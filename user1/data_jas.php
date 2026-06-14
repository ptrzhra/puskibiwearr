<?php
session_start();

include '../config/koneksi.php';

// cek login
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

// ambil data hanya 3 jas (tanpa Jas Formal Hitam)
$query = mysqli_query($conn, "
    SELECT * FROM jas
    WHERE nama_jas IN ('JAS SEMPRO','Jas Praktikum','Jas Almamater Biru')
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Jas - PuskibiWear</title>

<link rel="stylesheet" href="user.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>

<div class="jas-container">

    <!-- HEADER -->
    <div class="jas-header">
        <h1>Data Jas</h1>
        <p>Daftar jas yang tersedia di PuskibiWear</p>
    </div>

    <!-- GRID -->
    <div class="jas-grid">

        <?php while($row = mysqli_fetch_assoc($query)) { 

        $foto = !empty($row['foto']) ? $row['foto'] : 'default.png';
        $path = "../assets/img/" . $foto;

            if(!file_exists($path)){
                $path = "https://via.placeholder.com/300x220.png?text=No+Image";
            }
        ?>

        <div class="jas-card">

            <div class="jas-image">
            <img src="<?= $path; ?>" alt="foto jas">
            </div>

            <div class="jas-content">

                <h3><?= $row['nama_jas']; ?></h3>

                <div class="jas-info">
                    <span>Ukuran: <?= $row['ukuran']; ?></span>
                    <span>Warna: <?= $row['warna']; ?></span>
                </div>

                <p><?= $row['deskripsi']; ?></p>

                <div class="jas-footer">

                    <div>
                        <h4>Rp<?= number_format($row['harga']); ?></h4>
                        <small>Stok: <?= $row['stok']; ?></small>
                    </div>

                    <a href="peminjaman.php?id=<?= $row['id_jas']; ?>" class="btn-pinjam">
                        Pinjam
                    </a>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</div>

</body>
</html>