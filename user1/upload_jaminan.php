<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$pesan = "";

if(isset($_POST['upload'])){

    $id_user = $_SESSION['id'];

    $namaFile = $_FILES['jaminan']['name'];
    $tmpFile  = $_FILES['jaminan']['tmp_name'];
    $sizeFile = $_FILES['jaminan']['size'];

    $ekstensiValid = ['jpg','jpeg','png'];
    $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    if(!in_array($ekstensi, $ekstensiValid)){
        $pesan = "Format harus JPG, JPEG atau PNG!";
    }
    elseif($sizeFile > 2000000){
        $pesan = "Ukuran maksimal 2MB!";
    }
    else{

        $namaBaru = time().'_'.$namaFile;

        $folder = "../uploads/jaminan/";

        move_uploaded_file(
            $tmpFile,
            $folder.$namaBaru
        );

        mysqli_query($conn,"
        INSERT INTO jaminan(
            id_user,
            file_jaminan,
            tanggal_upload
        )
        VALUES(
            '$id_user',
            '$namaBaru',
            NOW()
        )
        ");

        $pesan = "Upload berhasil!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Jaminan</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>

<div class="container">

    <div class="card">

        <h2>Upload Jaminan</h2>

        <?php if($pesan != ""): ?>
            <div class="alert">
                <?= $pesan ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">


        <div class="sidebar-footer-box">
    <p>
        Pastikan foto KTM atau identitas terlihat jelas sebelum diunggah.
    </p>
</div>
            <label>Upload Foto KTM / Jaminan</label>

            <input
                type="file"
                name="jaminan"
                id="jaminan"
                accept="image/*"
                required
            >

            <div class="preview-box">
                <img id="preview">
            </div>

            <button type="submit" name="upload">
                Upload Jaminan
            </button>

        </form>

    </div>

</div>

<script>
document
.getElementById("jaminan")
.addEventListener("change", function(e){

    const file = e.target.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(event){

            document.getElementById("preview").src =
            event.target.result;

            document.getElementById("preview").style.display =
            "block";
        }

        reader.readAsDataURL(file);
    }
});
</script>

</body>
</html>