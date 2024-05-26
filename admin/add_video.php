<?php

session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../login.php");
    exit();
}

function generateRandomId() {
    $length = 8; 
    $characters = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomId = '';

    for ($i = 2; $i < $length; $i++) {
        $randomId .= $characters[rand(2, strlen($characters) - 1)];
    }

    return $randomId;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus Programming</title>
    <link rel="stylesheet" href="css/add_video.css">
    <link rel="icon" href="../img/Screenshot 2024-02-21 214242.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet"/>
</head>
<body>
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
            <a href="show_video.php" class="nav-link">Show Video</a>
            <a href="add_video.php" class="nav-link" id="active">Add Video</a>
            <a href="../index.php" class="nav-link" id="log-out">Log out</a>
        </nav>
      </div>
    </header>
<form action="connection/add_video.php" method="post" class="turu">
    <input type="hidden" name="id_video" value="<?php echo generateRandomId(); ?>">

    <label for="link_video">Link Video:</label>
    <input type="text" name="link_video" required>

    <label for="judul_video">Judul Video:</label>
    <input type="text" name="judul_video" required>

    <label for="deskripsi_video">Deskripsi Video:</label>
    <input name="deskripsi_video" required></input>

    <!-- Dropdown kursus -->
    <div class="form-row">
        <label for="selected-kursus">Pilih Kursus:</label>
        <select name="selected-kursus" id="selected-kursus" class="input-text" required>
            <option value="" disabled selected>Pilih Kursus</option>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "kursus");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT id_kursus, nama_kursus FROM kursus";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id_kursus'] . "'>" . $row['nama_kursus'] . "</option>";
            }

            mysqli_close($conn);
            ?>
        </select>
    </div>

    <input type="submit" value="Add Video">
</form>


</body>
<style>

</style>
</html>
