<section class="BlockAboutUsShort">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 col-12 wrapper">
				<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
					if($blockContent['WBC_image_id'] != NULL) {
						foreach(website::getWebsiteImageByID(intval($blockContent['WBC_image_id'])) as $image) { ?>						
							<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>"/>
						<?php }					
					} ?>
					<h2><?= $section['WSB_block_header'] ?></h2>
					<div class="about-us">
						<?= $section['WSB_block_rich_text'] ?>
					</div>
					<?php foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {
						if($button['WBCB_page_id'] == NULL || $button['WBCB_page_id'] == 0) { ?>
							<a class="btn btn-primary" href="<?= $button['WBCB_button_link'] ?>"><?= $button['WBCB_button_title'] ?></a>
						<?php } else { ?>
							<a class="btn btn-primary" href="<?= makeTheLinkPath($lang_id, $button['WBCB_page_id'], null) ?>"><?= $button['WBCB_button_title'] ?></a>
						<?php }
					}
				}
				?>				
			</div>
		</div>
	</div>
</section>