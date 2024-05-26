<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $nameToDelete = $data['name'];

    $file = '../contact.json';
    $jsonData = file_get_contents($file);
    $formDataArray = json_decode($jsonData, true);

    if ($formDataArray) {
        foreach ($formDataArray as $key => $formData) {
            if ($formData['name'] === $nameToDelete) {
                unset($formDataArray[$key]);
                break;
            }
        }
        file_put_contents($file, json_encode(array_values($formDataArray)));

        echo json_encode(['success' => true]);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
        exit;
    }
}

$formDataArray = [];

$file = '../contact.json';
$jsonData = file_get_contents($file);
$formDataArray = json_decode($jsonData, true);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus Programming</title>
    <link rel="stylesheet" href="css/comment.css">
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
            <a href="comment.php" class="nav-link"  id="active" id="active">Contact</a>
            <a href="bukti_riwayat.php" class="nav-link">Riwayat</a>
            <a href="peserta.php" class="nav-link">Peserta</a>
            <a href="show_video.php" class="nav-link">Show Video</a>
            <a href="add_video.php" class="nav-link">Add Video</a>
            <a href="../index.php" class="nav-link" id="log-out">Log out</a>
        </nav>
      </div>
    </header>
<table>
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>No Telepon</th>
            <th>Comment</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($formDataArray as $formData) {
            echo "<tr>
                    <td>{$formData['name']}</td>
                    <td>{$formData['mail']}</td>
                    <td>{$formData['phone']}</td>
                    <td>{$formData['comment']}</td>
                    <td><button class='delete-btn' onclick=\"deleteComment('{$formData['name']}')\">Hapus</button></td>
                </tr>";
        }
        ?>
    </tbody>
</table>

<script src="../js/contact.js"></script>
</body>
</html>