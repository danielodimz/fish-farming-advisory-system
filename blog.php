<?php include 'includes/auth.php'; ?>
<!-- <h2>Dashboard</h2> -->
<!-- <p>Welcome, <?php echo $_SESSION['username'] ?? 'Guest'; ?>!</p> -->
<!-- <a href="lesson.php?id=1">Start Lesson 1: Introduction to Fish Farming</a> -->
<!-- <a href="logout.php?id=1">Logout</a> -->
<?php include 'includes/header2.php' ?>


<!-- //  -->
<!-- //  -->
<!-- Container fluid -->
<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold">Blog: Fish Farming Tips & Advice</h3>
            </div>
        </div>
    </div>
    <div class="row mb-8">
        <div class="col-xl-3 col-lg-4 col-md-12 col-12">
            <div class="mb-4 mb-lg-0">
                <p class="mb-0 fs-5 text-muted">Top 5 Mistakes Beginner Fish Farmers Make
                </p>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
            <!-- card -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">

                    <div class="mb-4">
                        <!-- alert -->
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Starting a fish farm is exciting, but many new farmers make avoidable mistakes that cost them time, money, and sometimes their entire stock. Here are the top five mistakes to avoid as a beginner in fish farming:
                            </button>
                        </div>
                    </div>
                    <!-- numbered with content -->
                    <ol class="list-group list-group-numbered mb-6">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Overcrowding the Pond</div>
                                Too many fish in a small space leads to competition for oxygen and food, and can cause diseases to spread rapidly. Always stock based on the size of your pond or tank. Example: A 1,000-liter tank should not carry more than 200–300 fingerlings.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Poor Water Management</div>
                                Fish breathe through water. If the water is dirty, smells bad, or lacks oxygen, your fish will suffer. Change 30–50% of your water weekly (or more frequently if using a tarpaulin tank) and monitor pH and temperature.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Using Low-Quality Fingerlings</div>
                                Not all fingerlings are the same. Buying weak or unhealthy ones from an unverified hatchery can lead to poor growth, high mortality, and slow profit. Always buy from trusted sources and observe for signs of disease before stocking.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Overfeeding or Underfeeding</div>
                                Feeding is expensive, but underfeeding causes poor growth, and overfeeding leads to waste and bad water. Use floating feed to monitor consumption, and remove uneaten feed after 10–15 minutes. Follow a consistent feeding schedule.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">No Record Keeping</div>
                                Many beginners don’t track their expenses, feed quantity, or growth rates. Without records, it’s hard to know if you're making a profit. Use a simple notebook or Excel sheet to log daily activities like feeding, water changes, and harvest weights.
                            </div>
                        </li>
                    </ol>
                    <p>
                            ✅ <strong>Tip:</strong> Learn from others, join fish farming forums or WhatsApp groups, and never stop researching!
                    </p>
                    
                    <p>
                        <!-- 📝<strong> Up Next:</strong> Lesson 2 – <a href="lesson2.php">How to Set Up Your Fish Farm</a> -->
                    </p>
                     <p style="margin-top:20px;">
                            📖 <em>More blog posts coming soon: “How to Smoke Catfish for Sale”, “Fish Feed Formulation at Home”, “Starting a Profitable Backyard Fish Farm”</em>
                        </p>

                </div>


            </div>

        </div>
    </div>
</div>

</div>
</div>
</div>
<!-- //  -->
<!-- //  -->

<?php include 'includes/footer2.php' ?>

