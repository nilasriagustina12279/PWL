<?php

$id = $_GET['id'];
require 'model.php';

$model = new Model();
$data = $model->findRecord($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✍️Edit Data</title>
    <link rel="stylesheet" href="../assets/css/styling.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" />
</head>

<body>
    <h3>Edit data sekolah yang ada</h3>

    <a href="../view/home.php" class="">Kembali</a>

    <form action="proses.php?" method="post">
        <div class="table-wrapper">
            <table class="custom-table">
                <input type="hidden" name="id" value="<?= $data->id_sekolah ?>">
                <thead>
                    <th>Nama Sekolah</th>
                    <th>Alamat Sekolah</th>
                    <th>Aksi</th>
                </thead>

                <tbody>
                    <tr valign="middle">
                        <td>
                            <i class="material-icons user">perm_identity</i>
                            <input type="text" name="nama-sekolah" class="input-nama" id="" value="<?= $data->nama; ?>">
                        </td>

                        <td>
                            <i class="material-icons-outlined place">
                                place
                            </i>
                            <input type="text" name="alamat-sekolah" class="input-sekolah" id="" value="<?= $data->alamat; ?>">
                        </td>

                        <td>
                            <button type="submit" class="submit-button" name="submit_edit" value="kirim">Submit
                            </button>

                            <button type="reset" name="reset">Reset
                            </button>
                        </td>

                    </tr>
                </tbody>

                <tr>

                </tr>
            </table>
        </div>
    </form>
</body>

</html>