<?php 
require 'core/init.php';
protectPage();
include 'includes/_header.php';
?>

<?php 
if(isset($_SESSION['cetakNota'])){
	$KdTransaksi = $_SESSION['cetakNota'];
	$query 		 = mysql_query("SELECT * 
								FROM UserAktaTransaction, User, JenisAkta, Document 
								WHERE UserAktaTransaction.PenghadapId=User.Id 
								AND JenisAkta.Id=UserAktaTransaction.JenisAktaId
								AND Document.KdTransaksi=UserAktaTransaction.KdTransaksi
								AND md5(userAktaTransaction.KdTransaksi)='$KdTransaksi'");
	$transactionData 		= mysql_fetch_assoc($query);		
	
?>
<div class="alert">Terimakasih, Pengajuan Akta berhasil disubmit <i class="icon fa-smile-o"></i> periksa kembali detail Pengajuan Akta dibawah ini!</div>

<div style="margin-top:-30px" id="main" class="container">
	
	<div class="box">
		<h2 align="center" style="margin-top:-40px">Notaris PPAT Rian Erza  <br> #<?=$transactionData['KdTransaksi'] ?></h2>

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
			<td>Deskripsi</td>
			<td>Dokumen persyaratan</td>
			<td>Status</td>
		</tr>
		<tr align="center">
			<td>
			<?php
			(!empty($transactionData['Deskripsi'])) ? $desc=$transactionData['Deskripsi'] : $desc='-';
				echo $desc;
			?>
			</td>
			<td> <a class="icon fa-file" href="<?= $transactionData['DocPersyaratan']?>" target="blank"> Lihat Dokument</a></td>	
			<td> Diperiksa</td>	
		</tr>
	</table>
	<a href="pengajuanSaya.php" class="button fit special" target="blank">Pengajuan Saya</a>
	</div>				   
	
</div>
<?php
} else {
	header("Location: pemesanan.php");
}
include 'includes/_footer.php';

