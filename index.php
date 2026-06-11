<?php
require 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kursus Bahasa Inggris</title>
    </head>
<body>
    <div class="container">
        <header>
            <h1>Kursus Bahasa Inggris</h1>
            <div>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="user/index.php" class="btn">Dashboard User</a>
                <?php elseif(isset($_SESSION['admin_id'])): ?>
                    <a href="admin/index.php" class="btn">Dashboard Admin</a>
                <?php else: ?>
                    <a href="login.php" class="btn">Login</a>
                    <a href="register.php" class="btn">Daftar Member</a>
                <?php endif; ?>
            </div>
        </header>

        <main>
            <h2>Selamat Datang!</h2>
            <p>Tingkatkan kemampuan bahasa Inggris Anda bersama kami.</p>
            <div class="grid" style="margin-top: 20px;">
                <div class="card">
                    <h3>Materi Lengkap</h3>
                   
                </div>
                <div class="card">
                    <h3>Tutor Berpengalaman</h3>
                 
                </div>
                <div class="card">
                    <h3>Jadwal Fleksibel</h3>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
