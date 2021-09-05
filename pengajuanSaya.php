<?php
require 'core/init.php';
include 'includes/_header.php';

$showPage 	= '';
$batas		= 1;
if (isset($_GET['page'])) $noPage = $_GET['page'];
	else $noPage = 1;

$offset=($noPage - 1) * $batas;

if(isset($_POST['cari'])){ 
  	$cari 		= trim($_POST['cari']);  
	$nota 		= mysql_query("SELECT * 
								FROM UserAktaTransaction, User, JenisAkta, AktaStatus 
								WHERE User.Id=UserAktaTransaction.PenghadapId 
								AND PenghadapId=$userData[Id] 
								AND JenisAkta.Id=UserAktaTransaction.JenisAktaId
								AND UserAktaTransaction.AktaStatusId=AktaStatus.Id
								AND KdTransaksi='$cari' ORDER BY TglTransaksi DESC");
    $q     	  	= mysql_query("SELECT COUNT(Id) FROM UserAktaTransaction WHERE PenghadapId=$userData[Id] AND KdTransaksi='$cari'");   
	?>		<?php
}else{
	$nota 		= mysql_query("SELECT * 
								FROM UserAktaTransaction, User, JenisAkta, AktaStatus 
								WHERE User.Id=UserAktaTransaction.PenghadapId 
								AND PenghadapId=$userData[Id] 
								AND JenisAkta.Id=UserAktaTransaction.JenisAktaId
								AND UserAktaTransaction.AktaStatusId=AktaStatus.Id
								ORDER BY TglTransaksi DESC LIMIT $offset, $batas") or die (mysql_error());
	$q 			= mysql_query("SELECT COUNT(Id) FROM UserAktaTransaction WHERE PenghadapId=$userData[Id]");
} 

$no = $offset+1;

?>

<div style="margin-top:-30px" id="main" class="container">
	<h3> Status Pengajuan Saya</h3>
	<?php  
	if(mysql_num_rows($nota) == 0) echo("<hr><h2 align='center'><span class='icon fa-search'></span> Data tidak ditemukan, <br><a class='icon fa-chevron-left' href='penyewaan.php'> Kembali</a></h2><hr>");

	while($transactionData = mysql_fetch_assoc($nota)){
	?>
	<div class="box">
		<?php 
		$today_dt = new DateTime(date('Y-m-d'));
		$expire_dt = new DateTime($transactionData['TglTransaksi']);
		
		if ($transactionData['AktaStatusId'] == 3) {
			?><a href="cetakNota.php?code=<?= md5($transactionData['KdTransaksi']) ?>" class="button special fit icon fa-print" target="blank">Cetak</a><?php
		} else {
			($transactionData['AktaStatusId'] == 4) ? $warna = 'red' : $warna='green';
			?><b style="color:<?= $warna ?>"><?=$transactionData['Status']?></b> <?php
		}
		?>
	<table>
		<tr>
			<td width="180px">
				Kode Transaksi <br>
				Tgl Transaksi <br>
				Jenis Transaksi				
			</td>
			<td>
				: <?= $transactionData['KdTransaksi'] ?> <br>
				: <?= date('d F, Y', strtotime($transactionData['TglTransaksi'])) ?>  <br>
				: <?= $transactionData['JenisAkta'] ?>
				
			</td>
			
			<td widtd="90px">
				Penghadap <br>
				NIK <br>
				Tlp <br>				
			</td>
			<td>
				: <?= $transactionData['NamaLengkap'] ?> <br>
				: <?= $transactionData['NIK'] ?> <br>
				: <?= $transactionData['NoTlp'] ?>				
			</td>
		</tr>
	</table>

	<table class="alt" style="margin-top:-25px">
		<tr align="center">
			<td>No. SK/SP</td>
			<td>Harga (Rp)</td>
			<td>Sudah Bayar (Rp)</td>
			<td>Metode Bayar</td>
			<td>Keterangan</td>
		</tr>
		<tr align="center">
			<td>
			<?php
			(!empty($transactionData['NoSK'])) ? $noSK=$transactionData['NoSK'] : $noSK='-';
				echo $noSK;
			?>
			</td>
			<td><?= rupiah($transactionData['Harga'])?></td>
			<td><?= rupiah($transactionData['SudahBayar'])?></td>
			<td> <?= $transactionData['MetodeBayar']?></td>	
			<td> <?= $transactionData['Keterangan']?></td>	
		</tr>
	</table>

	</div>
		<?php
		}
		?>
	<form action="" method="POST">
		<div class="row">			
			<div  align="right" class="6u 12u">
			<?php 	
		 	$jml 		= mysql_fetch_array($q);
		  	$jmlData	= $jml[0];
		  	$jmlPage	= ceil($jmlData / $batas);

			if($noPage > 1) echo "<a class='button alt small' href=$_SERVER[PHP_SELF]?page=".($noPage-1)."><span class='icon fa-chevron-left'></a>";

			  for($i=1; $i <= $jmlPage; $i++){
			    if ((($i >= $noPage - $batas) && ($i <= $noPage + $batas)) || ($i == 1)  || $i == $jmlPage){
			      if(($showPage == 1) && ($i != 2)) echo "<a class='button small'>...</a>";
			      if(($showPage != ($jmlPage - 1)) && ($i == $jmlPage)) echo "<a class='button alt small'>...</a>";
			      if($i == $noPage) echo "<a class='button special alt small'>$i</a>";
			      else echo "<a class='button alt small' href=".$_SERVER['PHP_SELF']."?page=".$i." > ".$i."</a>";
			      $showPage=$i;
			    }  
			}			 
			
			if ($noPage < $jmlPage) echo "<a class='button alt small' href=$_SERVER[PHP_SELF]?page=".($noPage+1)."><span class='icon fa-chevron-right'></span></a>";
			?>	
			</div>

			<div class="6u 12u">		
		  		<input type="text" name="cari" placeholder="Cari kode transaksi..">	
			</div>
		</div>
	</form>
		  		<a href="pengajuanAkta.php" class="button special fit">Buat Pengajuan Akta</a>					   
	
</div>

	<?php include 'includes/_footer.php';

		if(mysql_num_rows($nota) == 0) echo("<hr><h2 align='center'><span class='icon fa-search'></span> Data tidak ditemukan, <br><a href='a_konfirm2.php'> Kembali</a>.</h2><hr>");
