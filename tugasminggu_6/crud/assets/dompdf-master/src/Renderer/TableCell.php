<? php
/ **
 * @ paket dompdf
 * @link http://dompdf.github.com/
 * @ penulis Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * /
namespace  Dompdf \ Renderer ;

gunakan  Dompdf \ Frame ;
gunakan  Dompdf \ FrameDecorator \ Table ;

/ **
 * Merender sel tabel
 *
 * @ paket dompdf
 * /
class  TableCell  memperluas  Block
{

    / **
     * @param Frame $ frame
     * /
    fungsi  render ( Frame  $ frame )
    {
        $ style = $ frame -> get_style ();

        if ( trim ( $ frame -> get_node () -> nodeValue ) === "" && $ style -> empty_cells === "sembunyikan" ) {
            kembali ;
        }

        $ id = $ frame -> get_node () -> getAttribute ( "id" );
        jika ( strlen ( $ id )> 0 ) {
            $ ini -> _canvas -> add_named_dest ( $ id );
        }

        $ ini -> _set_opacity ( $ frame -> get_opacity ( $ style -> opacity ));
        daftar ( $ x , $ y , $ w , $ h ) = $ frame -> get_border_box ();
        

        $ table = Tabel :: find_parent_table ( $ frame );

        if ( $ table -> get_style () -> border_collapse ! == "collapse" ) {
            if (( $ bg = $ style -> background_color )! == "transparent" ) {
                $ ini -> _canvas -> persegi_isi_i ( $ x , $ y , ( float ) $ w , ( float ) $ h , $ bg );
            }

            if (( $ url = $ style -> background_image ) && $ url ! == "none" ) {
                $ this -> _background_image ( $ url , $ x , $ y , $ w , $ h , $ style );
            }

            $ this -> _render_border ( $ frame );
            $ this -> _render_outline ( $ frame );
            kembali ;
        }

        // Kasus yang runtuh agak rumit ...
        // @todo Tambahkan dukungan untuk garis besar di sini

        $ background_position_x = $ x ; $ background_position_y = $ y ; $ background_width = ( float ) $ w ; $ background_height = ( float ) $ h ;
        $ border_right_width = 0 ; $ border_left_width = 0 ; $ border_top_width = 0 ; $ border_bottom_width = 0 ;
        $ border_right_length = 0 ; $ border_left_length = 0 ; $ border_top_length = 0 ; $ border_bottom_length = 0 ;

        $ cellmap = $ table -> get_cellmap ();
        $ cell = $ cellmap -> get_spanned_cells ( $ frame );

        if ( is_null ( $ cells )) {
            kembali ;
        }

        $ num_rows = $ cellmap -> get_num_rows ();
        $ num_cols = $ cellmap -> get_num_cols ();

        // Tentukan baris atas yang direntang oleh sel ini
        $ i = $ sel [ "baris" ] [ 0 ];
        $ top_row = $ cellmap -> get_row ( $ i );

        // Tentukan apakah sel ini berbatasan dengan bagian bawah tabel. Jika begitu,
        // lalu kita gambar batas bawahnya. Jika tidak, baris berikutnya akan turun
        // gambarkan batas atasnya sebagai gantinya.
        if ( in_array ( $ num_rows - 1 , $ cells [ "baris" ])) {
            $ draw_bottom = true ;
            $ bottom_row = $ cellmap -> get_row ( $ num_rows - 1 );
        } lain {
            $ draw_bottom = salah ;
        }

        // Gambarkan batas horizontal
        $ border_function_calls = [];
        foreach ( $ cells [ "kolom" ] sebagai  $ j ) {
            $ bp = $ cellmap -> get_border_properties ( $ i , $ j );
            $ col = $ cellmap -> get_column ( $ j );

            $ x = $ col [ "x" ] - $ bp [ "kiri" ] [ "lebar" ] / 2 ;
            $ y = $ baris atas [ "y" ] - $ bp [ "atas" ] [ "lebar" ] / 2 ;
            $ w = $ col [ "used-width" ] + ( $ bp [ "left" ] [ "width" ] + $ bp [ "right" ] [ "width" ]) / 2 ;

            jika ( $ bp [ "top" ] [ "width" ]> 0 ) {
                $ widths = [
                    ( float ) $ bp [ "top" ] [ "width" ],
                    ( float ) $ bp [ "right" ] [ "width" ],
                    ( float ) $ bp [ "bottom" ] [ "width" ],
                    ( float ) $ bp [ "kiri" ] [ "lebar" ]
                ];

                $ border_top_width = maks ( $ border_top_width , $ lebar [ 0 ]);
                
                $ method = "_border_" . $ bp [ "top" ] [ "style" ];
                $ border_function_calls [] = [ $ metode , [ $ x , $ y , $ w , $ bp [ "top" ] [ "color" ], $ widths , "top" , "square" ]];
            }

            if ( $ draw_bottom ) {
                $ bp = $ cellmap -> get_border_properties ( $ num_rows - 1 , $ j );
                jika ( $ bp [ "bottom" ] [ "width" ] <= 0 ) {
                    lanjutkan ;
                }
                
                $ widths = [
                    ( float ) $ bp [ "top" ] [ "width" ],
                    ( float ) $ bp [ "right" ] [ "width" ],
                    ( float ) $ bp [ "bottom" ] [ "width" ],
                    ( float ) $ bp [ "kiri" ] [ "lebar" ]
                ];

                $ y = $ baris_bawah [ "y" ] + $ baris_bawah [ "tinggi" ] + $ bp [ "bawah" ] [ "lebar" ] / 2 ;
                $ border_bottom_width = maks ( $ border_bottom_width , $ lebar [ 2 ]);

                $ method = "_border_" . $ bp [ "bottom" ] [ "style" ];
                $ border_function_calls [] = [ $ metode , [ $ x , $ y , $ w , $ bp [ "bottom" ] [ "color" ], $ widths , "bottom" , "square" ]];
            } lain {
                $ berdekatan_bp = $ cellmap -> get_border_properties ( $ i + 1 , $ j );
                $ border_bottom_width = maks ( $ border_bottom_width , $ berdekatan_bp [ "atas" ] [ "lebar" ]);
            }
        }

        $ j = $ sel [ "kolom" ] [ 0 ];

        $ left_col = $ cellmap -> get_column ( $ j );

        jika ( in_array ( $ num_cols - 1 , $ cells [ "kolom" ])) {
            $ draw_right = true ;
            $ right_col = $ cellmap -> get_column ( $ num_cols - 1 );
        } lain {
            $ draw_right = false ;
        }

        // Gambar batas vertikal
        foreach ( $ sel [ "baris" ] sebagai  $ i ) {
            $ bp = $ cellmap -> get_border_properties ( $ i , $ j );
            $ baris = $ cellmap -> get_row ( $ i );

            $ x = $ left_col [ "x" ] - $ bp [ "left" ] [ "width" ] / 2 ;
            $ y = $ baris [ "y" ] - $ bp [ "top" ] [ "width" ] / 2 ;
            $ h = $ baris [ "tinggi" ] + ( $ bp [ "atas" ] [ "lebar" ] + $ bp [ "bawah" ] [ "lebar" ]) / 2 ;

            jika ( $ bp [ "left" ] [ "width" ]> 0 ) {
                $ widths = [
                    ( float ) $ bp [ "top" ] [ "width" ],
                    ( mengapung )$ bp [ "right" ] [ "width" ],
                    ( mengapung ) $ bp [ "bottom" ] [ "width" ],
                    ( mengapung ) $ bp [ "kiri" ] [ "lebar" ]
                ];

                $ border_left_width = max ( $ border_left_width , $ lebar [ 3 ]);

                $ method = "_border_" . $ bp [ "kiri" ] [ "gaya" ];
                $ border_function_calls [] = [ $ metode , [ $ x , $ y , $ h , $ bp [ "kiri" ] [ "warna" ], $ lebar , "kiri" , "persegi" ]];
            }

            jika ( $ draw_right ) {
                $ bp = $ cellmap -> get_border_properties ( $ i , $ num_cols - 1 );
                jika ( $ bp [ "benar" ] [ "width" ] <= 0 ) {
                    lanjutkan ;
                }

                $ widths = [
                    ( float ) $ bp [ "top" ] [ "width" ],
                    ( float ) $ bp [ "right" ] [ "width" ],
                    ( float ) $ bp [ "bottom" ] [ "width" ],
                    ( float ) $ bp [ "kiri" ] [ "lebar" ]
                ];

                $ x = $ right_col [ "x" ] + $ right_col [ "bekas-lebar" ] + $ bp [ "kanan" ] [ "lebar" ] / 2 ;
                $ border_right_width = maks ( $ border_right_width , $ lebar [ 1 ]);

                $ method = "_border_" . $ bp [ "benar" ] [ "gaya" ];
                $ border_function_calls [] = [ $ metode , [ $ x , $ y , $ h , $ bp [ "right" ] [ "color" ], $ widths , "right" , "persegi" ]];
            } lainnya {
                $ berdekatan_bp = $ cellmap -> get_border_properties ( $ i , $ j + 1 );
                $ border_right_width = maks ( $ border_right_width , $ berdekatan_bp [ "kiri" ] [ "lebar" ]);
            }
        }

        // Gambarkan latar belakang, batas dan konten kami
        if (( $ bg = $ style -> background_color )! == "transparent" ) {
            $ ini -> _canvas -> persegi_isi_isi (
                $ background_position_x + ( $ border_left_width / 2 ),
                $ background_position_y + ( $ border_top_width / 2 ),
                ( float ) $ background_width - (( $ border_left_width + $ border_right_width ) / 2 ),
                ( float ) $ background_height - (( $ border_top_width + $ border_bottom_width ) / 2 ),
                $ bg
            );
        }
        if (( $ url = $ style -> background_image ) && $ url ! == "none" ) {
            $ ini -> _background_image (
                $ url ,
                $ background_position_x + ( $ border_left_width / 2 ),
                $ background_position_y + ( $ border_top_width / 2 ),
                ( float ) $ background_width - (( $ border_left_width + $ border_right_width ) / 2 ),
                ( float ) $ background_height - (( $ border_top_width + $ border_bottom_width ) / 2 ),
                $ style
            );
        }
        foreach ( $ border_function_calls  sebagai  $ border_function_call_params )
        {
            call_user_func_array ([ $ ini , $ border_function_call_params [ 0 ]], $ border_function_call_params [ 1 ]);
        }
    }
}