<?php

// Assuming you have a function or method to get the current user's role
function getCurrentUserRole() {
    // Dummy implementation. Replace with actual logic to get the user role.
    return isset($_SESSION['role']) ? $_SESSION['role'] : null;
}

class AdminMenu {
    private $role;

    public function __construct($role) {
        $this->role = $role;
    }

    public function generateMenu() {
        if ($this->role == 1) {
            return '<li class="item">
                        <a href="admin-tasks.php">Task Management</a>
                    </li>
                    <li class="item">
                        <a href="admin-users.php">Users Management</a>
                    </li>
                    <li class="item">
                        <a href="activityLog.php">Activity Log</a>
                    </li>';
        } else{
            return '';
        }
    }
}
?>