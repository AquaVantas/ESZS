<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_POST['title'])) {
		header('url=../../../cpanel.php?tab=webpage_editor&action=language_add');
	}

	$title = $_POST['title'];
	$short = $_POST['short'];

	//adds language into the database
	if($_POST['title'] != NULL) {
		website::addWebsiteLanguage($title, $short);
	}

	//redirect back to user list
	header('Location:../../../cpanel.php?tab=webpage_editor&action=language_editor');
?>