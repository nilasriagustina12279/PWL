<? php
function  cetak_ganjil ( $ awal , $ akhir ) {
untuk ( $ i = $ awal ; $ i < $ akhir ; $ i ++) {
jika ( $ i % 2 == 1 ) {
echo  "$ i" ;
}
}
}
// pemanggilan fungsi
$ a = 10 ;
$ b = 50 ;
echo  "<b> Bilangan ganjil dari $ a sampai $ b: </b> <br>" ;
cetak_ganjil ( $ a , $ b );
?>