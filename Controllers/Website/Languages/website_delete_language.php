<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['lang_id'])) {
		header('url=../../../cpanel.php?tab=webpage_editor&action=language_editor');
	}

	$lang_id = $_GET['lang_id'];

	//adds language into the database
	if($_GET['lang_id'] != NULL) {
		website::deleteWebsiteLanguage($lang_id);
	}

	//redirect back to user list
	header('Location:../../../cpanel.php?tab=webpage_editor&action=language_editor');
?>	