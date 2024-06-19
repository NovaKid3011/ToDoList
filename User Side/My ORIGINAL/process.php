<?php
session_start(); // Start the session // way to persist data across
require "connect-database.php"; // contains code for establishing a database connection

class UserDetail {
    public $username; // for storing user details ni sila
    public $email;
    public $password;
    private $conn; // pang hold lang sa database connection

    public function __construct($conn, $username, $email, $password) { // gipasugod na ang  process sa userdetail, provided na ang db connection and user details
        $this->conn = $conn; // 
        $this->username = $username; // set a username
        $this->email = $email; // set a email
        $this->password = $password; // set a password
    }

    public function registration() {
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);

        // Prepare and bind the INSERT statement

        // prepare para sa pag-insert data
        $stmt = $this->conn->prepare("INSERT INTO users (UserName, Email, Password) VALUES (?, ?, ?)");
        // tie the new data //  In this case, it indicates that all parameters are strings (s).
        $stmt->bind_param("sss", $this->username, $this->email, $passwordHash);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['registration_message'] = "User registered successfully!";
            header("Location: registration success.php");
            exit;
        } else {
            $_SESSION['error_message'] = "Error registering user: " . $stmt->error;
            header("Location: index.php");
            exit;
        }
    }
}

// Establish database connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['inputUsername'] ?? '';
    $email = $_POST['inputEmail'] ?? '';
    $password = $_POST['inputPassword'] ?? '';

    // Create UserDetail object with database connection
    $user = new UserDetail($conn, $username, $email, $password);

    // Call the registration method
    $user->registration();
}

// Close the database connection
$conn->close();


?>

