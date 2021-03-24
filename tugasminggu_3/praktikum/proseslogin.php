<? php
if ( isset ( $ _POST [ 'Login' ])) {
$ pengguna = $ _POST [ 'nama pengguna' ];
$ pass = $ _POST [ 'kata sandi' ];
if ( $ user == "achmatim" && $ pass == "123" ) {
echo  "<h2> Login Berhasil </h2>" ;
} lain {
echo  "<h2> Masuk Gagal </h2>" ;
}
}
?>