<?php if((isset($cpanel_tab) && $cpanel_tab == "webpage_editor") && (isset($cpanel_action) && $cpanel_action == "edit_page_details") && (isset($_GET['page_id'])) && $_GET['page_id'] != 1) { ?>
	<div class="user-body">
		<div class="row">
			<div class="create-user">
				<form class="row" method="post" action="Controllers/Website/Page/website_edit_page_details.php?page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>">
					<?php foreach(website::getSpecificWebsitePageDetails($_GET['page_id'], (isset($_GET['lang_id'])) ? $_GET['lang_id'] : 1) as $page) { ?>
						<div class="col-12">
							<div class="edit-cloud">
								<label for="page_title">Naslov strani:</label><br>
								<input type="text" id="page_title" name="page_title" value="<?= $page['page_title'] ?>">
							</div>	
						</div>
						<div class="col-12">
							<div class="edit-cloud">
								<label for="meta_name">Meta ime:</label><br>
								<input type="text" id="meta_name" name="meta_name" value="<?= $page['meta_name'] ?>">
								<label for="meta_description">Meta opis:</label><br>
								<input type="text" id="meta_description" name="meta_description" value="<?= $page['meta_description'] ?>">
								<label for="meta_keyword">Meta ključne besede:</label><br>
								<input type="text" id="meta_keyword" name="meta_keyword" value="<?= $page['meta_keyword'] ?>">
							</div>	
						</div>
					<?php } ?>
						<div class="col-12 submit-field">
							<input class="btn btn-primary submit" type="submit" value="Posodobi stran">
						</div>								
				</form>
				<div class="col-12">
					<div class="edit-cloud">
						<div class="section-list">
							<span>Seznam sekcij:</span>
							<div class="section-list">
								<div class="accordion" id="accordionExample">
									<?php  
									$counter = 0;
									foreach(website::getWebsiteSections($_GET['page_id']) as $section) { ?>
										<div class="accordion-item">
											<h2 class="accordion-header" id="headingTwo">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $counter ?>" aria-expanded="false" aria-controls="collapse<?= $counter ?>">
													<?php if($section['WSB_block_header'] == NULL || strcmp($section['WSB_block_header'], "")) { 
														if($section['WS_variant_id'] == 1) { ?>
															Section Block
														<?php } elseif($section['WS_variant_id'] == 2) { ?>
															Section Gallery
														<?php } 
													} else { 
														if($section['WS_variant_id'] == 1) { ?>															
															<div class="section-block-icon"></div><?= $section['WSB_block_header'] ?>
														<?php } elseif($section['WS_variant_id'] == 2) { ?>															
															<div class="section-gallery-icon"></div><?= $section['WSB_block_header'] ?>
														<?php } 
													}?>
												</button>
											</h2>
											<div id="collapse<?= $counter ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $counter ?>" data-bs-parent="#accordionExample">
												<div class="accordion-body">
													<?php if($section['WS_variant_id'] == 1) { ?>															
														<div class="section-block-info">
															<label for="section-name">Ime sekcije:</label><br>
															<input type="text" id="section-name" name="section-name" value="<?= $section['WSB_section_name'] ?>">
															<label for="section-class">Class sekcije:</label><br>
															<input type="text" id="section-class" name="section-class" value="<?= $section['WSB_section_class'] ?>">
															<label for="section-header">Naslov sekcije:</label><br>
															<input type="text" id="section-header" name="section-header" value="<?= $section['WSB_block_header'] ?>">
															<label for="section-subheader">Podnaslov sekcije:</label><br>
															<input type="text" id="section-subheader" name="section-subheader" value="<?= $section['WSB_block_subheader'] ?>">
															<label for="section-rich-text">Besedilo sekcije:</label><br>																			
															<!-- rich text editor -->
															<?php include "Views/CPanel/Universal/rich_text_editor.php" ?>	
														</div>
													<?php } elseif($section['WS_variant_id'] == 2) { ?>															
														<div class="section-gallery-icon"></div><?= $section['WSB_block_header'] ?>
													<?php } ?>
												</div>
											</div>
										</div>
									<?php 
									$counter = $counter + 1;
									} ?>
								</div>
							</div>
							<div class="add-section" data-bs-toggle="modal" data-bs-target="#add-section">
								<span>Add section</span><dic class="plus-icon"></div>
							</div>							
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
<?php } ?>