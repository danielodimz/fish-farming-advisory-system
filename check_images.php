<?php
require 'includes/db.php';
$stmt = $db->query("SELECT id, title, image_url FROM modules");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
foreach ($rows as $r) {
    echo "ID: {$r['id']} | Title: {$r['title']} | image_url: " . var_export($r['image_url'], true) . "\n";
}
echo "</pre>";
?>
