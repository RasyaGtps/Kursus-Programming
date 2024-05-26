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

function generateRandomVideoId($length = 8) {
    global $conn;

    $maxAttempts = 10;
    $attempts = 0;

    do {
        $numericId = '';
        
        for ($i = 0; $i < $length; $i++) {
            $numericId .= rand(1, 9);
        }

        $checkExistingId = "SELECT id_video FROM video WHERE id_video = '$numericId'";
        $result = mysqli_query($conn, $checkExistingId);

        if (mysqli_num_rows($result) == 0) {
            return $numericId;
        }

        $attempts++;
    } while ($attempts < $maxAttempts);

    $status = "Failed to generate a new ID after $maxAttempts attempts";
    return null;
}

function getYouTubeVideoId($url) {
    $videoId = null;

    $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
    
    preg_match($pattern, $url, $matches);

    if (isset($matches[1])) {
        $videoId = $matches[1];
    }

    return $videoId;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_video = generateRandomVideoId();
    $link_video = $_POST['link_video'];
    $judul_video = $_POST['judul_video'];
    $deskripsi_video = $_POST['deskripsi_video'];
    
    $selected_kursus = $_POST['selected-kursus'];

    $youtubeVideoId = getYouTubeVideoId($link_video);
    if ($youtubeVideoId) {
        $link_video = "https://www.youtube.com/embed/$youtubeVideoId";
    }

    $sql = "INSERT INTO video (id_video, id_kursus, link_video, judul_video, deskripsi_video) VALUES ('$id_video', '$selected_kursus', '$link_video', '$judul_video', '$deskripsi_video')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../add_video.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }    
}

mysqli_close($conn);
?>
