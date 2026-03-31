<?php
require_once '../config/db.php';
session_start();

$search = $_GET['q'] ?? '';

if ($search) {
    $sql = "SELECT id, name, email, keyprogramming 
            FROM cvs 
            WHERE name LIKE :q OR keyprogramming LIKE :q";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':q' => "%$search%"]);
} else {
    $sql = "SELECT id, name, email, keyprogramming FROM cvs";
    $stmt = $pdo->query($sql);
}

$cvs = $stmt->fetchAll();
?>
<?php include '../includes/header.php'; ?>

<h1>AstonCV – All CVs</h1>

<form method="get" action="index.php">
    <input type="text" name="q" placeholder="Search by name or language" value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Key Programming Language</th>
        <th>Details</th>
    </tr>
    <?php foreach ($cvs as $cv): ?>
        <tr>
            <td><?= htmlspecialchars($cv['name']) ?></td>
            <td><?= htmlspecialchars($cv['email']) ?></td>
            <td><?= htmlspecialchars($cv['keyprogramming']) ?></td>
            <td><a href="cv.php?id=<?= $cv['id'] ?>">View</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include '../includes/footer.php'; ?>
