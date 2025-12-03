<?php
// views/edit_note.php
require_once '../includes/auth_check.php'; //ambil config pengecekan auth
require_once '../config/database.php'; //ambil config koneksi database

// ambil data
$note_id = $_GET['id'] ?? null; //kalau notenya ga ada, maka sama dengan belum buat note
$user_id = $_SESSION['user_id'];

//kalau belum buat note
if (!$note_id) {
    header("Location: dashboard.php");
    exit();
}

// Ambil data catatan yang spesifik DAN pastikan milik user yang sedang login
$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = ? AND user_id = ?");

// eksekusi query
$stmt->execute([$note_id, $user_id]);

// simpan hasilnya dalam bentuk array
$note = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$note) {
    die("Catatan tidak ditemukan atau Anda tidak memiliki akses.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Catatan</title>
</head>
<body>
    <h2>Edit Catatan</h2>
    <a href="dashboard.php">Kembali ke Dashboard</a>

    <form action="../process_note.php" method="POST">
        <!-- Hidden input untuk mengirim ID dan Aksi Update -->
        <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
        <input type="hidden" name="action" value="update">

        <div>
            <label for="title">Judul:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($note['title']); ?>" required>
        </div>
        <div>
            <label for="content">Konten:</label>
            <textarea id="content" name="content" rows="5" required><?php echo htmlspecialchars($note['content']); ?></textarea>
        </div>
        <button type="submit">Update Catatan</button>
    </form>
</body>
</html>