<?php 

session_start();
error_reporting(E_ALL);
// error_reporting(0); // disable error
date_default_timezone_set("Asia/Bangkok");

$appName = "Notaris PPAT Rian Erza"; //Variable super GLOBAL 
$host	 = "ppat.qmuaji.com.test"; //Variable super GLOBAL

require 'dbConnect.php';
require 'functions/general.php';
require 'functions/users.php';

if(loggedIn()) {
	$userData   = userData($_SESSION['user_id'], 'Id', 'Email', 'Password', 'Username', 'NamaLengkap', 'NoTlp', 'Alamat', 'Img', 'UserRoleId', 'TmptLahir', 'TglLahir', 'NIK', 'Pekerjaan');

	if(!userActive($userData['Email'])) {
		session_destroy();
		header('Location: logout.php');
		exit();
	}
}

$alert = array();
$currentFile = explode('/', $_SERVER['SCRIPT_NAME']);
$currentFile = end($currentFile);
$ageMax = date('Y-m-d', strtotime("-6000 days"));
$dateMin 	 = date('Y-m-d');