<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon icon-->
    <link rel="shortcut icon" href="./templates/aqovo/images/fish_farm_logo-removebg-preview.png" />
    <!-- Libs CSS -->
    <link href="./templates/dist/assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="./templates/dist/assets/libs/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="./templates/dist/assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="./templates/dist/assets/libs/prismjs/themes/prism-okaidia.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="./templates/dist/assets/css/theme.min.css">
    <title>Odimz Farm &#8211; Academy &amp; Fishery Services</title>
</head>
<body class="bg-light">
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <!-- Sidebar -->
        <nav class="navbar-vertical navbar">
            <div class="nav-scroller">
                <!-- Brand logo -->
                <a class="navbar-brand" href="header-overlay.php">
                    <img id="footer-logo-img" class="img-fluid auto_size" style="height:55px; width:auto;" src="./templates/aqovo/images/fish_farm_logo-removebg-preview.png" alt="Odimz Farm">
                </a>
                <!-- Navbar nav -->
                <ul class="navbar-nav flex-column" id="sideNavbar">
                    <li class="nav-item">
                        <a class="nav-link has-arrow active" href="dashboard2.php">
                            <i data-feather="home" class="nav-icon icon-xs me-2"></i> Dashboard
                        </a>
                    </li>
                    <!-- Nav item -->
                    <li class="nav-item">
                        <div class="navbar-heading">Learn</div>
                    </li>
                    <!-- Nav item: Tutorial Modules -->
                    <li class="nav-item">
                        <a class="nav-link has-arrow collapsed" href="#!" data-bs-toggle="collapse"
                            data-bs-target="#navModules" aria-expanded="false" aria-controls="navModules">
                            <i data-feather="book" class="nav-icon icon-xs me-2"></i> Tutorial Modules
                        </a>
                        <div id="navModules" class="collapse" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <?php
                                require 'includes/db.php';
                                $stmt = $db->query("SELECT id, title FROM modules");
                                $nav_modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($nav_modules as $nav_mod) {
                                    echo '<li class="nav-item"><a class="nav-link" href="view_module.php?id=' . $nav_mod['id'] . '">' . htmlspecialchars($nav_mod['title']) . '</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <!-- Nav item: Lessons -->
                    <li class="nav-item">
                        <a class="nav-link has-arrow collapsed" href="#!" data-bs-toggle="collapse"
                            data-bs-target="#navPages" aria-expanded="false" aria-controls="navPages">
                            <i data-feather="layers" class="nav-icon icon-xs me-2"></i> Lessons
                        </a>
                        <div id="navPages" class="collapse" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item"><a class="nav-link" href="lesson1.php">Lesson 1</a></li>
                                <li class="nav-item"><a class="nav-link" href="lesson2.php">Lesson 2</a></li>
                                <li class="nav-item"><a class="nav-link" href="lesson3.php">Lesson 3</a></li>
                                <li class="nav-item"><a class="nav-link" href="lesson4.php">Lesson 4</a></li>
                                <li class="nav-item"><a class="nav-link" href="lesson5.php">Lesson 5</a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- Nav item: Video Lessons -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="videos.php">
                            <i data-feather="layers" class="nav-icon icon-xs me-2"></i> Video Lessons
                        </a>
                       
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="videos.php?category=backyard">
                            <i data-feather="video" class="nav-icon icon-xs me-2"></i> Backyard Farming Videos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="videos.php?category=catfish">
                            <i data-feather="video" class="nav-icon icon-xs me-2"></i> Catfish Farming Videos
                        </a>
                    </li>
                    <!-- Nav item: Certificate -->
                    <li class="nav-item">
                        <a class="nav-link" href="certificate.php">
                            <i data-feather="award" class="nav-icon icon-xs me-2"></i> Certificate
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="test.php">
                            <i data-feather="sidebar" class="nav-icon icon-xs me-2"></i> Test
                        </a>
                    </li>
                    <!-- Nav item -->
                    <li class="nav-item">
                        <div class="navbar-heading">Tools</div>
                    </li>
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link has-arrow" href="blog.php">
                            <i data-feather="package" class="nav-icon icon-xs me-2"></i> Blog
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link has-arrow" href="downloads.php">
                            <i data-feather="corner-left-down" class="nav-icon icon-xs me-2"></i> Downloads & Resources
                        </a>
                    </li>
                    <!-- Nav item -->
                    <li class="nav-item">
                        <div class="navbar-heading">User</div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link has-arrow" href="#">
                            <i data-feather="clipboard" class="nav-icon icon-xs me-2"></i> <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Page content -->
        <div id="page-content">
            <div class="header @@classList">
                <!-- navbar -->
                <nav class="navbar-classic navbar navbar-expand-lg">
                    <a id="nav-toggle" href="#"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
                    <div class="ms-lg-3 d-none d-md-none d-lg-block">
                        <!-- Form (removed for simplicity) -->
                    </div>
                    <!--Navbar nav -->
                    <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
                        <li class="dropdown ms-2">
                            <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="avatar avatar-md avatar-indicators">
                                    <i class="bi bi-people fs-4"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                <div class="px-4 pb-0 pt-2">
                                    <div class="lh-1">
                                        <h5 class="mb-1"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></h5>
                                    </div>
                                    <div class="dropdown-divider mt-3 mb-2"></div>
                                </div>
                                <ul class="list-unstyled">
                                    <li><a class="dropdown-item" href="dashboard2.php">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="lesson1.php">Lessons</a></li>
                                    <li><a class="dropdown-item" href="videos.php">Video Lessons</a></li>
                                    <li><a class="dropdown-item" href="certificate.php">Certificate</a></li>
                                    <li><a class="dropdown-item" href="test.php">Test</a></li>
                                    <li><a class="dropdown-item" href="blog.php">Blog</a></li>
                                    <li><a class="dropdown-item" href="logout.php?id=1">
                                        <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>Sign Out
                                    </a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>