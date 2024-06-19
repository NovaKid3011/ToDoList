<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $userRole = $_POST['userRole'];
    $createdAt = date("Y-m-d H:i:s");

    // File upload handling
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["userPhoto"]["name"]);
    move_uploaded_file($_FILES["userPhoto"]["tmp_name"], $targetFile);

    // Hash the password
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // SQL query to insert new user
    $sql = "INSERT INTO users (username, email, photo, role, created_at, password) VALUES ('$username', '$email', '$targetFile', '$userRole', '$createdAt', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New user created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
