<?php
require '../core/init.php';
protectPage();
adminProtect();
error_reporting(0);

require_once '../core/init.php';
require_once '../plugins/excel/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$start  = date('Y-m-d', strtotime($_GET['s']));
$end  = date('Y-m-d', strtotime($_GET['e'])); 

$query="SELECT * 
            FROM UserAktaTransaction, User, JenisAkta
            WHERE User.Id=UserAktaTransaction.PenghadapId 
            AND JenisAkta.Id=UserAktaTransaction.JenisAktaId
            And TglTransaksi BETWEEN '$start' AND '$end'
            ORDER BY TglTransaksi";

$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Risky Muaji")
      ->setLastModifiedBy("Risky Muaji")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan Transaksi Akta | Notaris PPAT Riar Erza")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Data Transaksi Akta");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'Tanggal')
       ->setCellValue('B1', 'Kode Transaksi')
       ->setCellValue('C1', 'Nama Penghadap')
       ->setCellValue('D1', 'Jenis Transaksi')
       ->setCellValue('E1', 'Nama Akta')
       ->setCellValue('F1', 'Harga')
       ->setCellValue('G1', 'Sisa Tagihan')
       ->setCellValue('H1', 'Keterangan');
 
$baris = 2;
$no = 0;			
while($row=mysql_fetch_array($hasil)){
  $no = $no +1;
  $objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue("A$baris", $row['TglTransaksi'])
       ->setCellValue("B$baris", $row['KdTransaksi'])
       ->setCellValue("C$baris", $row['NamaLengkap'])
       ->setCellValue("D$baris", $row['JenisAkta'])
       ->setCellValue("E$baris", $row['NamaAkta'])
       ->setCellValue("F$baris", $row['Harga'])
       ->setCellValue("G$baris", $row['SisaTagihan'])
       ->setCellValue("H$baris", $row['Keterangan']);
  $baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Laporan Transaksi Akta');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Laporan Transaksi Akta - Periode ('.$start.' sd '.$end.').xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 