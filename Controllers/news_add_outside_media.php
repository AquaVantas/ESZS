<?php

	//gets the database we'll be working with
	require_once("../Internal/news_database.php");

	if(!isset($_POST['media-name']) || $_POST['media-name'] == NULL) {
		header('url=../cpanel.php?tab=news_outside_media_add');
	}
	
	$mediaName = $_POST['media-name'];
	$mediaType = $_POST['media-type'];
	$contactName = $_POST['contact-name'];
	$contactSurname = $_POST['contact-surname'];
	$email = $_POST['email'];
	$contactTitle = $_POST['contact-title'];
	$phoneNumber = $_POST['phone-number'];
	$responsive = ($_POST['responsive'] == 'Yes') ? 1 : 0;

	//add to database
	if($_POST['media-name'] != NULL) {
		news::addOutsideMedia($mediaName, $mediaType, $contactName, $contactSurname, $email, $contactTitle, $phoneNumber, $responsive);
	}

	//redirect back to user list
	header('Location:../cpanel.php?tab=news_outside_media_add');

?>