<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['page_id']) || !isset($_GET['section_id'])) {
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

	$section_id = $_GET['section_id'];
	$section_name = $_POST['section-name'];
	$block_template_id = $_POST['section-template'];
	$section_class = $_POST['section-class'];
	$block_header = $_POST['section-header'];
	$block_subheader = $_POST['section-subheader'];
	$block_rich_text = $_POST['section-rich-text'];

	//edits language in the database
	if($section_id != NULL) {
		website::updateWebsiteSectionBlock($section_id, $section_name, $block_template_id, $section_class, $block_header, $block_subheader, $block_rich_text);
	}

	//redirect back to language list
	header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $lang_id);
?>