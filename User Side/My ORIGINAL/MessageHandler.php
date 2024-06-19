<?php
session_start();

class MessageHandler {
    public function displayMessage() {
        if (isset($_SESSION['registration_message'])) {
            $message = $_SESSION['registration_message'];
            echo "<div class='alert alert-success'>$message</div>";
            unset($_SESSION['registration_message']); // Clear the session variable after displaying the message
        } elseif (isset($_SESSION['error_message'])) {
            $message = $_SESSION['error_message'];
            echo "<div class='alert alert-danger'>$message</div>";
            unset($_SESSION['error_message']); // Clear the session variable after displaying the message
        }
    }
}

$messageHandler = new MessageHandler();
$messageHandler->displayMessage();
?>
