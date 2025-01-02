<section class="BlockAds">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
					foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {						
						if($button['WBCB_image_id'] != NULL) {
							foreach(website::getWebsiteImageByID(intval($button['WBCB_image_id'])) as $image) { 
								echo $button['WBCB_button_link'] == "";	
								if($button['WBCB_button_link'] == "") { ?>
									<div class="partner" href="<?= $button['WBCB_button_link'] ?>" target="_blank">
										<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
									</div>
								<?php }	
								else {
									if($button['WBCB_page_id'] == NULL || $button['WBCB_page_id'] == 0) { 
										if($button['WBCB_target'] == 1) { ?>
											<a class="partner" href="<?= $button['WBCB_button_link'] ?>" target="_blank">
												<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
											</a>
										<?php } else { ?>
											<a class="partner" href="<?= $button['WBCB_button_link'] ?>">
												<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
											</a>
										<?php }									
									} else { 
										if($button['WBCB_target'] == 1) { ?>
											<a class="partner" href="<?= makeTheLinkPath($lang_id, $button['WBCB_page_id'], null) ?>" target="_blank">
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
					 }
				} ?>				
			</div>
		</div>
	</div>
</section>