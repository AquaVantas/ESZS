<?php
	session_start();
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
	if(isset($_GET['tab'])) {
		$cpanel_tab = $_GET['tab'];
	}
	if(isset($_GET['action'])) {
		$cpanel_action = $_GET['action'];
	}

	$role_admin = false;
	$role_webdev = false;
	$role_news = false;
	$role_admin_dirt_rally_2_0 = false;

	if(isset($_SESSION['user'])) {
		foreach(editors::getSpecificAdminRoles($_SESSION['user']) as $role) {
			if($role['title'] == "Admin") {
				$role_admin = true;
			} else if ($role['title'] == "Web dev") {
				$role_webdev = true;
			} else if ($role['title'] == "Novinar") {
				$role_news = true;
			} else if ($role['title'] == "Game admin - DiRT Rally 2.0") {
				$role_admin_dirt_rally_2_0 = true;
			}
		}
	}

	function printSubMenu($parent, $level) {
		$html = "<div class='subpage-list'>";
		
		foreach(website::getAllWebsitePageSubpages($parent) as $subpage) {
			$html .= "<div class='list-element'>
			<div class='element' style='padding-left:" . $level*10 . "px; padding-right: 5px;'>";
			if (count(website::getSpecificWebsitePageDetails($subpage['page_id'], isset($_GET['lang_id']) ? $_GET['lang_id'] : 1)) != 0) { 
				if(isset($_GET['lang_id'])) {
					$html .= "<a href='?tab=webpage_editor&action=edit_page_details&page_id=" . $subpage['page_id'] . "&lang_id=" . $_GET['lang_id'] . "'>
						" . $subpage['page_title'] . "
					</a>";
				}
				else {
					$html .= "<a href='?tab=webpage_editor&action=edit_page_details&page_id=" . $subpage['page_id'] . "'>
						" . $subpage['page_title'] . "
					</a>";
				}				
			}
			else {
				if(isset($_GET['lang_id'])) {
					$html .= "<a href='Controllers/Website/Page/website_create_page_details.php?page_id=" . $subpage['page_id'] . "&lang_id=" . $_GET['lang_id'] . "'>
						" . $subpage['page_title'] . "
					</a>";
				}
				else {
					$html .= "<a href='Controllers/Website/Page/website_create_page_details.php?page_id=" . $subpage['page_id'] . "'>
						". $subpage['page_title'] . "
					</a>";
				}
			}
			$html .= "<div class='dropdown'>
						<button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
							<img src='Content/Images/Icons/three-dots.svg'>
						</button>
						<ul class='dropdown-menu'>";
			if(isset($_GET['lang_id'])) {
				$html .= "<a class='nav-link' href='Controllers/Website/Page/website_create_page.php?lang_id=" . $_GET['lang_id'] . "&parent_page_id=" . $subpage['page_id'] . "'>Dodaj podstran</a>
				<a class='nav-link' href='?tab=webpage_editor&action=edit_page&page_id=" . $subpage['page_id'] . "&lang_id=" . $_GET['lang_id'] . "'>Uredi</a>
				<a class='nav-link' href='Controllers/Website/Page/website_delete_page_details.php?lang_id=" . $_GET['lang_id'] . "&page_id=" . $subpage['page_id'] . "'>Izbriši za ta jezik</a>
				<a class='nav-link' href='Controllers/Website/Page/website_delete_page.php?lang_id=" . $_GET['lang_id'] . "&page_id=" . $subpage['page_id'] . "'>Izbriši za vse jezike</a>";
			}
			else {
				$html .= "<a class='nav-link' href='Controllers/Website/Page/website_create_page.php?parent_page_id=" . $subpage['page_id'] . "'>Dodaj podstran</a>
				<a class='nav-link' href='?tab=webpage_editor&action=edit_page&page_id=" . $subpage['page_id'] . "'>Uredi</a>
				<a class='nav-link' href='Controllers/Website/Page/website_delete_page_details.php?lang_id=1&page_id=" . $subpage['page_id'] . "'>Izbriši za ta jezik</a>
				<a class='nav-link' href='Controllers/Website/Page/website_delete_page.php?lang_id=" . $_GET['lang_id'] . "&page_id=" . $subpage['page_id'] . "'>Izbriši za vse jezike</a>";
			}
			$html .= "</ul></div></div>";
			if(count(website::getAllWebsitePageSubpages($subpage['page_id'])) > 0) {
				$html .= printSubMenu($subpage['page_id'], $level+1);
			}
			$html .= "</div>";			
		}	
		
		$html .= "</div>";
		return $html;
	}

	function printButtonSubmenu($parent, $level, $button_page_id) {
		$html = "<div class='a-page'>";
		foreach(website::getAllWebsitePageSubpages($parent) as $subpage) {
			$html .= "<div class='option'><input type='checkbox' id='" . $subpage['page_id'] . "' name='" . $subpage['page_id'] . "' value='" . $subpage['page_id'] . "'";
			if ($button_page_id == $subpage['page_id']) {
				$html .= " checked";
			}
			$html .= "><label for='" . $subpage['page_id'] . "'>" . $subpage['page_title'] . "</label></div>";
			if(sizeof(website::getAllWebsitePageSubpages($subpage['page_id'])) > 0) {
				$html .= printButtonSubmenu($subpage['page_id'], $level+1, $button_page_id);
			}
		}
		$html .= "</div>";
		return $html;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<link rel="stylesheet" href="Plugins/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="Style/Master.css">
        <link rel="stylesheet" href="Plugins/quill/quill.snow.css" />  
		<script type="text/javascript" src="Scripts/Main.js"></script>
		<script src="Plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>
		<?php if(isset($_SESSION['user'])) { ?>
		<div class="cpanel-navigation-wrapper">
			<div class="right-side">
				<div class="logo-wrapper">
					<img src="Content/Images/Logos/ESZS/eszs_simbol_white.png" />
					<span class="page-title">CPanel</span>
				</div>
				<div class="navigation-links">
					<?php if($role_webdev || $role_admin){ ?>
						<div class="dropdown">
						<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
							Spletna stran<div class="arrow"></div>
						</button>
						<ul class="dropdown-menu">
							<li><a href="?tab=webpage_editor" class="nav-link <?php if($cpanel_tab == "webpage_editor"){echo "active"; } ?>">Urejevalnik</a></li>
							<li><a href="?tab=media&path=/xampp/htdocs/ESZS_new/Content/WebsiteContent" class="nav-link <?php if($cpanel_tab == "media"){echo "active"; } ?>">Vsebina</a></li>
						</ul>
					</div>
					<?php } ?>
					<div class="dropdown">
						<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
							Novice<div class="arrow"></div>
						</button>
						<ul class="dropdown-menu">
							<?php if($role_news || $role_admin){ ?>
								<li><a href="?tab=news" class="nav-link <?php if($cpanel_tab == "news_editor"){echo "active"; } ?>">Novice</a></li>
								<li><a href="?tab=news_outside_media_add" class="nav-link <?php if($cpanel_tab == "news_editor"){echo "active"; } ?>">Mediji</a></li>
							<?php } ?>
						</ul>
					</div>
					<!--<div class="dropdown">
						<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
							Tekmovanja<div class="arrow"></div>
						</button>
						<ul class="dropdown-menu">
							<li><a href="?tab=tournament_add" class="nav-link">Dodaj tekmovanje</a></li>
							<?php foreach(tournament::getAllGames() as $game) {?>
								<li><a href="?tab=tournament&game=<?= str_replace(".", "_", str_replace(" ", "_", strtolower($game['game_title']))) ?>" class="nav-link"><?= $game['game_title'] ?></a></li>
							<?php } ?>
						</ul>
					</div>-->
					<a href="?tab=tournaments" class="nav-link <?php if($cpanel_tab == "tournaments"){echo "active"; } ?>">Tekmovanja</a>
					<a href="?tab=user_list" class="nav-link <?php if($cpanel_tab == "user_list" || $cpanel_tab == "user_list_create" || $cpanel_tab == "user_list_edit"){echo "active"; } ?>">Uporabniki</a>
				</div>
			</div>
			<div class="left-side">
				<?php foreach(editors::getAllAdmins() as $user) {
					if($user['admin_id'] == $_SESSION['user']) { ?>
						<div class="icon"><?= $user['ime'][0] ?><?= $user['priimek'][0] ?></div>						
						<div class="dropdown">
							<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?= $user['ime'] ?> <?= $user['priimek'] ?><div class="arrow"></div>
							</button>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item logout" href="Controllers/Editors/editors_logout.php">Logout</a></li>
							</ul>
						</div>
						<?php break;
					}
				} ?>
				
			</div>
		</div>
		<div class="cpanel-body-wrapper">
			<?php if(!isset($_GET['tab'])) { ?>
				<div class="default-body">
					Dobrodošel, uporabnik.
				</div>
			<?php } ?>
			<!-- website editor -->
			<?php include "Views/CPanel/tab_website_default_template.php" ?>
			<!-- outside news media -->
			<?php include "Views/CPanel/WebpageEditor/News/tab_news_outside_media_add.php" ?>
			<!-- news -->
			<?php include "Views/CPanel/WebpageEditor/News/tab_news.php" ?>
			<!-- edit news -->
			<?php include "Views/CPanel/WebpageEditor/News/tab_news_edit.php" ?>
			<!-- media list -->
			<?php include "Views/CPanel/tab_media.php" ?>
			<!-- add tournaments -->			
			<?php include "Views/CPanel/WebpageEditor/Tournaments/tab_tournaments_add.php" ?>
			<!-- tournaments -->
			<?php include "Views/CPanel/WebpageEditor/Tournaments/tab_tournaments.php" ?>
			<!-- tournament -->
			<?php include "Views/CPanel/WebpageEditor/Tournaments/tab_competition.php" ?>
			<!-- admin list -->
			<?php include "Views/CPanel/Editors/tab_user_list.php" ?>
			<!-- create new admin user -->
			<?php include "Views/CPanel/Editors/tab_user_list_create.php" ?>			
			<!-- edit user -->
			<?php include "Views/CPanel/Editors/tab_user_list_edit.php" ?>
		</div>
		<div class="modal fade delete-user-modal" id="delete-user-modal" tabindex="-1" aria-labelledby="delete-user-modal-label" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="delete-user-modal-label">Ali ste prepričani?</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Tega dejanja se ne da razveljaviti.
					</div>
					<div class="modal-footer">
						<a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Prekliči</a>
						<a type="button" class="btn btn-primary delete-button">Izbriši</a>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade add-section" id="add-section" tabindex="-1" aria-labelledby="add-section-label" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="delete-user-modal-label">Kateri tip sekcije želite?</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<?php foreach(website::getWebsiteSectionVariants() as $sectionVariants) {?>
							<a class="variant-block" href="Controllers/Website/Page/website_create_page_section.php?page_id=<?= $_GET['page_id'] ?>&section_variant=<?= $sectionVariants['variant_id'] ?>">
								<div class="variant-icon <?= $sectionVariants['section_type'] ?>"></div>
								<span><?= $sectionVariants['section_type'] ?></span>
							</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php } else { ?> 
			<div class="login-box container ">
				<div class="row">
					<div class="col-6 offset-3">
						<form class="row" method="post" action="Controllers/Editors/editors_login.php">
							<div class="col-12">
								<label for="email">E-pošta:</label><br>
								<input type="text" id="email" name="email" placeholder="janez.novak@eszs.si" required>
							</div>								
							<div class="col-12">
								<label for="password">Geslo:</label><br>
								<input type="password" id="password" name="password" required>
							</div>
							<div class="col-12 submit-field-edit">
								<input class="btn btn-primary submit" type="submit" value="Prijava">
							</div>								
						</form>
					</div>
				</div>
			</div>
		<?php } ?>
		<script src="Plugins/quill/quill.min.js"></script>
        <script src="Plugins/quill/image-resize.min.js"></script>
        <script src="Plugins/quill/quill.imageUploader.min.js"></script>		
        <script src="Scripts/QuillEditor.js"></script>
	</body>
	<footer>
	</footer>
</html>