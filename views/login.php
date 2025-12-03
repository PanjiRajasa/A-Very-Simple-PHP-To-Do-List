<!-- views/login.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login Aplikasi Notes</h2>

    <!-- Jika URL memiliki parameter registration yang nilainya 'success' -->
    <?php if (isset($_GET['registration']) && $_GET['registration'] == 'success'): ?>
        <p style="color: green;">Registrasi berhasil! Silakan login.</p>
    <?php endif; ?>
    
    <!-- Jika URL memiliki parameter error -->
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;">Username atau password salah.</p>
    <?php endif; ?>

    <form action="../process_login.php" method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar di sini</a>.</p>
</body>
</html>
