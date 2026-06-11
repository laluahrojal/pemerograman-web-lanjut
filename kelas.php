<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $nama = $_POST['nama_kelas'];
        $level = $_POST['level_kelas'];
        $tutor_id = $_POST['kode_tutor'];
        
        $conn->query("INSERT INTO kelas (nama_kelas, level_kelas, kode_tutor) VALUES ('$nama', '$level', '$tutor_id')");
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['kode_kelas'];
        $conn->query("DELETE FROM kelas WHERE kode_kelas = '$id'");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Kelas</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Admin - Kelola Kelas</h1>
            <a href="../logout.php" class="btn">Logout</a>
        </header>

        <table style="width:100%; text-align:center; margin-bottom:20px;">
            <tr>
                <td><a href="index.php">Dashboard</a></td>
            <td><a href="kelas.php" class="active">Kelola Kelas</a></td>
            <td><a href="tutor.php">Kelola Tutor</a></td>
            <td><a href="materi.php">Kelola Materi</a></td>
            <td><a href="jadwal.php">Kelola Jadwal</a></td>
            <td><a href="zoom.php">Kelola Zoom Meeting</a></td>
            <td><a href="member.php">Data Member</a></td>
            <td><a href="laporan.php">Laporan</a></td>
            </tr>
        </table>

        <main>
            <div class="card">
                <h3>Tambah Kelas</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <input type="text" name="nama_kelas" required>
                    </div>
                    <div class="form-group">
                        <label>Level Kelas</label>
                        <select name="level_kelas" required>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tutor</label>
                        <select name="kode_tutor" required>
                            <?php
                            $tutors = $conn->query("SELECT * FROM tutor");
                            while($t = $tutors->fetch_assoc()):
                            ?>
                            <option value="<?php echo $t['kode_tutor']; ?>"><?php echo $t['nama_tutor']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" name="add" class="btn">Simpan</button>
                </form>
            </div>

            <h3>Daftar Kelas</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama Kelas</th>
                    <th>Level</th>
                    <th>Tutor</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $result = $conn->query("SELECT k.*, t.nama_tutor FROM kelas k LEFT JOIN tutor t ON k.kode_tutor = t.kode_tutor");
                while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['kode_kelas']; ?></td>
                    <td><?php echo $row['nama_kelas']; ?></td>
                    <td><?php echo $row['level_kelas']; ?></td>
                    <td><?php echo $row['nama_tutor']; ?></td>
                    <td>
                        <form method="POST" action="" style="margin:0; padding:0; border:none;">
                            <input type="hidden" name="kode_kelas" value="<?php echo $row['kode_kelas']; ?>">
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
