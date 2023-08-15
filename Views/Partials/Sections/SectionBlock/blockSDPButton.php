<section class="BlockSDPButton">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
					foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {						
						if($button['WBCB_page_id'] == NULL || $button['WBCB_page_id'] == 0) { 
							if($button['WBCB_target'] == 1) { ?>
								<a class="partner" href="<?= $button['WBCB_button_link'] ?>" target="_blank">
									Prijavi se
								</a>
							<?php } else { ?>
								<a class="partner" href="<?= $button['WBCB_button_link'] ?>">
									Prijavi se
								</a>
							<?php }									
						} else { 
							if($button['WBCB_target'] == 1) { ?>
								<a class="partner" href="?page_id=<?= $button['WBCB_page_id'] ?>&lang_id=<?= $lang_id ?>" target="_blank">
									Prijavi se
								</a>
							<?php } else { ?>
								<a class="partner" href="?page_id=<?= $button['WBCB_page_id'] ?>&lang_id=<?= $lang_id ?>">
									Prijavi se
								</a>
							<?php }
						}		
					 }
				} ?>				
			</div>
		</div>
	</div>
</section>