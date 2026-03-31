<?php
$host = 'localhost';
$db   = 'dg240295129_astoncv';    
$user = 'dg240295129';      
$pass = 'fe8VmTxXBL9snbDk7Tdl26zEC';          

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Database connection failed');
}
