<?php
class Sekolah
{
    private $host = "localhost";
    private $user = "root";
    private $userPass = "";
    private $database = "daftar_sekolah";
    public $connectDB;

    public function __construct()
    {
        $this->connectDB = new mysqli($this->host, $this->user, $this->userPass, $this->database);

        //cek koneksi db
        if (mysqli_connect_error()) {
            echo "yah,koneksi ke database 'daftar_sekolah gagal! " . mysqli_connect_error();
        }
        //else {
        //     echo "koneksi ke database 'daftar_sekolah', berhasil!";
        // }
    }
}