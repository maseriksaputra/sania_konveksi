<?php
session_start();

// Include koneksi ke database
include('koneksi.php');

// Cek jika pengguna sudah login dan sudah berada di halaman login
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    header('Location: dashboard_admin.php');
    exit();
}

// Variabel untuk menampung pesan error
$error = '';

// Proses login saat form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil input dari form
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Sanitasi input untuk mencegah SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Cek apakah username ada di tabel admin (admin)
    $sql_admin = "SELECT * FROM admin_konveksi WHERE username = ?";
    $stmt_admin = $conn->prepare($sql_admin);
    $stmt_admin->bind_param('s', $username);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    // Jika ditemukan di tabel admin
    if ($result_admin->num_rows > 0) {
        $user_admin = $result_admin->fetch_assoc();

        // Verifikasi password untuk admin menggunakan password_verify()
        if (password_verify($password, $user_admin['password'])) {
            // Set session untuk role admin
            $_SESSION['role'] = 'admin';  // Set session untuk role admin
            $_SESSION['id'] = $user_admin['id'];  // Set session untuk id_admin
            $_SESSION['username'] = $username;  // Set session untuk username

            // Redirect ke dashboard admin setelah login berhasil
            header('Location: dashboard_admin.php');
            exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
        } else {
            $error = 'Username atau Password salah!';
        }
    } else {
        $error = 'Username atau Password salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap">
    <style>
        /* Style CSS untuk form login */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #4e73df, #1f58c4);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .login-container {
            background: #ffffff;
            border-radius: 8px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5rem;
            color: #333;
        }

        .input-field {
            position: relative;
            margin-bottom: 20px;
        }

        .input-field input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .input-field input:focus {
            border-color: #00bcd4;
        }

        .input-field label {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #333;
            pointer-events: none;
            transition: 0.3s ease;
        }

        .input-field input:focus + label,
        .input-field input:not(:placeholder-shown) + label {
            top: -10px;
            font-size: 0.9rem;
            color: #00bcd4;
        }

        .input-field input[type="password"]:focus + label,
        .input-field input[type="text"]:focus + label {
            color: #00bcd4;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }

        .login-btn {
            width: 100%;
            padding: 12px 0;
            border: none;
            background-color: #00bcd4;
            color: white;
            font-size: 1.1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #0097a7;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .footer a {
            color: #00bcd4;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login to Your Account</h2>
        
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="login.php" method="POST">
            <div class="input-field">
                <input type="text" name="username" id="username" required placeholder=" " autocomplete="off">
                <label for="username">Username</label>
            </div>

            <div class="input-field">
                <input type="password" name="password" id="password" required placeholder=" " autocomplete="off">
                <label for="password">Password</label>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <div class="footer">
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </div>

</body>
</html>
