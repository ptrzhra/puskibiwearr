<?php
session_start();

include '../config/koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

// CEK ID
if(!isset($_GET['id']) || $_GET['id'] == ''){
    die("ID tidak ditemukan");
}

$id = $_GET['id'];

// AMBIL DATA
$query = mysqli_query($conn, "SELECT * FROM jas WHERE id_jas='$id'");

if(mysqli_num_rows($query) == 0){
    die("Data tidak ditemukan");
}

$data = mysqli_fetch_assoc($query);

// UPDATE
if(isset($_POST['update'])){

    $nama_jas  = $_POST['nama_jas'];
    $ukuran    = $_POST['ukuran'];
    $warna     = $_POST['warna'];
    $stok      = $_POST['stok'];
    $harga     = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    if($_FILES['foto']['name'] != ""){

        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp,"../assets/img/".$foto);

        mysqli_query($conn,"UPDATE jas SET
        nama_jas='$nama_jas',
        ukuran='$ukuran',
        warna='$warna',
        stok='$stok',
        harga='$harga',
        deskripsi='$deskripsi',
        foto='$foto'
        WHERE id_jas='$id'");

    } else {

        mysqli_query($conn,"UPDATE jas SET
        nama_jas='$nama_jas',
        ukuran='$ukuran',
        warna='$warna',
        stok='$stok',
        harga='$harga',
        deskripsi='$deskripsi'
        WHERE id_jas='$id'");
    }

    echo "<script>alert('Berhasil update'); window.location='tampil_jas.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Jas</title>
<link rel="stylesheet" href="admin.css">
</head>

<body>

<div class="edit-wrapper">

    <div class="edit-card">

        <h2>Edit Jas</h2>
        <p>Perbarui data jas</p>

        <!-- INFO -->
        <div class="preview-box">
            <b>Data Saat Ini:</b><br>
            Nama: <?= $data['nama_jas']; ?> <br>
            Stok: <?= $data['stok']; ?> <br>
            Harga: Rp<?= number_format($data['harga']); ?>
        </div>

        <form method="POST" enctype="multipart/form-data">

            <input type="text" name="nama_jas" value="<?= $data['nama_jas']; ?>" required>

            <select name="ukuran">
                <option value="S" <?= $data['ukuran']=="S"?"selected":""; ?>>S</option>
                <option value="M" <?= $data['ukuran']=="M"?"selected":""; ?>>M</option>
                <option value="L" <?= $data['ukuran']=="L"?"selected":""; ?>>L</option>
                <option value="XL" <?= $data['ukuran']=="XL"?"selected":""; ?>>XL</option>
            </select>

            <input type="text" name="warna" value="<?= $data['warna']; ?>">

            <input type="number" name="stok" value="<?= $data['stok']; ?>">

            <input type="number" name="harga" value="<?= $data['harga']; ?>">

            <textarea name="deskripsi"><?= $data['deskripsi']; ?></textarea>

            <input type="file" name="foto">

            <button class="btn-update" type="submit" name="update">
                Update Data
            </button>

        </form>

    </div>

</div>

</body>
</html>