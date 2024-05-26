<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursus";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan data kursus dari database
$query = "SELECT id_kursus, nama_kursus FROM kursus";
$result = $conn->query($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $no_telepon = $_POST["no_telepon"];
    $selected_kursus = $_POST["selected-kursus"];

    $check_user_query = "SELECT id_pengguna, role FROM pengguna WHERE nama LIKE '%$nama%'";
    $result_user = $conn->query($check_user_query);

    if ($result_user->num_rows > 0) {
        $row = $result_user->fetch_assoc();
        $id_pengguna = $row["id_pengguna"];
        $role = $row["role"];

        if ($role != "peserta") {
            $update_role_query = "UPDATE pengguna SET role = 'peserta' WHERE id_pengguna = $id_pengguna";
            $conn->query($update_role_query);
        }
    } else {
        $id_pengguna = NULL;
    }

    // Fungsi untuk menghasilkan ID acak
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

        $status = "Gagal membuat id baru setelah $maxAttempts";
        return null;
    }

    $id_transaksi = generateRandomId();

    $insert_peserta_query = "INSERT INTO peserta (nomor_telepon, nama_pengguna, id_pengguna, id_kursus)
                            VALUES ('$no_telepon', '$nama', $id_pengguna, $selected_kursus)";

    $insert_transaksi_query = "INSERT INTO transaksi (id_transaksi, nomor_telepon, id_kursus)
                               VALUES ('$id_transaksi', '$no_telepon', $selected_kursus)";

    if ($conn->query($insert_peserta_query) === TRUE && $conn->query($insert_transaksi_query) === TRUE) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Error: " . $insert_peserta_query . "<br>" . $conn->error;
        echo "Error: " . $insert_transaksi_query . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kursus Programming</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="../css/join.css" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet"/>
    <link rel="icon" href="../img/Screenshot 2024-02-21 214242.png" type="image/png">
</head>
<body>
<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Jika sesi tidak ditemukan, redirect ke halaman login
    header("Location: ../login.php");
    exit();
}
?>
<header id="header">
    <div class="header-content-div">
        <div class="logo-and-username">
            <a href="#home-sec"> 
                <img src="../img/Screenshot 2024-02-21 214242.png" alt="Company Logo" id="header-img" />
            </a>
            <span id="username"><?php echo $username; ?></span>
        </div>
        <nav id="nav-bar">
            <a href="index.php" class="nav-link">Home</a>
            <a href="about.php" class="nav-link">About</a>
            <a href="benefits.php" class="nav-link">Benefits</a>
            <a href="contact.php" class="nav-link">Contact</a>
            <a href="join.php" class="nav-link" id="active">Join Us</a>
            <a href="../index.php" class="nav-link" id="log-out">Log out</a>
        </nav>
    </div>
</header>
<div class="page-content">
    <div class="form-v6-content">
        <div class="form-left">
            <img src="../img/Screenshot 2024-02-21 214242.png" alt="form">
        </div>
        <form class="form-detail" action="#" method="post">
            <h2>Join Us</h2>
            <div class="form-row">
                <input type="text" name="nama" id="full-name" class="input-text" placeholder="Nama" required>
            </div>
            <div class="form-row">
                <input type="text" name="no_telepon" id="no" class="input-text" placeholder="No telepon" required>
            </div>
            <div class="form-row">
                <select name="selected-kursus" id="choose-kursus" required>
                    <option value="" disabled selected>Pilih Kursus</option>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id_kursus'] . "'>" . $row['nama_kursus'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-row-last">
                <input type="submit" name="register" class="register" value="Register">
            </div>
        </form>
    </div>
</div>
</body>
</html>
