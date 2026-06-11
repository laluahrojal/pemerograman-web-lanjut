<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $error = "";

    // Cek User
    $result = $conn->query("SELECT * FROM user WHERE username = '$username' AND password = '$password'");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['kode_user'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama_user'] = $row['nama_user'];
        header("Location: user/index.php");
        exit();
    } else {
        // Cek Admin
        $result = $conn->query("SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['admin_id'] = $row['kode_admin'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['nama_admin'] = $row['nama_admin'];
            header("Location: admin/index.php");
            exit();
        } else {
            $error = "Username atau Password salah!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Kursus Bahasa Inggris</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Login</h1>
            <a href="index.php" class="btn">Kembali ke Beranda</a>
        </header>

        <main style="max-width: 400px; margin: 0 auto;">
            <?php if(!empty($error)): ?>
                <div class="alert"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </main>
    </div>
</body>
</html>
