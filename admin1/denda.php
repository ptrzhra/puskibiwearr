<?php
session_start();
include '../config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: ../user/login.php");
    exit;
}

// Query mengambil data
$query = mysqli_query($conn, "
    SELECT p.*, u.nama, j.nama_jas
    FROM peminjaman p
    LEFT JOIN users u ON p.id_user = u.id
    LEFT JOIN jas j ON p.id_jas = j.id_jas
    WHERE (p.status = 'disetujui' AND p.tanggal_kembali < CURDATE())
    OR (p.status = 'dikembalikan' AND p.denda > 0)
    ORDER BY p.tanggal_kembali ASC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Denda Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="denda-wrapper">
    <div class="denda-card">
        <h2>Daftar Mahasiswa Terkena Denda</h2>

        <?php 
        // Kita hitung totalnya dulu sebelum looping agar bisa tampil di atas
        $total_denda_keseluruhan = 0;
        $data_rows = [];
        while($row = mysqli_fetch_assoc($query)) {
            $denda_hitung = $row['denda'];
            if($row['status'] == 'disetujui') {
                $tgl_kembali = strtotime($row['tanggal_kembali']);
                $hari_ini = strtotime(date('Y-m-d'));
                if($hari_ini > $tgl_kembali) {
                    $selisih = floor(($hari_ini - $tgl_kembali) / (60 * 60 * 24));
                    $denda_hitung = $selisih * 2000;
                }
            }
            $row['denda_hitung'] = $denda_hitung;
            $total_denda_keseluruhan += $denda_hitung;
            $data_rows[] = $row;
        }
        ?>

        <div class="total-box">
            Total Potensi Denda : Rp <?= number_format($total_denda_keseluruhan); ?>
        </div>

        <table class="denda-table">
            <thead>
                <tr>
                    <th>Mahasiswa</th>
                    <th>Nama Jas</th>
                    <th>Batas Kembali</th>
                    <th>Denda</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data_rows as $row) { ?>
            <tr>
                <td><?= $row['nama'] ?? '-'; ?></td>
                <td><?= $row['nama_jas'] ?? '-'; ?></td>
                <td><?= $row['tanggal_kembali']; ?></td>
                <td>Rp <?= number_format($row['denda_hitung']); ?></td>
                <td>
                    <span class="badge-denda">
                        <?= ($row['status'] == 'disetujui') ? 'Terlambat' : 'Selesai'; ?>
                    </span>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>