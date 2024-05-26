<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursus";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM pengguna WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['login_time'] = date("Y-m-d H:i:s");

        $login_time = $_SESSION['login_time'];

    $login_time = $_SESSION['login_time'];
    $update_sql = "UPDATE pengguna SET login_time='$login_time' WHERE username='$username'";
    $conn->query($update_sql);

    if ($user['role'] == 'peserta') {
      header("Location: ../load/peserta.php");
    } elseif ($user['role'] == 'user') {
      header("Location: ../load/user.php");
    } elseif ($user['role'] == 'admin') {
      header("Location: ../admin/admin.php");
    }
  } else {
    header("Location: ../load/wrong.php");
  }
}

$conn->close();
?>
