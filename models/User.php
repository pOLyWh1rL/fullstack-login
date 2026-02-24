<?php
// models/User.php

class User {
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Check if email exists
    public function emailExists($email) {
        $query = "SELECT id FROM " . $this->table . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    // Register a new user
    public function register($username, $email, $password) {
        $query = "INSERT INTO " . $this->table . " (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Execute with the hashed password provided by the controller
        return $stmt->execute([$username, $email, $password]);
    }

    // Get user by email for login (Includes 'role' column)
    public function getUserByEmail($email) {
        $query = "SELECT id, username, password, role FROM " . $this->table . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all users for the table display (Includes 'role' column)
    public function getAllUsers() {
        $query = "SELECT id, username, email, role, created_at FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get the total count of registered users for the SOAP API
    public function getUserCount() {
        $query = "SELECT COUNT(*) FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    // Get a single user by ID (for the edit form)
    public function getUserById($id) {
        $query = "SELECT id, username, email, role FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user information
    public function updateUser($id, $username, $email, $role) {
        $query = "UPDATE " . $this->table . " SET username = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$username, $email, $role, $id]);
    }

    // Delete a user
    public function deleteUser($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>