<?php
$host ="127.0.0.1";
$dbname = "platforme_formation";
$user = "root";
$pass = "TJ @sedera";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion,tsy tafiditra : " . $e->getMessage());
}

