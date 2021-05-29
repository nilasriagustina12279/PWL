<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data</title>
    <link rel="stylesheet" href="css/styling.css">
</head>
<body>
    <h3>Tambah data</h3>
    <a href="menu-utama.php">Kembali</a>
    <form action="proses.php" method="post">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama-sekolah" id=""></td>
            </tr>
            <tr>
                <td>Alamat sekolah</td>
                <td><input type="text" name="alamat-sekolah" id=""></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="kirim" value="kirim">
                    <input type="reset" value="reset">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>