<?php
require 'koneksi.php';
$conn->query("INSERT IGNORE INTO admin (nama_admin, username, password) VALUES ('Administrator', 'admin', 'admin')");
echo "Admin check done";
?>
