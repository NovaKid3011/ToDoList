<?php
include_once 'Database.php'; // Tiyaking tama ang pangalan at case ng file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kunin ang mga ipinasa sa form
    $taskName = $_POST['taskName'];
    $taskDescription = $_POST['taskDescription'];

    // I-create ang instance ng Database class
    $db = new Database();
    $conn = $db->conn;

    // I-insert ang bagong task sa database
    $sql = "INSERT INTO tasks (taskName, description) VALUES ('$taskName', '$taskDescription')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motivea - Admin Side</title>
    <link rel="stylesheet" href="dashboard-admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
        }
        .containerTask {
            margin-top: 50px;
        }
        .modal-container {
            position: relative;
            z-index: 1050;
        }
    </style>
</head>
<body>
    <div class="containerTask mt-5">
        <h2>Admin Task Management</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTaskModal">Add Task</button>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Task Name</th>
                    <th>Description</th>
                    <th>Date Created</th>
                    <th>Files</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once 'Database.php'; // Tiyaking tama ang pangalan at case ng file
                $db = new Database();
                $conn = $db->conn;

                $sql = "SELECT * FROM tasks";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td><a href='#' class='description-btn' data-bs-toggle='modal' data-bs-target='#viewTaskModal' data-id='" . $row["id"] . "'>" . (isset($row["title"]) ? $row["title"] : '') . "</a></td>";
                        echo "<td>" . (isset($row["description"]) ? $row["description"] : '') . "</td>";
                        echo "<td>" . (isset($row["dateCreated"]) ? $row["dateCreated"] : '') . "</td>";
                        echo "<td><a href='" . (isset($row["files"]) ? $row["files"] : '') . "'>" . (isset($row["files"]) ? $row["files"] : '') . "</a></td>";
                        echo "<td>";
                        echo "<button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editTaskModal' data-id='" . $row["id"] . "' data-name='" . (isset($row["title"]) ? $row["title"] : '') . "' data-description='" . (isset($row["description"]) ? $row["description"] : '') . "'>Edit</button>";
                        echo "<a href='delete_task.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";

                    }
                } else {
                    echo "<tr><td colspan='6'>No tasks found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modals Container -->
    <div class="modal-container">
        <!-- Add Task Modal -->
        <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTaskModalLabel">Add Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="admin-tasks.php"> <!-- Updated action to current file -->
                            <div class="mb-3">
                                <label for="taskName" class="form-label">Task Name</label>
                                <input type="text" class="form-control" id="taskName" name="taskName" required>
                            </div>
                            <div class="mb-3">
                                <label for="taskDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="taskDescription" name="taskDescription" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Task</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Task Modal -->
        <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="task-update.php">
                            <input type="hidden" id="editTaskId" name="editTaskId">
                            <div class="mb-3">
                                <label for="editTaskName" class="form-label">Task Name</label>
                                <input type="text" class="form-control" id="editTaskName" name="editTaskName" required>
                            </div>
                            <div class="mb-3">
                                <label for="editTaskDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="editTaskDescription" name="editTaskDescription" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Task Modal -->
        <div class="modal fade" id="viewTaskModal" tabindex="-1" aria-labelledby="viewTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewTaskModalLabel">View Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        if (!empty($task)) {
                            echo "<h4 id='viewTaskName'>" . $task['taskName'] . "</h4>";
                            echo "<p id='viewTaskDescription'>" . $task['description'] . "</p>";
                            echo "<h5>Files</h5>";
                            echo "<a id='viewTaskFile' href='" . $task['file'] . "'>" . $task['file'] . "</a>";
                        } else {
                            echo "<p>No task details to display.</p>";
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
