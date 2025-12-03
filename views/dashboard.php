<?php
// views/dashboard.php

// ambil file config database dan pengecekan auth
require_once '../includes/auth_check.php';
require_once '../config/database.php';

// Ambil notes milik user yang sedang login
$user_id = $_SESSION['user_id'];

// ambil data note user berdasarkan id
$stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ? ORDER BY created_at DESC");

// execute statement
$stmt->execute([$user_id]);
// simpan dalam bentuk array
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Notes</title>
</head>
<body>
    <!-- pakai isi session untuk pesan selamat datang -->
    <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p><a href="../logout.php">Logout</a></p>

    <h3>Catatan Anda:</h3>
    <p><a href="create_note.php">Buat Catatan Baru</a></p>

    <!-- kalau notes ada (udah pernah buat notes) -->
    <?php if (count($notes) > 0): ?>
        <ul>
            <!-- loop notes -->
            <?php foreach ($notes as $note): ?>
                <li>
                    <!-- judul -->
                    <strong><?php echo htmlspecialchars($note['title']); ?></strong>

                    <!-- isi note -->
                    <!-- nl2br() untuk format teks supaya rapih -->
                    <p><?php echo nl2br(htmlspecialchars($note['content'])); ?></p>

                    <!-- tanggal note -->
                    <small>Dibuat pada: <?php echo $note['created_at']; ?></small>

                    <small>Diedit pada: <?php echo $note['updated_at']; ?></small>

                    <!-- Link Aksi: Edit dan Hapus (akan kita buat nanti) -->
                    <a href="edit_note.php?id=<?php echo $note['id']; ?>">Edit</a> | 
                    
                    <a href="../process_delete.php?id=<?php echo $note['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </li>
                <hr>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Anda belum memiliki catatan. Ayo buat yang pertama!</p>
    <?php endif; ?>

</body>
</html>
