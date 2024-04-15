<?php
	
	$dir = "/xampp/htdocs/ESZS/Content/WebsiteContent";					
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
							if($currDir == $dir) { ?>
								<a class="btn btn-primary" onclick="closeFileSelector()"><div class="arrow-icon"></div>Nazaj</a>
							<?php } else { 
							$prevDiv = strrev(substr(strrev($currDir), (strpos(strrev($currDir), '/'))+1)); ?>
								<a class="btn btn-primary" onclick="openCorrectFileSelector('<?= $prevDiv ?>')"><div class="arrow-icon"></div>Nazaj</a>								
							<?php }
						?>						
						<form id="<?= str_replace('.', '_', str_replace('/', '_', substr($currDir, 1, strlen($currDir) - 1))) ?>" class="hidden-add-pic">
							<input type="file" id="myFile" name="filename" onchange="uploadImageToDatabase('<?= $currDir ?>')">
							<input id="submit" type="submit" onclick="submitImageChanges()">
						</form>
						<div class="action-buttons">
							<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-folder" onclick="openNewFolderModal('<?= $currDir ?>')">Dodaj mapo</a>
							<a class="btn btn-primary" onclick="openInputFileForm('<?= $currDir ?>')">Dodaj sliko</a>
						</div>
					</div>
					<?php				
						foreach(scandir($currDir) as $file) {
							if(is_dir($currDir . "/" . $file) && ($file != "." && $file != ".." && $file != "Icons")) {
								?>
								<div class="col-2 media-folder-wrapper folder-file">
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
								foreach(media::getImages() as $image) {
									if(str_contains($currDir . "/" . $file, $image['image_path'])) { ?>
										<div class="col-2 media-folder-wrapper image-file" onclick="selectThisFile(<?= $image['image_id'] ?>)" image-id="<?= $image['image_id'] ?>">
											<div class="media-folder-image">
												<img src="<?= substr($currDir, strpos($currDir, "Content")) . "/" . $file ?>" />
											</div>
											<div class="media-folder-title">
												<span><?php echo $file; ?></span>
											</div>
										</div>
									<?php }
								}
							}
						}
					?>
				</div>
			</div>
		</div>
	<?php }
?>
