<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kursus Programming</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="../css/kursus.css" />
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
                <a href="kursus.php" class="nav-link" id="active">Kursus</a>
                <a href="../index.php" class="nav-link" id="log-out">Log out</a>
            </nav>
        </div>
    </header>
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

// Mendapatkan id_pengguna berdasarkan username dari sesi
$sql_user = "SELECT id_pengguna FROM pengguna WHERE username = ?";
$stmt_user = $conn->prepare($sql_user); // Mempersiapkan query
$stmt_user->bind_param("s", $username); // Mengikat parameter
$stmt_user->execute(); // Mengeksekusi statement
$result_user = $stmt_user->get_result(); // Mendapatkan hasil

$kursus_names = array();
if ($result_user->num_rows > 0) {
    $user_data = $result_user->fetch_assoc();
    $id_pengguna = $user_data['id_pengguna'];

    // Mendapatkan id_kursus dan nama_kursus berdasarkan id_pengguna dari tabel peserta
    $sql_peserta = "SELECT peserta.id_kursus, kursus.nama_kursus 
                    FROM peserta 
                    JOIN kursus ON peserta.id_kursus = kursus.id_kursus 
                    WHERE peserta.id_pengguna = ?";
    $stmt_peserta = $conn->prepare($sql_peserta); // Mempersiapkan query
    $stmt_peserta->bind_param("i", $id_pengguna); // Mengikat parameter
    $stmt_peserta->execute(); // Mengeksekusi statement
    $result_peserta = $stmt_peserta->get_result(); // Mendapatkan hasil

    $kursus_ids = array();
    while ($row_peserta = $result_peserta->fetch_assoc()) {
        $kursus_ids[] = $row_peserta['id_kursus'];
        $kursus_names[] = $row_peserta['nama_kursus'];
    }
}
?>

<h3 class="section-heading">Video Kursus
    <?php 
    if (!empty($kursus_names)) {
        echo implode(', ', $kursus_names) ;
    }
    ?>
</h3>
<div class="kursus-container">
<?php
// Jika pengguna terdaftar di kursus apapun
if (!empty($kursus_ids)) {
    $kursus_ids_placeholder = implode(',', array_fill(0, count($kursus_ids), '?'));
    $sql_video = "SELECT * FROM video WHERE id_kursus IN ($kursus_ids_placeholder)";
    $stmt_video = $conn->prepare($sql_video); // Mempersiapkan query
    $types = str_repeat('i', count($kursus_ids));
    $stmt_video->bind_param($types, ...$kursus_ids); // Mengikat parameter
    $stmt_video->execute(); // Mengeksekusi statement
    $result_video = $stmt_video->get_result(); // Mendapatkan hasil

    if ($result_video->num_rows > 0) {
        while ($row_video = $result_video->fetch_assoc()) {
            echo '<div class="sec-content-div flexible">';
            echo '<div class="tile">';
            echo '<iframe width="280" height="154.5" src="' . htmlspecialchars($row_video['link_video']) . '" frameborder="0" allowfullscreen></iframe>';
            echo '<h4>' . htmlspecialchars($row_video['judul_video']) . '</h4>';
            echo '<p>' . htmlspecialchars($row_video['deskripsi_video']) . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>Tidak ada video kursus yang ditemukan.</p>";
    }
} else {
    echo "<p>Anda belum terdaftar di kursus manapun.</p>";
}
$conn->close();
?>
</div>
</body>
</html>
