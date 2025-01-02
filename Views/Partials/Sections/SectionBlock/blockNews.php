<section class="BlockNews">
	<div class="container">
        <div class="row">
			<div class="col-lg-10 heading">
				<div class="newstitletext">
					<h3><?= $section['WSB_block_header'] ?></h3>
				</div>
			</div>		
		</div>
        <div class="row">
            <div class="col-12">
                <form id="urlForm" action="" method="get">
                    <input type="text" id="query" name="query" placeholder="Išči..."><br>
                    <input type="hidden" name="lang_id" value="<?php echo $_GET['lang_id']; ?>">
                    <input type="hidden" name="page_id" value="<?php echo $_GET['page_id']; ?>">
                </form>
            </div>
        </div>
        <div class="row">
            <?php
            if(isset($_GET['query'])) {
                $query = $_GET['query'];
                $previews = news::getArticlesPreviewsSearch($query);
            }
            else {                
                $previews = news::getArticlesPreviews();
            }
            $i = 0;
            foreach ($previews as $preview):
				$date = $preview["news_article_date"];
				$date = date("d.m.y", strtotime($date));
                $counter = 0;
                foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
				    foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {	
                        if($counter == 0) {
                            $news_page = $button['WBCB_page_id'];
                        }
                        $counter++;
				    }
			    } ?>			
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <a class="news-link" href="<?= makeTheLinkPath($lang_id, $news_page, null) ?>?news_id=<?= $preview["news_article_id"] ?>" target="_blank">
                    <div class="newsboxcontainer">
                        <div class="article-background" style="background-image: url('<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $preview['news_article_preview_image'] ?>')"></div>
                        <div class="overlay">
                            <div class="newstitletext">
                                <div class="newssubtitlepin">Dogodek | <?= $date ?></div>
                                <div class="newstitlepin"><?= $preview["news_article_title"] ?></div>
                            </div>
                            <div class="newstitlevec"><div class="vectext">več</div></div>
                        </div>
                    </div>
                </a>
                </div>
            <?php
                $i=$i+1;
                if ($i%2 == 0) {?>

                </div>
                <div class="row">
            <?php }
            endforeach; ?>
        </div>
	</div>
</section>
<script>
document.getElementById("query").addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault(); // Prevent form submission

        var queryValue = encodeURIComponent(document.getElementById("query").value);
        var lang_id = "<?php echo $_GET['lang_id']; ?>";
        var page_id = "<?php echo $_GET['page_id']; ?>";

        var generatedURL = "/?lang_id=" + lang_id + "&page_id=" + page_id + "&query=" + queryValue;

        // Redirect to the generated URL
        window.location.href = generatedURL;
    }
});
</script>