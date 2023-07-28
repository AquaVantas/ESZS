<?php if((isset($cpanel_tab) && $cpanel_tab == "webpage_editor") && (isset($cpanel_action) && $cpanel_action == "edit_page_details") && (isset($_GET['page_id']))) { 
$page_details_id = 0;	
?>
	<div class="user-body">
		<div class="row">
			<div class="create-user">
				<form class="row" method="post" action="Controllers/Website/Page/website_edit_page_details.php?page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>">
					<?php foreach(website::getSpecificWebsitePageDetails($_GET['page_id'], (isset($_GET['lang_id'])) ? $_GET['lang_id'] : 1) as $page) { 
							$page_details_id = $page['page_detail_id'];
						?>
						<div class="col-12">
							<div class="edit-cloud publish-bubble">
								<label for="page_title">Objavljena:</label><br>
								<input type="checkbox" id="page_published" name="page_published" <?= ($page['page_published']) == 1 ? 'checked' : '' ?>>
							</div>	
						</div>
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
									foreach(website::getWebsiteSections($page_details_id) as $page_section) { 
										if($page_section['variant_id'] == 1) { 
											foreach(website::getWebsiteSectionBlocks($page_section['section_id']) as $section) { ?>
												<div class="accordion-item">
													<h2 class="accordion-header" id="headingTwo">
														<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $counter ?>" aria-expanded="false" aria-controls="collapse<?= $counter ?>">
															<div class="header-left-side">
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
															</div>
															<div class="actions-wrapper">
																<div class="up-down-arrows">
																	<a class="up-arrow" href="Controllers/Website/Page/website_move_section.php?move_direction=up&page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>&section_id=<?= $page_section['section_id'] ?>&page_detail_id=<?= $page_details_id ?>">
																		<img src="Content/Images/Icons/arrow-down.svg">
																	</a>
																	<a class="down-arrow" href="Controllers/Website/Page/website_move_section.php?move_direction=down&page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>&section_id=<?= $page_section['section_id'] ?>&page_detail_id=<?= $page_details_id ?>">
																		<img src="Content/Images/Icons/arrow-down.svg">
																	</a>
																</div>
																<a class="delete" href="Controllers/Website/Page/website_delete_section.php?section_id=<?= $section['WS_section_id'] ?>&variant_id=<?= $section['WS_variant_id'] ?>&page_id=<?= $_GET['page_id'] ?>&lang_id=<?= $lang_id ?>">
																	<img src="Content/Images/Icons/plus.svg"></img>
																</a>
															</div>
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
																				<div class="accordion-item block-content-item">
																					<h2 class="accordion-header" id="headingTwo">
																						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInner<?= $counter ?><?= $innerCounter ?>" aria-expanded="false" aria-controls="collapseInner<?= $counter ?><?= $innerCounter ?>">
																							<?php if(strlen($blockContent['WBC_block_heading']) == 0) { ?>
																								<span>Block Content</span>
																							<?php } else { ?>
																								<span><?= $blockContent['WBC_block_heading'] ?></span>
																							<?php } ?>
																							<div class="actions-wrapper">
																								<div class="up-down-arrows">
																									<a class="up-arrow" href="Controllers/Website/Page/website_move_block_content.php?move_direction=up&page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>&section_id=<?= $section['WSB_section_block_id'] ?>&block_content_id=<?= $blockContent['WBC_block_content_id'] ?>">
																										<img src="Content/Images/Icons/arrow-down.svg">
																									</a>
																									<a class="down-arrow" href="Controllers/Website/Page/website_move_block_content.php?move_direction=down&page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>&section_id=<?= $section['WSB_section_block_id'] ?>&block_content_id=<?= $blockContent['WBC_block_content_id'] ?>">
																										<img src="Content/Images/Icons/arrow-down.svg">
																									</a>
																								</div>
																								<a class="delete" href="Controllers/Website/Page/website_delete_block_content.php?page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>&section_id=<?= $section['WS_section_id'] ?>&block_content_id=<?= $blockContent['WBC_block_content_id'] ?>">
																									<img src="Content/Images/Icons/plus.svg"></img>
																								</a>
																							</div>
																						</button>
																					</h2>
																					<div id="collapseInner<?= $counter ?><?= $innerCounter ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $counter ?><?= $innerCounter ?>" data-bs-parent="#accordionBlockContent">
																						<div class="accordion-body" block-id="<?= $blockContent['WBC_block_content_id'] ?>" sequence-num="<?= $blockContent['WBC_sequence_num'] ?>">
																							<div class="row">
																								<div class="col-2 label">																
																									<label for="block-content-image">Slika bloka:</label><br>
																								</div>
																								<div class="col-10">
																									<div class="add-image-wrapper" id="block-content-image" chosen-image-id="<?= $blockContent['WBC_image_id'] ?>" onclick="openFileSelector(<?= $blockContent['WBC_block_content_id'] ?>, 'blockContent')">
																										<?php if($blockContent['WBC_image_id'] != NULL) { ?>								
																											<?php foreach(website::getWebsiteImageByID(intval($blockContent['WBC_image_id'])) as $image) { ?>														
																												<img class="non-empty" src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>" />
																											<?php } ?>
																											<div class="remove-image" onClick="deleteThisImage(this)">
																												<img src="Content/Images/Icons/plus.svg">
																											</div>
																										<?php } else { ?>		
																										<div class="image-empty">																																															
																											<img src="Content/Images/Icons/plus.svg">																									
																										</div>
																										<?php } ?>
																									</div>
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
																								<div class="col-10 section-block-content-buttons">
																									<div class="accordion" id="accordionBlockContentButtons">
																									<div class="<?=$blockContent['WBC_block_content_id']?>"></div>
																									<?php $innerButtonCounter = 0; 
																									foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $blockContentButton) { ?>
																										<div class="accordion-item block-content-button-item">
																											<h2 class="accordion-header" id="headingTwo">
																												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInner<?= $counter ?><?= $innerCounter ?><?= $innerButtonCounter ?>" aria-expanded="false" aria-controls="collapseInner<?= $counter ?><?= $innerCounter ?><?= $innerButtonCounter ?>">
																													<?php if(strlen($blockContentButton['WBCB_button_title']) == 0) { ?>
																														<span>Button</span>																												
																													<?php } else { ?>
																														<span><?= $blockContentButton['WBCB_button_title'] ?></span>
																													<?php } ?>
																													<div class="actions-wrapper">
																														<div class="up-down-arrows">
																															<a class="up-arrow" href="Controllers/Website/Page/website_move_button.php?move_direction=up&page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>&button_id=<?= $blockContentButton['WBCB_button_id'] ?>&block_content_id=<?= $blockContent['WBC_block_content_id'] ?>">
																																<img src="Content/Images/Icons/arrow-down.svg">
																															</a>
																															<a class="down-arrow" href="Controllers/Website/Page/website_move_button.php?move_direction=down&page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>&button_id=<?= $blockContentButton['WBCB_button_id'] ?>&block_content_id=<?= $blockContent['WBC_block_content_id'] ?>">
																																<img src="Content/Images/Icons/arrow-down.svg">
																															</a>
																														</div>
																														<a class="delete" href="Controllers/Website/Page/website_delete_button.php?page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>&button_id=<?= $blockContentButton['WBCB_button_id'] ?>&block_content_id=<?= $blockContent['WBC_block_content_id'] ?>">
																															<img src="Content/Images/Icons/plus.svg">
																														</a>
																													</div>
																												</button>
																											</h2>
																											<div id="collapseInner<?= $counter ?><?= $innerCounter ?><?= $innerButtonCounter ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $counter ?><?= $innerCounter ?><?= $innerButtonCounter ?>" data-bs-parent="#accordionBlockContentButtons">
																												<div class="accordion-body" button-id="<?= $blockContentButton['WBCB_button_id'] ?>" sequence-num="<?= $blockContent['WBC_sequence_num'] ?>">
																													<div class="row">
																														<div class="col-2 label">																
																															<label for="button-image">Slika bloka:</label><br>
																														</div>
																														<div class="col-10">
																															<div class="add-image-wrapper" id="button-image" chosen-image-id="<?= $blockContentButton['WBCB_image_id'] ?>" onclick="openFileSelector(<?= $blockContentButton['WBCB_button_id'] ?>, 'buttonContent')">
																																<?php if($blockContentButton['WBCB_image_id'] != NULL) { ?>								
																																	<?php foreach(website::getWebsiteImageByID(intval($blockContentButton['WBCB_image_id'])) as $image) { ?>														
																																		<img class="non-empty" src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>" />
																																	<?php } ?>
																																<?php } else { ?>		
																																<div class="image-empty">																																															
																																	<img src="Content/Images/Icons/plus.svg"></img>																									
																																</div>
																																<?php } ?>
																															</div>
																														</div>
																														<div class="col-2 label">																
																															<label for="button-heading">Naslov gumba:</label><br>
																														</div>
																														<div class="col-10">
																															<input type="text" id="button-heading" name="button-heading" value="<?= $blockContentButton['WBCB_button_title'] ?>">
																														</div>
																														<div class="col-2 label">																
																															<label for="button-link">Povezava gumba:</label><br>
																														</div>
																														<div class="col-5">
																															<input type="text" id="button-link" name="button-link" value="<?= $blockContentButton['WBCB_button_link'] ?>">
																														</div>
																														<div class="col-2 label">																
																															<label for="button-anchor">Sidro povezave:</label><br>
																														</div>
																														<div class="col-3">
																															<input type="text" id="button-anchor" name="button-anchor" value="<?= $blockContentButton['WBCB_query_string'] ?>">
																														</div>
																														<div class="col-2 label">																
																															<label for="button-link-heading">Naslov povezave:</label><br>
																														</div>
																														<div class="col-10">
																															<input type="text" id="button-link-heading" name="button-link-heading" value="<?= $blockContentButton['WBCB_link_title'] ?>">
																														</div>
																														<div class="col-2 label">																
																															<label for="button-page-link">Povezave strani:</label><br>
																														</div>
																														<div class="col-10">
																															<div class="page-list-wrapper">
																																<?php foreach(website::getAllWebsitePages() as $page) { ?>
																																	<div class="a-page">
																																		<div class="option">
																																			<input type="checkbox" id="<?= $page['page_id'] ?>" name="<?= $page['page_id'] ?>" value="<?= $page['page_id'] ?>" <?= ($blockContentButton['WBCB_page_id'] == $page['page_id']) ? 'checked' : '' ?>>
																																			<label for="<?= $page['page_id'] ?>"> <?= $page['page_title'] ?></label>
																																		</div>
																																		<?php if(sizeof(website::getAllWebsitePageSubpages($page['page_id'])) > 0) {
																																			echo printButtonSubmenu($page['page_id'], 3, $blockContentButton['WBCB_page_id']);
																																		} ?>
																																	</div>
																																<?php } ?>
																															</div>
																														</div>
																														<div class="col-2 label">																
																															<label for="button-target">Odpre novo okno:</label><br>
																														</div>
																														<div class="col-10">
																															<input type="checkbox" id="button-target" name="button-target" value="button-target" <?= (intval($blockContentButton['WBCB_target']) == 1) ? 'checked' : '' ?>>
																														</div>
																													</div>
																												</div>
																											</div>
																										</div>
																									<?php $innerButtonCounter = $innerButtonCounter + 1; 
																									}																							
																									?>
																									</div>
																									<a class="add-block-content" href="Controllers/Website/Page/website_create_button.php?page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>&section_block_id=<?= $section['WSB_section_block_id'] ?>&block_content_id=<?= $blockContent['WBC_block_content_id'] ?>&button_type=block_content">
																										<span>Dodaj gumb</span><div class="plus-icon"></div>
																									</a>
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
																		<div class="dropdown template-dropdown" id="section-template" template-id="<?= $section['WSB_block_template_id'] ?>">
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
																						<li><a template-id="<?= $blockTemplate['block_template_id'] ?>" class="nav-link <?= ($section['WSB_block_template_id'] == $blockTemplate['block_template_id']) ? "active" : ""?>" onclick="setTemplateTitle(this)"><?= $blockTemplate['template_name']?></a></li>
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
											}
										}
										if($page_section['variant_id'] == 2) { 
											foreach(website::getWebsiteSectionForm($page_section['section_id']) as $section) { ?>
												<div class="accordion-item">
													<h2 class="accordion-header" id="headingTwo">
														<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $counter ?>" aria-expanded="false" aria-controls="collapse<?= $counter ?>">
															<div class="header-left-side">
																<?php if($section['WSF_section_name'] == NULL || strlen($section['WSF_section_name']) == 0) { ?>
																	Section Form
																<?php } else { ?>
																	<?= $section['WSF_form_header'] ?>
																<?php }?>
															</div>
															<div class="actions-wrapper">
																<div class="up-down-arrows">
																	<a class="up-arrow" href="Controllers/Website/Page/website_move_section.php?move_direction=up&page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>&section_id=<?= $page_section['section_id'] ?>&page_detail_id=<?= $page_details_id ?>">
																		<img src="Content/Images/Icons/arrow-down.svg">
																	</a>
																	<a class="down-arrow" href="Controllers/Website/Page/website_move_section.php?move_direction=down&page_id=<?= $_GET['page_id'] ?><?= isset($_GET['lang_id']) ? '&lang_id=' . $_GET['lang_id'] : ''?>&section_id=<?= $page_section['section_id'] ?>&page_detail_id=<?= $page_details_id ?>">
																		<img src="Content/Images/Icons/arrow-down.svg">
																	</a>
																</div>
																<a class="delete" href="Controllers/Website/Page/website_delete_section.php?section_id=<?= $section['WS_section_id'] ?>&variant_id=<?= $section['WS_variant_id'] ?>&page_id=<?= $_GET['page_id'] ?>&lang_id=<?= $lang_id ?>">
																	<img src="Content/Images/Icons/plus.svg"></img>
																</a>
															</div>
														</button>
													</h2>
													<div id="collapse<?= $counter ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $counter ?>" data-bs-parent="#accordionExample">
														<div class="accordion-body" form-id="<?= $section['WSF_section_form_id'] ?>" variant-id="<?= $section['WS_variant_id'] ?>" section-id="<?= $section['WS_section_id'] ?>">
															<?php if($section['WS_variant_id'] == 2) { ?>															
																<div class="section-block-info row" section-id="<?= $section['WS_section_id'] ?>">
																	<div class="col-2 label">																
																		<label for="form-image">Slika bloka:</label><br>
																	</div>
																	<div class="col-10">
																		<div class="add-image-wrapper" id="form-image" chosen-image-id="<?= $section['WSF_image_id'] ?>" onclick="openFileSelector(<?= $section['WSF_section_form_id'] ?>, 'sectionForm')">
																			<?php if($section['WSF_image_id'] != NULL) { ?>								
																				<?php foreach(website::getWebsiteImageByID(intval($section['WSF_image_id'])) as $image) { ?>														
																					<img class="non-empty" src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>" />
																				<?php } ?>
																			<?php } else { ?>		
																			<div class="image-empty">																																															
																				<img src="Content/Images/Icons/plus.svg"></img>																									
																			</div>
																			<?php } ?>
																		</div>
																	</div>
																	<div class="col-2 label">																
																		<label for="section-name">Ime sekcije:</label><br>
																	</div>
																	<div class="col-10">
																		<input type="text" id="section-name" name="section-name" value="<?= $section['WSF_section_name'] ?>">
																	</div>
																	<div class="col-2 label">
																		<label for="section-class">Class sekcije:</label><br>
																	</div>
																	<div class="col-10">
																		<input type="text" id="section-class" name="section-class" value="<?= $section['WSF_section_class'] ?>">
																	</div>
																	<div class="col-2 label">
																		<label for="section-header">Naslov sekcije:</label><br>
																	</div>
																	<div class="col-10">
																		<input type="text" id="section-header" name="section-header" value="<?= $section['WSF_form_header'] ?>">
																	</div>
																	<div class="col-2 label">
																		<label for="section-subheader">Podnaslov sekcije:</label><br>
																	</div>
																	<div class="col-10">
																		<input type="text" id="section-subheader" name="section-subheader" value="<?= $section['WSF_form_subheader'] ?>">
																	</div>
																	<div class="col-2 label">
																		<label for="form-receivers">Prejemniki obrazca:</label><br>
																	</div>																	
																	<div class="col-10">
																		<input type="text" id="form-receivers" name="form-receivers" value="<?= $section['WSF_form_receivers'] ?>">
																	</div>
																	<div class="col-2 label">
																		<label for="section-template">Template sekcije:</label><br>
																	</div>
																	<div class="col-10">
																		<div class="dropdown template-dropdown" id="section-template" template-id="<?= $section['WSF_form_template_id'] ?>">
																			<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
																				<?php																			
																					foreach(website::getWebsiteFormSectionTemplate($section['WSF_section_form_id']) as $template) {
																						?><?= $template['WSFT_template_name'] ?>
																					<?php }
																				?>
																				<div class="arrow"></div>
																			</button>
																			<ul class="dropdown-menu">
																				<li></li>
																				<?php
																					foreach(website::getAllWebsiteFormSectionTemplate() as $sectionTemplate) {?>
																						<li><a template-id="<?= $sectionTemplate['form_template_id'] ?>" class="nav-link <?= ($section['WSF_form_template_id'] == $sectionTemplate['form_template_id']) ? "active" : ""?>" onclick="setTemplateTitle(this)"><?= $sectionTemplate['template_name']?></a></li>
																					<?php }
																				?>
																			</ul>
																		</div>
																	</div>
																</div>
															<?php } ?>
														</div>
													</div>
												</div>
											<?php 
											}
										}
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