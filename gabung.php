<?php 

if(!empty($_POST) ) {
	$email 		= sanitize($_POST['email']);
	$password	= sanitize($_POST['password']);

	if(empty($email) || empty($password)) {
		$alert[] = "Silahkan masukan email dan password kamu!";
	} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) < 6 || strlen($email) > 50) {
		$alert[] = "Oops.. Alamat email tidak valid!";
	} elseif(strlen($password) < 6) {
		$alert[] = "Oops.. Password terlalu pendek! minimal 6 karakter.";
	} elseif(strlen($password) > 64) {
		$alert[] = "Oops.. Password terlalu panjang!";
	} elseif(!emailExists($email)) {

		if(empty($alert) && !empty($_POST)){
			$registerData = array(
				'Email' 	=> $email,
				'Password' 	=> $password,
				'EmailCode'=> sha1($email + microtime())
			);

			if(registerUser($registerData)){
				$alert[] = "Berhasil Daftar. <i class='icon fa-send-o'></i> &nbsp; Periksa email untuk mengaktifkan akun kamu, periksa juga spam folder. <i class='icon fa-smile-o'></i>";
			} else {
				$alert[] = "Sepertinya ada kesalahan, coba lagi lain kali <i class='icon fa-frown-o'></i>";
			}
		}
	} elseif(!userActive($email)) {	
		$alert[] = "Silahkan konfirmasi email terlebih dahulu, periksa juga spam folder.";
	} else {

		$login = login($email, $password);
		if(!$login){
			$alert[] = "Email/Password tidak cocok!";
		} else {
			$_SESSION['user_id'] = $login;

			header("Location: ./");
			exit();
			
		}

	}
}