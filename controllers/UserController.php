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

    // Handles both showing the login form AND processing the submission
    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Set session variables and redirect to dashboard
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: index.php?action=dashboard");
                exit;
            } else {
                $error = "Invalid email or password.";
            }
        }
        // Load the view, passing any error messages
        require 'views/login.php';
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

    public function users() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $stmt = $this->userModel->getAllUsers();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require 'views/user_list.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}
?>