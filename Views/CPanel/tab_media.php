<?php
	$media_root = "/xampp/htdocs/ESZS_new/Content/Images";
	if(isset($_GET['path'])) {
		$dir = $_GET['path'];
	}
	if(isset($_GET['path']) && $_GET['path'] != $media_root) {		
		$prevPath = substr($_GET['path'], 0, (1+strpos(strrev($_GET['path']), "/"))*(-1));
	}

	$files1 = scandir($dir);
	if(isset($cpanel_tab) && $cpanel_tab == "tournaments" && ($role_admin || $role_news)) { ?>
		<div class="user-body container">
			<div class="row">
				<?php if(isset($prevPath)) { ?>
					<div class="col-12 create-bar">
						<?php if($role_admin) { ?><a class="btn btn-primary" href="?tab=tournaments&path=<?= $prevPath ?>"><div class="arrow-icon"></div>Nazaj</a><?php } ?>
					</div>
				<?php } ?>
				<?php				
					foreach($files1 as $file) {
						if(is_dir($dir . "/" . $file) && ($file != "." && $file != ".." && $file != "Icons")) {
							?>
							<div class="col-2">
								<div class="media-folder"><a href="?tab=tournaments&path=<?= $dir . '/' . $file ?>"><?php echo $file; ?></a></div>
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
							<div class="col-2">
								<span><?php echo $file; ?></span>
							</div>
							<?php
						}
					}
				?>
			</div>
		</div>
	<?php } 
?>