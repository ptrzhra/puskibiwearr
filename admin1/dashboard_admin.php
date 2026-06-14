<?php
session_start();

date_default_timezone_set('Asia/Jakarta');

// PROTEKSI ADMIN
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../user/login.php");
    exit;
}

include '../config/koneksi.php';

$nama_admin = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Admin';


// ===============================
// REALTIME QUERY DASHBOARD ADMIN
// ===============================

// total jas
$total_jas = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM jas"
))['total'] ?? 0;

// sedang dipinjam
$dipinjam = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM peminjaman 
WHERE status='dipinjam' OR status='disetujui'"
))['total'] ?? 0;

// butuh verifikasi
$verifikasi = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM peminjaman 
WHERE status='menunggu'"
))['total'] ?? 0;

// total user (opsional tambahan real insight)
$total_user = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM users"
))['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PuskibiWear</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">


</head>

<body>

<div class="admin-container">

    <aside class="sidebar">
        <div class="logo-section">
            <span class="logo-icon">P</span>
            <span class="logo-text">PuskibiWear</span>
        </div>

        <a href="tambah_jas.php" class="btn-create-pitch">
            <span>Tambah Jas Baru</span>
            <span class="plus-icon">+</span>
        </a>

        <nav class="nav-menu">

    <a href="dashboard_admin.php" class="nav-item active">
        <span class="nav-text">Dashboard</span>
    </a>

    <a href="edit_jas.php" class="nav-item">
        <span class="nav-text">Edit Jas</span>
    </a>

    <a href="hapus_jas.php" class="nav-item">
        <span class="nav-text">Hapus Jas</span>
    </a>

    <a href="verifikasi.php" class="nav-item">
        <span class="nav-text">Verifikasi</span>
    </a>

    <a href="pengembalian.php" class="nav-item">
        <span class="nav-text">Pengembalian</span>
    </a>

    <a href="denda.php" class="nav-item">
        <span class="nav-text">Denda</span>
    </a>

</nav>
        <div class="sidebar-footer-box">
            <p>Sistem Admin</p>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>
    </aside>

    <main class="main-content">

        <header class="header-top">
            <div class="header-title">
                <h1>Dashboard</h1>
                <p class="current-date"><?= date('l, d F Y'); ?></p>
            </div>
            <div class="header-profile">
                <div class="profile-avatar">
                    <?= strtoupper(substr($nama_admin, 0, 2)); ?>
                </div>
                <span class="profile-name"><?= htmlspecialchars($nama_admin); ?></span>
            </div>
        </header>

        <section class="welcome-banner">
            <div class="banner-text">
                <h2>Hi, <?= htmlspecialchars($nama_admin); ?></h2>
                <p>Siap Mengelola Inventaris dan Pesanan Mahasiswa Setiap Hari!</p>
            </div>
            <div class="banner-illustration">
                <img src="../assets/img/admin.jpg" alt="Foto Admin" class="banner-admin-img">
            </div>
        </section>

        <h3 class="section-label">Overview</h3>

        <section class="overview-cards">

            <div class="card card-yellow">
                <div class="card-info">
                    <span class="card-value"><?= $total_jas; ?></span>
                    <span class="card-title">Total Jas</span>
                </div>
            </div>

            <div class="card card-purple">
                <div class="card-info">
                    <span class="card-value"><?= $dipinjam; ?></span>
                    <span class="card-title">Sedang Dipinjam</span>
                </div>
            </div>

            <div class="card card-pink">
                <div class="card-info">
                    <span class="card-value"><?= $verifikasi; ?></span>
                    <span class="card-title">Butuh Verifikasi</span>
                </div>
            </div>

        </section>

        <section class="info-list-section">

            <div class="info-row">
                <div class="info-row-left">
                    <div class="row-icon-box bg-light-purple">JA</div>
                    <div>
                        <h4>Jas Almamater UMSU</h4>
                        <p class="row-subtitle">Stok tersedia untuk dipinjam mahasiswa</p>
                    </div>
                </div>
                <div class="info-row-right">
                    <span class="status-badge public">Tersedia</span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-row-left">
                    <div class="row-icon-box bg-light-yellow">JP</div>
                    <div>
                        <h4>Jas Praktikum</h4>
                        <p class="row-subtitle">Stok tersedia untuk dipinjam mahasiswa</p>
                    </div>
                </div>
                <div class="info-row-right">
                    <span class="status-badge public">Tersedia</span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-row-left">
                    <div class="row-icon-box bg-light-yellow">JS</div>
                    <div>
                        <h4>Jas Sempro</h4>
                        <p class="row-subtitle">Stok tersedia untuk dipinjam mahasiswa</p>
                    </div>
                </div>
                <div class="info-row-right">
                    <span class="status-badge private">Tersedia</span>
                </div>
            </div>

        </section>

    </main>
</div>

</body>
</html>