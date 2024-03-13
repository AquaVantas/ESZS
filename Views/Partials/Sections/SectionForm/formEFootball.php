<section class="FormApplication">
	<div class="container" style="padding-top: 50px;">
		<div class="row">
			<div class="col-xxl-2 col-xl-2 col-lg-2"></div>
			<div class="col-xxl-8 col-xl-8 col-lg-8" style="padding-bottom: 70px;">
				<?php foreach(website::getWebsiteSectionForm($section_type['section_id']) as $sectionForm) {
					if($sectionForm['WSF_image_id'] != NULL) {
						foreach(website::getWebsiteImageByID(intval($sectionForm['WSF_image_id'])) as $image) { ?>						
							<img src="<?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>"/>
						<?php }					
					} ?>
					<br><br><br>
					<h1><?= $sectionForm['WSF_section_name'] ?></h1>
					<?= $sectionForm['WSF_form_header'] ?><br>
					<?= $sectionForm['WSF_form_subheader'] ?>
					<form method="post" action="Controllers/Tournaments/tournament_efootball.php?section_id=<?= $section_type['section_id'] ?>">
						<table width="100%">
							<tr>
								<td style="padding-right: 10px;">
									<label for="name">Ime: <span style="color: red;">*</span></label><br>
									<input type="text" id="name" name="name" placeholder="Janez" required><br>
								</td>
								<td style="padding-left: 10px;">
									<label for="surname">Priimek: <span style="color: red;">*</span></label><br>
									<input type="text" id="surname" name="surname" placeholder="Novak" required><br>
								</td>
							<tr>
						</table>
						<label for="nickname">Playstation ID: <span style="color: red;">*</span></label><br>
						<input type="text" id="nickname" name="nickname" placeholder="janko_kralj" required><br>
						<label for="email">Email: <span style="color: red;">*</span></label><br>
						<input type="text" id="email" name="email" placeholder="janez.novak@nekmail.com" required><br>
						<label for="discord">Discord: <span style="color: red;">*</span></label><br>
						<input type="text" id="discord" name="discord" placeholder="janci#0420" required><br>
						<label for="nationality">Državljanstvo: <span style="color: red;">*</span></label><br>
						<input type="text" id="nationality" name="nationality" placeholder="slovensko" required><br>						
						<label for="dateofbirth">Datum rojstva: <span style="color: red;">*</span></label><br>
						<input type="date" id="dateofbirth" name="dateofbirth" required><br>
						<label for="postalCode">Poštna številka: <span style="color: red;">*</span></label><br>
						<input type="text" id="postalCode" name="postalCode" placeholder="1000" required><br><br>
						<table width="100%" style="margin-top: 50px;">
							<tr>
								<td style="width: 50px; text-align: left;">
									<input type="checkbox" id="scales" name="scales" style="height: 20px; widght: 20px;" required>
								</td>
								<td>
									<label for="scales">Prebral sem pravilnik in se z njim strinjam. <span style="color: red;">*</span></label>
								<td>
								</td>
							</tr>
							<tr>
								<td style="width: 50px; text-align: left;">
									<input type="checkbox" id="scales" name="scales" style="height: 20px; widght: 20px;" required>
								</td>
								<td>
									<label for="scales">Strinjam se z obdelavo podatkov. <span style="color: red;">*</span></label>
								<td>
								</td>
							</tr>
							<tr>
								<td style="width: 50px; text-align: left;">
									<input type="checkbox" id="scales" name="scales" style="height: 20px; widght: 20px;" required>
								</td>
								<td>
									<label for="scales">Strinjam se, da se v primeru uvrstitve na IeSF, registriram kot aktivni igralec pri EŠZS. <span style="color: red;">*</span></label>
								<td>
								</td>
							</tr>
							<tr>
								<td style="width: 50px; text-align: left;">
									<input type="checkbox" id="scales" name="scales" style="height: 20px; widght: 20px;" required>
								</td>
								<td>
									<label for="scales">Strinjam se z obdelavo osebnih  podatkov v promocijske namene za EŠZS in partnerjev pri IeSF. <span style="color: red;">*</span></label>
								<td>
								</td>
							</tr>
						</table><br><br>
						<input id="submitButton" type="submit" value="PRIJAVA">
					</form>
				<?php } ?>				
			</div>			
		</div>
	</div>
</section>