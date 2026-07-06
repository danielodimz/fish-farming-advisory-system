<?php
header('Location: header-overlay.php');
// or die();
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Odimz Farm - Fish Farming Academy</title>
    <!-- Favicon-->
    <link rel="shortcut icon" href="templates/aqovo/images/fish_farm_logo-removebg-preview.png" />
    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="./templates/css/styles.css" rel="stylesheet" />
</head>
<body id="page-top">
    <!-- Navigation-->
    <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand"><a href="login.php">Login</a></li>
            <li class="sidebar-nav-item"><a href="#page-top">Home</a></li>
            <li class="sidebar-nav-item"><a href="#services">Services</a></li>
            <li class="sidebar-nav-item"><a href="#portfolio">Portfolio</a></li>
            <li class="sidebar-nav-item"><a href="#contact">Contact</a></li>
        </ul>
    </nav>
    <!-- Header-->
    <header class="masthead d-flex align-items-center">
        <div class="container px-4 px-lg-5 text-center">
            <!-- <h1 class="mb-1" style="text-shadow: -1px -1px 0 white, 1px -1px 0 white, -1px 1px 0 white, 1px 1px 0 white;">Welcome to Fish Farm Learn</h1> -->
            <h1 class="mb-3">Welcome to Fish Farm Learn</h1>
            <a class="btn btn-primary btn-xl" href="register.php">Start Learning</a>
            <!-- <p><a href="login.php">Login</a> or <a href="register.php">Register</a> to begin learning.</p> -->
        </div>
    </header>
    <!-- Services-->
    <section class="content-section bg-primary text-white text-center" id="services">
        <div class="container px-4 px-lg-5">
            <div class="content-section-heading">
                <h3 class="text-secondary mb-0">Services</h3>
                <h2 class="mb-5">What We Offer</h2>
                <h3 class="mb-5"><em>Learn modern, profitable, and sustainable fish farming techniques—from beginner basics to expert-level practices. Whether you're starting with a small tank or building a commercial fish farm, you're in the right place.</em></h3>
            </div>
            <div class="row gx-4 gx-lg-5">
                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                    <!-- <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-screen-smartphone"></i></span> -->
                    <h4><strong>📚 Online Tutorials</strong></h4>
                    <p class="text-faded mb-0">Step-by-step fish farming lessons, videos, and downloadable guides—designed for beginners and accessible anytime.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                    <!-- <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-pencil"></i></span> -->
                    <h4><strong>🧪 Farm Setup Guidance</strong></h4>
                    <p class="text-faded mb-0">Get expert advice on pond construction, tarpaulin setup, water quality management, and stocking fingerlings.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                    <!-- <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-like"></i></span> -->
                    <h4><strong>📊 Fish Farm Business Planning</strong></h4>
                    <p class="text-faded mb-0">We provide tools and templates for budgeting, feed tracking, profitability analysis, and scaling your business.</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <!-- <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-mustache"></i></span> -->
                    <h4><strong>💬 One-on-One Coaching</strong></h4>
                    <p class="text-faded mb-0">Need personalized help? Book a live WhatsApp consultation or video call with an experienced fish farmer.</p>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 mt-5">
                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                    <!-- <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-screen-smartphone"></i></span> -->
                    <h4><strong>🔥 Smoking & Processing Training</strong></h4>
                    <p class="text-faded mb-0">Learn how to properly process, smoke, package, and market catfish for local and export markets.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                    <!-- <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-pencil"></i></span> -->
                    <h4><strong>📦 Fingerling & Feed Sourcing Support</strong></h4>
                    <p class="text-faded mb-0">We connect you with trusted hatcheries and quality feed suppliers near you for a smooth startup.</p>
                </div>

            </div>
        </div>
    </section>
    <!-- Portfolio-->
    <section class="content-section" id="portfolio">
        <div class="container px-4 px-lg-5">
            <div class="content-section-heading text-center">
                <h3 class="text-secondary mb-0">Portfolio</h3>
                <h2 class="mb-5">Recent Projects</h2>
            </div>
            <div class="row gx-0">
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#!">
                        <div class="caption">
                            <div class="caption-content">
                                <div class="h2">🐟 Backyard Fish Farm Setup</div>
                                <p class="mb-0"><span>Location:</span> Lokoja, Kogi State
                                    Date: March 2025
                                    Set up 2 tarpaulin tanks and stocked 300 fingerlings. Guided client on feeding & water management.</p>
                            </div>
                        </div>
                        <img class="img-fluid" src="./templates/assets/img/two-grey-fish.jpg" alt="..." />
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#!">
                        <div class="caption">
                            <div class="caption-content">
                                <div class="h2">🎥 Beginner Video Tutorial Series</div>
                                <p class="mb-0">Released: April 2025
                                    Launched 5 video lessons covering everything from setup to harvesting. Over 120 learners.</p>
                            </div>
                        </div>
                        <img class="img-fluid" src="./templates/assets/img/background-raw-fish.jpg" alt="..." />
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#!">
                        <div class="caption">
                            <div class="caption-content">
                                <div class="h2">🔥 Smoking Catfish Class</div>
                                <p class="mb-0">Format: WhatsApp training
                                    Date: May 2025
                                    Trained 22 farmers on cutting, brining, smoking & packaging smoked catfish.
                                </p>
                            </div>
                        </div>
                        <img class="img-fluid" src="./templates/assets/img/background-raw-fish.jpg" alt="..." />
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#!">
                        <div class="caption">
                            <div class="caption-content">
                                <div class="h2">📘 Fish Farming Business Plan Toolkit</div>
                                <p class="mb-0">Released: June 2025
                                    Free PDF & Excel files to help farmers budget and plan their operations. 500+ downloads!</p>
                            </div>
                        </div>
                        <img class="img-fluid" src="./templates/assets/img/two-grey-fish.jpg" alt="..." />
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Call to Action-->
    <section class="content-section bg-primary text-white">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="mb-4">Jump back in or Get started below.</h2>
            <a class="btn btn-xl btn-light me-4" href="login.php">Login!</a>
            <a class="btn btn-xl btn-dark" href="register.php">Register!</a>
        </div>
    </section>
    <!-- Map-->
    <div class="map" id="contact">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126093.78244268634!2d7.367464754040914!3d9.024416368935379!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e745f4cd62fd9%3A0x53bd17b4a20ea12b!2sAbuja%2C%20Federal%20Capital%20Territory!5e0!3m2!1sen!2sng!4v1746718641812!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container px-4 px-lg-5">
            <ul class="list-inline mb-5">
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" target="_blank" href="https:\\facebook.com"><i class="icon-social-facebook"></i></a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" target="_blank" href="https://wa.me/+2347065379188">
                        <h1>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                            </svg>
                        </h1>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" target="_blank" href="https:\\x.com"><i class="icon-social-twitter"></i></a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white" target="_blank" href="https:\\github.com"><i class="icon-social-github"></i></a>
                </li>
            </ul>
            <p class="text-muted small mb-0">Copyright &copy; 2025</p>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="./templates/js/scripts.js"></script>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</body>
</html>