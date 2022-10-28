<?php if(isset($cpanel_tab) && $cpanel_tab == "webpage_editor") { ?>
	<div class="website-default-template">
		<div class="left-side">
			<div class="language-select">
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						<?php
							if(isset($_GET['lang_id'])) {
								foreach(website::getSpecificWebsiteLanguage($_GET['lang_id']) as $language) {
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
								<li><a href="?tab=webpage_editor&lang_id=<?= $language['language_id'] ?>" class="nav-link"><?= $language['title']?></a></li>
							<?php }
							if(isset($_GET['lang_id'])) { ?>
								<li><a href="?tab=webpage_editor&action=language_editor&lang_id=<?= $_GET['lang_id'] ?>" class="nav-link">Uredi jezike</a></li>
							<?php } else {	?>
								<li><a href="?tab=webpage_editor&action=language_editor" class="nav-link">Uredi jezike</a></li>
							<?php } 
						?>
					</ul>
				</div>
			</div>
			<div class="site-info">
				<span>TO-DO: Add page setup
			</div>
			<div class="list-of-pages">
				<?php foreach(website::getAllWebsitePages() as $page) { 
					if($page['page_id'] != 1) { ?>
					<div class="list-element">
						<?php if (count(website::getSpecificWebsitePageDetails($page['page_id'], isset($_GET['lang_id']) ? $_GET['lang_id'] : 1)) != 0) { ?>
							<a href="?tab=webpage_editor&action=edit_page_details&page_id=<?= $page['page_id'] ?><?= (isset($_GET['lang_id'])) ? '&lang_id='.$_GET['lang_id'] : '' ?>">
								<?= $page['page_title'] ?>
							</a>
						<?php } else { ?>
							<a href="Controllers/Website/Page/website_create_page_details.php?page_id=<?= $page['page_id'] ?><?= (isset($_GET['lang_id'])) ? '&lang_id='.$_GET['lang_id'] : '' ?>">
								<?= $page['page_title'] ?>
							</a>
						<?php } ?>
						<div class="dropdown">
							<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								<img src="Content/Images/Icons/three-dots.svg">
							</button>
							<ul class="dropdown-menu">							
								<a class="nav-link" href="?tab=webpage_editor&action=edit_page&page_id=<?= $page['page_id'] ?><?= (isset($_GET['lang_id'])) ? '&lang_id='.$_GET['lang_id'] : '' ?>">Uredi</a>
								<a class="nav-link">TO-DO: Izbriši (moraš izbrisat tudi vse kar sledi)</a>
							</ul>
						</div>
					</div>
					<?php } else { ?>
						<div class="list-element">
							<a><?= $page['page_title'] ?></a>
						</div>
					<?php }
				} ?>
			</div>
		</div>
		<div class="right-side">
			<!-- website page edit -->
			<?php include "Views/CPanel/WebpageEditor/Page/tab_website_page_edit.php" ?>
			<!-- website page details edit -->
			<?php include "Views/CPanel/WebpageEditor/Page/tab_website_page_details_edit.php" ?>
			<!-- website language editor -->
			<?php include "Views/CPanel/WebpageEditor/Languages/tab_website_language_editor.php" ?>
			<!-- website language add -->
			<?php include "Views/CPanel/WebpageEditor/Languages/tab_website_language_add.php" ?>
			<!-- website language edit -->
			<?php include "Views/CPanel/WebpageEditor/Languages/tab_website_language_edit.php" ?>
		</div>
	</div>
<?php } ?>