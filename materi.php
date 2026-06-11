<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $judul = $_POST['judul_materi'];
        $file = $_POST['file_materi']; // link text untuk saat ini
        $kelas_id = $_POST['kode_kelas'];
        
        $conn->query("INSERT INTO materi (judul_materi, file_materi, kode_kelas) VALUES ('$judul', '$file', '$kelas_id')");
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['kode_materi'];
        $conn->query("DELETE FROM materi WHERE kode_materi = '$id'");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Materi</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Admin - Kelola Materi</h1>
            <a href="../logout.php" class="btn">Logout</a>
        </header>

        <table style="width:100%; text-align:center; margin-bottom:20px;">
            <tr>
                <td><a href="index.php">Dashboard</a></td>
            <td><a href="kelas.php">Kelola Kelas</a></td>
            <td><a href="tutor.php">Kelola Tutor</a></td>
            <td><a href="materi.php" class="active">Kelola Materi</a></td>
            <td><a href="jadwal.php">Kelola Jadwal</a></td>
            <td><a href="zoom.php">Kelola Zoom Meeting</a></td>
            <td><a href="member.php">Data Member</a></td>
            <td><a href="laporan.php">Laporan</a></td>
            </tr>
        </table>

        <main>
            <div class="card">
                <h3>Tambah Materi</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Judul Materi</label>
                        <input type="text" name="judul_materi" required>
                    </div>
                    <div class="form-group">
                        <label>Link / File Materi</label>
                        <input type="text" name="file_materi" required>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="kode_kelas" required>
                            <?php
                            $kelas = $conn->query("SELECT * FROM kelas");
                            while($k = $kelas->fetch_assoc()):
                            ?>
                            <option value="<?php echo $k['kode_kelas']; ?>"><?php echo $k['nama_kelas']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" name="add" class="btn">Simpan</button>
                </form>
            </div>

            <h3>Daftar Materi</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Judul Materi</th>
                    <th>File</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $result = $conn->query("SELECT m.*, k.nama_kelas FROM materi m LEFT JOIN kelas k ON m.kode_kelas = k.kode_kelas");
                while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['kode_materi']; ?></td>
                    <td><?php echo $row['judul_materi']; ?></td>
                    <td><?php echo $row['file_materi']; ?></td>
                    <td><?php echo $row['nama_kelas']; ?></td>
                    <td>
                        <form method="POST" action="" style="margin:0; padding:0; border:none;">
                            <input type="hidden" name="kode_materi" value="<?php echo $row['kode_materi']; ?>">
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
