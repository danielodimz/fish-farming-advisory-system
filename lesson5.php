<?php
include 'includes/auth.php';
require 'includes/db.php';
include 'includes/header2.php';

$user_id = $_SESSION['user_id'];
$module_id = 5; // Map to module ID (1 for lesson1.php, 2 for lesson2.php, etc.)

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
        <h4 class="mb-1">Lesson 5</h4>
        <p class="mb-0 fs-5 text-muted">Harvesting and Selling Your Fish</p>
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
Harvesting is the final and most rewarding stage of fish farming. Knowing when and how to harvest, and where to sell, ensures you make the most profit from your efforts. A poor harvest can lead to losses—even after months of hard work.
              <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

              </button>
            </div>
          </div>
          <!-- hoverable rows -->
          <table class="table table-hover mb-6">
            <thead>
              <h5>When Should You Harvest?</h5>
              <tr>
                <th scope="col">🐟</th>
                <th scope="col">  Catfish: Ready between 4–6 months (weight: 1kg or more)

                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">🐠</th>
                <td>  Tilapia: Harvest at 6–8 months (300g to 500g)

                </td>
              </tr>
              <tr>
                <th scope="row">📏</th>
                <td> Consider market demand—some buyers want medium sizes, others prefer jumbo sizes

                </td>
              </tr>
              <tr>
                <th scope="row">💧</th>
                <td colspan="2">  Fish should be active, healthy, and properly fed before harvest

                </td>

              </tr>
            

            </tbody>
          </table>
          <h5>Methods of Harvesting
          </h5>
          <!-- numbered with content -->
          <ol class="list-group list-group-numbered mb-6">
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Complete Harvesting
</div>
               
All fish are removed from the pond at once—ideal when the pond needs to be drained or restocked.
              </div>
              <span class="badge bg-primary rounded-pill">x</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Partial Harvesting</div>
             Only market-sized fish are removed, allowing smaller ones to continue growing.

              </div>
              <span class="badge bg-success rounded-pill">x</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Grading</div>
                Fish are sorted by size before selling, ensuring uniformity and better pricing.

              </div>
              <span class="badge bg-secondary rounded-pill">x</span>
            </li>
           
          
          </ol>



          <div class="table-responsive mb-3">
            <table class="table text-nowrap">
              <thead class="table-light">
                <tr>
                  <th class="w-75"><strong>Tools You’ll Need</strong></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="border-top-0">
✔️ Harvesting net (dragnet or scoop net)
                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
✔️ Plastic tanks or barrels for temporary holding
                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
✔️ Scale for weighing
                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
✔️ Ice for preserving harvested fish (if not selling immediately)
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
          <div class="table-responsive mb-3">
            <table class="table text-nowrap">
              <thead class="table-light">
                <tr>
                  <th class="w-75"><strong>Post-Harvest Options</strong></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="border-top-0">
📦<strong> Fresh Sale:</strong> Sold live or iced to market, restaurants, or individuals
                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
🔥<strong> Smoked Fish:</strong> Increases shelf life, popular in retail markets
                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
🚚<strong> Wholesale:</strong> Selling in bulk to fish vendors or distributors
                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
📞<strong> Direct Order:</strong> Use social media, WhatsApp groups, or websites
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
          <div class="table-responsive mb-3">
            <table class="table text-nowrap">
              <thead class="table-light">
                <tr>
                  <th class="w-75"><strong> Tips to Sell Your Fish Faster</strong></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="border-top-0">
                    <i class="text-muted icon-sm" data-feather="minus"></i>
                     Build a customer list while the fish are still growing

                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
                    <i class="text-muted icon-sm" data-feather="minus"></i>
                     Use platforms like WhatsApp, Facebook, and local markets

                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
                    <i class="text-muted icon-sm" data-feather="minus"></i>
                     Offer discounts for bulk buyers

                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
                    <i class="text-muted icon-sm" data-feather="minus"></i>
                     Always sell clean, well-fed, and healthy fish

                  </td>
                </tr>
               
              </tbody>
            </table>
          </div>
                              <p><a href="take_quiz.php?module_id=<?php echo $module_id; ?>" class="btn btn-info">Take Quiz</a></p>

          <p>
                        📝<strong> Previous</strong> Lesson 4 – <a href="lesson4.php">Common Fish Diseases and How to Treat Them</a>
                    </p>
                     <p style="margin-top:30px;">
        📌 <strong>You've Completed the Beginner Course!</strong> 👏  
        Ready to go deeper? Start our next module: <em>“Advanced Fish Breeding Techniques”</em> or check out the blog for real-world tips.
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
