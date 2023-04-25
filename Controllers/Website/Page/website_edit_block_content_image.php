<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['button_id'])) {
		if(!isset($_GET['lang_id'])) {			
			header('url=../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id='.$_GET['page_id']);
		}
		else {
			header('url=../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id='.$_GET['page_id'].'&lang_id='.$_GET['lang_id']);
		}
	}
		

	//change the sequence numbers if button wasn't last on list
	if(isset($_GET['block_content_id'])) {
		foreach(website::getWebsiteBlockContentButtonDeletedSequenceNumber($_GET['button_id']) as $deletedSequence) {
			$deletedSequenceNumber = $deletedSequence['WBCB_sequence_num'];
		}

		foreach(website::getWebsiteBlockContentButtonAfterDeleted($_GET['block_content_id'], $deletedSequenceNumber) as $fix_button) {
			website::updateWebsiteBlockContentButtonSequenceNum($fix_button['WBCB_button_id']);
		}

		website::deleteWebsiteButton($_GET['button_id']);
		website::deleteWebsiteButtonLink($_GET['button_id']);
	}
	
		
	//redirect back to language list

	if(isset($_GET['lang_id'])) {		
		header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $_GET['lang_id']);
	}
	else {
		header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id']);
	}
?>