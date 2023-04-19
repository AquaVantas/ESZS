<?php
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
		<?php include "Views/Partials/Master/header.php"; ?>
	</head>
	<body>
		<?php 
		
		if(!isset($_GET['page_id'])) {
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

		include "Views/Partials/Master/navigation.php";

		foreach(website::getWebsiteSections($page_details_id) as $section_type) {
			if($section_type['variant_id'] == 1) {
				foreach(website::getWebsiteSectionBlocks($section_type['section_id']) as $section) {
					switch($section['WSB_block_template_id']) {
						case 1: 
							include "Views/Partials/Sections/SectionBlock/blockHightlightedNews.php";
							break;
						case 2:
							include "Views/Partials/Sections/SectionBlock/blockAboutUsShort.php";
							break;
						case 3:
							include "Views/Partials/Sections/SectionBlock/blockPartners.php";
							break;
						case 4:
							include "Views/Partials/Sections/SectionBlock/blockMembers.php";
							break;
					}
				} 
			}
		}

		include "Views/Partials/Master/bootomer.php";
		?>
	</body>
	<footer>
	</footer>
</html>