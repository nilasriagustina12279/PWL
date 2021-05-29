<?php  
//mengaktifkan session
session_start();

//menghapus semua session
session_destroy();

//berpindah halaman dan mengirim
//pesan logout
header("location:halaman_utama.php?pesan-login=logout");