<?php
include 'auth_check.php';
require '../includes/db.php';

// Fetch all users
$stmt = $db->query("SELECT id, username FROM users WHERE role = 'user' ORDER BY username");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all modules
$stmt = $db->query("SELECT id, title FROM modules ORDER BY title");
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch progress data
$stmt = $db->prepare("
    SELECT up.user_id, up.module_id, up.completed, up.progress_date, u.username, m.title
    FROM user_progress up
    JOIN users u ON up.user_id = u.id
    JOIN modules m ON up.module_id = m.id
    ORDER BY u.username, m.title
");
$stmt->execute();
$progress = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch quiz results
$stmt = $db->prepare("
    SELECT qr.user_id, qr.quiz_id, qr.score, q.module_id
    FROM quiz_results qr
    JOIN quizzes q ON qr.quiz_id = q.id
");
$stmt->execute();
$quiz_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organize quiz results by user_id and module_id
$quiz_scores = [];
foreach ($quiz_results as $result) {
    $quiz_scores[$result['user_id']][$result['module_id']] = $result['score'];
}

// Fetch certificate status
$stmt = $db->prepare("SELECT user_id, status FROM certificates");
$stmt->execute();
$certificates = $stmt->fetchAll(PDO::FETCH_ASSOC);
$certificate_status = [];
foreach ($certificates as $cert) {
    $certificate_status[$cert['user_id']] = $cert['status'];
}

// Filter by user or module (if provided)
$filter_user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;
$filter_module_id = isset($_GET['module_id']) ? (int)$_GET['module_id'] : 0;
$filtered_progress = $progress;
if ($filter_user_id) {
    $filtered_progress = array_filter($progress, function($p) use ($filter_user_id) {
        return $p['user_id'] == $filter_user_id;
    });
}
if ($filter_module_id) {
    $filtered_progress = array_filter($filtered_progress, function($p) use ($filter_module_id) {
        return $p['module_id'] == $filter_module_id;
    });
}
?>

<?php include 'includes/header2.php'; ?>

<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold">Track User Progress</h3>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-4 col-lg-4 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-1">Filters</h4>
                    <form method="get">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">User</label>
                            <select class="form-select" id="user_id" name="user_id">
                                <option value="">All Users</option>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?php echo $user['id']; ?>" <?php echo $filter_user_id == $user['id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($user['username']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="module_id" class="form-label">Module</label>
                            <select class="form-select" id="module_id" name="module_id">
                                <option value="">All Modules</option>
                                <?php foreach ($modules as $module): ?>
                                    <option value="<?php echo $module['id']; ?>" <?php echo $filter_module_id == $module['id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($module['title']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-12 col-12">
            <div class="card">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Progress Overview</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>User</th>
                                <th>Module</th>
                                <th>Status</th>
                                <th>Quiz Score</th>
                                <th>Certificate</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($filtered_progress as $p): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($p['username']); ?></td>
                                    <td><?php echo htmlspecialchars($p['title']); ?></td>
                                    <td>
                                        <?php if ($p['completed']): ?>
                                            <span class="badge bg-success">Completed</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">In Progress</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $score = isset($quiz_scores[$p['user_id']][$p['module_id']]) ? $quiz_scores[$p['user_id']][$p['module_id']] : 'N/A';
                                        echo htmlspecialchars($score);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $eligible = isset($quiz_scores[$p['user_id']]) && array_sum($quiz_scores[$p['user_id']]) / count($quiz_scores[$p['user_id']]) >= 70;
                                        echo isset($certificate_status[$p['user_id']]) ? htmlspecialchars($certificate_status[$p['user_id']]) : ($eligible ? 'Eligible' : 'Not Eligible');
                                        ?>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($p['progress_date'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($filtered_progress)): ?>
                                <tr><td colspan="6">No progress data available.</td></tr>
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