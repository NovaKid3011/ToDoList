<?php
// task-create.php
require_once 'Task.php';
require_once 'session.php';

// Ensure the user is logged in
ensure_logged_in();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$userId = getCurrentUserId(); // This function retrieves the current logged-in user ID

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'create') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $file = $_FILES['file']; 

    // Handle file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        $filePath = $targetFile;
    } else {
        // Handle file upload error
        die("Error uploading file.");
    }

    // Save the task
    $taskObj = new Task();
    $taskObj->createTask($title, $description, $filePath, $userId);
}

header("Location: dashboard-test.php");
exit;
?>
