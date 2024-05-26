<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Kursus Programming</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="../css/about.css" />
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
          <a href="about.php" class="nav-link" id="active">About</a>
          <a href="benefits.php" class="nav-link">Benefits</a>
          <a href="contact.php" class="nav-link">Contact</a>
          <a href="kursus.php" class="nav-link">Kursus</a>
          <a href="../index.php" class="nav-link" id="log-out">Log out</a>
        </nav>
      </div>
    </header>

    <section id="" class="flexible home-sec sec-padding">
      <div class="eye-grabber">
        <h1>Tentang kami</h1>
        <h2>Kami membangun kursus ini karena melihat ada banyak teknologi yang bertebaran di mana mana.Dan kami tidak pingin ada beberapa orang yang tidak tau cara memakainya. Salah satunya yaitu dengan coding.Banyak orang terlalu meremehkan karena menganggap coding itu adalah hal yang gampang.Kami membangun kursus ini agar anak anak bisa coding tertarik pada kami dan bisa belajar dari kami.</h2>
      </div>
    </section>

  </body>
</html>