<?php
	
	//gets the database we'll be working with
	require_once("../../Internal/editors_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['user'])) {
		header('url=../../cpanel.php?tab=user_list_create');
	}

	$user_id = $_GET['user'];

	//delete roles from soon-to-be deleted user
	editors::deleteAdminRoles($user_id);

	//delete user
	editors::deleteUser($user_id);

	header('Location:../../cpanel.php?tab=user_list');
?>