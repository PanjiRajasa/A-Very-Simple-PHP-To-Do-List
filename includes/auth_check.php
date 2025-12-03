<?php
// includes/auth_check.php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Jika user belum login, redirect ke halaman login
    header("Location: login.php");
    exit();
}
?>