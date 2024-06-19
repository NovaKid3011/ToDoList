<?php
require_once 'Database.php';

class Task {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Create task
    public function createTask($title, $description, $file, $userId) {
        $query = "INSERT INTO tasks (title, description, files, user_id) VALUES (?, ?, ?, ?)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssi', $title, $description, $file, $userId);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            // Log or handle the error appropriately
            return false;
        }
    }

    // Get tasks by user ID
    public function getUserTasks($userId) {
        $query = "SELECT * FROM tasks WHERE user_id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            // Log or handle the error appropriately
            return [];
        }
    }

    // Get all tasks
    public function getTasks() {
    $sql = "SELECT task_id as id, title, description, dateCreated, files FROM tasks";
    try {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            // Check existence of keys before outputting
            $task = [
                'id' => $row['id'],
                'title' => isset($row['title']) ? $row['title'] : '',
                'description' => isset($row['description']) ? $row['description'] : '',
                'dateCreated' => isset($row['dateCreated']) ? $row['dateCreated'] : '',
                'files' => isset($row['files']) ? $row['files'] : ''
            ];
            $tasks[] = $task;
        }
        return $tasks;
    } catch (Exception $e) {
        // Log or handle the error appropriately
        return [];
    }
}

    // Delete task
    public function deleteTask($taskId) {
        $query = "DELETE FROM tasks WHERE task_id = ?";
        $stmt = $this->db->prepare($query);
        
        if ($stmt === false) {
            error_log("Error preparing statement: " . $this->db->conn->error);
            return false;
        }

        $stmt->bind_param("i", $taskId);
        return $stmt->execute();
    }

    // Update task
    public function updateTask($taskId, $title, $description, $file) {
        $sql = "UPDATE tasks SET title = ?, description = ?, files = ? WHERE task_id = ?";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('sssi', $title, $description, $file, $taskId);
            $stmt->execute();
            return $stmt->affected_rows > 0;
        } catch (Exception $e) {
            // Log or handle the error appropriately
            return false;
        }
    }
}
?>
