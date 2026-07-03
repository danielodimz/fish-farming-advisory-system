<?php include 'auth_check.php'; require '../includes/db.php'; ?>
<?php
include '../db_connection.php';
require '../vendor/autoload.php';
require('../vendor/fpdf/fpdf/src/Fpdf/Fpdf.php');  // Adjust path
use Fpdf\Fpdf;


if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $username = $db->query("SELECT username FROM users WHERE id = $user_id")->fetchColumn();

    // Generate PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, "Certificate of Completion");
    $pdf->Ln(20);
    $pdf->Cell(40, 10, "This certifies that $username has completed the Fish Farming Tutorial.");
    $pdf->Ln(10);
    $pdf->Cell(40, 10, "Issued on: " . date('Y-m-d'));

    $path = "../certificates/cert_$user_id.pdf";
    $pdf->Output('F', $path);

    // Update DB
    $stmt = $db->prepare("INSERT INTO certificates (user_id, approved, issued_at, certificate_path) VALUES (?, 1, NOW(), ?)");
    $stmt->execute([$user_id, $path]);
    header("Location: certificate_approval.php");
}
?>