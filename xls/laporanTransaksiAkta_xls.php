<?php

error_reporting(0);

require_once '../core/init.php';
require_once '../plugins/excel/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$start  = date('Y-m-d', strtotime($_GET['s']));
$end  = date('Y-m-d', strtotime($_GET['e'])); 

$query="SELECT * 
            FROM UserAktaTransaction
            WHERE TglTransaksi BETWEEN '$start' AND '$end'
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
       ->setCellValue('B1', 'Kope Transaksi')
       ->setCellValue('C1', 'Nama Akta')
       ->setCellValue('D1', 'Harga')
       ->setCellValue('E1', 'Sisa Tagihan')
       ->setCellValue('F1', 'Keterangan');
 
$baris = 2;
$no = 0;			
while($row=mysql_fetch_array($hasil)){
  $no = $no +1;
  $objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue("A$baris", $row['TglTransaksi'])
       ->setCellValue("B$baris", $row['KdTransaksi'])
       ->setCellValue("C$baris", $row['NamaAkta'])
       ->setCellValue("D$baris", $row['Harga'])
       ->setCellValue("E$baris", $row['SisaTagihan'])
       ->setCellValue("F$baris", $row['Keterangan']);
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
 