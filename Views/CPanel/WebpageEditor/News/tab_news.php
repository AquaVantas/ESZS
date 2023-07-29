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
							<a class="btn btn-secondary" href="?tab=news_editor&news_id=<?= $artivle["news_article_id"] ?>">Uredi</a>
							<a class="btn btn-secondary" onclick="deleteUser('Controllers/Editors/editors_delete_user.php?user='+<?= $admin['admin_id'] ?>)" data-bs-toggle="modal" data-bs-target="#delete-user-modal">Izbriši</a>
						</div>
					</div>					
				</div>
			<?php } ?>
			<br><br><br><table>
				<tr>
					<td>Naslov novice</td><td>Uredi</td><td>Izbriši</td>
				</tr>
				<?php foreach (news::getArticlesPreviews() as $novica) : ?>

				<tr>					
					<td><?= $novica["news_article_title"] ?></td><td><a href="cpanel.php?action=2&article_id=<?=$novica["news_article_id"]?>">Edit</a></td><td><a href="cpanel.php?action=2&article_id=<?=$novica["news_article_id"]?>&delete=1">X</a></td>
				</tr><?php endforeach; ?>
			</table>
			<!--<div class="create-user">
				<?php
					if(isset($_GET['error'])) { ?>
						<p class="error">Gesli se ne ujemata! Poskusite ponovno!</p>
					<?php }
				?>						
				<form class="row" method="post" action="Controllers/Website/Page/website_edit_page.php?page_id=<?= $_GET['page_id'] ?><?= (isset($_GET['lang_id'])) ? '&lang_id='.$_GET['lang_id'] : '' ?>">
					<?php foreach(website::getSpecificWebsitePage($_GET['page_id']) as $page) { ?>
						<div class="col-12">
							<label for="page_title">Naslov:</label><br>
							<input type="text" id="page_title" name="page_title" value="<?= $page['page_title'] ?>" required>
						</div>	
					<?php } ?>
					<div class="col-12 submit-field">
						<input class="btn btn-primary submit" type="submit" value="Spremeni naslov strani">
					</div>								
				</form>
			</div>-->
		</div>
	</div>
<?php } ?>