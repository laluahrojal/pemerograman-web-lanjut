<?php
if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1') {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "kursus_inggris";
} else {
    $host = "localhost";
    $user = "tiuinmtr_mimin";
    $pass = "mimin2026#";
    $db   = "tiuinmtr_mimin";
}

// Connect without database to ensure it exists
$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Create database if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS `$db`");

// Select the database
$conn->select_db($db);

// Check if tables exist. If not, create them.
$table_check = $conn->query("SHOW TABLES LIKE 'user'");
if ($table_check && $table_check->num_rows == 0) {
    // Create user table
    $conn->query("CREATE TABLE user (
        kode_user INT AUTO_INCREMENT PRIMARY KEY,
        nama_user VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        no_hp VARCHAR(20) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Create admin table
    $conn->query("CREATE TABLE admin (
        kode_admin INT AUTO_INCREMENT PRIMARY KEY,
        nama_admin VARCHAR(100) NOT NULL,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Create tutor table
    $conn->query("CREATE TABLE tutor (
        kode_tutor INT AUTO_INCREMENT PRIMARY KEY,
        nama_tutor VARCHAR(100) NOT NULL,
        pengalaman VARCHAR(255) NOT NULL,
        foto VARCHAR(255) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Create kelas table
    $conn->query("CREATE TABLE kelas (
        kode_kelas INT AUTO_INCREMENT PRIMARY KEY,
        nama_kelas VARCHAR(100) NOT NULL,
        level_kelas ENUM('Beginner', 'Intermediate', 'Advanced') NOT NULL,
        kode_tutor INT NOT NULL,
        FOREIGN KEY (kode_tutor) REFERENCES tutor(kode_tutor) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Create materi table
    $conn->query("CREATE TABLE materi (
        kode_materi INT AUTO_INCREMENT PRIMARY KEY,
        judul_materi VARCHAR(150) NOT NULL,
        file_materi VARCHAR(255) NOT NULL,
        kode_kelas INT NOT NULL,
        FOREIGN KEY (kode_kelas) REFERENCES kelas(kode_kelas) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Create jadwal table
    $conn->query("CREATE TABLE jadwal (
        kode_jadwal INT AUTO_INCREMENT PRIMARY KEY,
        hari VARCHAR(20) NOT NULL,
        jam VARCHAR(50) NOT NULL,
        kode_kelas INT NOT NULL,
        FOREIGN KEY (kode_kelas) REFERENCES kelas(kode_kelas) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Create zoom_meeting table
    $conn->query("CREATE TABLE zoom_meeting (
        kode_zoom INT AUTO_INCREMENT PRIMARY KEY,
        link_zoom VARCHAR(255) NOT NULL,
        meeting_id VARCHAR(50) NOT NULL,
        password_meeting VARCHAR(50) NOT NULL,
        kode_kelas INT NOT NULL,
        FOREIGN KEY (kode_kelas) REFERENCES kelas(kode_kelas) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Create peserta_kelas table
    $conn->query("CREATE TABLE peserta_kelas (
        kode_peserta INT AUTO_INCREMENT PRIMARY KEY,
        kode_user INT NOT NULL,
        kode_kelas INT NOT NULL,
        tanggal_daftar DATE NOT NULL,
        FOREIGN KEY (kode_user) REFERENCES user(kode_user) ON DELETE CASCADE,
        FOREIGN KEY (kode_kelas) REFERENCES kelas(kode_kelas) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Create laporan table
    $conn->query("CREATE TABLE laporan (
        kode_laporan INT AUTO_INCREMENT PRIMARY KEY,
        isi_laporan TEXT NOT NULL,
        tanggal DATE NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Insert default admin
    $conn->query("INSERT IGNORE INTO admin (nama_admin, username, password) VALUES ('Administrator', 'admin', 'admin')");
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>