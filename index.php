<?php
require 'koneksi.php';
$user_id = $_SESSION['user_id'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>User Dashboard</h1>
            <div>
                Selamat datang, <?php echo $_SESSION['nama_user'] ?? 'Member'; ?>! | 
                <a href="../logout.php" class="btn">Logout</a>
            </div>
        </header>

        <table style="width:100%; text-align:center; margin-bottom:20px;">
            <tr>
                <td><a href="index.php" class="active">Dashboard</a></td>
                <td><a href="profil.php">Profil</a></td>
                <td><a href="daftar_kelas.php">Daftar Kelas</a></td>
                <td><a href="materi.php">Materi</a></td>
                <td><a href="tutor.php">Tutor</a></td>
                <td><a href="jadwal.php">Jadwal</a></td>
                <td><a href="zoom.php">Zoom Meeting</a></td>
            </tr>
        </table>

        <main>
            <h2>Selamat datang di Dashboard Member</h2>
            <div class="grid">
                <div class="card">
                    <h3>Total Kelas Anda</h3>
                    <p>
                        <?php 
                        $res = $conn->query("SELECT COUNT(*) as total FROM peserta_kelas WHERE kode_user='$user_id'");
                        echo $res ? $res->fetch_assoc()['total'] : 0;
                        ?>
                    </p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
