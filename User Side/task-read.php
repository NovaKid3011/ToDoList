<?php
include 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $taskId = $_GET['id'];

    $sql = "SELECT * FROM tasks WHERE task_id='$taskId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $task = $result->fetch_assoc();
    } else {
        echo "No task found";
        $task = [];
    }
    $conn->close();
}
?>
