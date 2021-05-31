<?php

require 'sekolah.php';

class Model extends Sekolah
{
    public function insertRecord($nama, $alamat)
    {
        $sql = "INSERT INTO sekolah_terdekat (nama,alamat) VALUES ('$nama','$alamat')";

        $this->connectDB->query($sql);
    }

    public function showRecord()
    {
        $sql = "SELECT * FROM sekolah_terdekat";

        $storing = $this->connectDB->query($sql);

        while ($obj = $storing->fetch_object()) {
            $rows[] = $obj;
        }
        if (!empty($rows)) {
            return $rows;
        }
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