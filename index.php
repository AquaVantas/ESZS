<?php
	require_once("Internal/editors_database.php");	
	require_once("Internal/media_database.php");
	require_once("Internal/news_database.php");	
	require_once("Internal/tournament_database.php");	
	require_once("Internal/website_database.php");

	header('Content-Type: text/html; charset=utf8');

	if (!function_exists('str_contains')) {
		function str_contains (string $haystack, string $needle)
		{
			return empty($needle) || strpos($haystack, $needle) !== false;
		}
	}

	function replaceSpecialCharacters($stringToReplace) {
		$stringToReplace = strtolower($stringToReplace);
		$stringToReplace = str_replace("Š", "s", (str_replace("š", "s", str_replace("č", "c", str_replace("ž", "z", str_replace("đ", "d", str_replace("ć", "c", $stringToReplace)))))));
		$stringToReplace = str_replace("- ", "", $stringToReplace);
		$specialCharacters = [".", ",", "+", ";", ">", "<"];
		$stringToReplace = str_replace($specialCharacters, "", $stringToReplace);
		$stringToReplace = str_replace(" ", "-", $stringToReplace);
		return $stringToReplace;
	}

	function makeTheLinkPath($lang_id, $pageId, $news_id) {
		$pagePathArray = array($pageId);
		$pagePath = (($lang_id == 1) ? "" : ("/" . website::getSpecificWebsiteLanguage($lang_id)[0]['iso'] ?? ""));

		foreach(website::getSpecificWebsitePage($pageId) as $page) {
			$pagePathArray = getParentPage($pagePathArray, $page['subpage_to']);
		}

		for($i = count($pagePathArray) - 1; $i >= 0; $i--) {
			foreach(website::getSpecificWebsitePageDetails($pagePathArray[$i], $lang_id) as $page) {
				$pagePath .= "/" . str_replace("/", "-", $page['page_title']);
			}
		}	
		if($news_id == null) {
			
		}
		else {
		
		}
		return replaceSpecialCharacters($pagePath);
	}

	function getParentPage($pagePathArray, $pageId) {
		if($pageId != null) {
			array_push($pagePathArray, $pageId);
			foreach(website::getSpecificWebsitePage($pageId) as $page) {
				return getParentPage($pagePathArray, $page['subpage_to']);
			}
		}
		else {
			return $pagePathArray;
		}
	}

	function printSubMenu($parent, $parent_title, $lang_id, $currPath) {		
		if($currPath == "" && $lang_id != 1) {
			foreach(website::getSpecificWebsiteLanguage($lang_id) as $used_language) {
				$currPath .= "/" . $used_language['iso'];
			}
		}
		$currPath .= "/" . str_replace("/", "-", $parent_title);
		$html = "<li class='nav-item dropdown' onhover='navigationHover()'>
					<a class='nav-link dropdown-toggle' id='navbarDropdownMenuLink' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" . $parent_title . "</a>
					<ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink' style='position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-40px, 30px);'>";
			foreach(website::getAllWebsitePageSubpagesPageNavigation($parent, $lang_id) as $subpage) {
				if(count(website::getAllWebsitePageSubpagesPageNavigation($subpage['WP_page_id'], $lang_id)) > 0) { 
					$html .= printSubMenu($subpage['WP_page_id'], $subpage['WPD_page_title'], $lang_id, $currPath);
				} else {
					$html .= "<li class='nav-item'>
							<a class='nav-link' href='" . replaceSpecialCharacters($currPath . "/" . str_replace("/", "-", $subpage['WPD_page_title'])) . "'>" . $subpage['WPD_page_title'] . "</a>
						</li>";
				}
			}
		$html .= "</ul></li>";
		return $html;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php 			
			include "routing.php";
			include "Views/Partials/Master/header.php"; 
		?>
	</head>
	<body>
		<?php 
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
						case 5:
							include "Views/Partials/Sections/SectionBlock/blockOtherSocials.php";
							break;
						case 6:
							include "Views/Partials/Sections/SectionBlock/blockLastNews.php";
							break;
						case 7:
							include "Views/Partials/Sections/SectionBlock/blockNews.php";
							break;
						case 8:
							include "Views/Partials/Sections/SectionBlock/blockSDPAnnouncement.php";
							break;
						case 9:
							include "Views/Partials/Sections/SectionBlock/blockSDPGameShort.php";
							break;
						case 10:
							include "Views/Partials/Sections/SectionBlock/blockSDPGameFileDownload.php";
							break;
						case 11:
							include "Views/Partials/Sections/SectionBlock/blockSDPGameAccordionRules.php";
							break;
						case 12:
							include "Views/Partials/Sections/SectionBlock/blockArticle.php";
							break;
						case 13:
							include "Views/Partials/Sections/SectionBlock/blockAds.php";
							break;
						case 14:
							include "Views/Partials/Sections/SectionBlock/blockDocuments.php";
							break;
						case 15:
							include "Views/Partials/Sections/SectionBlock/blockResultsUpcoming.php";
							break;
						case 16:
							include "Views/Partials/Sections/SectionBlock/blockSDPButton.php";
							break;
					}
				} 
			} else if($section_type['variant_id'] == 2) {
				foreach(website::getWebsiteSectionForm($section_type['section_id']) as $section) {
					switch($section['WSF_form_template_id']) {
						case 1: 
							include "Views/Partials/Sections/SectionForm/formLeagueOfLegends.php";
							break;
						case 2:
							include "Views/Partials/Sections/SectionForm/formValorant.php";
							break;
						case 3:
							include "Views/Partials/Sections/SectionForm/formFifa.php";
							break;
						case 4:
							include "Views/Partials/Sections/SectionForm/formMobileLegends.php";
							break;
						case 5:
							include "Views/Partials/Sections/SectionForm/formEFootball.php";
							break;
						case 6:
							include "Views/Partials/Sections/SectionForm/formPubgMobile.php";
							break;
						case 6:
							include "Views/Partials/Sections/SectionForm/formPhyigitalFootball.php";
							break;
					}
				}
			}
		}
		include "Views/Partials/Master/footer.php";
		include "Views/Partials/Master/bootomer.php";
		include "Views/Partials/Master/cookies.php";
		?>
	</body>
</html>