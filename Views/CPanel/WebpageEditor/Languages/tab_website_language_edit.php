<?php 
	if(isset($_GET['edit_lang_id']) && $_GET['edit_lang_id'] == 1) {
		header('url=../cpanel.php?tab=webpage_editor&action=language_editor');
	}
?>
<?php if((isset($cpanel_tab) && $cpanel_tab == "webpage_editor") && (isset($cpanel_action) && $cpanel_action == "language_edit")) { ?>
	<div class="create-bar">
		<a class="btn btn-primary" href="?tab=webpage_editor&action=language_editor"><div class="arrow-icon"></div>Prekliči</a>
	</div>
	<div class="user-body">
		<div class="row">
			<div class="create-user">					
				<form class="row" method="post" action="Controllers/Website/Languages/website_edit_language.php?edit_lang_id=<?= $_GET['edit_lang_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>">
					<?php foreach(website::getSpecificWebsiteLanguage($_GET['edit_lang_id']) as $language) { ?>
						<div class="col-6">
							<label for="title">Jezik:</label><br>
							<input type="text" id="title" name="title" value="<?= $language['title'] ?>" required>
						</div>								
						<div class="col-6">
							<label for="short">Okrajšava:</label><br>
							<input type="text" id="short" name="short" value="<?= $language['short'] ?>" required>
						</div>
						<div class="col-12 submit-field">
							<input class="btn btn-primary submit" type="submit" value="Uredi jezik">
						</div>					
					<?php } ?>								
				</form>
			</div>
		</div>
	</div>
<?php } ?>