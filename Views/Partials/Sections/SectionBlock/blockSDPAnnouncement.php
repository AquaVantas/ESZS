<section class="BlockMembers">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 heading">
				<div class="line">
				</div>
				<h3><?= $section['WSB_block_header'] ?></h3>
				<div class="line">
				</div>
			</div>
			<div class="col-12 member-list">
				<div class="row">
					<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
						foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {						
							if($button['WBCB_image_id'] != NULL) {
								foreach(website::getWebsiteImageByID(intval($button['WBCB_image_id'])) as $image) { 						
									if($button['WBCB_page_id'] == NULL || $button['WBCB_page_id'] == 0) { ?>
										<div class="col-lg-2">
											<a class="partner" href="<?= $button['WBCB_button_link'] ?>">
												<img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
											</a>
										</div>
									<?php } else { ?>
										<div class="col-lg-2">
											<a class="partner" href="?page_id=<?= $button['WBCB_page_id'] ?>&lang_id=<?= $lang_id ?>">
												<img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
											</a>
										</div>
									<?php }
								}					
							}						
						}
					} ?>
				</div>
			</div>
		</div>
	</div>
</section>