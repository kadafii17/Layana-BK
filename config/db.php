<?php
$host = "localhost";
$user = "root";
$pass = ""; // Ganti jika password MySQL kamu tidak kosong
$dbname = "multi_login";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
