<?php
session_start();  // Mulai sesi PHP

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "kursus";

// Membuat koneksi ke database
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Reset session error
    unset($_SESSION['error_username']);
    unset($_SESSION['error_email']);

    // Cek apakah password dan confirm password sesuai
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Password dan Confirm Password tidak sesuai.";
        header("Location: ../index.php");
        exit();
    } else {
        // Cek apakah username sudah digunakan
        $checkUsernameQuery = "SELECT username FROM pengguna WHERE username = '$username'";
        $resultUsername = mysqli_query($conn, $checkUsernameQuery);

        // Cek apakah email sudah digunakan
        $checkEmailQuery = "SELECT email FROM pengguna WHERE email = '$email'";
        $resultEmail = mysqli_query($conn, $checkEmailQuery);

        $errors = [];

        if (mysqli_num_rows($resultUsername) > 0) {
            // Username sudah digunakan
            $_SESSION['error_username'] = "Username telah digunakan. Silakan pilih username lain.";
        }

        if (mysqli_num_rows($resultEmail) > 0) {
            // Email sudah digunakan
            $_SESSION['error_email'] = "Email telah digunakan. Silakan gunakan email lain.";
        }

        if (isset($_SESSION['error_username']) || isset($_SESSION['error_email'])) {
            header("Location: ../index.php");
            exit();
        } else {
            // Membuat ID acak
            function generateRandomId($length = 3) {
                global $conn;

                $maxAttempts = 10;
                $attempts = 0;

                do {
                    $numbers = range(0, 9);
                    shuffle($numbers);
                    $randomString = implode('', array_slice($numbers, 0, $length));
                    
                    $checkExistingId = "SELECT id_pengguna FROM pengguna WHERE id_pengguna = '$randomString'";
                    $result = mysqli_query($conn, $checkExistingId);

                    if (mysqli_num_rows($result) == 0) {
                        return $randomString;
                    }

                    $attempts++;
                } while ($attempts < $maxAttempts);

                return null;
            }

            $id_pengguna = generateRandomId();

            if ($id_pengguna !== null) {
                $role = 'user';
                $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

                if (!$email) {
                    $_SESSION['error'] = "Harap masukkan email dengan benar.";
                    header("Location: ../index.php");
                    exit();
                } else {
                    $sql = "INSERT INTO pengguna (id_pengguna, nama, username, email, alamat, password, role) VALUES ('$id_pengguna', '$nama', '$username', '$email', '$alamat', '$password', '$role')";

                    if (mysqli_query($conn, $sql)) {
                        header("Location: ../load/success.php");
                        exit();
                    } else {
                        $_SESSION['error'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
                        header("Location: ../index.php");
                        exit();
                    }
                }
            } else {
                $_SESSION['error'] = "Gagal membuat ID pengguna. Silakan coba lagi.";
                header("Location: ../index.php");
                exit();
            }
        }
    }
}

mysqli_close($conn);
?>
