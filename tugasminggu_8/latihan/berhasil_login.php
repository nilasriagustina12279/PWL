<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman login sederhana</title>
    <!-- link ke google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300&family=Source+Sans+Pro:wght@200&display=swap" rel="stylesheet">

    <!-- lokasi css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- cek apakah sudah login -->
    <?php
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location:halaman_utama.php?pesan-login=belum_login");
    }

    ?>

    <h4>Selamat ya,<?php echo ($_SESSION['username']); ?> , kamu berhasil login! </h4>

    <!-- link untuk logout -->
    <a href="logout.php">Log out</a>

</body>

</html>