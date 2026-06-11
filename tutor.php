<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $nama = $_POST['nama_tutor'];
        $pengalaman = $_POST['pengalaman'];
        // Sederhanakan foto sebagai teks/URL untuk saat ini tanpa file upload
        $foto = $_POST['foto']; 
        
        $conn->query("INSERT INTO tutor (nama_tutor, pengalaman, foto) VALUES ('$nama', '$pengalaman', '$foto')");
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['kode_tutor'];
        $conn->query("DELETE FROM tutor WHERE kode_tutor = '$id'");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Tutor</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Admin - Kelola Tutor</h1>
            <a href="../logout.php" class="btn">Logout</a>
        </header>

        <table style="width:100%; text-align:center; margin-bottom:20px;">
            <tr>
                <td><a href="index.php">Dashboard</a></td>
            <td><a href="kelas.php">Kelola Kelas</a></td>
            <td><a href="tutor.php" class="active">Kelola Tutor</a></td>
            <td><a href="materi.php">Kelola Materi</a></td>
            <td><a href="jadwal.php">Kelola Jadwal</a></td>
            <td><a href="zoom.php">Kelola Zoom Meeting</a></td>
            <td><a href="member.php">Data Member</a></td>
            <td><a href="laporan.php">Laporan</a></td>
            </tr>
        </table>

        <main>
            <div class="card">
                <h3>Tambah Tutor</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Nama Tutor</label>
                        <input type="text" name="nama_tutor" required>
                    </div>
                    <div class="form-group">
                        <label>Pengalaman</label>
                        <input type="text" name="pengalaman" required>
                    </div>
                    <div class="form-group">
                        <label>URL Foto (Opsional)</label>
                        <input type="text" name="foto">
                    </div>
                    <button type="submit" name="add" class="btn">Simpan</button>
                </form>
            </div>

            <h3>Daftar Tutor</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama Tutor</th>
                    <th>Pengalaman</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM tutor");
                while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['kode_tutor']; ?></td>
                    <td><?php echo $row['nama_tutor']; ?></td>
                    <td><?php echo $row['pengalaman']; ?></td>
                    <td>
                        <form method="POST" action="" style="margin:0; padding:0; border:none;">
                            <input type="hidden" name="kode_tutor" value="<?php echo $row['kode_tutor']; ?>">
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
