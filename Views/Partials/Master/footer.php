<?php if($page_id != 1) { ?>
	<section class="BlockOtherSocials">
		<div class="container">
			<div class="row">
				<div class="col-12 socials-list">
					<div class="line">
					</div>
					<?php foreach(website::getWebsiteFooterSocials($lang_id) as $social) {
						foreach(website::getWebsiteButtonByID($social['button_id']) as $button) {
							if($button['WBCB_image_id'] != NULL) {
								foreach(website::getWebsiteImageByID(intval($button['WBCB_image_id'])) as $image) { 						
									if($button['WBCB_page_id'] == NULL || $button['WBCB_page_id'] == 0) { ?>
										<a class="partner" href="<?= $button['WBCB_button_link'] ?>">
											<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
										</a>
									<?php } else { ?>
										<a class="partner" href="<?= makeTheLinkPath($lang_id, $button['WBCB_page_id'], null) ?>">
											<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
										</a>
									<?php }
								}					
							}
						}
					}
					?>
					<div class="line">
					</div>
				</div>
			</div>
		</div>
	</section>
<?php } ?>
<footer>
	<div class="container">
		<div class="row">
			<div class="col-2 about">
				<?php foreach(website::getWebsiteDefault($lang_id) as $footer) { ?>
					<span><?= $footer['footer_about'] ?></span>
				<?php } ?>
			</div>
			<div class="col-2 links">
				<span class="footer-link-title">Povezave</span>
				<?php foreach(website::getWebsiteFooterLink($lang_id) as $link) {
					foreach(website::getWebsiteButtonByID($link['button_id']) as $button) { ?>
						<a href="<?= makeTheLinkPath($lang_id, $button['WBCB_page_id'], null) ?>"><?= $button['WBCB_button_title'] ?></a>
				<?php }
				} ?>
			</div>
			<?php foreach(website::getWebsiteFooterImages($lang_id) as $button) {
				foreach(website::getWebsiteButtonByID(intval($button['button_id'])) as $button_image) { 
					foreach(website::getWebsiteImageByID(intval($button_image['WBCB_image_id'])) as $image) {?>
						<div class="col-2 footer-image-wrapper <?= $button_image['WBCB_button_title'] ?>">
							<a href="<?= $button_image['WBCB_button_link'] ?>">
								<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>" />
							</a>
						</div>
					<?php }					
				}
			} ?>
		</div>
	</div>
	<div class="footer-last-container">
		<div class="container">
			<div class="row">
				<div class="col-6">
					<?php foreach(website::getWebsiteDefault($lang_id) as $footer) {
						if($footer['footer_logo'] != NULL) {
							foreach(website::getWebsiteImageByID(intval($footer['footer_logo'])) as $image) { ?>
								<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>" />
							<?php }
						}
					} ?>
				</div>
				<div class="col-6 copyright">
					<?php foreach(website::getWebsiteDefault($lang_id) as $footer) { ?>
						<span><?= $footer['footer_copyright'] ?></span>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</footer>