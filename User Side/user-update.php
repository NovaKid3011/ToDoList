<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_GET['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $userRole = $_POST['userRole'];

    var_dump($userId);
    die;

    $db = new Database();
    $conn = $db->conn;


    if ($conn == TRUE) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET userName='$username', email='$email', photo='$targetFile', userRole='$userRole', password='$password' WHERE userID='$userId'";
        header("Location: admin-users.php");
    } else {
        echo "";
    }
    $conn->close();
}
?>
