<?php
// dashboard-test-logOut.php

class Logout {
    public function __construct() {
        // Start the session
        session_start();
    }

    public function logoutUser() {
        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect to the homepage or any other page
        header("Location: HomePage.php"); // Assuming HomePage.php is your homepage
        exit;
    }
}

// Instantiate the class and call the logout method
$logout = new Logout();
$logout->logoutUser();
?>
