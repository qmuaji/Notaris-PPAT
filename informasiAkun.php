<?php
require 'core/init.php';
protectPage();

$email 	= $userData['Email'];
$namaLengkap 	= $userData['NamaLengkap'];
$noTlp 			= $userData['NoTlp'];
$alamat 		= $userData['Alamat'];
$nik 	 		= $userData['NIK'];
$tmptLahir 	 	= $userData['TmptLahir'];
$tglLahir 	 	= $userData['TglLahir'];
$pekerjaan 	 	= $userData['Pekerjaan'];

if(!empty($_POST)) {
	$requiredFields = array('NIK', 'NamaLengkap', 'Pekerjaan', 'NoTlp', 'Alamat');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $requiredFields)){
			$alert[] = "Silahkan isi bagian yang ditandai * <i class='icon fa-smile-o'></i>";
			break 1;
		}
	}

	if(empty($alert)) {
		$namaLengkap 	= trim($_POST['NamaLengkap']);
		$noTlp 			= trim($_POST['NoTlp']);
		$alamat 		= trim($_POST['Alamat']);
		$nik 			= trim($_POST['NIK']);
		$tmptLahir 		= trim($_POST['TmptLahir']);
		$tglLahir 		= trim($_POST['TglLahir']);
		$pekerjaan 		= trim($_POST['Pekerjaan']);

		// if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) < 6 || strlen($email) > 50) {
		// 	$alert[] = "Oops.. Email tidak valid!";
		// } 
		// if(emailExists($email) && $email !== $userData['Email']) {
		// 	$alert[] = "Maaf, email '{$email}' sudah digunakan.";
		// } 
		// if(strlen($username) < 3 || strlen($username) > 16) {
		// 	$alert[] = "Username minimal 3 dan maksimal 16 karakter";
		// } 
		// if(preg_match("/[^a-zA-Z|0-9]/", $username)) {	
		// 	$alert[] = "Username hanya huruf, angka dan tidak memakai spasi!";
		// } 
		if(nikExists($nik) && $nik !== $userData['NIK']) {
			$alert[] = "Maaf, NIK '{$nik}'' sudah di gunakan.";
		} 
		if(!preg_match("/^[a-zA-Z ]*$/", $namaLengkap)) {
			$alert[] = "Nama Lengkap hanya huruf dan spasi!";
		} 
		if(strlen($namaLengkap) < 5 || strlen($namaLengkap) > 50) {
			$alert[] = "Nama Lengkap minimal 5 dan maksimal 50 karakter.";
		} 
		if(strlen($alamat) > 225) {
			$alert[] = "Alamat maksimal 225 karakter.";
		} 
		if(strlen($noTlp) > 16 || strlen($noTlp) < 6 || !is_numeric($noTlp)) {
			$alert[] = "No. tlp tidak valid!";
		} 
		if(empty($alert)) {
			$updateData = array(
				'NamaLengkap'=> ucwords(strtolower($namaLengkap)),
				'NIK' 		=> $nik,
				'NoTlp'		=> $noTlp,
				'Pekerjaan'	=> $pekerjaan,
				'TmptLahir'	=> $tmptLahir,
				'TglLahir'	=> $tglLahir,
				'Alamat' 	=> $alamat
			);
			if(updateUser($updateData)) {
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
				<h3>Informasi Akun</h3>
				<form action="" method="post" autocomplete="off">			
					<div class="row">
						<div class="6u 12u">	
							No KTP*
							<input type="text" name="NIK" placeholder="NIK" value="<?= $nik ?>" required minlength="7" maxlength="20">
							Nama Lengkap*
							<input type="text" name="NamaLengkap" placeholder="Nama Lengkap" value="<?= $namaLengkap ?>" required minlength="3" maxlength="20">
							No telepon* 
							<input type="text" name="NoTlp" placeholder="Telepon"  value="<?= $noTlp ?>" required maxlength="20">
							Tempat Lahir
							<input type="text" name="TmptLahir" placeholder="Tempat lahir" value="<?= $tmptLahir ?>">

							Tanggal Lahir*
							<?php ($tglLahir=="0000-00-00") ? $tglLahir= "-" : $tglLahir = date('Y-m-d', strtotime($tglLahir))  ?>

							<input type="Date" name="TglLahir" placeholder="Tanggal Lahir" max="<?=$ageMax?>" required value="<?= $tglLahir ?>">
						</div>	
						<div class="6u 12u">	
							Email
							<input type="email" name="Email" placeholder="Email" value="<?= $email ?>" required maxlength="50" disabled>
							Pekerjaan*
							<input type="text" name="Pekerjaan" placeholder="Pekerjaan"  value="<?= $pekerjaan ?>" required maxlength="20">
							Alamat*
							<textarea name="Alamat" placeholder="Alamat" cols="30" rows="6" maxlength="225" required=""><?= $alamat ?></textarea>
							<input type="submit" value="Simpan" class="fit special">				
						</div>
					</div>		
				</form>
				<a href="pengajuanAkta.php" class="button special fit" style="background-color: #1F74C4">Pengajuan Akta</a>
			</div>		
		</div>
	</div>
</div>

<?php include 'includes/_footer.php';