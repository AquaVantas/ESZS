<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['page_id'])) {
		if(!isset($_GET['lang_id'])) {			
			header('url=../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id='.$_GET['page_id']);
		}
		else {
			header('url=../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id='.$_GET['page_id'].'&lang_id='.$_GET['lang_id']);
		}
	}		

	//change the sequence numbers if button wasn't last on list
	if(isset($_GET['page_id']) && isset($_GET['lang_id'])) {
		if(count(website::getAllWebsitePageSubpages($_GET['page_id'])) > 0) {
			findWebsiteSubpages($_GET['page_id']);
		}
		foreach(website::getAllWebsiteLanguages() as $lang) {
			deleteWebsiteSubpages($_GET['page_id'], $lang['language_id']);
		}
	}

	function findWebsiteSubpages($page_id) {
		foreach(website::getAllWebsitePageSubpages($page_id) as $subpage) {
			if(count(website::getAllWebsitePageSubpages($subpage['page_id'])) > 0) {
				findWebsiteSubpages($subpage['page_id']);
			}
			else {
				foreach(website::getAllWebsiteLanguages() as $lang) {
					deleteWebsiteSubpages($subpage['page_id'], $lang['language_id']);
				}
			}
		}
	}

	function deleteWebsiteSubpages($page_id, $lang_id) {
		foreach(website::getSpecificWebsitePageDetails($page_id, $lang_id) as $page_details) {
			foreach(website::getWebsiteSections($page_details['page_detail_id']) as $section) {
				if($section['variant_id'] == 1) {
					foreach(website::getWebsiteSectionBlocks($section['section_id']) as $section_block) {
						foreach(website::getWebsiteBlockContent($section_block['WSB_section_block_id']) as $blockContent) {
							foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {
								website::deleteWebsiteButton($button['WBCB_button_id']);
							}
							website::deleteWebsiteBlockContent($blockContent['WBC_block_content_id']);
						}

						foreach(website::getWebsiteSectionDeletedSequenceNumber($_GET['section_id']) as $deletedSequence) {
							$deletedSequenceNumber = $deletedSequence['WS_sequence_num'];
						}

						foreach(website::getSpecificWebsitePageDetails($_GET['page_id'], $lang_id) as $page_details) {
							$page_detail_id = $page_details['page_detail_id'];
						}

						foreach(website::getWebsiteSectionAfterDeleted($page_detail_id, $deletedSequenceNumber) as $fix_button) {
							website::updateWebsiteSectionSequenceNum($fix_button['WS_section_id']);
						}

						website::deleteWebsiteSection($section['section_id']);
						website::deleteWebsiteSectionBlock($section['section_id']);
					}
				}
				else if($section['variant_id'] == 2) {
					website::deleteWebsiteSection($section['section_id']);
					website::deleteWebsiteSectionForm($section['section_id']);
				}
			}
			website::deleteSpecificWebsitePageDetails($page_id, $lang_id);
			website::deleteSpecificWebsitePage($page_id);
		}
	}
			
	//redirect back to language list

	if(isset($_GET['lang_id'])) {		
		header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $_GET['lang_id']);
	}
	else {
		header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id']);
	}
?>