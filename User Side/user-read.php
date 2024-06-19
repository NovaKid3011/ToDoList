<?php
// Include mo ang iyong db_connection.php dito
include 'config.php';

class User {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    // Function para kunin ang lahat ng mga user mula sa database
    public function getAllUsers() {
        $users = array();

        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
    }
}

// Gumawa ng instance ng User class gamit ang koneksyon sa database
$userObj = new User($conn);

// Tawagin ang function na getAllUsers() para kunin ang lahat ng users
$allUsers = $userObj->getAllUsers();

// I-output ang resulta, pwede mong gawin ito sa JSON format depende sa iyong pangangailangan
print_r($allUsers);


?>
