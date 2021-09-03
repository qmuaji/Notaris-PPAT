<?php
require 'core/init.php';
protectPage();

$nik 	 		= $userData['NIK'];
$namaLengkap 	= $userData['NamaLengkap'];
$tmptLahir 	 	= $userData['TmptLahir'];
$tglLahir 	 	= $userData['TglLahir'];
$pekerjaan 	 	= $userData['Pekerjaan'];
$alamat 		= $userData['Alamat'];
$noTlp 			= $userData['NoTlp'];
$deskripsi 		= '';

if(!empty($_POST)) {
	$tipeFile = array('pdf', 'docs');
	$fileName = $_FILES['DocumentFile']['name'];
	$fileExtn = strtolower(end(explode('.', $fileName)));
	$fileTmp  = $_FILES['DocumentFile']['tmp_name'];

	$requiredFields = array('JenisAkta', 'DocumentFile', 'Deskripsi');

	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $requiredFields)){
			$alert[] = "Silahkan isi bagian yang ditandai * <i class='icon fa-smile-o'></i>";
			break 1;
		}
	}

	if(!in_array($fileExtn, $tipeFile)) {		
		$alert[] = "Tipe file yang di perbolehkan: ", implode(', ', $tipeFile);
	}

	if(empty($alert)) {
		$jenisAkta 		= trim($_POST['JenisAktaId']);
		$aktaId 		= trim($_POST['AktaId']);
		$deskripsi 		= trim($_POST['Deskripsi']);


		if(empty($_FILES['DocumentFile']['name'])){
			echo "Silakan pilih Dokumen PDF!";
		} 


		if(empty($alert)) {
			$userAktaTransaction = array(
				'TglTransaksi'	=> $tglTransaksi,
				'KdTransaksi'	=> $kdTransaksi,
				'AktaId'	=> $aktaId,
				'UserId' 	=> $_SESSION['id'],
				'Deskripsi'	=> $deskripsi
			);
		
			if(tambahData($userAktaTransaction, 'UserAktaTraksaction') && uploadDocumentFile($user_id, $fileTmp, $fileExtn)) {				
				$alert[] = "Informasi akun berhasil di simpan <i class='icon fa-smile-o'></i>";
			} else {
				$alert[] = "Informasi akun gagal di simpan! <i class='icon fa-frown-o'></i>";
			}	
		}
	}
} 

include 'includes/_header.php';
if(!empty($alert)) echo outputErrors($alert);
?>
<div style="margin-top:-30px" id="main" class="container">				
	<div class="row">
			
		<div class="12u 12u(mobile)">
			<div class="box">
				<h3>Formulir Transaki Akta</h3>
				<form action="" method="post" autocomplete="off" enctype="multipart/form-data">			
					<div class="row">
						<div class="6u 12u">	
							NIK*
							<input type="text" name="NIK" value="<?= $nik ?>" disabled minlength="3" maxlength="32">
							Nama Lengkap*
							<input type="text" name="NamaLengkap" value="<?= $namaLengkap ?>" disabled minlength="3" maxlength="32">
							No telepon* 
							<input type="text" name="NoTlp" value="<?= $noTlp ?>" disabled maxlength="20">
							Tempat Lahir
							<input type="text" name="TmptLahir" value="<?= $tmptLahir ?>">

							Tanggal Lahir*
							<?php ($tglLahir=="0000-00-00") ? $tglLahir= "-" : $tglLahir = date('Y-m-d', strtotime($tglLahir))  ?>

							<input type="Date" name="TglLahir" max="<?=$ageMax?>" disabled value="<?= $tglLahir ?>">
							Pekerjaan*
							<input type="text" name="Pekerjaan" value="<?= $pekerjaan ?>" disabled maxlength="20">
						</div>	

						<div class="6u 12u">	
							</select>
							Jenis Akta*
							<select name="JenisAkta" required>
								<?php getJenisAkta() ?>
							</select>
							<blockquote>
								<h6>*Mohon isi data diri sesuai KTP</h6>
								<h6>*Persyaratan pembuatan Akta format PDF dalam 1 File </h6>

							</blockquote>
							Dokumen Persyaratan*
							<input type="file" name="DocumentFile" accept="files/*"><br>
							Deskripsi*
							<textarea name="Deskripsi" placeholder="Alamat" cols="30" rows="6" maxlength="225" required=""><?= $deskripsi ?></textarea>


							<input type="submit" value="Simpan" class="fit special">				
						</div>
					</div>		
				</form>
			</div>		
		</div>
	</div>
</div>

<?php include 'includes/_footer.php';