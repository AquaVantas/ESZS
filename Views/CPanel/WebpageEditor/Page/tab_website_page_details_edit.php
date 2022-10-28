<?php if((isset($cpanel_tab) && $cpanel_tab == "webpage_editor") && (isset($cpanel_action) && $cpanel_action == "edit_page_details") && (isset($_GET['page_id'])) && $_GET['page_id'] != 1) { ?>
	<div class="user-body">
		<div class="row">
			<div class="create-user">
				<form class="row" method="post" action="Controllers/Website/Page/website_edit_page_details.php?page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>">
					<?php foreach(website::getSpecificWebsitePageDetails($_GET['page_id'], (isset($_GET['lang_id'])) ? $_GET['lang_id'] : 1) as $page) { ?>
						<div class="col-12">
							<div class="edit-cloud">
								<label for="page_title">Naslov strani:</label><br>
								<input type="text" id="page_title" name="page_title" value="<?= $page['page_title'] ?>">
							</div>	
						</div>
						<div class="col-12">
							<div class="edit-cloud">
								<label for="meta_name">Meta ime:</label><br>
								<input type="text" id="meta_name" name="meta_name" value="<?= $page['meta_name'] ?>">
								<label for="meta_description">Meta opis:</label><br>
								<input type="text" id="meta_description" name="meta_description" value="<?= $page['meta_description'] ?>">
								<label for="meta_keyword">Meta ključne besede:</label><br>
								<input type="text" id="meta_keyword" name="meta_keyword" value="<?= $page['meta_keyword'] ?>">
							</div>	
						</div>
					<?php } ?>
						<div class="col-12 submit-field">
							<input class="btn btn-primary submit" type="submit" value="Posodobi stran">
						</div>								
				</form>
				<div class="col-12">
					<div class="edit-cloud">
						<div class="section-list">
							<span>Seznam sekcij:</span>
							<div class="add-section" data-bs-toggle="modal" data-bs-target="#add-section">
								<span>Add section</span><dic class="plus-icon"></div>
							</div>							
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
<?php } ?>