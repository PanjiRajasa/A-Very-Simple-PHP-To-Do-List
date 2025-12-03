<?php
// process_register.php
// ambil config database php
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ambil data username dan password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi jika kedua input kosong
    if (empty($username) || empty($password)) {
        die("Username dan password tidak boleh kosong.");
    }

    // Hash password sebelum disimpan
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Query INSERT yang aman menggunakan prepared statement
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");

        // eksekusi query
        $stmt->execute([$username, $password_hash]);

        // pindah ke login, dan berikan nilai registration=success
        header("Location: views/login.php?registration=success");
        exit();
        
    } catch (PDOException $e) {

        // kesalahan ketika user mencoba mendaftar atau membuat akun dengan username yang sudah ada di database
        if ($e->getCode() == 23000) {
            die("Username sudah digunakan.");
        } else {
            die("Terjadi kesalahan: " . $e->getMessage());
        }
    }
}
?>