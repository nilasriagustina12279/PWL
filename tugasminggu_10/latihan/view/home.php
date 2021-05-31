<?php
require '../models/model.php';
$aksesModel = new Model();
$index = 1;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🏠Home</title>

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- google material icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300&family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" />

    <!-- css -->
    <link rel="stylesheet" href="../assets/css/styling.css">
    <!--  -->
</head>

<body>
    <h3>Daftar Sekolah di Semarang</h3>
    <a href="../models/add.php" class="custom-button">✍️Masukkan data baru</a>
    <div class="table-wrapper">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>
                        <span class="material-icons-outlined number-list">
                            format_list_numbered
                        </span>
                        Nomer
                    </th>
                    <th>
                        <span class="material-icons-outlined home">
                            school
                        </span>
                        Nama Sekolah
                    </th>
                    <th>
                        <span class="material-icons-outlined place">
                            place
                        </span>
                        Alamat Sekolah
                    </th>
                    <th>
                        <span class="material-icons-outlined settings">
                            settings
                        </span>
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody>
                <?php
                $hasil = $aksesModel->showRecord();
                if (!empty($hasil)) {
                    foreach ($hasil as $data) : ?>


                        <tr>
                            <td><?= $index++ ?></td>
                            <td><?= $data->nama ?></td>
                            <td><?= $data->alamat  ?></td>
                            <td>

                                <a href="../models/edit.php?id=<?= $data->id_sekolah ?>" name="edit" id="edit" class="edit-button">
                                    <span class="material-icons-outlined edit">
                                        edit
                                    </span>Edit</a>



                                <a href="../models/proses.php?=<?= $data->id_sekolah ?>" name="hapus" id="hapus" class="hapus-button">
                                    <span class="material-icons-outlined trash">
                                        delete
                                    </span>Hapus</a>

                            </td>
                        </tr>
                    <?php endforeach;
                } else {
                    ?>
                    <tr>
                        <td>belum ada data tersebut pada tabel
                            'sekolah_terdekat'</td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</body>

</html>