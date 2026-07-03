<?php
include 'includes/auth.php';
require 'includes/db.php';
include 'includes/header2.php';

$user_id = $_SESSION['user_id'];
$module_id = 2; // Map to module ID (1 for lesson1.php, 2 for lesson2.php, etc.)

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
        <h4 class="mb-1">Lesson 2</h4>
        <p class="mb-0 fs-5 text-muted">How to Set Up a Fish Farm</p>
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
              Setting up a fish farm is one of the most important steps in fish farming. A good setup ensures healthy fish, good water quality, and better profits. Whether you're working with land, tanks, or containers, the following steps will guide you.
              <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

              </button>
            </div>
          </div>
          <!-- hoverable rows -->
          <table class="table table-hover mb-6">
            <thead>
              <h5>Step 1: Choose a Suitable Location

              </h5>
              <tr>
                <th scope="col">🟢</th>
                <th scope="col"> Access to clean, non-polluted water
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">🟢</th>
                <td> Near a power supply (for pumps/aerators)
                </td>
              </tr>
              <tr>
                <th scope="row">🟢</th>
                <td> Proper drainage system
                </td>
              </tr>
              <tr>
                <th scope="row">🟢</th>
                <td colspan="2"> Easily accessible for feed supply and transportation
                  Can be practiced on a small scale in backyards
                </td>

              </tr>

            </tbody>
          </table>

          <!-- hoverable rows -->
          <table class="table table-hover mb-6">
            <thead>
              <h5>Step 2: Decide the Type of Fish Farm
              </h5>
              <tr>
                <th scope="col">🌊</th>
                <th scope="col"> Concrete Pond – durable but costly

                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">💧</th>
                <td> Tarpulin Tank – affordable and mobile

                </td>
              </tr>
              <tr>
                <th scope="row">🌱</th>
                <td> Earthen Pond – natural and cost-effective


                </td>

              </tr>
              <tr>
                <th scope="row">🔁</th>
                <td colspan="2"> Recirculating Aquaculture System (RAS) – modern and eco-friendly


                </td>

              </tr>

            </tbody>
          </table>
          <!-- hoverable rows -->
          <table class="table table-hover mb-6">
            <thead>
              <h5>Step 3: Construct the Pond or Tank</h5>
              <tr>
                <th scope="col"> The size depends on your budget and space. For beginners, a tarpaulin tank of 6ft x 4ft x 3ft is ideal. Ensure the base is flat and leak-free. </th>
              </tr>
            </thead>

          </table>
          <table class="table table-hover mb-6">
            <thead>
              <h5>Step 4: Install Drainage and Inlet Systems</h5>
              <tr>
                <th scope="col"> Good water flow is key. Install proper inlet (clean water in) and outlet (waste water out) systems to keep the water fresh and reduce ammonia build-up.
                </th>
              </tr>
            </thead>

          </table>

          <div class="table-responsive mb-3">
            <table class="table text-nowrap">
              <thead class="table-light">
                <tr>
                  <th class="w-75"><strong> Step 5: Prepare for Fingerlings</strong></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="border-top-0">
                    <i class="text-muted icon-sm" data-feather="minus"></i>
                    Clean and fill your pond/tank with water (leave to age for 5–7 days)
                  </td>
                </tr>
                <td class="border-top-0">
                  <i class="text-muted icon-sm" data-feather="minus"></i>
                  Treat water with anti-stress or salt (optional)
                </td>
                </tr>
                <td class="border-top-0">
                  <i class="text-muted icon-sm" data-feather="minus"></i>
                  Buy fingerlings from a reputable hatchery
                </td>
                </tr>
                </tr>
                <td class="border-top-0">
                  <i class="text-muted icon-sm" data-feather="minus"></i>
                  Feed Stock during cool hours (morning or evening)
                </td>
                </tr>
              </tbody>
            </table>
          </div>
          <p><a href="take_quiz.php?module_id=<?php echo $module_id; ?>" class="btn btn-info">Take Quiz</a></p>

          <p>
            📝<strong> Previous</strong> Lesson 1 – <a href="lesson1.php">Introduction to Fish Farming </a>
          </p>
          <p>
            📝<strong> Up Next:</strong> Lesson 3 – <a href="lesson3.php">Feeding Your Fish for Fast Growth</a>
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