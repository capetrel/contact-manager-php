<?php
// Connexion à la base de données
$host = 'localhost';
$db   = 'your_db_name';
$user = 'your_user_id';
$pass = 'your_user_pass';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false
];

$pdo = new PDO($dsn, $user, $pass, $opt);
