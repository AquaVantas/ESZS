<?php

	//gets the database we'll be working with
	require_once("../../../Internal/media_database.php");

	if(!isset($_POST['alt_text'])) {
		header("url=../../../cpanel.php");
	}
	
	$imageId = $_POST['image_id'];
	$altText = $_POST['alt_text'];

	media::editImageAltText($imageId, $altText);
	

	//redirect back to user list
	header('Location:../cpanel.php');

?>