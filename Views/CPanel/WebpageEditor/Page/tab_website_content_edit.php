<?php
	$tab = $_GET['tab'];
	$path = $_GET['path'];
?>
<div class="content-edit-sidebar" uploadLocation="">
	<div class="image-wrapper">
		<img src="" alt="" />
	</div>
	<form method="post" action="Controllers/Website/Media/media_edit_file.php">
		<div class="alt-wrapper">
			<input type="text" id="image_id" name="image_id" hidden><br>
			<label for="alt_text">Opis slike:</label>
			<input type="text" id="alt_text" name="alt_text">
		</div>
		<input class="btn btn-primary submit" type="submit" value="Posodobi besedilo">
	</form>
</div>