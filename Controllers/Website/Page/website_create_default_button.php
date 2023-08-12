<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['default_table'])) {
		if(!isset($_GET['lang_id'])) {			
			header('url=../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id='.$_GET['page_id']);
		}
		else {
			header('url=../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id='.$_GET['page_id'].'&lang_id='.$_GET['lang_id']);
		}
	}

	if(isset($_GET['default_table'])) {
		website::addWebsiteButtonLink();
		foreach(website::getWebsiteLastButtonLinkID() as $last_button_link) {
			$last = $last_button_link['max_button_link_id'];
		}
		$last_sequence_num = 1;
		
		if($_GET['default_table'] == "socials") {
			foreach(website::getWebsiteFooterSocialsMaxSequenceNumber(intval($_GET['lang_id'])) as $sequence_num) {
				if($sequence_num['max_sequence_num'] != NULL) {
					$last_sequence_num = $sequence_num['max_sequence_num'] + 1;
				}
			}
			website::addWebsiteFooterSocials($_GET['lang_id'], $last, $last_sequence_num);
		}
		else if($_GET['default_table'] == "images") {
			foreach(website::getWebsiteFooterImagesMaxSequenceNumber(intval($_GET['lang_id'])) as $sequence_num) {
				if($sequence_num['max_sequence_num'] != NULL) {
					$last_sequence_num = $sequence_num['max_sequence_num'] + 1;
				}
			}
			website::addWebsiteFooterImages($_GET['lang_id'], $last, $last_sequence_num);
		}
		else if($_GET['default_table'] == "links") {
			foreach(website::getWebsiteFooterLinksMaxSequenceNumber(intval($_GET['lang_id'])) as $sequence_num) {
				if($sequence_num['max_sequence_num'] != NULL) {
					$last_sequence_num = $sequence_num['max_sequence_num'] + 1;
				}
			}
			website::addWebsiteFooterLinks($_GET['lang_id'], $last, $last_sequence_num);
		}

		website::addWebsiteButton(NULL, NULL, NULL, NULL, $last);		
	}
		
	//redirect back to language list

	if(isset($_GET['lang_id'])) {		
		header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_header_footer&lang_id=' . $_GET['lang_id']);
	}
	else {
		header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_header_footer&lang_id=1');
	}
?>