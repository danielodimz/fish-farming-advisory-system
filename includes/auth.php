<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = 'Please log in to access this page.';
    header("Location: login.php");
    exit;
}
// Role-based check (optional, for user-only pages)
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header("Location: admin/dashboard.php");
    exit;
}
?>