<?php

include '../config/koneksi.php';

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $npm = $_POST['npm'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cek = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($cek) > 0){

        echo "<script>
        alert('Email sudah digunakan');
        </script>";

    } else {

        $insert = mysqli_query($conn,

        "INSERT INTO users(nama,npm,email,password)

        VALUES(
        '$nama',
        '$npm',
        '$email',
        '$password'
        )"

        );

        if($insert){

            echo "<script>
            alert('Registrasi berhasil');
            window.location='login.php';
            </script>";

        } else {

            echo "<script>
            alert('Registrasi gagal');
            </script>";

        }

    }

}

?>

<?php

include '../config/koneksi.php';

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $npm = $_POST['npm'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cek = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($cek) > 0){

        echo "<script>
        alert('Email sudah digunakan');
        </script>";

    } else {

        $insert = mysqli_query($conn,

        "INSERT INTO users(nama,npm,email,password)

        VALUES(
        '$nama',
        '$npm',
        '$email',
        '$password'
        )"

        );

        if($insert){

            echo "<script>
            alert('Registrasi berhasil');
            window.location='login.php';
            </script>";

        } else {

            echo "<script>
            alert('Registrasi gagal');
            </script>";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register PuskibiWear</title>

    <link rel="stylesheet" href="user.css">

</head>

<body>
    

<div class="container">

    <h2>Register PuskibiWear</h2>

    <p class="subtitle">
        Buat akun untuk melakukan penyewaan jas kampus
    </p>

    <form method="POST">

        <div class="input-group">
            <label>Nama Lengkap</label>
            <input
            type="text"
            name="nama"
            placeholder="Masukkan nama lengkap"
            required>
        </div>

        <div class="input-group">
            <label>NPM</label>
            <input
            type="text"
            name="npm"
            placeholder="Masukkan NPM"
            required>
        </div>

        <div class="input-group">
            <label>Email</label>
            <input
            type="email"
            name="email"
            placeholder="Masukkan email"
            required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input
            type="password"
            name="password"
            placeholder="Masukkan Password"
            required>
        </div>

        <button type="submit" name="register">
            Register
        </button>

        <div style="width: 100%; text-align: center; margin-top: 20px;">
         Sudah punya akun?
        <a href="login.php" style="text-decoration: none; color: #2563eb; font-weight: 600;">Login</a>
</div>

    </form>

</div>

</body>
</html>