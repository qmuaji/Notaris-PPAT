<?php 
//if(eregi('users.php', $_SERVER['PHP_SELF'])) {
//	header("Location: ./");
//	exit();
//}

function hasAccess($user_id, $role){
	$user_id = (int)$user_id;
	$role 	 = (int)$role;
	
	return (mysql_result(mysql_query("SELECT COUNT(Id) FROM user WHERE Id='$user_id' AND UserRoleId=$role"), 0) == 2) ? true : false;
}


function gantiSampulProfil($user_id, $fileTmp, $fileExtn) {
	$pathFile = sanitize('images/profile/'.substr(date('d_m_y-').(time()), 0). '.' .$fileExtn);
	mysql_query("UPDATE user SET Img='$pathFile' WHERE Id=$user_id");

	move_uploaded_file($fileTmp, $pathFile);
}

function recover($email) {
	$email = sanitize($email);
	$password = substr(str_shuffle('RISKYMUAJISETYAPRANA1893'), 0, 7);
	email($email , "Lupa Password {$GLOBALS['appName']}", "Dear {$email}, \n\nKami telah memulihkan akun kamu di Lan's Rooms Reservaton.\nSilakan login dengan password: {$password}\n\nJangan lupa segera ganti password kamu jika berhasil login.\n\n\n~{$GLOBALS['appName']}");

	return (mysql_query("UPDATE user SET Password=sha1('$password') WHERE Email='$email'")) ? true : false;

}

function updateUser($updateData) {
	$update = array();
	array_walk($updateData, 'arraySanitize');

	foreach ($updateData as $field=>$data) {
		$update[] = "{$field}='{$data}'";
	}
	$userData = implode(', ', $update);
	$user_id = (int)$_SESSION['user_id'];
	return (mysql_query("UPDATE user SET $userData WHERE Id=$user_id")) ? true : false;
}

function activate($email, $email_code) {
	$email 		= sanitize($email);
	$email_code = sanitize($email_code);
	if(mysql_result(mysql_query("SELECT COUNT(Id) FROM user WHERE Email='$email' AND EmailCode='$email_code'"), 0) == 1) {
		mysql_query("UPDATE user SET isActive=1 WHERE Email='$email' AND EmailCode='$email_code'");
		return true;
	} else {
		return false;
	}
}

function gantiPass($user_id, $password) {
	$user_id  = (int)$user_id;
	$password = sha1(sanitize($password));

	return (mysql_query("UPDATE user SET Password='$password' WHERE Id=$user_id")) ? true : false;
}

function registerUser($registerData) {
	$registerData['Password'] = sha1($registerData['Password']);
	$fields = implode(', ', array_keys($registerData));
	$data 	= '\''. implode('\', \'', $registerData) .'\'';
	$url    = "{$GLOBALS['host']}/activate.php?email=". $registerData['Email'] . "&email_code=" . $registerData['EmailCode'];

	email($registerData['Email'], "Aktivasi akun {$GLOBALS['appName']}", "Dear ". $registerData['Email'] . ",\n\nAnda baru saja bergabung untuk menjadi member di {$GLOBALS['appName']}. \nUntuk mengkonfirmasi bahwa email ini adalah email Anda, silakan klik link berikut:\n". $url ."\n\n\nJika Anda merasa tidak pernah mendaftarkan akun di {$GLOBALS['appName']}, mohon abaikan email ini. \n\n\n\n~{$GLOBALS['appName']}");
	return (mysql_query("INSERT INTO user ($fields) VALUES ($data)")) ? true : false;
}

function userData($user_id) {
	$data 	 = array();
	$user_id = (int)$user_id;

	$funcNumArgs = func_num_args();
	$funcGetArgs = func_get_args();

	if($funcNumArgs > 1){
		unset($funcGetArgs[0]);
		$fields = implode(', ', $funcGetArgs);
		$data 	= mysql_fetch_assoc(mysql_query("SELECT $fields FROM user WHERE Id=$user_id"));
	}
	return $data;
}

function loggedIn() {
	return (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) ? true : false;
}

function emailExists($email) {
	$email = sanitize($email);
	return (mysql_result(mysql_query("SELECT COUNT(Id) FROM user WHERE Email='$email'"), 0) == 1) ? true : false;
}

function usernameExists($username) {
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT(Id) FROM user WHERE Username='$username'"), 0) == 1) ? true : false;
}

function userActive($email) {
	return (mysql_result(mysql_query("SELECT COUNT(Id) FROM user WHERE Email='$email' AND IsActive=1"), 0) == 1) ? true : false;
}

function getUserIdFromEmail($email) {
	$email = sanitize($email);
	return mysql_result(mysql_query("SELECT Id FROM user WHERE Email='$email' or Username='$email'"), 0, 'Id');
}

function login($email, $password) {
	$user_id  = getUserIdFromEmail($email);
	$email 	  = sanitize($email);
	$password = sha1($password);
	return (mysql_result(mysql_query("SELECT COUNT(Id) FROM user WHERE Email='$email' AND Password='$password'"), 0) == 1) ? $user_id : false;
}