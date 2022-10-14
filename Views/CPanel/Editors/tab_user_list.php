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
							<a class="btn btn-secondary" onclick="deleteUser('Controllers/Editors/editors_delete_user.php?user='+<?= $admin['admin_id'] ?>)" data-bs-toggle="modal" data-bs-target="#delete-user-modal">Izbriši</a>
						</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>