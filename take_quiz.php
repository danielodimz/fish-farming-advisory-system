<?php
include 'includes/auth.php';
require 'includes/db.php';

// Get module_id from URL
$module_id = isset($_GET['module_id']) ? (int)$_GET['module_id'] : 0;
$user_id = $_SESSION['user_id'];

if (!$module_id) {
    $_SESSION['error_message'] = 'Invalid module ID.';
    header("Location: dashboard2.php");
    exit;
}

// Ensure user_progress entry exists
$stmt = $db->prepare("INSERT INTO user_progress (user_id, module_id, completed) VALUES (?, ?, 0) ON DUPLICATE KEY UPDATE user_id = user_id");
$stmt->execute([$user_id, $module_id]);

// Fetch quiz questions
$stmt = $db->prepare("SELECT id, question, option_a, option_b, option_c, option_d, correct_answer FROM quizzes WHERE module_id = ?");
$stmt->execute([$module_id]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if quiz exists
if (empty($questions)) {
    $_SESSION['error_message'] = 'No quiz found for this module.';
    header("Location: view_module.php?id=$module_id");
    exit;
}

// Process quiz submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        $_SESSION['error_message'] = 'Invalid CSRF token.';
        header("Location: take_quiz.php?module_id=$module_id");
        exit;
    }

    $score = 0;
    $total_questions = count($questions);

    foreach ($questions as $question) {
        $answer = $_POST['answer_' . $question['id']] ?? '';
        if ($answer && $answer === $question['correct_answer']) {
            $score++;
        }

        // Store quiz result
        $stmt = $db->prepare("INSERT INTO quiz_results (user_id, quiz_id, score) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE score = ?");
        $stmt->execute([$user_id, $question['id'], $answer === $question['correct_answer'] ? 100 : 0, $answer === $question['correct_answer'] ? 100 : 0]);
    }

    $percentage = ($score / $total_questions) * 100;

    // Update user progress
    $stmt = $db->prepare("UPDATE user_progress SET completed = 1 WHERE user_id = ? AND module_id = ?");
    $stmt->execute([$user_id, $module_id]);

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

    if ($progress['total_modules'] == $progress['completed_modules'] && $avg_score >= 70 && $video_progress['total_videos'] == $video_progress['viewed_videos']) {
        $stmt = $db->prepare("INSERT INTO certificates (user_id, status) VALUES (?, 'pending') ON DUPLICATE KEY UPDATE status = 'pending'");
        $stmt->execute([$user_id]);
    }

    $_SESSION['success_message'] = "Quiz submitted! Score: $score/$total_questions ($percentage%)";
    header("Location: view_module.php?id=$module_id");
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
                <h3 class="mb-0 fw-bold">Take Quiz: Module <?php echo $module_id; ?></h3>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                        <?php foreach ($questions as $index => $question): ?>
                            <div class="mb-4">
                                <h5><?php echo ($index + 1) . '. ' . htmlspecialchars($question['question']); ?></h5>
                                <?php
                                $options = [
                                    'A' => $question['option_a'],
                                    'B' => $question['option_b'],
                                    'C' => $question['option_c'],
                                    'D' => $question['option_d']
                                ];
                                ?>
                                <?php foreach ($options as $key => $option): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer_<?php echo $question['id']; ?>" value="<?php echo $key; ?>" required>
                                        <label class="form-check-label"><?php echo htmlspecialchars($option); ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-primary">Submit Quiz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php include 'includes/footer2.php'; ?>