<?php
// User.php

class User {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    // Function para sa paggawa ng bagong user
    public function createUser($username, $email, $password, $role, $photo) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (userName, email, password, userRole, photo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssss', $username, $email, $hashed_password, $role, $photo);
        return $stmt->execute();
    }

    // Function para sa pagbasa ng user base sa user ID
    public function getUserById($user_id) {
        $sql = "SELECT * FROM users WHERE userID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Function para sa pag-update ng user details
    public function updateUser($user_id, $username, $email, $role) {
        $sql = "UPDATE users SET userName = ?, email = ?, userRole = ? WHERE userID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssi', $username, $email, $role, $user_id);
        return $stmt->execute();
    }

    // Function para sa pagtanggal ng user base sa user ID
    public function deleteUser($user_id) {
        $sql = "DELETE FROM users WHERE userID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        return $stmt->execute();
    }
}
?>
