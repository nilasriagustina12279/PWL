<?php
require 'model.php';

if (isset($_POST['kirim'])) {
    $nama = $_POST['nama-sekolah'];
    $alamat = $_POST['alamat-sekolah'];
    $model = new Model();
    $model->insert($nama, $alamat);
    header('Location:menu-utama.php');
}

//untuk memeriksa apakah tombol submit
//dari file 'edit.php' sudah ditekan

/* alurnya: 
user klik tulisan 'edit' -> dilempar 
ke proses.php , kemudian diminta mengubah bagian mana
yang akan ditambah/dikurangi. 
bagian bawah ini akan memeriksa apakah tombol
submit bernama 'submit_edit' sudah ditekan.
(menggunakan input:submit juga bisa, asalkan namanya juga 'submit_edit')
*/
if (isset($_POST['submit_edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama-sekolah'];
    $alamat = $_POST['alamat-sekolah'];
    $model = new Model();
    $model->update($id, $nama, $alamat);
    header('Location:menu-utama.php');
}
/*memeriksa apakah ada parameter 'id'
dari file 'menu-utama.php'
tepatnya bagian:
<a name="hapus" id="hapus" href="proses.php?id=<?= $data->id_sekolah ?>">Hapus</a>
jika ada, akan dihapus
*/
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $model = new Model();
    $model->delete($id);
    header('Location:menu-utama.php');
}
// $aksesDariProses = new koneksi_database();

// $aksi = $_GET['aksi'];

// if ($aksi == "tambah") {
//     $aksesDariProses->masukkanData($_POST['nama'], $_POST['alamat']);
//     header("Location:menu-utama.php");
// } elseif ($aksi == "hapus") {
//     $aksesDariProses->hapusData($_GET['id']);
//     header("Location:menu-utama.php");
// } elseif ($aksi == "update") {
//     $aksesDariProses->updateData($_POST['id'], $_POST['nama'], $_POST['alamat']);
//     header("Location:menu-utama.php");
// }