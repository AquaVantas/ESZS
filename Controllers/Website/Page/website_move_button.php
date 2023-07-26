<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['button_id']) || !isset($_GET['move_direction'])) {
		if(!isset($_GET['lang_id'])) {			
			header('url=../../../cpanel.php?tab=webpage_editor');
		}
		else {
			header('url=../../../cpanel.php?tab=webpage_editor&lang_id='.$_GET['lang_id']);
		}
	}

	echo $_GET['button_id'];
	if($_GET['move_direction'] == "up") {
		if(isset($_GET['block_content_id'])) {
			foreach(website::getWebsiteBlockContentButtonSequenceNumMin($_GET['block_content_id']) as $min_seq) {
				$min_sequence_num = $min_seq['min_sequence_num'];
			}
			foreach(website::getWebsiteButtonByID($_GET['button_id']) as $button) {
				if($button['WBCB_sequence_num'] != $min_seq) {

				}
			}
		}
		else {

		}
	}
	else if($_GET['move_direction'] == "down") {
		if(isset($_GET['block_content_id'])) {			
			foreach(website::getWebsiteBlockContentButtonSequenceNum($_GET['block_content_id']) as $max_seq) {
				$max_sequence_num = $max_seq['max_sequence_num'];
			}
		}
		else {

		}
	}

	//redirect back to language list
	//header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $lang_id);
?>