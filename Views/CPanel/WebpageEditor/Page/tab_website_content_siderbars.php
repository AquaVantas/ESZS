<?php
	$dir = "/xampp/htdocs/ESZS_new/Content/WebsiteContent";					
	$files1 = scandir($dir);
	$fileDirectories = array($dir);
	checkAllFolders($fileDirectories, $dir);

	function checkAllFolders(&$fileDirectories, $dir) {
		$directory = scandir($dir);
		foreach($directory as $files) {
			if(is_dir($dir . "/" . $files) && ($files != "." && $files != "..")) {
				$dirA = $dir . "/" . $files;
				array_push($fileDirectories, $dirA);
				checkAllFolders($fileDirectories, $dirA);
			}
		}
	}
?>
<?php
	foreach($fileDirectories as $currDir) { ?>
		<div class="content-sidebar-wrapper" dirPath="<?= $currDir ?>" origiDir="<?= $dir ?>" lookingForContent="">
			<div class="container">
				<div class="row">
					<div class="col-12 create-bar">
						<?php
							if($currDir == $dir) {
							?>
							<a class="btn btn-primary" onclick="closeFileSelector()"><div class="arrow-icon"></div>Nazaj</a>
							<a class="btn btn-primary" href="">Dodaj sliko</a>
							<?php } else { 
							$prevDiv = strrev(substr(strrev($currDir), (strpos(strrev($currDir), '/'))+1));?>
							<a class="btn btn-primary" onclick="openCorrectFileSelector('<?= $prevDiv ?>')"><div class="arrow-icon"></div>Nazaj</a>
							<a class="btn btn-primary" href="">Dodaj sliko</a>
							<?php }
						?>
					</div>
					<?php				
						foreach(scandir($currDir) as $file) {
							if(is_dir($currDir . "/" . $file) && ($file != "." && $file != ".." && $file != "Icons")) {
								?>
								<div class="col-2 media-folder-wrapper">
									<a onclick="openCorrectFileSelector('<?= $currDir . "/" . $file ?>')">
										<div class="media-folder-image">
											<div class="folder-image"></div>
										</div>
										<div class="media-folder-title">
											<span><?php echo $file; ?></span>
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
						foreach(scandir($currDir) as $file) {
							if(!is_dir($currDir . "/" . $file)) {
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
