<?php
// index.php
session_start(); // Start session for authentication

require_once 'config/db.php';
require_once 'controllers/UserController.php';

$controller = new UserController($pdo);

// Simple routing based on the '?action=' URL parameter
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action) {
    case 'register':
        $controller->register();
        break;
    case 'login':
        $controller->login();
        break;
    case 'dashboard':
        $controller->dashboard();
        break;
    case 'users':
        $controller->users();
        break;
    case 'logout':
        $controller->logout();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->login();
        break;
}
?>