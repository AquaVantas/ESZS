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
					
					<form method="post" action="Controllers/Tournaments/tournament_valorant.php"><br>
					<label for="team">Email: <span style="color: red;">*</span></label><br>
					<input type="text" id="team" name="team" placeholder="janezki" required><br>

					<h4>Kapetan</h4>
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
					<label for="email">Email: <span style="color: red;">*</span></label><br>
					<input type="text" id="email" name="email" placeholder="janez.novak@nekmail.com" required><br>
					<label for="discord">Discord: <span style="color: red;">*</span></label><br>
					<input type="text" id="discord" name="discord" placeholder="janci#0420" required><br>
					<label for="nickname">Vzdevek: <span style="color: red;">*</span></label><br>
					<input type="text" id="nickname" name="nickname" placeholder="KawaiiJanez"><br>
					<label for="dateofbirth">Datum rojstva: <span style="color: red;">*</span></label><br>
					<input type="date" id="dateofbirth" name="dateofbirth"><br>
					<label for="postalCode">Poštna številka: <span style="color: red;">*</span></label><br>
					<input type="text" id="postalCode" name="postalCode" placeholder="1000"><br><br>

					<h4>Igralec 2</h4>
					<table width="100%">
						<tr>
							<td style="padding-right: 10px;">
								<label for="name2">Ime: <span style="color: red;">*</span></label><br>
								<input type="text" id="name2" name="name2" placeholder="Janez" required><br>
							</td>
							<td style="padding-left: 10px;">
								<label for="surname2">Priimek: <span style="color: red;">*</span></label><br>
								<input type="text" id="surname2" name="surname2" placeholder="Novak" required><br>
							</td>
						<tr>
					</table>
					<label for="email2">Email: <span style="color: red;">*</span></label><br>
					<input type="text" id="email2" name="email2" placeholder="janez.novak@nekmail.com" required><br>
					<label for="discord2">Discord: <span style="color: red;">*</span></label><br>
					<input type="text" id="discord2" name="discord2" placeholder="janci#0420" required><br>
					<label for="nickname2">Vzdevek: <span style="color: red;">*</span></label><br>
					<input type="text" id="nickname2" name="nickname2" placeholder="KawaiiJanez"><br>
					<label for="dateofbirth2">Datum rojstva: <span style="color: red;">*</span></label><br>
					<input type="date" id="dateofbirth2" name="dateofbirth2"><br>
					<label for="postalCode2">Poštna številka: <span style="color: red;">*</span></label><br>
					<input type="text" id="postalCode2" name="postalCode2" placeholder="1000"><br><br>

					<h4>Igralec 3</h4>
					<table width="100%">
						<tr>
							<td style="padding-right: 10px;">
								<label for="name3">Ime: <span style="color: red;">*</span></label><br>
								<input type="text" id="name3" name="name3" placeholder="Janez" required><br>
							</td>
							<td style="padding-left: 10px;">
								<label for="surname3">Priimek: <span style="color: red;">*</span></label><br>
								<input type="text" id="surname3" name="surname3" placeholder="Novak" required><br>
							</td>
						<tr>
					</table>
					<label for="email3">Email: <span style="color: red;">*</span></label><br>
					<input type="text" id="email3" name="email3" placeholder="janez.novak@nekmail.com" required><br>
					<label for="discord3">Discord: <span style="color: red;">*</span></label><br>
					<input type="text" id="discord3" name="discord3" placeholder="janci#0420" required><br>
					<label for="nickname3">Vzdevek: <span style="color: red;">*</span></label><br>
					<input type="text" id="nickname3" name="nickname3" placeholder="KawaiiJanez"><br>
					<label for="dateofbirth3">Datum rojstva: <span style="color: red;">*</span></label><br>
					<input type="date" id="dateofbirth3" name="dateofbirth3"><br>
					<label for="postalCode3">Poštna številka: <span style="color: red;">*</span></label><br>
					<input type="text" id="postalCode3" name="postalCode3" placeholder="1000"><br><br>

					<h4>Igralec 4</h4>
					<table width="100%">
						<tr>
							<td style="padding-right: 10px;">
								<label for="name4">Ime: <span style="color: red;">*</span></label><br>
								<input type="text" id="name4" name="name4" placeholder="Janez" required><br>
							</td>
							<td style="padding-left: 10px;">
								<label for="surname4">Priimek: <span style="color: red;">*</span></label><br>
								<input type="text" id="surname4" name="surname4" placeholder="Novak" required><br>
							</td>
						</tr>
					</table>
					<label for="email4">Email: <span style="color: red;">*</span></label><br>
					<input type="text" id="email4" name="email4" placeholder="janez.novak@nekmail.com" required><br>
					<label for="discord4">Discord: <span style="color: red;">*</span></label><br>
					<input type="text" id="discord4" name="discord4" placeholder="janci#0420" required><br>
					<label for="nickname4">Vzdevek: <span style="color: red;">*</span></label><br>
					<input type="text" id="nickname4" name="nickname4" placeholder="KawaiiJanez"><br>
					<label for="dateofbirth4">Datum rojstva: <span style="color: red;">*</span></label><br>
					<input type="date" id="dateofbirth4" name="dateofbirth4"><br>
					<label for="postalCode4">Poštna številka: <span style="color: red;">*</span></label><br>
					<input type="text" id="postalCode4" name="postalCode4" placeholder="1000"><br><br>

					<!-- Igralec 5 -->
					<h4>Igralec 5</h4>
					<table width="100%">
						<tr>
							<td style="padding-right: 10px;">
								<label for="name5">Ime: <span style="color: red;">*</span></label><br>
								<input type="text" id="name5" name="name5" placeholder="Janez" required><br>
							</td>
							<td style="padding-left: 10px;">
								<label for="surname5">Priimek: <span style="color: red;">*</span></label><br>
								<input type="text" id="surname5" name="surname5" placeholder="Novak" required><br>
							</td>
						</tr>
					</table>
					<label for="email5">Email: <span style="color: red;">*</span></label><br>
					<input type="text" id="email5" name="email5" placeholder="janez.novak@nekmail.com" required><br>
					<label for="discord5">Discord: <span style="color: red;">*</span></label><br>
					<input type="text" id="discord5" name="discord5" placeholder="janci#0420" required><br>
					<label for="nickname5">Vzdevek: <span style="color: red;">*</span></label><br>
					<input type="text" id="nickname5" name="nickname5" placeholder="KawaiiJanez"><br>
					<label for="dateofbirth5">Datum rojstva: <span style="color: red;">*</span></label><br>
					<input type="date" id="dateofbirth5" name="dateofbirth5"><br>
					<label for="postalCode5">Poštna številka: <span style="color: red;">*</span></label><br>
					<input type="text" id="postalCode5" name="postalCode5" placeholder="1000"><br><br>

					<!-- Igralec 6 -->
					<h4>Rezerva 1</h4>
					<table width="100%">
						<tr>
							<td style="padding-right: 10px;">
								<label for="name6">Ime:</label><br>
								<input type="text" id="name6" name="name6" placeholder="Janez"><br>
							</td>
							<td style="padding-left: 10px;">
								<label for="surname6">Priimek:</label><br>
								<input type="text" id="surname6" name="surname6" placeholder="Novak"><br>
							</td>
						</tr>
					</table>
					<label for="email6">Email:</label><br>
					<input type="text" id="email6" name="email6" placeholder="janez.novak@nekmail.com"><br>
					<label for="discord6">Discord:</label><br>
					<input type="text" id="discord6" name="discord6" placeholder="janci#0420"><br>
					<label for="nickname6">Vzdevek:</label><br>
					<input type="text" id="nickname6" name="nickname6" placeholder="KawaiiJanez"><br>
					<label for="dateofbirth6">Datum rojstva:</label><br>
					<input type="date" id="dateofbirth6" name="dateofbirth6"><br>
					<label for="postalCode6">Poštna številka:</label><br>
					<input type="text" id="postalCode6" name="postalCode6" placeholder="1000"><br><br>

					<!-- Igralec 7 -->
					<h4>Rezerva 2</h4>
					<table width="100%">
						<tr>
							<td style="padding-right: 10px;">
								<label for="name7">Ime:</label><br>
								<input type="text" id="name7" name="name7" placeholder="Janez"><br>
							</td>
							<td style="padding-left: 10px;">
								<label for="surname7">Priimek:</label><br>
								<input type="text" id="surname7" name="surname7" placeholder="Novak"><br>
							</td>
						</tr>
					</table>
					<label for="email7">Email:</label><br>
					<input type="text" id="email7" name="email7" placeholder="janez.novak@nekmail.com"><br>
					<label for="discord7">Discord:</label><br>
					<input type="text" id="discord7" name="discord7" placeholder="janci#0420"><br>
					<label for="nickname7">Vzdevek:</label><br>
					<input type="text" id="nickname7" name="nickname7" placeholder="KawaiiJanez"><br>
					<label for="dateofbirth7">Datum rojstva:</label><br>
					<input type="date" id="dateofbirth7" name="dateofbirth7"><br>
					<label for="postalCode7">Poštna številka:</label><br>
					<input type="text" id="postalCode7" name="postalCode7" placeholder="1000"><br><br>
						
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
								<label for="scales">Strinjam se, da se v primeru uvrstitve na SDP, registriram kot aktivni igralec pri EŠZS. <span style="color: red;">*</span></label>
							<td>
							</td>
						</tr>
						<tr>
							<td style="width: 50px; text-align: left;">
								<input type="checkbox" id="scales" name="scales" style="height: 20px; widght: 20px;" required>
							</td>
							<td>
								<label for="scales">Strinjam se z obdelavo osebnih  podatkov v promocijske namene za EŠZS in partnerjev pri SDP. <span style="color: red;">*</span></label>
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