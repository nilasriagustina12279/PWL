<? php
/ **
 * @ paket dompdf
 * @link http://dompdf.github.com/
 * @ penulis Benj Carson <benjcarson@digitaljunkies.ca>
 * @ penulis Helmut Tischer <htischer@weihenstephan.org>
 * @ penulis Fabien Ménager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * /
namespace  Dompdf \ Renderer ;

gunakan  Dompdf \ Adapter \ CPDF ;
gunakan  Dompdf \ Frame ;

/ **
 * Membuat bingkai teks
 *
 * @ paket dompdf
 * /
class  Text  memperluas  AbstractRenderer
{
    / ** Ketebalan garis bawah. Layar: 0,08, cetak: lebih baik kurang, misalnya 0,04 * /
    const  DECO_THICKNESS = 0,02 ;

    // Tweak jika $ base dan $ descent tidak akurat.
    // Periksa method_exists ($ this -> _ canvas, "get_cpdf")
    // - Untuk cpdf ini dapat dan harus tetap 0, karena metrik font digunakan secara langsung.
    // - Untuk perender lain, jika menginginkan nilai yang berbeda, pisahkan set parameter.
    // Tapi $ size dan $ size- $ height tampaknya cukup akurat

    / ** Relatif dengan bagian bawah teks, sebagai bagian dari tinggi * /
    const  UNDERLINE_OFFSET = 0,0 ;

    / ** Relatif dengan bagian atas teks * /
    const  OVERLINE_OFFSET = 0,0 ;

    / ** Relatif dengan pusat teks. * /
    const  LINETHROUGH_OFFSET = 0,0 ;

    / ** Seberapa jauh untuk memperpanjang garis melewati kedua ujungnya, dalam pt * /
    const  DECO_EXTENSION = 0,0 ;

    / **
     * @param \ Dompdf \ FrameDecorator \ Teks $ bingkai
     * /
    fungsi  render ( Frame  $ frame )
    {
        $ text = $ frame -> get_text ();
        if ( trim ( $ text ) === "" ) {
            kembali ;
        }

        $ style = $ frame -> get_style ();
        daftar ( $ x , $ y ) = $ frame -> get_position ();
        $ cb = $ frame -> get_containing_block ();

        if (( $ ml = $ style -> margin_left ) === "auto" || $ ml === "none" ) {
            $ ml = 0 ;
        }

        if (( $ pl = $ style -> padding_left ) === "auto" || $ pl === "none" ) {
            $ pl = 0 ;
        }

        if (( $ bl = $ style -> border_left_width ) === "auto" || $ bl === "none" ) {
            $ bl = 0 ;
        }

        $ x + = ( float ) $ style -> length_in_pt ([ $ ml , $ pl , $ bl ], $ cb [ "w" ]);

        $ font = $ style -> font_family ;
        $ size = $ style -> font_size ;
        $ frame_font_size = $ frame -> get_dompdf () -> getFontMetrics () -> getFontHeight ( $ font , $ size );
        $ word_spacing = $ frame -> get_text_spacing () + ( float ) $ style -> length_in_pt ( $ style -> word_spacing );
        $ char_spacing = ( float ) $ style -> length_in_pt ( $ style -> letter_spacing );
        $ width = $ style -> lebar ;

        / * $ text = str_replace (
          larik ("{PAGE_NUM}"),
          array ($ this -> _ canvas-> get_page_number ()),
          $ teks
        ); * /

        $ ini -> _canvas -> teks ( $ x , $ y , $ teks ,
            $ font , $ size ,
            $ style -> warna , $ word_spacing , $ char_spacing );

        $ baris = $ frame -> get_containing_line ();

        // FIXME Daripada menggunakan bingkai tertinggi ke posisi,
        // dekorasi, teks harus ditempatkan dengan baik
        if ( false && $ line -> tallest_frame ) {
            $ base_frame = $ line -> tallest_frame ;
            $ style = $ base_frame -> get_style ();
            $ size = $ style -> font_size ;
        }

        $ line_thickness = $ size * self :: DECO_THICKNESS ;
        $ underline_offset = $ size * self :: UNDERLINE_OFFSET ;
        $ overline_offset = $ size * self :: OVERLINE_OFFSET ;
        $ linethrough_offset = $ size * self :: LINETHROUGH_OFFSET ;
        $ underline_position = - 0,08 ;

        if ( $ this -> _canvas instanceof CPDF ) {
            $ cpdf_font = $ ini -> _canvas -> get_cpdf () -> font [ $ style -> font_family ];

            if ( isset ( $ cpdf_font [ "UnderlinePosition" ])) {
                $ underline_position = $ cpdf_font [ "UnderlinePosition" ] / 1000 ;
            }

            if ( isset ( $ cpdf_font [ "UnderlineThickness" ])) {
                $ line_thickness = $ size * ( $ cpdf_font [ "UnderlineThickness" ] / 1000 );
            }
        }

        $ keturunan = $ size * $ underline_position ;
        $ base = $ frame_font_size ;

        // Tangani dekorasi teks:
        // http://www.w3.org/TR/CSS21/text.html#propdef-text-decoration

        // Gambarlah semua dekorasi teks yang berlaku. Mulailah dengan akar dan lanjutkan ke bawah.
        $ p = $ bingkai ;
        $ tumpukan = [];
        sementara ( $ p = $ p -> get_parent ()) {
            $ tumpukan [] = $ p ;
        }

        sementara ( isset ( $ stack [ 0 ])) {
            $ f = array_pop ( $ tumpukan );

            if (( $ text_deco = $ f -> get_style () -> text_decoration ) === "tidak ada" ) {
                lanjutkan ;
            }

            $ deco_y = $ y ; // $ line-> y;
            $ color = $ f -> get_style () -> color ;

            saklar ( $ text_deco ) {
                default :
                    lanjutkan  2 ;

                case  "underline" :
                    $ deco_y + = $ base - $ keturunan + $ underline_offset + $ line_thickness / 2 ;
                    istirahat ;

                case  "overline" :
                    $ deco_y + = $ overline_offset + $ line_thickness / 2 ;
                    istirahat ;

                case  "line-through" :
                    $ deco_y + = $ base * 0.7 + $ linethrough_offset ;
                    istirahat ;
            }

            $ dx = 0 ;
            $ x1 = $ x - diri :: DECO_EXTENSION ;
            $ x2 = $ x + $ lebar + $ dx + mandiri :: DECO_EXTENSION ;
            $ ini -> _canvas -> baris ( $ x1 , $ deco_y , $ x2 , $ deco_y , $ color , $ line_thickness );
        }

        if ( $ this -> _dompdf -> getOptions () -> getDebugLayout () && $ this -> _dompdf -> getOptions () -> getDebugLayoutLines ()) {
            $ text_width = $ ini -> _dompdf -> getFontMetrics () -> getTextWidth ( $ teks , $ font , $ size );
            $ this -> _debug_layout ([ $ x , $ y , $ text_width + ( $ line -> wc - 1 ) * $ word_spacing , $ frame_font_size ], "orange" , [ 0.5 , 0.5 ]);
        }
    }
}