
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Kursus</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="../css/benefits.css" />
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
          <a href="benefits.php" class="nav-link" id="active">Benefits</a>
          <a href="contact.php" class="nav-link">Contact</a>
          <a href="join.php" class="nav-link">Join Us</a>
          <a href="../index.php" class="nav-link" id="log-out">Log out</a>
        </nav>
      </div>
    </header>

    <section id="home-sec" class="flexible home-sec">
        <div class="eye-grabber">
          <h1>Benefits</h1>
          <h2>Keuntungan bergabung dengan kami!</h2>
        </div>
        <div class="eye-grabber-img">
            <img src="../img/images.jpeg" alt=""/>
          </div>
    <h3 class="section-heading"></h3>
    <div class="sec-content-div flexible">
      <div class="tile">
        <h4>Beginner</h4>
<ul>
    <li>Mendapatkan pandangan terhadap coding</li>
    <li>Mendapatkan bimbingan codingan pertama seperti html dan css</li>
</ul>
      </div>
      <div class="tile">
        <h4>Advance</h4>
       <ul>
        <li>Mendapatkan ilmu dalam membuat web seperti PHP , JavaScript , Dll  </li>
        <li>Bimbingan terhadap database seperti MySql</li>
        <li>Dapat bimbingan dalam membuat web statis</li>
       </ul>
      </div>
      <div class="tile">
        <h4>Expert</h4>
        <ul>
            <li>Mendapatkan bimbingan terhadap machine learning seperti Python , Java , C++ , dll</li>
            <li>Mendapatkan bantuan dalam membuat CV (Jika sudah kuliah)</li>
        </ul>
      </div>
    </div>
  </section>
</body>
</html>
