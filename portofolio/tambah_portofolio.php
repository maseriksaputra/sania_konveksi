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

$success_message = "";
$error_message = "";

// Proses jika formulir di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil nilai nama_produk dari form
    $nama_produk = $_POST['nama_produk'];
    
    // Periksa apakah file gambar ada dan valid
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $file_name = $_FILES['gambar']['name'];
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $file_size = $_FILES['gambar']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Cek ekstensi file gambar yang diizinkan (misalnya .jpg, .jpeg, .png)
        $allowed_ext = ['jpg', 'jpeg', 'png'];

        if (in_array($file_ext, $allowed_ext)) {
            // Tentukan path penyimpanan gambar
            $upload_dir = 'portofolio/images/';
            
            // Pastikan folder upload ada, jika tidak buat folder
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Membuat folder jika belum ada
            }

            // Membuat nama file baru untuk menghindari konflik nama
            $new_file_name = uniqid() . '.' . $file_ext;
            $upload_path = $upload_dir . $new_file_name;

            // Pindahkan gambar ke folder upload
            if (move_uploaded_file($file_tmp, $upload_path)) {
                // Simpan nama produk dan gambar ke database
                $sql = "INSERT INTO portofolio (nama_produk, gambar) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $nama_produk, $new_file_name);

                if ($stmt->execute()) {
                    // Jika berhasil, set pesan sukses dan redirect
                    header("Location: portofolio_tambah.php?success=1"); // Redirect dengan query string
                    exit();
                } else {
                    $error_message = "Terjadi kesalahan saat menyimpan data ke database.";
                }
            } else {
                $error_message = "Gagal mengunggah gambar.";
            }
        } else {
            $error_message = "Hanya file gambar (.jpg, .jpeg, .png) yang diizinkan.";
        }
    } else {
        $error_message = "Pilih file gambar untuk diunggah.";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Portofolio</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold text-center mb-6">Tambah Portofolio</h1>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="bg-green-500 text-white p-4 mb-4 rounded">Portofolio berhasil ditambahkan!</div>
    <?php elseif (!empty($error_message)): ?>
        <div class="bg-red-500 text-white p-4 mb-4 rounded"><?= $error_message; ?></div>
    <?php endif; ?>

    <!-- Formulir Unggah Gambar Portofolio -->
    <form action="portofolio_tambah.php" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="nama_produk" class="block text-lg font-semibold text-gray-700">Nama Produk</label>
            <input type="text" name="nama_produk" id="nama_produk" class="mt-2 p-2 w-full border border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="gambar" class="block text-lg font-semibold text-gray-700">Pilih Gambar Portofolio</label>
            <input type="file" name="gambar" id="gambar" class="mt-2 p-2 w-full border border-gray-300 rounded" accept="image/*" required>
        </div>
        
        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white p-3 rounded w-full">Tambah Portofolio</button>
        </div>
    </form>
</div>

</body>
</html>

<?php
// Menutup koneksi
$conn->close();
?>
