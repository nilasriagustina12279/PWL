<? php
$ arrNilai = larik ( "Ani" => 80 , "Otim" => 90 , "Sri" => 75 ,
"Budi" => 85 );
echo  "<b> Larik sebelum pengurutan </b>" ;
echo  "<pre>" ;
print_r ( $ arrNilai );
echo  "</pre>" ;
urutkan ( $ arrNilai );
reset ( $ arrNilai );
echo  "<b> Larik setelah pengurutan dengan sort () </b>" ;
echo  "<pre>" ;
print_r ( $ arrNilai );
echo  "</pre>" ;
rsort ( $ arrNilai );
reset ( $ arrNilai );
echo  "<b> Larik setelah pengurutan dengan rsort () </b>" ;
echo  "<pre>" ;
print_r ( $ arrNilai );
echo  "</pre>" ;
?>