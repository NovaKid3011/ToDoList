<?php
session_start();
include 'config.php';
include 'session.php';

// Gumawa ng bagong Database object
$db = new Database();
$conn = $db->conn; // I-set ang connection mula sa Database object

// Function to handle errors in SQL statements
function handle_sql_error($conn, $error_message) {
    $error_log_message = "Error: " . $conn->error;
    error_log($error_log_message);
    die($error_message . " - " . $error_log_message);
}

// Handle sign up
if (isset($_POST['signup'])) {
    // Validate inputs
    $username = trim($_POST['username']);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!$email || !$password || !$username || $password !== $confirm_password) {
        header("Location: SignIn_SignUp.php?error=invalid_input");
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (userName, email, password, userRole) VALUES (?, ?, ?, 0)"); // Default role is user (0)
    if (!$stmt) {
        handle_sql_error($conn, "Failed to prepare SQL statement for sign up.");
    }

    $stmt->bind_param('sss', $username, $email, $hashed_password);

    if ($stmt->execute()) {
        login($stmt->insert_id, $username, 0); // Default role is user (0)
        header("Location: dashboard-test.php");
        exit;
    } else {
        handle_sql_error($conn, "Failed to execute SQL statement for sign up.");
    }
}

// Handle sign in
if (isset($_POST['login'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if (!$email || !$password) {
        header("Location: SignIn_SignUp.php?error=invalid_input");
        exit;
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT userID, userName, password, userRole FROM users WHERE email = ?");
    if (!$stmt) {
        handle_sql_error($conn, "Failed to prepare SQL statement for sign in.");
    }

    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $username, $hashed_password, $role);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        login($user_id, $username, $role);
        if ($role == 1) { // Admin
            header("Location: dashboard-admin.php");
        } else { // User
            header("Location: dashboard-test.php");
        }
        exit;
    } else {
        header("Location: SignIn_SignUp.php?error=login_failed");
        exit;
    }
}
?>
