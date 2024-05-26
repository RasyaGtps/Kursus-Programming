<!DOCTYPE html>
<html>
<head>
    <title>Kursus Programming</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet"/>
    <link rel="icon" href="../img/Screenshot 2024-02-21 214242.png" type="image/png">
    <style>
        html, body {
            background: #000;
            margin: 0;
            font-family:"quicksand",sans serif;
        }
        .centered {
            width: 400px;
            height: 400px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #000;
            filter: blur(10px) contrast(20);
        }
        .circle-1, .circle-2 {
            width: 70px;
            height: 70px;
            position: absolute;
            background: #fff;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .circle-1 {
            left: 20%;
            animation: osc-l 1.5s ease-in infinite;
            background-color: #fff;
        }
        .circle-2 {
            left: 80%;
            animation: osc-r 1.5s ease-in infinite;
            background: #29C5F6;
        }
        @keyframes osc-l {
            0% { left: 20%; }
            50% { left: 50%; }
            100% { left: 20%; }
        }
        @keyframes osc-r {
            0% { left: 80%; }
            50% { left: 50%; }
            100% { left: 80%; }
        }
        .text h1 {
            color: aliceblue;
            top: 55%;
            position: absolute;
            left: 45%;
            font-weight: bold;
            font-family:"quicksand",sans serif;
        }
        .text h1:after {
            content: ".";
            position: absolute;
            animation: caret infinite;
            animation-duration: 1.5s;
            animation-timing-function: steps(20, end);
            font-family:"quicksand",sans serif;
        }
        @keyframes caret {
            0%, 100% { opacity: 0; }
            50% { opacity: 1; }
        }
    </style>
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
    <div class="centered">
        <div class="circle-1"></div>
        <div class="circle-2"></div>
    </div>
    <div class="text">
        <h1>Selamat datang, <?php echo htmlspecialchars($username); ?> &nbsp;</h1>
    </div>
    <script>
        setTimeout(function () {
            window.location.href = "../user/index.php";
        }, 2300);
    </script>
</body>
</html>
