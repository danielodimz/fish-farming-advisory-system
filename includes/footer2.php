<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <p class="cpy-text m-6"><a href="header-overlay.php#" class="ttm-textcolor-skincolor font-weight-500"></a></p>
            <div>
                Copyright © 2025 <a href="header-overlay.php#" class="ttm-textcolor-skincolor font-weight-500">Odimz Farm</a> |
                <a href="about-us-2.php">About Us</a> |
                <a href="services-2.php">Services</a> |
                <a href="contact-us.php">Privacy</a>
            </div>
        </div>
    </div>
</footer>

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
        feather.replace();
        <?php if (isset($_SESSION['success_message'])): ?>
            try {
                var successModal = new bootstrap.Modal(document.getElementById('successModal'), { backdrop: 'static' });
                successModal.show();
                <?php unset($_SESSION['success_message']); ?>
            } catch (e) {
                console.error('Modal error:', e);
            }
        <?php endif; ?>
    });
</script>
</body>
</html>