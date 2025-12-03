<?php
// process_note.php
require_once 'includes/auth_check.php'; // Memastikan user login
require_once 'config/database.php'; //ambil config db

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ambil data user
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $action = $_POST['action'];

    // jika action POST adalah create
    if ($action == 'create') {
        try {
            // Query INSERT untuk catatan baru
            $stmt = $pdo->prepare("INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)");

            // eksekusi query
            $stmt->execute([$user_id, $title, $content]);

            // pindah lokasi ke dashboard
            header("Location: views/dashboard.php?status=created");
            exit();

        } catch (PDOException $e) {
            die("Error creating note: " . $e->getMessage());
        }
    } 
    
    // jika action POST adalah update
    elseif ($action == 'update') {
        // ambil id note dari POST edit_note.php
        $note_id = $_POST['note_id'];
        
        try {
            // Query UPDATE, pastikan ID catatan dan USER ID cocok
            $stmt = $pdo->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ? AND user_id = ?");

            // eksekusi query
            $stmt->execute([$title, $content, $note_id, $user_id]);

            // pindah lokasi
            header("Location: views/dashboard.php?status=updated");
            exit();

        } catch (PDOException $e) {
            // tampilkan error kalau ada error
            die("Error updating note: " . $e->getMessage());
        }
    }
}
?>
