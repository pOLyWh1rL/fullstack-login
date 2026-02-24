<?php
require_once '../config/db.php';

class UserSoapService {
    public function getUserCount() {
        global $pdo;
        $stmt = $pdo->query("SELECT COUNT(*) FROM users");
        return $stmt->fetchColumn();
    }
}

$options = array('uri' => 'http://localhost/fullstack-login/api/');
$server = new SoapServer(null, $options);
$server->setClass('UserSoapService');
$server->handle();
?>