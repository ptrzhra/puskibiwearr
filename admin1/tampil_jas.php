<?php
session_start();

include '../config/koneksi.php';

// proteksi admin
if(
   !isset($_SESSION['login']) ||
   $_SESSION['role'] != 'admin'
){
   header("Location: ../login.php");
   exit;
}

// ambil data jas
$query = mysqli_query($conn, "SELECT * FROM jas");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Data Jas</title>

<link rel="stylesheet" href="admin.css">
</head>

<body>

<div class="table-container">
<div class="table-box">

    <h2>Data Jas</h2>

    <table>

        <tr>
            <th>No</th>
            <th>Nama Jas</th>
            <th>Ukuran</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;

        while($data = mysqli_fetch_assoc($query)){
        ?>

        <tr>

            <td><?= $no++; ?></td>

            <td><?= $data['nama_jas']; ?></td>

            <td><?= $data['ukuran']; ?></td>

            <td><?= $data['stok']; ?></td>

            <td>Rp<?= number_format($data['harga']); ?></td>

            <td>
    <div class="btn-group">
        <a href="edit_jas.php?id=<?= $data['id_jas']; ?>" class="btn-edit">Edit</a>
        <a href="hapus_jas.php?id=<?= $data['id_jas']; ?>" class="btn-delete">Hapus</a>
    </div>
</td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>