<section class="BlockHighlightedNews">
	<div class="highlight-news-swiper swiper">
		<div class="swiper-wrapper">
			<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
				if($blockContent['WBC_image_id'] != NULL) {
					foreach(website::getWebsiteImageByID(intval($blockContent['WBC_image_id'])) as $image) { ?>
						<div class="swiper-slide" style="background-image: url('<?= $image['image_path'] ?>')">
							<div class="content-wrapper">
								<div class="colors">
								</div>
								<div class="container">
									<div class="row">
										<div class="col-lg-6 col-12">
											<div class="content">
												<h2><?= $blockContent['WBC_block_heading'] ?></h2>
												<div class="short-text">
													<?= $blockContent['WBC_block_text'] ?>
												</div>
												<?php foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {
													if($button['WBCB_page_id'] == NULL || $button['WBCB_page_id'] == 0) { ?>
														<a class="btn btn-primary" href="<?= $button['WBCB_button_link'] ?>"><?= $button['WBCB_button_title'] ?></a>
													<?php } else { ?>
														<a class="btn btn-primary" href="?page_id=<?= $button['WBCB_page_id'] ?>&lang_id=<?= $lang_id ?>"><?= $button['WBCB_button_title'] ?></a>
													<?php }
												} ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php }					
				}
			} ?>
		</div>
	</div>	
</section>