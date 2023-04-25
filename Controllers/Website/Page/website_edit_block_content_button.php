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

	$button_id = $_POST['button-id'];
	$button_image = $_POST['button-image'];
	$button_heading = $_POST['button-heading'];
	$button_link = $_POST['button-link'];
	$button_anchor = $_POST['button-anchor'];
	$button_link_heading = $_POST['button-link-heading'];
	$button_page_link = $_POST['button-page-link'];
	$button_target = $_POST['button-target'];
	if($button_target == "true") {
		$button_target = 1;
	}
	else {
		$button_target = 0;
	}	

	//edits language in the database
	if($button_id != NULL) {
		website::updateWebsiteBlockContentButton($button_id, $button_heading, $button_image);
		website::updateWebsiteBlockContentButtonLink($button_id, $button_link, $button_anchor, $button_link_heading, $button_target, $button_page_link);
	}

	//redirect back to language list
	//header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $lang_id);
?>