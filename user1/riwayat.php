<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id'];

$query = mysqli_query($conn, "
SELECT 
    peminjaman.*,
    jas.nama_jas
FROM peminjaman
JOIN jas ON peminjaman.id_jas = jas.id_jas
WHERE peminjaman.id_user = '$id_user'
ORDER BY peminjaman.id_pinjam DESC
");

$nama_user = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Riwayat</title>
<link rel="stylesheet" href="../admin1/admin.css">
</head>

<body>

<div class="admin-container">

<!-- SIDEBAR (SAMA SEPERTI DASHBOARD) -->
<aside class="sidebar">
    <div class="logo-section">
        <span class="logo-icon">P</span>
        <span class="logo-text">PuskibiWear</span>
    </div>

    <a href="data_jas.php" class="btn-create-pitch">Sewa Jas</a>

    <nav class="nav-menu">
        <a href="dashboard.php" class="nav-item">Dashboard</a>
        <a href="riwayat.php" class="nav-item active">Riwayat</a>
        <a href="data_jas.php" class="nav-item">Data Jas</a>
    </nav>
</aside>

<!-- CONTENT -->
<main class="main-content">

<h2>Riwayat Peminjaman</h2>

<table border="1" width="100%" style="margin-top:20px;">
<tr>
    <th>No</th>
    <th>Nama Jas</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Status</th>
    <th>Denda</th>
</tr>

<?php $no=1; while($row=mysqli_fetch_assoc($query)) { ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['nama_jas'] ?></td>
    <td><?= $row['tanggal_pinjam'] ?></td>
    <td><?= $row['tanggal_kembali'] ?></td>
    <td><?= $row['status'] ?></td>
    <td>Rp <?= number_format($row['denda']); ?>
</td>
</tr>
<?php } ?>

</table>

</main>

</div>

</body>
</html>