<?php
session_start();
if (isset($_SESSION['user'])) {
    // Redirect ke dashboard sesuai role
    switch ($_SESSION['user']['role']) {
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
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BK-Online - Konseling Sekolah Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0e7ff 0%, #f8fafc 100%);
            min-height: 100vh;
        }
        .hero {
            padding: 60px 0;
        }
        .logo-bk {
            width: 80px;
            margin-bottom: 20px;
        }
        @media (max-width: 576px) {
            .hero {
                padding: 30px 0;
            }
            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">BK-Online</a>
            <a class="btn btn-outline-primary ms-auto" href="login.php">Login</a>
        </div>
    </nav>
    <section class="hero text-center">
        <div class="container">
            <img src="assets/logo_bk.png" alt="Logo BK" class="logo-bk" onerror="this.style.display='none'">
            <h1 class="mb-3">Selamat Datang di BK-Online</h1>
            <p class="lead mb-4">
                Platform digital untuk layanan Bimbingan dan Konseling di sekolah.<br>
                Siswa, guru, dan admin dapat berinteraksi, konsultasi, serta mengelola data konseling secara mudah dan aman.
            </p>
            <a href="login.php" class="btn btn-primary btn-lg">Masuk ke Sistem</a>
        </div>
    </section>
    <section class="container my-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Untuk Siswa</h5>
                        <p class="card-text">Ajukan konseling, lihat riwayat, akses materi, dan komunikasi langsung dengan guru BK secara online.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Untuk Guru BK</h5>
                        <p class="card-text">Kelola jadwal konseling, tanggapi permintaan siswa, unggah materi, dan pantau perkembangan siswa.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Untuk Admin</h5>
                        <p class="card-text">Kelola data pengguna, monitoring aktivitas, dan dapatkan laporan konseling secara real-time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="text-center py-4 bg-light mt-auto">
        <small>&copy; <?= date('Y') ?> BK-Online. Seluruh hak cipta dilindungi.</small>
    </footer>
</body>
</html>