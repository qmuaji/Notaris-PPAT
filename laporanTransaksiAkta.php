<?php 	
require 'core/init.php';
protectPage();
adminProtect();
include 'includes/_header.php';

$showPage 	= '';
$batas		= 30;

if (isset($_GET['page'])) $noPage = $_GET['page'];
else $noPage = 1;

$offset=($noPage - 1) * $batas;


$start	= "";
$end	= date('Y-m-d');
$ket 	= 'Awal - Akhir';
$result = mysql_query("SELECT * 
						FROM UserAktaTransaction, User, JenisAkta
						WHERE User.Id=UserAktaTransaction.PenghadapId 
						AND JenisAkta.Id=UserAktaTransaction.JenisAktaId
						AND TglTransaksi BETWEEN '$start' AND '$end'
						ORDER BY TglTransaksi
						LIMIT $offset, $batas") or die (mysql_error());

$q 		= mysql_query("SELECT COUNT(Id) from UserAktaTransaction");

if (!empty($_POST)){

	$start 	= date('Y-m-d', strtotime($_POST['start']));
	$end 	= date('Y-m-d', strtotime($_POST['end'])); 

	$result = mysql_query("SELECT * 
							FROM UserAktaTransaction, User, JenisAkta
							WHERE User.Id=UserAktaTransaction.PenghadapId 
							AND JenisAkta.Id=UserAktaTransaction.JenisAktaId
							AND TglTransaksi BETWEEN '$start' AND '$end'
							ORDER BY TglTransaksi
							LIMIT $offset, $batas") or die (mysql_error());

	$ket	= date('d F Y', strtotime($_POST['start'])). " - ".date('d F Y', strtotime($_POST['end']));

	$q 		= mysql_query("SELECT COUNT(Id) from UserAktaTransaction WHERE TglTransaksi BETWEEN '$start' AND '$end'");
} 
$no = 1;
	$jml 		= mysql_fetch_array($q);
	$jmlData	= $jml[0];
 ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Laporan Transaksi Akta</h3>

	</div>
<div class="panel-body">
	<form action="" method="post">
		<div class="container" id="sandbox-container">
		
	<?php if($jmlData > 0) {
		?><a href="xls/laporanTransaksiAkta_xls.php?s=<?= $start ?>&e=<?= $end ?>" class="button small icon fa-download"> Excel</a> |<?php
		} ?> Periode :
				<div class="input-daterange input-group" id="datepicker">
			    	<input type="text" class="form-control" name="start"/>
			    	<span class="input-group-addon">sd</span>
			    	<input type="text" class="form-control" name="end" />
			    	<span class="input-group-btn">
			    	<button class="btn" type="submit">OK</button></span>
			    </div>
			
		</div>
	</form>


	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="warning">
					<th class='text-center'><small>#</small></th>
					<th class='text-center'>Tanggal</th>
					<th class='text-center'>Kode Transaksi</th>
					<th class='text-center'>Nama Penghadap</th>
					<th class='text-center'>Jenis Akta</th>
					<th class='text-center'>Nama Akta</th>
					<th class='text-center'>Harga</th>	
					<th class='text-center'>Sisa Tagihan</th>	
					<th class='text-center'>Keterangan</th>	
				</tr>
			</thead>
			<tbody>
			<?php 
				$subTotal = 0;
				$subTotal2 = 0;
				while($rows = mysql_fetch_array($result)){
					$tgl 	= $rows['TglTransaksi'];
					$tgl = date("d F, Y", strtotime($tgl));
					$kdTransaksi 	= $rows['KdTransaksi'];
					$namaPenghadap 	= $rows['NamaLengkap'];
					$jenisAkta 		= $rows['JenisAkta'];
					$namaAkta 		= $rows['NamaAkta'];
					$harga 			= $rows['Harga'];
					$sisaTagihan 	= $rows['SisaTagihan'];
					$status 		= $rows['Keterangan'];
					$subTotal 		= $subTotal + $harga;
					$subTotal2 		= $subTotal2 + $sisaTagihan;

				 ?>
				<tr>
					<td class='text-center'><small><?= $no ?></small></td>
					<td><?= $tgl ?></td>
					<td class='text-center'><small><?= $kdTransaksi ?></small></td>
					<td class='text-center'><small><?= $namaPenghadap ?></small></td>
					<td class='text-center'><small><?= $jenisAkta ?></small></td>
					<td class='text-center'><small><?= $namaAkta ?></small></td>
					<td class='text-right'><?= number_format($harga,0,',','.') ?></td>
					<td class='text-right'><?= number_format($sisaTagihan,0,',','.') ?></td>
					<td class='text-right'><?= $status ?></td>
				</tr>
				<?php 
					$no++;	
				}
			 ?>
				<tr>		
					<td colspan="4" class='text-right'>
						Total
					</td>		
				 	<td class='text-right'>
				 		<b><?= number_format($subTotal,0,',','.') ?></b>
				 	</td>
				 	<td class='text-right'>
				 		<b><?= number_format($subTotal2,0,',','.') ?></b>
				 	</td>

				</tr>		
			</tbody>
		</table>
	</div>

<div class="col-md-offset-5">
	<ul class="pagination">
	<?php 


	  $jmlPage	= ceil($jmlData / $batas);

	  if($noPage > 1) echo "<li><a href=$_SERVER[PHP_SELF]?f=laporan_view&page=".($noPage-1).">&laquo;</a></li>";

	  for($i=1; $i <= $jmlPage; $i++){

	    if ((($i >= $noPage - $batas) && ($i <= $noPage + $batas)) || ($i == 1)  || $i == $jmlPage){

	      if(($showPage == 1) && ($i != 2)) echo "<li><a>...</a></li>";

	      if(($showPage != ($jmlPage - 1)) && ($i == $jmlPage)) echo "<li><a>...</a></li>";

	      if($i==$noPage) echo "<li class=active><a>$i</a></li>";

	      else echo "<li><a href=".$_SERVER['PHP_SELF']."?f=laporan_view&page=".$i." > ".$i."</a></li>";

	      $showPage=$i;
	    }  
	  }
	 
	  if ($noPage < $jmlPage) echo "<li><a href=$_SERVER[PHP_SELF]?f=laporan_view&page=".($noPage+1).">&raquo;</a></li>";

	?>
	</ul>
		
</div>
<div class="label label-danger">Total Data : <?= $jmlData ?></div><br>
</div>

<?php include 'includes/_footer.php' ?>

<script>
	$(document).ready(function(){
	  $('#sandbox-container .input-daterange').datepicker({
	    format    : 'dd MM yyyy'
	  });
	});

</script>