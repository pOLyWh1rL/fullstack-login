<?php
// api/register.php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/db.php';

// Get the raw JSON POST data sent by React
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->username) && !empty($data->email) && !empty($data->password)) {
    
    // 1. Check if the email is already registered
    $checkStmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $checkStmt->execute([$data->email]);
    
    if ($checkStmt->rowCount() > 0) {
        echo json_encode(["status" => "error", "message" => "Email is already registered."]);
        exit;
    }

    // 2. Hash the password securely
    $hashedPassword = password_hash($data->password, PASSWORD_DEFAULT);

    // 3. The INSERT query using placeholders (?) to prevent SQL Injection
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    
    try {
        if ($stmt->execute([$data->username, $data->email, $hashedPassword])) {
            echo json_encode(["status" => "success", "message" => "Registration successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Registration failed."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    }
    
} else {
    echo json_encode(["status" => "error", "message" => "Please fill in all fields."]);
}
?>