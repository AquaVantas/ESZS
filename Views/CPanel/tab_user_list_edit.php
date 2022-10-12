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