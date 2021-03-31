<? php
$ arrWarna = array ( "Biru" , "Hitam" , "Merah" , "Kuning" , "Hijau" );
echo  "Menampilkan isi array dengan for: <br>" ;
untuk ( $ i = 0 ; $ i < count ( $ arrWarna ); $ i ++) {
echo  "Apakah kamu suka <font color = $ arrWarna [$ i]>" . $ arrWarna [ $ i ]
. "</font>? <br>" ;
}
echo  "<br> Menampilkan isi array dengan foreach: <br>" ;
foreach ( $ arrWarna  sebagai  $ warna ) {
echo  "Kamu suka <font color = $ warna>" . $ warna . "</font>
? <br> " ;
}
?>