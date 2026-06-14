<?php
session_start();

include '../config/koneksi.php';

// cek login admin
if(
    !isset($_SESSION['login']) ||
    $_SESSION['role'] != 'admin'
){
    header("Location: ../login.php");
    exit;
}


// proteksi admin
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

// proses tambah jas
if(isset($_POST['simpan'])){

    $nama_jas = $_POST['nama_jas'];
    $ukuran = $_POST['ukuran'];
    $warna = $_POST['warna'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // upload foto
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    if($foto != ""){
        move_uploaded_file($tmp, "../assets/img/" . $foto);
    }

    mysqli_query($conn, "
        INSERT INTO jas
        (nama_jas, ukuran, warna, stok, harga, deskripsi, foto)
        VALUES
        ('$nama_jas','$ukuran','$warna','$stok','$harga','$deskripsi','$foto')
    ");

    echo "
    <script>
        alert('Data jas berhasil ditambahkan');
        window.location='tambah_jas.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Jas</title>

<link rel="stylesheet" href="admin.css">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>

<div class="form-page">

    <div class="form-card">

        <h1>Tambah Jas</h1>

        <p>
            Tambahkan data jas baru ke sistem PuskibiWear
        </p>

        <form method="POST" enctype="multipart/form-data">

    <!-- Wrapper Grid Baru untuk membagi kolom -->
    <div class="form-grid">
        
        <!-- KOLOM KIRI -->
        <div class="form-column">
            <!-- Nama Jas -->
            <div class="form-group">
                <label>Nama Jas</label>
                <input type="text" name="nama_jas" placeholder="Masukkan nama jas" required>
            </div>

            <!-- Ukuran -->
            <div class="form-group">
                <label>Ukuran</label>
                <select name="ukuran" required>
                    <option value="">-- Pilih Ukuran --</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
            </div>

            <!-- Warna -->
            <div class="form-group">
                <label>Warna</label>
                <input type="text" name="warna" placeholder="Masukkan warna jas" required>
            </div>
        </div>

        <!-- KOLOM KANAN -->
        <div class="form-column">
            <!-- Stok -->
            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" placeholder="Masukkan stok" required>
            </div>

            <!-- Harga -->
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" placeholder="Masukkan harga" required>
            </div>

            <!-- Foto -->
            <div class="form-group">
                <label>Foto Jas</label>
                <input type="file" name="foto">
            </div>
        </div>

    </div>

    <!-- Deskripsi (Tetap di bawah full-width agar mengetik bisa luas) -->
    <div class="form-group full-width">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="3" placeholder="Masukkan deskripsi jas"></textarea>
    </div>

    <!-- BUTTON -->
    <button type="submit" name="simpan" class="btn-save">Simpan Jas</button>

</form>

    </div>

</div>

</body>
</html>