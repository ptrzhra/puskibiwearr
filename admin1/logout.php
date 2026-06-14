<?php
session_start();

// Hapus semua data session
$_SESSION = array();

// Hancurkan session di server
session_destroy();

// PENTING: Sesuaikan dengan proteksi dashboard kamu yang mengarah ke folder user
header("Location: ../user1/login.php");
exit;