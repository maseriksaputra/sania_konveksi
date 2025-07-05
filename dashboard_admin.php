<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi database benar
include 'header_admin.php'; // Include header dari file header.php

// Cek apakah pengguna sudah login dan memiliki role 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Konveksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* Styling Body */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            padding-bottom: 50px; /* Menambahkan padding untuk scroll */
        }

        .menu-card {
            transition: all 0.3s ease;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Warna ikon dan link */
        .menu-card i {
            font-size: 3rem;
            color: #15B392; /* Warna ikon hijau */
            transition: color 0.3s;
        }

        .menu-card:hover i {
            color: #128a70; /* Warna ikon saat hover */
        }

        .menu-card h5 {
            margin-top: 10px;
        }

        /* Link warna */
        .menu-card a {
            text-decoration: none;
            color: #15B392; /* Mengubah warna link sesuai dengan ikon */
            font-weight: bold;
        }

        .menu-card a:hover {
            color: #128a70; /* Warna link saat hover */
        }

        .row {
            margin-top: 30px;
        }

        /* Statistik Card */
        .stat-card {
            transition: all 0.3s ease;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-card i {
            font-size: 3rem;
            color: #15B392; /* Warna ikon statistik diubah */
        }

        .stat-card h5 {
            margin-top: 10px;
            font-size: 18px;
        }

        /* Add custom styles for large layout */
        .content-section {
            padding: 30px 0;
        }

        /* Make content responsive */
        @media (max-width: 768px) {
            .menu-card {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Main Content -->
    <div class="container my-4">
        <h3 class="mb-4">Dashboard Admin Konveksi</h3>

        <!-- Kotak-kotak Menu -->
        <div class="row">
            <!-- Kotak Produk -->
            <div class="col-md-3">
                <div class="menu-card">
                    <i class="fas fa-box"></i>
                    <h5>Kelola Produk</h5>
                    <a href="produk/kelola_produk.php">Kelola Produk</a>
                </div>
            </div>

            <!-- Kotak Portofolio (diubah ke Tambah Portofolio) -->
            <div class="col-md-3">
                <div class="menu-card">
                    <i class="fas fa-briefcase"></i>
                    <h5>Kelola Portofolio</h5>
                    <a href="portofolio/kelola_portofolio.php">Kelola Portofolio</a>
                </div>
            </div>

            <!-- Kotak Order -->
            <div class="col-md-3">
                <div class="menu-card">
                    <i class="fas fa-shopping-cart"></i>
                    <h5>Data Order</h5>
                    <a href="order/order_list.php">Tampil Order</a>
                </div>
            </div>

            <!-- Kotak Alat Jahit -->
            <div class="col-md-3">
                <div class="menu-card">
                    <i class="fas fa-cogs"></i>
                    <h5>Data Alat</h5>
                    <a href="alat_jahit.php">Lihat Alat</a>
                </div>
            </div>

            <!-- Kotak Tambah Produk -->
            <div class="col-md-3 mt-4">
                <div class="menu-card">
                    <i class="fas fa-plus-circle"></i>
                    <h5>Tambah Produk</h5>
                    <a href="produk/tambah_produk.php">Tambah Produk</a>
                </div>
            </div>
        </div>

        <!-- Statistik Dashboard -->
        <div class="row mt-5">
            <!-- Statistik Produk -->
            <div class="col-md-3">
                <div class="stat-card">
                    <i class="fas fa-box-open"></i>
                    <h5>Jumlah Produk</h5>
                    <p>
                        <?php
                        $query = "SELECT COUNT(*) as total_produk FROM produk";
                        $result = mysqli_query($conn, $query);
                        $data = mysqli_fetch_assoc($result);
                        echo $data['total_produk'];
                        ?>
                    </p>
                </div>
            </div>

            <!-- Statistik Jenis Produk -->
            <div class="col-md-3">
                <div class="stat-card">
                    <i class="fas fa-tags"></i>
                    <h5>Jenis Produk</h5>
                    <p>
                        <?php
                        $query = "SELECT COUNT(*) as total_jenis FROM jenis_produk";
                        $result = mysqli_query($conn, $query);
                        $data = mysqli_fetch_assoc($result);
                        echo $data['total_jenis'];
                        ?>
                    </p>
                </div>
            </div>

            <!-- Statistik Order -->
            <div class="col-md-3">
                <div class="stat-card">
                    <i class="fas fa-cart-arrow-down"></i>
                    <h5>Jumlah Order</h5>
                    <p>
                        <?php
                        $query = "SELECT COUNT(*) as total_order FROM orders";
                        $result = mysqli_query($conn, $query);
                        $data = mysqli_fetch_assoc($result);
                        echo $data['total_order'];
                        ?>
                    </p>
                </div>
            </div>

            <!-- Statistik Alat Jahit -->
            <div class="col-md-3">
                <div class="stat-card">
                    <i class="fas fa-cogs"></i>
                    <h5>Jumlah Alat Jahit</h5>
                    <p>
                        <?php
                        $query = "SELECT COUNT(*) as total_alat FROM alat_jahit";
                        $result = mysqli_query($conn, $query);
                        $data = mysqli_fetch_assoc($result);
                        echo $data['total_alat'];
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Daftar Produk -->
        <div class="content-section">
            <h4>Daftar Produk</h4>
            <div class="row">
                <?php
                $query_produk = "SELECT * FROM produk";
                $result_produk = mysqli_query($conn, $query_produk);
                while ($produk = mysqli_fetch_assoc($result_produk)) {
                    echo '
                    <div class="col-md-3">
                        <div class="menu-card">
                            <i class="fas fa-box"></i>
                            <h5>' . $produk['nama_produk'] . '</h5>
                            <p>' . $produk['deskripsi'] . '</p>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>

        <!-- Daftar Portofolio -->
        <div class="content-section">
            <h4>Daftar Portofolio</h4>
            <div class="row">
                <?php
                $query_portofolio = "SELECT * FROM portofolio";
                $result_portofolio = mysqli_query($conn, $query_portofolio);
                while ($portofolio = mysqli_fetch_assoc($result_portofolio)) {
                    echo '
                    <div class="col-md-3">
                        <div class="menu-card">
                            <i class="fas fa-briefcase"></i>
                            <h5>' . $portofolio['judul'] . '</h5>
                            <p>' . $portofolio['deskripsi'] . '</p>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
