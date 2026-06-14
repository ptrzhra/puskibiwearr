<?php
session_start(); 
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puskibiwear - Sewa Jas Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-[#f8faff] dark:bg-slate-900 text-slate-800 dark:text-slate-100 antialiased transition-colors duration-300">

    <!-- NAVBAR -->
    <nav class="sticky top-0 z-50 w-full bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl border-b border-slate-200/50 dark:border-slate-700">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        
        <a href="#" class="flex items-center gap-2 group">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-[#0d2a5c] to-[#1e4a9e] flex items-center justify-center shadow-xl shadow-blue-900/20 group-hover:rotate-12 transition-transform duration-300">
                <span class="text-white font-black text-lg">P</span>
            </div>
            <span class="text-xl font-extrabold text-[#0d2a5c] dark:text-white tracking-tighter">Puskibi<span class="text-amber-500">wear</span></span>
        </a>

        <div class="hidden md:flex items-center gap-1 bg-slate-100/50 dark:bg-slate-700/50 p-1 rounded-2xl border border-slate-200/50 dark:border-slate-600">
            <a href="#beranda" class="px-4 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-[#0d2a5c] dark:hover:text-white hover:bg-white dark:hover:bg-slate-600 rounded-xl transition-all duration-300">Beranda</a>
            <a href="#katalog" class="px-4 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-[#0d2a5c] dark:hover:text-white hover:bg-white dark:hover:bg-slate-600 rounded-xl transition-all duration-300">Katalog</a>
            <a href="#reservasi" class="px-4 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-[#0d2a5c] dark:hover:text-white hover:bg-white dark:hover:bg-slate-600 rounded-xl transition-all duration-300">Reservasi</a>
            <a href="#tentang" class="px-4 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-[#0d2a5c] dark:hover:text-white hover:bg-white dark:hover:bg-slate-600 rounded-xl transition-all duration-300">Tentang Kami</a>
            <a href="#kontak" class="px-4 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-[#0d2a5c] dark:hover:text-white hover:bg-white dark:hover:bg-slate-600 rounded-xl transition-all duration-300">Kontak</a>
        </div>

        
        <div class="hidden md:flex items-center gap-3">
    <a href="login.php" class="px-6 py-2.5 bg-[#0d2a5c] text-white text-sm font-bold rounded-2xl shadow-lg shadow-blue-900/20 hover:bg-blue-900 transition-all">
        Login
    </a>

    <button id="theme-toggle" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600 transition-all">
        <i class="fa-solid fa-moon dark:hidden"></i> <i class="fa-solid fa-sun hidden dark:block"></i> </button>
</div>
    </div>
</nav>

   <!-- HERO SECTION -->
<header id="beranda"
    class="w-full px-10 lg:px-20 pt-14 pb-14 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative overflow-hidden">

    <!-- Left Text -->
    <div class="lg:col-span-6 space-y-6 animate-fade-in">
        <span class="inline-block bg-amber-50 text-amber-600 text-xs font-semibold px-3 py-1.5 rounded-md">#SolusiJasKampus</span>
        <h1 class="text-5xl md:text-7xl font-bold text-[#0d2a5c] leading-tight dark:text-white">
            Sewa Jas Kampus<br>Mudah, Cepat, <span class="text-amber-300">Terpercaya.</span>
        </h1>
        <p class="text-slate-500 leading-relaxed max-w-md text-sm md:text-base dark:text-slate-400">
            Puskibiwear hadir untuk membantu mahasiswa mendapatkan jas berkualitas dengan proses peminjaman yang praktis, nyaman, dan terpercaya.
        </p>
        <!-- CTA Buttons -->
        <div class="flex flex-wrap gap-4 pt-2">
         <a href="#katalog" class="bg-[#0d2a5c] text-white px-6 py-3 rounded-xl font-medium text-sm flex items-center space-x-2 shadow-lg shadow-blue-900/20 hover:scale-105 transition-all duration-300">
            <i class="fa-solid fa-bookmark text-xs"></i>
            <span>Lihat Katalog Jas</span>
        </a>
        
        <a href="login.php" class="border border-amber-500 text-amber-600 px-6 py-3 rounded-xl font-medium text-sm flex items-center space-x-2 hover:bg-amber-50 transition-all duration-300">
            <i class="fa-regular fa-calendar-days"></i>
            <span>Booking Sekarang</span>
        </a>
    </div>

        <!-- Mini Badges -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6 text-xs font-medium text-slate-600 dark:text-slate-300">
            <div class="flex items-center space-x-2"><i class="fa-regular fa-circle-check text-blue-800 text-base"></i> <span>Bersih & Terawat</span></div>
            <div class="flex items-center space-x-2"><i class="fa-solid fa-ruler text-blue-800 text-base"></i> <span>Banyak Ukuran</span></div>
            <div class="flex items-center space-x-2"><i class="fa-solid fa-tag text-blue-800 text-base"></i> <span>Harga Terjangkau</span></div>
            <div class="flex items-center space-x-2"><i class="fa-solid fa-rotate text-blue-800 text-base"></i> <span>Proses Mudah</span></div>
        </div>
    </div>

    <!-- RIGHT HERO -->
    <div class="lg:col-span-6 flex justify-center animate-slide-in">
        <div class="relative w-full max-w-[650px] h-[500px]">

            <!-- Background Bulat -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-[420px] h-[420px] bg-blue-100 rounded-full opacity-70 animate-pulse"></div>
            </div>

            <!-- Wrapper Card -->
        <div class="absolute inset-0 flex items-center justify-center gap-6 z-10">
            
            <!-- Card 1: Jas Praktikum -->
            <div class="relative bg-white rounded-3xl shadow-xl w-[260px] p-5 group cursor-pointer border-2 border-transparent hover:border-slate-300 transition-all duration-300">
            <img src="../assets/img/jas praktikum.jpeg" class="w-full h-[220px] object-contain transition-transform duration-500 group-hover:scale-105">
            <h4 class="font-bold text-[#0d2a5c] text-center mt-3">Jas Praktikum</h4>
        </div>

            <!-- Card 2: Jas Almamater -->
            <div class="relative bg-white rounded-3xl shadow-xl w-[260px] p-5 group cursor-pointer border-2 border-transparent hover:border-slate-300 transition-all duration-300">
            <img src="../assets/img/jas almet.jpeg" class="w-full h-[220px] object-contain transition-transform duration-500 group-hover:scale-105">
            <h4 class="font-bold text-[#0d2a5c] text-center mt-3">Jas Almamater</h4>
        </div>

            <!-- Card 3: Jas Sempro -->
            <div class="relative bg-white rounded-3xl shadow-xl w-[260px] p-5 group cursor-pointer border-2 border-transparent hover:border-slate-300 transition-all duration-300">
            <img src="../assets/img/jas sempro.jpeg" class="w-full h-[220px] object-contain transition-transform duration-500 group-hover:scale-105">
            <h4 class="font-bold text-[#0d2a5c] text-center mt-3">Jas Sempro</h4>
        </div>

        </div>
                    </div>
                </div>
            </div>
        </header>

<style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-in { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }
    .animate-fade-in { animation: fade-in 1s ease-out; }
    .animate-slide-in { animation: slide-in 1s ease-out; }
</style>

<section id="katalog" class="w-full px-10 lg:px-20 py-6 mt-32">
    <div class="text-center mb-10">
    <h2 class="text-4xl font-bold text-[#0d2a5c] dark:text-amber-400 transition-colors duration-300">
    Katalog Jas
    </h2>
    <p class="text-slate-500 dark:text-slate-300 mt-3 transition-colors duration-300">
            Pilih jenis jas yang sesuai dengan kebutuhanmu.
    </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">  
    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm transition-colors duration-300 flex flex-col h-full">
    <div class="h-64 flex items-center justify-center bg-white rounded-2xl mb-5 overflow-hidden shadow-inner">
    <img src="../assets/img/jas praktikum.jpeg" class="max-h-full max-w-full object-contain">
</div>
    <h3 class="text-xl font-bold text-[#0d2a5c] dark:text-white transition-colors duration-300">Jas Praktikum</h3>
    <p class="text-slate-500 dark:text-slate-300 text-sm mt-2 mb-4 flex-grow transition-colors duration-300">Cocok digunakan untuk kegiatan praktikum di laboratorium dan aktivitas lapangan.</p>

    <div class="mb-4">
        <span class="text-xs font-semibold text-slate-400 uppercase">Tersedia Ukuran:</span>
        <div class="flex gap-2 mt-2">
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">S</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">M</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">L</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">XL</span>
        </div>
    </div>
    <a href="login.php" class="w-full py-3 bg-[#0d2a5c] text-white text-center font-semibold rounded-xl hover:bg-blue-900 transition">
        Pinjam Sekarang
    </a>
</div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 flex flex-col transition-colors duration-300">
    <div class="h-64 flex items-center justify-center bg-white rounded-2xl mb-5 overflow-hidden shadow-inner">
    <img src="../assets/img/jas Sempro.jpeg" class="max-h-full max-w-full object-contain">
</div>
    <h3 class="text-xl font-bold text-[#0d2a5c] dark:text-white transition-colors duration-300">
        Jas Sempro
    </h3>
    
    <p class="text-slate-500 dark:text-slate-300 text-sm mt-2 mb-4 flex-grow transition-colors duration-300">
    Cocok digunakan untuk seminar proposal dan sidang.
    </p>
    
    <div class="mb-4">
        <span class="text-xs font-semibold text-slate-400 dark:text-slate-300 uppercase transition-colors duration-300">
            Tersedia Ukuran:
        </span>
        <div class="flex gap-2 mt-2">
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">S</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">M</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">L</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">XL</span>
        </div>
    </div>
    
    <a href="login.php" class="w-full py-3 bg-[#0d2a5c] text-white text-center font-semibold rounded-xl hover:bg-blue-900 transition">Pinjam Sekarang</a>
</div>

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm transition-colors duration-300 flex flex-col h-full">
    <div class="h-64 flex items-center justify-center bg-white rounded-2xl mb-5 overflow-hidden border border-slate-100 dark:border-slate-700">
    <img src="../assets/img/jas almet.jpeg" class="w-full h-full object-cover">
</div>
    <h3 class="text-xl font-bold text-[#0d2a5c] dark:text-white transition-colors duration-300">
        Jas Almamater
    </h3>
    <p class="text-slate-500 dark:text-slate-300 text-sm mt-2 mb-4 flex-grow transition-colors duration-300">
        Cocok digunakan untuk kegiatan formal, organisasi, sidang, dan acara resmi kampus.
    </p>
    <div class="mb-4">
        <span class="text-xs font-semibold text-slate-400 dark:text-slate-300 uppercase transition-colors duration-300">
            Tersedia Ukuran:
        </span>
        <div class="flex gap-2 mt-2">
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">S</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">M</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">L</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">XL</span>
        </div>
    </div>
    <a href="login.php" class="w-full py-3 bg-[#0d2a5c] text-white text-center font-semibold rounded-xl hover:bg-blue-900 transition">Pinjam Sekarang</a>
</div>
    </div> 
</section>

        <!-- CARA PEMINJAMAN (Kanan) -->
        <section id="reservasi" class="w-full px-10 lg:px-20 pt-32 pb-24 bg-[#f8faff] dark:bg-slate-900 transition-colors duration-300">
    <div class="text-center mb-16">
    <h2 class="text-4xl font-bold text-[#0d2a5c] dark:text-amber-400 transition-colors duration-300">
    Cara Peminjaman
    </h2>
    <p class="text-slate-500 mt-3 dark:text-slate-300 transition-colors duration-300">
        Proses peminjaman jas di PuskibiWear dilakukan secara online dan mudah dalam beberapa langkah.
    </p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Langkah 1 -->
        <div class="group bg-slate-50 dark:bg-slate-800 rounded-3xl p-8 text-center hover:bg-white dark:hover:bg-slate-700 hover:shadow-2xl transition-all duration-300 border border-transparent hover:border-blue-100 dark:border-slate-700">
    <div class="relative w-16 h-16 mx-auto bg-white dark:bg-slate-900 rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-slate-100 dark:border-slate-600 group-hover:scale-110 transition-transform">
        <i class="fa-solid fa-right-to-bracket text-2xl text-[#0d2a5c] dark:text-blue-400"></i>
        <span class="absolute -top-2 -right-2 bg-[#0d2a5c] text-white text-[10px] font-bold w-6 h-6 flex items-center justify-center rounded-full">01</span>
    </div>
    
    <h3 class="font-bold text-lg text-[#0d2a5c] dark:text-white transition-colors duration-300">
        Login / Register
    </h3>
    
    <p class="text-slate-500 dark:text-slate-300 mt-3 text-sm leading-relaxed transition-colors duration-300">
        Mahasiswa membuat akun atau login menggunakan NPM untuk mengakses sistem.
    </p>
</div>

        <!-- Langkah 2 -->
        <div class="group bg-slate-50 dark:bg-slate-800 rounded-3xl p-8 text-center hover:bg-white dark:hover:bg-slate-700 hover:shadow-2xl transition-all duration-300 border border-transparent hover:border-amber-100 dark:border-slate-700">
    <div class="relative w-16 h-16 mx-auto bg-white dark:bg-slate-900 rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-slate-100 dark:border-slate-600 group-hover:scale-110 transition-transform">
        <i class="fa-solid fa-shirt text-2xl text-amber-500"></i>
        <span class="absolute -top-2 -right-2 bg-amber-500 text-white text-[10px] font-bold w-6 h-6 flex items-center justify-center rounded-full">02</span>
    </div>
    
    <h3 class="font-bold text-lg text-[#0d2a5c] dark:text-white transition-colors duration-300">
        Pilih & Booking
    </h3>
    
    <p class="text-slate-500 dark:text-slate-300 mt-3 text-sm leading-relaxed transition-colors duration-300">
        Pilih jas, ukuran, dan tanggal peminjaman sesuai kebutuhan lalu lakukan booking.
    </p>
</div>

        <!-- Langkah 3 -->
        <div class="group bg-slate-50 dark:bg-slate-800 rounded-3xl p-8 text-center hover:bg-white dark:hover:bg-slate-700 hover:shadow-2xl transition-all duration-300 border border-transparent hover:border-purple-100 dark:border-slate-700">
    <div class="relative w-16 h-16 mx-auto bg-white dark:bg-slate-900 rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-slate-100 dark:border-slate-600 group-hover:scale-110 transition-transform">
        <i class="fa-solid fa-clipboard-check text-2xl text-purple-600 dark:text-purple-400"></i>
        <span class="absolute -top-2 -right-2 bg-purple-600 text-white text-[10px] font-bold w-6 h-6 flex items-center justify-center rounded-full">03</span>
    </div>
    
    <h3 class="font-bold text-lg text-[#0d2a5c] dark:text-white transition-colors duration-300">
        Verifikasi Admin
    </h3>
    
    <p class="text-slate-500 dark:text-slate-300 mt-3 text-sm leading-relaxed transition-colors duration-300">
        Admin memeriksa data peminjaman dan jaminan sebelum menyetujui permintaan.
    </p>
</div>

        <!-- Langkah 4 -->
        <div class="group bg-slate-50 dark:bg-slate-800 rounded-3xl p-8 text-center hover:bg-white dark:hover:bg-slate-700 hover:shadow-2xl transition-all duration-300 border border-transparent hover:border-green-100 dark:border-slate-700">
    <div class="relative w-16 h-16 mx-auto bg-white dark:bg-slate-900 rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-slate-100 dark:border-slate-600 group-hover:scale-110 transition-transform">
        <i class="fa-solid fa-hand-holding text-2xl text-green-600 dark:text-green-400"></i>
        <span class="absolute -top-2 -right-2 bg-green-600 text-white text-[10px] font-bold w-6 h-6 flex items-center justify-center rounded-full">04</span>
    </div>
    
    <h3 class="font-bold text-lg text-[#0d2a5c] dark:text-white transition-colors duration-300">
        Ambil & Kembalikan
    </h3>
    
    <p class="text-slate-500 dark:text-slate-300 mt-3 text-sm leading-relaxed transition-colors duration-300">
        Setelah disetujui, mahasiswa mengambil jas lalu mengembalikannya sesuai jadwal.
    </p>
</div>
    </div>
</section>

    <!-- FOOTER / TRUST BADGE SECTION -->
    <section id="tentang" class="w-full px-10 lg:px-20 py-24 bg-slate-50 dark:bg-slate-900 transition-colors duration-300 relative overflow-hidden">
    <!-- Aksen Lingkaran Background -->
    <div class="absolute -top-24 -left-24 w-72 h-72 bg-blue-100 rounded-full blur-3xl opacity-50"></div>

    <div class="grid lg:grid-cols-2 gap-16 items-center">
        
        <!-- Sisi Kiri: Teks & Statistik -->
        <div class="relative z-10">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-[#0d2a5c] text-xs font-bold uppercase tracking-widest mb-4">
                Tentang Puskibiwear
            </span>
            <h2 class="text-5xl font-extrabold text-[#0d2a5c] dark:text-white leading-tight">
            Solusi Sewa Jas <br> <span class="text-amber-500">Terbaik di Kampus</span>
        </h2>
        <p class="text-slate-600 dark:text-slate-300 mt-6 leading-relaxed text-lg">
        Puskibiwear hadir untuk mempermudah langkah Anda. Kami berkomitmen menyediakan koleksi jas berkualitas dengan standar kebersihan tinggi, memastikan Anda tampil profesional di setiap momen penting.
        </p>

            <!-- Statistik dengan Desain Minimalis -->
            <div class="flex gap-10 mt-10 border-t border-blue-800 dark:border-slate-700 pt-8">
            <div>
                <h3 class="text-3xl font-bold text-[#0d2a5c] dark:text-white">1000+</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wide">Mahasiswa</p>
            </div>
            
            <div>
                <h3 class="text-3xl font-bold text-[#0d2a5c] dark:text-white">500+</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wide">Peminjaman</p>
            </div>
            
            <div>
                <h3 class="text-3xl font-bold text-[#0d2a5c] dark:text-white">4.9 <span class="text-amber-500">★</span></h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wide">Rating</p>
            </div>
            </div>
        </div>

        <!-- Sisi Kanan: Grid Keunggulan dengan Hover Effect -->
        <div class="grid grid-cols-2 gap-4">
        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 mt-8">
        <div class="w-12 h-12 bg-amber-50 dark:bg-slate-900 text-amber-500 rounded-xl flex items-center justify-center mb-4 transition-colors duration-300">
        <i class="fa-solid fa-shirt"></i>
        </div> 
    <h3 class="font-bold text-[#0d2a5c] dark:text-white transition-colors duration-300">
        Jas Premium
    </h3>
    <p class="text-xs text-slate-400 dark:text-slate-300 mt-1 transition-colors duration-300">
        Material pilihan & nyaman.
    </p>
</div>
        
    <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 mt-8">
    <div class="w-12 h-12 bg-amber-50 dark:bg-slate-900 text-amber-500 rounded-xl flex items-center justify-center mb-4 transition-colors duration-300">
    <i class="fa-solid fa-ruler text-xl"></i>
    </div>
    
    <h3 class="font-bold text-[#0d2a5c] dark:text-white transition-colors duration-300">
        All Sizes
    </h3>
    
    <p class="text-xs text-slate-400 dark:text-slate-300 mt-1 transition-colors duration-300">
        Tersedia semua ukuran.
    </p>
</div>

    <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 mt-8">
    <div class="w-12 h-12 bg-purple-50 dark:bg-slate-900 text-purple-600 dark:text-purple-400 rounded-xl flex items-center justify-center mb-4 transition-colors duration-300">
    <i class="fa-solid fa-clock text-xl"></i>
    </div>
    
    <h3 class="font-bold text-[#0d2a5c] dark:text-white transition-colors duration-300">
        Proses Cepat
    </h3>
    
    <p class="text-xs text-slate-400 dark:text-slate-300 mt-1 transition-colors duration-300">
        Booking online hitungan detik.
    </p>
</div>

    <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 mt-8">
    <div class="w-12 h-12 bg-purple-50 dark:bg-slate-900 text-purple-600 dark:text-purple-400 rounded-xl flex items-center justify-center mb-4 transition-colors duration-300">
    <i class="fa-solid fa-shield-halved text-xl"></i>
    </div>
    
    <h3 class="font-bold text-[#0d2a5c] dark:text-white transition-colors duration-300">
        Terpercaya
    </h3>
    
    <p class="text-xs text-slate-400 dark:text-slate-300 mt-1 transition-colors duration-300">
        Keamanan data terjamin.
    </p>
</div>
    </div>
    </div>
    </section>
    </footer>

<!-- KONTAK SECTION (Dikecilkan) -->
<section id="kontak" class="w-full px-10 lg:px-20 py-24">
    <div class="max-w-5xl mx-auto bg-white rounded-[2rem] shadow-2xl shadow-blue-100/50 flex flex-col md:flex-row overflow-hidden border border-slate-100">
        
        <!-- BAGIAN KIRI: Info Kontak -->
        <div class="bg-[#0d2a5c] p-10 md:w-1/3 text-white flex flex-col justify-between">
            <div>
                <h2 class="text-3xl font-bold mb-8">Contact Us</h2>
                <div class="space-y-6 text-sm">
                    <div class="flex items-start space-x-4">
                        <i class="fa-solid fa-location-dot mt-1"></i>
                        <p>Universitas Muhammadiyah<br>Sumatera Utara, Medan</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i class="fa-solid fa-envelope"></i>
                        <p>puskibiwear@gmail.com</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i class="fa-solid fa-phone"></i>
                        <p>+62 819 4456 7890</p>
                    </div>
                </div>
            </div>
            
            <!-- Media Sosial -->
            <div class="flex space-x-6 mt-10 text-xl">
                <a href="#"><i class="fa-brands fa-whatsapp hover:text-amber-400 cursor-pointer transition"></i></a>
                <a href="#"><i class="fa-brands fa-instagram hover:text-amber-400 cursor-pointer transition"></i></a>
                <a href="#"><i class="fa-brands fa-tiktok hover:text-amber-400 cursor-pointer transition"></i></a>
            </div>
        </div>

        <!-- BAGIAN KANAN: Form -->
        <div class="p-10 md:w-2/3">
            <h3 class="text-2xl font-bold text-[#0d2a5c] mb-2">Get in Touch</h3>
            <p class="text-slate-500 mb-8 text-sm">Jangan ragu untuk menghubungi kami!</p>
            
            <form class="space-y-4">
                <div class="grid md:grid-cols-2 gap-4">
                    <input type="text" placeholder="Your Name" class="w-full p-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-[#0d2a5c] transition">
                    <input type="email" placeholder="Your Email" class="w-full p-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-[#0d2a5c] transition">
                </div>
                <textarea placeholder="Typing your message here..." rows="4" class="w-full p-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-[#0d2a5c] transition"></textarea>
                
                <button type="submit" class="bg-[#0d2a5c] text-white px-8 py-3 rounded-full font-semibold hover:bg-blue-950 transition-all shadow-lg">
                    SEND MESSAGE
                </button>
            </form>
        </div>

    </div>
</section>

<!-- COPYRIGHT -->
<div class="border-t border-slate-200 dark:border-slate-700 py-5 text-center mt-8 transition-colors duration-300">
    <p class="text-sm text-slate-500 dark:text-slate-200 transition-colors duration-300">
        © 2026 Puskibiwear. All Rights Reserved.
    </p>
</div>

<script src="user.js"></script>
</body>
</html>