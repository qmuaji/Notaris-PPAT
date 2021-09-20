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
       ->setCellValue('A1', 'Kode Transaksi')
       ->setCellValue('B1', 'Tanggal Transaksi')
       ->setCellValue('C1', 'No Akta')
       ->setCellValue('D1', 'Tanggal Akta')
       ->setCellValue('E1', 'No. SK')
       ->setCellValue('F1', 'Jenis Akta')
       ->setCellValue('G1', 'Nama Akta')
       ->setCellValue('H1', 'Deskripsi')
       ->setCellValue('I1', 'Harga')
       ->setCellValue('J1', 'Sudah Bayar')
       ->setCellValue('K1', 'Sisa Tagihan')
       ->setCellValue('L1', 'Keterangan')
       ->setCellValue('M1', 'Nama Penghadap');
 
$baris = 2;
$no = 0;			
while($row=mysql_fetch_array($hasil)){
  $no = $no +1;
  $objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue("A$baris", $row['KdTransaksi'])
       ->setCellValue("B$baris", $row['TglTransaksi'])
       ->setCellValue("C$baris", $row['NoAkta'])
       ->setCellValue("D$baris", $row['TanggalAkta'])
       ->setCellValue("E$baris", $row['NoSK'])
       ->setCellValue("F$baris", $row['JenisAkta'])
       ->setCellValue("G$baris", $row['NamaAkta'])
       ->setCellValue("H$baris", $row['Deskripsi'])
       ->setCellValue("I$baris", $row['Harga'])
       ->setCellValue("J$baris", $row['SudahBayar'])
       ->setCellValue("K$baris", $row['SisaTagihan'])
       ->setCellValue("L$baris", $row['Keterangan'])
       ->setCellValue("M$baris", $row['NamaLengkap']);
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
 