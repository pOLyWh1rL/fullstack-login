<?php
session_start();
require "../config/db.php";

$action = $_POST['action'];

if ($action === "register") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?,?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    header("Location: ../public/index.php");
}

if ($action === "login") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($password, $result['password'])) {
        $_SESSION['user'] = $username;
        header("Location: ../public/dashboard.php");
    } else {
        header("Location: ../public/index.php");
    }
}
