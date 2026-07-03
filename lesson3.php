<?php
include 'includes/auth.php';
require 'includes/db.php';
include 'includes/header2.php';

$user_id = $_SESSION['user_id'];
$module_id = 3; // Map to module ID (1 for lesson1.php, 2 for lesson2.php, etc.)

// Start progress if not exists
$stmt = $db->prepare("INSERT IGNORE INTO user_progress (user_id, module_id) VALUES (?, ?)");
$stmt->execute([$user_id, $module_id]);
?>
<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->

            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold">Lessons</h3>

            </div>

        </div>
    </div>

    <div class="row mb-8">
        <div class="col-xl-3 col-lg-4 col-md-12 col-12">
            <div class="mb-4 mb-lg-0">
                <h4 class="mb-1">Lesson 3</h4>
                <p class="mb-0 fs-5 text-muted">Fish Feeding & Nutrition</p>
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
                            Feeding your fish the right way is one of the most important factors that affect their
                            growth, health, and your profit. Poor feeding means poor growth and more disease outbreaks.
                            Let’s explore the best practices in fish nutrition.
                            <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                            </button>
                        </div>
                    </div>
                    <!-- hoverable rows -->
                    <h5>Types of Fish Feed </h5>
                    <ol class="list-group list-group-numbered mb-6">
                        <li class="list-group-item"><strong>Natural Feed:</strong> Algae, plankton, insects – usually
                            found in ponds</li>
                        <li class="list-group-item"><strong>Supplementary Feed:</strong> Rice bran, maize meal,
                            groundnut cake</li>
                        <li class="list-group-item"><strong>Complete/Commercial Feed:</strong> Formulated pellets with
                            balanced nutrients</li>
                    </ol>

                    <!-- table head -->
                    <table class="table mb-6">
                        <h5>Feeding Stages by Fish Age
                        </h5>
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Stage</th>
                                <th scope="col">Feed Type</th>
                                <th scope="col">Feed Size</th>
                                <th scope="col">Frequency</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Fry</td>
                                <td>Powdered Feed</td>
                                <td>0.1 – 0.3 mm</td>
                                <td>4–5 times/day</td>
                            </tr>
                            <tr>
                                <td>Fingerlings</td>
                                <td>Floating Feed</td>
                                <td>0.5 – 1 mm</td>
                                <td>2–3 times/day</td>
                            </tr>
                            <tr>
                                <td>Grow-out</td>
                                <td>Pellets</td>
                                <td>2 – 6 mm</td>
                                <td>2 times/day</td>
                            </tr>
                        </tbody>

                    </table>
                    <!-- hoverable rows -->
                    <table class="table table-hover mb-6">
                        <thead>
                            <h5>Tips for Efficient Feeding

                            </h5>
                            <tr>
                                <th scope="col">✅</th>
                                <th scope="col"> Feed early in the morning and late evening


                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">✅</th>
                                <td> Do not overfeed—leftover feed reduces water quality


                                </td>
                            </tr>
                            <tr>
                                <th scope="row">✅</th>
                                <td> Observe fish behavior during feeding



                                </td>

                            </tr>
                            <tr>
                                <th scope="row">✅</th>
                                <td colspan="2"> Use floating feed to monitor consumption



                                </td>

                            </tr>
                            <tr>
                                <th scope="row">✅</th>
                                <td colspan="2"> Always provide clean, fresh water




                                </td>

                            </tr>

                        </tbody>
                    </table>
                    <!-- hoverable rows -->
                    <table class="table table-hover mb-6">
                        <thead>
                            <h5>Feed Conversion Ratio (FCR)</h5>
                            <tr>
                                <th scope="col"> FCR = Weight of feed given ÷ Weight of fish produced </th>
                            </tr>
                            <tr>
                                <th scope="col"> Example: If you give 100kg of feed and harvest 70kg of fish, FCR =
                                    100/70 = 1.43 </th>
                            </tr>
                        </thead>

                    </table>

                    <p><a href="take_quiz.php?module_id=<?php echo $module_id; ?>" class="btn btn-info">Take Quiz</a>
                    </p>
                    <p>
                        📝<strong> Previous</strong> Lesson 2 – <a href="lesson2.php">How to Set Up Your Fish Farm</a>
                    </p>
                    <p>
                        📝<strong> Up Next:</strong> Lesson 4 – <a href="lesson4.php">Common Fish Diseases and How to
                            Treat Them</a>
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