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
				if($blockContent['WBC_image_id'] != NULL) { ?>
						<div class="col-lg-2 col-4">
							<div class="file-wrapper">
								<img src="Content/Images/Icons/pdf.svg" alt="pdf_file">
								<h4><?= $blockContent['WBC_block_heading'] ?></h4>
								<p><?= $blockContent['WBC_block_subheading'] ?></p>
								<?php foreach(website::getWebsiteImageByID(intval($blockContent['WBC_image_id'])) as $image) { ?>						
									<a class="btn btn-primary" href="<?= $image['image_path'] ?>" target="_blank">
										PRENESI
									</a>
								<?php } ?>
							</div>
						</div>
					<?php }		
			} ?>				
		</div>
	</div>
</section>