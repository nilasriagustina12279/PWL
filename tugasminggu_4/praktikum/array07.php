<? php
$ arrNilai = larik ( "Ani" => 80 , "Otim" => 90 , "Sri" => 75 ,
"Budi" => 85 );
echo  "<b> Larik sebelum pengurutan </b>" ;
echo  "<pre>" ;
print_r ( $ arrNilai );
echo  "</pre>" ;
asort ( $ arrNilai );
reset ( $ arrNilai );
echo  "<b> Larik setelah pengurutan dengan asort () </b>" ;
echo  "<pre>" ;
print_r ( $ arrNilai );
echo  "</pre>" ;
arsort ( $ arrNilai );
reset ( $ arrNilai );
echo  "<b> Larik setelah pengurutan dengan arsort () </b>" ;
echo  "<pre>" ;
print_r ( $ arrNilai );
echo  "</pre>" ;
?>