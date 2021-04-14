<? php
namespace  Dompdf ;

kelas  Pembantu
{
    / **
     * print_r wrapper untuk keluaran html / cli
     *
     * Membungkus output print_r () dalam tag <pre> jika sapi saat ini bukan 'cli'.
     * Mengembalikan string keluaran daripada menampilkannya jika $ return benar.
     *
     * @param campuran $ variabel atau ekspresi campuran untuk ditampilkan
     * @param bool $ return
     *
     * @ string kembali | null
     * /
    public  static  function  pre_r ( $ mixed , $ return = false )
    {
        if ( $ return ) {
            mengembalikan  "<pre>" . print_r ( $ campuran , benar ). "</pre>" ;
        }

        if ( php_sapi_name ()! == "cli" ) {
            echo  "<pre>" ;
        }

        print_r ( $ campuran );

        if ( php_sapi_name ()! == "cli" ) {
            echo  "</pre>" ;
        } lain {
            echo  "\ n" ;
        }

        flush ();

        kembali  nol ;
    }

      / **
     * membangun url lengkap dengan protokol, nama host, jalur dasar, dan url
     *
     * @param string $ protocol
     * @param string $ host
     * @ string parameter $ base_path
     * @param string $ url
     * @ string kembali
     *
     * Awalnya garis miring $ base_path bersifat opsional, dan ditambahkan secara bersyarat.
     * Namun pada situs yang dibuat secara dinamis, di mana halaman tersebut diberikan sebagai parameter url,
     * jalur dasar mungkin tidak diakhiri dengan url.
     * Oleh karena itu, jangan tambahkan garis miring, dan ** memerlukan ** $ base_url untuk diakhiri dengan garis miring
     * ketika diperlukan.
     * Sebaliknya, saat menggunakan jalur sistem file lokal dari sebuah file, pastikan bahwa garis miring
     * ditambahkan (ok juga untuk Windows)
     * /
    public  static  function  build_url ( $ protocol , $ host , $ base_path , $ url )
    {
        $ protocol = mb_strtolower ( $ protocol );
        jika ( strlen ( $ url ) == 0 ) {
            // kembalikan $ protocol. $ host. rtrim ($ base_path, "/ \\"). "/";
            return  $ protocol . $ host . $ base_path ;
        }

        // Apakah url sudah sepenuhnya memenuhi syarat, URI Data, atau referensi ke jangkar bernama?
        // URL protokol file mungkin memerlukan pemrosesan tambahan (mis. Untuk URL dengan jalur relatif)
        if (( mb_strpos ( $ url , ": //" )! == false && substr ( $ url , 0 , 7 )! == "file: //" ) || mb_substr ( $ url , 0 , 1 ) = == "#" || mb_strpos ( $ url , "data:" ) === 0 || mb_strpos ( $ url , "mailto:" ) === 0 ||mb_strpos ( $ url , "tel:" ) === 0 ) {
            return  $ url ;
        }

        if ( strpos ( $ url , "file: //" ) === 0 ) {
            $ url = substr ( $ url , 7 );
            $ protocol = "" ;
        }

        $ ret = "" ;
        if ( $ protocol ! = "file: //" ) {
            $ ret = $ protokol ;
        }

        if (! in_array ( mb_strtolower ( $ protocol ), [ "http: //" , "https: //" , "ftp: //" , "ftps: //" ])) {
            // Pada file lokal Windows, jalur abs juga dapat dimulai dengan '\' atau huruf drive dan titik dua
            // drive: diikuti oleh jalur relatif akan menjadi folder default khusus drive.
            // tidak dikenal dalam kode aplikasi php, perlakukan sebagai jalur abs
            // ($ url [1]! == ':' || ($ url [2]! == '\\' && $ url [2]! == '/'))
            if ( $ url [ 0 ]! == '/' && ( strtoupper ( substr ( PHP_OS , 0 , 3 ))! == 'WIN' || ( mb_strlen ( $ url )> 1 && $ url [ 0 ]! = = '\\' && $ url [ 1 ]! == ':' ))) {
                // Untuk jalur rel dan akses lokal kami mengabaikan host, dan menjalankan jalur melalui realpath ()
                $ ret . = realpath ( $ base_path ). '/' ;
            }
            $ ret . = $ url ;
            $ ret = preg_replace ( '/\?(.*)$/' , "" , $ ret );
            return  $ ret ;
        }

        // Protokol url relatif (misalnya "//example.org/style.css")
        if ( strpos ( $ url , '//' ) === 0 ) {
            $ ret . = substr ( $ url , 2 );
            // url jarak jauh dengan garis miring terbalik di html / css tidak benar-benar benar, tapi mari kita genereous
        } elseif ( $ url [ 0 ] === '/' || $ url [ 0 ] === '\\' ) {
            // Jalan mutlak
            $ ret . = $ host . $ url ;
        } lain {
            // Jalur relatif
            // $ base_path = $ base_path! == ""? rtrim ($ base_path, "/ \\"). "/": "";
            $ ret . = $ host . $ base_path . $ url ;
        }

        // URL sekarang sudah selesai, pembersihan akhir
        $ parsed_url = parse_url ( $ ret );

        // direproduksi dari https://www.php.net/manual/en/function.parse-url.php#106731
        $ skema    = isset ( $ parsed_url [ 'skema' ])? $ parsed_url [ 'skema' ]. ': //' : '' ;
        $ host      = isset ( $ parsed_url [ 'host' ])? $ parsed_url [ 'host' ]: '' ;
        $ port      = isset ( $ parsed_url [ 'port' ])? ':' . $ parsed_url [ 'port' ]: '' ;
        $ user      = isset ( $ parsed_url [ 'user' ])? $ parsed_url [ 'user' ]: '' ;
        $ pass      = isset ( $ parsed_url [ 'pass' ])? ':' . $ parsed_url [ 'pass' ]: '' ;
        $ pass      = ( $ user || $ pass )? "$ pass @" : '' ;
        $ path      = isset ( $ parsed_url [ 'path' ])? $ parsed_url [ 'path' ]: '' ;
        $ query     = isset ( $ parsed_url [ 'query' ])? '?' . $ parsed_url [ 'query' ]: '' ;
        $ fragment = isset ( $ parsed_url [ 'fragment' ])? '#' . $ parsed_url [ 'fragment' ]: '' ;
        
        // direproduksi sebagian dari https://stackoverflow.com/a/1243431/264628
        / * ganti '//' atau '/./' atau '/foo/../' dengan '/' * /
        $ re = larik ( '# (/\.?/) #' , '# / (?! \. \.) [^ /] + / \. \ ./#' );
        untuk ( $ n = 1 ; $ n > 0 ; $ path = preg_replace ( $ re , '/' , $ path , - 1 , $ n )) {}

        $ ret = "$ scheme $ user $ pass $ host $ port $ path $ query $ fragment" ;

        return  $ ret ;
    }

    / **
     * Membuat string header HTTP Content-Disposition menggunakan `$ dispositionType`
     * dan `$ filename`.
     *
     * Jika nama file berisi karakter apa pun yang tidak memiliki karakter ISO-8859-1
     * set, nama file cadangan akan disertakan untuk klien yang tidak mendukung
     * Parameter `nama file *`.
     *
     * @param string $ dispositionType
     * @param string $ nama file
     * @ string kembali
     * /
    public  static  function  buildContentDispositionHeader ( $ dispositionType , $ filename )
    {
        $ encoding = mb_detect_encoding ( $ nama file );
        $ fallbackfilename = mb_convert_encoding ( $ nama file , "ISO-8859-1" , $ encoding );
        $ fallbackfilename = str_replace ( "\" " , " " , $ fallbackfilename );
        $ encodedfilename = rawurlencode ( $ filename );

        $ contentDisposition = "Isi-Disposisi: $ dispositionType; nama file = \" $ fallbackfilename \ "" ;
        if ( $ fallbackfilename ! == $ filename ) {
            $ contentDisposition . = "; namafile * = UTF-8 '' $ encodedfilename" ;
        }

        return  $ contentDisposition ;
    }

    / **
     * Mengubah angka desimal menjadi angka romawi
     *
     * @param int $ num
     *
     * @throws Exception
     * @ string kembali
     * /
     dec2roman fungsi statis  publik ( $ num ) 
    {

        statis  $ ones = [ "" , "i" , "ii" , "iii" , "iv" , "v" , "vi" , "vii" , "viii" , "ix" ];
        statis  $ puluhan = [ "" , "x" , "xx" , "xxx" , "xl" , "l" , "lx" , "lxx" , "lxxx" , "xc" ];
        statis  $ hund = [ "" , "c" , "cc" , "ccc" , "cd" , "d" , "dc" , "dcc" , "dccc" , "cm" ];
        statis  $ engkau = [ "" , "m" , "mm" , "mmm" ];

        if (! is_numeric ( $ num )) {
            membuang  Exception baru  ( "dec2roman () membutuhkan argumen numerik." );
        }

        if ( $ num > 4000 || $ num < 0 ) {
            return  "(di luar jangkauan)" ;
        }

        $ num = strrev (( string ) $ num );

        $ ret = "" ;
        saklar ( mb_strlen ( $ num )) {
            / ** @noinspection PhpMissingBreakStatementInspection * /
            kasus  4 :
                $ ret . = $ engkau [ $ num [ 3 ]];
            / ** @noinspection PhpMissingBreakStatementInspection * /
            kasus  3 :
                $ ret . = $ hund [ $ num [ 2 ]];
            / ** @noinspection PhpMissingBreakStatementInspection * /
            kasus  2 :
                $ ret . = $ puluhan [ $ num [ 1 ]];
            / ** @noinspection PhpMissingBreakStatementInspection * /
            kasus  1 :
                $ ret . = $ satu [ $ num [ 0 ]];
            default :
                istirahat ;
        }

        return  $ ret ;
    }

    / **
     * Menentukan apakah $ value adalah persentase atau tidak
     *
     * @param float $ value
     *
     * @ kembali bool
     * /
    public  static  function  is_percent ( $ value )
    {
        return  false ! == mb_strpos ( $ value , "%" );
    }

    / **
     * Mengurai skema URI data
     * http://en.wikipedia.org/wiki/Data_URI_scheme
     *
     * @param string $ data_uri URI data yang akan diurai
     *
     * @return array | bool Hasil dengan charset, tipe mime dan data yang didekodekan
     * /
    public  static  function  parse_data_uri ( $ data_uri )
    {
        if (! preg_match ( '/ ^ data :(? P <mime> [a-z0-9 \ / + -.] +) ( ; charset = ( ? P <charset> [a-z0-9 -]) + )? (? P <base64>; base64)? \, (? P <data>. *)? / Is ' , $ data_uri , $ match )) {
            return  false ;
        }

        $ match [ 'data' ] = rawurldecode ( $ match [ 'data' ]);
        $ result = [
            'charset' => $ match [ 'charset' ]? $ match [ 'charset' ]: 'US-ASCII' ,
            'mime' => $ match [ 'mime' ]? $ match [ 'mime' ]: 'text / plain' ,
            'data' => $ match [ 'base64' ]? base64_decode ( $ match [ 'data' ]): $ match [ 'data' ],
        ];

        return  $ result ;
    }

    / **
     * Mengkodekan Uniform Resource Identifier (URI) dengan mengganti non-alfanumerik
     * karakter dengan tanda persen (%) diikuti dengan dua digit hex, kecuali
     * karakter dalam kumpulan karakter khusus URI.
     *
     * Mengasumsikan bahwa URI adalah URI lengkap, jadi tidak mengenkode yang dicadangkan
     * karakter yang memiliki arti khusus di URI.
     *
     * Mensimulasikan fungsi encodeURI yang tersedia di JavaScript
     * https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/encodeURI
     *
     * Sumber: http://stackoverflow.com/q/4929584/264628
     *
     * @param string $ uri URI yang akan dikodekan
     * @return string URL asli dengan karakter khusus yang dikodekan
     * /
    public  static  function  encodeURI ( $ uri ) {
        $ unescaped = [
            '% 2D' => '-' , '% 5F' => '_' , '% 2E' => '.' , '% 21' => '!' , '% 7E' => '~' ,
            '% 2A' => '*' , '% 27' => "'" , '% 28 ' => ' (' , '% 29 ' => ') '
        ];
        $ dipesan = [
            '% 3B' => ';' , '% 2C' => ',' , '% 2F' => '/' , '% 3F' => '?' , '% 3A' => ':' ,
            '% 40' => '@' , '% 26' => '&' , '% 3D' => '=' , '% 2B' => '+' , '% 24' => '$'
        ];
        $ skor = [
            '% 23' => '#'
        ];
        kembali  strtr ( rawurlencode ( rawurldecode ( $ uri )), array_merge ( $ dicadangkan , $ unescaped , $ skor ));
    }

    / **
     * Decoder untuk kompresi RLE8 di bitmap windows
     * http://msdn.microsoft.com/library/default.asp?url=/library/en-us/gdi/bitmaps_6x0u.asp
     *
     * @param string $ str Data untuk didekode
     * @param integer $ width Lebar gambar
     *
     * @ string kembali
     * /
     fungsi statis  publik rle8_decode ( $ str , $ width ) 
    {
        $ lineWidth = $ lebar + ( 3 - ( $ lebar - 1 )% 4 );
        $ out = '' ;
        $ cnt = strlen ( $ str );

        untuk ( $ i = 0 ; $ i < $ cnt ; $ i ++) {
            $ o = ord ( $ str [ $ i ]);
            saklar ( $ o ) {
                kasus  0 : # ESCAPE
                    $ i ++;
                    switch ( ord ( $ str [ $ i ])) {
                        kasus  0 : # BARIS BARU
                            $ padCnt = $ lineWidth - strlen ( $ out )% $ lineWidth ;
                            if ( $ padCnt < $ lineWidth ) {
                                $ out . = str_repeat ( chr ( 0 ), $ padCnt ); # garis pad
                            }
                            istirahat ;
                        kasus  1 : # AKHIR FILE
                            $ padCnt = $ lineWidth - strlen ( $ out )% $ lineWidth ;
                            if ( $ padCnt < $ lineWidth ) {
                                $ out . = str_repeat ( chr ( 0 ), $ padCnt ); # garis pad
                            }
                            istirahat  3 ;
                        kasus  2 : # DELTA
                            $ i + = 2 ;
                            istirahat ;
                        default : # MODE MUTLAK
                            $ num = ord ( $ str [ $ i ]);
                            untuk ( $ j = 0 ; $ j < $ num ; $ j ++) {
                                $ keluar . = $ str [++ $ i ];
                            }
                            jika ( $ num % 2 ) {
                                $ i ++;
                            }
                    }
                    istirahat ;
                default :
                    $ out . = str_repeat ( $ str [++ $ i ], $ o );
            }
        }
        mengembalikan  $ keluar ;
    }

    / **
     * Decoder untuk kompresi RLE4 di bitmap windows
     * lihat http://msdn.microsoft.com/library/default.asp?url=/library/en-us/gdi/bitmaps_6x0u.asp
     *
     * @param string $ str Data untuk didekode
     * @param integer $ width Lebar gambar
     *
     * @ string kembali
     * /
     fungsi statis  publik rle4_decode ( $ str , $ width ) 
    {
        $ w = lantai ( $ lebar / 2 ) + ( $ lebar % 2 );
        $ lineWidth = $ w + ( 3 - (( $ width - 1 ) / 2 )% 4 );
        $ piksel = [];
        $ cnt = strlen ( $ str );
        $ c = 0 ;

        untuk ( $ i = 0 ; $ i < $ cnt ; $ i ++) {
            $ o = ord ( $ str [ $ i ]);
            saklar ( $ o ) {
                kasus  0 : # ESCAPE
                    $ i ++;
                    switch ( ord ( $ str [ $ i ])) {
                        kasus  0 : # BARIS BARU
                            sementara ( hitung ( $ piksel )% $ lineWidth ! = 0 ) {
                                $ piksel [] = 0 ;
                            }
                            istirahat ;
                        kasus  1 : # AKHIR FILE
                            sementara ( hitung ( $ piksel )% $ lineWidth ! = 0 ) {
                                $ piksel [] = 0 ;
                            }
                            istirahat  3 ;
                        kasus  2 : # DELTA
                            $ i + = 2 ;
                            istirahat ;
                        default : # MODE MUTLAK
                            $ num = ord ( $ str [ $ i ]);
                            untuk ( $ j = 0 ; $ j < $ num ; $ j ++) {
                                jika ( $ j % 2 == 0 ) {
                                    $ c = ord ( $ str [++ $ i ]);
                                    $ piksel [] = ( $ c & 240 ) >> 4 ;
                                } lain {
                                    $ piksel [] = $ c & 15 ;
                                }
                            }

                            jika ( $ num % 2 == 0 ) {
                                $ i ++;
                            }
                    }
                    istirahat ;
                default :
                    $ c = ord ( $ str [++ $ i ]);
                    untuk ( $ j = 0 ; $ j < $ o ; $ j ++) {
                        $ piksel [] = ( $ j % 2 == 0 ? ( $ c & 240 ) >> 4 : $ c & 15 );
                    }
            }
        }

        $ out = '' ;
        if ( hitung ( $ piksel )% 2 ) {
            $ piksel [] = 0 ;
        }

        $ cnt = hitung ( $ piksel ) / 2 ;

        untuk ( $ i = 0 ; $ i < $ cnt ; $ i ++) {
            $ keluar . = chr ( 16 * $ piksel [ 2 * $ i ] + $ piksel [ 2 * $ i + 1 ]);
        }

        mengembalikan  $ keluar ;
    }

    / **
     * mengurai url lengkap atau nama jalur dan mengembalikan array (protokol, host, jalur,
     * file + kueri + fragmen)
     *
     * @param string $ url
     * @ kembali array
     * /
     fungsi statis  publik explode_url ( $ url ) 
    {
        $ protocol = "" ;
        $ host = "" ;
        $ path = "" ;
        $ file = "" ;

        $ arr = parse_url ( $ url );
        if ( isset ( $ arr [ "scheme" ])) {
            $ arr [ "skema" ] = mb_strtolower ( $ arr [ "skema" ]);
        }

        // Kecualikan huruf drive windows ...
        if ( isset ( $ arr [ "scheme" ]) && $ arr [ "scheme" ]! == "file" && strlen ( $ arr [ "scheme" ])> 1 ) {
            $ protocol = $ arr [ "skema" ]. ": //" ;

            if ( isset ( $ arr [ "user" ])) {
                $ host . = $ arr [ "pengguna" ];

                if ( isset ( $ arr [ "pass" ])) {
                    $ host . = ":" . $ arr [ "pass" ];
                }

                $ host . = "@" ;
            }

            if ( isset ( $ arr [ "host" ])) {
                $ host . = $ arr [ "host" ];
            }

            if ( isset ( $ arr [ "port" ])) {
                $ host . = ":" . $ arr [ "port" ];
            }

            if ( isset ( $ arr [ "path" ]) && $ arr [ "path" ]! == "" ) {
                // Apa ada garis miring?
                if ( $ arr [ "path" ] [ mb_strlen ( $ arr [ "path" ]) - 1 ] === "/" ) {
                    $ jalur = $ arr [ "jalur" ];
                    $ file = "" ;
                } lain {
                    $ path = rtrim ( dirname ( $ arr [ "path" ]), '/ \\' ). "/" ;
                    $ file = nama dasar ( $ arr [ "path" ]);
                }
            }

            if ( isset ( $ arr [ "query" ])) {
                $ file . = "?" . $ arr [ "query" ];
            }

            if ( isset ( $ arr [ "fragment" ])) {
                $ file . = "#" . $ arr [ "fragment" ];
            }

        } lain {

            $ i = mb_stripos ( $ url , "file: //" );
            if ( $ i ! == false ) {
                $ url = mb_substr ( $ url , $ i + 7 );
            }

            $ protocol = "" ; // "file: //"; ? mengapa ini tidak berhasil ... Itu karena
            // nama file jaringan seperti // COMPU / SHARENAME

            $ host = "" ; // localhost, sungguh
            $ file = basename ( $ url );

            $ path = dirname ( $ url );

            // Periksa apakah jalurnya ada
            if ( $ path ! == false ) {
                $ jalur . = '/' ;

            } lain {
                // buat url untuk mengakses file jika tidak ada jalur nyata yang ditemukan.
                $ protocol = isset ( $ _SERVER [ 'HTTPS' ]) && $ _SERVER [ 'HTTPS' ] === 'on' ? 'https: //' : 'http: //' ;

                $ host = isset ( $ _SERVER [ "HTTP_HOST" ])? $ _SERVER [ "HTTP_HOST" ]: php_uname ( "n" );

                if ( substr ( $ arr [ "path" ], 0 , 1 ) === '/' ) {
                    $ path = dirname ( $ arr [ "path" ]);
                } lain {
                    $ path = '/' . rtrim ( dirname ( $ _SERVER [ "SCRIPT_NAME" ]), '/' ). '/' . $ arr [ "jalur" ];
                }
            }
        }

        $ ret = [ $ protokol , $ host , $ path , $ file ,
            "protokol" => $ protokol ,
            "host" => $ host ,
            "jalur" => $ jalur ,
            "file" => $ file ];
        return  $ ret ;
    }

    / **
     * Cetak pesan debug
     *
     * @param string $ type Jenis pesan debug yang akan dicetak
     * @param string $ msg Pesan yang akan ditampilkan
     * /
    public  static  function  dompdf_debug ( $ type , $ msg )
    {
        global  $ _DOMPDF_DEBUG_TYPES , $ _dompdf_show_warnings , $ _dompdf_debug ;
        if ( isset ( $ _DOMPDF_DEBUG_TYPES [ $ type ]) && ( $ _dompdf_show_warnings || $ _dompdf_debug )) {
            $ arr = debug_backtrace ();

            echo nama  dasar ( $ arr [ 0 ] [ "file" ]). "(" . $ arr [ 0 ] [ "line" ]. "):" . $ arr [ 1 ] [ "fungsi" ]. ":" ;
            Pembantu :: pre_r ( $ msg );
        }
    }

    / **
     * Menyimpan peringatan dalam larik untuk ditampilkan nanti
     * Fungsi ini memungkinkan peringatan yang dihasilkan oleh parser DomDocument
     * dan pemuat CSS ({@link Stylesheet}) yang akan diambil dan ditampilkan
     * nanti. Tanpa fungsi ini, kesalahan akan segera ditampilkan dan
     * Streaming PDF tidak mungkin.
     * @lihat http://www.php.net/manual/en/function.set-error_handler.php
     *
     * @param int $ errno
     * @ string parameter $ errstr
     * @ string parameter $ errfile
     * @ string parameter $ errline
     *
     * @throws Exception
     * /
    public  static  function  record_warnings ( $ errno , $ errstr , $ errfile , $ errline )
    {
        // Bukan peringatan atau pemberitahuan
        jika ((! $ errno & ( E_WARNING | E_NOTICE | E_USER_NOTICE | E_USER_WARNING | E_STRICT | E_DEPRECATED | E_USER_DEPRECATED ))) {
            melempar  Pengecualian baru  ( $ errstr . "$ errno" );
        }

        global  $ _dompdf_warnings ;
        global  $ _dompdf_show_warnings ;

        if ( $ _dompdf_show_warnings ) {
            echo  $ errstr . "\ n" ;
        }

        $ _dompdf_warnings [] = $ errstr ;
    }

    / **
     * @param $ c
     * @return bool | string
     * /
     fungsi statis  publik unichr ( $ c ) 
    {
        jika ( $ c <= 0x7F ) {
            kembali  chr ( $ c );
        } lain  jika ( $ c <= 0x7FF ) {
            return  chr ( 0xC0 | $ c >> 6 ). chr ( 0x80 | $ c & 0x3F );
        } lain  jika ( $ c <= 0xFFFF ) {
            kembali  chr ( 0xE0 | $ c >> 12 ). chr ( 0x80 | $ c >> 6 & 0x3F )
            . chr ( 0x80 | $ c & 0x3F );
        } lain  jika ( $ c <= 0x10FFFF ) {
            kembali  chr ( 0xF0 | $ c >> 18 ). chr ( 0x80 | $ c >> 12 & 0x3F )
            . chr ( 0x80 | $ c >> 6 & 0x3F )
            . chr ( 0x80 | $ c & 0x3F );
        }
        return  false ;
    }

    / **
     * Mengubah warna CMYK ke RGB
     *
     * @param float | float [] $ c
     * @param float $ m
     * @param float $ y
     * @param float $ k
     *
     * @return float []
     * /
     fungsi statis  publik cmyk_to_rgb ( $ c , $ m = null , $ y = null , $ k = null ) 
    {
        if ( is_array ( $ c )) {
            [ $ c , $ juta , $ y , $ k ] = $ c ;
        }

        $ c * = 255 ;
        $ m * = 255 ;
        $ y * = 255 ;
        $ k * = 255 ;

        $ r = ( 1 - putaran ( 2,55 * ( $ c + $ k )));
        $ g = ( 1 - putaran ( 2,55 * ( $ m + $ k )));
        $ b = ( 1 - putaran ( 2,55 * ( $ y + $ k )));

        jika ( $ r < 0 ) {
            $ r = 0 ;
        }
        jika ( $ g < 0 ) {
            $ g = 0 ;
        }
        jika ( $ b < 0 ) {
            $ b = 0 ;
        }

        kembali [
            $ r , $ g , $ b ,
            "r" => $ r , "g" => $ g , "b" => $ b
        ];
    }

    / **
     * getimagesize tidak memberikan ukuran yang bagus untuk gambar BMP 32bit v5
     *
     * @param string $ nama file
     * @param resource $ context
     * @return array Format yang sama seperti getimagesize ($ filename)
     * /
     fungsi statis  publik dompdf_getimagesize ( $ nama file , $ konteks = null ) 
    {
        statis  $ cache = [];

        if ( isset ( $ cache [ $ filename ])) {
            return  $ cache [ $ filename ];
        }

        [ $ lebar , $ tinggi , $ type ] = getimagesize ( $ namafile );

        // Jenis khusus
        $ jenis = [
            IMAGETYPE_JPEG => "jpeg" ,
            IMAGETYPE_GIF   => "gif" ,
            IMAGETYPE_BMP   => "bmp" ,
            IMAGETYPE_PNG   => "png" ,
        ];

        $ type = isset ( $ types [ $ type ])? $ tipe [ $ tipe ]: null ;

        if ( $ width == null || $ height == null ) {
            [ $ data , $ headers ] = Pembantu :: getFileContent ( $ namafile , $ konteks );

            if (! empty ( $ data )) {
                if ( substr ( $ data , 0 , 2 ) === "BM" ) {
                    $ meta = unpack ( 'vtype / Vfilesize / Vreserved / Voffset / Vheadersize / Vwidth / Vheight' , $ data );
                    $ width = ( int ) $ meta [ 'width' ];
                    $ tinggi = ( int ) $ meta [ 'tinggi' ];
                    $ type = "bmp" ;
                } lain {
                    if ( strpos ( $ data , "<svg" )! == false ) {
                        $ doc = baru \ Svg \ Document ();
                        $ doc -> loadFile ( $ filename );

                        [ $ lebar , $ tinggi ] = $ dokumen -> getDimensions ();
                        $ type = "svg" ;
                    }
                }
            }
        }

        return  $ cache [ $ filename ] = [ $ lebar , $ tinggi , $ tipe ];
    }

    / **
     * Kredit diberikan ke mgutt
     * http://www.programmierer-forum.de/function-imagecreatefrombmp-welche-variante-laeuft-t143137.htm
     * Dimodifikasi oleh Fabien Menager untuk mendukung format RGB555 BMP
     * /
    public  static  function  imagecreatefrombmp ( $ filename , $ context = null )
    {
        if (! function_exists ( "imagecreatetruecolor" )) {
            trigger_error ( "Ekstensi GD PHP diperlukan, tetapi tidak dipasang." , E_ERROR );
            return  false ;
        }

        // versi 1.00
        if (! ( $ fh = fopen ( $ filename , 'rb' ))) {
            trigger_error ( 'imagecreatefrombmp: Tidak dapat membuka' . $ nama file , E_USER_WARNING );
            return  false ;
        }

        $ byte_read = 0 ;

        // baca file header
        $ meta = unpack ( 'vtype / Vfilesize / Vreserved / Voffset' , fread ( $ fh , 14 ));

        // periksa bitmap
        if ( $ meta [ 'type' ]! = 19778 ) {
            trigger_error ( 'imagecreatefrombmp:' . $ filename . 'bukan bitmap!' , E_USER_WARNING );
            return  false ;
        }

        // baca header gambar
        $ meta + = unpack ( 'Vheadersize / Vwidth / Vheight / vplanes / vbits / Vcompression / Vimagesize / Vxres / Vyres / Vcolors / Vimportant' , fread ( $ fh , 40 ));
        $ byte_read + = 40 ;

        // baca header bitfield tambahan
        jika ( $ meta [ 'kompresi' ] == 3 ) {
            $ meta + = unpack ( 'VrMask / VgMask / VbMask' , fread ( $ fh , 12 ));
            $ byte_read + = 12 ;
        }

        // setel byte dan padding
        $ meta [ 'byte' ] = $ meta [ 'bits' ] / 8 ;
        $ meta [ 'stiker' ] = 4 - ( 4 * (( $ meta [ 'width' ] * $ meta [ 'bytes' ] / 4 ) - floor ( $ meta [ 'width' ] * $ meta [ 'bytes' ] / 4 )));
        jika ( $ meta [ 'decal' ] == 4 ) {
            $ meta [ 'decal' ] = 0 ;
        }

        // dapatkan ukuran gambar
        if ( $ meta [ 'imagesize' ] < 1 ) {
            $ meta [ 'imagesize' ] = $ meta [ 'filesize' ] - $ meta [ 'offset' ];
            // dalam kasus yang jarang terjadi, ukuran file sama dengan offset jadi kita perlu membaca ukuran fisik
            if ( $ meta [ 'imagesize' ] < 1 ) {
                $ meta [ 'imagesize' ] = @ filesize ( $ filename ) - $ meta [ 'offset' ];
                if ( $ meta [ 'imagesize' ] < 1 ) {
                    trigger_error ( 'imagecreatefrombmp: Tidak dapat memperoleh ukuran file dari' . $ filename . '!' , E_USER_WARNING );
                    return  false ;
                }
            }
        }

        // hitung warna
        $ meta [ 'warna' ] =! $ meta [ 'warna' ]? pow ( 2 , $ meta [ 'bits' ]): $ meta [ 'colors' ];

        // baca palet warna
        $ palet = [];
        if ( $ meta [ 'bits' ] < 16 ) {
            $ palette = unpack ( 'l' . $ meta [ 'colors' ], fread ( $ fh , $ meta [ 'colors' ] * 4 ));
            // dalam kasus yang jarang terjadi, nilai warna ditandatangani
            jika ( $ palette [ 1 ] < 0 ) {
                foreach ( $ palette  as  $ i => $ color ) {
                    $ palet [ $ i ] = $ warna + 16777216 ;
                }
            }
        }

        // abaikan header bitmap tambahan
        if ( $ meta [ 'headersize' ]> $ bytes_read ) {
            fread ( $ fh , $ meta [ 'headersize' ] - $ bytes_read );
        }

        // buat gambar gd
        $ im = imagecreatetruecolor ( $ meta [ 'width' ], $ meta [ 'height' ]);
        $ data = fread ( $ fh , $ meta [ 'imagesize' ]);

        // buka kompresi data
        saklar ( $ meta [ 'kompresi' ]) {
            kasus  1 :
                $ data = Pembantu :: rle8_decode ( $ data , $ meta [ 'width' ]);
                istirahat ;
            kasus  2 :
                $ data = Pembantu :: rle4_decode ( $ data , $ meta [ 'width' ]);
                istirahat ;
        }

        $ p = 0 ;
        $ vide = chr ( 0 );
        $ y = $ meta [ 'tinggi' ] - 1 ;
        $ error = 'imagecreatefrombmp:' . $ filename . 'tidak memiliki cukup data!' ;

        // loop melalui data gambar yang dimulai dengan pojok kiri bawah
        sementara ( $ y > = 0 ) {
            $ x = 0 ;
            sementara ( $ x < $ meta [ 'width' ]) {
                switch ( $ meta [ 'bits' ]) {
                    kasus  32 :
                    kasus  24 :
                        if (! ( $ part = substr ( $ data , $ p , 3  / * $ meta ['bytes'] * / ))) {
                            trigger_error ( $ error , E_USER_WARNING );
                            mengembalikan  $ im ;
                        }
                        $ color = unpack ( 'V' , $ part . $ vide );
                        istirahat ;
                    kasus  16 :
                        if (! ( $ part = substr ( $ data , $ p , 2  / * $ meta ['bytes'] * / ))) {
                            trigger_error ( $ error , E_USER_WARNING );
                            mengembalikan  $ im ;
                        }
                        $ color = unpack ( 'v' , $ part );

                        jika ( kosong ( $ meta [ 'rMask' ]) || $ meta [ 'rMask' ]! = 0xf800 ) {
                            $ color [ 1 ] = (( $ color [ 1 ] & 0x7c00 ) >> 7 ) * 65536 + (( $ color [ 1 ] & 0x03e0 ) >> 2 ) * 256 + (( $ color [ 1 ] & 0x001f ) << 3 ); // 555
                        } lain {
                            $ color [ 1 ] = (( $ color [ 1 ] & 0xf800 ) >> 8 ) * 65536 + (( $ color [ 1 ] & 0x07e0 ) >> 3 ) * 256 + (( $ color [ 1 ] & 0x001f ) << 3 ); // 565
                        }
                        istirahat ;
                    kasus  8 :
                        $ color = unpack ( 'n' , $ vide . substr ( $ data , $ p , 1 ));
                        $ color [ 1 ] = $ palet [ $ warna [ 1 ] + 1 ];
                        istirahat ;
                    kasus  4 :
                        $ color = unpack ( 'n' , $ vide . substr ( $ data , floor ( $ p ), 1 ));
                        $ warna [ 1 ] = ( $ p * 2 )% 2 == 0 ? $ warna [ 1 ] >> 4 : $ warna [ 1 ] & 0x0F ;
                        $ warna [ 1 ] = $ palet [ $ warna [ 1 ] + 1 ];
                        istirahat ;
                    kasus  1 :
                        $ color = unpack ( 'n' , $ vide . substr ( $ data , floor ( $ p ), 1 ));
                        sakelar (( $ p * 8 )% 8 ) {
                            kasus  0 :
                                $ color [ 1 ] = $ color [ 1 ] >> 7 ;
                                istirahat ;
                            kasus 1 :
                                $ color [ 1 ] = ( $ color [ 1 ] & 0x40 ) >> 6 ;
                                istirahat ;
                            kasus  2 :
                                $ color [ 1 ] = ( $ color [ 1 ] & 0x20 ) >> 5 ;
                                istirahat ;
                            kasus  3 :
                                $ warna [ 1 ] = ( $ warna [ 1 ] & 0x10 ) >> 4 ;
                                istirahat ;
                            kasus  4 :
                                $ warna [ 1 ] = ( $ warna [ 1 ] & 0x8 ) >> 3 ;
                                istirahat ;
                            kasus  5 :
                                $ warna [ 1 ] = ( $ warna [ 1 ] & 0x4 ) >> 2 ;
                                istirahat ;
                            kasus  6 :
                                $ color [ 1 ] = ( $ color [ 1 ] & 0x2 ) >> 1 ;
                                istirahat ;
                            kasus  7 :
                                $ warna [ 1 ] = ( $ warna [ 1 ] & 0x1 );
                                istirahat ;
                        }
                        $ warna [ 1 ] = $ palet [ $ warna [ 1 ] + 1 ];
                        istirahat ;
                    default :
                        trigger_error ( 'imagecreatefrombmp:' . $ filename . 'has' . $ meta [ 'bits' ]. 'bits and this is not support!' , E_USER_WARNING );
                        kembali false ;
                }
                imagesetpixel ( $ im , $ x , $ y , $ color [ 1 ]);
                $ x ++;
                $ p + = $ meta [ 'byte' ];
            }
            $ y -;
            $ p + = $ meta [ 'stiker' ];
        }
        fclose ( $ fh );
        return  $ im ;
    }

    / **
     * Mendapat konten file di jalur yang ditentukan menggunakan salah satu dari
     * metode berikut, dalam urutan preferensial:
     * - file_get_contents: jika allow_url_fopen benar atau file lokal
     * - curl: jika allow_url_fopen salah dan curl tersedia
     *
     * @ string parameter $ uri
     * @param resource $ context (diabaikan jika curl digunakan)
     * @param int $ offset
     * @param int $ maxlen (diabaikan jika curl digunakan)
     * @ string kembali []
     * /
    public  static  function  getFileContent ( $ uri , $ context = null , $ offset = 0 , $ maxlen = null )
    {
        $ konten = null ;
        $ headers = null ;
        [ $ proto , $ host , $ path , $ file ] = Pembantu :: explode_url ( $ uri );
        $ is_local_path = ( $ proto == '' || $ proto === 'file: //' );

        set_error_handler ([ self :: class, 'record_warnings' ]);

        mencoba {
            if ( $ is_local_path || ini_get ( 'allow_url_fopen' )) {
                if ( $ is_local_path === false ) {
                    $ uri = Pembantu :: encodeURI ( $ uri );
                }
                if ( isset ( $ maxlen )) {
                    $ result = file_get_contents ( $ uri , null , $ context , $ offset , $ maxlen );
                } lain {
                    $ result = file_get_contents ( $ uri , null , $ context , $ offset );
                }
                if ( $ result ! == false ) {
                    $ konten = $ hasil ;
                }
                if ( isset ( $ http_response_header )) {
                    $ headers = $ http_response_header ;
                }

            } elseif ( function_exists ( 'curl_exec' )) {
                $ curl = curl_init ( $ uri );

                // TODO: gunakan $ context untuk menentukan opsi curl tambahan
                curl_setopt ( $ curl , CURLOPT_TIMEOUT , 10 );
                curl_setopt ( $ curl , CURLOPT_CONNECTTIMEOUT , 10 );
                curl_setopt ( $ curl , CURLOPT_RETURNTRANSFER , true );
                curl_setopt ( $ curl , CURLOPT_HEADER , true );
                if ( $ offset > 0 ) {
                    curl_setopt ( $ curl , CURLOPT_RESUME_FROM , $ offset );
                }

                $ data = curl_exec ( $ curl );

                if ( $ data ! == false &&! curl_errno ( $ curl )) {
                    switch ( $ http_code = curl_getinfo ( $ curl , CURLINFO_HTTP_CODE )) {
                        kasus  200 :
                            $ raw_headers = substr ( $ data , 0 , curl_getinfo ( $ curl , CURLINFO_HEADER_SIZE ));
                            $ Header = preg_split ( "/ [\ n \ r] + /" , lis ( $ raw_headers ));
                            $ content = substr ( $ data , curl_getinfo ( $ curl , CURLINFO_HEADER_SIZE ));
                            istirahat ;
                    }
                }
                curl_close ( $ curl );
            }
        } akhirnya {
            restore_error_handler ();
        }

        return [ $ content , $ headers ];
    }

     fungsi statis  publik mb_ucwords ( $ str ) { 
        $ max_len = mb_strlen ( $ str );
        jika ( $ max_len === 1 ) {
            return  mb_strtoupper ( $ str );
        }

        $ str = mb_strtoupper ( mb_substr ( $ str , 0 , 1 )). mb_substr ( $ str , 1 );

        foreach ([ '' , '.' , ',' , '!' , '?' , '-' , '+' ] sebagai  $ s ) {
            $ pos = 0 ;
            while (( $ pos = mb_strpos ( $ str , $ s , $ pos ))! == false ) {
                $ pos ++;
                // Tidak ada yang bisa dilakukan jika pemisah adalah karakter terakhir dari string
                if ( $ pos ! == false && $ pos < $ max_len ) {
                    // Jika karakter yang ingin kita tambahkan adalah karakter terakhir, tidak ada yang perlu ditambahkan di belakang
                    jika ( $ pos + 1 < $ max_len ) {
                        $ str = mb_substr ( $ str , 0 , $ pos ). mb_strtoupper ( mb_substr ( $ str , $ pos , 1 )). mb_substr ( $ str , $ pos + 1 );
                    } lain {
                        $ str = mb_substr ( $ str , 0 , $ pos ). mb_strtoupper ( mb_substr ( $ str , $ pos , 1 ));
                    }
                }
            }
        }

        mengembalikan  $ str ;
    }
}