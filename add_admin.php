<?php
// Koneksi ke database
$host = 'localhost';
$dbname = 'dbkonveksi';
$username = 'root';  // Ganti dengan username MySQL Anda
$password = '';      // Ganti dengan password MySQL Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cek apakah form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form
        $admin_username = $_POST['username'];
        $admin_password = $_POST['password'];

        // Hash password menggunakan password_hash()
        $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

        // Query untuk menambahkan admin ke tabel tbl_admin
        $sql = "INSERT INTO tbl_admin (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $admin_username);
        $stmt->bindParam(':password', $hashed_password);

        // Eksekusi query dan periksa apakah berhasil
        if ($stmt->execute()) {
            echo "Admin berhasil ditambahkan!";
        } else {
            echo "Terjadi kesalahan saat menambahkan admin.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!-- Form untuk menambahkan admin -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>
</head>
<body>
    <h2>Tambah Admin Baru</h2>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Tambah Admin">
    </form>
</body>
</html>
