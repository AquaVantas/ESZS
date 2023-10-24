<?php

	//gets the database we'll be working with
	require_once("../../../Internal/media_database.php");
	require_once("../../../Internal/website_database.php");

	if(!isset($_POST['filename'])) {
		header("url=../../../cpanel.php");
	}
	
	$fileName = $_FILES["filename"]["name"];
	$targetDir = $_GET["target_dir"];
	$targetDirDatabase = substr($targetDir, strpos($targetDir, "Content")) . "/" . $_FILES["filename"]["name"];
	$targetDir = "../../../" . substr($targetDir, strpos($targetDir, "Content")) . "/" . $_FILES["filename"]["name"];
	if (file_exists($targetDir)) {
		echo "The file $targetDir exists";
	} else {
		if($_FILES["filename"]["name"] != NULL) {
			if (move_uploaded_file($_FILES["filename"]["tmp_name"], $targetDir)) {
				media::addImage($targetDirDatabase, $_FILES["filename"]["name"]);
				if($_GET['contentType'] == "blockContent") {	
					$lastImg = 0;
					foreach(media::getLastImageID() as $imgID) {
						$lastImg = $imgID['max_image_id'];
					}
					website::updateWebsiteBlockContentImage($_GET['contentID'], intval($lastImg));
				}
				//TO-DO add upload for buttons
				else if($_GET['contentType'] == "button") {
					echo "button type";
				}
			}
		}
	}
	

	//redirect back to user list
	//header('Location:../cpanel.php?tab=news_outside_media_add');

?>