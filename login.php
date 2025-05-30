<?php
// Struktur file akan seperti ini:
// - login.php
// - dashboard_siswa.php
// - dashboard_guru.php
// - dashboard_admin.php
// - db.php
// - logout.php
// - siswa_konseling_ajukan.php
// - guru_konseling_proses.php
// - hapus_user.php
// - init.sql

// Langkah pertama adalah kita buat ulang file login.php, dan kita pastikan halaman dashboard tiap role punya fitur jelas dan bebas error

// login.php
session_start();
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE nama=? AND email=? AND password=?");
    $stmt->bind_param("sss", $nama, $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user;

        switch ($user['role']) {
            case 'siswa':
                header('Location: dashboard/dashboard_siswa.php');
                break;
            case 'guru':
                header('Location: dashboard/dashboard_guru.php');
                break;
            case 'admin':
                header('Location: dashboard/dashboard_admin.php');
                break;
        }
    } else {
        echo "Login gagal. Cek kembali nama, email, dan password.";
    }
}
?>

<!-- HTML form -->
<form method="POST">
    Nama: <input type="text" name="nama" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
