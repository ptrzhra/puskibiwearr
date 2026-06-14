<?php
session_start();

date_default_timezone_set('Asia/Jakarta');

// 1. Koneksi Database
include '../config/koneksi.php';

// ===============================
// DASHBOARD REAL-TIME QUERY
// ===============================

// total jas
$total_jas = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM jas"
))['total'];

// dipinjam (disetujui)
$dipinjam = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM peminjaman 
WHERE status='disetujui' OR status='dipinjam'"
))['total'];

// tersedia (stok total)
$tersedia = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT SUM(stok) AS total FROM jas"
))['total'];

// menunggu verifikasi
$menunggu = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM peminjaman 
WHERE status='menunggu'"
))['total'];


// 2. Cek apakah session login sudah ada
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

// 3. Ambil role
$role_kamu = isset($_SESSION['role']) ? strtolower($_SESSION['role']) : '';

if ($role_kamu !== 'mahasiswa') {
    if ($role_kamu === 'admin') {
        header("Location: ../admin1/dashboard_admin.php");
    } else {
        header("Location: login.php");
    }
    exit;
}
 
$id_user = $_SESSION['id'];

$query_riwayat = mysqli_query($conn, "
SELECT 
    peminjaman.id_pinjam,
    peminjaman.tanggal_pinjam,
    peminjaman.tanggal_kembali,
    peminjaman.status,
    users.nama AS nama_mahasiswa,
    jas.nama_jas
FROM peminjaman
INNER JOIN users ON peminjaman.id_user = users.id
INNER JOIN jas ON peminjaman.id_jas = jas.id_jas
WHERE peminjaman.id_user = '$id_user'
ORDER BY peminjaman.id_pinjam DESC
");

$nama_user = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - PuskibiWear</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../admin1/admin.css">

    <style>
        /* Trik CSS untuk menyembunyikan konten halaman yang tidak aktif */
        .content-section {
            display: none;
        }
        .content-section.section-active {
            display: block;
        }
        
        /* Memperbaiki kursor menu agar terlihat bisa diklik */
        .nav-menu a {
            cursor: pointer;
        }

        .nav-menu .nav-item{
        font-size: 14px;
        font-weight: 500;
        padding: 9px 12px;
        }

        /* TUNING EXTRA AGAR DASHBOARD USER KEMBAR DAN RAPI SEPERTI ADMIN */
        .overview-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 3 kartu sejajar */
        gap: 24px;
        margin-bottom: 32px;
        }
        .info-list-section {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.05);
            width: 100%;
            box-sizing: border-box;
        }
        .section-label {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a1d20;
            margin: 32px 0 16px 0;
        }

        /* Badge Status Mengikuti Warna Estetik Pastel */
        .status {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-align: center;
        }
        .status.waiting {
            background-color: #fff6e0;
            color: #ffb636;
        }
        .status.approved {
            background-color: #eeeeff;
            color: #5D50C6;
        }
        .status.rejected {
            background-color: #ffe5e5;
            color: #ff4d4d;
        }

        .logo-text{
            font-size: 22px;
            font-weight: 700;
        }

        .btn-create-pitch{
            font-size: 15px;
            font-weight: 600;
            padding: 12px 16px;
            border-radius: 12px;
        }

        .nav-menu{
            margin-top: 15px;
        }

        .nav-menu .nav-item{
            font-size: 17px;
            font-weight: 500;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 6px;
        }

        .nav-menu .nav-text{
            font-size: 15px;
        }

        .sidebar-footer-box p{
            font-size: 14px;
            font-weight: 600;
        }

        .btn-logout{
            font-size: 14px;
            font-weight: 600;
            padding: 10px 14px;
        }
    </style>
</head>
<body>

<div class="admin-container">
    
    <aside class="sidebar">
        <div class="logo-section">
            <span class="logo-icon">P</span>
            <span class="logo-text">PuskibiWear</span>
        </div>

        <a href="data_jas.php" class="btn-create-pitch">
            <span>Sewa Jas Baru</span>
            <span class="plus-icon">+</span>
        </a>

        <nav class="nav-menu">

    <a onclick="switchHalaman('menu-dashboard')" id="btn-dashboard" class="nav-item active">
        <span class="nav-text">Dashboard</span>
    </a>

    <a href="data_jas.php" class="nav-item">
        <span class="nav-text">Data Jas</span>
    </a>

    <a onclick="switchHalaman('menu-riwayat')" id="btn-riwayat" class="nav-item">
        <span class="nav-text">Riwayat</span>
    </a>

    <a href="upload_jaminan.php" class="nav-item">
        <span class="nav-text">Upload Jaminan</span>
    </a>

    <a href="denda.php" class="nav-item">
        <span class="nav-text">Denda Saya</span>
    </a>

    <a href="bukti_peminjaman.php" class="nav-item">
    <span class="nav-text">Bukti Peminjaman</span>
    </a>

    <a href="user.php" class="nav-item">
        <span class="nav-text">User</span>
    </a>
    

</nav>
<div class="sidebar-footer-box">
    <p>Sistem User</p>
    <a href="logout.php" class="btn-logout">Logout</a>
</div>
    </aside>

    <main class="main-content">
        
        <header class="header-top">
            <div class="header-title">
                <h1 id="main-page-title">Dashboard</h1>
                <p class="current-date"><?= date('l, d F Y'); ?></p>
            </div>
            <div class="header-profile">
                <div class="profile-avatar">
                    <?= strtoupper(substr($nama_user, 0, 2)); ?>
                </div>
                <span class="profile-name"><?= htmlspecialchars($nama_user); ?></span>
            </div>
        </header>

        <div id="content-dashboard" class="content-section section-active">
            <section class="welcome-banner">
                <div class="banner-text">
                    <h2>Hi, <?= htmlspecialchars($nama_user); ?></h2>
                    <p>Siap Mencari dan Menyewa Inventaris Jas Mahasiswa Terbaikmu Hari Ini!</p>
                </div>
                <div class="banner-illustration">
                    <img src="../assets/img/user.jpg" alt="Foto User" class="banner-admin-img">
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
                        <span class="card-title">Dipinjam</span>
                    </div>
                </div>

                <div class="card card-pink">
                    <div class="card-info">
                        <span class="card-value"><?= $tersedia; ?></span>
                        <span class="card-title">Tersedia</span>
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
        </div>

        <div id="content-riwayat" class="content-section">    
            <section class="info-list-section" style="background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03); border: 1px solid rgba(0, 0, 0, 0.05); width: 100%; box-sizing: border-box;">
                
                <div class="riwayat-header" style="margin-bottom: 24px; text-align: center;">
                    <h2 style="font-size: 2.18rem; font-weight: 700; color: #1e3a8a; margin-bottom: 10px;">Riwayat Peminjaman Jas</h2>
                    <p style="font-size: 0.875rem; color: #6c757d; margin: 15px;">Daftar seluruh peminjaman yang pernah dilakukan</p>
                </div>
                
                <div class="table-wrapper" style="width: 100%; overflow-x: auto;">
                    
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem; min-width: 800px;">
                        <thead>
                            <tr style="background-color: #f8f9fa; border-bottom: 2px solid #edf2f7;">
                                <th style="padding: 16px; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; width: 5%;">No</th>
                                <th style="padding: 16px; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; width: 25%;">Nama</th>
                                <th style="padding: 16px; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; width: 30%;">Jas</th>
                                <th style="padding: 16px; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; width: 15%;">Tanggal Pinjam</th>
                                <th style="padding: 16px; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; width: 15%;">Tanggal Kembali</th>
                                <th style="padding: 16px; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; width: 10%;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        if ($query_riwayat && mysqli_num_rows($query_riwayat) > 0) {
                            while ($row = mysqli_fetch_assoc($query_riwayat)) {
                        ?>
                            <tr style="border-bottom: 1px solid #edf2f7; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#fcfcff'" onmouseout="this.style.backgroundColor='transparent'">
                                <td style="padding: 16px; color: #495057;"><?= $no++; ?></td>
                                <td style="padding: 16px; color: #1a1d20; font-weight: 500;"><?= htmlspecialchars($row['nama_mahasiswa']); ?></td>
                                <td style="padding: 16px; color: #5D50C6; font-weight: 600;"><?= htmlspecialchars($row['nama_jas']); ?></td>
                                <td style="padding: 16px; color: #495057;"><?= date('d M Y', strtotime($row['tanggal_pinjam'])); ?></td>
                                <td style="padding: 16px; color: #495057;">
                                    <?= ($row['tanggal_kembali'] && $row['tanggal_kembali'] != '0000-00-00') ? date('d M Y', strtotime($row['tanggal_kembali'])) : '<span style="color:#adb5bd;">-</span>'; ?>
                                </td>
                                <td style="padding: 16px;">
                                    <?php if (strtolower($row['status']) == 'menunggu') { ?>
                                        <span class="status waiting">Menunggu</span>
                                    <?php } elseif (strtolower($row['status']) == 'sedang dipinjam' || strtolower($row['status']) == 'disetujui' || strtolower($row['status']) == 'selesai') { ?>
                                        <span class="status approved">Disetujui</span>
                                    <?php } else { ?>
                                        <span class="status rejected">Ditolak</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='6' style='text-align:center; padding: 40px; color: #6c757d; font-weight: 500;'>Belum ada riwayat transaksi peminjaman.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

    </main>
</div>

<script>
function switchHalaman(targetMenu) {
    // Sembunyikan semua section konten
    document.getElementById('content-dashboard').classList.remove('section-active');
    document.getElementById('content-riwayat').classList.remove('section-active');

    // Hapus status aktif dari semua menu
    document.getElementById('btn-dashboard').classList.remove('active');
    document.getElementById('btn-riwayat').classList.remove('active');

    if (targetMenu === 'menu-dashboard') {
        document.getElementById('content-dashboard').classList.add('section-active');
        document.getElementById('btn-dashboard').classList.add('active');
        document.getElementById('main-page-title').innerText = 'Dashboard';
    } else if (targetMenu === 'menu-riwayat') {
        document.getElementById('content-riwayat').classList.add('section-active');
        document.getElementById('btn-riwayat').classList.add('active');
        document.getElementById('main-page-title').innerText = 'Riwayat Peminjaman';
    }
}
</script>

</body>
</html>