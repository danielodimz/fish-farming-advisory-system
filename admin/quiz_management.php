<?php
include 'auth_check.php';
require '../includes/db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        $_SESSION['error_message'] = 'Invalid CSRF token.';
        header("Location: quiz_management.php");
        exit;
    }

    $module_id = (int)($_POST['module_id'] ?? 0);
    $question = trim($_POST['question'] ?? '');
    $option_a = trim($_POST['option_a'] ?? '');
    $option_b = trim($_POST['option_b'] ?? '');
    $option_c = trim($_POST['option_c'] ?? '');
    $option_d = trim($_POST['option_d'] ?? '');
    $correct_answer = trim($_POST['correct_answer'] ?? '');
    $quiz_id = (int)($_POST['quiz_id'] ?? 0);

    // Validate inputs
    if (empty($module_id) || empty($question) || empty($option_a) || empty($option_b) || empty($option_c) || empty($option_d) || empty($correct_answer)) {
        $_SESSION['error_message'] = 'All fields are required.';
        header("Location: quiz_management.php" . ($quiz_id ? "?edit=$quiz_id" : ""));
        exit;
    }

    // Validate correct_answer
    $valid_answers = ['A', 'B', 'C', 'D'];
    if (!in_array($correct_answer, $valid_answers)) {
        $_SESSION['error_message'] = 'Correct answer must be A, B, C, or D.';
        header("Location: quiz_management.php" . ($quiz_id ? "?edit=$quiz_id" : ""));
        exit;
    }

    // Validate module_id exists
    $stmt = $db->prepare("SELECT id FROM modules WHERE id = ?");
    $stmt->execute([$module_id]);
    if (!$stmt->fetch()) {
        $_SESSION['error_message'] = 'Invalid module selected.';
        header("Location: quiz_management.php" . ($quiz_id ? "?edit=$quiz_id" : ""));
        exit;
    }

    if ($quiz_id) {
        // Update existing quiz
        $stmt = $db->prepare("UPDATE quizzes SET module_id = ?, question = ?, option_a = ?, option_b = ?, option_c = ?, option_d = ?, correct_answer = ? WHERE id = ?");
        $stmt->execute([$module_id, $question, $option_a, $option_b, $option_c, $option_d, $correct_answer, $quiz_id]);
        $_SESSION['success_message'] = 'Quiz updated successfully.';
    } else {
        // Create new quiz
        $stmt = $db->prepare("INSERT INTO quizzes (module_id, question, option_a, option_b, option_c, option_d, correct_answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$module_id, $question, $option_a, $option_b, $option_c, $option_d, $correct_answer]);
        $_SESSION['success_message'] = 'Quiz created successfully.';
    }
    header("Location: quiz_management.php");
    exit;
}

// Handle delete request
if (isset($_GET['delete'])) {
    $quiz_id = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM quizzes WHERE id = ?");
    $stmt->execute([$quiz_id]);
    $_SESSION['success_message'] = 'Quiz deleted successfully.';
    header("Location: quiz_management.php");
    exit;
}

// Fetch quiz for editing
$edit_quiz = null;
if (isset($_GET['edit'])) {
    $quiz_id = (int)$_GET['edit'];
    $stmt = $db->prepare("SELECT * FROM quizzes WHERE id = ?");
    $stmt->execute([$quiz_id]);
    $edit_quiz = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Generate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// Fetch all quizzes with module titles
$stmt = $db->query("SELECT q.*, m.title AS module_title FROM quizzes q LEFT JOIN modules m ON q.module_id = m.id");
$quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all modules for dropdown
$stmt = $db->query("SELECT id, title FROM modules");
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header2.php'; ?>

<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold">Manage Quizzes</h3>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-4 col-lg-4 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-1"><?php echo $edit_quiz ? 'Edit Quiz' : 'Add New Quiz'; ?></h4>
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                        <input type="hidden" name="quiz_id" value="<?php echo $edit_quiz ? $edit_quiz['id'] : 0; ?>">
                        <div class="mb-3">
                            <label for="module_id" class="form-label">Module</label>
                            <select class="form-select" id="module_id" name="module_id" required>
                                <option value="">Select a module</option>
                                <?php foreach ($modules as $module): ?>
                                    <option value="<?php echo $module['id']; ?>" <?php echo $edit_quiz && $edit_quiz['module_id'] == $module['id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($module['title']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" class="form-control" id="question" name="question" value="<?php echo $edit_quiz ? htmlspecialchars($edit_quiz['question']) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="option_a" class="form-label">Option A</label>
                            <input type="text" class="form-control" id="option_a" name="option_a" value="<?php echo $edit_quiz ? htmlspecialchars($edit_quiz['option_a']) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="option_b" class="form-label">Option B</label>
                            <input type="text" class="form-control" id="option_b" name="option_b" value="<?php echo $edit_quiz ? htmlspecialchars($edit_quiz['option_b']) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="option_c" class="form-label">Option C</label>
                            <input type="text" class="form-control" id="option_c" name="option_c" value="<?php echo $edit_quiz ? htmlspecialchars($edit_quiz['option_c']) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="option_d" class="form-label">Option D</label>
                            <input type="text" class="form-control" id="option_d" name="option_d" value="<?php echo $edit_quiz ? htmlspecialchars($edit_quiz['option_d']) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="correct_answer" class="form-label">Correct Answer</label>
                            <select class="form-select" id="correct_answer" name="correct_answer" required>
                                <option value="">Select correct answer</option>
                                <option value="A" <?php echo $edit_quiz && $edit_quiz['correct_answer'] == 'A' ? 'selected' : ''; ?>>A</option>
                                <option value="B" <?php echo $edit_quiz && $edit_quiz['correct_answer'] == 'B' ? 'selected' : ''; ?>>B</option>
                                <option value="C" <?php echo $edit_quiz && $edit_quiz['correct_answer'] == 'C' ? 'selected' : ''; ?>>C</option>
                                <option value="D" <?php echo $edit_quiz && $edit_quiz['correct_answer'] == 'D' ? 'selected' : ''; ?>>D</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo $edit_quiz ? 'Update Quiz' : 'Add Quiz'; ?></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-12 col-12">
            <div class="card">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Quiz List</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Module</th>
                                <th>Question</th>
                                <th>Correct Answer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($quizzes as $quiz): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($quiz['module_title'] ?? 'Unknown Module'); ?></td>
                                    <td><?php echo htmlspecialchars($quiz['question']); ?></td>
                                    <td><?php echo htmlspecialchars($quiz['correct_answer']); ?></td>
                                    <td>
                                        <a href="?edit=<?php echo $quiz['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="?delete=<?php echo $quiz['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this quiz?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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