<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['section_block_id'])) {
		if(!isset($_GET['lang_id'])) {			
			header('url=../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id='.$_GET['page_id']);
		}
		else {
			header('url=../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id='.$_GET['page_id'].'&lang_id='.$_GET['lang_id']);
		}
	}

	$section_block_id = $_GET['section_block_id'];
	
	$last_sequence = 1;
	foreach(website::getWebsiteBlockSectionLastBlockContent($section_block_id) as $blockContent) {
		if($blockContent['sequence_num'] != NULL) {
			$last_sequence = $blockContent['sequence_num'] + 1;
		}
	}
	website::addWebsiteBlockContent($last_sequence, $section_block_id);
	
	//redirect back to language list

	if(isset($_GET['lang_id'])) {		
		header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $_GET['lang_id']);
	}
	else {
		header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id']);
	}
?>