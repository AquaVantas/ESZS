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
						<!--<div class="col-12 submit-field">
							<input class="btn btn-primary submit" type="submit" value="Posodobi stran">
						</div>-->						
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
													<?php if($section['WSB_section_name'] == NULL || strlen($section['WSB_section_name']) == 0) { 
														if($section['WS_variant_id'] == 1) { ?>
															Section Block
														<?php } elseif($section['WS_variant_id'] == 2) { ?>
															Section Gallery
														<?php } 
													} else { 
														if($section['WS_variant_id'] == 1) { ?>															
															<div class="section-block-icon"></div><?= $section['WSB_section_name'] ?>
														<?php } elseif($section['WS_variant_id'] == 2) { ?>															
															<div class="section-gallery-icon"></div><?= $section['WSB_block_header'] ?>
														<?php } 
													}?>
												</button>
											</h2>
											<div id="collapse<?= $counter ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $counter ?>" data-bs-parent="#accordionExample">
												<div class="accordion-body" variant-id="<?= $section['WS_variant_id'] ?>" section-id="<?= $section['WS_section_id'] ?>">
													<?php if($section['WS_variant_id'] == 1) { ?>															
														<div class="section-block-info row" section-id="<?= $section['WS_section_id'] ?>">
															<div class="col-2 label">																
																<label for="section-name">Ime sekcije:</label><br>
															</div>
															<div class="col-10">
																<input type="text" id="section-name" name="section-name" value="<?= $section['WSB_section_name'] ?>">
															</div>
															<div class="col-2 label">
																<label for="section-class">Class sekcije:</label><br>
															</div>
															<div class="col-10">
																<input type="text" id="section-class" name="section-class" value="<?= $section['WSB_section_class'] ?>">
															</div>
															<div class="col-2 label">
																<label for="section-header">Naslov sekcije:</label><br>
															</div>
															<div class="col-10">
																<input type="text" id="section-header" name="section-header" value="<?= $section['WSB_block_header'] ?>">
															</div>
															<div class="col-2 label">
																<label for="section-subheader">Podnaslov sekcije:</label><br>
															</div>
															<div class="col-10">
																<input type="text" id="section-subheader" name="section-subheader" value="<?= $section['WSB_block_subheader'] ?>">
															</div>
															<div class="col-2 label">
																<label for="section-block-content">Vsebina sekcije:</label><br>
															</div>
															<div class="col-10 section-block-content" id="section-block-content">
																<div class="accordion" id="accordionBlockContent">
																	<?php $innerCounter = 0;
																	foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) {?>
																		<div class="accordion-item">
																			<h2 class="accordion-header" id="headingTwo">
																				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInner<?= $counter ?><?= $innerCounter ?>" aria-expanded="false" aria-controls="collapseInner<?= $counter ?><?= $innerCounter ?>">
																					<?php if(strlen($blockContent['WBC_block_heading']) == 0) { ?>
																						Block Content
																					<?php } else { ?>
																						<?= $blockContent['WBC_block_heading'] ?>
																					<?php } ?>
																				</button>
																			</h2>
																			<div id="collapseInner<?= $counter ?><?= $innerCounter ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $counter ?><?= $innerCounter ?>" data-bs-parent="#accordionBlockContent">
																				<div class="accordion-body" block-id="<?= $blockContent['WBC_block_content_id'] ?>" sequence-num="<?= $blockContent['WBC_sequence_num'] ?>">
																					<div class="row">
																						<div class="col-2 label">																
																							<label for="block-content-image">Slika bloka:</label><br>
																						</div>
																						<div class="col-10">
																							Insert image
																						</div>
																						<div class="col-2 label">																
																							<label for="block-content-link">Link bloka:</label><br>
																						</div>
																						<div class="col-10">
																							<input type="text" id="block-content-link" name="block-content-link" value="<?= $blockContent['WBC_block_link'] ?>">
																						</div>
																						<div class="col-2 label">																
																							<label for="block-content-heading">Naslov bloka:</label><br>
																						</div>
																						<div class="col-10">
																							<input type="text" id="block-content-heading" name="block-content-heading" value="<?= $blockContent['WBC_block_heading'] ?>">
																						</div>
																						<div class="col-2 label">																
																							<label for="block-content-subheading">Podnaslov bloka:</label><br>
																						</div>
																						<div class="col-10">
																							<input type="text" id="block-content-subheading" name="block-content-subheading" value="<?= $blockContent['WBC_block_subheading'] ?>">
																						</div>
																						<div class="col-2 label">																
																							<label for="block-content-text">Besedilo bloka:</label><br>
																						</div>
																						<div class="col-10">
																							<?php include "Views/CPanel/Universal/rich_text_editor.php" ?>
																						</div>
																						<div class="col-2 label">																
																							<label for="block-content-subheading">Gumbi bloka:</label><br>
																						</div>
																						<div class="col-10">
																							Insert gumbi
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	<?php $innerCounter = $innerCounter + 1;
																	} 
																	unset($blockContent); ?>																	
																</div>
																<a class="add-block-content" href="Controllers/Website/Page/website_create_block_content.php?page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>&section_block_id=<?= $section['WSB_section_block_id'] ?>">
																	<span>Dodaj blok z vsebino</span><div class="plus-icon"></div>
																</a>
															</div>
															<div class="col-2 label">
																<label for="section-rich-text">Besedilo sekcije:</label><br>																			
															</div>
															<div class="col-10">
																<!-- rich text editor -->
																<?php include "Views/CPanel/Universal/rich_text_editor.php" ?>	
															</div>
															<div class="col-2 label">
																<label for="section-template">Template sekcije:</label><br>
															</div>
															<div class="col-10">
																<div class="dropdown template-dropdown">
																	<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
																		<?php																			
																			foreach(website::getWebsiteBlockSectionTemplate($section['WSB_section_block_id']) as $template) {
																				?><?= $template['WSBT_template_name'] ?><?php
																			}
																		?>
																		<div class="arrow"></div>
																	</button>
																	<ul class="dropdown-menu">
																		<li></li>
																		<?php
																			foreach(website::getAllWebsiteBlockSectionTemplate() as $blockTemplate) {?>
																				<li><a template-id="<?= $blockTemplate['block_template_id'] ?>" class="nav-link <?= ($section['WSB_block_template_id'] == $blockTemplate['block_template_id']) ? "active" : ""?>"><?= $blockTemplate['template_name']?></a></li>
																			<?php }
																		?>
																	</ul>
																</div>
															</div>
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
								<span>Add section</span><div class="plus-icon"></div>
							</div>							
						</div>
					</div>	
				</div>
			</div>
			<div class="col-12 submit-field">
				<input class="btn btn-primary submit" onclick="submitPageChanges(<?= $_GET['page_id'] ?>, <?= isset($_GET['lang_id']) ? $_GET['lang_id'] : 1 ?>)" type="submit" value="Posodobi stran">
			</div>
		</div>
	</div>
<?php } ?>