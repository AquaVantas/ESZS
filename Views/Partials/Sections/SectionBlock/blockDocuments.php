<section class="BlockDocuments">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 heading">
				<div class="newstitletext">
					<h3><?= $section['WSB_block_header'] ?></h3>
				</div>
			</div>		
		</div>
		<div class="row">
			<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
				foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {						
					if($button['WBCB_image_id'] != NULL) { ?>
						<div class="col-lg-2 col-4">
							<div class="file-wrapper">
								<img src="Content/Images/Icons/pdf.svg" alt="pdf_file">
								<h4><?= $button['WBCB_button_title'] ?></h4>
								<p><?= $button['WBCB_button_link'] ?></p>
								<?php foreach(website::getWebsiteImageByID(intval($button['WBCB_image_id'])) as $image) { 						
									if($button['WBCB_page_id'] == NULL || $button['WBCB_page_id'] == 0) { 
										if($button['WBCB_target'] == 1) { ?>
											<a class="btn btn-primary" href="<?= $button['WBCB_button_link'] ?>" target="_blank">
												PRENESI
											</a>
										<?php } else { ?>
											<a class="btn btn-primary" href="<?= $button['WBCB_button_link'] ?>">
												PRENESI
											</a>
										<?php }									
									} else { 
										if($button['WBCB_target'] == 1) { ?>
											<a class="btn btn-primary" href="?page_id=<?= $button['WBCB_page_id'] ?>&lang_id=<?= $lang_id ?>" target="_blank">
												PRENESI
											</a>
										<?php } else { ?>
											<a class="btn btn-primary" href="?page_id=<?= $button['WBCB_page_id'] ?>&lang_id=<?= $lang_id ?>">
												PRENESI
											</a>
										<?php }
									}
								} ?>
							</div>
						</div>
					<?php }						
				}
			} ?>				
		</div>
	</div>
</section>