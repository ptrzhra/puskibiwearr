<?php
session_start();

include '../config/koneksi.php';

// proteksi admin
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

// update status
if(isset($_GET['aksi']) && isset($_GET['id'])){

    $id = $_GET['id'];
    $aksi = $_GET['aksi'];

    if($aksi == "terima"){
        mysqli_query($conn, "UPDATE peminjaman SET status='disetujui' WHERE id_pinjam='$id'");
    }

    if($aksi == "tolak"){
        mysqli_query($conn, "UPDATE peminjaman SET status='ditolak' WHERE id_pinjam='$id'");
    }

    header("Location: verifikasi.php");
    exit;
}

// ambil data peminjaman
$data = mysqli_query($conn, "
    SELECT
        p.*,
        j.nama_jas,
        u.nama,
        jm.file_jaminan
    FROM peminjaman p
    JOIN jas j ON p.id_jas = j.id_jas
    JOIN users u ON p.id_user = u.id
    LEFT JOIN jaminan jm ON p.id_user = jm.id_user
    WHERE p.status='menunggu'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Verifikasi Peminjaman</title>
<link rel="stylesheet" href="admin.css">
</head>

<body>

<div class="verify-wrapper">

    <div class="verify-card">

        <h2>Verifikasi Peminjaman</h2>
        <p>Kelola permintaan peminjaman jas</p>

        <table>
            <tr>
            <tr>
            <th>Nama User</th>
            <th>Nama Jas</th>
            <th>Tanggal Pinjam</th>
            <th>Jaminan</th>
            <th>Aksi</th>
        </tr>       
            <?php while($row = mysqli_fetch_assoc($data)) { ?>

            <tr>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['nama_jas']; ?></td>
                <td><?= $row['tanggal_pinjam']; ?></td>
            
                <td>
            <?php if(!empty($row['file_jaminan'])){ ?>
                <a href="../uploads/jaminan/<?= $row['file_jaminan']; ?>"
                target="_blank"
                class="btn-view">
                Lihat Jaminan
                </a>
            <?php } else { ?>
                Belum Upload
            <?php } ?>
            </td>

            <td>
                    <a href="?aksi=terima&id=<?= $row['id_pinjam']; ?>" class="btn-accept">Terima</a>
                    <a href="?aksi=tolak&id=<?= $row['id_pinjam']; ?>" class="btn-reject">Tolak</a>
                </td>
            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>