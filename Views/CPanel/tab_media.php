<?php
	$media_root = "/xampp/htdocs/ESZS/Content/WebsiteContent";
	if(isset($_GET['path'])) {
		$dir = $_GET['path'];
		$files1 = scandir($dir);
	}
	if(isset($_GET['path']) && $_GET['path'] != $media_root) {		
		$prevPath = substr($_GET['path'], 0, (1+strpos(strrev($_GET['path']), "/"))*(-1));
	}

	if(isset($cpanel_tab) && $cpanel_tab == "media" && ($role_admin || $role_news || $role_webdev)) { ?>
		<div class="media-viewer">
			<div class="user-body container">
				<div class="row">
						<div class="col-12 create-bar">
							<?php if(isset($prevPath)) { ?>
								<?php if($role_admin || $role_webdev) { ?><a class="btn btn-primary" href="?tab=media&path=<?= $prevPath ?>"><div class="arrow-icon"></div>Nazaj</a><?php } ?>
								<?php if($role_admin || $role_webdev) { ?>
									<div class="buttons-wrapper">
										<a class="btn btn-primary" onclick="openFileUploader()">Dodaj mapo</a>
										<a class="btn btn-primary" onclick="openFileUploader()">Dodaj sliko</a>
									</div>
								<?php } ?>
							<?php } ?>
							</div>
					<?php				
						foreach($files1 as $file) {
							if(is_dir($dir . "/" . $file) && ($file != "." && $file != ".." && $file != "Icons")) {
								?>
								<div class="col-2 media-folder-wrapper">
									<a href="?tab=media&path=<?= $dir . '/' . $file ?>">
										<div class="media-folder-image">
											<div class="folder-image"></div>
										</div>
										<div class="media-folder-title">
											<?php echo $file; ?>
										</div>
									</a>
								</div>
								<?php
							}
						}
					?>
				</div>
				<div class="row">
					<?php				
						foreach($files1 as $file) {
							if(!is_dir($dir . "/" . $file)) {
								$image_path = substr($_GET['path'], strpos($_GET['path'], 'Content')) . '/' . $file;
								foreach(media::getImageByPath($image_path) as $foundImage) { ?>
									<div class="col-2 media-folder-wrapper" onclick="openFileEditor(<?= $foundImage['image_id'] ?>, '<?= $foundImage['image_path'] ?>', '<?= $foundImage['alt_text'] ?>')">
										<div class="media-folder-image">
											<img src="<?= $image_path ?>" />
										</div>
										<div class="media-folder-title">
											<span><?php echo $file; ?></span>
										</div>
									</div>
								<?php }
								?>
								
								<?php
							}
						}
					?>
				</div>
			</div>
		</div>
		
		<!-- image upload sidebar -->
		<?php include "Views/CPanel/WebpageEditor/Page/tab_website_content_upload_siderbars.php" ?>
		<!-- image edit sidebar -->
		<?php include "Views/CPanel/WebpageEditor/Page/tab_website_content_edit.php" ?>
	<?php } 
?>
