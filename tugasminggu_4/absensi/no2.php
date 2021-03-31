<!DOCTYPE HTML>
<html>
    <body>
        <?php
        $gust_str = "Malam hari indah dengan kemerlap bintang";
        //Menghitung dan menampilkan jumlah string pada kata
        echo str_word_count($gust_str);
        ?>
    </body>
<br>
<br> 
</html>

<!DOCTYPE HTML>
<html>
    <body>
        <?php
        $gust_str = "Saya ingin mempunyai semangat "; 
        //Menampilkan string yg di replace
        echo str_replace("semangat", "tekad", $gust_str);
        ?>
    </body>
<br> <br>
</html>

<!DOCTYPE HTML>
<html>
    <body>
        <?php
        $gust_str = "Jangan lelah kita tidak tahu kedepannya jadi semangat ";
        //Menampilkan string yg di replace
        echo strrev($gust_str)
        ?>
    </body>
</html>