<?php session_start(); ?>
<?php require 'includes/db.php'; ?>

<?php
$user_id = $_SESSION['user_id'];

// Check if already requested
$stmt = $db->prepare("SELECT * FROM certificates WHERE user_id = ?");
$stmt->execute([$user_id]);
if ($stmt->fetch()) {
    $_SESSION['error_message'] = "Certificate already requested.";
} else {
    $stmt = $db->prepare("INSERT INTO certificates (user_id) VALUES (?)");
    $stmt->execute([$user_id]);
    $_SESSION['success_message'] = "Certificate requested! Await admin approval.";
}

header("Location: dashboard2.php");
exit();
?>