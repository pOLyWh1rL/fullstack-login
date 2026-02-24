<?php
// api/get_users.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/db.php';

try {
    // Model: SQL Query to get all users
    $stmt = $pdo->query("SELECT id, username, email, created_at FROM users ORDER BY created_at DESC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Controller: Return the data as JSON
    if ($users) {
        echo json_encode(["status" => "success", "data" => $users]);
    } else {
        echo json_encode(["status" => "success", "data" => []]); // Return empty array if no users
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>