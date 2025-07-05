<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbkonveksi";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil semua jenis produk
$sql = "SELECT * FROM jenis_produk";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Konveksi</title>
    <!-- Menggunakan Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- CSS Kustom -->
    <style>
        /* Gaya produk card */
        .product-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Gaya untuk info produk */
        .product-info {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 16px;
            text-align: center;
        }

        /* Gaya judul produk */
        .product-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d2d2d;
        }

        /* Mengatur gambar produk */
        .product-image {
            width: 100%;
            height: 200px; /* Ukuran yang lebih proporsional */
            object-fit: cover;
            border-radius: 8px;
            transition: opacity 0.3s ease;
        }

        .product-image:hover {
            opacity: 0.8;
        }

        /* Menambahkan warna biru telur asin pada judul */
        .text-blue {
            color: #15B392;
        }

        /* Membuat tampilan responsif */
        @media (max-width: 640px) {
            .product-card {
                max-width: 100%;
            }
        }

        /* Mengurangi padding dan margin untuk mengurangi ruang kosong */
        body {
            padding-top: 20px; /* Mengurangi padding atas pada body */
        }

        section#jenis-produk {
            padding-top: 8px; /* Mengurangi padding pada section */
        }

        h1 {
            margin-bottom: 24px; /* Mengurangi margin bawah pada judul */
        }
    </style>
</head>
<body class="bg-gray-100">

<!-- Jenis Produk Section -->
<section id="jenis-produk" class="py-8"> <!-- Mengurangi padding bagian atas -->
<h1 class="text-3xl font-semibold text-center mb-6 text-white">Jenis Produk Sania Konveksi</h1>
    <div class="container mx-auto px-4">
        <!-- Mengubah teks menjadi putih -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

            <?php
            // Periksa apakah ada data produk
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Path untuk gambar
                    $image_path = 'produk/produk/gambar_jenis/' . $row["foto"];
                    
                    // Jika gambar tidak ada, gunakan gambar default
                    if (!file_exists($image_path) || empty($row["foto"])) {
                        $image_path = 'produk/produk/gambar_jenis/default.png';
                    }

                    // Menampilkan data produk hanya jenis_produk tanpa keterangan dan harga
                    echo '
                    <a href="produk/detail_jenis_produk.php?id=' . $row["id"] . '&jenis_produk=' . urlencode($row["jenis_produk"]) . '" class="product-card block">
                        <img
                            alt="' . $row["jenis_produk"] . '"
                            class="product-image"
                            src="' . $image_path . '"
                        />
                        <div class="product-info">
                            <h3 class="product-title text-xl text-blue font-semibold">' . $row["jenis_produk"] . '</h3>
                        </div>
                    </a>';
                }
            } else {
                echo "<p class='col-span-4 text-center text-xl text-gray-600'>Tidak ada jenis produk ditemukan.</p>";
            }

            // Menutup koneksi
            $conn->close();
            ?>

        </div>
    </div>
</section>

</body>
</html>
