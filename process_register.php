<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    // Check username uniqueness
    $stmt = $db->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        $_SESSION['error_message'] = 'That username is already taken.';
        header("Location: register.php");
        exit();
    }

    // Check email uniqueness
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['error_message'] = 'An account with that email already exists.';
        header("Location: register.php");
        exit();
    }

    try {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'student')");
        $stmt->execute([$username, $email, $hashed]);

        // Log the new user in and send them to their dashboard
        $_SESSION['user_id']  = $db->lastInsertId();
        $_SESSION['username'] = $username;
        $_SESSION['role']     = 'student';

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