<?php

include 'pbo_dengan_php2.php';

echo "<html><head><title>Mahasiswa</title></head><body>";

$form = new FormulirSederhana("", "kirim-form");
$form->tambahField("text-nim", "nim");
$form->tambahField("text-nama", "nama");
$form->tambahField("text-alamat", "alamat");

echo "<h3>Silahkan isi form : </h3>";
$form->tampilkanFormulir();
echo "</body></html>";