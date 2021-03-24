< html >
< head > < title > Pengolahan Formulir </ title > </ head >
< body >
< FORM  ACTION = "" METHOD = " POST " NAME = " input " >
Nama Anda: < masukan  jenis = " text " nama =" nama di " > < br >
< input  type = " submit " name = " Input " value = " Input " >
</ FORM >
</ body >
</ html >
<? php
if ( isset ( $ _POST [ 'Input' ])) { $ nama = $ _POST [ 'nama' ];
echo  "Nama Anda: <b> $ nama </b>" ; } ?>