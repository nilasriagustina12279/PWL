<?php
session_start();
if (isset($_POST['Login'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];


    //periksa login
    if ($user == "achmatim" && $pass == "123") {
        //menciptakan session
        $_SESSION['login'] = $user;

        //menuju ke halaman memeriksa session
        echo ("<h2>anda berhasil login!</h2>");
        echo "<br>";
        echo ("<h2>klik <a href='coba-session2.php'> di sini (coba-session2.php)</a> untuk melanjutkan ke halaman pemeriksaan session</h2>");
    }
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>login here....</title>
    </head>

    <body>
        <form action="" method="post">

            <h2>login disini gan~</h2>
            Username: <input type="text" name="user" id=""><br>
            password: <input type="password" name="pass" id=""><br>
            <input type="submit" name="Login" value="Log in">

        </form>
    </body>

    </html>
<?
}



?>