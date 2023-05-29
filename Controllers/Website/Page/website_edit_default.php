<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['lang_id'])) {			
		header('url=../../../cpanel.php?tab=webpage_editor');
	}

	if(isset($_GET['lang_id'])) {
		$lang_id = $_GET['lang_id'];
	} else {
		$lang_id = 1;
	}

	$website_title = $_POST['website_title'];
	if($_POST['header_logo'] == '') {
	    $header_logo = NULL;
	} else {
	    $header_logo = intval($_POST['header_logo']);
	}
	
	if($_POST['footer_logo'] == '') {
	    $footer_logo = NULL;
	} else {
	    $footer_logo = intval($_POST['footer_logo']);
	}
	$footer_copyright = $_POST['footer_copyright'];
	$footer_about = $_POST['footer_about'];

	//edits language in the database
	if($lang_id != NULL) {
		website::updateWebsiteDefault($lang_id, $header_logo, $footer_logo, $footer_copyright, $footer_about, $website_title);
	}

	//redirect back to language list
	//header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $lang_id);
?>