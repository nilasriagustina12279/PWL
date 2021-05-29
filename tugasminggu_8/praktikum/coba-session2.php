<?php
session_start();
//pemeriksaan session
if (isset($_SESSION['login'])) {
    //menampilkan isi session

    echo ("<h3> selamat datang" . $_SESSION['login'] . "</h3>");
    echo ("<br>");

    echo ("<h3> halaman ini hanya bisa diakses jika anda sudah login</h3>");
    echo ("<br>");

    echo ("<h3> klik <a href='coba-session3.php'> di sini (coba-session3.php)</a> untuk log out </h3>");
    echo ("<br>");
} else {
    //session belum ada (belum login)
    die("Anda belum login! anda tidak dapat masuk ke halaman ini . Silahkan login <a href ='coba-session1.php'> di sini </a>");
}