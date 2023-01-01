<?php
	$tab = $_GET['tab'];
	$path = $_GET['path'];
?>
<div class="content-upload-sidebar" uploadLocation="">
	<div class="upload-wrapper">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Naloži sliko</button>
				<button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Ustvari mapo</button>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form action="Controllers/Website/Page/website_media_upload.php?tab=<?= $tab ?>&path=<?= $path ?>" method="post" enctype="multipart/form-data">
					Select image to upload:
					<input type="file" name="fileToUpload" id="fileToUpload">
					<input type="submit" value="Upload Image" name="submit">
				</form>
			</div>
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
		</div>
	</div>
	<div class="upload-footer">
		<a class="btn btn-primary">Zapri</a>
	</div>
</div>