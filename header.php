<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Sania Konveksi</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- FontAwesome untuk ikon keranjang -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Styling Header */
        .header {
            background-color: #15B392; /* Warna hijau */
            padding: 10px 0;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        /* Flexbox container untuk header */
        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-form {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%; /* Mengisi seluruh sisa ruang */
        }

        .search-form input[type="text"] {
            width: 100%; /* Mengisi ruang yang tersisa di antara logo dan keranjang */
            max-width: 600px; /* Set batas lebar maksimal untuk kolom pencarian */
            padding: 12px;
            font-size: 16px;
            border-radius: 20px;
            border: 2px solid #fff;
            background-color: #fff;
        }

        .search-form button {
            background-color: #fff;
            border: 2px solid #fff;
            border-radius: 20px;
            padding: 12px 20px;
            color: #15B392;
            font-weight: bold;
        }

        .search-form button:hover {
            background-color: #15B392;
            color: white;
        }

        .cart-icon {
            color: white;
            font-size: 28px;
            text-decoration: none;
        }

        .cart-icon:hover {
            color: #128c74;
        }

        /* Media Queries untuk responsif */
        @media (max-width: 768px) {
            .search-form input[type="text"] {
                width: 80%; /* Lebar input lebih kecil pada perangkat mobile */
            }

            .search-form button {
                width: 20%; /* Lebar tombol lebih kecil pada perangkat mobile */
            }
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    <div class="container">
        <!-- Logo Kiri -->
        <a href="index.php" class="logo">Sania Konveksi</a>

        <!-- Menu Pencarian Tengah -->
        <div class="search-form">
            <input type="text" class="form-control" placeholder="Cari produk..." id="searchInput">
            <button type="submit" class="btn btn-light ms-2">Cari</button>
        </div>

        <!-- Ikon Keranjang Kanan -->
        <a href="keranjang.php" class="cart-icon">
            <i class="fas fa-shopping-cart"></i>
        </a>
    </div>
</div>

<!-- Konten halaman lainnya -->
<div class="container my-5">
    <!-- Konten produk dan lainnya -->
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
