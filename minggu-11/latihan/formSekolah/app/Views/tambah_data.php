<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data</title>

    <!-- lokasi css -->
    <link rel="stylesheet" href="<?= base_url('/css/styling.css') ?>">

    <!--  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" />
</head>

<body>
    <h3>Tambah Sekolah</h3>

    <!-- tombol kembali menuju home.
        menggunakan material icon dari google 
        sebagai simbolnya
     -->
    <a href="/Home/index" class="custom-button">
        <span class="material-icons-outlined">
            undo
        </span>
        Kembali
    </a>
    <form action="../controller/controls.php" method="post">
        <div class="table-wrapper">
            <table class="custom-table">
                <thead>
                    <th>
                        <span class="material-icons-outlined edit">
                            perm_identity
                        </span>
                        Isi Nama Sekolah
                    </th>

                    <th>
                        <span class="material-icons-outlined place">
                            place
                        </span>
                        Isi Alamat Sekolah
                    </th>
                    <th>
                        <span class="material-icons-outlined settings">
                            settings
                        </span>
                        Aksi
                    </th>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="nama-sekolah" class="input-nama" id="" required placeholder="Name here...">
                        </td>

                        <td>
                            <input type="text" name="alamat-sekolah" class="input-sekolah" id="" required placeholder="Alamat here...">
                        </td>

                        <td>
                            <button type="submit" class="kirim-data" name="kirim" value="kirim">Kirim</button>

                            <button type="reset" class="reset-data" name="reset=" value="reset">Reset</button>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </form>
</body>

</html>