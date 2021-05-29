<?php
$value = 'soleh';
$value2 = 'saleh salman';
setcookie("username", $value);

//cookie dibawah akan kadaluarsa dalam 1 jam
setcookie("nama_lengkap", $value2, time() + 3600);

echo ("<h2>ini halaman pengesetan cookie</h2>");
echo ("<br>");
echo ("<h2>klik <a href='coba-cookie2.php'>di sini </a> untuk pemeriksaan cookie</h2>");