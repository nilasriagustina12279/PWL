<?php
class Mobil
{
    var $warna;
    var $merk;
    var $harga;


    function __construct()
    {
        $this->warna = "Biru";
        $this->merk = "BMW";
        $this->harga = "100000000";
    }

    function gantiWarna($warnaBaru)
    {
        $this->warna = "$warnaBaru";
    }

    function tampilkanWarna()
    {
        echo "warna mobilnya : " . $this->warna;
    }
}

$aksesPertama = new Mobil();
$aksesKedua = new Mobil();

echo "<b>mobil pertama</b><br>";
echo ($aksesPertama->tampilkanWarna());

echo "<br>";

echo "ganti warna mobil pertama<br>";
$aksesPertama->gantiWarna("kuning");

//akses langsung ke variabel
echo "warna mobil pertama setelah ganti (akses variabel) : " . $aksesPertama->warna;
echo "<br>";
//akses method yang menampilkan warna
$aksesPertama->tampilkanWarna();

//akses kedua ke class 'mobil'
echo "<br>";
echo "<b>mobil kedua</b><br>";
echo $aksesKedua->tampilkanWarna();

echo "<br>";

echo "ganti warna mobil kedua <br>";
$aksesKedua->gantiWarna("biru muda");
$aksesKedua->tampilkanWarna();