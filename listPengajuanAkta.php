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
					<h6>
						
						<table id="users">
							<thead>
								<tr>
									<th>Kode Transaksi</th>
									<th>Tgl Transaksi</th>
									<th>Jenis Transaksi</th>
									<th>Nama Penghadap</th>
									<th>No Tlp</th>
									<th>NPWP Pribadi/PT</th>
									<th>Harga (Rp)</th>
									<th>Sudah Bayar (Rp)</th>
									<th>No SK/SP</th>
									<th>Akta</th>
									<th>STATUS</th>
									<th>Opsi</th>
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
									<td><?= $row['KdTransaksi'] ?></td>
									<td><?= date('d/m/y', strtotime($row['TglTransaksi'])) ?></td>
									<td><?= $row['JenisAkta'] ?></td>
									<td><?= $row['NamaLengkap'] ?></td>
									<td><?= $row['NoTlp'] ?></td>
									<td><?= $row['NPWP'] ?></td>
									<td><?= rupiah($row['Harga']) ?></td>
									<td><?= rupiah($row['SudahBayar']) ?></td>
									<td><?= $row['NoSK'] ?></td>
									<td> <a target="_blank" href="<?= $row['DocAkta'] ?>" class="icon fa-download"> Download</a></td>
									<?php 
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
									<td><a href="aktaEdit.php?id=<?= $row['Id'] ?>" class="icon fa-edit"> | <a href="#" class="icon fa-trash"></td>
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