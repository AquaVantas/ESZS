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
						<a href=""><?= $button['WBCB_button_title'] ?></a>
				<?php }
				} ?>
			</div>
			<div class="col-2 links">
				<span class="footer-link-title">Dokumentacije</span>
			</div>
			<?php foreach(website::getWebsiteFooterImages($lang_id) as $button) {
				foreach(website::getWebsiteButtonByID(intval($button['button_id'])) as $button_image) { 
					foreach(website::getWebsiteImageByID(intval($button_image['WBCB_image_id'])) as $image) {?>
						<div class="col-2 footer-image-wrapper">
							<img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>" />
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
								<img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>" />
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