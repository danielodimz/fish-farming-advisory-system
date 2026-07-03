<?php
include 'auth_check.php';
require '../includes/db.php';

// Fetch summary statistics
$userCount = $db->query("SELECT COUNT(*) FROM users")->fetchColumn(); // Count all users
$moduleCount = $db->query("SELECT COUNT(*) FROM modules")->fetchColumn();
$quizCount = $db->query("SELECT COUNT(*) FROM quizzes")->fetchColumn();
$pendingCertificates = $db->query("SELECT COUNT(*) FROM certificates WHERE status = 'pending'")->fetchColumn();

// Debug: Fetch role distribution
$stmt = $db->query("SELECT role, COUNT(*) AS count FROM users GROUP BY role");
$roleDistribution = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch progress data for chart
$stmt = $db->query("SELECT COUNT(*) AS total, SUM(completed) AS completed FROM user_progress");
$progress = $stmt->fetch(PDO::FETCH_ASSOC);
$totalProgress = $progress['total'] ?: 1; // Avoid division by zero
$completedPerc = round(($progress['completed'] / $totalProgress) * 100);
$inProgressPerc = round(($progress['total'] - $progress['completed']) / $totalProgress * 100);
?>

<?php include 'includes/header2.php'; ?>

<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold">Admin Dashboard</h3>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Welcome, Admin <?php echo htmlspecialchars($_SESSION['username']); ?></h4>
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="mb-0">Total Users</h5>
                                    <h1 class="fw-bold"><?php echo $userCount; ?></h1>
                                    <a href="user_management.php" class="btn btn-primary btn-sm">Manage Users</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="mb-0">Total Modules</h5>
                                    <h1 class="fw-bold"><?php echo $moduleCount; ?></h1>
                                    <a href="content_management.php" class="btn btn-primary btn-sm">Manage Modules</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="mb-0">Total Quizzes</h5>
                                    <h1 class="fw-bold"><?php echo $quizCount; ?></h1>
                                    <a href="quiz_management.php" class="btn btn-primary btn-sm">Manage Quizzes</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="mb-0">Pending Certificates</h5>
                                    <h1 class="fw-bold"><?php echo $pendingCertificates; ?></h1>
                                    <a href="certificate_approval.php" class="btn btn-primary btn-sm">Approve Certificates</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Debug: Role Distribution -->
                    <div class="mt-4">
                        <h5>Role Distribution</h5>
                        <ul>
                            <?php foreach ($roleDistribution as $role): ?>
                                <li><?php echo htmlspecialchars($role['role'] ?: 'No Role'); ?>: <?php echo $role['count']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Overall Progress</h4>
                </div>
                <div class="card-body">
                    <canvas id="progressChart"></canvas>
                    <div class="d-flex align-items-center justify-content-around mt-4">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('progressChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'In Progress'],
                datasets: [{
                    data: [<?php echo $completedPerc; ?>, <?php echo $inProgressPerc; ?>],
                    backgroundColor: ['#28a745', '#ffc107'],
                    borderColor: ['#28a745', '#ffc107'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Overall User Progress' }
                }
            }
        });
    });
</script>

<?php include 'includes/footer2.php'; ?>