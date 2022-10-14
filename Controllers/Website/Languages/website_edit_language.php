<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_POST['lang_id']) || !isset($_GET['lang_id'])) {
		header('url=../cpanel.php?tab=webpage_editor&action=language_editor');
	}

	$lang_id = $_GET['lang_id'];
	$title = $_POST['title'];
	$short = $_POST['short'];

	//edits language in the database
	if($_POST['title'] != NULL) {
		website::updateWebsiteLanguage($lang_id, $title, $short);
	}

	//redirect back to language list
	header('Location:../../../cpanel.php?tab=webpage_editor&action=language_editor');
?>