<?php

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AstonCV</title>
   <link rel="stylesheet" href="../public/css/style.css">

<body>

<nav>
    <a href="index.php">Home</a>

    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="edit_cv.php">My CV</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
    <?php endif; ?>
</nav>

<hr>
