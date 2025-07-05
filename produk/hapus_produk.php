<?php
include('../koneksi.php');

// Ambil id_produk dari URL
$id_produk = isset($_GET['id_produk']) ? $_GET['id_produk'] : '';

if ($id_produk) {
    // Hapus produk berdasarkan id_produk
    $sql = "DELETE FROM produk WHERE id_produk = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();

    // Cek apakah berhasil
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Produk berhasil dihapus!'); window.location='kelola_produk.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus produk!');</script>";
    }
} else {
    echo "<script>alert('ID Produk tidak valid!'); window.location='kelola_produk.php';</script>";
}

$conn->close();
?>
