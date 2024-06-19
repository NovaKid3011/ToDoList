<?php
require_once 'Task.php'; // Ensure Task.php exists and is correct
require_once 'Database.php'; // Ensure Database.php exists and is correct

session_start(); // Start the session

// Function to print debug information
function debug($message) {
    error_log($message);
}

// Check if the request method is POST and task_id is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id']) && isset($_SESSION['username'])) {
    $taskId = $_POST['task_id'];

    // Create Task object and attempt to delete the task
    try {
        $taskObj = new Task();

        // Delete the task
        if ($taskObj->deleteTask($taskId)) {
            // Task successfully deleted
            $_SESSION['success_message'] = "Task successfully deleted.";
        } else {
            // Task deletion failed
            $_SESSION['error_message'] = "Error deleting task.";
            debug("Failed to delete task with ID: $taskId");
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Exception: " . $e->getMessage();
        debug("Exception caught: " . $e->getMessage());
    }

    // Redirect back to dashboard-test.php after the deletion attempt
    header('Location: dashboard-test.php');
    exit();
} else {
    // Invalid request or insufficient permissions
    $_SESSION['error_message'] = "Invalid request or insufficient permissions.";
    debug("Invalid request or insufficient permissions. POST data: " . print_r($_POST, true));
    header('Location: dashboard-test.php');
    exit();
}
?>
