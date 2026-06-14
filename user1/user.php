<?php
session_start();

include '../config/koneksi.php';

// cek login
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id'];

$query = mysqli_query($conn,
"SELECT * FROM users WHERE id='$id'");

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>User Profile</title>

<link rel="stylesheet" href="user.css">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
 
<body class="profile-page-body">
<body>

<div class="profile-container">

    <div class="profile-card">

        <div class="profile-header">

            <div class="profile-avatar">
                <?= strtoupper(substr($data['nama'],0,1)); ?>
            </div>

            <h2><?= $data['nama']; ?></h2>

            <p><?= $data['email']; ?></p>

        </div>

        <div class="profile-info">

            <div class="info-item">
                <span>NPM</span>
                <strong><?= $data['npm']; ?></strong>
            </div>

            <div class="info-item">
                <span>Role</span>
                <strong><?= $data['role']; ?></strong>
            </div>

            <div class="info-item">
                <span>Email</span>
                <strong><?= $data['email']; ?></strong>
            </div>

        </div>

        <a href="logout.php" class="logout-btn">
            Logout
        </a>

    </div>

</div>

</body>
</html>