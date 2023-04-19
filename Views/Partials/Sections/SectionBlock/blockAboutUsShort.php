<section class="BlockAboutUsShort">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
					if($blockContent['WBC_image_id'] != NULL) {
						foreach(website::getWebsiteImageByID(intval($blockContent['WBC_image_id'])) as $image) { ?>						
							<img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>"/>
						<?php }					
					}
				 }
				?>
				<h2><?= $section['WSB_block_header'] ?></h2>
				<div class="about-us">
					<?= $section['WSB_block_rich_text'] ?>
				</div>
			</div>
		</div>
	</div>
</section>