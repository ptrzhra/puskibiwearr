<?php
session_start();

include '../config/koneksi.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($query) > 0){

        $data = mysqli_fetch_assoc($query);

        // Cek password
        if($password == $data['password']){

            // Ubah role menjadi huruf kecil
            $role_db = strtolower($data['role']);

            // Simpan session
            $_SESSION['login'] = true;
            $_SESSION['id'] = $data['id'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['role'] = $role_db;

            // Redirect berdasarkan role
            if($role_db == 'admin'){
                header("Location: ../admin1/dashboard_admin.php");
            } elseif($role_db == 'mahasiswa'){
                header("Location: dashboard.php");
            } else {
                die("Role tidak dikenali: " . $role_db);
            }

            exit;

        } else {
            echo "<script>alert('Password salah');</script>";
        }

    } else {
        echo "<script>alert('Email tidak ditemukan');</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="user.css">
</head>
<body>

<div class="auth-wrapper">
    <div class="container">
        <h2>Login</h2>
        <p class="subtitle">
           Halo, Masuk ke akun PuskibiWear
        </p>

        <form method="POST">
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" name="login">
                Login
            </button>

            <p style="text-align: center; margin-top: 15px; font-size: 14px; color: #64748b;">
            Belum memiliki akun?
            <a href="register.php" style="color: #2563eb; font-weight: 600; text-decoration: none;">Register</a>
            </p>
        </form>
        
    </div>
</div>

</body>
</html>