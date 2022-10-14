<?php
	
	//gets the database we'll be working with
	require_once("../../Internal/editors_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_POST['name'])) {
		header('url=../cpanel.php?tab=user_list_create');
	}

	$name = $_POST['name'];
	echo $name;
	$surname = $_POST['surname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordRepeat = $_POST['password-repeat'];

	//checks if the passwords match
	if($password != $passwordRepeat) {
		header('Location:../../cpanel.php?tab=user_list_create&error=incorrect_password');
	}

	//adds the user to the database and encrypts the password
	if($_POST['name'] != NULL) {
		editors::addAdmin($name, $surname, $email, password_hash($password, PASSWORD_DEFAULT));
	}

	//we'll get the ID of the last added member here
	$lastAddedAdminID = 0;
	
	foreach(editors::getAllAdmins() as $admins) {
		if($admins['admin_id'] > $lastAddedAdminID) {
			$lastAddedAdminID = $admins['admin_id'];
		}
	}

	//adding user roles to the last person added
	foreach(editors::getAdminRoles() as $role) {
		if(isset($_POST[strtolower(str_replace(" ", "_", $role["title"]))])) {
			editors::addRolesToAdmin($lastAddedAdminID, $role['role_id']);
		}		
	}

	//redirect back to user list
	header('Location:../../cpanel.php?tab=user_list');
?>