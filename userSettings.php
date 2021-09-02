<?php
require 'core/init.php';
protectPage();

$email 			= $userData['Email'];
$namaLengkap 	= $userData['NamaLengkap'];
$noTlp 			= $userData['NoTlp'];
$username 		= $userData['Username'];
$alamat 		= $userData['Alamat'];
$nik 	 		= $userData['NIK'];
$tmptLahir 	 	= $userData['TmptLahir'];
$tlgLahir 	 	= $userData['TglLahir'];
$pekerjaan 	 	= $userData['Pekerjaan'];

if(!empty($_POST)) {
	$requiredFields = array('email', 'username', 'first_name', 'tlp');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $requiredFields)){
			$alert[] = "Silahkan isi bagian yang ditandai * <i class='icon fa-smile-o'></i>";
			break 1;
		}
	}

	if(empty($alert)) {
		$username 		= trim($_POST['Username']);
		$namaLengkap 	= trim($_POST['NamaLengkap']);
		$noTlp 			= trim($_POST['NoTlp']);
		$alamat 		= trim($_POST['Alamat']);
		$alamat 		= trim($_POST['Alamat']);
		$nik 			= trim($_POST['NIK']);
		$tmptLahir 		= trim($_POST['TmptLahir']);
		$TglLahir 		= trim($_POST['TglLahir']);
		$pekerjaan 		= trim($_POST['Pekerjaan']);
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) < 6 || strlen($email) > 50) {
			$alert[] = "Oops.. Email tidak valid!";
		} elseif(emailExists($email) && $email !== $userData['email']) {
			$alert[] = "Maaf, email '{$email}' sudah digunakan.";
		} elseif(strlen($username) < 3 || strlen($username) > 16) {
			$alert[] = "Username minimal 3 dan maksimal 16 karakter";
		} elseif(preg_match("/[^a-zA-Z|0-9]/", $username)) {	
			$alert[] = "Username hanya huruf, angka dan tidak memakai spasi!";
		} elseif(usernameExists($username) && $username !== $userData['username']) {
			$alert[] = "Maaf, username '{$username}'' sudah di gunakan.";
		} elseif(!preg_match("/^[a-zA-Z ]*$/", $namaLengkap)) {
			$alert[] = "Nama Lengkap hanya huruf dan spasi!";
		} elseif(strlen($namaLengkap) < 5 || strlen($namaLengkap) > 50) {
			$alert[] = "Nama Lengkap minimal 5 dan maksimal 50 karakter.";
		} elseif(strlen($alamat) > 225) {
			$alert[] = "Alamat maksimal 225 karakter.";
		} elseif(strlen($noTlp) > 16 || strlen($noTlp) < 6 || !is_numeric($noTlp)) {
			$alert[] = "No. tlp tidak valid!";
		} else {

			if(empty($errors)) {
				$updateData = array(
					'Username' 	=> strtolower($username),
					'NamaLengkap'=> ucwords(strtolower($namaLengkap)),
					'NIK' 		=> $nik,
					'NoTlp'		=> $noTlp,
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
} 

include 'includes/_header.php';
if(!empty($alert)) echo outputErrors($alert);
?>
<div style="margin-top:-30px" id="main" class="container">				
	<div class="row">
		<div class="4u 12u(mobile)">
			<div class="box	">							
				<ul class="alt">
					<li><h4><a href="userSettings.php" class="icon fa-user"> <b>Informasi Akun</b></a></h4></li>					
					<?php 
					if (hasAccess($_SESSION['user_id'], 0)){
						?>
					<li><h4><a href="saldo.php" class="icon fa-money">&nbsp; Isi Saldo</a></h4></li>
					<li><h4><a href="konfirmasi.php" class="icon fa-check"> Konfirmasi Bayar</a></h4></li>
						<?php
					}
					 ?>
					<li><h4><a href="gantiPass.php" class="icon fa-lock"> Ganti Password</a></h4></li>
				</ul>
			</div>						
		</div>
			
		<div class="8u 12u(mobile)">
			<div class="box">
				<h3>Informasi Akun</h3>
				<form action="" method="post" autocomplete="off">			
					<div class="row">
						<div class="6u 12u">	
							NIK*
							<input type="text" name="NIK" placeholder="NIK" value="<?php echo $nik ?>" required minlength="3" maxlength="32">
							Nama Lengkap*
							<input type="text" name="NamaLengkap" placeholder="Nama Lengkap" value="<?php echo $namaLengkap ?>" required minlength="3" maxlength="32">
							No telepon* 
							<input type="text" name="NoTlp" placeholder="Telepon"  value="<?php echo $noTlp ?>" maxlength="20">
							Tempat Lahir
							<input type="text" name="TmptLahir" placeholder="Tempat lahir"  value="<?php echo $tmptLahir ?>">
							Tanggal Lahir* 
							<input type="Date" name="TlgLahir" placeholder="Tanggal Lahir"  value="<?php echo $tlgLahir ?>" maxlength="20">
							Pekerjaan
							<input type="text" name="TlgLahir" placeholder="Pekerjaan"  value="<?php echo $pekerjaan ?>" maxlength="20">
						</div>	
						<div class="6u 12u">	
							Email
							<input type="email" name="Email" placeholder="Email" value="<?php echo $email ?>" required maxlength="50" disabled>
							Username* &nbsp;<b class="icon fa-user"></b>		
							<input type="text" name="Username" placeholder="Username" value="<?php echo $username ?>" required maxlength="16">
							Alamat 
							<textarea name="Alamat" placeholder="Alamat" cols="30" rows="6" maxlength="225"><?php echo $alamat ?></textarea>
							<input type="submit" value="Simpan" class="fit special">				
						</div>
					</div>		
				</form>
			</div>		
		</div>
	</div>
</div>

<?php include 'includes/_footer.php';