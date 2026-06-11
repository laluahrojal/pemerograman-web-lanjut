<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $isi = $_POST['isi_laporan'];
        $tanggal = date('Y-m-d');
        
        $conn->query("INSERT INTO laporan (isi_laporan, tanggal) VALUES ('$isi', '$tanggal')");
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['kode_laporan'];
        $conn->query("DELETE FROM laporan WHERE kode_laporan = '$id'");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Laporan</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Admin - Kelola Laporan</h1>
            <a href="../logout.php" class="btn">Logout</a>
        </header>

        <table style="width:100%; text-align:center; margin-bottom:20px;">
            <tr>
                <td><a href="index.php">Dashboard</a></td>
            <td><a href="kelas.php">Kelola Kelas</a></td>
            <td><a href="tutor.php">Kelola Tutor</a></td>
            <td><a href="materi.php">Kelola Materi</a></td>
            <td><a href="jadwal.php">Kelola Jadwal</a></td>
            <td><a href="zoom.php">Kelola Zoom Meeting</a></td>
            <td><a href="member.php">Data Member</a></td>
            <td><a href="laporan.php" class="active">Laporan</a></td>
            </tr>
        </table>

        <main>
            <div class="card">
                <h3>Buat Laporan Baru</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Isi Laporan</label>
                        <textarea name="isi_laporan" rows="4" required></textarea>
                    </div>
                    <button type="submit" name="add" class="btn">Simpan</button>
                </form>
            </div>

            <h3>Daftar Laporan</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Isi Laporan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM laporan ORDER BY tanggal DESC");
                while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['kode_laporan']; ?></td>
                    <td><?php echo nl2br($row['isi_laporan']); ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td>
                        <form method="POST" action="" style="margin:0; padding:0; border:none;">
                            <input type="hidden" name="kode_laporan" value="<?php echo $row['kode_laporan']; ?>">
                            <button type="submit" name="delete" class="btn">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </main>
    </div>
</body>
</html>
