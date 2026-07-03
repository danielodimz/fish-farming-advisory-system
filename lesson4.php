<?php
include 'includes/auth.php';
require 'includes/db.php';
include 'includes/header2.php';

$user_id = $_SESSION['user_id'];
$module_id = 4; // Map to module ID (1 for lesson1.php, 2 for lesson2.php, etc.)

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
        <h4 class="mb-1">Lesson 4</h4>
        <p class="mb-0 fs-5 text-muted">Common Fish Diseases and How to Treat Them</p>
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
              Fish, like other animals, are vulnerable to diseases—especially when stressed by poor water quality, bad feeding, overcrowding, or sudden changes in environment. Early detection and proper management can save your entire stock.
              <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

              </button>
            </div>
          </div>
          <!-- hoverable rows -->
          <table class="table table-hover mb-6">
            <thead>
              <h5>Common Signs of Disease </h5>
              <tr>
                <th scope="col">⚠️</th>
                <th scope="col"> Loss of appetite
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">⚠️</th>
                <td> Unusual swimming (e.g., spinning, floating sideways)
                </td>
              </tr>
              <tr>
                <th scope="row">⚠️</th>
                <td>Visible sores or lesions
                </td>
              </tr>
              <tr>
                <th scope="row">⚠️</th>
                <td colspan="2"> Gasping at the surface
                </td>

              </tr>
              <tr>
                <th scope="row">⚠️</th>
                <td colspan="2"> Discoloration or fin rot
                </td>

              </tr>

            </tbody>
          </table>
          <h5>Top 5 Common Fish Diseases
          </h5>
          <!-- numbered with content -->
          <ol class="list-group list-group-numbered mb-6">
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Bacterial Infections</div>
                Symptoms: Open wounds, red streaks, ulcers <br>
                Treatment: Apply antibiotics like oxytetracycline in feed; salt bath may help
              </div>
              <span class="badge bg-primary rounded-pill">x</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Fungal Infections</div>
                Symptoms: Cotton-like growth on body or fins
                <br />Treatment: Use antifungal agents like methylene blue; improve water quality
              </div>
              <span class="badge bg-success rounded-pill">x</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Ich (White Spot Disease)</div>
                Symptoms: Tiny white spots all over the body and gills
                <br />Treatment: Increase water temperature gradually; use salt and anti-parasitic treatment
              </div>
              <span class="badge bg-secondary rounded-pill">x</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Fin and Tail Rot</div>
                Symptoms: Fraying fins, ragged tail edges
                <br />Treatment: Antibiotic treatment in water or feed; improve hygiene
              </div>
              <span class="badge bg-warning rounded-pill">x</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Swim Bladder Disorder</div>
                Symptoms: Fish floats or sinks uncontrollably
                <br />Treatment: Improve diet, isolate infected fish; sometimes self-corrects
              </div>
              <span class="badge bg-info rounded-pill">x</span>
            </li>
          </ol>



          <div class="table-responsive mb-3">
            <table class="table text-nowrap">
              <thead class="table-light">
                <tr>
                  <th class="w-75"><strong>Useful Natural Remedies</strong></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="border-top-0">
                    🧂 Common Salt (for stress and fungal infections)
                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
                    🌿 Bitter leaf extract (for parasites – local remedy)
                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
                    🔵 Methylene blue (widely used for fungus & external infections)
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
          <div class="table-responsive mb-3">
            <table class="table text-nowrap">
              <thead class="table-light">
                <tr>
                  <th class="w-75"><strong> How to Prevent Fish Diseases</strong></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="border-top-0">
                    <i class="text-muted icon-sm" data-feather="minus"></i>
                    Quarantine new fish before stocking
                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
                    <i class="text-muted icon-sm" data-feather="minus"></i>
                    Maintain clean water and good aeration
                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
                    <i class="text-muted icon-sm" data-feather="minus"></i>
                    Avoid overcrowding
                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
                    <i class="text-muted icon-sm" data-feather="minus"></i>
                    Feed quality, nutritious feed
                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
                    <i class="text-muted icon-sm" data-feather="minus"></i>
                    Monitor fish behavior daily
                  </td>
                </tr>
                <tr>
                  <td class="border-top-0">
                    <i class="text-muted icon-sm" data-feather="minus"></i>
                    Remove dead fish immediately
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <p><a href="take_quiz.php?module_id=<?php echo $module_id; ?>" class="btn btn-info">Take Quiz</a></p>

          <p>
            📝<strong> Previous:</strong> Lesson 3 – <a href="lesson3.php">Feeding Your Fish for Fast Growth</a>
          </p>
          <p>
            📌<strong> Up Next:</strong> Lesson 5 – <a href="lesson5.php">Harvesting and Selling Your Fish</a>
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