<?php
// Pastikan jalur file 'koneksi.php' benar
include('../koneksi.php'); // Sesuaikan dengan lokasi sebenarnya
include('../header_admin.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $jenis_produk = $_POST['jenis_produk'];  // Menggunakan jenis_produk, bukan jenis
    $keterangan = $_POST['keterangan'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $ukuran = $_POST['ukuran'];
    $tanggal_upload = date('Y-m-d H:i:s'); // Mendapatkan tanggal dan waktu saat ini

    // Pastikan folder 'images' sudah dibuat
    if (!is_dir('images')) {
        mkdir('images', 0777, true);
    }

    // Query untuk menambahkan produk ke tabel produk_baru
    $sql_produk = "INSERT INTO produk (nama_produk, jenis_produk, keterangan, harga, stok, ukuran, tanggal_upload)
                   VALUES ('$nama_produk', '$jenis_produk', '$keterangan', '$harga', '$stok', '$ukuran', '$tanggal_upload')";

    if ($conn->query($sql_produk) === TRUE) {
        // Ambil id_produk yang baru dimasukkan
        $id_produk = $conn->insert_id;

        // Memproses upload thumbnail (periksa apakah kolom 'thumbnail_url' ada di tabel)
        if (isset($_FILES['thumbnail'])) {
            $thumbnail_name = $_FILES['thumbnail']['name'];
            $thumbnail_tmp_name = $_FILES['thumbnail']['tmp_name'];
            $thumbnail_target = "images/" . basename($thumbnail_name);

            if (move_uploaded_file($thumbnail_tmp_name, $thumbnail_target)) {
                // Jika kolom thumbnail_url ada di tabel produk_baru
                $sql_thumbnail = "UPDATE produk SET thumbnail_url = '$thumbnail_name' WHERE id_produk = '$id_produk'";
                if ($conn->query($sql_thumbnail) === FALSE) {
                    echo "<div class='alert alert-danger'>Error saat menyimpan thumbnail: " . $conn->error . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Gagal mengupload thumbnail.</div>";
            }
        }

        // Memproses upload foto dan keterangan warna
        if (isset($_FILES['foto'])) {
            $foto_count = count($_FILES['foto']['name']); // Mengetahui jumlah file foto yang diupload

            // Menyimpan semua foto
            for ($i = 0; $i < $foto_count; $i++) {
                $foto_name = $_FILES['foto']['name'][$i];
                $foto_tmp_name = $_FILES['foto']['tmp_name'][$i];
                $warna_foto = isset($_POST['warna_foto'][$i]) ? $_POST['warna_foto'][$i] : ''; // Ambil warna foto

                // Tentukan lokasi penyimpanan foto
                $target_dir = "images/";
                $target_file = $target_dir . basename($foto_name);

                // Pindahkan file foto ke folder 'images'
                if (move_uploaded_file($foto_tmp_name, $target_file)) {
                    // Simpan foto produk ke tabel foto_produk
                    $sql_foto = "INSERT INTO foto_produk (id_produk, foto_url) VALUES ('$id_produk', '$foto_name')";
                    if ($conn->query($sql_foto) === TRUE) {
                        $id_foto_baru = $conn->insert_id; // Ambil ID foto yang baru dimasukkan

                        // Cek jika ada warna untuk foto, dan simpan ke tabel warna jika belum ada
                        if (!empty($warna_foto)) {
                            // Periksa apakah warna sudah ada di tabel warna
                            $sql_check_warna = "SELECT id_warna FROM warna WHERE warna = '$warna_foto'";
                            $result = $conn->query($sql_check_warna);
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $id_warna = $row['id_warna']; // Ambil ID warna yang sudah ada
                            } else {
                                // Jika warna belum ada, masukkan ke tabel warna
                                $sql_insert_warna = "INSERT INTO warna (warna) VALUES ('$warna_foto')";
                                if ($conn->query($sql_insert_warna) === TRUE) {
                                    $id_warna = $conn->insert_id; // Ambil ID warna yang baru dimasukkan
                                } else {
                                    echo "<div class='alert alert-danger'>Gagal menyimpan warna: " . $conn->error . "</div>";
                                }
                            }

                            // Hubungkan foto dengan warna di tabel foto_warna (relasi foto dan warna)
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

            // Jika semua foto berhasil diupload, redirect ke halaman dashboard_admin.php
            header("Location: dashboard_admin.php");
            exit(); // Pastikan script berhenti setelah header
        } else {
            echo "<div class='alert alert-danger'>Tidak ada foto yang diupload.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error saat menambahkan produk: " . $conn->error . "</div>";
    }

    $conn->close();
}
?>

<!-- HTML Form tetap seperti sebelumnya -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        .image-preview {
            max-height: 200px;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Tambah Produk</h2>
        <form method="POST" enctype="multipart/form-data" class="p-4 shadow rounded bg-white">
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk" class="form-control" required>
            </div>
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
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea id="keterangan" name="keterangan" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" id="harga" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" id="stok" name="stok" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ukuran" class="form-label">Ukuran</label>
                <input type="text" id="ukuran" name="ukuran" class="form-control" required>
            </div>

            <!-- Form untuk mengupload foto dan memberi keterangan warna -->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto Produk</label>
                <input type="file" id="foto" name="foto[]" class="form-control" multiple required onchange="previewImages()">
                <small class="text-muted">Pilih beberapa foto untuk produk ini.</small>
            </div>
            <div id="foto-previews" class="mb-3"></div>

            <div id="warna-previews" class="mb-3"></div>

            <!-- Input Thumbnail Produk -->
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail Produk</label>
                <input type="file" id="thumbnail" name="thumbnail" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Tambah Produk</button>
        </form>
    </div>

    <script>
        // Fungsi untuk melihat preview foto yang diupload
        function previewImages() {
            var previewContainer = document.getElementById('foto-previews');
            var warnaContainer = document.getElementById('warna-previews');
            previewContainer.innerHTML = ''; // Clear previous previews
            warnaContainer.innerHTML = ''; // Clear previous color inputs

            var files = document.getElementById('foto').files;
            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var img = document.createElement('img');
                    img.src = event.target.result;
                    img.classList.add('image-preview');
                    previewContainer.appendChild(img);

                    // Create color input for each image
                    var colorInput = document.createElement('input');
                    colorInput.type = 'text';
                    colorInput.name = 'warna_foto[]';
                    colorInput.classList.add('form-control', 'mb-2');
                    colorInput.placeholder = 'Masukkan warna foto (opsional)';
                    warnaContainer.appendChild(colorInput);
                }
                reader.readAsDataURL(files[i]);
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
