<?php
include 'includes/auth.php';
require 'includes/db.php';

// All redirects must happen before any HTML output
if (!isset($_GET['id'])) {
    $_SESSION['error_message'] = 'No module selected.';
    header("Location: dashboard2.php");
    exit;
}

$module_id = (int)$_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch module — select columns explicitly to match actual DB schema
$stmt = $db->prepare("SELECT id, title, content, image_url, materials FROM modules WHERE id = ?");
$stmt->execute([$module_id]);
$module = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$module) {
    $_SESSION['error_message'] = 'Module not found.';
    header("Location: dashboard2.php");
    exit;
}

// Start progress if not exists
$stmt = $db->prepare("INSERT IGNORE INTO user_progress (user_id, module_id) VALUES (?, ?)");
$stmt->execute([$user_id, $module_id]);

// Check if quiz is available
$stmt = $db->prepare("SELECT id FROM quizzes WHERE module_id = ?");
$stmt->execute([$module_id]);
$quiz = $stmt->fetch(PDO::FETCH_ASSOC);

// All data ready — now safe to output HTML
include 'includes/header2.php';
?>

<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold">Tutorial Module</h3>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-3 col-lg-4 col-md-12 col-12">
            <div class="mb-4 mb-lg-0">
                <h4 class="mb-1"><?php echo htmlspecialchars($module['title']); ?></h4>
                <p class="mb-0 fs-5 text-muted">Module Content</p>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <?php if (!empty($module['image_url'])): ?>
                        <img src="<?php echo htmlspecialchars($module['image_url']); ?>" class="img-fluid mb-4" alt="<?php echo htmlspecialchars($module['title']); ?>">
                    <?php else: ?>
                        <img src="templates/aqovo/images/default-module.png" class="img-fluid mb-4" alt="Default Module">
                    <?php endif; ?>
                    <div class="mb-4">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?php echo nl2br(htmlspecialchars($module['content'] ?? 'No content available.')); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    <?php if (!empty($module['materials'])): ?>
                        <p><strong>Resources:</strong> <?php echo htmlspecialchars($module['materials']); ?></p>
                    <?php endif; ?>
                    <?php if ($quiz): ?>
                        <p><a href="take_quiz.php?module_id=<?php echo $module_id; ?>" class="btn btn-info">Take Quiz</a></p>
                    <?php endif; ?>
                    <p><a href="dashboard2.php" class="btn btn-secondary">Back to Dashboard</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php include 'includes/footer2.php'; ?>