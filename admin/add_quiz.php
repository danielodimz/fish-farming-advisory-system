<?php include 'auth_check.php'; require '../includes/db.php'; ?>
<?php
include '../db_connection.php';
$module_id = $_POST['module_id'];
$question = $_POST['question'];
$options = $_POST['options'];  // Validate as JSON
$correct = $_POST['correct_answer'];

$stmt = $db->prepare("INSERT INTO quizzes (module_id, question, options, correct_answer) VALUES (?, ?, ?, ?)");
$stmt->execute([$module_id, $question, $options, $correct]);
header("Location: quiz_management.php");
?>