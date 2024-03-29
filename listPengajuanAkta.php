<?php
require 'core/init.php';
protectPage();
adminProtect();

if (isset($_GET['del'])){
	$del 	 = $_GET['del'];
	if(hapusData('UserAktaTransaction', 'Id', $del)) {
		header('Location: listPengajuanAkta.php?del=success');
	}
}
if(!empty($_GET['del'])) {
		$alert[] = "Pengajuan berhasil di hapus!";

	}
?>

<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css" />

<?php include 'includes/_header.php' ?>

<div id="main" style="margin-top:-30px" class="panel-body">

	<?php if(!empty($alert)) echo outputErrors($alert);?>

	<div class="row">
		<div class="12u">
			<section class="box">
				<div class="row gtr-uniform gtr-50">
					<div class="col-9 col-12-mobilep">
						<h3 class="fit">Pengajuan Akta</h3>
					</div>
					<div class="col-3 col-12-mobilep">
						<ul class="actions">
							<li>
								
								<a href="xls/akta_xls.php" class="button small icon fa-download"> Excel</a>
							</li>
						</ul>
					</div>
				</div>
					<h6>
						
						<table id="users">
							<thead>
								<tr>
									<th>Kode Transaksi</th>
									<th>Tgl Transaksi</th>
									<th>No Akta</th>
									<th>Tgl Akta</th>
									<th>Jenis Transaksi</th>
									<th>Deskripsi</th>
									<th>Harga (Rp)</th>
									<th>Keterangan</th>
									<th>Nama Penghadap</th>
									<th>Status</th>
									<th>Opsi</th>
								</tr>
							</thead>

							<tbody>
							<?php 
							$transactionData = mysql_query("SELECT *, UserAktaTransaction.Id AS TrxId
									FROM UserAktaTransaction, User, JenisAkta, AktaStatus, Document
									WHERE User.Id=UserAktaTransaction.PenghadapId 
									AND JenisAkta.Id=UserAktaTransaction.JenisAktaId
									AND UserAktaTransaction.AktaStatusId=AktaStatus.Id
									AND Document.KdTransaksi=UserAktaTransaction.KdTransaksi
									ORDER BY TglTransaksi DESC");
							$total = mysql_num_rows($transactionData);

							if(mysql_num_rows($transactionData) == 0) echo "<h3><span class='icon fa-search'></span> Data Penghadap masih kosong.</h3><p> Silahkan tambahkan terlebih dahulu</p>";
							while($row = mysql_fetch_assoc($transactionData)){
								?>
								<tr>
									<td><?= $row['KdTransaksi'] ?></td>
									<td><?= date('d/m/y', strtotime($row['TglTransaksi'])) ?></td>
									<td><?= $row['NoAkta'] ?></td>
									<td><?= $row['TglAkta'] ?></td>
									<td><?= $row['JenisAkta'] ?></td>
									<td><?= $row['Deskripsi'] ?></td>
									<td><?= rupiah($row['Harga']) ?></td>
									<td><?= $row['Keterangan'] ?></td>
									<td><?= $row['NamaLengkap'] ?></td>
									<?php
									if(!empty($row['DocAkta'])){
										$doc = "<a target='_blank' href='{$row['DocAkta']}' class='icon fa-download'></a>";

									}else {
										$doc = "<b class='icon fa-minus'></b>";
									}

									if($row['Status'] == 'Diperiksa'){
										$warna='black';
									}elseif($row['Status']== 'Diproses'){
										$warna='orange';
									}elseif($row['Status']== 'Ditolak'){
										$warna='red';
									}else{
										$warna='green';
									}
									?>
									<td style="color:<?= $warna ?>"><?= $row['Status'] ?></td>
									<td>
										<a onclick="return confirm('Ubah Pengajuan Akta #<?=$row['KdTransaksi']?>?')"href="aktaEdit.php?id=<?= $row['TrxId'] ?>" class="icon fa-edit"> </a> | 	
										<?=$doc?> | 									
										<a onclick="return confirm('Hapus Pengajuan Akta #<?=$row['KdTransaksi']?>?')" href="?del=<?= $row['TrxId'] ?>" class="icon fa-trash"></a>
									</td>
								</tr>
								<?php
							}
							?>
							</tbody>
							<tr>
								<td colspan="2" align="center"><b>Total Data</b></td>
								<td align="right">
									<b> <?=$total ?></b>
								</td>
								<td></td>
							</tr>
						</table>
					</h6>
			</section>

		</div>
	</div>

</div>

<?php include 'includes/_footer.php' ?>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
    	$('#users').DataTable();
	} );
</script>