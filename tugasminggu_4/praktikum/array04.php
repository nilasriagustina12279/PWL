<? php
$ arrNilai = larik ( "Ani" => 80 , "Otim" => 90 , "Ana" => 75 , "Budi"
=> 85 );
echo  "Menampilkan isi array dengan foreach: <br>" ;
foreach ( $ arrNilai  sebagai  $ nama => $ nilai ) {
echo  "Nilai $ nama = $ nilai <br>" ;
}
reset ( $ arrNilai );
echo  "<br> Menampilkan isi array dengan while dan list: <br>" ;
while ( list ( $ nama , $ nilai ) = masing-masing ( $ arrNilai )) {
echo  "Nilai $ nama = $ nilai <br>" ;
}
?>