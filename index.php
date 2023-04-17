<?php
	session_start();
	require_once("Internal/editors_database.php");	
	require_once("Internal/media_database.php");
	require_once("Internal/news_database.php");	
	require_once("Internal/tournament_database.php");	
	require_once("Internal/website_database.php");

	header('Content-Type: text/html; charset=utf8');

	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<link rel="stylesheet" href="Plugins/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="Style/Master.css">
		<script type="text/javascript" src="Scripts/Main.js"></script>
		<script src="Plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>
		<?php if(!isset($_GET['page_id'])) {
			$page_id = 1;
		}
		else {
			$page_id = $_GET['page_id'];
		}

		if(!isset($_GET['lang_id'])) {
			$lang_id = 1;
		}
		else {			
			$lang_id = $_GET['lang_id'];
		}

		$page_details_id = 0;
		foreach(website::getSpecificWebsitePageDetails($page_id, $lang_id) as $page) {
			$page_details_id = $page['page_detail_id'];
		}

		foreach(website::getWebsiteSections($page_details_id) as $section_type) {
			if($section_type['variant_id'] == 1) {
				foreach(website::getWebsiteSectionBlocks($section_type['section_id']) as $section) {
					echo $section['WSB_block_template_id'];
					switch($section['WSB_block_template_id']) {
						case 1: 
							include "Views";
							break;
					}
				} 
			}
		}
		?>
	</body>
	<footer>
	</footer>
</html>