<section class="BlockSDPGameAccordionRules">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 heading">
				<h3><?= $section['WSB_block_header'] ?></h3>
			</div>
			<div class="col-12 col-lg-10 rules-list">
				<div class="row">
					<div class="accordion" id="accordionExample">
					    <?php $counter = 0;
						foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { ?>
						    <div class="accordion-item">
								<h2 class="accordion-header" id="heading-<?= $counter ?>">
									<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $counter ?>" aria-expanded="true" aria-controls="collapse-<?= $counter ?>">
										<?= $blockContent['WBC_block_heading'] ?>
									</button>
								</h2>
								<div id="collapse-<?= $counter ?>" class="accordion-collapse collapse <?php if($counter == 0) { echo "show"; } ?>" aria-labelledby="heading-<?= $counter ?>" data-bs-parent="#accordionExample">
									<div class="accordion-body">
										<?= $blockContent['WBC_block_text'] ?>
									</div>
								</div>
							  </div>                      
					    <?php $counter = $counter + 1;
						} ?>                  
					</div>
				</div>
			</div>
		</div>
	</div>
</section>