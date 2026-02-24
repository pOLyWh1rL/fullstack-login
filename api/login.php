<?php
header("Access-Control-Allow-Origin: *"); // For Vite frontend
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/db.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->password)) {
    // Model: SQL Query
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->execute([$data->email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Controller: Logic and validation
    if ($user && password_verify($data->password, $user['password'])) {
        echo json_encode(["status" => "success", "message" => "Login successful", "user" => $user['username']]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Incomplete data"]);
}
?>