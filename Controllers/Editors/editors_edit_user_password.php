<?php
	
	//gets the database we'll be working with
	require_once("../../Internal/editors_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_POST['password']) || $_GET['user']) {
		header("url=../../cpanel.php?tab=user_list_create");
	}

	$password = $_POST['password'];
	$passwordRepeat = $_POST['password-repeat'];
	$admin_id = $_GET['user'];

	//checks if the passwords match
	if($password != $passwordRepeat) {
		header("Location:../cpanel.php?tab=user_list");
	}

	//encrypts the password and changes it on chosen user
	editors::updateAdminPass($admin_id, password_hash($password, PASSWORD_DEFAULT));
	
	//redirect back to user list
	header("Location:../../cpanel.php?tab=user_list");
?>