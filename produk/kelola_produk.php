<?php
include('../koneksi.php');
include('../header_admin.php');

// Ambil parameter jenis produk dari URL
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

// Binding parameter jika ada filter
if (!empty($jenis_produk)) {
    $stmt->bind_param("s", $jenis_produk);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk Sania Konveksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 30px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Responsif grid */
            gap: 20px;
            margin-top: 30px;
        }

        .product-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: bold;
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
        }

        .btn-actions {
            margin-top: 15px;
        }

        /* Modernisasi dropdown filter jenis produk */
        .form-select {
            background-color: #15B392;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            padding: 8px;
        }

        .form-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(21, 179, 146, 0.25);
        }

        /* Menambahkan padding pada filter section */
        .filter-section {
            margin-bottom: 30px;
        }

        /* Menambahkan media query untuk responsivitas */
        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }

            .product-image {
                height: 150px;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
<h1 class="text-3xl font-semibold text-center mb-6 text-black">Kelola Produk Sania Konveksi</h1>
<div class="container">

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" class="d-flex justify-content-between">
            <div class="d-flex">
                <select name="jenis_produk" class="form-select me-2" onchange="this.form.submit()">
                    <option value="">-- Semua Jenis --</option>
                    <option value="polo" <?php echo ($jenis_produk == 'polo') ? 'selected' : ''; ?>>Polo</option>
                    <option value="kaos" <?php echo ($jenis_produk == 'kaos') ? 'selected' : ''; ?>>Kaos</option>
                    <option value="kemeja" <?php echo ($jenis_produk == 'kemeja') ? 'selected' : ''; ?>>Kemeja</option>
                    <option value="hoodie" <?php echo ($jenis_produk == 'hoodie') ? 'selected' : ''; ?>>Hoodie</option>
                    <option value="celana" <?php echo ($jenis_produk == 'celana') ? 'selected' : ''; ?>>Celana</option>
                    <option value="seragam olahraga" <?php echo ($jenis_produk == 'seragam olahraga') ? 'selected' : ''; ?>>Seragam Olahraga</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>

    <div class="product-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Menentukan URL gambar produk
                $imagePath = isset($row['thumbnail_url']) && !empty($row['thumbnail_url']) ? 'produk/images/' . $row['thumbnail_url'] : 'produk/images/default.png';
                $detailUrl = isset($row['id_produk']) ? "produk/detail_produk.php?id_produk=" . $row['id_produk'] : '#';
                
                echo "<div class='product-card'>";
                echo "<img src='" . $imagePath . "' alt='" . htmlspecialchars($row['nama_produk']) . "' class='product-image'>";
                echo "<h5 class='product-name'>" . htmlspecialchars($row['nama_produk']) . "</h5>";
                echo "<div class='price'>Rp " . number_format($row['harga'], 0, ',', '.') . "</div>";
                echo "<div class='product-info'>";
                echo "<p><strong>Stok:</strong> " . $row['stok'] . "</p>";
                echo "<p><strong>Warna:</strong> " . ($row['warna'] ? $row['warna'] : 'Tidak ada warna') . "</p>";
                echo "</div>";

                // Tombol Edit dan Hapus
                echo "<div class='btn-actions'>";
                echo "<a href='edit_produk.php?id_produk=" . $row['id_produk'] . "' class='btn btn-warning'>Edit</a> ";
                echo "<a href='hapus_produk.php?id_produk=" . $row['id_produk'] . "' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\")'>Hapus</a>";
                echo "</div>";

                echo "</div>";
            }
        } else {
            echo "<p>Tidak ada produk yang sesuai dengan filter.</p>";
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
