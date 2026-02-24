<?php
// api/test_soap.php

// Define the connection options. 
// We use 'location' to point to the server file, and 'uri' as the namespace.
$options = array(
    'location' => 'http://localhost/fullstack-login/api/soap_server.php',
    'uri'      => 'http://localhost/fullstack-login/api/'
);

try {
    // 1. Initialize the built-in PHP SOAP Client in non-WSDL mode
    $client = new SoapClient(null, $options);
    
    // 2. Call the function exactly as it was named in your soap_server.php class
    $userCount = $client->getUserCount();
    
    // 3. Display the result
    echo "<div style='font-family: Arial, sans-serif; padding: 20px;'>";
    echo "<h2 style='color: #0d6efd;'>SOAP API Test Successful!</h2>";
    echo "<p>The SOAP Server responded. Total registered users in the database: <strong>" . $userCount . "</strong></p>";
    echo "</div>";

} catch (SoapFault $e) {
    // Catch and display any XML or connection errors
    echo "<div style='font-family: Arial, sans-serif; padding: 20px; color: red;'>";
    echo "<h2>SOAP Error:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    echo "</div>";
}
?>