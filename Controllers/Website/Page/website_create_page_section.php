<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['section_variant'])) {
		if(!isset($_GET['lang_id'])) {			
			header('url=../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id='.$_GET['page_id']);
		}
		else {
			header('url=../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id='.$_GET['page_id'].'&lang_id='.$_GET['lang_id']);
		}
	}

	foreach(website::getSpecificWebsitePageDetails($_GET['page_id'], isset($_GET['lang_id']) ? $_GET['lang_id'] : 1) as $page) {
		$page_detail_id = $page['page_detail_id'];
	}
	$section_variant = $_GET['section_variant'];

	//edits language in the database
	$arrayYes = 0;
	foreach(website::getWebsiteExistingPageSections($page_detail_id, $section_variant) as $max_sequence) {
		if($max_sequence['sequence_num'] != NULL) {
			$sequence_num = $max_sequence['sequence_num'];
		}
	}

	website::addWebsiteSection($page_detail_id, $section_variant, $sequence_num+1);

	$section_id = 1;
	foreach(website::getWebsiteLastSection() as $last_section) {
		if($last_section['section_id'] != NULL) {
			$section_id = $last_section['section_id'];
		}
	}

	if($section_variant == 1) {		
		website::addWebsiteSectionBlock($section_id);
	}
	else if($section_variant == 2) {
		website::addWebsiteSectionForm($section_id);
	}

	//redirect back to language list

	if(isset($_GET['lang_id'])) {		
		header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $_GET['lang_id']);
	}
	else {
		header('Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id']);
	}
?>