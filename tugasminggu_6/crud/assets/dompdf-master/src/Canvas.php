<? php
/ **
 * @ paket dompdf
 * @link http://dompdf.github.com/
 * @ penulis Benj Carson <benjcarson@digitaljunkies.ca>
 * @ penulis Fabien Ménager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * /

namespace  Dompdf ;

/ **
 * Antarmuka rendering utama
 *
 * Saat ini {@link Dompdf \ Adapter \ CPDF}, {@link Dompdf \ Adapter \ PDFLib}, dan {@link Dompdf \ Adapter \ GD}
 * menerapkan antarmuka ini.
 *
 * Implementasi harus mengukur x dan y meningkat ke kiri dan ke bawah,
* masing-masing, dengan titik asal di pojok kiri atas. Implementasi
 * bebas menggunakan satuan selain panjang titik, tetapi saya tidak bisa
 * menjamin bahwa hasilnya akan terlihat bagus.
 *
 * @ paket dompdf
 * /
antarmuka  Canvas
{
    function  __construct ( $ paper = "letter" , $ orientasi = "potret" , Dompdf  $ dompdf = null );

    / **
     * @return Dompdf
     * /
    function  get_dompdf ();

    / **
     * Mengembalikan nomor halaman saat ini
     *
     * @return int
     * /
    function  get_page_number ();

    / **
     * Mengembalikan jumlah halaman
     *
     * @return int
     * /
    function  get_page_count ();

    / **
     * Mengatur jumlah halaman
     *
     * @param int $ hitung
     * /
    function  set_page_count ( $ hitungan );

    / **
     * Menarik garis dari x1, y1 ke x2, y2
     *
     * Lihat {@link Style :: munge_color ()} untuk format larik warna.
     * Lihat {@link Cpdf :: setLineStyle ()} untuk penjelasan tentang format
     * Parameter $ style (alias tanda hubung).
     *
     * @param float $ x1
     * @param float $ y1
     * @param float $ x2
     * @param float $ y2
     * @param array $ color
     * @param float $ width
     * @param array $ style
     * /
     baris fungsi ( $ x1 , $ y1 , $ x2 , $ y2 , $ color , $ width , $ style = null );

    / **
     * Menggambar persegi panjang pada x1, y1 dengan lebar w dan tinggi h
     *
     * Lihat {@link Style :: munge_color ()} untuk format larik warna.
     * Lihat {@link Cpdf :: setLineStyle ()} untuk deskripsi $ style
     * parameter (alias tanda hubung)
     *
     * @param float $ x1
     * @param float $ y1
     * @param float $ w
     * @param float $ h
     * @param array $ color
     * @param float $ width
     * @param array $ style
     * /
    fungsi  persegi panjang ( $ x1 , $ y1 , $ w , $ h , $ color , $ width , $ style = null );

    / **
     * Menggambar persegi panjang yang terisi pada x1, y1 dengan lebar w dan tinggi h
     *
     * Lihat {@link Style :: munge_color ()} untuk format larik warna.
     *
     * @param float $ x1
     * @param float $ y1
     * @param float $ w
     * @param float $ h
     * @param array $ color
     * /
    Fungsi  filled_rectangle ( $ x1 , $ y1 , $ w , $ h , $ warna );

    / **
     * Mulai persegi panjang kliping pada x1, y1 dengan lebar w dan tinggi h
     *
     * @param float $ x1
     * @param float $ y1
     * @param float $ w
     * @param float $ h
     * /
    fungsi  clipping_rectangle ( $ x1 , $ y1 , $ w , $ h );

    / **
     * Mulai persegi panjang kliping bulat pada x1, y1 dengan lebar w dan tinggi h
     *
     * @param float $ x1
     * @param float $ y1
     * @param float $ w
     * @param float $ h
     * @param float $ tl
     * @param float $ tr
     * @param float $ br
     * @param float $ bl
     *
     * @ kembali
     * /
    fungsi  clipping_roundrectangle ( $ x1 , $ y1 , $ w , $ h , $ tl , $ tr , $ br , $ bl );

    / **
     * Mengakhiri bentuk kliping terakhir
     * /
    fungsi  clipping_end ();

    / **
     * Menulis teks pada koordinat x dan y yang ditentukan pada setiap halaman
     *
     * String '{PAGE_NUM}' dan '{PAGE_COUNT}' diganti secara otomatis
     * dengan nilainya saat ini.
     *
     * Lihat {@link Style :: munge_color ()} untuk format larik warna.
     *
     * @param float $ x
     * @param float $ y
     * @param string $ teks teks yang akan ditulis
     * @param string $ font file font yang akan digunakan
     * @param float $ mengukur ukuran font, dalam poin
     * @param array $ color
     * @param float $ word_space penyesuaian spasi kata
     * @param float $ char_space penyesuaian jarak karakter
     * @param float $ angle angle untuk menulis teks, diukur CW mulai dari sumbu x
     * /
     teks halaman fungsi  publik ( $ x , $ y , $ teks , $ font , $ size , $ color = [ 0 , 0 , 0 ], $ word_space = 0.0 , $ char_space = 0.0 , $ angle = 0.0 );

    / **
     * Simpan keadaan saat ini
     * /
    fungsi  simpan ();

    / **
     * Kembalikan keadaan terakhir
     * /
     pemulihan fungsi ();

    / **
     * Putar
     *
     * @param float $ sudut sudut dalam derajat untuk rotasi berlawanan arah jarum jam
     * @param float $ x Origin absis
     * @param float $ y Ordinat asal
     * /
    fungsi  putar ( $ sudut , $ x , $ y );

    / **
     * Miring
     *
     * @param float $ angle_x
     * @param float $ angle_y
     * @param float $ x Origin absis
     * @param float $ y Ordinat asal
     * /
    fungsi  miring ( $ angle_x , $ angle_y , $ x , $ y );

    / **
     * Skala
     *
     * Faktor penskalaan @param float $ s_x untuk lebar sebagai persen
     * Faktor penskalaan @param float $ s_y untuk tinggi sebagai persen
     * @param float $ x Origin absis
     * @param float $ y Ordinat asal
     * /
     skala fungsi ( $ s_x , $ s_y , $ x , $ y );

    / **
     * Terjemahkan
     *
     * @param float $ t_x gerakan ke kanan
     * @param float $ t_y gerakan ke bawah
     * /
     terjemahan fungsi ( $ t_x , $ t_y );

    / **
     * Transformasi
     *
     * @param $ a
     * @param $ b
     * @param $ c
     * @param $ d
     * @param $ e
     * @param $ f
     * @ kembali
     * /
     transformasi fungsi ( $ a , $ b , $ c , $ d , $ e , $ f );

    / **
     * Menggambar poligon
     *
     * Poligon dibentuk dengan menggabungkan semua titik yang disimpan dalam $ points
     * Himpunan. $ points memiliki struktur berikut:
     * <code>
     * larik (0 => x1,
     * 1 => y1,
     * 2 => x2,
     * 3 => y2,
     * ...
     *);
     * </code>
     *
     * Lihat {@link Style :: munge_color ()} untuk format larik warna.
     * Lihat {@link Cpdf :: setLineStyle ()} untuk deskripsi $ style
     * parameter (alias tanda hubung)
     *
     * @param array $ points
     * @param array $ color
     * @param float $ width
     * @param array $ style
     * @param bool $ fill Mengisi poligon jika benar
     * /
     poligon fungsi ( $ poin , $ warna , $ lebar = null , $ style = null , $ fill = false );

    / **
     * Menggambar lingkaran pada $ x, $ y dengan radius $ r
     *
     * Lihat {@link Style :: munge_color ()} untuk format larik warna.
     * Lihat {@link Cpdf :: setLineStyle ()} untuk deskripsi $ style
     * parameter (alias tanda hubung)
     *
     * @param float $ x
     * @param float $ y
     * @param float $ r
     * @param array $ color
     * @param float $ width
     * @param array $ style
     * @param bool $ fill Isi lingkaran jika true
     * /
     lingkaran fungsi ( $ x , $ y , $ r , $ color , $ width = null , $ style = null , $ fill = false );

    / **
     * Tambahkan gambar ke pdf.
     *
     * Gambar ditempatkan pada koordinat x dan y yang ditentukan dengan
     * diberi lebar dan tinggi.
     *
     * @param string $ img_url jalur ke gambar
     * @param float posisi $ xx
     * @param float $ yy position
     * @param int $ w lebar (dalam piksel)
     * @param int $ h tinggi (dalam piksel)
     * @param string $ resolution Resolusi gambar
     * /
     gambar fungsi ( $ img_url , $ x , $ y , $ w , $ h , $ resolution = "normal" );

    / **
     * Tambahkan busur ke PDF
     * Lihat {@link Style :: munge_color ()} untuk format larik warna.
     *
     * @param float $ x X koordinat busur
     * @param float $ y Y koordinat busur
     * @param float $ r1 Radius 1
     * @param float $ r2 Radius 2
     * @param float $ astart Sudut awal dalam derajat
     * @param float $ aend Sudut akhir dalam derajat
     * @param array $ color Color
     * @param float $ width
     * @param array $ style
     * /
     busur fungsi ( $ x , $ y , $ r1 , $ r2 , $ astart , $ aend , $ color , $ width , $ style = []);

    / **
     * Menulis teks pada koordinat x dan y yang ditentukan
     * Lihat {@link Style :: munge_color ()} untuk format larik warna.
     *
     * @param float $ x
     * @param float $ y
     * @param string $ teks teks yang akan ditulis
     * @param string $ font file font yang akan digunakan
     * @param float $ mengukur ukuran font, dalam poin
     * @param array $ color
     * @param float $ word_space penyesuaian spasi kata
     * @param float $ char_space penyesuaian jarak karakter
     * @param float $ sudut sudut
     * /
     teks fungsi ( $ x , $ y , $ teks , $ font , $ size , $ color = [ 0 , 0 , 0 ], $ word_space = 0.0 , $ char_space = 0.0 , $ angle = 0.0 );

    / **
     * Tambahkan tujuan bernama (mirip dengan <a name="foo"> ... </a> di html)
     *
     * @param string $ anchorname Nama tujuan bernama
     * /
    function  add_named_dest ( $ anchorname );

    / **
     * Tambahkan tautan ke pdf
     *
     * @param string $ url Url yang akan ditautkan
     * @param float $ x Posisi x dari tautan
     * @param float $ y Posisi y dari link
     * @param float $ width Lebar link
     * @param float $ height Tinggi tautan
     * /
    function  add_link ( $ url , $ x , $ y , $ width , $ height );

    / **
     * Tambahkan informasi meta ke pdf
     *
     * @param string $ name Label nilai (Pembuat, Produser, dll.)
     * @param string $ value Teks yang akan disetel
     * /
    function  add_info ( $ nama , $ nilai );

    / **
     * Menghitung ukuran teks, dalam poin
     *
     * @param string $ teks ukuran teks
     * @param string $ font font yang diinginkan
     * @param float $ size ukuran font yang diinginkan
     * @param float $ word_spacing spasi kata, jika ada
     * @param float $ char_spacing
     *
     * @return float
     * /
    function  get_text_width ( $ teks , $ font , $ size , $ word_spacing = 0.0 , $ char_spacing = 0.0 );

    / **
     * Menghitung tinggi font, dalam poin
     *
     * @param string $ font
     * @param float $ size
     *
     * @return float
     * /
    function  get_font_height ( $ font , $ size );

    / **
     * Menghitung baseline font, dalam poin
     *
     * @param string $ font
     * @param float $ size
     *
     * @return float
     * /
    function  get_font_baseline ( $ font , $ size );

    / **
     * Mengembalikan lebar PDF dalam poin
     *
     * @return float
     * /
    function  get_width ();


    / **
     * Kembalikan tinggi gambar dalam piksel
     *
     * @return float
     * /
    function  get_height ();

    / **
     * Mengembalikan font x-height, dalam poin
     *
     * @param string $ font
     * @param float $ size
     *
     * @return float
     * /
    // function get_font_x_height ($ font, $ size);

    / **
     * Mengatur opacity
     *
     * @param float $ opacity
     * @ string parameter $ mode
     * /
    function  set_opacity ( $ opacity , $ mode = "Normal" );

    / **
     * Mengatur tampilan default
     *
     * @param string $ view
     * 'XYZ' kiri, atas, zoom
     * 'Cocok'
     * Atasan 'FitH'
     * 'FitV' tersisa
     * 'FitR' kiri, bawah, kanan
     * 'FitB'
     * Bagian atas 'FitBH'
     * 'FitBV' tersisa
     * @param array $ options
     *
     * @ kembali batal
     * /
    function  set_default_view ( $ tampilan , $ options = []);

    / **
     * @param string $ script
     *
     * @ kembali batal
     * /
    function  javascript ( $ script );

    / **
     * Memulai halaman baru
     *
     * Operasi menggambar selanjutnya akan muncul di halaman baru.
     * /
    function  new_page ();

    / **
     * Streaming PDF langsung ke browser.
     *
     * @param string $ filename Nama file yang akan ditampilkan ke browser.
     * @param array $ options Array asosiatif: 'compress' => 1 atau 0 (default 1); 'Lampiran' => 1 atau 0 (default 1).
     * /
     aliran fungsi ( $ nama file , $ options = []);

    / **
     * Mengembalikan PDF sebagai string.
     *
     * @param array $ options Array asosiatif: 'compress' => 1 atau 0 (default 1).
     * @ string kembali
     * /
     keluaran fungsi ( $ options = []);
}