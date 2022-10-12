<?php 
if(isset($cpanel_tab) && $cpanel_tab == "user_list_create" && $role_admin) { ?>
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
						<label for="email">Email:</label><br>
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