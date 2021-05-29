<?php
require 'daftar-sekolah.php';

class Model extends koneksi_database
{
    // var $connDB;
    public function __construct()
    {

        $this->connectDB = $this->get_connection();
    }

    public function insert($nama, $alamat)
    {
        $sql = "INSERT INTO sekolah_terdekat (nama,alamat) VALUES('$nama','$alamat')";

        $this->connectDB->query($sql);
    }

    public function tampil_data()
    {
        $sql = "SELECT * FROM sekolah_terdekat";
        $bind = $this->connectDB->query($sql);
        while ($obj = $bind->fetch_object()) {
            $baris[] = $obj;
        }
        if (!empty($baris)) {
            return $baris;
        }
    }


    public function find($id)
    {
        $sql = "SELECT * FROM sekolah_terdekat WHERE id_sekolah='$id'";
        $bind = $this->connectDB->query($sql);
        $baris = "";
        while ($obj = $bind->fetch_object()) {
            $baris = $obj;
        }
        return $baris;
    }

    public function update($id, $nama, $alamat)
    {
        $sql = "UPDATE sekolah_terdekat SET nama='$nama', alamat='$alamat' WHERE id_sekolah='$id'";
        $this->connectDB->query($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM sekolah_terdekat WHERE id_sekolah='$id'";
        $this->connectDB->query($sql);
    }
}