<?php
include 'config.php'; // Include the database connection file

// Create instance of Database class to get the connection
$database = new Database();
$conn = $database->getConnection();

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
header("Location: admin-users.php"); // Redirect back to the admin-users page
exit();
?>
