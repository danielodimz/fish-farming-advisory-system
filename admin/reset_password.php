<?php include 'auth_check.php'; require '../includes/db.php'; ?>
<?php
if (isset($_GET['id'])) {
    $newPass = 'newpassword';  // Generate random or form input
    $hash = password_hash($newPass, PASSWORD_DEFAULT);
    $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->execute([$hash, $_GET['id']]);
    echo "Password reset to: $newPass";  // Email to user in production
}
?>