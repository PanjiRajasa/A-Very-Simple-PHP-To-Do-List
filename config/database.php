<?php
// config/database.php

$host = '127.0.0.1'; // Biasanya localhost atau 127.0.0.1
$dbname = 'simple_notes_app';
$dbuser = 'root'; // Ganti dengan username DB Anda
$dbpass = '';     // Ganti dengan password DB Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

?>