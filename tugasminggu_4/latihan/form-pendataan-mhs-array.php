<!DOCTYPE html>
<html>
    <head>
        <title>Form Pendataan</title>
    </head>
    <body>
        <form method="post">  
            <table border="1">
                <tr>
                    <th>NIM</th>
                    <td>
                        <input type="text" name="nim" required="">
                    </td>
                </tr>
                <tr>
                    <th>Program Studi</th>
                    <td>
                        <select name="prog_studi" required="">
                            <option value="" disabled selected>Pilih Program Studi</option>
                            <option value="A11">Teknik Informatika S1</option>
                            <option value="A12">Sistem Informatika S1</option>
                            <option value="A22">Teknik Informatika D3</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Nilai Tugas</th>
                    <td>
                        <input type="text" name="ntugas" required="">
                    </td>
                </tr>
                <tr>
                    <th>Nilai UTS</th>
                    <td>
                        <input type="text" name="nuts" required="">
                    </td>
                </tr>
                <tr>
                    <th>Nilai UAS</th>
                    <td>
                        <input type="text" name="nuas" required="">
                    </td>
                </tr>
                <tr>
                    <th rowspan="3">Catatan Khusus</th>
                    <td>
                        <input type="checkbox" name="checkbox1" value="Kehadiran >= 70%">
                        <label>Kehadiran >= 70%</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="checkbox2" value="Interaktif dikelas">
                        <label>Interaktif dikelas</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="checkbox3" value="Kehadiran >= 70%">
                        <label>Tidak terlambat mengumpulkan tugas</label>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="proses" value="Simpan">
                    </td>
                </tr>
            </table>
        </form>
        </br>
        </br>
        <hr>
        </br>
        </br>
    </body>
</html>

<?php

$nilai_akhir = 0;

if(isset($_POST['proses'])){

    $nim = $_POST['nim'];
    $kode_ps = $_POST['prog_studi'];
    $ntugas = $_POST['ntugas'];
    $nuts = $_POST['nuts'];
    $nuas = $_POST['nuas'];
    $catatan = array();

    if (isset($_POST['checkbox1'])) {
        $cat = $_POST['checkbox1'];
        $catatan[] = '<li>'.$cat.'</li>';
    }

    if (isset($_POST['checkbox2'])) {
        $cat = $_POST['checkbox2'];
        $catatan[] = '<li>'.$cat.'</li>';
    }

    if (isset($_POST['checkbox3'])) {
        $cat = $_POST['checkbox3'];
        $catatan[] = '<li>'.$cat.'</li>';
    }

    $new_cat = '';
    if(!empty($catatan)){
        $new_cat = implode(" ", $catatan);
    }

    if (is_numeric($ntugas) && is_numeric($nuas) && is_numeric($nuts)) {
        if ($ntugas <= 100 && $nuts <= 100 && $nuas <= 100) {
            proses($kode_ps, $nim, $ntugas, $nuts, $nuas, $new_cat);
        }else{
            echo "<h3>Maaf nilai yang anda inputkan lebih dari 100 !</h3>";
        }
    }else{
        echo "<h3>Maaf nilai yang anda inputkan salah !</h3>";
    }
}

function proses($kode_ps, $nim, $ntugas, $nuts, $nuas, $new_cat){
    // Nilai Akhir
    $nilai_akhir = (0.4*$ntugas) + (0.3*$nuts) + (0.3*$nuas);
    $status = '';
    if ($nilai_akhir >= 60) {
        $status = "LULUS";
    }else{
        $status = "TIDAK LULUS";
    }
    $nilai_lulus = '';
    if ($nilai_akhir > 84 ) {
        $nilai_lulus = 'A';
    }elseif ($nilai_akhir >= 70 && $nilai_akhir <= 84) {
        $nilai_lulus = 'B';
    }elseif ($nilai_akhir >= 60 && $nilai_akhir <= 69) {
        $nilai_lulus = 'C';
    }elseif ($nilai_akhir >= 50 && $nilai_akhir <= 59) {
        $nilai_lulus = 'D';
    }else{
        $nilai_lulus = 'E';
    }

    // Program Studi
    if($kode_ps == 'A11'){
        $prog_studi = 'Teknik Informatika S1';
    }elseif ($kode_ps == 'A12') {
        $prog_studi = 'Sistem Informatika S1';
    }elseif ($kode_ps == 'A22') {
        $prog_studi = 'Teknik Informatika D3';
    }

    echo '<table border="1" style="text-align:center">
                <tr>
                    <th>Program Studi</th>
                    <th>NIM</th>
                    <th>Nilai Akhir</th>
                    <th>Status</th>
                    <th>Catatan Khusus</th>
                </tr>
                <tr>
                    <td>'.$prog_studi.'</td>
                    <td>'.$nim.'</td>
                    <td>'.$nilai_lulus.'</td>
                    <td>'.$status.'</td>
                    <td><ul>'.$new_cat.'</ul></td>
                </tr>
            </table>';

}

echo "";

?>