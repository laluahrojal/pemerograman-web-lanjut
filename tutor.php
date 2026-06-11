<?php
require 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Tutor</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Tutor Kami</h1>
            <a href="../logout.php" class="btn">Logout</a>
        </header>

        <table style="width:100%; text-align:center; margin-bottom:20px;">
            <tr>
                <td><a href="index.php">Dashboard</a></td>
            <td><a href="profil.php">Profil</a></td>
            <td><a href="daftar_kelas.php">Daftar Kelas</a></td>
            <td><a href="materi.php">Materi</a></td>
            <td><a href="tutor.php" class="active">Tutor</a></td>
            <td><a href="jadwal.php">Jadwal</a></td>
            <td><a href="zoom.php">Zoom Meeting</a></td>
            </tr>
        </table>

        <main>
            <div class="grid">
                <?php
                $result = $conn->query("SELECT * FROM tutor");
                while($row = $result->fetch_assoc()):
                ?>
                <div class="card">
                    <h4><?php echo $row['nama_tutor']; ?></h4>
                    <p><strong>Pengalaman:</strong> <?php echo $row['pengalaman']; ?></p>
                    <?php if(!empty($row['foto'])): ?>
                        <p><a href="<?php echo $row['foto']; ?>" target="_blank">Lihat Foto</a></p>
                    <?php endif; ?>
                </div>
                <?php endwhile; ?>
            </div>
        </main>
    </div>
</body>
</html>
