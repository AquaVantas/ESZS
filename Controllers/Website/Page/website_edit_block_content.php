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

	$block_content_id = $_POST['block-content-id'];
	$sequence_num = $_POST['sequence-num'];
	//$image_id = $_POST['image-id'];
	$image_id = NULL;
	$block_link = $_POST['block-content-link'];
	$block_heading = $_POST['block-content-heading'];
	$block_subheading = $_POST['block-content-subheading'];
	$block_text = $_POST['block-content-text'];

	//edits language in the database
	if($block_content_id != NULL) {
		website::updateWebsiteBlockContent($block_content_id, $sequence_num, $image_id, $block_link, $block_heading, $block_subheading, $block_text);
	}

	//redirect back to language list
	header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $lang_id);
?>