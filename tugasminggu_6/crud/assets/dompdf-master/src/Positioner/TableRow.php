<? php
/ **
 * @ paket dompdf
 * @link http://dompdf.github.com/
 * @ penulis Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * /

namespace  Dompdf \ Positioner ;

gunakan  Dompdf \ FrameDecorator \ AbstractFrameDecorator ;

/ **
 * Posisi baris tabel
 *
 * @ paket dompdf
 * /
class  TableRow  memperluas  AbstractPositioner
{

    / **
     * @param AbstractFrameDecorator $ frame
     * /
     posisi fungsi ( AbstractFrameDecorator  $ frame )
    {
        $ cb = $ frame -> get_containing_block ();
        $ p = $ bingkai -> get_prev_sibling ();

        jika ( $ p ) {
            $ y = $ p -> get_position ( "y" ) + $ p -> get_margin_height ();
        } lain {
            $ y = $ cb [ "y" ];
        }
        $ frame -> set_position ( $ cb [ "x" ], $ y );
    }
}