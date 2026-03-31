<?php
require_once '../config/db.php';
session_start();

$id = $_GET['id'] ?? null;

if (!$id || !ctype_digit($id)) {
    die('Invalid CV');
}

$sql = "SELECT * FROM cvs WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$cv = $stmt->fetch();

if (!$cv) {
    die('CV not found');
}

include '../includes/header.php';
?>

<h1><?= htmlspecialchars($cv['name']) ?>'s CV</h1>

<p><strong>Email:</strong> <?= htmlspecialchars($cv['email']) ?></p>
<p><strong>Key Programming Language:</strong> <?= htmlspecialchars($cv['keyprogramming']) ?></p>
<p><strong>Profile:</strong> <?= nl2br(htmlspecialchars($cv['profile'])) ?></p>
<p><strong>Education:</strong> <?= nl2br(htmlspecialchars($cv['education'])) ?></p>
<p><strong>Links:</strong> <?= nl2br(htmlspecialchars($cv['URLlinks'])) ?></p>

<a href="index.php">Back</a>

<?php include '../includes/footer.php'; ?>
