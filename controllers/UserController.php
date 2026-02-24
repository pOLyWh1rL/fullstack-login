<?php
// controllers/UserController.php
require_once 'models/User.php';

class UserController {
    private $db;
    private $userModel;

    public function __construct($db) {
        $this->db = $db;
        $this->userModel = new User($this->db);
    }

    public function register() {
        $error = '';
        $success = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if ($this->userModel->emailExists($email)) {
                $error = "Email is already registered.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                if ($this->userModel->register($username, $email, $hashedPassword)) {
                    $success = "Registration successful! You can now log in.";
                } else {
                    $error = "Registration failed.";
                }
            }
        }
        require 'views/register.php';
    }

    public function dashboard() {
        // Protect the route: check if session exists
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        require 'views/dashboard.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }

    // Handles both showing the login form AND processing the submission
    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true); // Security: Prevent session fixation
                
                // Save the role in the session along with ID and username
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role']; 
                
                header("Location: index.php?action=dashboard");
                exit;
            } else {
                $error = "Invalid email or password.";
            }
        }
        require 'views/login.php';
    }

    public function users() {
        // 1. Check if logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        
        // 2. AUTHORIZATION CHECK: Kick them out if they are not an admin
        if ($_SESSION['role'] !== 'admin') {
            // Redirect back to dashboard with an error flag in the URL
            header("Location: index.php?action=dashboard&error=unauthorized");
            exit;
        }

        $stmt = $this->userModel->getAllUsers();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require 'views/user_list.php';
    }
    public function edit() {
        // 1. Authorization Check (Admin only)
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=dashboard&error=unauthorized");
            exit;
        }

        $error = '';
        $id = $_GET['id'] ?? null;

        // If no ID is provided, send them back to the user list
        if (!$id) {
            header("Location: index.php?action=users");
            exit;
        }

        // Process the form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $role = trim($_POST['role']);

            if ($this->userModel->updateUser($id, $username, $email, $role)) {
                header("Location: index.php?action=users&msg=updated");
                exit;
            } else {
                $error = "Failed to update user.";
            }
        }

        // Fetch the user data to populate the form
        $user = $this->userModel->getUserById($id);
        require 'views/edit_user.php';
    }

    public function delete() {
        // 1. Authorization Check (Admin only)
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=dashboard&error=unauthorized");
            exit;
        }

        $id = $_GET['id'] ?? null;
        
        // Prevent admins from accidentally deleting themselves
        if ($id && $id != $_SESSION['user_id']) {
            $this->userModel->deleteUser($id);
            header("Location: index.php?action=users&msg=deleted");
            exit;
        } else {
            header("Location: index.php?action=users&error=cannot_delete_self");
            exit;
        }
    }
}
?>