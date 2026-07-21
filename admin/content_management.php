<?php
include 'auth_check.php';
require '../includes/db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        $_SESSION['error_message'] = 'Invalid CSRF token.';
        header("Location: content_management.php");
        exit;
    }

    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $supporting_materials = trim($_POST['materials'] ?? '');
    $module_id = (int)($_POST['module_id'] ?? 0);
    $image_url = null;

    // Validate inputs
    if (empty($title) || empty($content)) {
        $_SESSION['error_message'] = 'Title and content are required.';
        header("Location: content_management.php" . ($module_id ? "?edit=$module_id" : ""));
        exit;
    }

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $upload_dir = __DIR__ . '/uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $image_path = $upload_dir . $image_name;
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= 5 * 1024 * 1024) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                $image_url = $image_name; // store filename only
            } else {
                $_SESSION['error_message'] = 'Failed to upload image.';
                header("Location: content_management.php" . ($module_id ? "?edit=$module_id" : ""));
                exit;
            }
        } else {
            $_SESSION['error_message'] = 'Invalid image type or size (max 5MB).';
            header("Location: content_management.php" . ($module_id ? "?edit=$module_id" : ""));
            exit;
        }
    }

    if ($module_id) {
        // Update existing module
        $stmt = $db->prepare("UPDATE modules SET title = ?, content = ?, image_url = COALESCE(?, image_url), materials = ? WHERE id = ?");
        $stmt->execute([$title, $content, $image_url, $supporting_materials, $module_id]);
        $_SESSION['success_message'] = 'Module updated successfully.';
    } else {
        // Create new module
        $stmt = $db->prepare("INSERT INTO modules (title, content, image_url, materials) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $content, $image_url, $supporting_materials]);
        $_SESSION['success_message'] = 'Module created successfully.';
    }
    header("Location: content_management.php");
    exit;
}

// Handle delete request
if (isset($_GET['delete'])) {
    $module_id = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM modules WHERE id = ?");
    $stmt->execute([$module_id]);
    $_SESSION['success_message'] = 'Module deleted successfully.';
    header("Location: content_management.php");
    exit;
}

// Fetch module for editing
$edit_module = null;
if (isset($_GET['edit'])) {
    $module_id = (int)$_GET['edit'];
    $stmt = $db->prepare("SELECT * FROM modules WHERE id = ?");
    $stmt->execute([$module_id]);
    $edit_module = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Build the base URL for uploads dynamically
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
    . '://' . $_SERVER['HTTP_HOST']
    . rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/\\')
    . '/admin/uploads/';

// Generate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// Fetch all modules
$stmt = $db->query("SELECT * FROM modules");
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header2.php'; ?>

<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold">Manage Tutorial Modules</h3>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-4 col-lg-4 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-1"><?php echo $edit_module ? 'Edit Module' : 'Add New Module'; ?></h4>
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                        <input type="hidden" name="module_id" value="<?php echo $edit_module ? $edit_module['id'] : 0; ?>">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $edit_module ? htmlspecialchars($edit_module['title']) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="6" required><?php echo $edit_module ? htmlspecialchars($edit_module['content']) : ''; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image (Optional, max 5MB)</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <?php if ($edit_module && !empty($edit_module['image_url'])): ?>
                                <small>Current: <a href="<?php echo htmlspecialchars($base_url . basename($edit_module['image_url'])); ?>" target="_blank">View Image</a></small>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="supporting_materials" class="form-label">Supporting Materials (Optional)</label>
                            <textarea class="form-control" id="supporting_materials" name="materials" rows="3"><?php echo $edit_module ? htmlspecialchars($edit_module['materials']) : ''; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo $edit_module ? 'Update Module' : 'Add Module'; ?></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-12 col-12">
            <div class="card">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Module List</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($modules as $module): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($module['title']); ?></td>
                                    <td>
                                        <?php if (!empty($module['image_url'])): ?>
                                            <a href="<?php echo htmlspecialchars($base_url . basename($module['image_url'])); ?>" target="_blank">View</a>
                                        <?php else: ?>
                                            None
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="?edit=<?php echo $module['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="?delete=<?php echo $module['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this module?');">Delete</a>
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