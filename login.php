<?php
session_start();
// Debug: Log session contents
file_put_contents('session_debug.txt', print_r($_SESSION, true));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="./templates/aqovo/images/gill-wise-logo.png" />
    <link href="./templates/dist/assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="./templates/dist/assets/libs/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="./templates/dist/assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="./templates/dist/assets/libs/prismjs/themes/prism-okaidia.css" rel="stylesheet">
    <link rel="stylesheet" href="./templates/dist/assets/css/theme.min.css">
    <title>Sign In | Gill-Wise-Academy</title>
</head>
<body class="bg-dark" style="background-image: url(./templates/aqovo/images/slides/slider-mainbg-008.jpg); background-position: center; 
  background-repeat: no-repeat;
  background-size: cover;">
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center g-0 min-vh-100">
            <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
                <div class="card smooth-shadow-md" style="background-color: rgba(0,0,0, 0.4);">
                    <div class="card-body p-6">
                        <div class="mb-4">
                            <a href="header-overlay.php"><img id="logo-img" height="100" width="140" class="img-fluid auto_size" src="./templates/aqovo/images/Gill-Wise logo (White)" alt="logo-img"></a>
                            <p class="mb-6 text-light">Please enter your user information.</p>
                        </div>
                        <form method="post" action="process_login.php">
                            <div class="mb-3">
                                <label for="username" class="form-label text-light">Username or Email</label>
                                <input type="text" id="username" class="form-control" name="username" placeholder="Enter username or email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label text-light">Password</label>
                                <input type="password" id="password" class="form-control" name="password" placeholder="**************" required>
                            </div>
                            <div class="d-lg-flex justify-content-between align-items-center mb-4">
                                <div class="form-check custom-checkbox text-light">
                                    <input type="checkbox" class="form-check-input" id="rememberme">
                                    <label class="form-check-label" for="rememberme">Remember me</label>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark-primary">Sign in</button>
                            </div>
                            <div class="d-md-flex justify-content-between mt-4">
                                <div class="mb-2 mb-md-0">
                                    <a href="register.php" class="fs-5 link-light">Create An Account</a>
                                </div>
                                <div>
                                    <a href="password.php" class="text-inherit fs-5 link-light">Forgot your password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo isset($_SESSION['error_message']) ? htmlspecialchars($_SESSION['error_message']) : 'Invalid username or email.'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="./templates/dist/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./templates/dist/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./templates/dist/assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="./templates/dist/assets/libs/feather-icons/dist/feather.min.js"></script>
    <script src="./templates/dist/assets/libs/prismjs/prism.js"></script>
    <script src="./templates/dist/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="./templates/dist/assets/libs/dropzone/dist/min/dropzone.min.js"></script>
    <script src="./templates/dist/assets/libs/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
    <script src="./templates/dist/assets/libs/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
    <script src="./templates/dist/assets/js/theme.min.js"></script>
    <script>
        $(document).ready(function() {
            <?php if (isset($_SESSION['error_message'])): ?>
                try {
                    console.log('Attempting to show error modal');
                    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'), { backdrop: 'static', keyboard: false });
                    errorModal.show();
                } catch (e) {
                    console.error('Error showing modal:', e);
                }
                <?php
                unset($_SESSION['error_message']);
                ?>
            <?php endif; ?>
        });
    </script>
</body>
</html>