<?php
//memulai session
session_start();

//memanggil funsi koneksi ke db
require 'functions.php';

//menyimpan login dari form

$username = $_POST['username'];
$passwords = $_POST['passwords'];

//mencocokkan login dari form
//dengan username dan password di dalam database
//p.s. : ini tetap mengambil data dari db/query databasenya
$antrikan = mysqli_query($sambung_ke_db, "SELECT * FROM tb_user WHERE username='$username' AND passwords='$passwords'");

//menghitung jumlah record/ data di dalam tabel

$cek_isi = mysqli_num_rows($antrikan);

if ($cek_isi > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    header("location:berhasil_login.php");
} else {
    header("location:halaman_utama.php?pesan-login=gagal");
}