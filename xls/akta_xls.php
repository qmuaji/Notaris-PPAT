<?php

error_reporting(0);

require_once '../core/init.php';
require_once '../plugins/excel/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$query="SELECT * 
        FROM UserAktaTransaction, User, JenisAkta, AktaStatus, Document
        WHERE User.Id=UserAktaTransaction.PenghadapId 
        AND JenisAkta.Id=UserAktaTransaction.JenisAktaId
        AND UserAktaTransaction.AktaStatusId=AktaStatus.Id
        AND Document.KdTransaksi=UserAktaTransaction.KdTransaksi
        ORDER BY TglTransaksi DESC";
$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Risky Muaji")
      ->setLastModifiedBy("Risky Muaji")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan Daftar Pengajuan Akta .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Data Pengajuan Akta");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'Kode Transaksi')
       ->setCellValue('B1', 'No Akta')
       ->setCellValue('C1', 'Tgl Akta')
       ->setCellValue('D1', 'Jenis Akta')
       ->setCellValue('E1', 'Nama Akta')
       ->setCellValue('F1', 'NPWP Pribadi/PT')
       ->setCellValue('G1', 'No SK/SP')
       ->setCellValue('H1', 'Harga')
       ->setCellValue('I1', 'Sudah Bayar')
       ->setCellValue('J1', 'Keterangan')
       ->setCellValue('K1', 'Sisa Tagihan')
       ->setCellValue('L1', 'Nama Penghadap')
       ->setCellValue('M1', 'Pembuat Akta');
       ->setCellValue('N1', 'Status');
 
$baris = 2;
$no = 0;			
while($row=mysql_fetch_array($hasil)){
  $no = $no +1;
  $objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue("A$baris", $row['KdTransaksi'])
       ->setCellValue("B$baris", $row['NoAkta'])
       ->setCellValue("C$baris", $row['TglAkta'])
       ->setCellValue("D$baris", $row['JenisAkta'])
       ->setCellValue("E$baris", $row['NamaAkta'])
       ->setCellValue("F$baris", $row['NPWP'])
       ->setCellValue("G$baris", $row['NoSK'])
       ->setCellValue("H$baris", $row['Harga'])
       ->setCellValue("I$baris", $row['SudahBayar'])
       ->setCellValue("J$baris", $row['Keterangan'])
       ->setCellValue("K$baris", $row['SisaTagihan'])
       ->setCellValue("L$baris", $row['NamaLengkap'])
       ->setCellValue("M$baris", $row['PembuatAkta']);
       ->setCellValue("N$baris", $row['Status']);
  $baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Pengajuan Akta');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Daftar_Pengajuan_Akta.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 