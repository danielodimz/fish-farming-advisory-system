<?php include 'auth_check.php'; require '../includes/db.php'; ?>
<?php
include '../db_connection.php';
$title = $_POST['title'];
$content = $_POST['content'];
$materials = $_POST['materials'];

// Handle image upload
$image_url = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $target_dir = "../uploads/";
    $image_url = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $image_url);
}

$stmt = $db->prepare("INSERT INTO modules (title, content, image_url, supporting_materials) VALUES (?, ?, ?, ?)");
$stmt->execute([$title, $content, $image_url, $materials]);
header("Location: content_management.php");
?>