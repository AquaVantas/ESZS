<section class="BlockSDPGameFileDownload">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 heading">
				<h3><?= $section['WSB_block_header'] ?></h3>
			</div>
			<div class="col-12 col-lg-10 document-list">
				<div class="row">
					<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 					
						if($blockContent['WBC_image_id'] != NULL) {
							foreach(website::getWebsiteImageByID(intval($blockContent['WBC_image_id'])) as $image) { ?>				
								<div class="wrapper">
									<div class="document-sdp">
										<div class="document-wrapper">
											<div class="image-and-text">
												<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?>Content/Images/Icons/pdf.svg">
												<p><?= $blockContent['WBC_block_heading'] ?></p>
											</div>
											<a href="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" target="_blank">
												Preberi več
											</a>
										</div>
									</div>
								</div>
							<?php }					
						}
					} ?>
				</div>
			</div>			
		</div>
	</div>
</section>