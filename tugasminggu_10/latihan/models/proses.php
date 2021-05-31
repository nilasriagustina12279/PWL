<?php
require 'model.php';
if (isset($_POST['kirim'])) {
    $nama = $_POST['nama-sekolah'];
    $alamat = $_POST['alamat-sekolah'];
    $model = new Model();
    $model->insertRecord($nama, $alamat);
    header('Location: ../view/home.php');
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
    $model->updateRecord($id, $nama, $alamat);
    header('Location:../view/home.php');
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
    $model->deleteRecord($id);
    header('Location:../view/home.php');
}