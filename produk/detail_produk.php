<?php
include('../koneksi.php'); // Pastikan path ke file koneksi benar
include('../header.php');

// Ambil ID produk dari URL
$id = isset($_GET['id_produk']) ? intval($_GET['id_produk']) : 0; // Mengambil ID produk dari URL

// Cek apakah ID valid
if ($id <= 0) {
    echo "ID produk tidak valid."; // Menampilkan pesan jika ID produk tidak valid
    exit; // Menghentikan eksekusi program
}

// Ambil detail produk berdasarkan ID dari tabel produk
$sql = "SELECT p.id_produk, p.nama_produk, p.jenis_produk, p.keterangan, p.harga, p.stok, p.ukuran, p.thumbnail_url 
        FROM produk p 
        WHERE p.id_produk = ?";
$stmt = $conn->prepare($sql); // Menyiapkan query untuk mengambil data produk berdasarkan ID
$stmt->bind_param("i", $id); // Mengikat parameter ID produk
$stmt->execute(); // Menjalankan query
$result = $stmt->get_result(); // Mendapatkan hasil query

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc(); // Mengambil data produk jika ditemukan
} else {
    echo "Produk tidak ditemukan."; // Menampilkan pesan jika produk tidak ditemukan
    exit; // Menghentikan eksekusi program
}

// Ambil semua foto produk berdasarkan id_produk
$foto_sql = "SELECT foto_url FROM foto_produk WHERE id_produk = ?"; 
$foto_stmt = $conn->prepare($foto_sql); // Menyiapkan query untuk mengambil data foto berdasarkan ID produk
$foto_stmt->bind_param("i", $id); // Mengikat parameter ID produk
$foto_stmt->execute(); // Menjalankan query
$foto_result = $foto_stmt->get_result(); // Mendapatkan hasil query foto

// Ambil warna yang tersedia untuk produk
$warna_sql = "SELECT w.id_warna, w.warna 
              FROM warna w
              LEFT JOIN foto_warna fw ON w.id_warna = fw.id_warna
              WHERE fw.id_foto IN (SELECT id_foto FROM foto_produk WHERE id_produk = ?)";
$warna_stmt = $conn->prepare($warna_sql); // Menyiapkan query untuk mengambil warna produk
$warna_stmt->bind_param("i", $id); // Mengikat parameter ID produk
$warna_stmt->execute(); // Menjalankan query
$warna_result = $warna_stmt->get_result(); // Mendapatkan hasil query warna

// Ambil rekomendasi produk lain sejenis berdasarkan jenis_produk
$jenis_produk = $product['jenis_produk']; // Mengambil jenis produk
$rekomendasi_sql = "SELECT p.id_produk, p.nama_produk, p.harga, f.foto_url 
                    FROM produk p 
                    LEFT JOIN foto_produk f ON p.id_produk = f.id_produk
                    WHERE p.jenis_produk = ? AND p.id_produk != ? AND f.foto_url IS NOT NULL
                    LIMIT 5"; 
$rekomendasi_stmt = $conn->prepare($rekomendasi_sql); // Menyiapkan query untuk rekomendasi produk
$rekomendasi_stmt->bind_param("si", $jenis_produk, $id); // Mengikat parameter untuk query rekomendasi
$rekomendasi_stmt->execute(); // Menjalankan query rekomendasi
$rekomendasi_result = $rekomendasi_stmt->get_result(); // Mendapatkan hasil query rekomendasi

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .product-image {
            flex: 1;
            max-width: 40%;
            text-align: center;
        }
        .product-image img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .product-details {
            flex: 2;
            max-width: 55%;
        }
        .product-details h1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .product-details .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #15B392;
            margin-bottom: 20px;
        }
        .product-details p {
            margin-bottom: 10px;
        }
        .btn-buy {
            background-color: #15B392;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }
        .btn-buy:hover {
            background-color: #129478;
        }
        .recommendation-section {
            margin-top: 40px;
            padding-bottom: 40px; /* Padding untuk memberikan ruang dengan footer */
        }
        .recommendation-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .recommendation-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 kolom */
            gap: 15px;
        }
        .recommendation-item {
            text-align: center;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            transition: box-shadow 0.3s ease;
        }
        .recommendation-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .recommendation-item img {
            max-width: 100%;
            height: 120px; /* Gambar kecil */
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .recommendation-item h5 {
            font-size: 0.9rem;
            margin-bottom: 8px;
        }
        .recommendation-item .price {
            font-weight: bold;
            color: #15B392;
            margin-bottom: 8px;
        }

        /* Responsif untuk layar lebih kecil */
        @media (max-width: 1200px) {
            .recommendation-container {
                grid-template-columns: repeat(4, 1fr); /* 4 produk di layar besar */
            }
            .product-container {
                flex-direction: column; /* Stack produk secara vertikal pada layar lebih kecil */
                align-items: center;
            }
            .product-details {
                max-width: 100%;
            }
        }
        @media (max-width: 992px) {
            .recommendation-container {
                grid-template-columns: repeat(3, 1fr); /* 3 produk di layar sedang */
            }
        }
        @media (max-width: 768px) {
            .recommendation-container {
                grid-template-columns: repeat(2, 1fr); /* 2 produk di layar kecil */
            }
        }
        @media (max-width: 576px) {
            .recommendation-container {
                grid-template-columns: 1fr; /* 1 produk di layar ekstra kecil */
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center my-5">Detail Produk</h1>
    <div class="product-container">
        <!-- Foto Produk -->
        <div class="product-image">
            <?php if ($foto_result->num_rows > 0): ?>
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $active = 'active'; // Menandai foto pertama sebagai 'active' di carousel
                        while ($foto = $foto_result->fetch_assoc()): ?>
                            <div class="carousel-item <?= $active ?>">
                                <img src="../produk/images/<?= htmlspecialchars($foto['foto_url']) ?>" class="d-block w-100" alt="Foto Produk">
                            </div>
                            <?php $active = ''; // Setiap foto setelah yang pertama tidak lagi active ?>
                        <?php endwhile; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            <?php else: ?>
                <img src="../produk/images/default.png" alt="Gambar Produk Default" class="img-fluid">
            <?php endif; ?>
        </div>

        <!-- Detail Produk -->
        <div class="product-details">
            <h1><?= htmlspecialchars($product['nama_produk']) ?></h1>
            <p><strong>Jenis Produk:</strong> <?= htmlspecialchars($product['jenis_produk']) ?></p>
            <p><strong>Keterangan:</strong> <?= nl2br(htmlspecialchars($product['keterangan'])) ?></p>
            <p><strong>Harga:</strong> Rp <?= number_format($product['harga'], 0, ',', '.') ?></p>
            <p><strong>Stok:</strong> <?= htmlspecialchars($product['stok']) ?></p>

            <!-- Pilih Ukuran dan Warna -->
            <form action="detail_produk.php" method="POST" id="purchaseForm">
                <div class="mb-3">
                    <label for="ukuran">Pilih Ukuran:</label>
                    <select class="form-select" id="ukuran" name="ukuran">
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                        <option value="XXXL">XXXL</option>
                    </select>
                </div>

                <div class="mb-3">
    <label for="warna">Pilih Warna:</label>
    <select class="form-select" id="warna" name="warna">
        <?php while ($warna = $warna_result->fetch_assoc()): ?>
            <option value="<?= $warna['id_warna'] ?>"><?= htmlspecialchars($warna['warna']) ?></option>
        <?php endwhile; ?>
    </select>
</div>


                <div class="mb-3 quantity-control">
                    <button type="button" id="decreaseQuantity" onclick="updateQuantity(-1)">-</button>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?= $product['stok'] ?>" readonly required>
                    <button type="button" id="increaseQuantity" onclick="updateQuantity(1)">+</button>
                </div>

                <div class="mb-3">
                    <label for="totalPrice">Harga Total:</label>
                    <input type="text" id="totalPrice" name="totalPrice" class="form-control" value="Rp <?= number_format($product['harga'], 0, ',', '.') ?>" readonly>
                </div>

                <div class="mb-3" id="promoMessage" style="display: none; color: red;">
                    <strong>Promo! Dapatkan potongan Rp 3.000 per produk untuk pembelian lebih dari 10 produk.</strong>
                </div>

                <!-- Tombol Beli Sekarang yang mengarah ke WhatsApp -->
                <a class="btn btn-buy" href="#" id="whatsappLink" target="_blank">
                    Beli Sekarang
                </a>
            </form>
        </div>
    </div>

    <!-- Rekomendasi Produk -->
    <div class="recommendation-section">
    <h2 class="recommendation-title">Rekomendasi Produk Lainnya</h2>
    <div class="recommendation-container">
        <?php while ($row = $rekomendasi_result->fetch_assoc()): ?>
            <div class="recommendation-item">
                <?php
                // Jika foto produk ada, tampilkan; jika tidak ada, tampilkan gambar default
                $rekomImgSrc = !empty($row['foto_url']) ? '../produk/images/' . $row['foto_url'] : '../produk/images/default.png';
                ?>
                <a href="detail_produk.php?id_produk=<?= $row['id_produk'] ?>">
                    <img src="<?= $rekomImgSrc ?>" alt="<?= htmlspecialchars($row['nama_produk']) ?>">
                    <h5><?= htmlspecialchars($row['nama_produk']) ?></h5>
                    <div class="price">Rp <?= number_format($row['harga'], 0, ',', '.') ?></div>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

</div>

<script>
    function updateQuantity(change) {
        var quantityInput = document.getElementById('quantity');
        var currentQuantity = parseInt(quantityInput.value);
        var newQuantity = currentQuantity + change;
        
        var maxQuantity = <?= $product['stok'] ?>;
        if (newQuantity >= 1 && newQuantity <= maxQuantity) {
            quantityInput.value = newQuantity;
            updateTotalPrice();
        }
    }

    function updateTotalPrice() {
        var quantity = document.getElementById('quantity').value;
        var price = <?= $product['harga'] ?>;
        var totalPrice = quantity * price;

        // Cek apakah memenuhi syarat promo
        if (quantity >= 10) {
            var discount = 3000 * quantity; // Potongan harga Rp 3000 per produk
            totalPrice -= discount; // Mengurangi total harga dengan potongan
            document.getElementById('promoMessage').style.display = 'block'; // Menampilkan pesan promo
        } else {
            document.getElementById('promoMessage').style.display = 'none'; // Menyembunyikan pesan promo jika kurang dari 10
        }

        document.getElementById('totalPrice').value = 'Rp ' + totalPrice.toLocaleString();
        updateWhatsappLink(quantity, totalPrice);
    }

    function updateWhatsappLink(quantity, totalPrice) {
    var size = document.getElementById('ukuran').value;  // Ambil ukuran yang dipilih
    var colorId = document.getElementById('warna').value;  // Ambil ID warna yang dipilih
    
    // Ambil nama warna berdasarkan ID yang dipilih
    var colorName = document.querySelector(`#warna option[value="${colorId}"]`).text;

    var productName = "<?= urlencode($product['nama_produk']) ?>";  // Nama produk
    var productType = "<?= urlencode($product['jenis_produk']) ?>";  // Jenis produk
    var description = "<?= urlencode($product['keterangan']) ?>";  // Deskripsi produk

    // Buat URL WhatsApp
    var whatsappUrl = "https://wa.me/+6281391546050?text=Halo,%20saya%20tertarik%20untuk%20membeli%20produk%20anda.%0A%0A%2A%20Nama%20Produk%3A%20" + productName +
        "%0A%2A%20Jenis%20Produk%3A%20" + productType +
        "%0A%2A%20Ukuran%3A%20" + size +
        "%0A%2A%20Warna%3A%20" + encodeURIComponent(colorName) +  // Mengirimkan nama warna
        "%0A%2A%20Jumlah%3A%20" + quantity +
        "%20buah%0A%2A%20Harga%20Total%3A%20Rp%20" + totalPrice.toLocaleString() +
        "%0A%2A%20Keterangan%3A%20" + description;

    // Update link tombol "Beli Sekarang"
    document.getElementById('whatsappLink').href = whatsappUrl;
}



    updateTotalPrice();
</script>
<!-- Include Footer -->
<?php include('../footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>
