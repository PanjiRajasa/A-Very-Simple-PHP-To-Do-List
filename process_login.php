<?php
// process_login.php
session_start(); // Mulai sesi

// ambil config database php
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ambil data user
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil user dari database berdasarkan username
    $stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");

    // eksekusi queri
    $stmt->execute([$username]);

    // mengambil data pengguna dari database dan menyimpannya dalam variabel $user dalam format array
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifikasi password
    if ($user && password_verify($password, $user['password_hash'])) {
        // Login berhasil, maka buat session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        // Redirect ke dashboard
        header("Location: views/dashboard.php");
        exit();

    } else {
        // Login gagal, dan berikan nilai error=invalid pada URL
        header("Location: views/login.php?error=invalid");
        exit();
    }
}
?>
