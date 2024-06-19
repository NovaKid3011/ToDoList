<?php

// mao ni ang code arun mag initialize ang operation sa connection sa database
class Database { 
    // prepare and mga database parameters
    private $servername;
    private $dbusername; // mga parameters sa ahong understanding they are...       
    private $dbpassword; // ...stored as private and encapsulated sulod sa class. 
    private $dbname;    // they are aslo can be accessible throughtout sa process.
    private $conn;  // para sa actual connection na gi-established sa database server.

    // Constructor to initialize database connection parameters  // automatic call dayun ang parameters
    public function __construct($servername, $dbusername, $dbpassword, $dbname) {
        $this->servername = $servername; // ang kini na parameter passed to the constructor na gi-assign sa $servername sad hahah
        $this->dbusername = $dbusername;
        $this->dbpassword = $dbpassword;
        $this->dbname = $dbname;
    }

    // establishes the connection with the database server emeeh!
    public function connect() {
        //
        $this->conn = new mysqli($this->servername, $this->dbusername, $this->dbpassword);
        // In case of Error connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        
        // Select the database
        if (!$this->conn->select_db($this->dbname)) {
        // If the database doesn't exist, create it
        $this->createDatabase();
        // After creating the database, select it again
        $this->conn->select_db($this->dbname);
    }

    }

    public function createDatabase() {
        $this->connect(); // to recognize og ma-establish and connection
        $sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS " . $this->dbname;
        if ($this->conn->query($sqlCreateDatabase) === FALSE) { // query execution
            echo "Error creating database: " . $this->conn->error;
        }
    }

    public function createTableUsers() {
        $this->connect(); // to recognize og ma-establish and connection
        $EmailMaxLength = 50; // set maximum lenght for email
        $tableOne = "users";
        $sqlCreateTableUsers = "CREATE TABLE IF NOT EXISTS $tableOne (
            UserID INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            UserName VARCHAR(30) NOT NULL,
            Email VARCHAR($EmailMaxLength) UNIQUE NOT NULL,
            Password VARCHAR(60) NOT NULL,
            Role INT(1) DEFAULT 1
        )";
        if ($this->conn->query($sqlCreateTableUsers) === FALSE) { //  to check if it is working well or not
            echo "Error creating table: " . $this->conn->error;
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

// mga value na gamiton
$dbname = "registrationdb";
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";

$database = new Database($servername, $dbusername, $dbpassword, $dbname);
$database->createDatabase(); //Create the database if it doesn't exist
$database->createTableUsers();
$database->closeConnection();

?>
