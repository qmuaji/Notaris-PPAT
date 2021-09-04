<?php
require 'core/init.php';
protectPage();

$npwp='';
if(!empty($_POST)) {
	$tipeFile = array('pdf', 'doc', 'docx');
	$fileName = $_FILES['DocPersyaratan']['name'];
	$extn 	  = explode('.', $fileName);
	$fileExtn = strtolower(end($extn));
	$fileTmp  = $_FILES['DocPersyaratan']['tmp_name'];

	if(!in_array($fileExtn, $tipeFile)) {
		$alert[] = "Tipe file yang di perbolehkan: ". implode(', ', $tipeFile);
	}

	$requiredFields = array('JenisAktaId', 'DocPersyaratan', 'NPWP', 'NIK');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $requiredFields)){
			$alert[] = "Silahkan isi bagian yang ditandai * <i class='icon fa-smile-o'></i>";
			break 1;
		}
	}

	if(empty($alert)) {
		$jenisAktaId 		= trim($_POST['JenisAktaId']);
		$npwp 				= trim($_POST['NPWP']);
		$deskripsi 			= trim($_POST['Deskripsi']);
		$kdTransaksi 		= getNota();

		if(empty($alert)) {
			$userAktaTransaction = array(
				'KdTransaksi'	=> $kdTransaksi,
				'JenisAktaId'	=> $jenisAktaId,
				'PenghadapId' 	=> $userData['Id'],
				'NPWP' 			=> $npwp,
				'NIK' 			=> $userData['NIK'],
				'Deskripsi'		=> $deskripsi
			);

			if(tambahData($userAktaTransaction, 'UserAktaTransaction')) {				
			uploadDocumentFile($userData['Id'], $fileTmp, $fileExtn, $kdTransaksi);
				$alert[] = "Pengajuan Akta berhasil di submit! <a href='pengajuanSaya.php'> Lihat Status</a>";
				$jenisAktaId = '';
				$npwp 		= '';
				$deskripsi 	= '';
			} else {
				$alert[] = "Pengajuan Akta gagal di submit! <i class='icon fa-frown-o'></i>";
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
				<h3>Formulir Pengajuan Akta</h3>
				<form action="" method="post" autocomplete="off" enctype="multipart/form-data">			
					<div class="row gtr-uniform gtr-50">
						<div class="col-6 col-12-mobilep">
							No KTP*
							<input type="text" value="<?= $userData['NIK'] ?>" disabled minlength="7" maxlength="20">
							Nama Lengkap*
							<input type="text" value="<?= $userData['NamaLengkap'] ?>" disabled minlength="3" maxlength="20">
							No telepon* 
							<input type="text" value="<?= $userData['NoTlp'] ?>" disabled maxlength="20">
							Tempat Lahir
							<input type="text" disabled value="<?= $userData['TmptLahir'] ?>">
							Tanggal Lahir*
							<?php 
							$tglLahir = $userData['TglLahir'];
							($tglLahir=="0000-00-00") ? $tglLahir= "-" : $tglLahir = date('Y-m-d', strtotime($tglLahir))  ?>
							<input type="Date" max="<?=$ageMax?>" disabled value="<?= $tglLahir ?>">
							Pekerjaan*
							<input type="text" value="<?= $userData['Pekerjaan'] ?>" disabled maxlength="20">
							<a href="informasiAkun.php" class="button special fit"style="background-color: #1F74C4">Ubah Informasi Akun</a>
						</div>
						<div class="col-6 col-12-mobilep">	
							<blockquote>								
								<ul>
									<li><h5>Mohon isi data diri sesuai KTP</h5></li>
									<li><h5>Persyaratan pembuatan Akta format PDF dalam 1 File </h5></li>
									<li><h5><a href="alurTransaksi.php">Klik untuk meihat Alur Transaksi Akta</a> </h5></li>
									<li><h5><a href="alurTransaksi.php">Klik untuk meihat Persyaratan Pembuatan Akta</a></h5></li>
								</ul>
								</select>
							</blockquote>
							Jenis Akta*
							<select name="JenisAktaId" required>
								<?php getJenisAkta() ?>
							</select>
							NPWP*
							<input type="text" name="NPWP" placeholder="NPWP*" required maxlength="20" value="<?= $npwp ?>">
							Upload Dokumen Persyaratan*
							<input type="file" name="DocPersyaratan" accept="files/*"><br>
							Deskripsi
							<textarea name="Deskripsi" placeholder="Deskripsi" rows="4" maxlength="225"></textarea>
						</div>
					</div>		
					<input type="submit" value="Submit Pengajuan Akta" class="special fit">				
				</form>
			</section>		
		</div>
	</div>
</section>

<?php include 'includes/_footer.php';