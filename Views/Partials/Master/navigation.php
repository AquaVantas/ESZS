<div class="navigation-desktop container-fluid">
	<div class="row">
		<div class="content-wrapper">
			<div class="left-side">
				<div class="logo-wrapper">
					<?php foreach(website::getWebsiteDefault($lang_id) as $default) {
						if($default['header_logo'] != NULL) {
							foreach(website::getWebsiteImageByID(intval($default['header_logo'])) as $image) { ?>
								<a href="/"><img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>" /></a>
							<?php }
						}
					} ?>			
				</div>
			</div>
			<div class="right-side">
				<div class="navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav ml-auto staridelaj" style="padding-right: 70px;">
						<?php foreach(website::getAllWebsitePagesPageNavigation($lang_id) as $page) { 
							if(count(website::getAllWebsitePageSubpages($page['WP_page_id'])) > 0) {
								echo printSubMenu($page['WP_page_id'], $page['WPD_page_title'], $lang_id);
							} else { ?>
								<li class="nav-item">
									<a class="nav-link" href="?lang_id=<?= $lang_id ?>&page_id=<?= $page['WP_page_id'] ?>"><?= $page['WPD_page_title'] ?></a>
								</li>
							<?php }
						} ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="navigation-mobile">
	<div class="logo">
	</div>
	<div class="hamburger-menu">
	</div>
</div>

