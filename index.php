<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus Programming</title>
    <link rel="icon" href="img/Screenshot 2024-02-21 214242.png" type="image/png">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="login-page">
  <div class="form">
    <?php
    session_start();
    ?>
    <form class="register-form box" action="koneksi/register.php" method="post">
      <img src="img/Screenshot 2024-02-21 214242.png" alt="">
      <h1 style="color: white">Register</h1>
      <input type="text" name="nama" placeholder="Nama" required>
      <input type="text" name="username" placeholder="Username" required>
      <?php
      if (isset($_SESSION['error_username'])) {
          echo '<p style="color: red;">' . $_SESSION['error_username'] . '</p>';
          unset($_SESSION['error_username']);
      }
      ?>
      <input type="email" name="email" placeholder="Email" required>
      <?php
      if (isset($_SESSION['error_email'])) {
          echo '<p style="color: red;">' . $_SESSION['error_email'] . '</p>';
          unset($_SESSION['error_email']);
      }
      ?>
      <input type="text" name="alamat" placeholder="Alamat" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <input type="submit" name="submit" value="Register">
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="box" action="koneksi/login.php" method="post">
      <img src="img/Screenshot 2024-02-21 214242.png" alt="">
      <h1 style="color: white">Login</h1>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" name="submit" value="Login">
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
