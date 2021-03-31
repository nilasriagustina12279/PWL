<? php
$ transport = array ( 'foot' , 'bike' , 'car' , 'plane' );
echo  "<pre>" ;
print_r ( $ transport );
echo  "</pre>" ;
$ mode = saat ini ( $ transport );
echo  $ mode . "<br>" ; // $ mode = 'kaki';
$ mode = berikutnya ( $ transport );
echo  $ mode . "<br>" ; // $ mode = 'sepeda';
$ mode = saat ini ( $ transport );
echo  $ mode . "<br>" ; // $ mode = 'sepeda';
$ mode = prev ( $ transport );
echo  $ mode . "<br>" ; // $ mode = 'kaki';
$ mode = end ( $ transport );
echo  $ mode . "<br>" ; // $ mode = 'pesawat';
$ mode = saat ini ( $ transport );
echo  $ mode . "<br>" ; // $ mode = 'pesawat';
?>