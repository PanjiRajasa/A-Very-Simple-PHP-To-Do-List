<!-- views/register.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Registrasi Pengguna</title>
</head>
<body>
    <h2>Daftar Akun Baru</h2>
    <form action="../process_register.php" method="POST" >
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a>.</p>
</body>
</html>