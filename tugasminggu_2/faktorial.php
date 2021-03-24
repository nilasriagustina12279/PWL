<?php

/*WHILE*/
  $i=1;
  $hasil=$i;
  $n=4;
while($i<=$n){
  $hasil=$hasil * $i;
  $i++;
}
 echo "hasilnya = ";
 echo $hasil;

 /*FOR*/
 for($i=1;$i<=$n;$i++){
    $hasil * $i;
 }
 echo "<br>hasilnya = ";
 echo $hasil;

 $i=1;
 $hasil=$i;
 $n=4;
while($i<=$n){
 $hasil=$hasil * $i;
 $i++;
}

/*DO WHILE*/

$i = 1;
$hasil = $i;
$n=4;

do {
$hasil=$hasil*$i;
$i++;
} while ($i <= $n);

echo "<br>hasilnya = $hasil";

?>