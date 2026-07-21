<?php
include 'includes/auth.php';
require 'includes/db.php';

$module_id = isset($_GET['module_id']) ? (int)$_GET['module_id'] : 0;
$user_id   = $_SESSION['user_id'];

if (!$module_id) {
    header("Location: dashboard2.php");
    exit;
}

// Fetch module title
$stmt = $db->prepare("SELECT id, title FROM modules WHERE id = ?");
$stmt->execute([$module_id]);
$module = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$module) {
    header("Location: dashboard2.php");
    exit;
}

// Fetch all quiz questions for this module
$stmt = $db->prepare("SELECT id, question, option_a, option_b, option_c, option_d, correct_answer FROM quizzes WHERE module_id = ?");
$stmt->execute([$module_id]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($questions)) {
    header("Location: view_module.php?id=$module_id");
    exit;
}

// Check if this is a fresh submission (feedback in session) or a returning visit (load from DB)
$feedback = null;

if (isset($_SESSION['quiz_feedback']) && $_SESSION['quiz_feedback']['module_id'] == $module_id) {
    $feedback = $_SESSION['quiz_feedback'];
    unset($_SESSION['quiz_feedback']); // consume it
} else {
    // Returning visit — rebuild feedback from DB results
    $quiz_ids     = array_column($questions, 'id');
    $placeholders = implode(',', array_fill(0, count($quiz_ids), '?'));
    $stmt = $db->prepare("SELECT quiz_id, score FROM quiz_results WHERE user_id = ? AND quiz_id IN ($placeholders)");
    $stmt->execute(array_merge([$user_id], $quiz_ids));
    $db_results = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); // quiz_id => score

    if (empty($db_results)) {
        // No result yet — redirect to take quiz
        header("Location: take_quiz.php?module_id=$module_id");
        exit;
    }

    $score = 0;
    foreach ($db_results as $qid => $s) {
        if ($s == 100) $score++;
    }
    $total = count($questions);

    $feedback = [
        'module_id'    => $module_id,
        'score'        => $score,
        'total'        => $total,
        'percentage'   => round(($score / $total) * 100),
        'user_answers' => [], // not available on returning visit
        'questions'    => $questions,
        'db_results'   => $db_results, // quiz_id => 100|0
    ];
}

$pass       = $feedback['percentage'] >= 50;
$questions  = $feedback['questions'];
$user_ans   = $feedback['user_answers'] ?? [];
$db_results = $feedback['db_results'] ?? [];

include 'includes/header2.php';
?>

<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4 d-flex align-items-center justify-content-between">
                <h3 class="mb-0 fw-bold">Quiz Result — <?php echo htmlspecialchars($module['title']); ?></h3>
                <a href="view_module.php?id=<?php echo $module_id; ?>" class="btn btn-secondary btn-sm">Back to Module</a>
            </div>
        </div>
    </div>

    <!-- Score summary card -->
    <div class="row mb-4">
        <div class="col-xl-4 col-lg-5 col-md-8 col-12 mx-auto">
            <div class="card text-center border-0 shadow-sm <?php echo $pass ? 'border-success' : 'border-danger'; ?>">
                <div class="card-body py-5">
                    <?php if ($pass): ?>
                        <div class="mb-3">
                            <span class="display-3">🎉</span>
                        </div>
                        <h2 class="fw-bold text-success">Congratulations!</h2>
                        <p class="text-muted mb-3">You passed the quiz.</p>
                    <?php else: ?>
                        <div class="mb-3">
                            <span class="display-3">📚</span>
                        </div>
                        <h2 class="fw-bold text-danger">Keep Studying!</h2>
                        <p class="text-muted mb-3">You didn't pass this time. Review the module and try again next time.</p>
                    <?php endif; ?>

                    <div class="display-4 fw-bold <?php echo $pass ? 'text-success' : 'text-danger'; ?>">
                        <?php echo $feedback['percentage']; ?>%
                    </div>
                    <p class="mt-2 text-muted">
                        You scored <strong><?php echo $feedback['score']; ?></strong> out of <strong><?php echo $feedback['total']; ?></strong>
                    </p>

                    <!-- Progress bar -->
                    <div class="progress mt-3" style="height:12px;">
                        <div class="progress-bar <?php echo $pass ? 'bg-success' : 'bg-danger'; ?>"
                             role="progressbar"
                             style="width: <?php echo $feedback['percentage']; ?>%;"
                             aria-valuenow="<?php echo $feedback['percentage']; ?>"
                             aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <small class="text-muted mt-1 d-block">Pass mark: 50%</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Per-question feedback -->
    <div class="row mb-8">
        <div class="col-xl-8 col-lg-10 col-12 mx-auto">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Question Review</h5>
                </div>
                <div class="card-body">
                    <?php foreach ($questions as $index => $q):
                        $qid = $q['id'];
                        $correct = strtoupper($q['correct_answer']);

                        // Determine if user got it right
                        if (!empty($user_ans) && isset($user_ans[$qid])) {
                            // Fresh submission — we have the exact answer
                            $given   = strtoupper($user_ans[$qid]);
                            $is_correct = ($given === $correct);
                        } elseif (!empty($db_results) && isset($db_results[$qid])) {
                            // Returning visit — only know right/wrong, not the chosen option
                            $is_correct = ($db_results[$qid] == 100);
                            $given   = null;
                        } else {
                            $is_correct = false;
                            $given   = null;
                        }

                        $options = [
                            'A' => $q['option_a'],
                            'B' => $q['option_b'],
                            'C' => $q['option_c'],
                            'D' => $q['option_d'],
                        ];
                    ?>
                    <div class="mb-4 p-3 rounded <?php echo $is_correct ? 'bg-success' : 'bg-danger'; ?>">
                        <div class="d-flex align-items-start gap-2 mb-2">
                            <span class="badge bg-white <?php echo $is_correct ? 'text-success' : 'text-danger'; ?> mt-1">
                                <?php echo $is_correct ? '✓' : '✗'; ?>
                            </span>
                            <h6 class="mb-0 text-white"><?php echo ($index + 1) . '. ' . htmlspecialchars($q['question']); ?></h6>
                        </div>
                        <ul class="list-unstyled ms-4 mb-0">
                            <?php foreach ($options as $key => $text): ?>
                                <?php
                                    $is_this_correct  = ($key === $correct);
                                    $is_this_chosen   = ($given !== null && $key === $given);
                                    $badge = '';

                                    if ($is_this_correct && $is_this_chosen) {
                                        $badge = ' <span class="badge bg-white text-success ms-1">Your Answer ✓</span>';
                                    } elseif ($is_this_correct) {
                                        $badge = ' <span class="badge bg-white text-success ms-1">Correct Answer</span>';
                                    } elseif ($is_this_chosen) {
                                        $badge = ' <span class="badge bg-white text-danger ms-1">Your Answer ✗</span>';
                                    }
                                ?>
                                <li class="py-1 text-white <?php echo ($is_this_chosen && !$is_this_correct) ? 'text-decoration-line-through opacity-75' : ''; ?>">
                                    <strong><?php echo $key; ?>.</strong>
                                    <?php echo htmlspecialchars($text); ?>
                                    <?php echo $badge; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php if ($given === null && !$is_correct): ?>
                            <small class="ms-4 text-white opacity-75">Correct answer: <strong><?php echo $correct . '. ' . htmlspecialchars($options[$correct]); ?></strong></small>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mt-4 d-flex gap-3">
                <a href="view_module.php?id=<?php echo $module_id; ?>" class="btn btn-primary">Back to Module</a>
                <a href="dashboard2.php" class="btn btn-secondary">Go to Dashboard</a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer2.php'; ?>
