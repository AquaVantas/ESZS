<div class="navigation-desktop container-fluid">
	<div class="row">
		<div class="content-wrapper">
			<div class="left-side">
				<div class="logo-wrapper">
				</div>
			</div>
			<div class="right-side">
				<div class="navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav ml-auto staridelaj" style="padding-right: 70px;">
						<?php foreach(website::getAllWebsitePages() as $page) { 
						if(count(website::getAllWebsitePageSubpages($page['page_id'])) > 0) {
							echo printSubMenu($page['page_id'], $page['page_title']);
						} else { ?>
							<li class="nav-item">
								<a class="nav-link" href=""><?= $page['page_title'] ?></a>
							</li>
						<?php }
						} ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

