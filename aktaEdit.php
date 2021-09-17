<?php
require 'core/init.php';
protectPage();
adminProtect();

if(isset($_GET['id'])) {
	$id 		= (int)$_GET['id'];
	$row 		= mysql_fetch_assoc(mysql_query("SELECT *, AktaStatus.id as StatusId
									FROM UserAktaTransaction, User, JenisAkta, AktaStatus, Document
									WHERE User.Id=UserAktaTransaction.PenghadapId 
									AND JenisAkta.Id=UserAktaTransaction.JenisAktaId
									AND UserAktaTransaction.AktaStatusId=AktaStatus.Id
									AND Document.KdTransaksi=UserAktaTransaction.KdTransaksi
									AND UserAktaTransaction.Id = $id"));
	$jenisAktaId 	= $row['JenisAktaId'];
	$npwp 			= $row['NPWP'];
	$deskripsi 		= $row['Deskripsi'];
	$aktatStatusId	= $row['StatusId'];
	$noSK 			= $row['NoSK'];
	$tglAkta 		= $row['TglAkta'];
	$harga 			= $row['Harga'];
	$sudahBayar		= $row['SudahBayar'];


	if(!empty($_POST)) {

		$requiredFields = array('JenisAktaId', 'NPWP', 'NIK', 'Deskripsi');
		foreach($_POST as $key=>$value) {
			if(empty($value) && in_array($key, $requiredFields)){
				$alert[] = "Silahkan isi bagian yang ditandai * <i class='icon fa-smile-o'></i>";
				break 1;
			}
		}

		$jenisAktaId 		= trim($_POST['JenisAktaId']);
		$npwp 				= trim($_POST['NPWP']);
		$deskripsi 			= trim($_POST['Deskripsi']);
		$aktatStatusId		= trim($_POST['AktaStatusId']);
		$noSK 				= trim($_POST['NoSK']);
		$tglAkta 			= trim($_POST['TglAkta']);
		$harga  			= trim($_POST['Harga']);
		$sudahBayar			= trim($_POST['SudahBayar']);
		$tipeFile = array('pdf', 'doc', 'docx');
		$fileName = $_FILES['DocAkta']['name'];
		$extn 	  = explode('.', $fileName);
		$fileExtn = strtolower(end($extn));
		$fileTmp  = $_FILES['DocAkta']['tmp_name'];

		if(empty($alert)) {


			if(empty($alert)) {
				$userAktaTransaction = array(
					'JenisAktaId'	=> $jenisAktaId,
					'NPWP' 			=> $npwp,
					'Deskripsi'		=> $deskripsi,
					'AktaStatusId'	=> $aktatStatusId,
					'NoSK'			=> $noSK,
					'TglAkta'		=> $tglAkta,
					'Harga'			=> $harga,
					'SudahBayar'	=> $sudahBayar
				);
				
				if(in_array($fileExtn, $tipeFile)) {
					uploadAkta($fileTmp, $fileExtn, $row['KdTransaksi']);
				}
				
				if(ubahData('UserAktaTransaction', $userAktaTransaction,  'Id', $id)) {	

					

					if((int)$harga == (int)$sudahBayar){
						mysql_query("UPDATE UserAktaTransaction SET Keterangan='LUNAS', SisaTagihan=0 WHERE Id={$id}");
					} else {
						mysql_query("UPDATE UserAktaTransaction SET Keterangan='BELUM LUNAS', SisaTagihan={(int)$harga-(int)$sudahBayar} WHERE Id={$id}");
					}
					header('Location: '.$_SERVER['REQUEST_URI']);

					$alert[] = "Pengajuan Akta berhasil di update! <a href='pengajuanSaya.php'> Lihat Status</a>";
					email($userData['Email'], 'Pengajuan Akta '.$appName.' - ' . $row['KdTransaksi'], "Dear {$userData['NamaLengkap']}, \n\nTerimakasih telah melakukan pengajuan Transaksi Akta. Anda bisa melacak status pengajuan dengan kode transaksi pengajuan anda: {$row['KdTransaksi']}\n<a href='ppat.qmuaji.com/pengajuanSaya.php'> Lihat Status</a>\n\n ~".$appName);
				} else {
					$alert[] = "Pengajuan Akta gagal di update! <i class='icon fa-frown-o'></i>";
				}	
			}
		}
	} 

	include 'includes/_header.php';
	if(!empty($alert)) echo outputErrors($alert);
	?>
	<section id="main" class="container">				
		<div class="row">			
			<div class="col-12">
				<section class="box">
					<h3>Formulir Pengajuan Akta #<?=$row['KdTransaksi']?></h3>
					<form action="" method="post" autocomplete="off" enctype="multipart/form-data">			
						<div class="row">
							<div class="col-6 col-12-mobilep">
								No KTP*
								<input type="text" value="<?= $row['NIK'] ?>" disabled minlength="7" maxlength="20">
								Nama Lengkap*
								<input type="text" value="<?= $row['NamaLengkap'] ?>" disabled minlength="3" maxlength="20">
								No telepon* 
								<input type="text" value="<?= $row['NoTlp'] ?>" disabled maxlength="20">
								Tempat Lahir
								<input type="text" disabled value="<?= $row['TmptLahir'] ?>">
								Tanggal Lahir*
								<?php 
								$tglLahir = $row['TglLahir'];
								($tglLahir=="0000-00-00") ? $tglLahir= "-" : $tglLahir = date('Y-m-d', strtotime($tglLahir))  ?>
								<input type="Date" max="<?=$ageMax?>" disabled value="<?= $tglLahir ?>">
								Pekerjaan*
								<input type="text" value="<?= $row['Pekerjaan'] ?>" disabled maxlength="20">
							</div>
							<div class="col-6 col-12-mobilep">	
								Jenis Akta*
								<select name="JenisAktaId" required>
									<?php getJenisAkta($jenisAktaId) ?>
								</select>
								NPWP Pribadi/PT*
								<input type="text" name="NPWP" placeholder="NPWP" required maxlength="20" value="<?= $npwp ?>">
								Dokumen Persyaratan : <a href="<?= $row['DocPersyaratan'] ?>" class="icon fa-download"> Download</a><hr>
								Upload Dokumen Akta*
								<input type="file" name="DocAkta" accept="files/*"><br>
								Deskripsi*
								<textarea name="Deskripsi" placeholder="Deskripsi" rows="4" maxlength="225" required><?= $deskripsi ?></textarea>
							</div>
							<div class="col-6 col-12-mobilep">	
								Status Akta
								<select name="AktaStatusId" required>
									<?php getAktaStatus($aktatStatusId) ?>
								</select>
								Tanggal Akta
								<input type="date" name="TglAkta" placeholder="NPWP" maxlength="20" value="<?= $tglAkta ?>">
								No. SK/SP
								<input type="text" name="NoSK" placeholder="No. SK/SP" maxlength="20" value="<?= $noSK ?>">
								Harga (Rp.)
								<input type="text" name="Harga" placeholder="Harga (Rp.)" maxlength="20" value="<?= $harga ?>">
								Sudah Bayar (Rp.)
								<input type="text" name="SudahBayar" placeholder="Sudah Bayar (Rp.)" maxlength="20" value="<?= $sudahBayar ?>">
								Metode Bayar
								<input type="text" name="MetodeBayar" value="<?= $row['MetodeBayar'] ?>" disabled>
								Keterangan
								<input type="text" name="Keterangan" value="<?= $row['Keterangan'] ?>" disabled>
							</div>
						</div>		
						<input type="submit" value="Update Pengajuan Akta" class="special fit" onclick="return confirm('Update Pengajuan Akta?')">		
					</form>
				</section>		
			</div>
		</div>
	</section>
<?php 
};
include 'includes/_footer.php';