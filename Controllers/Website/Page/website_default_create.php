<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['lang_id'])) {			
		header('url=../../../cpanel.php?tab=webpage_editor');
	}

	website::addWebsiteDefault($_GET['lang_id'], NULL, NULL, NULL, NULL, NULL);
	
	//redirect back to language list

	header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_header_footer&lang_id=' . $_GET['lang_id']);
?>