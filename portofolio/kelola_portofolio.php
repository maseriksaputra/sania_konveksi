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

// Menambahkan portofolio
if (isset($_POST['add'])) {
    $nama_produk = $_POST['nama_produk'];
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "portofolio/images/";
    $target_file = $target_dir . basename($gambar);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi ekstensi file gambar
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($imageFileType, $allowed_extensions)) {
        echo "Hanya file gambar yang diizinkan (jpg, jpeg, png, gif).";
        exit();
    }

    // Upload gambar
    if ($gambar) {
        // Cek apakah file sudah ada
        if (file_exists($target_file)) {
            echo "Maaf, file gambar sudah ada.";
            exit();
        }

        // Cek ukuran file gambar (max 5MB)
        if ($_FILES['gambar']['size'] > 5000000) {
            echo "Maaf, file gambar terlalu besar. Maksimal 5MB.";
            exit();
        }

        // Pindahkan file gambar yang diupload ke folder tujuan
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            // Menyimpan data ke database
            $sql = "INSERT INTO portofolio (nama_produk, gambar) VALUES ('$nama_produk', '$gambar')";
            if ($conn->query($sql) === TRUE) {
                header("Location: kelola_portofolio.php"); // Redirect setelah menambahkan
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload gambar.";
            exit();
        }
    }
}

// Mengedit portofolio
if (isset($_POST['edit'])) {
    $id_portofolio = $_POST['id_portofolio'];
    $nama_produk = $_POST['nama_produk'];
    $gambar = $_FILES['gambar']['name'];

    $gambar_query = "";
    // Cek apakah gambar baru diupload
    if ($gambar) {
        $target_dir = "portofolio/images/";
        $target_file = $target_dir . basename($gambar);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');

        if (!in_array($imageFileType, $allowed_extensions)) {
            echo "Hanya file gambar yang diizinkan (jpg, jpeg, png, gif).";
            exit();
        }

        // Upload gambar
        if ($_FILES['gambar']['size'] > 5000000) {
            echo "Maaf, file gambar terlalu besar. Maksimal 5MB.";
            exit();
        }

        // Cek jika gambar sudah ada
        if (file_exists($target_file)) {
            echo "Maaf, file gambar sudah ada.";
            exit();
        }

        // Pindahkan gambar ke folder tujuan
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $gambar_query = ", gambar='$gambar'";
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload gambar.";
            exit();
        }
    }

    $sql = "UPDATE portofolio SET nama_produk='$nama_produk' $gambar_query WHERE id_portofolio=$id_portofolio";
    if ($conn->query($sql) === TRUE) {
        header("Location: kelola_portofolio.php"); // Redirect setelah mengedit
        exit();
    }
}

// Menghapus portofolio
if (isset($_GET['delete'])) {
    $id_portofolio = $_GET['delete'];
    $sql = "DELETE FROM portofolio WHERE id_portofolio=$id_portofolio";
    if ($conn->query($sql) === TRUE) {
        header("Location: kelola_portofolio.php"); // Redirect setelah menghapus
        exit();
    }
}

// Query untuk mengambil data portofolio beserta nama produk
$sql = "SELECT id_portofolio, nama_produk, gambar FROM portofolio";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Portofolio Sania Konveksi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .portfolio-image {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .portfolio-image:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .portfolio-card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        section#portofolio {
            padding-top: 24px;
        }
    </style>
</head>
<body class="bg-gray-100">

<!-- Form untuk Menambah Portofolio -->
<section class="py-8">
    <h2 class="text-2xl font-semibold text-center mb-4 text-gray-800">Tambah Portofolio</h2>
    <form action="kelola_portofolio.php" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto bg-white p-6 rounded-md shadow-md">
        <div class="mb-4">
            <label for="nama_produk" class="block text-gray-600">Nama Produk</label>
            <input type="text" name="nama_produk" id="nama_produk" required class="w-full p-2 border border-gray-300 rounded-md" placeholder="Nama produk">
        </div>
        <div class="mb-4">
            <label for="gambar" class="block text-gray-600">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="w-full p-2 border border-gray-300 rounded-md">
        </div>
        <button type="submit" name="add" class="w-full bg-blue-500 text-white p-2 rounded-md">Tambah Portofolio</button>
    </form>
</section>

<!-- Daftar Portofolio -->
<section id="portofolio" class="py-8">
    <h1 class="text-3xl font-semibold text-center mb-6 text-white">Portofolio Sania Konveksi</h1>
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

            <?php
            // Periksa apakah ada data portofolio
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $image_path = 'portofolio/images/' . $row["gambar"];
                    if (!file_exists($image_path) || empty($row["gambar"])) {
                        $image_path = 'portofolio/images/default.png';
                    }

                    echo '
                    <div class="portfolio-card">
                        <img src="' . $image_path . '" alt="Portofolio ' . $row["id_portofolio"] . '" class="portfolio-image" />
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-center">' . $row["nama_produk"] . '</h3>
                            <div class="flex justify-center gap-2 mt-4">
                                <a href="kelola_portofolio.php?edit=' . $row["id_portofolio"] . '" class="text-blue-500">Edit</a>
                                <a href="kelola_portofolio.php?delete=' . $row["id_portofolio"] . '" class="text-red-500">Hapus</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p class='col-span-4 text-center text-xl text-gray-600'>Tidak ada portofolio ditemukan.</p>";
            }

            // Menutup koneksi
            $conn->close();
            ?>

        </div>
    </div>
</section>

</body>
</html>
