<?php

function getJenisAkta($kode) {

	echo "<option value='' >- Pilih -</option>";
	$query = mysql_query("SELECT Id, JenisAkta FROM JenisAkta");

	while ($row = mysql_fetch_row($query)) {

		if ($kode == ""){
			echo "<option value='$row[0]'> " . ucwords($row[1]) . " </option>";
		}else{
			echo "<option value='$row[0]'" . selected($row[0], $kode) . "> " . ucwords($row[1]) . " </option>";
		}
	}
}

function getAktaStatus($kode) {

	echo "<option value='' >- Pilih -</option>";
	$query = mysql_query("SELECT Id, Status FROM AktaStatus");

	while ($row = mysql_fetch_row($query)) {

		if ($kode == ""){
			echo "<option value='$row[0]'> " . ucwords($row[1]) . " </option>";
		}else{
			echo "<option value='$row[0]'" . selected($row[0], $kode) . "> " . ucwords($row[1]) . " </option>";
		}
	}
}

function selected($t1, $t2) {

	if(trim($t1) == trim($t2)) return "selected";
	else return "";

}

function getNota(){
	$unik = 'RISKYMUAJISETYAPRANA18101993';
	$i = 0;
	$code="";
	while ($i < 4) { 
	$code .= substr($unik, mt_rand(0, strlen($unik)-1), 1);
	$i++;
	}
	$date 	= date('dmy');
	$nota  = $code.$date;
	return $nota;
}

function hapusData($table, $key,$id) {
	return (mysql_query("DELETE FROM $table WHERE $key=$id")) ? true : false;
}

function nameExist($table, $name) {
	$name = sanitize($name);
	return (mysql_result(mysql_query("SELECT COUNT(*) FROM $table WHERE name='$name'"), 0) == 1) ? true : false;
}

function ubahData($table, $ubahData, $key, $id) {
	$update = array();
	array_walk($ubahData, 'arraySanitize');

	foreach ($ubahData as $field=>$data) {
		$update[] = "{$field}='{$data}'";
	}
	$fields = implode(', ', $update);
	return (mysql_query("UPDATE $table SET $fields WHERE $key=$id")) ? true : false;
}

function tambahData($tambahData, $table) {
	$fields = implode(', ', array_keys($tambahData));
	$data 	= '\''. implode('\', \'', $tambahData) .'\'';
	return (mysql_query("INSERT INTO $table ($fields) VALUES ($data)")) ? true : false;
}

function adminProtect() {
	if(!(hasAccess($_SESSION['user_id'], 2) || hasAccess($_SESSION['user_id'], 3))){
		header("Location: ../");
		exit();
	}
}

function rupiah($angka) {
    return number_format($angka,0,',','.');
}

function email($to, $subject, $isi) {
	mail($to, $subject, $isi, "From: admin@{$GLOBALS['host']}");
}

function loggedInRedirect() {
	if(loggedIn()) header("Location: ../");
}

function protectPage() {
	if(!loggedIn()) header("Location: ../login.php");
}

function arraySanitize(&$item){
	$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function sanitize($data) {
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

function outputErrors($errors) {
	$output = array();
	foreach ($errors as $error) {
		$output[] = "<div class='alert'><h5><b>". $error .'</b></h5></div>';
	}
	return implode('', $output);
}

function updateUser2($updateData, $id) {
	$update = array();
	array_walk($updateData, 'arraySanitize');

	foreach ($updateData as $field=>$data) {
		$update[] = "{$field}='{$data}'";
	}
	$userData = implode(', ', $update);
	$user_id = (int)$_SESSION['user_id'];
	return (mysql_query("UPDATE User SET $userData WHERE Id=$id")) ? true : false;
}