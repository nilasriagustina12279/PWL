<? php
$ str = <<< EOD
Contoh string yang mencakup banyak baris menggunakan heredoc
sintaksis.
EOD ;
/ * Contoh yang lebih kompleks, dengan variabel. * /
kelas foo
{
var $ foo ;
var $ bar ;
fungsi  foo ()
{
$ ini -> foo = 'Foo' ;
$ ini -> bar = larik ( 'Bar1' , 'Bar2' , 'Bar3' );
}
}
$ foo = new foo ();
$ name = 'Achmatim' ;
echo <<< EOT
<u> $ str </u> <br>
Nama saya adalah "<b> $ name </b>". Saya mencetak beberapa <b> $ foo-
> foo </ b>. Sekarang, saya mencetak beberapa <b> {$ foo-> bar [1]} </b>. Ini
harus mencetak huruf kapital 'A': \ x41
EOT ;
?>