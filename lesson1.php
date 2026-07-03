<?php
include 'includes/auth.php';
require 'includes/db.php';
include 'includes/header2.php';

$user_id = $_SESSION['user_id'];
$module_id = 1; // Map to module ID (1 for lesson1.php, 2 for lesson2.php, etc.)

// Start progress if not exists
$stmt = $db->prepare("INSERT IGNORE INTO user_progress (user_id, module_id) VALUES (?, ?)");
$stmt->execute([$user_id, $module_id]);
?>

<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold">Lessons</h3>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-3 col-lg-4 col-md-12 col-12">
            <div class="mb-4 mb-lg-0">
                <h4 class="mb-1">Lesson 1</h4>
                <p class="mb-0 fs-5 text-muted">Introduction to Fish Farming</p>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Fish farming, also known as aquaculture, is the process of raising fish in controlled environments for commercial, personal, or educational purposes. With the rising demand for fish and the decline of natural fish stocks, aquaculture has become a sustainable and profitable alternative to traditional fishing.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    <table class="table table-hover mb-6">
                        <thead>
                            <h5>Why Learn Fish Farming?</h5>
                            <tr><th scope="col">✅</th><th scope="col">Growing demand for fish as a protein source</th></tr>
                        </thead>
                        <tbody>
                            <tr><th scope="row">✅</th><td>High return on investment</td></tr>
                            <tr><th scope="row">✅</th><td>Low startup cost compared to other livestock</td></tr>
                            <tr><th scope="row">✅</th><td>Can be practiced on a small scale in backyards</td></tr>
                            <tr><th scope="row">✅</th><td>Opportunity to contribute to food security</td></tr>
                        </tbody>
                    </table>
                    <table class="table table-hover mb-6">
                        <thead>
                            <h5>Types of Fish You Can Farm</h5>
                            <tr><th scope="col">🐟</th><th scope="col">Catfish (very popular in Nigeria and West Africa)</th></tr>
                        </thead>
                        <tbody>
                            <tr><th scope="row">🐠</th><td>Tilapia (fast-growing and hardy)</td></tr>
                            <tr><th scope="row">🐡</th><td>Carp</td></tr>
                            <tr><th scope="row">🦈</th><td>Clarias & Heterobranchus (hybrid catfish)</td></tr>
                        </tbody>
                    </table>
                    <div class="table-responsive mb-3">
                        <table class="table text-nowrap">
                            <thead class="table-light">
                                <tr><th class="w-75"><strong>Quick Terms to Know</strong></th></tr>
                            </thead>
                            <tbody>
                                <tr><td class="border-top-0"><i class="text-muted icon-sm" data-feather="minus"></i><strong>Fry:</strong> Baby fish just hatched from eggs.</td></tr>
                                <tr><td class="border-top-0"><i class="text-muted icon-sm" data-feather="minus"></i><strong>Fingerlings:</strong> Young fish ready to grow out.</td></tr>
                                <tr><td class="border-top-0"><i class="text-muted icon-sm" data-feather="minus"></i><strong>Grow-out:</strong> The stage when fish are raised to market size.</td></tr>
                                <tr><td class="border-top-0"><i class="text-muted icon-sm" data-feather="minus"></i><strong>Feed Conversion Ratio (FCR):</strong> How efficiently fish convert feed into body weight.</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p><a href="take_quiz.php?module_id=<?php echo $module_id; ?>" class="btn btn-info">Take Quiz</a></p>
                    <p>📝<strong>Up Next:</strong> Lesson 2 – <a href="lesson2.php">How to Set Up Your Fish Farm</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php include 'includes/footer2.php'; ?>