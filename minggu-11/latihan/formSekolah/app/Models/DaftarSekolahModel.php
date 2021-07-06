<?php

namespace App\Models;

use CodeIgniter\Model;


class DaftarSekolahModel extends Model
{

    //menentukan tabel dari database
    //yang akan dimanipulasi
    //nama variabel ini akan override
    //dari vendor/codeigniter4/Model.php
    protected $table = 'sekolah_terdekat';

    //menentukan primary key dari database
    //yang akan digunakan
    //defaultnya adalah $primaryKey='id';
    protected $primaryKey = 'id_sekolah';

    //
    protected $allowedFields = ['nama', 'alamat'];

    //mengembalikan record/data
    // dalam bentuk array
    protected $returnType = 'array';

    //sambungkan ke db
    protected $sambungkan;

    public function __construct()
    {
        $this->sambungkan = \Config\Database::connect();
        parent::__construct($this->sambungkan);
    }

    //menampilkan record
    public function showRecord()
    {
        // $sql = "SELECT * FROM sekolah_terdekat";

        // $storing = $this->connectDB->query($sql);

        // while ($obj = $storing->fetch_object()) {
        //     $rows[] = $obj;
        // }
        // if (!empty($rows)) {
        //     return $rows;
        // }

    }
    public function insertRecord($nama, $alamat)
    {
        $sql = "INSERT INTO sekolah_terdekat (nama,alamat) VALUES ('$nama','$alamat')";

        $this->connectDB->query($sql);
    }



    public function findRecord($id)
    {
        $sql = "SELECT * FROM sekolah_terdekat WHERE id_sekolah='$id'";

        $bind = $this->connectDB->query($sql);

        $rows = "";

        while ($obj = $bind->fetch_object()) {
            $rows = $obj;
        }
        return $rows;
    }


    public function updateRecord($id, $nama, $alamat)
    {
        $sql = "UPDATE sekolah_terdekat SET nama='$nama', alamat='$alamat' WHERE id_sekolah='$id'";
        $this->connectDB->query($sql);
    }

    public function deleteRecord($id)
    {
        $sql = "DELETE FROM sekolah_terdekat WHERE id_sekolah='$id'";
        $this->connectDB->query($sql);
    }
}
