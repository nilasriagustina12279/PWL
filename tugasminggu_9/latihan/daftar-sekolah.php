<?php

class koneksi_database
{
    public function get_connection()
    {
        $host = "localhost";
        $user = "root";
        $user_pass = "";
        $db_name = "daftar_sekolah";
        $connectDB = new mysqli($host, $user, $user_pass, $db_name);
        return $connectDB;
    }

    // //menyambungkan ke database
    // public function __construct()
    // {
    //     $this->connectDB = new mysqli($this->host, $this->user, $this->user_pass, $this->db_name);

    //     //menguji koneksi ke database
    //     if (mysqli_connect_error()) {
    //         echo "gagal menyambungkan ke database" . mysqli_connect_error();
    //     } else {
    //         return $this->connectDB;
    //     }
    //     // else {
    //     //     echo "koneksi ke database bernama " . $db_name . " ,berhasil!";
    //     // }

    // }

    // //menangkap isi tabel customer untuk ditampilkan
    // public function tampilkanData()
    // {
    //     $data = mysqli_query($this->connectDB, "SELECT * FROM sekolah_terdekat");
    //     while ($d = mysqli_fetch_array($data)) {
    //         $hasil[] = $d;
    //     }
    //     return $hasil;
    // }
    // // 
    // public function masukkanData($nama, $alamat)
    // {
    //     //bagian ini untuk mencegah sql injection
    //     // $nama = $this->connectDB->real_escape_string($_POST['nama-sekolah']);
    //     // $alamat = $this->connectDB->real_escape_string($_POST['alamat-sekolah']);

    //     mysqli_query($this->connectDB, "INSERT INTO sekolah_terdekat (nama,alamat) VALUES('$nama','$alamat')");
    // }

    // //
    // public function hapusData($id)
    // {
    //     mysqli_query($this->connectDB, "DELETE FROM sekolah_terdekat WHERE id='$id'");
    // }


    // //
    // public function edit($id)
    // {
    //     $data = mysqli_query($this->connectDB, "SELECT * FROM sekolah_terdekat WHERE id='$id'");
    //     while ($d = mysqli_fetch_array($data)) {
    //         $hasil[] = $d;
    //     }
    //     return $hasil;
    // }

    // //
    // public function updateData($id, $nama, $alamat)
    // {
    //     mysqli_query($this->connectDB, "UPDATE sekolah_terdekat SET nama='$nama',alamat='$alamat' WHERE id='$id'");
    // }
    //insert data dari daftar_sekolah ke tabel
    // public function masukkanData()
    // {
    //     $nama = $this->connectDB->real_escape_string($_POST['nama-sekolah']);
    //     $alamatSekolah = $this->connectDB->real_escape_string($_POST['alamat-sekolah']);

    //     //mengambil data dari database /query
    //     $antrikan = "INSERT INTO sekolah_terdekat(nama,alamat) VALUES ('$nama','$alamatSekolah')";

    //     // 
    //     $sql = $this->connectDB->query($antrikan);

    //     //
    //     if ($sql == true) {
    //         header("Location:menu-utama.php?msg=insert");
    //     } else {
    //         echo ("pemasukan data gagal, coba lagi");
    //     }
    // }

    //

}