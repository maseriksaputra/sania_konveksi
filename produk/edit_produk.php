<?php
include('../koneksi.php');
include('../header_admin.php');

// Ambil id_produk dari URL
$id_produk = isset($_GET['id_produk']) ? $_GET['id_produk'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_produk = $_POST['nama_produk'];
    $jenis_produk = $_POST['jenis_produk'];
    $keterangan = $_POST['keterangan'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $ukuran = $_POST['ukuran'];

    // Query untuk update produk
    $sql = "UPDATE produk SET nama_produk = ?, jenis_produk = ?, keterangan = ?, harga = ?, stok = ?, ukuran = ? WHERE id_produk = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisii", $nama_produk, $jenis_produk, $keterangan, $harga, $stok, $ukuran, $id_produk);
    $stmt->execute();

    // Cek apakah berhasil
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Produk berhasil diperbarui!'); window.location='kelola_produk.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk!');</script>";
    }

    // Mengelola foto dan warna
    if (isset($_FILES['foto'])) {
        $foto_count = count($_FILES['foto']['name']); // Mengetahui jumlah file foto yang diupload

        for ($i = 0; $i < $foto_count; $i++) {
            $foto_name = $_FILES['foto']['name'][$i];
            $foto_tmp_name = $_FILES['foto']['tmp_name'][$i];
            $warna_foto = isset($_POST['warna_foto'][$i]) ? $_POST['warna_foto'][$i] : ''; // Ambil warna foto

            // Tentukan lokasi penyimpanan foto
            $target_dir = "images/";
            $target_file = $target_dir . basename($foto_name);

            if (move_uploaded_file($foto_tmp_name, $target_file)) {
                // Simpan foto produk ke tabel foto_produk
                $sql_foto = "INSERT INTO foto_produk (id_produk, foto_url) VALUES ('$id_produk', '$foto_name')";
                if ($conn->query($sql_foto) === TRUE) {
                    $id_foto_baru = $conn->insert_id;

                    if (!empty($warna_foto)) {
                        // Periksa apakah warna sudah ada di tabel warna
                        $sql_check_warna = "SELECT id_warna FROM warna WHERE warna = '$warna_foto'";
                        $result = $conn->query($sql_check_warna);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $id_warna = $row['id_warna'];
                        } else {
                            $sql_insert_warna = "INSERT INTO warna (warna) VALUES ('$warna_foto')";
                            if ($conn->query($sql_insert_warna) === TRUE) {
                                $id_warna = $conn->insert_id;
                            } else {
                                echo "<div class='alert alert-danger'>Gagal menyimpan warna: " . $conn->error . "</div>";
                            }
                        }

                        // Hubungkan foto dengan warna di tabel foto_warna
                        $sql_foto_warna = "INSERT INTO foto_warna (id_foto, id_warna) VALUES ('$id_foto_baru', '$id_warna')";
                        if ($conn->query($sql_foto_warna) === FALSE) {
                            echo "<div class='alert alert-danger'>Error saat menghubungkan foto dengan warna: " . $conn->error . "</div>";
                        }
                    }
                } else {
                    echo "<div class='alert alert-danger'>Error saat menyimpan foto: " . $conn->error . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Gagal mengupload foto ke server.</div>";
            }
        }
    }

    // Upload thumbnail produk
    if (isset($_FILES['thumbnail'])) {
        $thumbnail_name = $_FILES['thumbnail']['name'];
        $thumbnail_tmp_name = $_FILES['thumbnail']['tmp_name'];
        $thumbnail_target = "images/" . basename($thumbnail_name);

        if (move_uploaded_file($thumbnail_tmp_name, $thumbnail_target)) {
            $sql_thumbnail = "UPDATE produk SET thumbnail_url = '$thumbnail_name' WHERE id_produk = '$id_produk'";
            if ($conn->query($sql_thumbnail) === FALSE) {
                echo "<div class='alert alert-danger'>Error saat menyimpan thumbnail: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Gagal mengupload thumbnail.</div>";
        }
    }
} else {
    // Ambil data produk berdasarkan id_produk
    $sql = "SELECT * FROM produk WHERE id_produk = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();
    $produk = $result->fetch_assoc();

    // Ambil foto-foto produk yang ada beserta warna
    $sql_foto = "SELECT fp.*, w.warna FROM foto_produk fp 
                 LEFT JOIN foto_warna fw ON fp.id_foto = fw.id_foto
                 LEFT JOIN warna w ON fw.id_warna = w.id_warna
                 WHERE fp.id_produk = ?";
    $stmt_foto = $conn->prepare($sql_foto);
    $stmt_foto->bind_param("i", $id_produk);
    $stmt_foto->execute();
    $result_foto = $stmt_foto->get_result();

    // Ambil semua warna yang tersedia
    $sql_warna = "SELECT * FROM warna";
    $result_warna = $conn->query($sql_warna);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        .image-preview {
            max-height: 200px;
            object-fit: contain;
        }

        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .image-preview-container img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="my-4">Edit Produk</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $produk['nama_produk']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="jenis_produk" class="form-label">Jenis Produk</label>
            <select name="jenis_produk" class="form-control" required>
                <option value="polo" <?php echo ($produk['jenis_produk'] == 'polo') ? 'selected' : ''; ?>>Polo</option>
                <option value="kaos" <?php echo ($produk['jenis_produk'] == 'kaos') ? 'selected' : ''; ?>>Kaos</option>
                <option value="kemeja" <?php echo ($produk['jenis_produk'] == 'kemeja') ? 'selected' : ''; ?>>Kemeja</option>
                <option value="hoodie" <?php echo ($produk['jenis_produk'] == 'hoodie') ? 'selected' : ''; ?>>Hoodie</option>
                <option value="celana" <?php echo ($produk['jenis_produk'] == 'celana') ? 'selected' : ''; ?>>Celana</option>
                <option value="kemeja PDL" <?php echo ($produk['jenis_produk'] == 'kemeja PDL') ? 'selected' : ''; ?>>Kemeja PDL</option>
                <option value="seragam olahraga" <?php echo ($produk['jenis_produk'] == 'seragam olahraga') ? 'selected' : ''; ?>>Seragam Olahraga</option>
                <option value="rompi" <?php echo ($produk['jenis_produk'] == 'rompi') ? 'selected' : ''; ?>>Rompi</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3" required><?php echo $produk['keterangan']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" value="<?php echo $produk['harga']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="<?php echo $produk['stok']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="ukuran" class="form-label">Ukuran</label>
            <input type="text" name="ukuran" class="form-control" value="<?php echo $produk['ukuran']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Produk</label>
            <input type="file" name="foto[]" class="form-control" multiple onchange="previewImages()">
            <small class="text-muted">Pilih beberapa foto untuk produk ini.</small>

            <!-- Foto yang sudah ada dengan warna -->
            <div class="image-preview-container mt-3">
                <?php while ($foto = $result_foto->fetch_assoc()) { ?>
                    <div class="foto-item">
                        <img src="images/<?php echo $foto['foto_url']; ?>" alt="Foto Produk" class="image-preview">
                        <select name="warna_foto[]" class="form-control mt-2">
                            <option value="">Pilih Warna</option>
                            <?php while ($warna = $result_warna->fetch_assoc()) { ?>
                                <option value="<?php echo $warna['warna']; ?>"
                                    <?php echo ($warna['warna'] == $foto['warna']) ? 'selected' : ''; ?>>
                                    <?php echo $warna['warna']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail Produk</label>
            <input type="file" name="thumbnail" class="form-control">
            <small class="text-muted">Jika ingin mengganti thumbnail.</small>

            <!-- Thumbnail yang sudah ada -->
            <?php if ($produk['thumbnail_url']) { ?>
                <div class="mt-3">
                    <img src="images/<?php echo $produk['thumbnail_url']; ?>" class="image-preview" alt="Thumbnail Produk">
                </div>
            <?php } ?>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<script>
    // Fungsi untuk melihat preview foto yang diupload
    function previewImages() {
        var previewContainer = document.getElementById('foto-previews');
        previewContainer.innerHTML = ''; // Clear previous previews

        var files = document.getElementById('foto').files;
        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();
            reader.onload = function(event) {
                var img = document.createElement('img');
                img.src = event.target.result;
                img.classList.add('image-preview');
                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(files[i]);
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
