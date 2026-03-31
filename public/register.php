<?php
require_once '../config/db.php';
session_start();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $keyprog  = trim($_POST['keyprogramming'] ?? '');

    if ($name === '' || $email === '' || $password === '') {
        $errors[] = 'Name, email and password are required.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO cvs (name, email, password, keyprogramming) 
                VALUES (:name, :email, :password, :keyprogramming)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                ':name'          => $name,
                ':email'         => $email,
                ':password'      => $hash,
                ':keyprogramming'=> $keyprog
            ]);
            header('Location: login.php');
            exit;
        } catch (PDOException $e) {
            $errors[] = 'Email already registered.';
        }
    }
}
?>
<?php include '../includes/header.php'; ?>

<h1>Register</h1>

<?php foreach ($errors as $error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endforeach; ?>

<form method="post" action="register.php">
    <label>Name: <input type="text" name="name" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <label>Key Programming Language: <input type="text" name="keyprogramming"></label><br>
    <button type="submit">Register</button>
</form>

<?php include '../includes/footer.php'; ?>
