<?php
// config.php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "antrian_qr"; // samakan dengan nama database yang kamu import

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>