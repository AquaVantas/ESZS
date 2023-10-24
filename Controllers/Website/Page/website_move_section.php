<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['section_id']) || !isset($_GET['move_direction'])) {
		if(!isset($_GET['lang_id'])) {			
			header('url=../../../cpanel.php?tab=webpage_editor');
		}
		else {
			header('url=../../../cpanel.php?tab=webpage_editor&lang_id='.$_GET['lang_id']);
		}
	}

	if($_GET['move_direction'] == "up") {
		if(isset($_GET['page_detail_id'])) {
			foreach(website::getWebsiteSectionSequenceNumMin($_GET['page_detail_id']) as $min_seq) {
				$min_sequence_num = $min_seq['min_sequence_num'];
			}
			foreach(website::getWebsiteSectionByID($_GET['section_id']) as $button) {
				$chosenButtonSequenceNumber = $button['sequence_num'];
				if($button['sequence_num'] != $min_sequence_num) {
					foreach(website::getWebsiteSectionByID($_GET['section_id']) as $chosenButton) {
						foreach(website::getWebsiteSectionPrev($chosenButton['sequence_num'], $_GET['page_detail_id']) as $previousButton) {
							$prev_button = $previousButton['section_id'];
						}
					}
				}
			}
			if(isset($prev_button)) {				
				website::updateWebsiteSectionSequenceNumbers($_GET['section_id'], intval($chosenButtonSequenceNumber) - 1);
				website::updateWebsiteSectionSequenceNumbers($prev_button, intval($chosenButtonSequenceNumber));
			}
		}
	}
	else if($_GET['move_direction'] == "down") {
		if(isset($_GET['page_detail_id'])) {			
			foreach(website::getWebsiteSectionSequenceNumMax($_GET['page_detail_id']) as $max_seq) {
				$max_sequence_num = $max_seq['max_sequence_num'];
			}
			foreach(website::getWebsiteSectionByID($_GET['section_id']) as $button) {
				$chosenButtonSequenceNumber = $button['sequence_num'];
				if($button['sequence_num'] != $max_sequence_num) {
					foreach(website::getWebsiteSectionByID($_GET['section_id']) as $chosenButton) {
						foreach(website::getWebsiteSectionNext($chosenButton['sequence_num'], $_GET['page_detail_id']) as $previousButton) {
							$prev_button = $previousButton['section_id'];
						}
					}
				}
			}
			if(isset($prev_button)) {				
				website::updateWebsiteSectionSequenceNumbers($_GET['section_id'], intval($chosenButtonSequenceNumber) + 1);
				website::updateWebsiteSectionSequenceNumbers($prev_button, intval($chosenButtonSequenceNumber));
			}
		}
	}

	//redirect back to language list
	//header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $_GET['lang_id']);
?>