<?php
	session_start();
	require_once("Internal/editors_database.php");
	require_once("Internal/news_database.php");	
	require_once("Internal/website_database.php");	

	header('Content-Type: text/html; charset=utf8');
	if(isset($_GET['tab'])) {
		$cpanel_tab = $_GET['tab'];
	}
	if(isset($_GET['action'])) {
		$cpanel_action = $_GET['action'];
	}

	$role_admin = false;
	$role_webdev = false;
	$role_news = false;

	if(isset($_SESSION['user'])) {
		foreach(editors::getSpecificAdminRoles($_SESSION['user']) as $role) {
			if($role['title'] == "Admin") {
				$role_admin = true;
			} else if ($role['title'] == "Web dev") {
				$role_webdev = true;
			} else if ($role['title'] == "Novinar") {
				$role_news = true;
			}
		}
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
						<!--<a href="?tab=webpage_editor" class="nav-link <?php if($cpanel_tab == "webpage_editor"){echo "active"; } ?>">Spletna stran</a>-->
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
							<li><?php if($role_news || $role_admin){ ?><a href="?tab=news_outside_media_add" class="nav-link <?php if($cpanel_tab == "news_editor"){echo "active"; } ?>">Mediji</a><?php } ?></li>
						</ul>
					</div>
					<?php if($role_admin){ ?><a href="?tab=tournaments&path=/xampp/htdocs/ESZS_new/Content/WebsiteContent" class="nav-link <?php if($cpanel_tab == "tournaments"){echo "active"; } ?>">Tekmovanja</a><?php } ?>
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
			<!-- outside news media-->
			<?php include "Views/CPanel/tab_news_outside_media_add.php" ?>
			<!-- media list -->
			<?php include "Views/CPanel/tab_media.php" ?>
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