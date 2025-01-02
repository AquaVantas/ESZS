<section class="BlockSDPAnnouncement">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 heading">
				<div class="newstitletext">
					<h3><?= $section['WSB_block_header'] ?></h3>
				</div>
			</div>
			<div class="col-12 content">
				<div class="row">
					<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 						
						if($blockContent['WBC_image_id'] != NULL) {
							foreach(website::getWebsiteImageByID(intval($blockContent['WBC_image_id'])) as $image) { ?>
								<div class="col-12 banner">
									<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
								</div>
							<?php 
							}					
						} ?>
						<div class="col-12 text">
							<?= $blockContent['WBC_block_text'] ?>
						</div>
						<div class="available-games col-12">
							<h1><?= $blockContent['WBC_block_heading'] ?></h1>
							<div class="row">
								<?php foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {						
									if($button['WBCB_image_id'] != NULL) {
										foreach(website::getWebsiteImageByID(intval($button['WBCB_image_id'])) as $image) { ?>
											<div class="col-2 game">
												<?php if($button['WBCB_button_title'] != "closed") {
													if($button['WBCB_button_link'] != NULL || $button['WBCB_button_link'] != "") { ?>
														<a href="<?= $button['WBCB_button_link'] ?>">
															<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
														</a>
													<?php }
													else { ?>
														<a href="<?= makeTheLinkPath($lang_id, $button['WBCB_page_id'], null) ?>">
															<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
														</a>
													<?php }
												} else { ?>
													<a class="link-closed">
														<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
													</a>
												<?php } ?>
											</div>
										<?php 
										}					
									}						
								} ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>