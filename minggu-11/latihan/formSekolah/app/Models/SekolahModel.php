<?php

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends Model
{
    protected $table      = 'sekolah_terdekat';

    public function getSekolahTerdekat()
    {
        return $this->findAll();
    }
}