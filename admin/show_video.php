<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus Programming</title>
    <link rel="stylesheet" href="css/show_video.css">
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
            <a href="admin.php" class="nav-link">User</a>
            <a href="comment.php" class="nav-link">Contact</a>
            <a href="bukti_riwayat.php" class="nav-link">Riwayat</a>
            <a href="peserta.php" class="nav-link">Peserta</a>
            <a href="show_video.php" class="nav-link"  id="active">Show Video</a>
            <a href="add_video.php" class="nav-link">Add Video</a>
            <a href="../index.php" class="nav-link" id="log-out">Log out</a>
        </nav>
      </div>
    </header>
<table id="data-table">
    <thead>
        <tr>
            <th>Nama Kursus </th>
            <th>Judul Video</th>
            <th>Deskripsi Video</th>
            <th>Link Video</th>
        </tr>
    </thead>

    <tbody>
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

$sql = "SELECT v.judul_video, v.deskripsi_video, v.link_video, k.nama_kursus
        FROM video v
        INNER JOIN kursus k ON v.id_kursus = k.id_kursus";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($row['nama_kursus']) . "</td>";
      echo "<td>" . htmlspecialchars($row['judul_video']) . "</td>";
      echo "<td>" . htmlspecialchars($row['deskripsi_video']) . "</td>";
      echo "<td>" . htmlspecialchars($row['link_video']) . "</td>";
      echo "</tr>";
  }
} else {
  echo "<tr><td colspan='3'>No data found</td></tr>";
}

$conn->close();
?>
    </tbody>
</table>
</body>
</html>
