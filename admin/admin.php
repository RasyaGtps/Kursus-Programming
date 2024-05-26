<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus Programming</title>
    <link rel="stylesheet" href="css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet"/>
    <link rel="icon" href="../img/Screenshot 2024-02-21 214242.png" type="image/png">
</head>
<body>
<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
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
            <a href="admin.php" class="nav-link" id="active">User</a>
            <a href="comment.php" class="nav-link">Contact</a>
            <a href="bukti_riwayat.php" class="nav-link">Riwayat</a>
            <a href="peserta.php" class="nav-link">Peserta</a>
            <a href="show_video.php" class="nav-link">Show Video</a>
            <a href="add_video.php" class="nav-link">Add Video</a>
            <a href="../index.php" class="nav-link" id="log-out">Log out</a>
        </nav>
    </div>
</header>

<table id="data-table">
    <thead>
        <tr>
            <th>id_pengguna</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role</th>
            <th>Login Time</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<script src="../js/admin.js"></script>

<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['action'])) {
    if ($_GET['action'] === 'delete') {
        $id_pengguna = $_GET['id_pengguna'];

        // Hapus dari tabel transaksi berdasarkan nomor telepon di peserta
        $delete_transaksi_query = "DELETE FROM transaksi WHERE nomor_telepon IN (SELECT nomor_telepon FROM peserta WHERE id_pengguna = '$id_pengguna')";
        mysqli_query($conn, $delete_transaksi_query);

        // Hapus dari tabel peserta berdasarkan id pengguna
        $delete_peserta_query = "DELETE FROM peserta WHERE id_pengguna = '$id_pengguna'";
        mysqli_query($conn, $delete_peserta_query);

        // Hapus dari tabel pengguna berdasarkan id pengguna
        $delete_pengguna_query = "DELETE FROM pengguna WHERE id_pengguna = '$id_pengguna'";
        mysqli_query($conn, $delete_pengguna_query);
        
        $response['success'] = true;
        echo json_encode($response);
        exit;
    }
}

mysqli_close($conn);
?>
</body>
</html>
