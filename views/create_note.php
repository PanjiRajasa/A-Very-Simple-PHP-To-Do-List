<?php
// views/create_note.php

// ambil config pengecekan auth
require_once '../includes/auth_check.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Buat Catatan Baru</title>
</head>
<body>
    <h2>Buat Catatan Baru</h2>
    <a href="dashboard.php">Kembali ke Dashboard</a>

    <form action="../process_note.php" method="POST">
        <div>
            <label for="title">Judul:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="content">Konten:</label>
            <textarea id="content" name="content" rows="5" required></textarea>
        </div>
        <button type="submit" name="action" value="create">Simpan Catatan</button>
    </form>
</body>
</html>