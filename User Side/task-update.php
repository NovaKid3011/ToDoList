<?php
include 'Database.php'; // Include to establish $conn
include 'Task.php'; // Include Task class file

$db = new Database(); // Assuming this initializes $conn correctly
$conn = $db->conn;

// Check if form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id'], $_POST['title'], $_POST['description'])) {
    // Sanitize inputs if needed
    $taskId = htmlspecialchars($_POST['task_id']);
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    // Assuming other form fields like 'file' are handled appropriately

    // Create new Task instance
    $taskObj = new Task();

    // Call updateTask method
    if ($taskObj->updateTask($taskId, $title, $description)) {
        // If update is successful, redirect to dashboard-test.php or appropriate page
        header('Location: dashboard-test.php');
        exit();
    } else {
        // If update fails, display an error message
        echo "Error updating task.";
    }
} else {
    // Handle case where required POST parameters are not set
    echo "Invalid request.";
}
?>
