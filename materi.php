<?php
require 'koneksi.php';
$user_id = $_SESSION['user_id'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Materi Pembelajaran</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Materi Pembelajaran</h1>
            <a href="../logout.php" class="btn">Logout</a>
        </header>

        <table style="width:100%; text-align:center; margin-bottom:20px;">
            <tr>
                <td><a href="index.php">Dashboard</a></td>
            <td><a href="profil.php">Profil</a></td>
            <td><a href="daftar_kelas.php">Daftar Kelas</a></td>
            <td><a href="materi.php" class="active">Materi</a></td>
            <td><a href="tutor.php">Tutor</a></td>
            <td><a href="jadwal.php">Jadwal</a></td>
            <td><a href="zoom.php">Zoom Meeting</a></td>
            </tr>
        </table>

        <main>
            <h3>Materi dari Kelas Saya</h3>
            <table>
                <tr>
                    <th>Kelas</th>
                    <th>Judul Materi</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $sql = "SELECT m.*, k.nama_kelas FROM materi m 
                        JOIN kelas k ON m.kode_kelas = k.kode_kelas 
                        JOIN peserta_kelas p ON k.kode_kelas = p.kode_kelas 
                        WHERE p.kode_user = $user_id";
                $result = $conn->query($sql);
                
                if($result->num_rows > 0):
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['nama_kelas']; ?></td>
                    <td><?php echo $row['judul_materi']; ?></td>
                    <td><a href="<?php echo $row['file_materi']; ?>" target="_blank" class="btn">Buka Materi</a></td>
                </tr>
                <?php 
                    endwhile; 
                else: 
                ?>
                <tr><td colspan="3">Belum ada materi. Anda mungkin belum bergabung dengan kelas apapun.</td></tr>
                <?php endif; ?>
            </table>
        </main>
    </div>
</body>
</html>
