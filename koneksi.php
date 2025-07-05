<?php
// Menyambungkan ke database MySQL
$host = "localhost";
$username = "root";            
$password = "";                
$dbname = "dbkonveksi";        
$port = 3306;            

try {
    // Membuat koneksi ke MySQL
    $conn = new mysqli($host, $username, $password, $dbname, $port);

    // Mengecek koneksi, jika gagal akan mengeluarkan pesan error
    if ($conn->connect_error) {
        // Jika koneksi gagal, tampilkan pesan error dengan detail
        throw new Exception("Koneksi gagal: " . $conn->connect_error);
    }

    // Mengatur charset untuk menghindari masalah karakter (terutama dengan karakter non-ASCII)
    $conn->set_charset("utf8");

    // Jika koneksi berhasil, bisa lanjutkan ke halaman lain atau operasi lainnya
    // echo "Koneksi berhasil!";
} catch (Exception $e) {
    // Jika ada kesalahan (exception), tampilkan pesan error
    die("Terjadi kesalahan: " . $e->getMessage());
}
?>
