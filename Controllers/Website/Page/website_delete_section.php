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
	if(isset($_GET['block_content_id']) && $_GET['section_id']) {
		foreach(website::getWebsiteBlockContentButton($_GET['block_content_id']) as $button) {
			//website::deleteWebsiteButton($button['WBCB_button_id']);
		}

		foreach(website::getWebsiteBlockContentDeletedSequenceNumber($_GET['block_content_id']) as $deletedSequence) {
			$deletedSequenceNumber = $deletedSequence['WBC_sequence_num'];
		}

		foreach(website::getWebsiteBlockContentAfterDeleted($_GET['section_id'], $deletedSequenceNumber) as $fix_button) {
			//website::updateWebsiteBlockContentSequenceNum($fix_button['WBC_block_content_id']);
		}

		//website::deleteWebsiteBlockContent($_GET['block_content_id']);
	}	
		
	//redirect back to language list

	if(isset($_GET['lang_id'])) {		
		//header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $_GET['lang_id']);
	}
	else {
		//header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id']);
	}
?>