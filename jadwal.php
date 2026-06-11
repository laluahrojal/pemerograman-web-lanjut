<?php
require 'koneksi.php';
$user_id = $_SESSION['user_id'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Kelas Saya</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Jadwal Kelas Saya</h1>
            <a href="../logout.php" class="btn">Logout</a>
        </header>

        <table style="width:100%; text-align:center; margin-bottom:20px;">
            <tr>
                <td><a href="index.php">Dashboard</a></td>
            <td><a href="profil.php">Profil</a></td>
            <td><a href="daftar_kelas.php">Daftar Kelas</a></td>
            <td><a href="materi.php">Materi</a></td>
            <td><a href="tutor.php">Tutor</a></td>
            <td><a href="jadwal.php" class="active">Jadwal</a></td>
            <td><a href="zoom.php">Zoom Meeting</a></td>
            </tr>
        </table>

        <main>
            <h3>Jadwal Mendatang</h3>
            <table>
                <tr>
                    <th>Kelas</th>
                    <th>Hari</th>
                    <th>Jam</th>
                </tr>
                <?php
                $sql = "SELECT j.*, k.nama_kelas FROM jadwal j 
                        JOIN kelas k ON j.kode_kelas = k.kode_kelas 
                        JOIN peserta_kelas p ON k.kode_kelas = p.kode_kelas 
                        WHERE p.kode_user = $user_id";
                $result = $conn->query($sql);
                
                if($result->num_rows > 0):
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['nama_kelas']; ?></td>
                    <td><?php echo $row['hari']; ?></td>
                    <td><?php echo $row['jam']; ?></td>
                </tr>
                <?php 
                    endwhile; 
                else: 
                ?>
                <tr><td colspan="3">Tidak ada jadwal. Anda mungkin belum bergabung dengan kelas.</td></tr>
                <?php endif; ?>
            </table>
        </main>
    </div>
</body>
</html>
