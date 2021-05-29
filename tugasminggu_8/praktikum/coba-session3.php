<?php
session_start();
if (isset($_POST['login'])) {

    unset($_SESSION);

    //
    echo ("<h2>anda sudah berhasil logout</h2>");
    echo "<br>";

    echo ("<h3>Klik <a href='coba-session1.php'>di sini </a> untuk login kembali</h3>");
    echo ("<br>");

    echo ("<h3>anda sekarang tidak bisa masuk ke halaman <a href='coba-session2.php'> session2 </a>lagi.</h3>");
    echo "<br>";
}