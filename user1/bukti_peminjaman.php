<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id'];

$query = mysqli_query($conn,"
SELECT
    p.*,
    u.nama,
    j.nama_jas
FROM peminjaman p
JOIN users u ON p.id_user=u.id
JOIN jas j ON p.id_jas=j.id_jas
WHERE p.id_user='$id_user'
AND p.status='disetujui'
ORDER BY p.id_pinjam DESC
LIMIT 1
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Belum ada peminjaman yang disetujui.");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Bukti Peminjaman</title>
<link rel="stylesheet" href="user.css">
</head>

<body>

<div class="bukti-container">

    <div class="kop">
        <h1>PUSKIBIWEAR</h1>
        <p>Sistem Penyewaan Jas Kampus</p>
    </div>

    <div class="judul">
        <h2>BUKTI PEMINJAMAN JAS</h2>
        <span>No. PJM-<?= str_pad($data['id_pinjam'],5,'0',STR_PAD_LEFT); ?></span>
    </div>

    <div class="detail-box">

        <div class="item">
            <label>Nama Mahasiswa</label>
            <span><?= $data['nama']; ?></span>
        </div>

        <div class="item">
            <label>Nama Jas</label>
            <span><?= $data['nama_jas']; ?></span>
        </div>

        <div class="item">
            <label>Tanggal Pinjam</label>
            <span><?= date('d F Y', strtotime($data['tanggal_pinjam'])); ?></span>
        </div>

        <div class="item">
            <label>Tanggal Kembali</label>
            <span><?= date('d F Y', strtotime($data['tanggal_kembali'])); ?></span>
        </div>

        <div class="item">
            <label>Status</label>
            <span class="status">
                <?= strtoupper($data['status']); ?>
            </span>
        </div>

    </div>

    <div class="aturan">
        <h3>Ketentuan Peminjaman</h3>

        <ul>
            <li>Jas wajib dikembalikan tepat waktu.</li>
            <li>Keterlambatan akan dikenakan denda sesuai ketentuan.</li>
            <li>Jas harus dikembalikan dalam kondisi baik.</li>
            <li>Bukti ini wajib ditunjukkan saat pengambilan jas.</li>
        </ul>
    </div>

    <div class="ttd">

        <div class="kolom">
            <p>Admin Puskibi</p>
            <br><br><br>
            <span>________________</span>
        </div>

        <div class="kolom">
            <p>Mahasiswa</p>
            <br><br><br>
            <span><?= $data['nama']; ?></span>
        </div>

    </div>

    <button onclick="window.print()" class="btn-print">
        Cetak Bukti
    </button>

</div>

</body>
</html>