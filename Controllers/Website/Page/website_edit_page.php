<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['page_id'])) {
		header('url=../../../cpanel.php?tab=webpage_editor');
	}

	$page_id = $_GET['page_id'];
	$page_title = $_POST['page_title'];

	//edits language in the database
	if($_POST['page_title'] != NULL) {
		website::updateWebsitePage($page_id, $page_title);
	}

	//redirect back to language list
	header('Location:../../../cpanel.php?tab=webpage_editor');
?>