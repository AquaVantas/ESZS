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
		</div>
	</div>
</section>