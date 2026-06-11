<?php
require 'koneksi.php';

$user_id = $_SESSION['user_id'] ?? 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['join'])) {
    $kelas_id = $_POST['kode_kelas'];
    $tanggal = date('Y-m-d');
    
    // Cek apakah sudah terdaftar
    $cek = $conn->query("SELECT * FROM peserta_kelas WHERE kode_user=$user_id AND kode_kelas=$kelas_id");
    if ($cek->num_rows == 0) {
        $result_insert = $conn->query("INSERT INTO peserta_kelas (kode_user, kode_kelas, tanggal_daftar) VALUES ('$user_id', '$kelas_id', '$tanggal')");
        if ($result_insert) {
            echo "<script>alert('Berhasil mendaftar ke kelas!'); window.location='daftar_kelas.php';</script>";
        }
    } else {
        echo "<script>alert('Anda sudah terdaftar di kelas ini.');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kelas</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Daftar Kelas</h1>
            <a href="../logout.php" class="btn">Logout</a>
        </header>

        <table style="width:100%; text-align:center; margin-bottom:20px;">
            <tr>
                <td><a href="index.php">Dashboard</a></td>
            <td><a href="profil.php">Profil</a></td>
            <td><a href="daftar_kelas.php" class="active">Daftar Kelas</a></td>
            <td><a href="materi.php">Materi</a></td>
            <td><a href="tutor.php">Tutor</a></td>
            <td><a href="jadwal.php">Jadwal</a></td>
            <td><a href="zoom.php">Zoom Meeting</a></td>
            </tr>
        </table>

        <main>
            <h3>Kelas Tersedia</h3>
            <div class="grid">
                <?php
                $result = $conn->query("SELECT k.*, t.nama_tutor FROM kelas k LEFT JOIN tutor t ON k.kode_tutor = t.kode_tutor");
                while($row = $result->fetch_assoc()):
                    // Cek apakah user sudah daftar
                    $k_id = $row['kode_kelas'];
                    $cek = $conn->query("SELECT * FROM peserta_kelas WHERE kode_user=$user_id AND kode_kelas=$k_id");
                    $sudah_daftar = $cek->num_rows > 0;
                ?>
                <div class="card">
                    <h4><?php echo $row['nama_kelas']; ?></h4>
                    <p>Level: <?php echo $row['level_kelas']; ?></p>
                    <p>Tutor: <?php echo $row['nama_tutor']; ?></p>
                    <br>
                    <?php if($sudah_daftar): ?>
                        <span style="font-weight:bold; color:green;">Sudah Terdaftar</span>
                    <?php else: ?>
                        <form method="POST" action="" style="padding:0; margin:0; border:none;">
                            <input type="hidden" name="kode_kelas" value="<?php echo $row['kode_kelas']; ?>">
                            <button type="submit" name="join" class="btn">Gabung Kelas</button>
                        </form>
                    <?php endif; ?>
                </div>
                <?php endwhile; ?>
            </div>
        </main>
    </div>
</body>
</html>
