<section class="BlockHighlightedNews">
	<div class="highlight-news-swiper swiper">
		<div class="swiper-wrapper">
			<?php foreach(news::getArticlesHighlighted() as $highlighted) { ?>
				<div class="swiper-slide" style="background-image: url('<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $highlighted['news_article_preview_image'] ?>')">
					<div class="content-wrapper">
						<div class="container">
							<div class="row">
								<div class="col-lg-6 col-12">
									<div class="content">
										<h2><?= $highlighted['news_article_title'] ?></h2>
										<div class="short-text">
											<?= $highlighted['news_article_description'] ?>
										</div>
										<?php if(intval($highlighted['shows_on_news']) == 0) { ?>
											<?= $highlighted['news_article_content'] ?>
										<?php } else { 
											$counter = 0;
											foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
												if($blockContent['WBC_block_link'] == "pagelinkblock") {
													foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {
														if($counter == 2) { ?>
															<a class="partner btn btn-primary" href="<?= makeTheLinkPath($lang_id, $button['WBCB_page_id'], $highlighted['news_article_id']) ?>?news_id=<?= $highlighted['news_article_id'] ?>"><?= $button['WBCB_button_title'] ?></a>														
														<?php }
														$counter++;
													}
												}
											}											
										} ?>										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>			
			<?php } ?>
		</div>
	</div>
	<div class="scores">		
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<?php $counter = 0;
				foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
					if($blockContent['WBC_block_link'] == "pagelinkblock") {
						foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) { 
							if($counter == 0) { ?>
								<a class="nav-item nav-link active" id="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>-tab" data-toggle="tab" href="#nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>" role="tab" aria-controls="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>" aria-selected="true"><?= $button['WBCB_button_title'] ?></a>				
							<?php } else if($counter != 2) { ?>
								<a class="nav-item nav-link" id="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>-tab" data-toggle="tab" href="#nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>" role="tab" aria-controls="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>" aria-selected="true"><?= $button['WBCB_button_title'] ?></a>				
							<?php }							
						$counter++;
						}
					}				
				} ?>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<?php $counter = 0;
			foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
				if($blockContent['WBC_block_link'] == "pagelinkblock") {
					foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) { 
						if($counter == 0) { ?>
							<div class="tab-pane fade show active" id="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>" role="tabpanel" aria-labelledby="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>-tab">
								<div class="tab-container">
									<?php $count = 0;
									foreach(tournament::getTournamentMatchesAllDesc() as $match) { 
										if($match['match_end'] == 1 && $count < 20) { ?>
											<div class="match-wrapper upcoming">
												<?php foreach(tournament::getTournamentsById($match['tournament_id']) as $tournament) {
													if($tournament['game_id'] == 5) { 
														foreach(tournament::getTeamValorant($tournament['apply_end_time'], $tournament['apply_start_time'], $match['player_one']) as $team) { ?>															
															<div class="contestant left-contestant">
																<div class="logo" style="background-image: url('data:<?= $team['logo_data_type'] ?>;base64, <?= $team['logo'] ?>')"></div>
																<div class="name">
																	<span><?= $match['player_one'] ?></span>
																</div>
															</div>
														<?php } ?>														
														<div class="middle-block">
															<?php 
																$date = new DateTime($match['match_date']);

																$slovenianDays = [
																	'Monday'    => 'ponedeljek',
																	'Tuesday'   => 'torek',
																	'Wednesday' => 'sreda',
																	'Thursday'  => 'četrtek',
																	'Friday'    => 'petek',
																	'Saturday'  => 'sobota',
																	'Sunday'    => 'nedelja'
																];

																$englishDay = $date->format('l');
																$day = $date->format('d');
																$month = $date->format('m');
																$year = $date->format('Y');

																$slovenianDay = strtoupper($slovenianDays[$englishDay]);

																$formattedDate = "$slovenianDay, $day. $month. $year";
															?>
															<div class="match-title"><span><?= $formattedDate ?></span></div>
															<a class="match-score btn btn-primary"><?= $match['player_one_score'] ?> : <?= $match['player_two_score'] ?></a>
														</div>
														<?php foreach(tournament::getTeamValorant($tournament['apply_end_time'], $tournament['apply_start_time'], $match['player_two']) as $team) { ?>															
															<div class="contestant right-contestant">
																<div class="logo" style="background-image: url('data:<?= $team['logo_data_type'] ?>;base64, <?= $team['logo'] ?>')"></div>
																<div class="name">
																	<span><?= $match['player_two'] ?></span>
																</div>
															</div>
														<?php } ?>	
													<?php } 
												} ?>
											</div>
										<?php $count = $count + 1;
										} 
									} ?>
								</div>
							</div>
						<?php } else { ?>
							<div class="tab-pane fade" id="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>" role="tabpanel" aria-labelledby="nav-<?= str_replace(" ", "", strtolower($button['WBCB_button_title'])) ?>-tab">
								<div class="tab-container">
									<?php $count = 0;
									foreach(tournament::getTournamentMatchesAll() as $match) { 
										if($match['match_end'] == 0 && $count < 20) { ?>
											<div class="match-wrapper upcoming">
												<?php foreach(tournament::getTournamentsById($match['tournament_id']) as $tournament) {
													if($tournament['game_id'] == 5) { 
														foreach(tournament::getTeamValorant($tournament['apply_end_time'], $tournament['apply_start_time'], $match['player_one']) as $team) { ?>															
															<div class="contestant left-contestant">
																<div class="logo" style="background-image: url('data:<?= $team['logo_data_type'] ?>;base64, <?= $team['logo'] ?>')"></div>
																<div class="name">
																	<span><?= $match['player_one'] ?></span>
																</div>
															</div>
														<?php } ?>														
														<div class="middle-block">
															<?php 
																$date = new DateTime($match['match_date']);

																$slovenianDays = [
																	'Monday'    => 'ponedeljek',
																	'Tuesday'   => 'torek',
																	'Wednesday' => 'sreda',
																	'Thursday'  => 'četrtek',
																	'Friday'    => 'petek',
																	'Saturday'  => 'sobota',
																	'Sunday'    => 'nedelja'
																];

																$englishDay = $date->format('l');
																$day = $date->format('d');
																$month = $date->format('m');
																$year = $date->format('Y');

																$slovenianDay = strtoupper($slovenianDays[$englishDay]);

																$formattedDate = "$slovenianDay, $day. $month. $year";
															?>
															<div class="match-title"><span><?= $formattedDate ?></span></div>
															<a class="match-score btn btn-primary">TBD</a>
														</div>
														<?php foreach(tournament::getTeamValorant($tournament['apply_end_time'], $tournament['apply_start_time'], $match['player_two']) as $team) { ?>															
															<div class="contestant right-contestant">
																<div class="logo" style="background-image: url('data:<?= $team['logo_data_type'] ?>;base64, <?= $team['logo'] ?>')"></div>
																<div class="name">
																	<span><?= $match['player_two'] ?></span>
																</div>
															</div>
														<?php } ?>	
													<?php } 
												} ?>
											</div>
										<?php $count = $count + 1;
										} 
									} ?>
								</div>
							</div>				
						<?php }							
					$counter++;
					}
				}				
			} ?>
		</div>
	</div>
</section>