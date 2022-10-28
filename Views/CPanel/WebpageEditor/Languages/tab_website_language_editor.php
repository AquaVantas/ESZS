<?php if((isset($cpanel_tab) && $cpanel_tab == "webpage_editor") && (isset($cpanel_action) && $cpanel_action == "language_editor")) { ?>
	<div class="create-bar">
		<?php if(isset($_GET['lang_id'])) { ?>
			<a class="btn btn-primary" href="?tab=webpage_editor&action=language_add&lang_id=<?= $_GET['lang_id'] ?>">Dodaj jezik</a>
		<?php } else { ?>
			<a class="btn btn-primary" href="?tab=webpage_editor&action=language_add">Dodaj jezik</a>
		<?php } ?>
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
									<?php if(count(website::getSpecificWebsitePageDetailsLanguage($language['language_id'])) == 0) {?>
										<td><a href="?tab=webpage_editor&action=language_edit&edit_lang_id=<?= $language['language_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>">Uredi</a></td>
										<td>
											<a onclick="deleteUser('Controllers/Website/Languages/website_delete_language.php?edit_lang_id=<?= $language['language_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>')" data-bs-toggle="modal" data-bs-target="#delete-user-modal">Izbriši TO-DO: Block if content exists</a>
										</td>
									<?php } else { ?>
										<td></td>
										<td><a href="?tab=webpage_editor&action=language_edit&edit_lang_id=<?= $language['language_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>">Uredi</a></td>
									<?php } ?>
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