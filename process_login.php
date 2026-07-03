<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = trim($_POST['username']);  // Added trim for sanitization
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$input, $input]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];  // Added for progress tracking
        $_SESSION['role'] = $user['role'];   // Added role
        $_SESSION['success_message'] = 'Login successful!';
        // Debug: Log session before redirect
        file_put_contents('login_success_debug.txt', print_r($_SESSION, true));
        
        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: dashboard2.php");
        }
        exit();
    } else {
        $_SESSION['error_message'] = 'Invalid username or email or password.';
        // Debug: Log session before redirect
        file_put_contents('login_error_debug.txt', print_r($_SESSION, true));
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = 'Invalid request.';
    // Debug: Log session before redirect
    file_put_contents('login_error_debug.txt', print_r($_SESSION, true));
    header("Location: login.php");
    exit();
}
?>