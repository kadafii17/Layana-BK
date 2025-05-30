<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<h2>Dashboard Admin</h2>
<p>Selamat datang, <?= htmlspecialchars($_SESSION['user']['nama']) ?>!</p>

<h3>Statistik Sistem</h3>
<?php
$total_user = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$total_konseling = $conn->query("SELECT COUNT(*) as total FROM konseling")->fetch_assoc()['total'];
$siswa = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='siswa'")->fetch_assoc()['total'];
$guru = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='guru'")->fetch_assoc()['total'];
?>
<ul>
    <li>Total Pengguna: <?= $total_user ?></li>
    <li>Total Siswa: <?= $siswa ?></li>
    <li>Total Guru BK: <?= $guru ?></li>
    <li>Total Konseling: <?= $total_konseling ?></li>
</ul>

<h3>Manajemen Pengguna</h3>
<table border="1" cellpadding="5">
<tr><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th></tr>
<?php
$result = $conn->query("SELECT * FROM users WHERE role != 'admin'");
while ($user = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . htmlspecialchars($user['nama']) . "</td>
        <td>" . htmlspecialchars($user['email']) . "</td>
        <td>" . $user['role'] . "</td>
        <td><a href='hapus_user.php?id={$user['id']}' onclick='return confirm(\"Yakin ingin menghapus user ini?\")'>Hapus</a></td>
    </tr>";
}
?>
</table>

<h3>Riwayat Konseling</h3>
<table border="1" cellpadding="5">
<tr><th>Nama Siswa</th><th>Topik</th><th>Status</th><th>Jadwal</th><th>Deskripsi</th><th>Tanggapan</th></tr>
<?php
$query = "SELECT k.*, u.nama FROM konseling k JOIN users u ON k.siswa_id = u.id ORDER BY k.created_at DESC";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . htmlspecialchars($row['nama']) . "</td>
        <td>" . htmlspecialchars($row['topik']) . "</td>
        <td>" . $row['status'] . "</td>
        <td>" . ($row['jadwal'] ? date('d-m-Y H:i', strtotime($row['jadwal'])) : '-') . "</td>
        <td>" . htmlspecialchars($row['deskripsi']) . "</td>
        <td>" . htmlspecialchars($row['tanggapan']) . "</td>
    </tr>";
}
?>
</table>

<a href="../logout.php" class="btn btn-danger">Logout</a>
