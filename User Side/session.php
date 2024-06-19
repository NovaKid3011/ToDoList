<?php
// session.php
session_start();

function login($user_id, $username, $role) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
}

function logout() {
    session_unset();
    session_destroy();
    header("Location: HomePage.php");
    exit;
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function log_session($action) {
    $log_message = "User: {$_SESSION['username']} - Action: $action - Time: " . date('Y-m-d H:i:s') . "\n";
    file_put_contents('session_log.txt', $log_message, FILE_APPEND);
}

function ensure_admin() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) { // Admin role is 1
        exit;
    }
}

function ensure_logged_in() {
    if (!is_logged_in()) {
        header("Location: login.php");
        exit;
    }
}

function getCurrentUserId() {
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}

function getID($id){
    $_SESSION['getID'] = $id;
}
?>
