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

	if(isset($_GET['button_type'])) {
		if($_GET['button_type'] == 'block_content') {
			website::addWebsiteButtonLink();
			foreach(website::getWebsiteLastButtonLinkID() as $last_button_link) {
				$last = $last_button_link['max_button_link_id'];
			}			
			$last_sequence_num = 1;
			foreach(website::getWebsiteBlockContentButtonSequenceNum($_GET['block_content_id']) as $sequence_num) {
				if($sequence_num['max_sequence_num'] != NULL) {
					$last_sequence_num = $sequence_num['max_sequence_num'] + 1;
					echo $last_sequence_num;
				}
			}
			website::addWebsiteButton(NULL, NULL, $last_sequence_num, $_GET['block_content_id'], $last);
		}
		//TO-DO: add the rest
	}
		
	//redirect back to language list

	if(isset($_GET['lang_id'])) {		
		header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $_GET['lang_id']);
	}
	else {
		header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id']);
	}
?>