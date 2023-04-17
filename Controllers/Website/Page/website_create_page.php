<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	

	if(isset($_GET['lang_id'])) {
		$lang_id = $_GET['lang_id'];
	} else {
		$lang_id = 1;
	}

	if(isset($_GET['parent_page_id'])) {
		$parent = $_GET['parent_page_id'];
	}
	else {
		$parent = NULL;
	}

	//edits language in the database
	website::addWebsitePage($parent);

	//redirect back to language list
	header('Location:../../../cpanel.php?tab=webpage_editor&lang_id=' . $lang_id);
?>