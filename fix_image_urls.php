<?php
require 'includes/db.php';

$base = '/web/odimz/fish-farming-advisory-system/admin/uploads/';

$stmt = $db->query("SELECT id, image_url FROM modules WHERE image_url IS NOT NULL");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    $old = $row['image_url'];
    $filename = basename($old);
    $new = $base . $filename;

    if ($old !== $new) {
        $upd = $db->prepare("UPDATE modules SET image_url = ? WHERE id = ?");
        $upd->execute([$new, $row['id']]);
        echo "Module {$row['id']}: '$old' → '$new'<br>";
    } else {
        echo "Module {$row['id']}: already correct<br>";
    }
}
echo "<br><strong>Done.</strong>";
?>
