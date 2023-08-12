<?php 
	$article = news::getArticleById($_GET["news_id"]);
?>
<section class="BlockArticle">
	<div class="container article-title">
		<div class="row">
			<div class="col-xxl-8 col-xl-8 col-lg-8" class="article-title">
				<div class="newstitletext" style="width: 80%; padding: 40px;">
					<div class="newstitlepin" style="font-size: 30px; padding-bottom: 10px; text-transform: uppercase;"><?= $article["news_article_title"] ?></div>
					<div class="newssubtitlepin"><?= $article["news_author_name"] ?> | <?php
						$tags = news::getTagsByArticle($article["news_article_id"]);
						foreach ($tags as $tag): ?>
							<a href="novice.php?tag_id=<?= $tag['news_tag_id'] ?>" style="text-decoration: none; text-transform: capitalize; color: black;"><?= $tag['news_tag_name'] ?></a>
						<?php endforeach; ?> | <?= $article["news_article_date"] ?></div>
				</div>
			</div>
			<div class="col-xxl-4 col-xl-4 col-lg-4">
				
			</div>
		</div>
	</div>
	<div class="container" style="padding-bottom: 60px;">
		<div class="row">
			<div class="col-xxl-8 col-xl-8 col-lg-8" style="padding-top: 40px;">
				<div style="border: none;" class="ql-container ql-snow"><?= $article["news_article_content"] ?></div>
			</div>
			<div class="col-xxl-4 col-xl-4 col-lg-4">
				<?php 
				if (isset($_GET["tag_id"])) {
					$previews = news::getArticlesByTag($_GET["tag_id"]);
				} else {
					$previews = news::getArticlesPreviews();
				}
				$i = 0;
				$counter = 0;
				foreach ($previews as $preview) {
					$date = $preview["news_article_date"];
					$date = date("d.m.y", strtotime($date));
					?> <a class="news-link" href="?lang_id=<?= $lang_id ?>&page_id=<?= $_GET["page_id"] ?>&news_id=<?= $preview["news_article_id"] ?>">
						<div class="newsboxcontainer">
							<div class="article-background" style="background-image: url('<?= $preview['news_article_preview_image'] ?>')"></div>
							<div class="overlay">
								<div class="newstitletext">
									<div class="newssubtitlepin">Dogodek | <?= $date ?></div>
									<div class="newstitlepin"><?= $preview["news_article_title"] ?></div>
								</div>
								<div class="newstitlevec"><div class="vectext">več</div></div>
							</div>
						</div>
					</a>
				<?php
					$counter++;
					if($counter == 3) {					
						break; 
					}
				} ?>
			</div>
		</div>
	</div>
</section>