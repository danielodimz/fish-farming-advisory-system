<?php
session_start();

// Redirect if already logged in as admin
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header("Location: dashboard.php");
    exit();
}

require '../includes/db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    // Validation
    if (empty($username)) {
        $errors[] = 'Username is required.';
    } elseif (strlen($username) < 3 || strlen($username) > 50) {
        $errors[] = 'Username must be between 3 and 50 characters.';
    }

    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if (empty($password)) {
        $errors[] = 'Password is required.';
    } elseif (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters.';
    }

    if ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        // Check username uniqueness
        $stmt = $db->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $errors[] = 'That username is already taken.';
        }

        // Check email uniqueness
        if (empty($errors)) {
            $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errors[] = 'An account with that email already exists.';
            }
        }
    }

    if (empty($errors)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare(
            "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'admin')"
        );
        $stmt->execute([$username, $email, $hashed]);

        // Log the new admin in and send them straight to the dashboard
        $_SESSION['user_id']  = $db->lastInsertId();
        $_SESSION['username'] = $username;
        $_SESSION['role']     = 'admin';

        header("Location: dashboard.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../templates/aqovo/images/fish_farm_logo-removebg-preview.png" />
    <link href="../templates/dist/assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../templates/dist/assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../templates/dist/assets/css/theme.min.css">
    <title>Admin Registration | Odimz Farm</title>
</head>
<body class="bg-dark"
      style="background-image: url(../templates/aqovo/images/slides/slider-mainbg-african-002.jpg);
             background-position: center;
             background-repeat: no-repeat;
             background-size: cover;">

    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center g-0 min-vh-100">
            <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
                <div class="card smooth-shadow-md" style="background-color: rgba(0,0,0,0.4);">
                    <div class="card-body p-6">

                        <!-- Logo & title -->
                        <div class="mb-4">
                            <a href="../header-overlay.php">
                                <img class="img-fluid auto_size mb-2"
                                     src="../templates/aqovo/images/fish_farm_logo-removebg-preview.png"
                                     alt="Odimz Farm"
                                     style="height:90px; width:auto;">
                            </a>
                            <h4 class="text-light mb-1">Create Admin Account</h4>
                            <p class="text-light mb-0">Fill in the details below to register a new admin.</p>
                        </div>

                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger py-2">
                                <ul class="mb-0 ps-3">
                                    <?php foreach ($errors as $err): ?>
                                        <li><?php echo htmlspecialchars($err); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="register.php" novalidate>

                            <!-- Username -->
                            <div class="mb-3">
                                <label for="username" class="form-label text-light">Username</label>
                                <input type="text"
                                       id="username"
                                       name="username"
                                       class="form-control"
                                       placeholder="Enter a username"
                                       value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                                       required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label text-light">Email address</label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       class="form-control"
                                       placeholder="Enter email"
                                       value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                       required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label text-light">Password</label>
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="Min. 8 characters"
                                       required>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="confirm_password" class="form-label text-light">Confirm Password</label>
                                <input type="password"
                                       id="confirm_password"
                                       name="confirm_password"
                                       class="form-control"
                                       placeholder="Repeat password"
                                       required>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-dark-primary">Register Admin</button>
                            </div>

                            <div class="text-center">
                                <a href="../login.php" class="fs-5 link-light">Already have an account? Sign in</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../templates/dist/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../templates/dist/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../templates/dist/assets/libs/feather-icons/dist/feather.min.js"></script>
    <script src="../templates/dist/assets/js/theme.min.js"></script>
    <script>
        $(document).ready(function () {
            feather.replace();
        });
    </script>
</body>
</html>
