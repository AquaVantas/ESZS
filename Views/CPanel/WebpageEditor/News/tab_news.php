<?php if((isset($cpanel_tab) && $cpanel_tab == "news")  && ($role_admin || $role_news)) { ?>
	<div class="user-body container">
		<div class="row">
			<div class="col-12 create-bar">
				<?php if($role_admin || $role_news) { ?><a class="btn btn-primary" href="?tab=news_editor">Dodaj novico</a><?php } ?>
			</div>
			<?php foreach(news::getArticlesPreviews() as $article) { ?>
				<div class="col-lg-3 col-md-4 col-6">
					<div class="user-card">
						<div class="news-image" style="background-image: url('<?= $article['news_article_preview_image'] ?>')">							
						</div>
						<div class="user-info">
							<span class="user-info-name"><?= $article["news_article_title"] ?></span>
							<span class="user-info-email"><?= $article['news_article_date'] ?></span>						
						</div>
						<div class="user-roles">
						</div>
						<div class="user-actions">
							<a class="btn btn-secondary" href="?tab=news_editor&news_id=<?= $article["news_article_id"] ?>">Uredi</a>
							<a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#delete-user-modal">Izbriši</a>
						</div>
					</div>					
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>