<?php
include('koneksi.php');

// Ambil parameter jenis produk dari URL dengan pengecekan yang lebih aman
$jenis_produk = isset($_GET['jenis_produk']) ? $_GET['jenis_produk'] : '';

// Query untuk mengambil produk dan foto pertama berdasarkan id_produk
$sql = "
SELECT p.id_produk, p.nama_produk, p.harga, p.stok, p.jenis_produk, 
       p.thumbnail_url, w.warna
FROM produk p
LEFT JOIN foto_produk f ON p.id_produk = f.id_produk
LEFT JOIN foto_warna fw ON f.id_foto = fw.id_foto
LEFT JOIN warna w ON fw.id_warna = w.id_warna
WHERE f.id_foto = (SELECT MIN(id_foto) FROM foto_produk WHERE id_produk = p.id_produk)
";

// Jika ada jenis_produk di URL, tambahkan filter pada query
if (!empty($jenis_produk)) {
    $sql .= " AND p.jenis_produk = ?";  // Filter berdasarkan jenis produk jika ada
}

$sql .= " ORDER BY p.id_produk";

// Eksekusi query
$stmt = $conn->prepare($sql);
if (!empty($jenis_produk)) {
    $stmt->bind_param("s", $jenis_produk); // Bind parameter jenis_produk jika ada
}
$stmt->execute();
$result = $stmt->get_result();

// Periksa jika ada hasil
if ($result === false) {
    echo "Terjadi kesalahan pada query SQL: " . $conn->error;
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Sania Konveksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        /* CSS Styling untuk mengisolasi produk */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        /* Menggunakan Flexbox atau CSS Grid untuk menata produk */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 kolom untuk desktop */
            gap: 15px;
            margin-top: 30px;
        }

        /* Responsivitas untuk tablet dan ponsel */
        @media (max-width: 1024px) {
            .product-grid {
                grid-template-columns: repeat(3, 1fr); /* 3 kolom untuk tablet */
            }
        }

        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr); /* 2 kolom untuk ponsel */
            }
        }

        @media (max-width: 480px) {
            .product-grid {
                grid-template-columns: 1fr; /* 1 kolom untuk layar sangat kecil */
            }
        }

        /* Styling untuk setiap kartu produk */
        .product-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: left;
            cursor: pointer; /* Agar kotak produk bisa diklik */
        }

        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: normal;
            color: #333;
        }

        .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #15B392;
            margin-top: 10px;
        }

        .product-info {
            font-size: 0.9rem;
            color: #555;
            margin-top: 10px;
            text-align: left; /* Untuk memastikan informasi stok dan warna rata kiri */
        }

        .product-info p {
            margin: 5px 0;
        }

    </style>
</head>
<body>
<h1 class="text-3xl font-semibold text-center mb-6 text-black">Produk Sania Konveksi</h1>
<div class="container">

    <div class="product-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Lokasi gambar thumbnail di folder produk/images atau URL yang ada
                $imagePath = 'produk/images/' . $row['thumbnail_url'];

                // Jika thumbnail_url tidak kosong, gunakan thumbnail_url
                if (empty($row['thumbnail_url'])) {
                    // Jika thumbnail_url kosong, gunakan gambar default
                    $imagePath = 'produk/images/default.png';
                }

                // URL detail_produk.php dengan parameter id_produk
                $detailUrl = "produk/detail_produk.php?id_produk=" . $row['id_produk'];

                // Tampilkan produk dalam grid
                echo "<a href='" . $detailUrl . "' style='text-decoration: none; color: inherit;'>";  // link ke detail produk
                echo "<div class='product-card'>";  // Kotak produk yang bisa diklik

                // Cek apakah gambar ada
                echo "<img src='" . $imagePath . "' alt='" . $row['nama_produk'] . "' class='product-image'>";

                // Tampilkan informasi produk
                echo "<h5 class='product-name'>" . $row['nama_produk'] . "</h5>"; 
                echo "<div class='price'>Rp " . number_format($row['harga'], 0, ',', '.') . "</div>";

                // Informasi stok dan warna tanpa kotak
                echo "<div class='product-info'>";
                echo "<p><strong>Stok:</strong> " . $row['stok'] . "</p>";  // Hanya menampilkan stok tanpa kotak
                echo "<p><strong>Warna:</strong> " . ($row['warna'] ? $row['warna'] : 'Tidak ada warna') . "</p>";  // Tampilkan warna jika ada
                echo "</div>"; // .product-info

                echo "</div>"; // .product-card
                echo "</a>";  // link ditutup
            }
        } else {
            echo "<p>Tidak ada produk tersedia.</p>";
        }
        ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>
