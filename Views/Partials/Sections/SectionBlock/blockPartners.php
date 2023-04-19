<section class="BlockPartners">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 heading">
				<div class="line">
				</div>
				<h3><?= $section['WSB_block_header'] ?></h3>
				<div class="line">
				</div>
			</div>
			<div class="col-lg-10 offset-lg-1 partner-list">
				<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
					foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {						
						if($button['WBCB_image_id'] != NULL) {
							foreach(website::getWebsiteImageByID(intval($button['WBCB_image_id'])) as $image) { 						
								if($button['WBCB_page_id'] == NULL || $button['WBCB_page_id'] == 0) { ?>
									<a class="partner" href="<?= $button['WBCB_button_link'] ?>">
										<img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
									</a>
								<?php } else { ?>
									<a class="partner" href="?page_id=<?= $button['WBCB_page_id'] ?>&lang_id=<?= $lang_id ?>">
										<img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>">
									</a>
								<?php }
							}					
						}						
					 }
				} ?>				
			</div>
		</div>
	</div>
</section>