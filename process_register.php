<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        $_SESSION['username'] = $username;
        $_SESSION['success_message'] = 'Registration successful!';
        header("Location: dashboard2.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Registration failed: ' . $e->getMessage();
        header("Location: register.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = 'Invalid request.';
    header("Location: register.php");
    exit();
}
?>