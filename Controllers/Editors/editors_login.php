<?php
	session_start();
	//gets the database we'll be working with
	require_once("../../Internal/editors_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_POST['email'])) {
		header('url=../../cpanel.php');
	}

	$email = $_POST['email'];
	$password = $_POST['password'];

	//search database and login
	foreach(editors::getAllAdmins() as $admin) {

		if($email == $admin['email']) {
			$krneki = password_verify($password, $admin['password']);
			if($krneki == 1) {
				$_SESSION['user'] = $admin['admin_id'];
			}
		}
	}

	//redirect back to user list
	header('Location:../../cpanel.php');
?>