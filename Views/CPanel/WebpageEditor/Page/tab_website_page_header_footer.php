<?php if((isset($cpanel_tab) && $cpanel_tab == "webpage_editor") && (isset($cpanel_action) && $cpanel_action == "edit_page_header_footer")) { 
	if(isset($_GET['lang_id'])) {
		$lang_id = $_GET['lang_id'];
	}
	else {
		$lang_id = 1;
	}
	foreach(website::getWebsiteDefault($lang_id) as $pageDefault) {?>
	<div class="user-body">
		<div class="row">
			<div class="create-user">
				<div class="col-12">
					<div class="edit-cloud website-default row">
						<div class="col-2">
							<label for="website_title">Naslov strani:</label>
						</div>
						<div class="col-10">
							<input type="text" id="website_title" name="website_title" value="<?= $pageDefault['website_title'] ?>">
						</div>
						<div class="col-2">
							<label for="header_logo">Logo glave:</label>
						</div>
						<div class="col-10 website-header">
							<div class="add-image-wrapper" id="header_logo" chosen-image-id="<?= $pageDefault['header_logo'] ?>" onclick="openFileSelector(<?= $pageDefault['lang_id'] ?>, 'websiteDefaultHeader')">
								<?php if($pageDefault['header_logo'] != NULL) { ?>								
									<?php foreach(website::getWebsiteImageByID(intval($pageDefault['header_logo'])) as $image) { ?>														
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
						<div class="col-2">
							<label for="footer_logo">Logo noge:</label>
						</div>
						<div class="col-10 website-footer">
							<div class="add-image-wrapper" id="footer_logo" chosen-image-id="<?= $pageDefault['footer_logo'] ?>" onclick="openFileSelector(<?= $pageDefault['lang_id'] ?>, 'websiteDefaultFooter')">
								<?php if($pageDefault['footer_logo'] != NULL) { ?>								
									<?php foreach(website::getWebsiteImageByID(intval($pageDefault['footer_logo'])) as $image) { ?>														
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
						<div class="col-2">
							<label for="footer_copyright">Copyright strani:</label>
						</div>
						<div class="col-10">
							<input type="text" id="footer_copyright" name="footer_copyright" value="<?= $pageDefault['footer_copyright'] ?>">
						</div>
						<div class="col-2">
							<label for="website_title">O strani:</label>
						</div>
						<div class="col-10">
							<?php include "Views/CPanel/Universal/rich_text_editor.php" ?>
						</div>						
						<div class="col-2">
							<label for="footer_images">Slike noge:</label>
						</div>
						<div class="col-10">
							<?php $innerButtonCounter = 0; 
							foreach(website::getWebsiteFooterImages($lang_id) as $button) { 
								foreach(website::getWebsiteDefaultButton($button['button_id']) as $blockContentButton) {?>
								<div class="accordion-item block-content-button-item">
									<h2 class="accordion-header" id="headingTwo">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInnerLinks<?= $innerButtonCounter ?>" aria-expanded="false" aria-controls="collapseInnerLinks<?= $innerButtonCounter ?>">
											<?php if(strlen($blockContentButton['WBCB_button_title']) == 0) { ?>
												<span>Button</span>																												
											<?php } else { ?>
												<span><?= $blockContentButton['WBCB_button_title'] ?></span>
											<?php } ?>
											<div class="actions-wrapper">
												<div class="up-down-arrows">
													<div class="up-arrow">
													</div>
													<div class="down-arrow">
													</div>
												</div>
												<a class="delete" href="Controllers/Website/Page/website_delete_button.php?lang_id=<?= $lang_id ?>&button_id=<?= $blockContentButton['WBCB_button_id'] ?>">
													<img src="Content/Images/Icons/plus.svg"></img>
												</a>
											</div>
										</button>
									</h2>
									<div id="collapseInnerLinks<?= $innerButtonCounter ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $innerButtonCounter ?>" data-bs-parent="#accordionBlockContentButtons">
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
																	echo printButtonSubmenu($page['page_id'], 3, 3);

																} ?>
															</div>
														<?php } ?>
													</div>
												</div>
												<div class="col-2 label">																
													<label for="button-target">Odpre novo okno:</label><br>
												</div>
												<div class="col-10">
													<input type="checkbox" id="button-target" name="button-target" value="button-target">
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php }
								$innerButtonCounter = $innerButtonCounter + 1; 
							}																							
							?>
							<a class="add-block-content" href="Controllers/Website/Page/website_create_default_button.php?lang_id=<?= $lang_id ?>&default_table=images">
								<span>Dodaj gumb</span><div class="plus-icon"></div>
							</a>
						</div>
						<div class="col-2">
							<label for="footer_links">Povezave noge:</label>
						</div>
						<div class="col-10">
							<?php $innerButtonCounter = 0; 
							foreach(website::getWebsiteFooterLink($lang_id) as $button) { 
								foreach(website::getWebsiteDefaultButton($button['button_id']) as $blockContentButton) {?>
								<div class="accordion-item block-content-button-item">
									<h2 class="accordion-header" id="headingTwo">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInnerLinks<?= $innerButtonCounter ?>" aria-expanded="false" aria-controls="collapseInnerLinks<?= $innerButtonCounter ?>">
											<?php if(strlen($blockContentButton['WBCB_button_title']) == 0) { ?>
												<span>Button</span>																												
											<?php } else { ?>
												<span><?= $blockContentButton['WBCB_button_title'] ?></span>
											<?php } ?>
											<div class="actions-wrapper">
												<div class="up-down-arrows">
													<div class="up-arrow">
													</div>
													<div class="down-arrow">
													</div>
												</div>
												<a class="delete" href="Controllers/Website/Page/website_delete_button.php?lang_id=<?= $lang_id ?>&button_id=<?= $blockContentButton['WBCB_button_id'] ?>">
													<img src="Content/Images/Icons/plus.svg"></img>
												</a>
											</div>
										</button>
									</h2>
									<div id="collapseInnerLinks<?= $innerButtonCounter ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $innerButtonCounter ?>" data-bs-parent="#accordionBlockContentButtons">
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
																	echo printButtonSubmenu($page['page_id'], 3, 3);

																} ?>
															</div>
														<?php } ?>
													</div>
												</div>
												<div class="col-2 label">																
													<label for="button-target">Odpre novo okno:</label><br>
												</div>
												<div class="col-10">
													<input type="checkbox" id="button-target" name="button-target" value="button-target">
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php }
								$innerButtonCounter = $innerButtonCounter + 1; 
							}																							
							?>
							<a class="add-block-content" href="Controllers/Website/Page/website_create_default_button.php?lang_id=<?= $lang_id ?>&default_table=links">
								<span>Dodaj gumb</span><div class="plus-icon"></div>
							</a>
						</div>
						<div class="col-2">
							<label for="footer_socials">Socialna omrezja:</label>
						</div>
						<div class="col-10">
							<?php $innerButtonCounter = 0; 
							foreach(website::getWebsiteFooterSocials($lang_id) as $button) { 
								foreach(website::getWebsiteDefaultButton($button['button_id']) as $blockContentButton) {?>
								<div class="accordion-item block-content-button-item">
									<h2 class="accordion-header" id="headingTwo">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInnerLinks<?= $innerButtonCounter ?>" aria-expanded="false" aria-controls="collapseInnerLinks<?= $innerButtonCounter ?>">
											<?php if(strlen($blockContentButton['WBCB_button_title']) == 0) { ?>
												<span>Button</span>																												
											<?php } else { ?>
												<span><?= $blockContentButton['WBCB_button_title'] ?></span>
											<?php } ?>
											<div class="actions-wrapper">
												<div class="up-down-arrows">
													<div class="up-arrow">
													</div>
													<div class="down-arrow">
													</div>
												</div>
												<a class="delete" href="Controllers/Website/Page/website_delete_button.php?lang_id=<?= $lang_id ?>&button_id=<?= $blockContentButton['WBCB_button_id'] ?>">
													<img src="Content/Images/Icons/plus.svg"></img>
												</a>
											</div>
										</button>
									</h2>
									<div id="collapseInnerLinks<?= $innerButtonCounter ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $innerButtonCounter ?>" data-bs-parent="#accordionBlockContentButtons">
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
																	echo printButtonSubmenu($page['page_id'], 3, 3);

																} ?>
															</div>
														<?php } ?>
													</div>
												</div>
												<div class="col-2 label">																
													<label for="button-target">Odpre novo okno:</label><br>
												</div>
												<div class="col-10">
													<input type="checkbox" id="button-target" name="button-target" value="button-target">
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php }
								$innerButtonCounter = $innerButtonCounter + 1; 
							}																							
							?>
							<a class="add-block-content" href="Controllers/Website/Page/website_create_default_button.php?lang_id=<?= $lang_id ?>&default_table=socials">
								<span>Dodaj gumb</span><div class="plus-icon"></div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 submit-field">
				<input class="btn btn-primary submit" onclick="submitWebsiteDefault(<?= $lang_id ?>)" type="submit" value="Posodobi o strani">
			</div>
		</div>
	</div>
	<?php } 
} ?>