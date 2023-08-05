<?php
	
	//gets the database we'll be working with
	require_once("../../../Internal/website_database.php");
	
	//since we had problems with NULL entries in the database
	//we'll first check if there even is a value attached to what we're adding
	if(!isset($_GET['page_id']) || !isset($_GET['section_id'])) {
		if(!isset($_GET['lang_id'])) {			
			header("url=../../../cpanel.php?tab=webpage_editor");
		}
		else {
			header("url=../../../cpanel.php?tab=webpage_editor&lang_id=".$_GET['lang_id']);
		}
	}

	if(isset($_GET['lang_id'])) {
		$lang_id = $_GET['lang_id'];
	} else {
		$lang_id = 1;
	}

	$section_id = $_GET['section_id'];
	$section_name = $_POST['section-name'];
	$form_template_id = intval($_POST['section-template']);
	$section_class = $_POST['section-class'];
	$form_header = $_POST['section-header'];
	$form_subheader = $_POST['section-subheader'];
	$form_receivers = $_POST['form-receivers'];
	if($_POST['form-receivers'] == '') {
	    $image_id = NULL;
	}
	else {
	    $image_id = $_POST['form-image'];
	}

	//edits language in the database
	if($section_id != NULL) {
		website::updateWebsiteSectionForm($section_id, $section_name, $form_template_id, $section_class, $form_header, $form_subheader, $form_receivers, $image_id);
	}

	//redirect back to language list
	header("Location:../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=" . $_GET['page_id'] . "&lang_id=" . $lang_id);
?>