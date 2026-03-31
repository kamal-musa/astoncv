<?php
require_once '../config/db.php';
session_start();
require_once '../includes/auth.php';
requireLogin();

$userId = $_SESSION['user_id'];

$sql = "SELECT * FROM cvs WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $userId]);
$cv = $stmt->fetch();

if (!$cv) {
    die('CV not found');
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profile   = trim($_POST['profile'] ?? '');
    $education = trim($_POST['education'] ?? '');
    $links     = trim($_POST['URLlinks'] ?? '');

    $sql = "UPDATE cvs 
            SET profile = :profile, education = :education, URLlinks = :links 
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':profile'   => $profile,
        ':education' => $education,
        ':links'     => $links,
        ':id'        => $userId
    ]);

    header('Location: cv.php?id=' . $userId);
    exit;
}
?>
<?php include '../includes/header.php'; ?>

<h1>Edit My CV</h1>

<form method="post" action="edit_cv.php">
    <label>Profile:<br>
        <textarea name="profile" rows="4" cols="50"><?= htmlspecialchars($cv['profile']) ?></textarea>
    </label><br>
    <label>Education:<br>
        <textarea name="education" rows="4" cols="50"><?= htmlspecialchars($cv['education']) ?></textarea>
    </label><br>
    <label>Links:<br>
        <textarea name="URLlinks" rows="4" cols="50"><?= htmlspecialchars($cv['URLlinks']) ?></textarea>
    </label><br>
    <button type="submit">Save</button>
</form>

<?php include '../includes/footer.php'; ?>
