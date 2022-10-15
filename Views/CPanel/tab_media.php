<?php
	$media_root = "/xampp/htdocs/ESZS_new/Content/Images";
	if(isset($_GET['path'])) {
		$dir = $_GET['path'];
		$files1 = scandir($dir);
	}
	if(isset($_GET['path']) && $_GET['path'] != $media_root) {		
		$prevPath = substr($_GET['path'], 0, (1+strpos(strrev($_GET['path']), "/"))*(-1));
	}

	if(isset($cpanel_tab) && $cpanel_tab == "tournaments" && ($role_admin || $role_news)) { ?>
		<div class="media-viewer">
			<div class="user-body container">
				<div class="row">
					<?php if(isset($prevPath)) { ?>
						<div class="col-12 create-bar">
							<?php if($role_admin) { ?><a class="btn btn-primary" href="?tab=tournaments&path=<?= $prevPath ?>"><div class="arrow-icon"></div>Nazaj</a><?php } ?>
							<?php if($role_admin) { ?><a class="btn btn-primary" href="?tab=tournaments&path=<?= $prevPath ?>">Dodaj sliko</a><?php } ?>
						</div>
					<?php } ?>
					<?php				
						foreach($files1 as $file) {
							if(is_dir($dir . "/" . $file) && ($file != "." && $file != ".." && $file != "Icons")) {
								?>
								<div class="col-2 media-folder-wrapper">
									<a href="?tab=tournaments&path=<?= $dir . '/' . $file ?>">
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
								?>
								<div class="col-2 media-folder-wrapper">
									<div class="media-folder-image">
										<img src="<?= substr($_GET['path'], strpos($_GET['path'], 'Content')) . '/' . $file ?>" />
									</div>
									<div class="media-folder-title">
										<span><?php echo $file; ?></span>
									</div>
								</div>
								<?php
							}
						}
					?>
				</div>
			</div>
		</div>
	<?php } 
?>