<?php
	require_once("../../Internal/editors_database.php");

	if(!isset($_POST['name']) || !isset($_GET['user'])) {
		header("url=../../cpanel.php?tab=user_list_create");
	}

	$admin_id = $_GET['user'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$email = $_POST['email'];
	
	editors::updateAdmin($admin_id, $name, $surname, $email);

	header("Location:../../cpanel.php?tab=user_list");
?>