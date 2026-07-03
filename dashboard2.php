<?php
include 'includes/auth.php';
require 'includes/db.php';
include 'includes/header2.php';

$user_id = $_SESSION['user_id'];

// Ensure user_progress entries for all modules
$stmt = $db->query("SELECT id FROM modules");
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($modules as $module) {
    $stmt = $db->prepare("INSERT INTO user_progress (user_id, module_id, completed) VALUES (?, ?, 0) ON DUPLICATE KEY UPDATE user_id = user_id");
    $stmt->execute([$user_id, $module['id']]);
}

// Fetch modules and progress
$stmt = $db->query("SELECT * FROM modules");
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("SELECT * FROM user_progress WHERE user_id = ?");
$stmt->execute([$user_id]);
$progress = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch video progress
$stmt = $db->prepare("SELECT COUNT(*) AS total_videos, SUM(viewed) AS viewed_videos FROM video_progress WHERE user_id = ?");
$stmt->execute([$user_id]);
$video_progress = $stmt->fetch(PDO::FETCH_ASSOC);
$total_videos = $video_progress['total_videos'];
$viewed_videos = $video_progress['viewed_videos'];

// Fetch quiz score
$stmt = $db->prepare("SELECT AVG(score) AS avg_score FROM quiz_results WHERE user_id = ?");
$stmt->execute([$user_id]);
$avg_score = $stmt->fetchColumn();

// Fetch certificate status
$stmt = $db->prepare("SELECT status FROM certificates WHERE user_id = ?");
$stmt->execute([$user_id]);
$certificate = $stmt->fetch(PDO::FETCH_ASSOC);

// Calculate module progress
$progressMap = [];
foreach ($progress as $p) {
    $progressMap[$p['module_id']] = $p;
}

$totalModules = count($modules);
$completed = 0;
$inProgress = 0;
$behind = 0; // Initialize to 0, not $totalModules
foreach ($modules as $m) {
    if (isset($progressMap[$m['id']])) {
        if ($progressMap[$m['id']]['completed']) {
            $completed++;
        } else {
            $inProgress++;
        }
    } else {
        $behind++; // Should not occur due to initial insert
    }
}
$completedPerc = $totalModules > 0 ? round(($completed / $totalModules) * 100) : 0;
$inProgressPerc = $totalModules > 0 ? round(($inProgress / $totalModules) * 100) : 0;
$behindPerc = $totalModules > 0 ? round(($behind / $totalModules) * 100) : 0;

// Check certificate eligibility
$eligible = $completed == $totalModules && $total_videos == $viewed_videos && $avg_score >= 70;
?>

<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold">User Dashboard</h3>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <div class="card">
                <div class="card-body">
                    <a href="view_module.php">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div><h4 class="mb-0">Lessons</h4></div>
                            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                <i class="bi bi-briefcase fs-4"></i>
                            </div>
                        </div>
                        <div><h1 class="fw-bold"><?php echo $totalModules; ?></h1><p class="mb-0">View</p></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <div class="card">
                <div class="card-body">
                    <a href="videos.php?category=backyard">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div><h4 class="mb-0">Video Lessons</h4></div>
                            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                <i class="bi bi-list-task fs-4"></i>
                            </div>
                        </div>
                        <div><h1 class="fw-bold"><?php echo $total_videos; ?></h1><p class="mb-0">View</p></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <div class="card">
                <div class="card-body">
                    <a href="certificate.php">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div><h4 class="mb-0">Certificate</h4></div>
                            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                <i class="bi bi-award fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <h1 class="fw-bold"><?php echo $eligible ? 'Eligible' : 'Not Eligible'; ?></h1>
                            <p class="mb-0">
                                <?php echo $certificate ? htmlspecialchars($certificate['status']) : 'Not Requested'; ?>
                                <?php if ($certificate && $certificate['status'] == 'approved'): ?>
                                    <a href="certificates/certificate_<?php echo $user_id; ?>.pdf" class="btn btn-primary btn-sm" target="_blank">Download</a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-6 col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Certificate Eligibility Progress</h4>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Modules Completed
                            <span><?php echo $completed . '/' . $totalModules; ?> (<?php echo $completedPerc; ?>%)</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Videos Watched
                            <span><?php echo $viewed_videos . '/' . $total_videos; ?> (<?php echo $total_videos > 0 ? round(($viewed_videos / $total_videos) * 100) : 0; ?>%)</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Average Quiz Score
                            <span><?php echo $avg_score ? round($avg_score, 1) . '%' : 'N/A'; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Certificate Status
                            <span><?php echo $certificate ? htmlspecialchars($certificate['status']) : 'Not Requested'; ?></span>
                        </li>
                    </ul>
                    <?php if ($eligible && (!$certificate || $certificate['status'] != 'approved')): ?>
                        <a href="certificate.php" class="btn btn-primary mt-3">Request Certificate</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Module Progress</h4>
                    <canvas id="perfomanceChart"></canvas>
                    <div class="d-flex justify-content-around mt-4">
                        <div class="text-center">
                            <i class="icon-sm text-success" data-feather="check-circle"></i>
                            <h1 class="mt-3 mb-1 fw-bold"><?php echo $completedPerc; ?>%</h1>
                            <p>Completed</p>
                        </div>
                        <div class="text-center">
                            <i class="icon-sm text-warning" data-feather="trending-up"></i>
                            <h1 class="mt-3 mb-1 fw-bold"><?php echo $inProgressPerc; ?>%</h1>
                            <p>In Progress</p>
                        </div>
                        <div class="text-center">
                            <i class="icon-sm text-danger" data-feather="alert-circle"></i>
                            <h1 class="mt-3 mb-1 fw-bold"><?php echo $behindPerc; ?>%</h1>
                            <p>Behind</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo isset($_SESSION['success_message']) ? htmlspecialchars($_SESSION['success_message']) : 'Action successful!'; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo isset($_SESSION['error_message']) ? htmlspecialchars($_SESSION['error_message']) : 'An error occurred.'; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('perfomanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'In-Progress', 'Behind'],
                datasets: [{
                    data: [<?php echo $completedPerc; ?>, <?php echo $inProgressPerc; ?>, <?php echo $behindPerc; ?>],
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                    borderColor: ['#28a745', '#ffc107', '#dc3545'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Module Progress' }
                }
            }
        });

        <?php if (isset($_SESSION['success_message'])): ?>
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
    });
</script>

<?php include 'includes/footer2.php'; ?>