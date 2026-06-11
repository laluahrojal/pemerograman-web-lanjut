<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $hari = $_POST['hari'];
        $jam = $_POST['jam'];
        $kelas_id = $_POST['kode_kelas'];
        
        $conn->query("INSERT INTO jadwal (hari, jam, kode_kelas) VALUES ('$hari', '$jam', '$kelas_id')");
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['kode_jadwal'];
        $conn->query("DELETE FROM jadwal WHERE kode_jadwal = '$id'");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Jadwal</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Admin - Kelola Jadwal</h1>
            <a href="../logout.php" class="btn">Logout</a>
        </header>

        <table style="width:100%; text-align:center; margin-bottom:20px;">
            <tr>
                <td><a href="index.php">Dashboard</a></td>
            <td><a href="kelas.php">Kelola Kelas</a></td>
            <td><a href="tutor.php">Kelola Tutor</a></td>
            <td><a href="materi.php">Kelola Materi</a></td>
            <td><a href="jadwal.php" class="active">Kelola Jadwal</a></td>
            <td><a href="zoom.php">Kelola Zoom Meeting</a></td>
            <td><a href="member.php">Data Member</a></td>
            <td><a href="laporan.php">Laporan</a></td>
            </tr>
        </table>

        <main>
            <div class="card">
                <h3>Tambah Jadwal</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Hari</label>
                        <select name="hari" required>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jam</label>
                        <input type="text" name="jam" placeholder="Misal: 19:00 - 20:30" required>
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

            <h3>Daftar Jadwal</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $result = $conn->query("SELECT j.*, k.nama_kelas FROM jadwal j LEFT JOIN kelas k ON j.kode_kelas = k.kode_kelas");
                while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['kode_jadwal']; ?></td>
                    <td><?php echo $row['hari']; ?></td>
                    <td><?php echo $row['jam']; ?></td>
                    <td><?php echo $row['nama_kelas']; ?></td>
                    <td>
                        <form method="POST" action="" style="margin:0; padding:0; border:none;">
                            <input type="hidden" name="kode_jadwal" value="<?php echo $row['kode_jadwal']; ?>">
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
