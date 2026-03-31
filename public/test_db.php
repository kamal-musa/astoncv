<?php
require_once '../config/db.php';

$stmt = $pdo->query("SELECT * FROM cvs");
$data = $stmt->fetchAll();

echo "<pre>";
print_r($data);
echo "</pre>";
