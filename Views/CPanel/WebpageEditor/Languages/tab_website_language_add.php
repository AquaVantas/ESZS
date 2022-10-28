<?php if((isset($cpanel_tab) && $cpanel_tab == "webpage_editor") && (isset($cpanel_action) && $cpanel_action == "language_add")) { ?>
	<div class="create-bar">
		<?php if(isset($_GET['lang_id'])) { ?>
			<a class="btn btn-primary" href="?tab=webpage_editor&action=language_editor&lang_id=<?= $_GET['lang_id'] ?>"><div class="arrow-icon"></div>Prekliči</a>
		<?php } else { ?>
			<a class="btn btn-primary" href="?tab=webpage_editor&action=language_editor"><div class="arrow-icon"></div>Prekliči</a>
		<?php } ?>
	</div>
	<div class="user-body">
		<div class="row">
			<div class="create-user">						
				<form class="row" method="post" action="Controllers/Website/Languages/website_create_language.php<?= (isset($_GET['lang_id']) ? ('?lang_id=' . $_GET['lang_id']) : '') ?>">
					<div class="col-6">
						<label for="title">Jezik:</label><br>
						<input type="text" id="title" name="title" placeholder="slovenščina" required>
					</div>								
					<div class="col-6">
						<label for="short">Okrajšava:</label><br>
						<input type="text" id="short" name="short" placeholder="SLO" required>
					</div>
					<div class="col-12 submit-field">
						<input class="btn btn-primary submit" type="submit" value="Dodaj jezik">
					</div>								
				</form>
			</div>
		</div>
	</div>
<?php } ?>