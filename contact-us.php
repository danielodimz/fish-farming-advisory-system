<?php
session_start(); // Start session to store success/error messages

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fish_farm";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'address');
    $phone = filter_input(INPUT_POST, 'phone');
    $subject = filter_input(INPUT_POST, 'subject');
    $message = filter_input(INPUT_POST, 'message');

    try {
        $sql = "INSERT INTO requests (name, email, phone, subject, message, created_at) 
                VALUES (:name, :email, :phone, :subject, :message, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':subject' => $subject,
            ':message' => $message
        ]);
         $_SESSION['success'] = true;
        header("Location: contact-us.php"); // Redirect to clear POST
        exit();
        
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: contact-us.php"); // Redirect to clear POST
        exit();
    }
}

// Fetch all requests
try {
    $stmt = $conn->query("SELECT * FROM requests ORDER BY created_at DESC");
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
        $_SESSION['error'] = "Error fetching requests: " . $e->getMessage();
}
?>


<?php include 'includes/lp-header.php' ?>


<!-- page-title -->
<div class="ttm-page-title-row ttm-bg ttm-bgimage-yes ttm-bgcolor-darkgrey clearfix">
    <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="ttm-page-title-row-inner">
                    <div class="page-title-heading">
                        <h2 class="title">Contact Us</h2>
                    </div>
                    <div class="breadcrumb-wrapper">
                        <span>
                            <a title="Homepage" href="header-overlay.html">Home</a>
                        </span>
                        <span>Contact Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-title end -->


<!--site-main start-->
<div class="site-main">


    <!-- conatct-section -->
    <section class="ttm-row conatct-section ttm-bgcolor-grey clearfix">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title -->
                    <div class="section-title title-style-center_text">
                        <div class="title-header">
                            <h3>get in touch!</h3>
                            <h2 class="title">Have Questions? Drop Us Line!</h2>
                        </div>
                        <div class="title-desc">
                            <p>We take great pride in everything that we do, complete control over products allows us to ensure customers receive best service.</p>
                        </div>
                    </div><!-- section-title end -->
                </div>
            </div>
            <!-- row end -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="ttm-bgcolor-white p-40 padding_top35 border-rad_5 margin_top15">
                        <form id="request_qoute_form" class="request_qoute_form wrap-form clearfix" method="post" novalidate="novalidate">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="text-input"><input name="name" type="text" value="" placeholder="Your Name*" required="required"></span>
                                </div>
                                <div class="col-md-6">
                                    <span class="text-input"><input name="address" type="text" value="" placeholder="Your Email*" required="required"></span>
                                </div>
                                <div class="col-md-6">
                                    <span class="text-input"><input name="phone" type="text" value="" placeholder="Phone Number*" required="required"></span>
                                </div>
                                <div class="col-md-6">
                                    <span class="text-input"><input name="subject" type="text" value="" placeholder="Subject*" required="required"></span>
                                </div>
                                <div class="col-lg-12">
                                    <span class="text-input"><textarea name="message" rows="5" placeholder="Message" required="required"></textarea></span>
                                </div>
                                <div class="col-lg-12">
                                    <button class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-fill ttm-btn-color-skincolor w-100 margin_top5" type="submit">Send now!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ttm-bgcolor-white p-30 border-rad_5 margin_top15">
                        <!--featured-icon-box-->
                        <div class="featured-icon-box icon-align-top-content margin_top0 margin_bottom25">
                            <div class="featured-icon">
                                <div class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-size-lg">
                                    <i class="flaticon-email"></i>
                                </div>
                            </div>
                            <div class="featured-content pt-2">
                                <div class="featured-title">
                                    <h3 class="margin_bottom0 fs-20">Let’s Call or Email</h3>
                                </div>
                                <div class="featured-desc">danielodimz@gmail.com<br>+234 706 537 9188</div>
                            </div>
                        </div><!-- featured-icon-box end-->
                        <!--featured-icon-box-->
                        <div class="featured-icon-box icon-align-top-content margin_bottom25">
                            <div class="featured-icon">
                                <div class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-size-lg">
                                    <i class="flaticon-address"></i>
                                </div>
                            </div>
                            <div class="featured-content pt-2">
                                <div class="featured-title">
                                    <h3 class="margin_bottom0 fs-20">We Reached Here</h3>
                                </div>
                                <div class="featured-desc">Maraba-Akunza, Lafia, Nasarawa State, Nigeria.</div>
                            </div>
                        </div><!-- featured-icon-box end-->
                        <!--featured-icon-box-->
                        <div class="featured-icon-box icon-align-top-content margin_bottom10">
                            <div class="featured-icon">
                                <div class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                    <i class="themifyicon ti-themify-favicon"></i>
                                </div>
                            </div>
                            <div class="featured-content pt-2">
                                <div class="featured-title">
                                    <h3 class="margin_bottom0 fs-20">Chat on Online</h3>
                                </div>
                                <div class="featured-desc">danielodimz@gmail.com</div>
                            </div>
                        </div><!-- featured-icon-box end-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- conatct-section end -->
    <!--work-section-->
    <section class="ttm-row work-section ttm-bgcolor-grey clearfix">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- section title -->
                    <div class="section-title style2">
                        <div class="title-header">
                            <h3>QUESTIONS</h3>
                            <h2 class="title">Others have asked!</h2>
                        </div>

                    </div><!-- section title end -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <?php foreach ($requests as $request): ?>
                        <div class="accordion padding_top15 res-991-padding_top0">
                            <!-- toggle -->
                            <div class="toggle ttm-toggle_style_classic ttm-toggle-title-bgcolor-white">
                                <div class="toggle-title box-shadow"><a href="about-us-2.html#"><?php echo htmlspecialchars($request['message']); ?></a></div>
                                <div class="toggle-content">
                                    <p><strong>Name: </strong><?php echo htmlspecialchars($request['name']); ?></p>
                                    <p><strong>Email: </strong><?php echo htmlspecialchars($request['email']); ?></p>
                                    <p><strong>Subject: </strong><?php echo htmlspecialchars($request['subject']); ?></p>
                                    <p><strong>Date: </strong><?php echo htmlspecialchars($request['created_at']); ?></p>
                                </div>
                            </div><!-- toggle end -->
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </section>
    <!--work-section end-->

    <!-- Requests Table -->
    
</div>


<!--- conatact-section -->
<section class="ttm-row conatact-section mb_20 clearfix">
    <div class="container">
        <!-- row -->
        <div class="row ttm-boxes-spacing-30px">
            <div class="col-lg-4 ttm-box-col-wrapper">
                <div class="ttm_contact_widget_wrapper ttm-bgcolor-skincolor border-rad_5 ttm-textcolor-white">
                    <ul>
                        <!-- <li><h6>Venue</h6><span>James D.Mraff Nok Mall</span></li> -->
                        <li>
                            <h6>Address</h6><span>Maraba-Akunza, Lafia, Nasarawa State, Nigeria.</span>
                        </li>
                        <!-- <li><h6>Address 2</h6><span>1356 Broadway, New York NY 10018, Australia</span></li> -->
                    </ul>
                    <a class="ttm-btn btn-inline ttm-btn-size-sm ttm-btn-color-white" href="#fish-map"><u>Get A Directions!</u></a>
                </div>
            </div>
            <div class="col-lg-8 ttm-box-col-wrapper" id="fish-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d15785.037049014889!2d8.572745655984152!3d8.474151478596774!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sMararaba%2FAkunza%2C%20Lafia.!5e0!3m2!1sen!2sng!4v1753025387226!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6304.829986131271!2d-122.4746968033092!3d37.80374752160443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808586e6302615a1%3A0x86bd130251757c00!2sStorey+Ave%2C+San+Francisco%2C+CA+94129!5e0!3m2!1sen!2sus!4v1435826432051" width="740" height="405"></iframe> -->
            </div>
            <div class="col-md-6 col-sm-6 ttm-box-col-wrapper">
                <div class="ttm_single_image-wrapper border-rad_5">
                    <img class="img-fluid" src="./templates/aqovo/images/single-img-09.jpg" height="330" width="570" alt="single-09">
                </div>
            </div>
            <div class="col-md-6 col-sm-6 ttm-box-col-wrapper">
                <div class="ttm_single_image-wrapper border-rad_5">
                    <img class="img-fluid" src="./templates/aqovo/images/single-img-10.jpg" height="330" width="570" alt="single-10">
                </div>
            </div>
        </div><!-- row end -->
    </div>
</section>
<!-- conatact-section end -->


</div><!--site-main end-->


<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Your question has been submitted successfully!
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
 <?php echo isset($_SESSION['error']) ? htmlspecialchars($_SESSION['error']) : 'An error occurred while submitting your request.'; ?>            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
        <?php if (isset($_SESSION['success']) && $_SESSION['success']): ?>
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            <?php unset($_SESSION['success']); ?>
        <?php elseif (isset($_SESSION['error'])): ?>
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </script>


<?php include 'includes/lp-footer.php' ?>