<?php
// process_delete.php
require_once 'includes/auth_check.php'; //ambil config pengecekan auth
require_once 'config/database.php'; //ambil config database

// jika GET id dari process_delete.php?id=<?php echo $note['id'] sudah di-set
if (isset($_GET['id'])) {

    // ambil data id dan id user
    $note_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    try {
        // Query DELETE, pastikan ID catatan dan USER ID cocok
        $stmt = $pdo->prepare("DELETE FROM notes WHERE id = ? AND user_id = ?");

        // eksekusi kode
        $stmt->execute([$note_id, $user_id]);

        // pindah lokasi
        header("Location: views/dashboard.php?status=deleted");
        exit();

    } catch (PDOException $e) {
        // tampilkan error jika ada
        die("Error deleting note: " . $e->getMessage());
    }
} else {
    // kalau misalkan id note ga ada
    header("Location: views/dashboard.php");
    exit();
}
?>