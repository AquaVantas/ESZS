<?php
	//gets the database we'll be working with
	require_once("../../../Internal/media_database.php");
	require_once("../../../Internal/website_database.php");

	if(!isset($_GET['dir'])) {
		header("url=../../../cpanel.php");
	}

	$folderName = $_GET['folder_name'];
	$targetDir = $_GET['dir'];
	$targetDir = "../../../" . substr($targetDir, strpos($targetDir, "Content")) . "/" . $folderName;

	if(!is_dir($targetDir)) {
		mkdir($targetDir, 0755, true);
	}
?>