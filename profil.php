<?php
require 'koneksi.php';

$user_id = $_SESSION['user_id'] ?? 0;
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_user'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $query = "UPDATE user SET nama_user='$nama', email='$email', no_hp='$no_hp', password='$password' WHERE kode_user='$user_id'";
    } else {
        $query = "UPDATE user SET nama_user='$nama', email='$email', no_hp='$no_hp' WHERE kode_user='$user_id'";
    }
    
    if ($conn->query($query)) {
        $success = "Profil berhasil diperbarui!";
        $_SESSION['nama_user'] = $nama;
    }
}

$result = $conn->query("SELECT * FROM user WHERE kode_user = '$user_id'");
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profil Saya</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Profil Saya</h1>
            <a href="../logout.php" class="btn">Logout</a>
        </header>

        <table style="width:100%; text-align:center; margin-bottom:20px;">
            <tr>
                <td><a href="index.php">Dashboard</a></td>
            <td><a href="profil.php" class="active">Profil</a></td>
            <td><a href="daftar_kelas.php">Daftar Kelas</a></td>
            <td><a href="materi.php">Materi</a></td>
            <td><a href="tutor.php">Tutor</a></td>
            <td><a href="jadwal.php">Jadwal</a></td>
            <td><a href="zoom.php">Zoom Meeting</a></td>
            </tr>
        </table>

        <main>
            <div class="card" style="max-width:500px;">
                <?php if($success): ?>
                    <div class="alert"><?php echo $success; ?></div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Username (Tidak bisa diubah)</label>
                        <input type="text" value="<?php echo $user['username']; ?>" readonly disabled>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_user" value="<?php echo $user['nama_user']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" value="<?php echo $user['no_hp']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" name="password">
                    </div>
                    <button type="submit" class="btn">Simpan Profil</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
