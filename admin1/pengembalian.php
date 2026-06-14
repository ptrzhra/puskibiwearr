<?php
session_start();
include '../config/koneksi.php';

// proteksi admin
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

// proses pengembalian
if(isset($_GET['kembali'])){
    $id = $_GET['kembali'];

    // ambil data peminjaman
    $ambil = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_pinjam='$id'");
    $data = mysqli_fetch_assoc($ambil);

    if($data){
        $tgl_kembali = $data['tanggal_kembali'];
        $hari_ini = date('Y-m-d');

        $keterlambatan = 0;
        $denda = 0;

        // hitung keterlambatan untuk disimpan ke database
        if(strtotime($hari_ini) > strtotime($tgl_kembali)){
            $keterlambatan = floor((strtotime($hari_ini) - strtotime($tgl_kembali)) / (60*60*24));
            $denda = $keterlambatan * 2000;
        }

        // simpan ke tabel pengembalian
$insert_query = "INSERT INTO pengembalian (id_pinjam, tanggal_dikembalikan, kondisi_jas, keterlambatan, denda, catatan) 
                 VALUES ('".$data['id_pinjam']."', '$hari_ini', 'Baik', '$keterlambatan', '$denda', '-')";

        if (!mysqli_query($conn, $insert_query)) {
            die("Error di tabel pengembalian: " . mysqli_error($conn));
        }

        // update status peminjaman
        mysqli_query($conn,"
            UPDATE peminjaman
            SET status='dikembalikan',
                tanggal_dikembalikan='$hari_ini',
                denda='$denda'
            WHERE id_pinjam='$id'
        ");

        // kembalikan stok jas
        mysqli_query($conn,"
            UPDATE jas
            SET stok = stok + 1
            WHERE id_jas='".$data['id_jas']."'
        ");

        echo "<script>
            alert('Jas berhasil dikembalikan');
            window.location='pengembalian.php';
        </script>";
        exit;
    }
}

// ambil data peminjaman
$query = mysqli_query($conn, "
    SELECT p.*, u.nama, j.nama_jas
    FROM peminjaman p
    LEFT JOIN users u ON p.id_user = u.id
    LEFT JOIN jas j ON p.id_jas = j.id_jas
    WHERE p.status IN ('disetujui', 'dikembalikan')
    ORDER BY p.status ASC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Jas</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="return-container">
    <div class="return-title">
        <h1>Pengembalian Jas</h1>
        <p>Kelola pengembalian jas mahasiswa</p>
    </div>

    <div class="return-card">
        <table class="return-table">
            <thead>
                <tr>
                    <th>Mahasiswa</th>
                    <th>Nama Jas</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Denda</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($query)) { 

                // --- LOGIKA DENDA OTOMATIS ---
                $denda_tampil = $row['denda']; 
                $status_telat = false;
                $hari_telat = 0;

                // Hanya hitung otomatis jika status masih 'disetujui'
                if(($row['status'] ?? '') == 'disetujui') {
                    $tgl_kembali = strtotime($row['tanggal_kembali']);
                    $hari_ini = strtotime(date('Y-m-d'));
                    
                    if($hari_ini > $tgl_kembali) {
                        $hari_telat = floor(($hari_ini - $tgl_kembali) / (60 * 60 * 24));
                        $denda_tampil = $hari_telat * 2000;
                        $status_telat = true;
                    } else {
                        $denda_tampil = 0;
                    }
                }
            ?>
                <tr>
                    <td>
                        <div class="user-box">
                            <div class="user-avatar">
                                <?= isset($row['nama']) ? strtoupper(substr($row['nama'], 0, 1)) : '-' ; ?>
                            </div>
                            <?= $row['nama'] ?? 'User Tidak Ditemukan'; ?>
                        </div>
                    </td>
                    <td><?= $row['nama_jas'] ?? 'Jas Tidak Ditemukan'; ?></td>
                    <td><?= $row['tanggal_pinjam'] ?? '-'; ?></td>
                    <td><?= $row['tanggal_kembali'] ?? '-'; ?></td>
                    
                    <td>
                        Rp <?= number_format($denda_tampil); ?>
                        <?php if($status_telat) { ?>
                            <br><small style="color: red; font-weight: bold;">Telat <?= $hari_telat ?> hari</small>
                        <?php } ?>
                    </td>

                    <td>
                        <span class="status-success">
                            <?= $row['status'] ?? '-'; ?>
                        </span>
                    </td>
                    <td>
                        <?php if(($row['status'] ?? '') == 'disetujui') { ?>
                            <a href="?kembali=<?= $row['id_pinjam'] ?? '#'; ?>" 
                               class="btn-return" 
                               onclick="return confirm('Yakin ingin mengembalikan jas ini?')">
                               Kembalikan
                            </a>
                        <?php } else { ?>
                            <span style="color: #94a3b8; font-style: italic;">Sudah Selesai</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>