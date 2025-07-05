<?php
// Pastikan jalur file koneksi.php benar
include('../koneksi.php'); // Sesuaikan dengan lokasi sebenarnya

// Proses jika form disubmit (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $jenis_produk = $_POST['jenis_produk'];  // Menggunakan jenis_produk
    $foto = $_FILES['foto']['name']; // Foto produk

    // Pastikan folder 'produk/gambar_jenis' sudah dibuat
    $folder_path = 'produk/gambar_jenis/';
    if (!is_dir($folder_path)) {
        mkdir($folder_path, 0777, true); // Membuat folder jika belum ada
    }

    // Menyimpan file foto ke folder 'produk/gambar_jenis'
    $target_file = $folder_path . basename($foto);

    // Proses upload file
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
        // Query untuk menambahkan data ke tabel jenis_produk
        $sql = "INSERT INTO jenis_produk (jenis_produk, foto) VALUES ('$jenis_produk', '$foto')";

        // Mengeksekusi query dan memeriksa apakah berhasil
        if ($conn->query($sql) === TRUE) {
            // Redirect ke halaman yang sama setelah berhasil
            header("Location: tambah_jenis_produk.php");
            exit(); // Pastikan script berhenti setelah header
        } else {
            // Menampilkan pesan error jika query gagal
            echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    } else {
        // Menampilkan pesan error jika gagal upload foto
        echo "<div class='alert alert-danger'>Gagal mengupload foto.</div>";
    }

    // Menutup koneksi database
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jenis Produk</title>
    <!-- Menggunakan Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Tambah Jenis Produk</h2>

        <!-- Form untuk tambah jenis produk -->
        <form method="POST" enctype="multipart/form-data" class="p-4 shadow rounded bg-white">
            <div class="mb-3">
                <label for="jenis_produk" class="form-label">Jenis Produk</label>
                <select id="jenis_produk" name="jenis_produk" class="form-control" required>
                    <option value="polo">Polo</option>
                    <option value="kaos">Kaos</option>
                    <option value="kemeja">Kemeja</option>
                    <option value="hoodie">Hoodie</option>
                    <option value="celana">Celana</option>
                    <option value="kemeja PDL">Kemeja PDL</option>
                    <option value="seragam olahraga">Seragam Olahraga</option>
                    <option value="rompi">Rompi</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" id="foto" name="foto" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Tambah Jenis Produk</button>
        </form>
    </div>

    <!-- Menggunakan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
