<?php if(isset($cpanel_tab) && $cpanel_tab == "webpage_editor") { ?>
	<div class="website-default-template">
		<div class="left-side">
			<div class="language-select">
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						<?php
							if(isset($_GET['lang'])) {
								foreach(website::getSpecificWebsiteLanguage($_GET['lang']) as $language) {
									?><?= $language['title'] ?><?php
								}								
							}
							else {
								foreach(website::getSpecificWebsiteLanguage(1) as $language) {
									?><?= $language['title'] ?><?php
								}								
							}
						?>
						<div class="arrow"></div>
					</button>
					<ul class="dropdown-menu">
						<?php
							foreach(website::getAllWebsiteLanguages() as $language) {?>
								<li><a href="?tab=webpage_editor&lang=<?= $language['language_id'] ?>" class="nav-link"><?= $language['title']?></a></li>
							<?php }
						?>
						<li><a href="?tab=webpage_editor&action=language_editor" class="nav-link">Uredi jezike</a></li>
						
					</ul>
				</div>
			</div>
		</div>
		<div class="right-side">
			<!-- website language editor -->
			<?php include "Views/CPanel/WebpageEditor/Languages/tab_website_language_editor.php" ?>
			<!-- website language add -->
			<?php include "Views/CPanel/WebpageEditor/Languages/tab_website_language_add.php" ?>
			<!-- website language edit -->
			<?php include "Views/CPanel/WebpageEditor/Languages/tab_website_language_edit.php" ?>
		</div>
	</div>
<?php } ?>