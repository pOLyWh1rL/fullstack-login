<?php
// api/soap_server.php
require_once '../config/db.php';
require_once '../models/User.php';

class UserSoapService {
    private $userModel;

    // The constructor initializes the Model using the global PDO connection
    public function __construct() {
        global $pdo;
        $this->userModel = new User($pdo);
    }

    // Expose the model's method to the SOAP client
    public function getUserCount() {
        return $this->userModel->getUserCount();
    }
}

// Initialize the SOAP Server
$options = array('uri' => 'http://localhost/fullstack-login/api/');
$server = new SoapServer(null, $options);
$server->setClass('UserSoapService');
$server->handle();
?>