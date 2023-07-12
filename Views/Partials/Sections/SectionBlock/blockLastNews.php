<section class="BlockLastNews">
	<div class="container">
        <div class="row">
            <?php
            if (isset($_GET["tag_id"])) {
                $previews = news::getArticlesByTag($_GET["tag_id"]);
            } else {
                $previews = news::getArticlesPreviews();
            }
            $i = 0;
            foreach ($previews as $preview):
				$date = $preview["news_article_date"];
				$date = date("d.m.y", strtotime($date));
            $counter = 0;
            foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
				foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {	
                    if($counter == 1) {
                        $news_page = $button['WBCB_page_id'];
                    }
                    $counter++;
				}
			} ?>			
            <div class="col-xxl-6 col-xl-6 col-lg-6">
                <a class="news-link" href="?lang_id=<?= $lang_id ?>&page_id=<?= $news_page ?>&news_id=<?= $preview["news_article_id"] ?>" target="_blank">
                    <div class="newsboxcontainer" style="background-image: url('<?= $preview['news_article_preview_image'] ?>')">
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
                if ($i%4 == 0) {
                    break;
                }
                if ($i%2 == 0) {?>

                </div>
                <div class="row">
            <?php }
            endforeach; ?>
            <div class="col-12 button-wrapper">
                <?php $counter = 0;
                foreach(website::getWebsiteBlockContent($section['WSB_section_block_id']) as $blockContent) { 
				    foreach(website::getWebsiteBlockContentButton($blockContent['WBC_block_content_id']) as $button) {
                        if($counter == 0) {
                            if($button['WBCB_page_id'] == NULL || $button['WBCB_page_id'] == 0) { ?>
						        <a class="partner btn btn-primary" href="<?= $button['WBCB_button_link'] ?>"><?= $button['WBCB_button_title'] ?></a>
					        <?php } else { ?>
						        <a class="partner btn btn-primary" href="?page_id=<?= $button['WBCB_page_id'] ?>&lang_id=<?= $lang_id ?>"><?= $button['WBCB_button_title'] ?></a>
					        <?php $counter++;
                            }	
                        }                        		
				    }
			    } ?>				
            </div>
        </div>
	</div>
</section>