<?php
//memanggil file daftar-sekolah
require 'model.php';

//mengakses class koneksi-database
$aksesModel = new Model();
$index = 1;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar sekolah di semarang</title>
    <link rel="stylesheet" href="css/styling.css">
</head>

<body>
    <a href="tambah-data.php">Masukkan data baru</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>Nomer</th>
                <th>Nama Sekolah</th>
                <th>Alamat Sekolah</th>
            </tr>


        </thead>

        <!--  -->
        <tbody>
            <?php
            $hasil = $aksesModel->tampil_data();
            if (!empty($hasil)) {
                foreach ($hasil as $data) : ?>
                    <tr>
                        <td><?= $index++ ?></td>
                        <td><?= $data->nama ?></td>
                        <td><?= $data->alamat ?></td>
                        <td>
                            <a name="edit" id="edit" href="edit.php?id=<?= $data->id_sekolah ?>">Edit</a>

                            <a name="hapus" id="hapus" href="proses.php?id=<?= $data->id_sekolah ?>">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach;
            } else {
                ?>
                <tr>
                    <td colspan="9">belum ada data pada tabel 'sekolah_terdekat'</td>
                </tr>

            <?php } ?>

        </tbody>


    </table>



</body>

</html>