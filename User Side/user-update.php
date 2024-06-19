<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $userRole = $_POST['userRole'];

    // Optionally update photo if provided
    if (!empty($_FILES["userPhoto"]["name"])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["userPhoto"]["name"]);
        move_uploaded_file($_FILES["userPhoto"]["tmp_name"], $targetFile);
        $sql = "UPDATE users SET username='$username', email='$email', photo='$targetFile', role='$userRole' WHERE id='$userId'";
    } else {
        $sql = "UPDATE users SET username='$username', email='$email', role='$userRole' WHERE id='$userId'";
    }

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username='$username', email='$email', role='$userRole', password='$password' WHERE id='$userId'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
