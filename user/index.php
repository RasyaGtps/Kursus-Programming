
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Kursus</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="../css/styles.css" />
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
          <a href="index.php" class="nav-link" id="active">Home</a>
          <a href="about.php" class="nav-link">About</a>
          <a href="benefits.php" class="nav-link">Benefits</a>
          <a href="contact.php" class="nav-link">Contact</a>
          <a href="join.php" class="nav-link">Join Us</a>
          <a href="../index.php" class="nav-link" id="log-out">Log out</a>
        </nav>
      </div>
    </header>

    <main>
      <section id="home-sec" class="flexible home-sec" src="Coding.jpg">
        <div class="background-img"></div>
        <div class="eye-grabber-img">
          <img src="../img/Coding.jpg" alt="" />
        </div>
        <div class="eye-grabber">
          <h1>Kursus Programming</h1>
          <h2>Latih skillmu bersama kami!</h2>
        </div>
      </section>
      <section id="varieties class" class="sec-padding">
        <h3 class="section-heading">Top 3 alasan kenapa kamu harus bergabung bersama kami</h3>
        <div class="sec-content-div1 flexible">
          <div class="tile">
            <img src="../img/asik.jpg" alt="asik" />
            <h4>Asik</h4>
            <h6>Gurunya asik , ga mungkin dong gurunya ga asik. Nanti pada saat pengajaran jatuhnya diem dieman. Jadi guru di sini juga suka sedikit jokes</h6>
          </div>
          <div class="tile">
            <img src="../img/cerdas.jpg" alt="senku" />
            <h4>Cerdas</h4>
            <h6>Tentunya guru guru yang berada di tempat kami cerdas. Dan tentunya mereka dari jurusan it dan tidak mungkin berasal dari jurusan hukum.Mereka merupakan lulusan terbaik dari universitasnya masing masing</h6>
          </div>
          <div class="tile">
            <img src="../img/teknologi.jpg" alt="ngabs" />
            <h4>Inovasi Teknologi</h4>
            <h6>Pemrograman memungkinkan Anda untuk menjadi bagian dari inovasi teknologi. Dengan memahami dasar-dasar pemrograman, Anda dapat menciptakan solusi baru, aplikasi, atau produk yang dapat meningkatkan cara kita bekerja dan hidup</h6>
          </div>
        </div>
        <h3 class="section-heading">Class</h3>
        <div class="sec-content-div">
          <div class="bars">
            <div class="icon-container">
              <img src="../img/beginner.png " alt="" />
            </div>
            <div class="txt-container">
              <h5>Beginner</h5>
              <p>Di class beginner , akan di ajari hal hal dasar terlebih dahulu agar dapat pandangan codingan ke depannya</p>
            </div>
          </div>
          <div class="bars">
            <div class="icon-container">
              <img src="../img/advance.png" alt="" />
            </div>
            <div class="txt-container">
              <h5>Advance</h5>
              <p>Di class ini akan di ajarkan hal hal coding yang mungkin ada di perkuliahan tapi tidak semua. </p>
            </div>
          </div>
          <div class="bars">
            <div class="icon-container">
              <img src="../img/expert.png" alt="" />
            </div>
            <div class="txt-container">
              <h5>Expert</h5>
              <p>Di class ini akan di bekali materi yang lebih berguna untuk masuk ke dunia kerja. Dan di class ini akan menjadi class sangat berat di bandingkan dengan class lain.</p>
          </div>
        </div>
      </section>
    </main>
    <footer>
    © 2024
      <a href="#">Kursus Programming Indonesia</a>
    </footer>
  </body>
</html>