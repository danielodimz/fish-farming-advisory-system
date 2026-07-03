<?php
include 'includes/auth.php';
require 'includes/db.php';

$user_id = $_SESSION['user_id'];
$category = isset($_GET['category']) && in_array($_GET['category'], ['backyard', 'catfish']) ? $_GET['category'] : 'backyard';

// Fetch videos
$stmt = $db->prepare("SELECT id, title, youtube_url FROM videos WHERE category = ?");
$stmt->execute([$category]);
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Track video view (simplified: mark as viewed on page load)
if (!empty($videos)) {
    foreach ($videos as $video) {
        $stmt = $db->prepare("INSERT INTO video_progress (user_id, video_id, viewed) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE viewed = 1");
        $stmt->execute([$user_id, $video['id']]);
    }
}

?>

<?php include 'includes/header2.php'; ?>

<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold"><?php echo $category == 'backyard' ? 'Backyard Fish Farming Basics' : 'Catfish Farming'; ?></h3>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <a href="videos.php?category=backyard" class="btn btn-<?php echo $category == 'backyard' ? 'primary' : 'outline-primary'; ?> me-2">Backyard Farming</a>
            <a href="videos.php?category=catfish" class="btn btn-<?php echo $category == 'catfish' ? 'primary' : 'outline-primary'; ?>">Catfish Farming</a>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($videos as $video): ?>
            <div class="col">
                <div class="card">
                    <h5 class="card-title p-1"><?php echo htmlspecialchars($video['title']); ?></h5>
                    <iframe width="100%" height="250" src="<?php echo htmlspecialchars($video['youtube_url']); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (empty($videos)): ?>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <p>No videos available for this category.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>
</div>

<?php include 'includes/footer2.php'; ?>