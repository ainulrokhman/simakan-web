<?php
// Tentukan path yang tepat ke mPDF
$nama_dokumen='Daftar_seleksi_calon_siswa'; //Beri nama file PDF hasil.
define('_MPDF_PATH','assets/plugins/mpdf/vendor/'); // Tentukan folder dimana anda menyimpan folder mpdf
require_once(_MPDF_PATH . "autoload.php"); // Arahkan ke file mpdf.php didalam folder mpdf
//$mpdf=new mPDF('utf-8', 'A4', 10.5, 'arial'); // Membuat file mpdf baru
$mpdf = new \Mpdf\Mpdf();
 
//Memulai proses untuk menyimpan variabel php dan html
ob_start();
?>
 
Untuk konten nya dibuat sendiri ya soalnya ga tau design nya mau kaya gimana<br>
file nya ada di views/rpl_view.php
 
<?php
 
$mpdf->setFooter('{PAGENO}');
//penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>