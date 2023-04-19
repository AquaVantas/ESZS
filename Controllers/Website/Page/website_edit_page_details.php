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
	$page_published = $_POST['page_published'];
	if($page_published == "true") {
		$page_published = 1;
	}
	else {
		$page_published = 0;
	}

	$page_title = $_POST['page_title'];
	$meta_name = $_POST['meta_name'];
	$meta_description = $_POST['meta_description'];
	$meta_keyword = $_POST['meta_keyword'];

	//edits language in the database
	if($page_id != NULL) {
		website::updateWebsitePageDetails($page_id, $lang_id, $page_published, $page_title, $meta_name, $meta_description, $meta_keyword);
	}

	//redirect back to language list
	header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $lang_id);
?>