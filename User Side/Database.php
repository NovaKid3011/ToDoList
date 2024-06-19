<?php
class Database {
    public $conn;

    public function __construct() {
        $host = 'localhost';
        $username = 'root'; // Replace with your actual username
        $password = ''; // Replace with your actual password
        $database = 'todolistdb'; // Replace with your actual database name

        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function prepare($query) {
        return $this->conn->prepare($query);
    }

    public function query($query) {
        return $this->conn->query($query);
    }

}
?>
