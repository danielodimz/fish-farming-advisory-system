<?php
include 'auth_check.php';
require '../includes/db.php';
require '../vendor/fpdf/fpdf/src/Fpdf/Fpdf.php';
use Fpdf\Fpdf;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        $_SESSION['error_message'] = 'Invalid CSRF token.';
        header("Location: certificate_approval.php");
        exit;
    }

    $user_id = (int)($_POST['user_id'] ?? 0);
    $action = $_POST['action'] ?? '';

    if ($user_id && in_array($action, ['approve', 'reject'])) {
        // Verify eligibility for approval
        if ($action === 'approve') {
            $stmt = $db->prepare("SELECT COUNT(*) AS total_modules, SUM(up.completed) AS completed_modules FROM user_progress up WHERE up.user_id = ?");
            $stmt->execute([$user_id]);
            $progress = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = $db->prepare("SELECT AVG(qr.score) AS avg_score FROM quiz_results qr JOIN quizzes q ON qr.quiz_id = q.id WHERE qr.user_id = ?");
            $stmt->execute([$user_id]);
            $avg_score = $stmt->fetchColumn();
            $stmt = $db->prepare("SELECT COUNT(*) AS total_videos, SUM(vp.viewed) AS viewed_videos FROM video_progress vp WHERE vp.user_id = ?");
            $stmt->execute([$user_id]);
            $video_progress = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($progress['total_modules'] != $progress['completed_modules'] || $avg_score < 70 || $video_progress['total_videos'] != $video_progress['viewed_videos']) {
                $_SESSION['error_message'] = 'User is not eligible for a certificate.';
                header("Location: certificate_approval.php");
                exit;
            }

            // Generate PDF certificate
            $stmt = $db->prepare("SELECT username FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $username = $user['username'];

            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Certificate of Completion', 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, "This certifies that $username has successfully completed", 0, 1, 'C');
            $pdf->Cell(0, 10, 'the Fish Farming Course at Odimz Farm.', 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->Cell(0, 10, 'Date: ' . date('M d, Y'), 0, 1, 'C');
            $pdf->Output('F', "../certificates/certificate_$user_id.pdf");

            // Update certificate status
            $stmt = $db->prepare("UPDATE certificates SET status = 'approved', issued_date = NOW() WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $_SESSION['success_message'] = 'Certificate approved and generated successfully.';
        } else {
            // Reject certificate
            $stmt = $db->prepare("UPDATE certificates SET status = 'rejected' WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $_SESSION['success_message'] = 'Certificate request rejected.';
        }
        header("Location: certificate_approval.php");
        exit;
    } else {
        $_SESSION['error_message'] = 'Invalid action or user.';
        header("Location: certificate_approval.php");
        exit;
    }
}

// Generate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// Fetch pending certificate requests
$stmt = $db->prepare("
    SELECT c.user_id, c.status, c.issued_date, u.username, u.email,
           COUNT(up.module_id) AS total_modules, SUM(up.completed) AS completed_modules,
           AVG(qr.score) AS avg_score,
           COUNT(vp.video_id) AS total_videos, SUM(vp.viewed) AS viewed_videos
    FROM certificates c
    JOIN users u ON c.user_id = u.id
    LEFT JOIN user_progress up ON u.id = up.user_id
    LEFT JOIN quiz_results qr ON u.id = qr.user_id
    LEFT JOIN quizzes q ON qr.quiz_id = q.id
    LEFT JOIN video_progress vp ON u.id = vp.user_id
    WHERE c.status = 'pending'
    GROUP BY c.user_id, u.username, u.email
");
$stmt->execute();
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header2.php'; ?>

<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold">Certificate Approval</h3>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Pending Certificate Requests</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Modules Completed</th>
                                <th>Videos Watched</th>
                                <th>Average Quiz Score</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($requests as $request): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($request['username']); ?></td>
                                    <td><?php echo htmlspecialchars($request['email']); ?></td>
                                    <td><?php echo $request['completed_modules'] . '/' . $request['total_modules']; ?></td>
                                    <td><?php echo $request['viewed_videos'] . '/' . $request['total_videos']; ?></td>
                                    <td><?php echo $request['avg_score'] ? round($request['avg_score'], 1) . '%' : 'N/A'; ?></td>
                                    <td><span class="badge bg-warning"><?php echo htmlspecialchars($request['status']); ?></span></td>
                                    <td>
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $request['user_id']; ?>">
                                            <input type="hidden" name="action" value="approve">
                                            <button type="submit" class="btn btn-sm btn-success" <?php echo $request['completed_modules'] == $request['total_modules'] && $request['avg_score'] >= 70 && $request['total_videos'] == $request['viewed_videos'] ? '' : 'disabled'; ?>>Approve</button>
                                        </form>
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $request['user_id']; ?>">
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($requests)): ?>
                                <tr><td colspan="7">No pending certificate requests.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php include 'includes/footer2.php'; ?>