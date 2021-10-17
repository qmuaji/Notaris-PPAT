<?php 
require 'core/init.php';
protectPage();
include 'includes/_head.php';
?>
  <script type="text/javascript">
    if (window.print) {
      document.write();
    }
    setTimeout('window.print()', 1000);
    setTimeout('TO_INDEX()', 1200);
  </script>
<?php 
if(isset($_GET['code']) || isset($_SESSION['cetakNota'])){
	isset($_GET['code']) ? $kdTransaksi  = $_GET['code'] : $kdTransaksi  = $_SESSION['cetakNota'];
	$query 		= mysql_query("SELECT * 
								FROM UserAktaTransaction, User, JenisAkta, AktaStatus 
								WHERE User.Id=UserAktaTransaction.PenghadapId 
								AND JenisAkta.Id=UserAktaTransaction.JenisAktaId
								AND UserAktaTransaction.AktaStatusId=AktaStatus.Id
								AND md5(KdTransaksi)='$kdTransaksi'");
	$transactionData 		= mysql_fetch_assoc($query);		
	
?>
<div class="container" style="margin-top:-30px" id="main">
	<div class="box">
	<h2 align="center"><?=$appName?> <br> #<?= $transactionData['KdTransaksi'] ?></h2>
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
	<div style="text-align: right;">
		
		<sub>
		Sukabumi,___________ <br><br><br>
		( Administrasi )    
		</sub>
	</div>
	</div>
</div>

<?php
} else {
	header("Location: pemesanan.php");
}
