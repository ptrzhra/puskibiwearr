<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id'];

// Query untuk mengambil data denda milik user
$query = mysqli_query($conn,"
    SELECT p.*, j.nama_jas
    FROM peminjaman p
    JOIN jas j ON p.id_jas = j.id_jas
    WHERE p.id_user='$id_user'
    AND p.denda > 0
    ORDER BY p.id_pinjam DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Denda Saya - PuskibiWear</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>

<div class="denda-container">
    <div class="denda-card">
        <div class="denda-header">
            <h2>Denda Peminjaman</h2>
            <p>Silakan segera selesaikan pembayaran denda Anda.</p>
        </div>

        <div class="table-wrapper">
            <table class="denda-table">
                <thead>
                    <tr>
                        <th>Nama Jas</th>
                        <th>Tgl Kembali</th>
                        <th>Denda</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($query)){ ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama_jas']); ?></td>
                        <td><?= htmlspecialchars($row['tanggal_kembali']); ?></td>
                        <td>Rp <?= number_format($row['denda']); ?></td>
                        <td>
                            <span class="badge-belum">Belum Dibayar</span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>