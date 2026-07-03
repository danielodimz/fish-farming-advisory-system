<?php
include 'includes/auth.php';
require 'includes/db.php';

$user_id = $_SESSION['user_id'];

// Check certificate eligibility
$stmt = $db->prepare("SELECT COUNT(*) AS total_modules, SUM(completed) AS completed_modules FROM user_progress WHERE user_id = ?");
$stmt->execute([$user_id]);
$progress = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("SELECT AVG(score) AS avg_score FROM quiz_results WHERE user_id = ?");
$stmt->execute([$user_id]);
$avg_score = $stmt->fetchColumn();
$stmt = $db->prepare("SELECT COUNT(*) AS total_videos, SUM(viewed) AS viewed_videos FROM video_progress WHERE user_id = ?");
$stmt->execute([$user_id]);
$video_progress = $stmt->fetch(PDO::FETCH_ASSOC);

$eligible = $progress['total_modules'] == $progress['completed_modules'] && 
            $avg_score >= 70 && 
            $video_progress['total_videos'] == $video_progress['viewed_videos'];

// Check existing certificate status
$stmt = $db->prepare("SELECT status FROM certificates WHERE user_id = ?");
$stmt->execute([$user_id]);
$certificate = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission for requesting a certificate
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        $_SESSION['error_message'] = 'Invalid CSRF token.';
        header("Location: certificate.php");
        exit;
    }

    if ($eligible && (!$certificate || $certificate['status'] != 'approved')) {
        $stmt = $db->prepare("INSERT INTO certificates (user_id, status) VALUES (?, 'pending') ON DUPLICATE KEY UPDATE status = 'pending'");
        $stmt->execute([$user_id]);
        $_SESSION['success_message'] = 'Certificate request submitted successfully!';
    } else {
        $_SESSION['error_message'] = 'You are not eligible to request a certificate or it is already approved.';
    }
    header("Location: certificate.php");
    exit;
}

// Generate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<?php include 'includes/header2.php'; ?>

<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold">Certificate Status</h3>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Certificate Eligibility</h4>
                    <p>Modules Completed: <?php echo $progress['completed_modules'] . '/' . $progress['total_modules']; ?></p>
                    <p>Videos Watched: <?php echo $video_progress['viewed_videos'] . '/' . $video_progress['total_videos']; ?></p>
                    <p>Average Quiz Score: <?php echo $avg_score ? round($avg_score, 1) . '%' : 'N/A'; ?></p>
                    <p>Eligibility: <?php echo $eligible ? 'Eligible' : 'Not Eligible'; ?></p>
                    <?php if ($certificate): ?>
                        <p>Certificate Status: <?php echo htmlspecialchars($certificate['status']); ?></p>
                        <?php if ($certificate['status'] == 'approved'): ?>
                            <a href="certificates/certificate_<?php echo $user_id; ?>.pdf" class="btn btn-primary btn-sm" target="_blank">Download Certificate</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>Certificate Status: Not Requested</p>
                    <?php endif; ?>
                    <?php if ($eligible && (!$certificate || $certificate['status'] != 'approved')): ?>
                        <form method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                            <button type="submit" class="btn btn-primary">Request Certificate</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php include 'includes/footer2.php'; ?>