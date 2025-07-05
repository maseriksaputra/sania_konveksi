<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "koneksi.php";
if (!isset($_SESSION['admin'])) {
    header("Location: header_admin.php"); // Redirect to login page if not logged in
    exit();
}
include 'koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Sania Konveksi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Menggunakan FontAwesome untuk ikon -->
    <style>
        /* Header Styling */
        .header {
            background-color: #15B392; /* Warna latar belakang hijau */
            padding: 20px 30px; /* Memperlebar header */
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 1.2rem; /* Menyesuaikan ukuran font */
        }

        /* Logo Teks */
        .logo {
            font-size: 2rem; /* Ukuran font lebih besar untuk logo */
            font-weight: bold;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        /* Menu Styling */
        .nav-menu {
            list-style: none;
            display: flex;
            gap: 30px; /* Menambah jarak antar menu */
        }

        .nav-menu li {
            display: inline-block;
            position: relative;
        }

        .nav-menu a {
            text-decoration: none;
            color: white;
            font-size: 1rem;
            font-weight: 500;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        /* Animasi saat hover */
        .nav-menu a:hover {
            color: #ffdf00; /* Warna hover kuning */
            transform: translateY(-3px); /* Efek mengangkat saat hover */
        }

        /* Penandaan menu aktif */
        .nav-menu .active a {
            color: #ffdf00; /* Warna menu aktif menjadi kuning */
            font-weight: bold;
        }

        /* Styling untuk Logout Button */
        .logout {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.1rem; /* Ukuran font lebih besar */
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .logout:hover {
            color: #ffdf00; /* Warna hover untuk logout */
        }

        .logout i {
            font-size: 1.4rem; /* Ukuran ikon logout lebih besar */
        }

        /* Styling untuk mobile view */
        @media (max-width: 768px) {
            .nav-menu {
                display: none; /* Menyembunyikan menu pada layar kecil */
                flex-direction: column;
                gap: 10px;
                align-items: flex-start; /* Menyusun menu ke kiri */
            }

            .nav-menu.active {
                display: flex;
            }

            .hamburger {
                display: block;
                cursor: pointer;
                font-size: 1.8rem;
                color: white;
            }
        }

        .hamburger {
            display: none; /* Tombol hamburger hanya tampil di mobile */
        }

    </style>
</head>
<body>

<?php
// Cek apakah user sudah login dan halaman yang sedang diakses adalah dashboard_admin.php
if (isset($_SESSION['admin']) && basename($_SERVER['PHP_SELF']) == 'dashboard_admin.php') :
?>

<!-- Header Section -->
<header class="header">
    <!-- Logo Teks -->
    <a href="index.php" class="logo">Sania Konveksi</a>

    <!-- Navigation Menu -->
    <nav>
        <ul class="nav-menu">
            <li class="<?= (basename($_SERVER['PHP_SELF']) == 'dashboard_admin.php') ? 'active' : ''; ?>">
                <a href="/dashboard_admin.php">Home</a>
            </li>
            <li class="<?= (basename($_SERVER['PHP_SELF']) == 'produk/kelola_produk.php') ? 'active' : ''; ?>">
                <a href="/produk/kelola_produk.php">Produk</a>
            </li>
            <li class="<?= (basename($_SERVER['PHP_SELF']) == 'jenis_produk/kelola_jenis_produk.php') ? 'active' : ''; ?>">
                <a href="/jenis_produk/kelola_jenis_produk.php">Jenis Produk</a>
            </li>
            <li class="<?= (basename($_SERVER['PHP_SELF']) == 'portofolio/kelola_portofolio.php') ? 'active' : ''; ?>">
                <a href="/portofolio/kelola_portofolio.php">Portofolio</a>
            </li>
            <li class="<?= (basename($_SERVER['PHP_SELF']) == 'data_order.php') ? 'active' : ''; ?>">
                <a href="/data_order.php">Data Order</a>
            </li>
            <li class="<?= (basename($_SERVER['PHP_SELF']) == 'data_alat.php') ? 'active' : ''; ?>">
                <a href="/data_alat.php">Alat</a>
            </li>
        </ul>
    </nav>

    <!-- Logout Button (paling kanan) -->
    <a href="logout.php" class="logout">
        <span>Logout</span>
        <!-- Ikon Logout -->
        <i class="fas fa-sign-out-alt"></i> <!-- Ikon Logout FontAwesome -->
    </a>

    <!-- Hamburger Button for Mobile -->
    <div class="hamburger" onclick="toggleMenu()">☰</div>
</header>

<?php endif; ?>

<script>
    // Script untuk toggle menu pada mobile view
    function toggleMenu() {
        const navMenu = document.querySelector('.nav-menu');
        navMenu.classList.toggle('active');
    }
</script>

</body>
</html>
