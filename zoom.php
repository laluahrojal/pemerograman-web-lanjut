<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $link = $_POST['link_zoom'];
        $meeting_id = $_POST['meeting_id'];
        $pass = $_POST['password_meeting'];
        $kelas_id = $_POST['kode_kelas'];
        
        $conn->query("INSERT INTO zoom_meeting (link_zoom, meeting_id, password_meeting, kode_kelas) VALUES ('$link', '$meeting_id', '$pass', '$kelas_id')");
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['kode_zoom'];
        $conn->query("DELETE FROM zoom_meeting WHERE kode_zoom = '$id'");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Zoom Meeting</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Admin - Kelola Zoom</h1>
            <a href="../logout.php" class="btn">Logout</a>
        </header>

        <table style="width:100%; text-align:center; margin-bottom:20px;">
            <tr>
                <td><a href="index.php">Dashboard</a></td>
            <td><a href="kelas.php">Kelola Kelas</a></td>
            <td><a href="tutor.php">Kelola Tutor</a></td>
            <td><a href="materi.php">Kelola Materi</a></td>
            <td><a href="jadwal.php">Kelola Jadwal</a></td>
            <td><a href="zoom.php" class="active">Kelola Zoom Meeting</a></td>
            <td><a href="member.php">Data Member</a></td>
            <td><a href="laporan.php">Laporan</a></td>
            </tr>
        </table>

        <main>
            <div class="card">
                <h3>Tambah Zoom Meeting</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Link Zoom</label>
                        <input type="text" name="link_zoom" required>
                    </div>
                    <div class="form-group">
                        <label>Meeting ID</label>
                        <input type="text" name="meeting_id" required>
                    </div>
                    <div class="form-group">
                        <label>Password Meeting</label>
                        <input type="text" name="password_meeting" required>
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

            <h3>Daftar Zoom</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Link Zoom</th>
                    <th>Meeting ID</th>
                    <th>Password</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $result = $conn->query("SELECT z.*, k.nama_kelas FROM zoom_meeting z LEFT JOIN kelas k ON z.kode_kelas = k.kode_kelas");
                while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['kode_zoom']; ?></td>
                    <td><a href="<?php echo $row['link_zoom']; ?>" target="_blank">Buka Link</a></td>
                    <td><?php echo $row['meeting_id']; ?></td>
                    <td><?php echo $row['password_meeting']; ?></td>
                    <td><?php echo $row['nama_kelas']; ?></td>
                    <td>
                        <form method="POST" action="" style="margin:0; padding:0; border:none;">
                            <input type="hidden" name="kode_zoom" value="<?php echo $row['kode_zoom']; ?>">
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
