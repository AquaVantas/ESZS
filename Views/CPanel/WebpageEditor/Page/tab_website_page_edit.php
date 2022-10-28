<?php if((isset($cpanel_tab) && $cpanel_tab == "webpage_editor") && (isset($cpanel_action) && $cpanel_action == "edit_page") && (isset($_GET['page_id'])) && $_GET['page_id'] != 1) { ?>
	<div class="user-body">
		<div class="row">
			<div class="create-user">
				<?php
					if(isset($_GET['error'])) { ?>
						<p class="error">Gesli se ne ujemata! Poskusite ponovno!</p>
					<?php }
				?>						
				<form class="row" method="post" action="Controllers/Website/Page/website_edit_page.php?page_id=<?= $_GET['page_id'] ?><?= (isset($_GET['lang_id'])) ? '&lang_id='.$_GET['lang_id'] : '' ?>">
					<?php foreach(website::getSpecificWebsitePage($_GET['page_id']) as $page) { ?>
						<div class="col-12">
							<label for="page_title">Naslov:</label><br>
							<input type="text" id="page_title" name="page_title" value="<?= $page['page_title'] ?>" required>
						</div>	
					<?php } ?>
					<div class="col-12 submit-field">
						<input class="btn btn-primary submit" type="submit" value="Spremeni naslov strani">
					</div>								
				</form>
			</div>
		</div>
	</div>
<?php } ?>