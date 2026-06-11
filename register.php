<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_user'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $no_hp = $_POST['no_hp'];

    // Cek username apakah sudah ada
    $result = $conn->query("SELECT * FROM user WHERE username = '$username'");

    if ($result->num_rows > 0) {
        $error = "Username sudah digunakan!";
    } else {
        $result_insert = $conn->query("INSERT INTO user (nama_user, email, username, password, no_hp) VALUES ('$nama', '$email', '$username', '$password', '$no_hp')");
        
        if ($result_insert) {
            echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='login.php';</script>";
            exit();
        } else {
            $error = "Terjadi kesalahan saat mendaftar.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Member - Kursus Bahasa Inggris</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Daftar Member</h1>
            <a href="index.php" class="btn">Kembali ke Beranda</a>
        </header>

        <main style="max-width: 500px; margin: 0 auto;">
            <?php if(isset($error)): ?>
                <div class="alert"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_user" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>No HP</label>
                    <input type="text" name="no_hp" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn">Daftar</button>
            </form>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </main>
    </div>
</body>
</html>
