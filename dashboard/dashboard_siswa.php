<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'siswa') {
    header('Location: ../login.php');
    exit();
}
include '../config/db.php';
include '../includes/header.php';
?>

<h2>Dashboard Siswa</h2>
<ul>
    <li><a href="?fitur=ajukan_konseling">Ajukan Konseling</a></li>
    <li><a href="?fitur=riwayat_konseling">Riwayat Konseling</a></li>
    <li><a href="?fitur=pesan_guru">Pesan ke Guru</a></li>
    <li><a href="?fitur=materi">Materi Konseling</a></li>
    <li><a href="?fitur=notifikasi">Notifikasi</a></li>
</ul>

<?php
$fitur = $_GET['fitur'] ?? '';
switch ($fitur) {
    case 'ajukan_konseling':
        include '../fitur/siswa/ajukan_konseling.php';
        break;
    case 'riwayat_konseling':
        include '../fitur/siswa/riwayat_konseling.php';
        break;
    case 'pesan_guru':
        include '../fitur/siswa/pesan_guru.php';
        break;
    case 'materi':
        include '../fitur/siswa/materi.php';
        break;
    case 'notifikasi':
        include '../fitur/siswa/notifikasi.php';
        break;
    default:
        echo "<p>Selamat datang di dashboard siswa.</p>";
}
include '../includes/footer.php';
?>

<a href="../logout.php" class="btn btn-danger">Logout</a>