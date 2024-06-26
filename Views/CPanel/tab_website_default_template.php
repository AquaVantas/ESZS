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
				<?php if(isset($_GET['lang_id'])) {
					$lang_id = $_GET['lang_id'];					
				} else {
					$lang_id = 1;
				}
				if(count(website::getWebsiteDefault($lang_id)) > 0) { ?>
					<a href="?tab=webpage_editor&action=edit_page_header_footer&lang_id=<?= $lang_id ?>">EŠZS</a>				
				<?php } else { ?>
					<a href="Controllers/Website/Page/website_default_create.php?lang_id=<?= $lang_id ?>">EŠZS</a>
				<?php } ?>
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						<img src="Content/Images/Icons/three-dots.svg">
					</button>
					<ul class="dropdown-menu">							
						<a class="nav-link" href="Controllers/Website/Page/website_create_page.php?<?= (isset($_GET['lang_id'])) ? '&lang_id='.$_GET['lang_id'] : '' ?>">Dodaj stran</a>
					</ul>
				</div>
			</div>
			<div class="list-of-pages">				
				<?php foreach(website::getAllWebsitePages() as $page) { 
					if($page['page_id'] != 1) { ?>
					<div class="main-element-wrapper">
						<div class="list-element">
							<div class="element">
								<?php if (count(website::getSpecificWebsitePageDetails($page['page_id'], isset($_GET['lang_id']) ? $_GET['lang_id'] : 1)) != 0) { 
									foreach(website::getSpecificWebsitePageDetails($page['page_id'], isset($_GET['lang_id']) ? $_GET['lang_id'] : 1) as $page_detail) { ?>
										<a class="published-<?= $page_detail['page_published'] ?>" href="?tab=webpage_editor&action=edit_page_details&page_id=<?= $page['page_id'] ?><?= (isset($_GET['lang_id'])) ? '&lang_id='.$_GET['lang_id'] : '' ?>">
											<?= $page['page_title'] ?>
										</a>
									<?php } 									
								} else { ?>
									<a href="Controllers/Website/Page/website_create_page_details.php?page_id=<?= $page['page_id'] ?><?= (isset($_GET['lang_id'])) ? '&lang_id='.$_GET['lang_id'] : '' ?>">
										<?= $page['page_title'] ?>
									</a>
								<?php } ?>
								<div class="dropdown">
									<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
										<img src="Content/Images/Icons/three-dots.svg">
									</button>
									<ul class="dropdown-menu">					
										<a class="nav-link" href="Controllers/Website/Page/website_create_page.php?<?= (isset($_GET['lang_id'])) ? '&lang_id='.$_GET['lang_id'] : '' ?>&parent_page_id=<?= $page['page_id'] ?>">Dodaj podstran</a>
										<a class="nav-link" href="?tab=webpage_editor&action=edit_page&page_id=<?= $page['page_id'] ?><?= (isset($_GET['lang_id'])) ? '&lang_id='.$_GET['lang_id'] : '' ?>">Uredi</a>
										<a class='nav-link' href="Controllers/Website/Page/website_delete_page_details.php?lang_id=<?= $lang_id ?>&page_id=<?= $page['page_id']?>">Izbriši za ta jezik</a>
										<a class='nav-link' href="Controllers/Website/Page/website_delete_page.php?lang_id=<?= $lang_id ?>&page_id=<?= $page['page_id']?>">Izbriši za vse jezike</a>
									</ul>
								</div>
							</div>
						</div>
						<?php if(sizeof(website::getAllWebsitePageSubpages($page['page_id'])) > 0) {
							echo printSubMenu($page['page_id'], 3);
						} ?>
					</div>
					<?php } else { ?>
						<div class="list-element first">
							<?php if (count(website::getSpecificWebsitePageDetails(1, isset($_GET['lang_id']) ? $_GET['lang_id'] : 1)) != 0) { ?>
								<a class="published-1" href="?tab=webpage_editor&action=edit_page_details&page_id=1<?= (isset($_GET['lang_id'])) ? '&lang_id='.$_GET['lang_id'] : '' ?>">
									<?= $page['page_title'] ?>
								</a>
							<?php } else { ?>
								<a href="Controllers/Website/Page/website_create_page_details.php?page_id=1<?= (isset($_GET['lang_id'])) ? '&lang_id='.$_GET['lang_id'] : '' ?>">
									<?= $page['page_title'] ?>
								</a>
							<?php } ?>
						</div>
					<?php }
				} ?>
			</div>
		</div>
		<div class="right-side">
			<!-- website default editor -->
			<?php include "Views/CPanel/WebpageEditor/Page/tab_website_page_header_footer.php" ?>
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
	<!-- image picker sidebar -->
	<?php include "Views/CPanel/WebpageEditor/Page/tab_website_content_siderbars.php" ?>
<?php } ?>
