<? php
/ **
 * @ paket dompdf
 * @link http://dompdf.github.com/
 * @ penulis Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * /
namespace  Dompdf \ Renderer ;

gunakan  Dompdf \ Frame ;

/ **
 * Membuat bingkai blok
 *
 * @ paket dompdf
 * /
class  TableRowGroup  memperluas  Block
{

    / **
     * @param Frame $ frame
     * /
    fungsi  render ( Frame  $ frame )
    {
        $ style = $ frame -> get_style ();

        $ ini -> _set_opacity ( $ frame -> get_opacity ( $ style -> opacity ));

        $ this -> _render_border ( $ frame );
        $ this -> _render_outline ( $ frame );

        if ( $ this -> _dompdf -> getOptions () -> getDebugLayout () && $ this -> _dompdf -> getOptions () -> getDebugLayoutBlocks ()) {
            $ this -> _debug_layout ( $ frame -> get_border_box (), "red" );
            if ( $ this -> _dompdf -> getOptions () -> getDebugLayoutPaddingBox ()) {
                $ this -> _debug_layout ( $ frame -> get_padding_box (), "merah" , [ 0,5 , 0,5 ]);
            }
        }

        if ( $ this -> _dompdf -> getOptions () -> getDebugLayout () && $ this -> _dompdf -> getOptions () -> getDebugLayoutLines () && $ frame -> get_decorator ()) {
            foreach ( $ frame -> get_decorator () -> get_line_boxes () sebagai  $ line ) {
                $ frame -> _debug_layout ([ $ line -> x , $ line -> y , $ line -> w , $ line -> h ], "orange" );
            }
        }

        $ id = $ frame -> get_node () -> getAttribute ( "id" );
        jika ( strlen ( $ id )> 0 ) {
            $ ini -> _canvas -> add_named_dest ( $ id );
        }
    }
}