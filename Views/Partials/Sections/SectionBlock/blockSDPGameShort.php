<section class="BlockSDPGameShort">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 heading">
				<div class="newstitletext">
					<h3><?= $section['WSB_block_header'] ?></h3>
				</div>
			</div>
			<div class="col-lg-10 content">
				<div class="row">
					<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) {
						$class = $blockContent['WBC_block_link'];
						if($blockContent['WBC_image_id'] != NULL) {
							foreach(website::getWebsiteImageByID(intval($blockContent['WBC_image_id'])) as $image) { ?>
								<div class="col-12 banner">
									<img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
								</div>
							<?php 
							}					
						} ?>
						<div class="col-12 text">
							<?= $blockContent['WBC_block_text'] ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-lg-2 banners">
				<?php if($class != NULL && $class != "") {
					$counter = 0;
					foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) {
						$class = $blockContent['WBC_block_link'];
						foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {
							if($button['WBCB_image_id'] != NULL) {
								foreach(website::getWebsiteImageByID(intval($button['WBCB_image_id'])) as $image) { ?>
									<?php if($counter != 1) { ?>
										<img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
									<?php } 
								}					
							}
							if($counter == 1) { ?>
							<div>
								<div class="line"></div>
								<span class="bold"><?= $button['WBCB_button_title'] ?> </span><span class="normal"><?= $button['WBCB_button_link'] ?></span>
								<div class="line"></div>								
								<span class="bold"><?= $button['WBCB_query_string'] ?></span>
							</div>
							<?php }
							$counter++;
						} 
					}
				} ?>
			</div>
		</div>
	</div>
</section>