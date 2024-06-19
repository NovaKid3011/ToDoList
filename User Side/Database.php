<?php
class Database {
    private $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli('localhost', 'root', '', 'todolistdb');

        if ($this->conn->connect_errno) {
            error_log("Failed to connect to MySQL: " . $this->conn->connect_error);
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function prepare($query) {
        return $this->conn->prepare($query);
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>

