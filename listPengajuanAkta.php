<?php
require 'core/init.php';
protectPage();
adminProtect();
?>

<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css" />

<?php include 'includes/_header.php' ?>

<div id="main" style="margin-top:-30px" class="panel-body">

			

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
								
								<a href="xls/pelanggan_xls.php" class="button small icon fa-download"> Excel</a>
							</li>
						</ul>
					</div>
				</div>

					<table id="users">
						<thead>
							<tr>
								<th>#</th>
								<th>Kode Transaksi</th>
								<th>Tanggal Transaksi</th>
								<th>Jenis Transaksi</th>
								<th>Nama Penghadap</th>
								<th>NIK / No KTP</th>
								<th>NPWP</th>
								<th>Dokument Persyaratan</th>
								<th>No SK</th>
							</tr>
						</thead>

						<tbody>
						<?php 
						$transactionData = mysql_query("SELECT * 
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
								<td><?= '1' ?></td>
								<td><?= $row['KdTransaksi'] ?></td>
								<td><?= $row['TglTransaksi'] ?></td>
								<td><?= $row['JenisAkta'] ?></td>
								<td><?= $row['NamaLengkap'] ?></td>
								<td><?= $row['NIK'] ?></td>
								<td><?= $row['NPWP'] ?></td>
								<td> <a href="<?= $row['DocPersyaratan'] ?>" class="icon fa-download"> Download</a></td>
								<td><?= $row['NoSK'] ?></td>
								<td><a href="a_userEdit.php?id=<?= $row['Id'] ?>" class="icon fa-edit"> | <a href="#" class="icon fa-trash"></td>
							</tr>
							<?php
						}
						?>
						</tbody>
						<tr>
							<td colspan="2" align="center"><b>Total Penghadap</b></td>
							<td align="right">
								<b> <?=$total ?></b>
							</td>
							<td></td>
						</tr>
					</table>
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