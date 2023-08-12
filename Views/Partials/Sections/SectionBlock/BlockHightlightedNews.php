<section class="BlockHighlightedNews">
	<div class="highlight-news-swiper swiper">
		<div class="swiper-wrapper">
			<?php foreach(news::getArticlesHighlighted() as $highlighted) { ?>
				<div class="swiper-slide" style="background-image: url('<?= $highlighted['news_article_preview_image'] ?>')">
					<div class="content-wrapper">
						<div class="container">
							<div class="row">
								<div class="col-lg-6 col-12">
									<div class="content">
										<h2><?= $highlighted['news_article_title'] ?></h2>
										<div class="short-text">
											<?= $highlighted['news_article_description'] ?>
										</div>
										<?= $highlighted['news_article_content'] ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>			
			<?php } ?>
		</div>
	</div>
	<div class="scores">		
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<?php $counter = 0;
				foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
					if($blockContent['WBC_block_link'] == "pagelinkblock") {
						foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) { 
							if($counter == 0) { ?>
								<a class="nav-item nav-link active" id="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>-tab" data-toggle="tab" href="#nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>" role="tab" aria-controls="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>" aria-selected="true"><?= $button['WBCB_button_title'] ?></a>				
							<?php } else { ?>
								<a class="nav-item nav-link" id="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>-tab" data-toggle="tab" href="#nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>" role="tab" aria-controls="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>" aria-selected="true"><?= $button['WBCB_button_title'] ?></a>				
							<?php }							
						$counter++;
						}
					}				
				} ?>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<?php $counter = 0;
			foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
				if($blockContent['WBC_block_link'] == "pagelinkblock") {
					foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) { 
						if($counter == 0) { ?>
							<div class="tab-pane fade show active" id="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>" role="tabpanel" aria-labelledby="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>-tab">
							<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
								if($blockContent['WBC_block_link'] == "results") { ?>
									<div class="match-wrapper">
										<?php $counter = 0;
										foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) { 
											if($counter == 0) { ?>
												<div class="contestant left-contestant">
													<?php if($button['WBCB_image_id'] != NULL) {
														foreach(website::getWebsiteImageByID(intval($button['WBCB_image_id'])) as $image) { ?>						
															<div class="logo" style="background-image: url('<?= $image['image_path'] ?>')"></div>
														<?php }					
													} ?>
													<div class="name">
														<span><?= $button['WBCB_button_title'] ?></span>
													</div>
												</div>
											 <?php }
											 $counter = $counter + 1;
										} ?>							
										<div class="middle-block">
											<div class="match-title"><span><?= $blockContent['WBC_block_heading'] ?></span></div>
											<a class="match-score btn btn-primary"><?= $blockContent['WBC_block_subheading'] ?></a>
										</div>
										<?php $counter = 0;
										foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) { 
											if($counter == 1) { ?>
												<div class="contestant right-contestant">										
													<?php if($button['WBCB_image_id'] != NULL) {
														foreach(website::getWebsiteImageByID(intval($button['WBCB_image_id'])) as $image) { ?>						
															<div class="logo" style="background-image: url('<?= $image['image_path'] ?>')"></div>
														<?php }					
													} ?>
													<div class="name">
														<span><?= $button['WBCB_button_title'] ?></span>
													</div>
												</div>
											 <?php }
											 $counter = $counter + 1;
										} ?>
									</div>
								<?php }				
							} ?>
							</div>				
						<?php } else { ?>
							<div class="tab-pane fade" id="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>" role="tabpanel" aria-labelledby="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>-tab">
								<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
									if($blockContent['WBC_block_link'] == "upcoming") { ?>
										<div class="match-wrapper upcoming">
											<?php $counter = 0;
											foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) { 
												if($counter == 0) { ?>
													<div class="contestant left-contestant">
														<?php if($button['WBCB_image_id'] != NULL) {
															foreach(website::getWebsiteImageByID(intval($button['WBCB_image_id'])) as $image) { ?>						
																<div class="logo" style="background-image: url('<?= $image['image_path'] ?>')"></div>
															<?php }					
														} ?>
														<div class="name">
															<span><?= $button['WBCB_button_title'] ?></span>
														</div>
													</div>
												 <?php }
												 $counter = $counter + 1;
											} ?>							
											<div class="middle-block">
												<div class="match-title"><span><?= $blockContent['WBC_block_heading'] ?></span></div>
												<a class="match-score btn btn-primary"><?= $blockContent['WBC_block_subheading'] ?></a>
											</div>
											<?php $counter = 0;
											foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) { 
												if($counter == 1) { ?>
													<div class="contestant right-contestant">										
														<?php if($button['WBCB_image_id'] != NULL) {
															foreach(website::getWebsiteImageByID(intval($button['WBCB_image_id'])) as $image) { ?>						
																<div class="logo" style="background-image: url('<?= $image['image_path'] ?>')"></div>
															<?php }					
														} ?>
														<div class="name">
															<span><?= $button['WBCB_button_title'] ?></span>
														</div>
													</div>
												 <?php }
												 $counter = $counter + 1;
											} ?>
										</div>
									<?php }				
								} ?>
							</div>				
						<?php }							
					$counter++;
					}
				}				
			} ?>
		</div>
	</div>
</section>