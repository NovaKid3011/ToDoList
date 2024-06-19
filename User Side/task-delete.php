<?php

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    
    // Include necessary files and instantiate Task class if not already done
    require_once 'Task.php';
    $taskObj = new Task();
    
    // Attempt to delete the task
    $deleted = $taskObj->deleteTask($taskId);
    
    if ($deleted) {
        // Task deleted successfully
        // Redirect or display a success message
        header('Location: dashboard-test.php'); // Example redirect after deletion
        exit;
    } else {
        // Error deleting task
        // Handle error or redirect with error message
        header('Location: dashboard-test.php'); // Example redirect with error
        exit;
    }
} else {
    // Task ID not provided
    // Handle error or redirect with error message
    header('Location: dashboard-test.php'); // Example redirect with error
    exit;
}

?>
