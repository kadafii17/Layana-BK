<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'guru') {
    header("Location: login.php");
    exit();
}

$guru_id = $_SESSION['user']['id'];
?>

<h2>Dashboard Guru</h2>
<p>Selamat datang, <?= htmlspecialchars($_SESSION['user']['nama']) ?>!</p>

<h3>Pesan dari Siswa</h3>
<ul>
<?php
$pesan_result = $conn->query("SELECT p.*, u.nama AS pengirim FROM pesan p JOIN users u ON p.pengirim_id = u.id WHERE p.penerima_id = $guru_id ORDER BY p.waktu_kirim DESC");
while ($pesan = $pesan_result->fetch_assoc()) {
    echo "<li><strong>Dari: " . htmlspecialchars($pesan['pengirim']) . "</strong><br>" . htmlspecialchars($pesan['isi']) . "<br><small>" . $pesan['waktu_kirim'] . "</small>";
    echo "<form method='POST' action='balas_pesan.php' style='margin-top: 10px;'>
            <input type='hidden' name='pengirim_id' value='" . $pesan['pengirim_id'] . "'>
            <textarea name='balasan' required placeholder='Tulis balasan...'></textarea><br>
            <button type='submit'>Balas</button>
          </form>";
    echo "</li>";
}
?>
</ul>

<h3>Kelola Jadwal Konseling</h3>
<form method="POST" action="buat_jadwal.php">
    Siswa: 
    <select name="siswa_id" required>
        <?php
        $siswa_result = $conn->query("SELECT id, nama FROM users WHERE role = 'siswa'");
        while ($siswa = $siswa_result->fetch_assoc()) {
            echo "<option value='" . $siswa['id'] . "'>" . htmlspecialchars($siswa['nama']) . "</option>";
        }
        ?>
    </select><br>
    Topik: <input type="text" name="topik" required><br>
    Jadwal: <input type="datetime-local" name="jadwal" required><br>
    <button type="submit">Buat Jadwal</button>
</form>

<h3>Materi Konseling</h3>
<form method="POST" action="upload_materi.php" enctype="multipart/form-data">
    Judul: <input type="text" name="judul" required><br>
    File: <input type="file" name="file" required><br>
    <button type="submit">Unggah</button>
</form>

<h3>Notifikasi</h3>
<ul>
<?php
$notifikasi_result = $conn->query("SELECT * FROM notifikasi WHERE user_id = $guru_id AND status = 'baru' ORDER BY waktu DESC");
while ($notifikasi = $notifikasi_result->fetch_assoc()) {
    echo "<li>" . htmlspecialchars($notifikasi['isi']) . "<br><small>" . $notifikasi['waktu'] . "</small></li>";
}
$conn->query("UPDATE notifikasi SET status = 'dibaca' WHERE user_id = $guru_id");
?>
</ul>

<a href="../logout.php" class="btn btn-danger">Logout</a>