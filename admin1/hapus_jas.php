<?php
session_start();
include '../config/koneksi.php';

// Proteksi akses
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Ambil data untuk hapus foto
    $query_data = mysqli_query($conn, "SELECT * FROM jas WHERE id_jas='$id'");
    $data = mysqli_fetch_assoc($query_data);

    if($data){
        // Hapus file foto jika ada
        if($data['foto'] != "" && file_exists("../assets/img/".$data['foto'])){
            unlink("../assets/img/".$data['foto']);
        }

        // Hapus data dari database
        mysqli_query($conn, "DELETE FROM jas WHERE id_jas='$id'");
    }
}

// Langsung kembali ke halaman utama
header("Location: tampil_jas.php");
exit;
?>