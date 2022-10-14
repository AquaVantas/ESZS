<?php if((isset($cpanel_tab) && $cpanel_tab == "webpage_editor") && (isset($cpanel_action) && $cpanel_action == "language_editor")) { ?>
	<div class="create-bar">
		<a class="btn btn-primary" href="?tab=webpage_editor&action=language_add">Dodaj jezik</a>
	</div>
	<div class="content-wrapper">
		<div class="language-list">
			<table>
				<?php
					foreach(website::getAllWebsiteLanguages() as $language) {
						?>
							<tr>
								<td><?= $language['title'] ?> (<?= $language['short'] ?>)</td>
								<?php if($language['short'] != "SLO") { ?>
									<td><a href="?tab=webpage_editor&action=language_edit&lang_id=<?= $language['language_id'] ?>">Uredi</a></td>
									<td><a onclick="deleteUser('Controllers/Website/Languages/website_delete_language.php?lang_id='+<?= $language['language_id'] ?>)" data-bs-toggle="modal" data-bs-target="#delete-user-modal">Izbriši</a></td>
								<?php } 
								else { ?>
									<td></td>
									<td></td>
								<?php }?>
							</tr>
						<?php
					}
				?>
			</table>
		</div>
	</div>
<?php } ?>