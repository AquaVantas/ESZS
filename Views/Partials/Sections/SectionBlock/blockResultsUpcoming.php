<section class="BlockResultsUpcoming">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 heading">
				<div class="line">
				</div>
			</div>
			<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
				if($blockContent['WBC_block_link'] == "pagelinkblock") {
					foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) { ?>					
					<div class="col-lg-6 col-12">
						<div class="title-wrapper">
							<div class="title"><?= $button['WBCB_button_title'] ?></div>
							<?php if($button['WBCB_page_id'] == NULL || $button['WBCB_page_id'] == 0) { ?>
								<a class="partner" href="<?= $button['WBCB_button_link'] ?>">
									<?= $button['WBCB_button_link'] ?>
								</a>
							<?php } else { ?>
								<a class="partner" href="?page_id=<?= $button['WBCB_page_id'] ?>&lang_id=<?= $lang_id ?>">
									<?= $button['WBCB_button_link'] ?>
								</a>
							<?php } ?>
						</div>
					</div>
				<?php }
				}				
			} ?>
			<div class="col-lg-6 col-12">
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
			<div class="col-lg-6 col-12">
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
		</div>
	</div>
</section>