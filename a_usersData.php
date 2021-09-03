<?php
require 'core/init.php';
protectPage();
adminProtect();
?>

<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css" />

<?php include 'includes/_header.php' ?>

<div id="main" style="margin-top:-30px" class="container">

			

	<div class="row">
		<div class="12u">
			<section class="box">
				<div class="row gtr-uniform gtr-50">
					<div class="col-9 col-12-mobilep">
						<h3 class="fit">Data Penghadap</h3>
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
								<th>Nama</th>
								<th>Email</th>
								<th>Pekerjaan</th>
								<th>Opsi</th>
							</tr>
						</thead>

						<tbody>
						<?php 
						$usersData = mysql_query("SELECT * FROM User WHERE UserRoleId=1 AND IsActive=1");
						$total = mysql_num_rows($usersData);

						if(mysql_num_rows($usersData) == 0) echo "<h3><span class='icon fa-search'></span> Data Penghadap masih kosong.</h3><p> Silahkan tambahkan terlebih dahulu</p>";
						while($row = mysql_fetch_assoc($usersData)){
							?>
							<tr>
								<td><?= $row['NamaLengkap'] ?></td>
								<td><?= $row['Email'] ?></td>
								<td><?= $row['Pekerjaan'] ?></td>
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