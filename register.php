<?php session_start(); ?>

<!-- <form method="post" action="process_register.php">
    <h2>Register</h2>
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
</form> -->

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



<!-- Favicon icon-->
<link rel="shortcut icon" href="./templates/aqovo/images/gill-wise-logo.png" />

<!-- Libs CSS -->


<link href="./templates/dist/assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="./templates/dist/assets/libs/dropzone/dist/dropzone.css"  rel="stylesheet">
<link href="./templates/dist/assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" />
<link href="./templates/dist/assets/libs/prismjs/themes/prism-okaidia.css" rel="stylesheet">








<!-- Theme CSS -->
<link rel="stylesheet" href="./templates/dist/assets/css/theme.min.css">
  <title>Sign Up | Gill-Wise-Academy</title>
</head>

<body class="bg-dark" style="background-image: url(./templates/aqovo/images/slides/slider-mainbg-008.jpg); background-position: center; 
  background-repeat: no-repeat;
  background-size: cover;">
  <!-- container -->
  <div class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0
        min-vh-100">
      <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
        <!-- Card -->
        <div class="card smooth-shadow-md" style="background-color: rgba(0,0,0, 0.4);">
          <!-- Card body -->
          <div class="card-body p-6">
            <div class="mb-4">
            <a href="header-overlay.php"><img id="logo-img" height="100" width="140" class="img-fluid auto_size" src="./templates/aqovo/images/Gill-Wise logo (White)" alt="logo-img"></a>
              <p class="mb-6 text-light">Please enter your user information.</p>

            </div>
            <!-- Form -->
            <form method="post" action="process_register.php">
              <!-- Username -->
              <div class="mb-3">
                <label for="username" class="form-label text-light">Username</label>
                <input type="text" id="username" class="form-control" name="username" placeholder="Username" required="">
              </div>
              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label text-light">Email</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Email address here" required="">
              </div>
              <!-- Password -->
              <div class="mb-3">
                <label for="password" class="form-label text-light">Password</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="**************" required="">
              </div>
              <!-- Checkbox -->
              <div class="mb-3">
                <div class="form-check custom-checkbox">
                  <input type="checkbox" class="form-check-input" id="agreeCheck">
                  <label class="form-check-label" for="agreeCheck"><span
                        class="fs-5 text-light">I agree to the <a class="link-light"
                          href="terms-condition-page.html">Terms of
                          Service </a>and
                        <a href="terms-condition-page.html" class="link-light">Privacy Policy.</a></span></label>
                </div>
              </div>
              <div>
                <!-- Button -->
                <div class="d-grid">
                  <button type="submit" class="btn btn-dark-primary">
                    Create Free Account
                  </button>
                </div>

                <div class="d-md-flex justify-content-between mt-4">
                  <div class="mb-2 mb-md-0">
                    <a href="login.php" class="fs-5 link-light">Already
                        member? Login </a>
                  </div>
                  <div>
                    <a href="password.php" class="text-inherit
                        fs-5 link-light">Forgot your password?</a>
                  </div>

                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo isset($_SESSION['success_message']) ? htmlspecialchars($_SESSION['success_message']) : 'Registration successful!'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
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
                    <?php echo isset($_SESSION['error_message']) ? htmlspecialchars($_SESSION['error_message']) : 'Registration failed. Please try again.'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

  <!-- Scripts -->
  <!-- Libs JS -->
<script src="./templates/dist/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="./templates/dist/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="./templates/dist/assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="./templates/dist/assets/libs/feather-icons/dist/feather.min.js"></script>
<script src="./templates/dist/assets/libs/prismjs/prism.js"></script>
<script src="./templates/dist/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="./templates/dist/assets/libs/dropzone/dist/min/dropzone.min.js"></script>
<script src="./templates/dist/assets/libs/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
<script src="./templates/dist/assets/libs/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
<!-- Theme JS -->
<script src="./templates/dist/assets/js/theme.min.js"></script>
<script>
        $(document).ready(function() {
            <?php
            if (isset($_SESSION['success_message'])) {
                echo "try {";
                echo "var successModal = new bootstrap.Modal(document.getElementById('successModal'), { backdrop: 'static' });";
                echo "successModal.show();";
                echo "} catch (e) { console.error('Modal error:', e); }";
                unset($_SESSION['success_message']);
            }
            if (isset($_SESSION['error_message'])) {
                echo "try {";
                echo "var errorModal = new bootstrap.Modal(document.getElementById('errorModal'), { backdrop: 'static' });";
                echo "errorModal.show();";
                echo "} catch (e) { console.error('Modal error:', e); }";
                unset($_SESSION['error_message']);
            }
            ?>
        });
    </script>
</body>

</html>

      