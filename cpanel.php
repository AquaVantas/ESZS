<!DOCTYPE html>
<?php
	session_start();
	require_once("Internal/editors_database.php");
	if(isset($_GET['tab'])) {
		$cpanel_tab = $_GET['tab'];
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<link rel="stylesheet" href="Plugins/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="Style/Master.css">
		<script src="Plugins/bootstrap/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="cpanel-navigation-wrapper">
			<div class="right-side">
				<div class="logo-wrapper">
					<img src="Content/Images/Logos/ESZS/eszs_simbol_white.png" />
					<span class="page-title">CPanel</span>
				</div>
				<div class="navigation-links">
					<a href="?tab=webpage_editor" class="nav-link <?php if($cpanel_tab == "webpage_editor"){echo "active"; } ?>">Spletna stran</a>
					<a href="?tab=news_editor" class="nav-link <?php if($cpanel_tab == "news_editor"){echo "active"; } ?>">Novice</a>
					<a href="?tab=tournaments" class="nav-link <?php if($cpanel_tab == "tournaments"){echo "active"; } ?>">Tekmovanja</a>
					<a href="?tab=user_list" class="nav-link <?php if($cpanel_tab == "user_list" || $cpanel_tab == "user_list_create"){echo "active"; } ?>">Uporabniki</a>
				</div>
			</div>
			<div class="left-side">
				<div class="icon"></div>
				Name Surname
			</div>
		</div>
		<div class="cpanel-body-wrapper">
			<?php if(!isset($_GET['tab'])) { ?>
				<div class="default-body">
					Dobrodošel, uporabnik.
				</div>
			<?php } ?>
			<!-- admin list -->
			<?php if(isset($cpanel_tab) && $cpanel_tab == "user_list") { ?>
				<div class="user-body container">
					<div class="row">
						<div class="col-12 create-bar">
							<a class="btn btn-primary" href="?tab=user_list_create">Ustvari uporabnika</a>
						</div>
						<?php foreach(editors::getAllAdmins() as $admin) { ?>
							<div class="col-lg-3 col-md-4 col-6">
								<div class="user-card">
									<div class="user-icon">
										<?= substr($admin['ime'], 0, 1) ?><?= substr($admin['priimek'], 0, 1) ?>
									</div>
									<div class="user-info">
										<span class="user-info-name"><?= $admin['ime'] ?> <?= $admin['priimek'] ?></span>
										<span class="user-info-email"><?= $admin['email'] ?></span>
									</div>
									<div class="user-roles">
										<?php foreach(editors::getSpecificAdminRoles($admin['admin_id']) as $role) { ?>
											<span><?= $role['title'] ?></span>
										<?php } ?>
									</div>
									<div class="user-actions">
										<a class="btn btn-secondary" href="?tab=user_list_edit&user=<?= $admin['admin_id'] ?>">Uredi</a>
										<a class="btn btn-secondary" href="" data-bs-toggle="modal" data-bs-target="#delete-user-modal">Izbriši</a>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
			<!-- create new admin user -->
			<?php if(isset($cpanel_tab) && $cpanel_tab == "user_list_create") { ?>
				<div class="user-body container">
					<div class="row">
						<div class="col-12 create-bar">
							<a class="btn btn-primary" href="?tab=user_list"><div class="arrow-icon"></div>Prekliči</a>
						</div>
						<div class="col-8 offset-2 create-user">
						<?php
							if(isset($_GET['error'])) { ?>
								<p class="error">Gesli se ne ujemata! Poskusite ponovno!</p>
							<?php }
						?>						
						<form class="row" method="post" action="Controllers/editors_create_user.php">
								<div class="col-6">
									<label for="name">Ime:</label><br>
									<input type="text" id="name" name="name" placeholder="Janez" required>
								</div>								
								<div class="col-6">
									<label for="surname">Priimek:</label><br>
									<input type="text" id="surname" name="surname" placeholder="Novak" required>
								</div>
								<div class="col-12">
									<label for="email">Priimek:</label><br>
									<input type="text" id="email" name="email" placeholder="janez.novak@eszs.si" required>
								</div>								
								<div class="col-6">
									<label for="password">Geslo:</label><br>
									<input type="password" id="password" name="password" required>
								</div>								
								<div class="col-6">
									<label for="password-repeat">Ponovi geslo:</label><br>
									<input type="password" id="password-repeat" name="password-repeat" required>
								</div>
								<div class="col-12">
									<label>Vloge uporabnika:</label>
								</div>
								<?php 
									$roles = editors::getAdminRoles();
									foreach($roles as $role): ?>
										<div class="col-6 user-permissions">
											<input type="checkbox" id="<?= strtolower(str_replace(" ", "_", $role["title"])) ?>" name="<?= strtolower(str_replace(" ", "_", $role["title"])) ?>" value="True">
											<span><?= $role["title"] ?></span>
										</div>										
									<?php endforeach; 
								?>
								<div class="col-12 submit-field">
									<input class="btn btn-primary submit" type="submit" value="Ustvari uporabnika">
								</div>								
							</form>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="modal fade delete-user-modal" id="delete-user-modal" tabindex="-1" aria-labelledby="delete-user-modal-label" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="delete-user-modal-label">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Ali ste prepričani, da želite izbrisati tega uporabnika?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Prekliči</button>
						<button type="button" class="btn btn-primary">Izbriši</button>
					</div>
				</div>
			</div>
		</div>
	</body>
	<footer>
	</footer>
</html>