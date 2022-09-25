<!DOCTYPE html>
<?php
	session_start();
	require_once("Internal/editors_database.php");
	if(isset($_GET['tab'])) {
		$cpanel_tab = $_GET['tab'];
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
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<link rel="stylesheet" href="Plugins/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="Style/Master.css">
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
					<?php if($role_webdev || $role_admin){ ?><a href="?tab=webpage_editor" class="nav-link <?php if($cpanel_tab == "webpage_editor"){echo "active"; } ?>">Spletna stran</a><?php } ?>
					<?php if($role_news || $role_admin){ ?><a href="?tab=news_editor" class="nav-link <?php if($cpanel_tab == "news_editor"){echo "active"; } ?>">Novice</a><?php } ?>
					<?php if($role_admin){ ?><a href="?tab=tournaments" class="nav-link <?php if($cpanel_tab == "tournaments"){echo "active"; } ?>">Tekmovanja</a><?php } ?>
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
								<li><a class="dropdown-item logout" href="Controllers/editors_logout.php">Logout</a></li>
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
			<!-- admin list -->
			<?php if(isset($cpanel_tab) && $cpanel_tab == "user_list") { ?>
				<div class="user-body container">
					<div class="row">
						<div class="col-12 create-bar">
							<?php if($role_admin) { ?><a class="btn btn-primary" href="?tab=user_list_create">Ustvari uporabnika</a><?php } ?>
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
										<?php 
										$roleCount = 0;
										foreach(editors::getSpecificAdminRoles($admin['admin_id']) as $role) { ?>
											<?php if($roleCount == 0) { ?>
												<span><?= $role['title'] ?></span>
											<?php } 
											else { ?>
												<span>, <?= $role['title'] ?></span>
											<?php } 
											$roleCount++;
										 } ?>
									</div>
									<?php if($role_admin) { ?>
									<div class="user-actions">
										<a class="btn btn-secondary" href="?tab=user_list_edit&user=<?= $admin['admin_id'] ?>">Uredi</a>
										<a class="btn btn-secondary" onclick="deleteUser(<?= $admin['admin_id'] ?>)" data-bs-toggle="modal" data-bs-target="#delete-user-modal">Izbriši</a>
									</div>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
			<!-- create new admin user -->
			<?php if(isset($cpanel_tab) && $cpanel_tab == "user_list_create" && $role_admin) { ?>
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
			<!-- edit user -->
			<?php if(isset($cpanel_tab) && $cpanel_tab == "user_list_edit" && $role_admin) { ?>
				<div class="user-body container">
					<div class="row">
						<div class="col-12 create-bar">
							<a class="btn btn-primary" href="?tab=user_list"><div class="arrow-icon"></div>Prekliči</a>
						</div>
						<div class="col-8 offset-2 create-user">		
							<?php if(isset($_GET['user'])) {
								foreach(editors::getSpecificAdmin($_GET['user']) as $user) {
							?>
								<form class="row" method="post" action="Controllers/editors_edit_user_information.php?user=<?= $_GET['user'] ?>">
									<div class="col-6">
										<label for="name">Ime:</label><br>
										<input type="text" id="name" name="name" value="<?= $user['ime'] ?>" required>
									</div>								
									<div class="col-6">
										<label for="surname">Priimek:</label><br>
										<input type="text" id="surname" name="surname" value="<?= $user['priimek'] ?>" required>
									</div>
									<div class="col-12">
										<label for="email">Priimek:</label><br>
										<input type="text" id="email" name="email" value="<?= $user['email'] ?>" required>
									</div>
									<div class="col-12 submit-field-edit">
										<input class="btn btn-primary submit" type="submit" value="Posodobi podatke">
									</div>								
								</form>
							<?php 
								}
							} ?>
						</div>
						<div class="col-8 offset-2 create-user">		
							<?php if(isset($_GET['user'])) {
								foreach(editors::getSpecificAdmin($_GET['user']) as $user) {
							?>
								<form class="row" method="post" action="Controllers/editors_edit_user_roles.php?user=<?= $_GET['user'] ?>">
									<div class="col-12">
										<label>Vloge uporabnika:</label>
									</div>
									<?php 
										$roles = editors::getAdminRoles();
										foreach($roles as $role): ?>
											<div class="col-6 user-permissions">
												<input type="checkbox" id="<?= strtolower(str_replace(" ", "_", $role["title"])) ?>" name="<?= strtolower(str_replace(" ", "_", $role["title"])) ?>" value="True" <?php foreach(editors::getSpecificAdminRoles($_GET['user']) as $user_roles) { if($user_roles['title'] == $role['title']) { echo "checked"; }} ?>>
												<span><?= $role["title"] ?></span>
											</div>										
										<?php endforeach; 
									?>
									<div class="col-12 submit-field-edit">
										<input class="btn btn-primary submit" type="submit" value="Posodobi dovoljenja">
									</div>				
								</form>
							<?php 
								}
							} ?>
						</div>
						<div class="col-8 offset-2 create-user">		
							<?php if(isset($_GET['user'])) {
								foreach(editors::getSpecificAdmin($_GET['user']) as $user) {
							?>
								<form class="row" method="post" action="Controllers/editors_edit_user_password.php?user=<?= $_GET['user'] ?>">
									<div class="col-6">
										<label for="password">Geslo:</label><br>
										<input type="password" id="password" name="password" required>
									</div>								
									<div class="col-6">
										<label for="password-repeat">Ponovi geslo:</label><br>
										<input type="password" id="password-repeat" name="password-repeat" required>
									</div>
									<div class="col-12 submit-field-edit">
										<input class="btn btn-primary submit" type="submit" value="Posodobi geslo">
									</div>				
								</form>
							<?php 
								}
							} ?>
						</div>
					</div>
				</div>
			<?php } ?>
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
		<?php } else { ?> 
			<div class="login-box container ">
				<div class="row">
					<div class="col-6 offset-3">
						<form class="row" method="post" action="Controllers/editors_login.php">
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
	</body>
	<footer>
	</footer>
</html>