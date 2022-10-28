<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['page_id'])) {
		if(!isset($_GET['lang_id'])) {			
			header('url=../../../cpanel.php?tab=webpage_editor');
		}
		else {
			header('url=../../../cpanel.php?tab=webpage_editor&lang_id='.$_GET['lang_id']);
		}
	}

	if(isset($_GET['lang_id'])) {
		$lang_id = $_GET['lang_id'];
	} else {
		$lang_id = 1;
	}

	$page_id = $_GET['page_id'];

	//edits language in the database
	if($page_id != NULL) {
		website::automaticallyAddWebsitePageDetailsForCurrentLanguage($page_id, $lang_id);
	}

	//redirect back to language list
	header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $lang_id);
?>