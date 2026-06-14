// Efek muncul saat discroll
const cards = document.querySelectorAll('.card, .step');

window.addEventListener('scroll', () => {

    cards.forEach(card => {

        const position = card.getBoundingClientRect().top;

        if(position < window.innerHeight - 100){
            card.classList.add('show');
        }

    });

});

/* ==========================================================================
   JAVASCRIPT NAVIGATION SYSTEM UTK USER DASHBOARD (PuskibiWear)
   ========================================================================== */

function switchHalaman(menu) {
    // Ambil elemen konten halaman
    const dashboardContent = document.getElementById('content-dashboard');
    const riwayatContent = document.getElementById('content-riwayat');
    const pageTitle = document.getElementById('main-page-title');
    
    // Ambil elemen tombol navigasi di sidebar
    const btnDashboard = document.getElementById('btn-dashboard');
    const btnRiwayat = document.getElementById('btn-riwayat');

    if (menu === 'menu-dashboard') {
        // Tampilkan halaman dashboard utama
        dashboardContent.classList.add('section-active');
        riwayatContent.classList.remove('section-active');
        pageTitle.innerText = "Dashboard";
        
        // Atur efek aktif tombol sidebar
        btnDashboard.classList.add('active');
        btnRiwayat.classList.remove('active');
    } 
    else if (menu === 'menu-riwayat') {
        // Tampilkan halaman tabel riwayat
        riwayatContent.classList.add('section-active');
        dashboardContent.classList.remove('section-active');
        pageTitle.innerText = "Riwayat Peminjaman";
        
        // Atur efek aktif tombol sidebar
        btnRiwayat.classList.add('active');
        btnDashboard.classList.remove('active');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('theme-toggle');
    const html = document.documentElement;

    // Pastikan tombolnya ketemu baru jalankan script
    if (toggleButton) {
        toggleButton.addEventListener('click', () => {
            html.classList.toggle('dark');
            
            // Simpan status ke browser
            if (html.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });
    }

    // Cek status tema saat halaman direfresh
    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        html.classList.add('dark');
    }
});
