<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Sania Konveksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
  /* Base Styles */
  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
  }

  /* Animations */
  @keyframes fadeIn {
    0% {
      opacity: 0;
      transform: translateY(20px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Smooth Scroll */
  html {
    scroll-behavior: smooth;
  }

  /* Header Styles */
  header {
    position: absolute;
    width: 100%;
    z-index: 10;
    transition: background-color 0.3s ease;
  }

  header.transparent {
    background-color: transparent;
  }

  header.scrolled {
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .logo img {
    height: 50px;
  }
  
  nav a {
    text-transform: uppercase;
    font-size: 14px;
    font-weight: bold;
    color: #fff;
    text-decoration: none;
    margin-left: 20px;
    transition: color 0.3s;
  }

  nav a:hover {
    color: #15B392;
  }

  nav a.scrolled-nav {
    color: #333;
  }

  .login-btn {
    background-color: #15B392;
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    display: flex;
    align-items: center;
    font-weight: bold;
    transition: background-color 0.3s;
  }

  .login-btn:hover {
    background-color: #15B392;
  }

  .main-banner {
  position: relative;
  width: 100%;
  padding-top: 46%;
  overflow: hidden;
}

.main-banner img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.main-banner::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.2); /* Darken by 20% */
  z-index: 1;
}


  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 40px;
  }

/* Teks untuk judul pada overlay */
.overlay h1 {
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: white; /* Menambahkan warna putih pada teks judul */
}

.overlay h2 {
    font-size: 2rem;
    color: #15B392; /* Menjaga warna hijau untuk subjudul */
    margin-bottom: 20px;
}

.overlay p {
    font-size: 1.2rem;
    margin-bottom: 30px;
    color: white; /* Mengubah warna teks deskripsi menjadi putih */
}


  .button-group a {
    text-decoration: none;
    padding: 12px 25px;
    border-radius: 25px;
    margin-right: 10px;
    font-size: 1.1rem;
    text-transform: uppercase;
    font-weight: bold;
    transition: background-color 0.3s;
  }

  .button-group .primary-btn {
    background-color: #15B392;
    color: white;
  }

  .button-group .primary-btn:hover {
    background-color: #15B392;
  }

  .button-group .secondary-btn {
    background-color: white;
    color: #333;
    border: 2px solid #15B392;
  }

  .button-group .secondary-btn:hover {
    background-color: #f4f4f4;
  }

  /* Section Styles */
  .section-title {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 50px;
    color: #333;
  }

  .section-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  /* Scroll to top button */
  .scroll-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #15B392;
    color: white;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s;
  }

  .scroll-to-top:hover {
    background-color: #15B392;
  }

  /* Gaya untuk tombol order */
  .order-button {
    background-color: white;
    color: #15B392; /* Warna hijau keputihan */
    font-size: 18px;
    font-weight: bold;
    padding: 12px 30px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s, transform 0.3s;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  /* Menambahkan sedikit jarak antara ikon dan teks */
  .order-button i {
    margin-right: 10px;
  }

  /* Efek hover */
  .order-button:hover {
    background-color: #15B392; /* Hijau keputihan saat hover */
    color: white; /* Teks menjadi putih */
    transform: scale(1.1); /* Efek sedikit membesar */
  }

  /* Efek untuk transisi warna teks dan background */
  .order-button:active {
    background-color: #12A57E;
    color: white;
  }
</style>

  </head>

  <body class="font-sans">
  <!-- Custom Header -->
  <header class="transparent">
    <div class="header-container">
      <div class="logo">
        <img alt="Bikin.co logo" src="https://storage.googleapis.com/a1aa/image/eONOzqoAfoulpUTL61LETkwPutf4efUEZdaRw5rkdNIeVg88E.jpg" />
      </div>
      <nav>
        <a href="#produk">Produk</a>
        <a href="#jenis">Jenis Produk</a>
        <a href="#portofolio">Portofolio</a>
        <a href="#order-section">Order</a>
        <a href="#alamat">Alamat</a>
      </nav>
      <a class="login-btn" href="login.php">
        <i class="fas fa-sign-in-alt mr-2"></i> Login
      </a>
    </div>
  </header>

    <!-- Main Content -->
    <main>
    <section class="main-banner">
    <img src="https://storage.googleapis.com/a1aa/image/lfxQzL2Z1rUwGCLRkyLgrPdBvebfqSmZAngojukTCswxCknnA.jpg" alt="Banner Image" />
    <div class="overlay fade-in">
        <h1>Sania Konveksi</h1>
        <h2>Terpercaya</h2>
        <p>Apapun kebutuhan baju anda, bikin di saniakonveksi.co aja!</p>
        <div class="button-group">
            <a class="primary-btn" href="#">Cek Layanan saniakonveksi.co</a>
            <!-- URL WhatsApp dengan pesan yang diisi otomatis -->
            <a class="secondary-btn" href="https://wa.me/082250791395?text=Halo,%20saya%20tertarik%20untuk%20membeli%20produk%20anda.%0A%0A%2A%20Nama%20Produk%3A%20<?= urlencode($nama_produk) ?>%0A%2A%20Jenis%20Produk%3A%20<?= urlencode($jenis_produk) ?>%0A%2A%20Ukuran%3A%20<?= urlencode($ukuran) ?>%0A%2A%20Warna%3A%20<?= urlencode($warna) ?>%0A%2A%20Jumlah%3A%20<?= urlencode($jumlah) ?>%20buah%0A%2A%20Harga%20Total%3A%20Rp%20<?= number_format($jumlah * $harga, 0, ',', '.') ?>%0A%2A%20Keterangan%3A%20<?= urlencode($keterangan) ?>" target="_blank">
                <i class="fab fa-whatsapp mr-2"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>

<!-- Link untuk mengarahkan ke WhatsApp -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Untuk mengaktifkan ikon WhatsApp -->





<!-- Produk Section -->
<section id="produk" class="py-16">
    <div class="section-container fade-in">
        <?php
            // Menggunakan include untuk menampilkan produk dari file tampil_jenis_produk.php
            include 'produk/tampil_produk.php';
            ?>
    </div>
</section>

<section id="jenis" class="py-16 bg-[#15B392]">
    <div class="section-container fade-in">
        <?php
            // Menggunakan include untuk menampilkan produk dari file tampil_jenis_produk.php
            include 'jenis_produk/tampil_jenis_produk.php';
        ?>
    </div>
</section>


<section id="portofolio" class="py-16">
    <div class="section-container fade-in">
        <h2 class="section-title">Portofolio</h2>
        <?php
            // Menggunakan include untuk menampilkan produk dari file tampil_jenis_produk.php
            include 'portofolio/portofolio_produk.php';
            ?>
    </div>
</section>

<section id="order-section" class="py-16">
    <div class="section-container fade-in">
        <a href="order.php" class="order-button">
            <i class="fas fa-cart-plus"></i> Order Sekarang
        </a>
    </div>
</section>


<?php
include('footer.php');
?>


    <script>
      const prevButton = document.querySelector('.prev-btn');
      const nextButton = document.querySelector('.next-btn');
      const portfolioWrapper = document.querySelector('.portfolio-wrapper');
      let currentIndex = 0;

      const totalItems = document.querySelectorAll('.portfolio-item').length;

      function updatePortfolio() {
        const offset = -currentIndex * 100;
        portfolioWrapper.style.transform = `translateX(${offset}%)`;
      }

      prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
          currentIndex--;
        } else {
          currentIndex = totalItems - 1;
        }
        updatePortfolio();
      });

      nextButton.addEventListener('click', () => {
        if (currentIndex < totalItems - 1) {
          currentIndex++;
        } else {
          currentIndex = 0;
        }
        updatePortfolio();
      });
    </script>

    <!-- Tombol Scroll ke Atas -->
<div class="scroll-to-top" onclick="scrollToTop()">
    <i class="fas fa-arrow-up"></i> <!-- Ikon panah ke atas -->
</div>

<!-- JavaScript untuk scroll ke atas -->
<script>
    // Fungsi untuk scroll ke atas halaman
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>



  </body>
</html>
