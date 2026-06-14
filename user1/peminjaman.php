<?php
session_start();

include '../config/koneksi.php';

// cek login
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

// cek id jas
if(!isset($_GET['id'])){
    header("Location: jas.php");
    exit;
}

$id_jas = $_GET['id'];

// ambil data jas
$query = mysqli_query($conn,
"SELECT * FROM jas WHERE id_jas='$id_jas'");

$jas = mysqli_fetch_assoc($query);

// proses pinjam
if(isset($_POST['pinjam'])){

    $id_user = $_SESSION['id'];

    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // cek stok
    if($jas['stok'] > 0){

        mysqli_query($conn, "
        INSERT INTO peminjaman
        (id_user,id_jas,tanggal_pinjam,tanggal_kembali,status)
        VALUES
        ('$id_user','$id_jas','$tanggal_pinjam','$tanggal_kembali','menunggu')
        ");

        // kurangi stok
        mysqli_query($conn,
        "UPDATE jas SET stok=stok-1
        WHERE id_jas='$id_jas'");

        echo "
        <script>
        alert('Peminjaman berhasil!');
        window.location='dashboard.php?page=riwayat';
        </script>
        ";

    } else {

        echo "
        <script>
        alert('Stok jas habis!');
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Form Peminjaman</title>

<link rel="stylesheet" href="user.css">
</head>

<body>

<div class="form-pinjam-container">

    <div class="form-pinjam-card">

        <!-- FOTO -->
        <div class="pinjam-image">

            <?php if($jas['foto'] != NULL){ ?>

                <img src="../assets/img/<?= $jas['foto']; ?>">

            <?php } else { ?>

                <img src="https://via.placeholder.com/400x300">

            <?php } ?>

        </div>

        <!-- CONTENT -->
        <div class="pinjam-content">

            <h1><?= $jas['nama_jas']; ?></h1>

            <div class="detail-pinjam">

                <span>Ukuran : <?= $jas['ukuran']; ?></span>

                <span>Warna : <?= $jas['warna']; ?></span>

                <span>Stok : <?= $jas['stok']; ?></span>

            </div>

            <h2>
                Rp<?= number_format($jas['harga']); ?>
            </h2>

            <p>
                <?= $jas['deskripsi']; ?>
            </p>

            <!-- FORM -->
            <form method="POST">

                <div class="input-group">

                    <label>Tanggal Pinjam</label>

                    <input type="date"
                           name="tanggal_pinjam"
                           required>

                </div>

                <div class="input-group">

                    <label>Tanggal Kembali</label>

                    <input type="date"
                           name="tanggal_kembali"
                           required>

                </div>

                <button type="submit"
                        name="pinjam"
                        class="btn-submit">

                    Konfirmasi Peminjaman

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>