<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['kode_user'];
    $conn->query("DELETE FROM user WHERE kode_user = '$id'");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Member</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Admin - Data Member</h1>
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
            <td><a href="member.php" class="active">Data Member</a></td>
            <td><a href="laporan.php">Laporan</a></td>
            </tr>
        </table>

        <main>
            <h3>Daftar Member Terdaftar</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>No. HP</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM user");
                while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['kode_user']; ?></td>
                    <td><?php echo $row['nama_user']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['no_hp']; ?></td>
                    <td>
                        <form method="POST" action="" style="margin:0; padding:0; border:none;">
                            <input type="hidden" name="kode_user" value="<?php echo $row['kode_user']; ?>">
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
