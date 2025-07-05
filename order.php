<?php
include('koneksi.php');
include('header.php');

// Ambil parameter jenis produk dan rentang harga dari URL atau form
$jenis_produk = isset($_GET['jenis_produk']) ? $_GET['jenis_produk'] : '';
$min_harga = isset($_GET['min_harga']) ? $_GET['min_harga'] : '';
$max_harga = isset($_GET['max_harga']) ? $_GET['max_harga'] : '';

// Cek apakah ada parameter id_produk untuk menampilkan produk berdasarkan id
$id_produk = isset($_GET['id_produk']) ? $_GET['id_produk'] : '';

if ($id_produk) {
    // Jika ada id_produk, tampilkan produk berdasarkan id_produk
    $sql = "SELECT * FROM produk WHERE id_produk = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_produk); // binding untuk id_produk yang merupakan integer
} else {
    // Jika tidak ada id_produk, tampilkan semua produk dengan filter
    $sql = "SELECT * FROM produk WHERE 1";
    
    // Menambahkan filter berdasarkan jenis produk jika ada
    if (!empty($jenis_produk)) {
        $sql .= " AND jenis_produk = ?";
    }

    // Menambahkan filter berdasarkan rentang harga jika ada
    if (!empty($min_harga)) {
        $sql .= " AND harga >= ?";
    }
    if (!empty($max_harga)) {
        $sql .= " AND harga <= ?";
    }

    $stmt = $conn->prepare($sql);

    // Binding parameter untuk filter
    if (!empty($jenis_produk) && !empty($min_harga) && !empty($max_harga)) {
        $stmt->bind_param("sii", $jenis_produk, $min_harga, $max_harga);
    } elseif (!empty($jenis_produk) && !empty($min_harga)) {
        $stmt->bind_param("si", $jenis_produk, $min_harga);
    } elseif (!empty($jenis_produk) && !empty($max_harga)) {
        $stmt->bind_param("si", $jenis_produk, $max_harga);
    } elseif (!empty($min_harga) && !empty($max_harga)) {
        $stmt->bind_param("ii", $min_harga, $max_harga);
    } elseif (!empty($jenis_produk)) {
        $stmt->bind_param("s", $jenis_produk);
    } elseif (!empty($min_harga)) {
        $stmt->bind_param("i", $min_harga);
    } elseif (!empty($max_harga)) {
        $stmt->bind_param("i", $max_harga);
    }
}

// Eksekusi query
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Pakaian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .product-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .product-image {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .price {
            font-size: 20px;
            font-weight: bold;
            color: #15B392;
            margin-top: 10px;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 15px;
        }
        @media (max-width: 1200px) {
            .product-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        @media (max-width: 992px) {
            .product-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 576px) {
            .product-grid {
                grid-template-columns: 1fr;
            }
        }
        .filter-section {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            display: none;
        }
        .filter-section label {
            font-weight: 600;
            color: #333;
        }
        .filter-section select {
            padding: 8px 12px;
            font-size: 16px;
            border-radius: 4px;
            border: 2px solid #15B392;
            width: 100%;
            background-color: #ffffff;
        }
        .filter-section select:focus {
            border-color: #128c74;
            box-shadow: 0 0 5px rgba(21, 179, 146, 0.5);
        }
        .filter-section .btn {
            margin-top: 10px;
            width: 100%;
            background-color: #15B392;
            color: white;
            border: none;
        }
        .toggle-filter-btn {
            font-size: 18px;
            color: #15B392;
            cursor: pointer;
            border: none;
            background: none;
        }
        .product-card h5 {
            font-size: 17px; 
            font-weight: normal;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <!-- Tombol untuk membuka filter -->
    <button class="toggle-filter-btn mb-3" onclick="toggleFilter()">
        <i class="fas fa-filter"></i> Filter Produk
    </button>

    <!-- Filter Produk -->
    <div class="filter-section" id="filter-section">
        <h5>Pilih Jenis Produk</h5>
        <form method="GET" class="mb-3">
            <div class="form-group">
                <label for="jenis_produk">Jenis Produk</label>
                <select name="jenis_produk" id="jenis_produk" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Semua Jenis --</option>
                    <option value="polo" <?php echo ($jenis_produk == 'polo') ? 'selected' : ''; ?>>Polo</option>
                    <option value="kaos" <?php echo ($jenis_produk == 'kaos') ? 'selected' : ''; ?>>Kaos</option>
                    <option value="kemeja" <?php echo ($jenis_produk == 'kemeja') ? 'selected' : ''; ?>>Kemeja</option>
                    <option value="hoodie" <?php echo ($jenis_produk == 'hoodie') ? 'selected' : ''; ?>>Hoodie</option>
                    <option value="celana" <?php echo ($jenis_produk == 'celana') ? 'selected' : ''; ?>>Celana</option>
                    <option value="kemeja PDL" <?php echo ($jenis_produk == 'kemeja PDL') ? 'selected' : ''; ?>>Kemeja PDL</option>
                    <option value="seragam olahraga" <?php echo ($jenis_produk == 'seragam olahraga') ? 'selected' : ''; ?>>Seragam olahraga</option>
                    <option value="rompi" <?php echo ($jenis_produk == 'rompi') ? 'selected' : ''; ?>>Rompi</option>


                </select>
            </div>
            <div class="form-group mt-3">
                <label for="min_harga">Rentang Harga</label>
                <div class="d-flex">
                    <input type="number" name="min_harga" id="min_harga" class="form-control" placeholder="Min Harga" value="<?php echo $min_harga; ?>">
                    <span class="mx-2">-</span>
                    <input type="number" name="max_harga" id="max_harga" class="form-control" placeholder="Max Harga" value="<?php echo $max_harga; ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Filter</button>
        </form>
    </div>

    <!-- Display products in grid format -->
    <div class="product-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Pastikan 'thumbnail_url' dan 'id_produk' ada sebelum digunakan
                $imagePath = isset($row['thumbnail_url']) && !empty($row['thumbnail_url']) ? 'produk/images/' . $row['thumbnail_url'] : 'produk/images/default.png';
                $detailUrl = isset($row['id_produk']) ? "produk/detail_produk.php?id_produk=" . $row['id_produk'] : '#';

                echo "<a href='" . $detailUrl . "' style='text-decoration: none; color: inherit;'>";
                echo "<div class='product-card'>";

                echo "<img src='" . $imagePath . "' alt='" . htmlspecialchars($row['nama_produk']) . "' class='product-image'>";

                echo "<h5>" . htmlspecialchars($row['nama_produk']) . "</h5>";
                echo "<div class='price'>Rp " . number_format($row['harga'], 0, ',', '.') . "</div>";
                echo "<p>Jenis: " . htmlspecialchars($row['jenis_produk']) . "</p>";
                echo "<p>Stok: " . htmlspecialchars($row['stok']) . "</p>";
                echo "</div>";
                echo "</a>";
            }
        } else {
            echo "<p>Tidak ada produk tersedia untuk filter ini.</p>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Fungsi untuk menampilkan/menyembunyikan filter
    function toggleFilter() {
        var filterSection = document.getElementById('filter-section');
        filterSection.style.display = (filterSection.style.display === 'none' || filterSection.style.display === '') ? 'block' : 'none';
    }
</script>

</body>
</html>

<?php
include('footer.php');
$conn->close();
?>
