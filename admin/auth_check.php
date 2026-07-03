<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error_message'] = 'Access denied. Please log in as admin.';
    header("Location: ../login.php");
    exit();
}
?>