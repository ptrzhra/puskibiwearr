<?php
session_start();

include '../config/koneksi.php';

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id'];

/* AMBIL DATA JAS */
$jas = mysqli_query($conn, "SELECT * FROM jas");

/* PROSES BOOKING */
if(isset($_POST['booking'])){

    $id_jas = $_POST['id_jas'];
    $tanggal_pakai = $_POST['tanggal_pakai'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    /* UPLOAD JAMINAN */
    $file = $_FILES['jaminan']['name'];
    $tmp = $_FILES['jaminan']['tmp_name'];
    $folder = "uploads/".$file;

    move_uploaded_file($tmp, $folder);

    $insert = mysqli_query($conn,
    "INSERT INTO booking(id_user,id_jas,tanggal_pakai,tanggal_kembali,jaminan)
    VALUES('$id_user','$id_jas','$tanggal_pakai','$tanggal_kembali','$file')");

    if($insert){
        echo "<script>alert('Booking berhasil!'); window.location='riwayat.php';</script>";
    } else {
        echo "<script>alert('Booking gagal!');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Jas</title>
    <link rel="stylesheet" href="user.css">
</head>

<body>

<div class="booking-container">

    <h2>Booking Jas</h2>
    <p>Pilih jas dan isi data peminjaman</p>

    <form method="POST" enctype="multipart/form-data">

        <label>Pilih Jas</label>
        <select name="id_jas" required>
            <option value="">-- Pilih Jas --</option>

            <?php while($row = mysqli_fetch_assoc($jas)){ ?>
                <option value="<?= $row['id_jas'] ?>">
                    <?= $row['nama_jas'] ?> (<?= $row['ukuran'] ?>)
                </option>
            <?php } ?>

        </select>

        <label>Tanggal Pakai</label>
        <input type="date" name="tanggal_pakai" required>

        <label>Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" required>

        <label>Upload Jaminan (KTM / Bukti)</label>
        <input type="file" name="jaminan" required>

        <button type="submit" name="booking">
            Booking Sekarang
        </button>

    </form>

</div>

</body>
</html>