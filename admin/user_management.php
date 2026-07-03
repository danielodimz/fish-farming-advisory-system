<?php
include 'auth_check.php';
require '../includes/db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        $_SESSION['error_message'] = 'Invalid CSRF token.';
        header("Location: user_management.php");
        exit;
    }

    $user_id = (int)($_POST['user_id'] ?? 0);
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $role = trim($_POST['role'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validate inputs
    if (empty($user_id) || empty($username) || empty($email) || empty($role)) {
        $_SESSION['error_message'] = 'Username, email, and role are required.';
        header("Location: user_management.php?edit=$user_id");
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = 'Invalid email format.';
        header("Location: user_management.php?edit=$user_id");
        exit;
    }

    // Validate role
    $valid_roles = ['user', 'admin'];
    if (!in_array($role, $valid_roles)) {
        $_SESSION['error_message'] = 'Invalid role selected.';
        header("Location: user_management.php?edit=$user_id");
        exit;
    }

    // Check if username or email already exists (excluding current user)
    $stmt = $db->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?");
    $stmt->execute([$username, $email, $user_id]);
    if ($stmt->fetch()) {
        $_SESSION['error_message'] = 'Username or email already exists.';
        header("Location: user_management.php?edit=$user_id");
        exit;
    }

    // Update user
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("UPDATE users SET username = ?, email = ?, role = ?, password = ? WHERE id = ?");
        $stmt->execute([$username, $email, $role, $hashed_password, $user_id]);
    } else {
        $stmt = $db->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
        $stmt->execute([$username, $email, $role, $user_id]);
    }
    $_SESSION['success_message'] = 'User updated successfully.';
    header("Location: user_management.php");
    exit;
}

// Handle delete request
if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    if ($delete_id === $_SESSION['user_id']) {
        $_SESSION['error_message'] = 'You cannot delete your own account.';
        header("Location: user_management.php");
        exit;
    }
    $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$delete_id]);
    $_SESSION['success_message'] = 'User deleted successfully.';
    header("Location: user_management.php");
    exit;
}

// Fetch user for editing
$edit_user = null;
if (isset($_GET['edit'])) {
    $user_id = (int)$_GET['edit'];
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $edit_user = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Generate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// Fetch all users
$stmt = $db->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header2.php'; ?>

<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold">Manage Users</h3>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-4 col-lg-4 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-1"><?php echo $edit_user ? 'Edit User' : 'View User'; ?></h4>
                    <?php if ($edit_user): ?>
                        <form method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                            <input type="hidden" name="user_id" value="<?php echo $edit_user['id']; ?>">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($edit_user['username']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($edit_user['email']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="user" <?php echo $edit_user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                                    <option value="admin" <?php echo $edit_user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password (Optional)</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
                            </div>
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </form>
                    <?php else: ?>
                        <p>Select a user from the list to edit their details.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-12 col-12">
            <div class="card">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">User List</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined</th>
                                <th>Actions</th>
                                <th>Modules Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                                    <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                                    <td>
                                        <a href="?edit=<?php echo $user['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <?php if ($user['id'] !== $_SESSION['user_id']): ?>
                                            <a href="?delete=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $stmt = $db->prepare("SELECT COUNT(*) FROM user_progress WHERE user_id = ? AND completed = 1");
                                        $stmt->execute([$user['id']]);
                                        $completed = $stmt->fetchColumn();
                                        echo "<td>$completed</td>";
                                        ?>
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