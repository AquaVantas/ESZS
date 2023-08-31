<div class="navigation-mobile">
	<div class="logo">
		<?php foreach(website::getWebsiteDefault($lang_id) as $default) {
			if($default['header_logo'] != NULL) {
				foreach(website::getWebsiteImageByID(intval($default['header_logo'])) as $image) { ?>
					<a href="/"><img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>" /></a>
				<?php }
			}
		} ?>	
	</div>
	<div class="hamburger-menu" onclick="openMobileSidemuneHamburger(0)">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
	</div>
</div>
<?php $counter = 22;
foreach(website::getAllWebsitePagesPageNavigationMobile($lang_id) as $pageMob) { 
	if($pageMob['WP_subpage_to'] == NULL) { ?>
		<div clasS="mobile-menu-sidebar sidebar-0">
			<div class="content">
				<?php foreach(website::getAllWebsitePagesPageNavigation($lang_id) as $page) {
					if(count(website::getAllWebsitePageSubpagesPageNavigation($page['WP_page_id'], $lang_id)) > 0) { ?>
						<a class="nav-item" onclick="openMobileSidemenu(<?= $page['WP_page_id'] ?>)">
							<span><?= $page['WPD_page_title'] ?></span>
							<div class="arrow-image"></div>
						</a>
					<?php } else { ?>
						<a class="nav-item" href="?lang_id=<?= $lang_id ?>&page_id=<?= $page['WP_page_id'] ?>">
							<span><?= $page['WPD_page_title'] ?></span>
						</a>
					<?php }
				} ?>
			</div>
		</div>
	<?php } else { ?>
		<div class="mobile-menu-sidebar sidebar-<?= $pageMob['WP_subpage_to'] ?>" style="z-index: <?= $counter ?>">
			<div class="content">
				<a class="back-nav-item" onclick="openMobileSidemenu(<?= $pageMob['WP_subpage_to'] ?>)">
					<span><?php
						foreach(website::getSpecificWebsitePageDetails($pageMob['WP_subpage_to'], $lang_id) as $page) { ?>
							<?= $page['page_title'] ?>
						<?php } ?>
					</span>
					<div class="arrow-image"></div>
				</a>
				<?php foreach(website::getAllWebsitePageSubpagesPageNavigation($pageMob['WP_subpage_to'], $lang_id) as $subpage) {
					if(count(website::getAllWebsitePageSubpagesPageNavigation($subpage['WP_page_id'], $lang_id)) > 0) { ?>
						<a class="nav-item" onclick="openMobileSidemenu(<?= $subpage['WP_page_id'] ?>)">
							<span><?= $subpage['WPD_page_title'] ?></span>
							<div class="arrow-image"></div>
						</a>
					<?php } else { ?>
						<a class="nav-item" href="?lang_id=<?= $lang_id ?>&page_id=<?= $subpage['WP_page_id'] ?>">
							<span><?= $subpage['WPD_page_title'] ?></span>
						</a>
					<?php }
				} ?>
			</div>
		</div>	
	<?php 	
	$counter = $counter + 1;
	}
} ?>
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