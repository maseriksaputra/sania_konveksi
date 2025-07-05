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

// Query untuk mengambil data portofolio beserta nama produk
$sql = "SELECT id_portofolio, nama_produk, gambar FROM portofolio";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Sania Konveksi</title>
    <!-- Menggunakan Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- CSS Kustom -->
    <style>
        /* Gaya gambar portofolio */
        .portfolio-image {
            width: 100%;
            height: auto;
            object-fit: cover; /* Memastikan gambar memenuhi area tanpa distorsi */
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Efek hover pada gambar */
        .portfolio-image:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Gaya kartu portofolio */
        .portfolio-card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .portfolio-card:hover {
            transform: translateY(-5px); /* Efek mengangkat kartu */
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        /* Gaya untuk container portofolio */
        section#portofolio {
            padding-top: 24px;
            padding-bottom: 24px;
        }

        /* Membuat tampilan responsif */
        @media (max-width: 640px) {
            .portfolio-card {
                max-width: 100%;
            }
        }

    </style>
</head>
<body class="bg-gray-100">

<!-- Portofolio Section -->
<section id="portofolio" class="py-8">
    <h1 class="text-3xl font-semibold text-center mb-6 text-gray-800">Portofolio Sania Konveksi</h1>
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

            <?php
            // Periksa apakah ada data portofolio
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Path untuk gambar portofolio
                    $image_path = 'portofolio/images/' . $row["gambar"];

                    // Jika gambar tidak ada, gunakan gambar default
                    if (!file_exists($image_path) || empty($row["gambar"])) {
                        $image_path = 'portofolio/images/default.png';
                    }

                    // Menampilkan data portofolio dengan desain yang modern dan responsif
                    echo '
                    <div class="portfolio-card">
                        <img src="' . $image_path . '" alt="Portofolio ' . $row["id_portofolio"] . '" class="portfolio-image" />
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-center text-gray-800">' . $row["nama_produk"] . '</h3>
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
