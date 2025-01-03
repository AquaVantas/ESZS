<section class="FormApplication">
	<div class="container" style="padding-top: 50px;">
		<div class="row">
			<div class="col-xxl-2 col-xl-2 col-lg-2"></div>
			<div class="col-xxl-8 col-xl-8 col-lg-8" style="padding-bottom: 70px;">
				<?php foreach(website::getWebsiteSectionForm($section_type['section_id']) as $sectionForm) {
					if($sectionForm['WSF_image_id'] != NULL) {
						foreach(website::getWebsiteImageByID(intval($sectionForm['WSF_image_id'])) as $image) { ?>						
							<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?><?= $image['image_path'] ?>" alt="<?= $image['alt_text'] ?>"/>
						<?php }					
					} ?>
					<br><br><br>
					<h1><?= $sectionForm['WSF_section_name'] ?></h1>
					<?= $sectionForm['WSF_form_header'] ?><br>
					<?= $sectionForm['WSF_form_subheader'] ?>
					<script>
						// Ensure the path is generated properly with PHP
						var relativePath = "<?= str_repeat('../', count($pageRoutePath) - 1) ?>";
					</script>
					<form method="post" onsubmit="addPhygitalApplication(event, relativePath)">
						<table>
							<tr>
								<td>									
									<label for="company_name">Ime podjetja: <span style="color: red;">*</span></label><br>
									<input type="text" id="company_name" name="company_name" placeholder="Janez Novak d.o.o." required><br>
								</td>
								<td>
									<label for="team_name">Ime ekipe: <span style="color: red;">*</span></label><br>
									<input type="text" id="team_name" name="team_name" placeholder="Janezki" required><br>
								</td>
							</tr>
						</table>
						<label for="team_logo">Logo ekipe: <span style="color: red;">*</span></label><br>
						<input type="file" id="team_logo" name="team_logo" accept="image/png, image/jpeg" /><br>
						<table>
							<tr>
								<td>
									<label for="country">Država: <span style="color: red;">*</span></label><br>
									<input type="text" id="country" name="country" placeholder="Slovenija" required><br>
								</td>
								<td>
									<label for="city">Mesto: <span style="color: red;">*</span></label><br>
									<input type="text" id="city" name="city" placeholder="Ljubljana" required><br>
								</td>
							</tr>
						</table>
						<label for="team_representative">Reprezentant ekipe: <span style="color: red;">*</span></label><br>
						<input type="text" id="team_representative" name="team_representative" placeholder="Janez Novak" required><br>
						<table>
							<tr>
								<td>
									<label for="contact_number">Kontaktna številka: <span style="color: red;">*</span></label><br>
									<input type="text" id="contact_number" name="contact_number" placeholder="031 000 000" required><br>
								</td>
								<td>
									<label for="contact_email">Kontaktni e-poštni naslov: <span style="color: red;">*</span></label><br>
									<input type="text" id="contact_email" name="contact_email" placeholder="janez.novak@gmail.com" required><br>
								</td>
							</tr>
						</table>
						<label for="about">O ekipi (npr. dosežki): </label><br>
						<input type="text" id="about" name="about" placeholder="Državni prvaki leta 2024, 3-kratni zmagovalci tekmovanja xyz,..."><br>
						<label for="team_social_media">Socialna omrežja: </label><br>
						<input type="text" id="team_social_media" name="team_social_media" placeholder="instagram: @janezki"><br>
						<div class="line"></div>
						<h4>Igralec 1</h4>
						<table>
							<tr>
								<td>
									<label for="name_1">Ime in priimek: <span style="color: red;">*</span></label><br>
									<input type="text" id="name_1" name="name_1" placeholder="Janez Novak" required><br>
								</td>
								<td>
									<label for="nickname_1">Vzdevek: <span style="color: red;">*</span></label><br>
									<input type="text" id="nickname_1" name="nickname_1" placeholder="janko_kralj" required><br>
								</td>
							<tr>
						</table>
						<label for="player_icon_1">Slika igralca: <span style="color: red;">*</span></label><br>
						<input type="file" id="player_icon_1" name="player_icon_1" required><br>
						<table>
							<tr>
								<td>
									<label for="player_sex_1">Spol: <span style="color: red;">*</span></label><br>
									<select id="player_sex_1" name="player_sex_1">
										<option value="F">Ž</option>
										<option value="M">M</option>
									</select>
								</td>
								<td>
									<label for="date_of_birth_1">Datum rojstva: <span style="color: red;">*</span></label><br>
									<input type="date" id="date_of_birth_1" name="date_of_birth_1" required><br>
								</td>
							</tr>
						</table>
						<label for="player_nationality_1">Državljanstvo: <span style="color: red;">*</span></label><br>
						<input type="text" id="player_nationality_1" name="player_nationality_1" placeholder="slovensko" required><br>		
						<table>
							<tr>
								<td>		
									<label for="player_emso_1">EMŠO: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_emso_1" name="player_emso_1" placeholder="1211981500126" required><br>
								</td>
								<td>
									<label for="player_document_no_1">Številka dokumenta: <span style="color: red;">*</span></label><br>
									<input type="text" id="player_document_no_1" name="player_document_no_1" placeholder="IE9876543" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_position_1">Pozicija igralca: <span style="color: red;">*</span></label><br>
									<select id="player_position_1" name="player_position_1" required>
										<option value="Goalkeeper">Vratar</option>
										<option value="Field">Igrišče</option>
										<option value="Coach">Trener</option>
										<option value="Staff">Osebje</option>
									</select>
								</td>
								<td>
									<label for="player_jersey_1">Številka dresa: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_jersey_1" name="player_jersey_1" placeholder="72" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_class_p_1">Razred "P" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_1" name="player_class_p_1" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
								<td>
									<label for="player_class_p_plus_1">Razred "P+" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_plus_1" name="player_class_p_plus_1" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
							</tr>
						</table>						
						<label for="player_social_media_1">Socialna omrežja igralca: </label><br>
						<input type="text" id="player_social_media_1" name="player_social_media_1" placeholder="Instagram: @janezeknovak"><br>
						<div class="line"></div>
						<h4>Igralec 2</h4>
						<table>
							<tr>
								<td>
									<label for="name_2">Ime in priimek: <span style="color: red;">*</span></label><br>
									<input type="text" id="name_2" name="name_2" placeholder="Janez Novak" required><br>
								</td>
								<td>
									<label for="nickname_2">Vzdevek: <span style="color: red;">*</span></label><br>
									<input type="text" id="nickname_2" name="nickname_2" placeholder="janko_kralj" required><br>
								</td>
							<tr>
						</table>
						<label for="player_icon_2">Slika igralca: <span style="color: red;">*</span></label><br>
						<input type="file" id="player_icon_2" name="player_icon_2" required><br>
						<table>
							<tr>
								<td>
									<label for="player_sex_2">Spol: <span style="color: red;">*</span></label><br>
									<select id="player_sex_2" name="player_sex_2">
										<option value="F">Ž</option>
										<option value="M">M</option>
									</select>
								</td>
								<td>
									<label for="date_of_birth_2">Datum rojstva: <span style="color: red;">*</span></label><br>
									<input type="date" id="date_of_birth_2" name="date_of_birth_2" required><br>
								</td>
							</tr>
						</table>
						<label for="player_nationality_2">Državljanstvo: <span style="color: red;">*</span></label><br>
						<input type="text" id="player_nationality_2" name="player_nationality_2" placeholder="slovensko" required><br>		
						<table>
							<tr>
								<td>		
									<label for="player_emso_2">EMŠO: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_emso_2" name="player_emso_2" placeholder="1211981500126" required><br>
								</td>
								<td>
									<label for="player_document_no_2">Številka dokumenta: <span style="color: red;">*</span></label><br>
									<input type="text" id="player_document_no_2" name="player_document_no_2" placeholder="IE9876543" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_position_2">Pozicija igralca: <span style="color: red;">*</span></label><br>
									<select id="player_position_2" name="player_position_2" required>
										<option value="Goalkeeper">Vratar</option>
										<option value="Field">Igrišče</option>
										<option value="Coach">Trener</option>
										<option value="Staff">Osebje</option>
									</select>
								</td>
								<td>
									<label for="player_jersey_2">Številka dresa: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_jersey_2" name="player_jersey_2" placeholder="72" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_class_p_2">Razred "P" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_2" name="player_class_p_2" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
								<td>
									<label for="player_class_p_plus_2">Razred "P+" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_plus_2" name="player_class_p_plus_2" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
							</tr>
						</table>						
						<label for="player_social_media_2">Socialna omrežja igralca: </label><br>
						<input type="text" id="player_social_media_2" name="player_social_media_2" placeholder="Instagram: @janezeknovak"><br>
						<div class="line"></div>
						<h4>Igralec 3</h4>
						<table>
							<tr>
								<td>
									<label for="name_3">Ime in priimek: <span style="color: red;">*</span></label><br>
									<input type="text" id="name_3" name="name_3" placeholder="Janez Novak" required><br>
								</td>
								<td>
									<label for="nickname_3">Vzdevek: <span style="color: red;">*</span></label><br>
									<input type="text" id="nickname_3" name="nickname_3" placeholder="janko_kralj" required><br>
								</td>
							</tr>
						</table>
						<label for="player_icon_3">Slika igralca: <span style="color: red;">*</span></label><br>
						<input type="file" id="player_icon_3" name="player_icon_3" required><br>
						<table>
							<tr>
								<td>
									<label for="player_sex_3">Spol: <span style="color: red;">*</span></label><br>
									<select id="player_sex_3" name="player_sex_3">
										<option value="F">Ž</option>
										<option value="M">M</option>
									</select>
								</td>
								<td>
									<label for="date_of_birth_3">Datum rojstva: <span style="color: red;">*</span></label><br>
									<input type="date" id="date_of_birth_3" name="date_of_birth_3" required><br>
								</td>
							</tr>
						</table>
						<label for="player_nationality_3">Državljanstvo: <span style="color: red;">*</span></label><br>
						<input type="text" id="player_nationality_3" name="player_nationality_3" placeholder="slovensko" required><br>		
						<table>
							<tr>
								<td>		
									<label for="player_emso_3">EMŠO: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_emso_3" name="player_emso_3" placeholder="1211981500126" required><br>
								</td>
								<td>
									<label for="player_document_no_3">Številka dokumenta: <span style="color: red;">*</span></label><br>
									<input type="text" id="player_document_no_3" name="player_document_no_3" placeholder="IE9876543" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_position_3">Pozicija igralca: <span style="color: red;">*</span></label><br>
									<select id="player_position_3" name="player_position_3" required>
										<option value="Goalkeeper">Vratar</option>
										<option value="Field">Igrišče</option>
										<option value="Coach">Trener</option>
										<option value="Staff">Osebje</option>
									</select>
								</td>
								<td>
									<label for="player_jersey_3">Številka dresa: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_jersey_3" name="player_jersey_3" placeholder="72" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_class_p_3">Razred "P" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_3" name="player_class_p_3" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
								<td>
									<label for="player_class_p_plus_3">Razred "P+" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_plus_3" name="player_class_p_plus_3" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
							</tr>
						</table>						
						<label for="player_social_media_3">Socialna omrežja igralca: </label><br>
						<input type="text" id="player_social_media_3" name="player_social_media_3" placeholder="Instagram: @janezeknovak"><br>

						<div class="line"></div>
						<h4>Igralec 4</h4>
						<table>
							<tr>
								<td>
									<label for="name_4">Ime in priimek: <span style="color: red;">*</span></label><br>
									<input type="text" id="name_4" name="name_4" placeholder="Janez Novak" required><br>
								</td>
								<td>
									<label for="nickname_4">Vzdevek: <span style="color: red;">*</span></label><br>
									<input type="text" id="nickname_4" name="nickname_4" placeholder="janko_kralj" required><br>
								</td>
							</tr>
						</table>
						<label for="player_icon_4">Slika igralca: <span style="color: red;">*</span></label><br>
						<input type="file" id="player_icon_4" name="player_icon_4" required><br>
						<table>
							<tr>
								<td>
									<label for="player_sex_4">Spol: <span style="color: red;">*</span></label><br>
									<select id="player_sex_4" name="player_sex_4">
										<option value="F">Ž</option>
										<option value="M">M</option>
									</select>
								</td>
								<td>
									<label for="date_of_birth_4">Datum rojstva: <span style="color: red;">*</span></label><br>
									<input type="date" id="date_of_birth_4" name="date_of_birth_4" required><br>
								</td>
							</tr>
						</table>
						<label for="player_nationality_4">Državljanstvo: <span style="color: red;">*</span></label><br>
						<input type="text" id="player_nationality_4" name="player_nationality_4" placeholder="slovensko" required><br>		
						<table>
							<tr>
								<td>		
									<label for="player_emso_4">EMŠO: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_emso_4" name="player_emso_4" placeholder="1211981500126" required><br>
								</td>
								<td>
									<label for="player_document_no_4">Številka dokumenta: <span style="color: red;">*</span></label><br>
									<input type="text" id="player_document_no_4" name="player_document_no_4" placeholder="IE9876543" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_position_4">Pozicija igralca: <span style="color: red;">*</span></label><br>
									<select id="player_position_4" name="player_position_4" required>
										<option value="Goalkeeper">Vratar</option>
										<option value="Field">Igrišče</option>
										<option value="Coach">Trener</option>
										<option value="Staff">Osebje</option>
									</select>
								</td>
								<td>
									<label for="player_jersey_4">Številka dresa: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_jersey_4" name="player_jersey_4" placeholder="72" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_class_p_4">Razred "P" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_4" name="player_class_p_4" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
								<td>
									<label for="player_class_p_plus_4">Razred "P+" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_plus_4" name="player_class_p_plus_4" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
							</tr>
						</table>						
						<label for="player_social_media_4">Socialna omrežja igralca: </label><br>
						<input type="text" id="player_social_media_4" name="player_social_media_4" placeholder="Instagram: @janezeknovak"><br>
						<div class="line"></div>
						<h4>Igralec 5</h4>
						<table>
							<tr>
								<td>
									<label for="name_5">Ime in priimek: <span style="color: red;">*</span></label><br>
									<input type="text" id="name_5" name="name_5" placeholder="Janez Novak" required><br>
								</td>
								<td>
									<label for="nickname_5">Vzdevek: <span style="color: red;">*</span></label><br>
									<input type="text" id="nickname_5" name="nickname_5" placeholder="janko_kralj" required><br>
								</td>
							</tr>
						</table>
						<label for="player_icon_5">Slika igralca: <span style="color: red;">*</span></label><br>
						<input type="file" id="player_icon_5" name="player_icon_5" required><br>
						<table>
							<tr>
								<td>
									<label for="player_sex_5">Spol: <span style="color: red;">*</span></label><br>
									<select id="player_sex_5" name="player_sex_5">
										<option value="F">Ž</option>
										<option value="M">M</option>
									</select>
								</td>
								<td>
									<label for="date_of_birth_5">Datum rojstva: <span style="color: red;">*</span></label><br>
									<input type="date" id="date_of_birth_5" name="date_of_birth_5" required><br>
								</td>
							</tr>
						</table>
						<label for="player_nationality_5">Državljanstvo: <span style="color: red;">*</span></label><br>
						<input type="text" id="player_nationality_5" name="player_nationality_5" placeholder="slovensko" required><br>		
						<table>
							<tr>
								<td>		
									<label for="player_emso_5">EMŠO: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_emso_5" name="player_emso_5" placeholder="1211981500126" required><br>
								</td>
								<td>
									<label for="player_document_no_5">Številka dokumenta: <span style="color: red;">*</span></label><br>
									<input type="text" id="player_document_no_5" name="player_document_no_5" placeholder="IE9876543" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_position_5">Pozicija igralca: <span style="color: red;">*</span></label><br>
									<select id="player_position_5" name="player_position_5" required>
										<option value="Goalkeeper">Vratar</option>
										<option value="Field">Igrišče</option>
										<option value="Coach">Trener</option>
										<option value="Staff">Osebje</option>
									</select>
								</td>
								<td>
									<label for="player_jersey_5">Številka dresa: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_jersey_5" name="player_jersey_5" placeholder="72" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_class_p_5">Razred "P" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_5" name="player_class_p_5" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
								<td>
									<label for="player_class_p_plus_5">Razred "P+" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_plus_5" name="player_class_p_plus_5" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
							</tr>
						</table>						
						<label for="player_social_media_5">Socialna omrežja igralca: </label><br>
						<input type="text" id="player_social_media_5" name="player_social_media_5" placeholder="Instagram: @janezeknovak"><br>

						<div class="line"></div>
						<h4>Igralec 6</h4>
						<table>
							<tr>
								<td>
									<label for="name_6">Ime in priimek: <span style="color: red;">*</span></label><br>
									<input type="text" id="name_6" name="name_6" placeholder="Janez Novak" required><br>
								</td>
								<td>
									<label for="nickname_6">Vzdevek: <span style="color: red;">*</span></label><br>
									<input type="text" id="nickname_6" name="nickname_6" placeholder="janko_kralj" required><br>
								</td>
							</tr>
						</table>
						<label for="player_icon_6">Slika igralca: <span style="color: red;">*</span></label><br>
						<input type="file" id="player_icon_6" name="player_icon_6" required><br>
						<table>
							<tr>
								<td>
									<label for="player_sex_6">Spol: <span style="color: red;">*</span></label><br>
									<select id="player_sex_6" name="player_sex_6">
										<option value="F">Ž</option>
										<option value="M">M</option>
									</select>
								</td>
								<td>
									<label for="date_of_birth_6">Datum rojstva: <span style="color: red;">*</span></label><br>
									<input type="date" id="date_of_birth_6" name="date_of_birth_6" required><br>
								</td>
							</tr>
						</table>
						<label for="player_nationality_6">Državljanstvo: <span style="color: red;">*</span></label><br>
						<input type="text" id="player_nationality_6" name="player_nationality_6" placeholder="slovensko" required><br>		
						<table>
							<tr>
								<td>		
									<label for="player_emso_6">EMŠO: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_emso_6" name="player_emso_6" placeholder="1211981500126" required><br>
								</td>
								<td>
									<label for="player_document_no_6">Številka dokumenta: <span style="color: red;">*</span></label><br>
									<input type="text" id="player_document_no_6" name="player_document_no_6" placeholder="IE9876543" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_position_6">Pozicija igralca: <span style="color: red;">*</span></label><br>
									<select id="player_position_6" name="player_position_6" required>
										<option value="Goalkeeper">Vratar</option>
										<option value="Field">Igrišče</option>
										<option value="Coach">Trener</option>
										<option value="Staff">Osebje</option>
									</select>
								</td>
								<td>
									<label for="player_jersey_6">Številka dresa: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_jersey_6" name="player_jersey_6" placeholder="72" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_class_p_6">Razred "P" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_6" name="player_class_p_6" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
								<td>
									<label for="player_class_p_plus_6">Razred "P+" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_plus_6" name="player_class_p_plus_6" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
							</tr>
						</table>						
						<label for="player_social_media_6">Socialna omrežja igralca: </label><br>
						<input type="text" id="player_social_media_6" name="player_social_media_6" placeholder="Instagram: @janezeknovak"><br>
						<div class="line"></div>
						<h4>Igralec 7</h4>
						<table>
							<tr>
								<td>
									<label for="name_7">Ime in priimek: <span style="color: red;">*</span></label><br>
									<input type="text" id="name_7" name="name_7" placeholder="Janez Novak" required><br>
								</td>
								<td>
									<label for="nickname_7">Vzdevek: <span style="color: red;">*</span></label><br>
									<input type="text" id="nickname_7" name="nickname_7" placeholder="janko_kralj" required><br>
								</td>
							</tr>
						</table>
						<label for="player_icon_7">Slika igralca: <span style="color: red;">*</span></label><br>
						<input type="file" id="player_icon_7" name="player_icon_7" required><br>
						<table>
							<tr>
								<td>
									<label for="player_sex_7">Spol: <span style="color: red;">*</span></label><br>
									<select id="player_sex_7" name="player_sex_7">
										<option value="F">Ž</option>
										<option value="M">M</option>
									</select>
								</td>
								<td>
									<label for="date_of_birth_7">Datum rojstva: <span style="color: red;">*</span></label><br>
									<input type="date" id="date_of_birth_7" name="date_of_birth_7" required><br>
								</td>
							</tr>
						</table>
						<label for="player_nationality_7">Državljanstvo: <span style="color: red;">*</span></label><br>
						<input type="text" id="player_nationality_7" name="player_nationality_7" placeholder="slovensko" required><br>		
						<table>
							<tr>
								<td>		
									<label for="player_emso_7">EMŠO: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_emso_7" name="player_emso_7" placeholder="1211981500126" required><br>
								</td>
								<td>
									<label for="player_document_no_7">Številka dokumenta: <span style="color: red;">*</span></label><br>
									<input type="text" id="player_document_no_7" name="player_document_no_7" placeholder="IE9876543" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_position_7">Pozicija igralca: <span style="color: red;">*</span></label><br>
									<select id="player_position_7" name="player_position_7" required>
										<option value="Goalkeeper">Vratar</option>
										<option value="Field">Igrišče</option>
										<option value="Coach">Trener</option>
										<option value="Staff">Osebje</option>
									</select>
								</td>
								<td>
									<label for="player_jersey_7">Številka dresa: <span style="color: red;">*</span></label><br>
									<input type="number" id="player_jersey_7" name="player_jersey_7" placeholder="72" required><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_class_p_7">Razred "P" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_7" name="player_class_p_7" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
								<td>
									<label for="player_class_p_plus_7">Razred "P+" igralec: <span style="color: red;">*</span></label><br>
									<select id="player_class_p_plus_7" name="player_class_p_plus_7" required>
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
							</tr>
						</table>						
						<label for="player_social_media_7">Socialna omrežja igralca: </label><br>
						<input type="text" id="player_social_media_7" name="player_social_media_7" placeholder="Instagram: @janezeknovak"><br>

						<div class="line"></div>
						<h4>Dodatno osebje 1</h4>
						<table>
							<tr>
								<td>
									<label for="name_8">Ime in priimek: </label><br>
									<input type="text" id="name_8" name="name_8" placeholder="Janez Novak"><br>
								</td>
								<td>
									<label for="nickname_8">Vzdevek: </label><br>
									<input type="text" id="nickname_8" name="nickname_8" placeholder="janko_kralj"><br>
								</td>
							</tr>
						</table>
						<label for="player_icon_8">Slika igralca: </label><br>
						<input type="file" id="player_icon_8" name="player_icon_8"><br>
						<table>
							<tr>
								<td>
									<label for="player_sex_8">Spol: </label><br>
									<select id="player_sex_8" name="player_sex_8">
										<option value="F">Ž</option>
										<option value="M">M</option>
									</select>
								</td>
								<td>
									<label for="date_of_birth_8">Datum rojstva: </label><br>
									<input type="date" id="date_of_birth_8" name="date_of_birth_8"><br>
								</td>
							</tr>
						</table>
						<label for="player_nationality_8">Državljanstvo: </label><br>
						<input type="text" id="player_nationality_8" name="player_nationality_8" placeholder="slovensko"><br>		
						<table>
							<tr>
								<td>		
									<label for="player_emso_8">EMŠO: </label><br>
									<input type="number" id="player_emso_8" name="player_emso_8" placeholder="1211981500126"><br>
								</td>
								<td>
									<label for="player_document_no_8">Številka dokumenta: </label><br>
									<input type="text" id="player_document_no_8" name="player_document_no_8" placeholder="IE9876543"><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_position_8">Pozicija igralca: </label><br>
									<select id="player_position_8" name="player_position_8">
										<option value="Goalkeeper">Vratar</option>
										<option value="Field">Igrišče</option>
										<option value="Coach">Trener</option>
										<option value="Staff">Osebje</option>
									</select>
								</td>
								<td>
									<label for="player_jersey_8">Številka dresa: </label><br>
									<input type="number" id="player_jersey_8" name="player_jersey_8" placeholder="72"><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_class_p_8">Razred "P" igralec: </label><br>
									<select id="player_class_p_8" name="player_class_p_8">
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
								<td>
									<label for="player_class_p_plus_8">Razred "P+" igralec: </label><br>
									<select id="player_class_p_plus_8" name="player_class_p_plus_8">
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
							</tr>
						</table>						
						<label for="player_social_media_8">Socialna omrežja igralca: </label><br>
						<input type="text" id="player_social_media_8" name="player_social_media_8" placeholder="Instagram: @janezeknovak"><br>

						<div class="line"></div>
						<h4>Dodatno osebje 2</h4>
						<table>
							<tr>
								<td>
									<label for="name_9">Ime in priimek: </label><br>
									<input type="text" id="name_9" name="name_9" placeholder="Janez Novak"><br>
								</td>
								<td>
									<label for="nickname_9">Vzdevek: </label><br>
									<input type="text" id="nickname_9" name="nickname_9" placeholder="janko_kralj"><br>
								</td>
							</tr>
						</table>
						<label for="player_icon_9">Slika igralca: </label><br>
						<input type="file" id="player_icon_9" name="player_icon_9"><br>
						<table>
							<tr>
								<td>
									<label for="player_sex_9">Spol: </label><br>
									<select id="player_sex_9" name="player_sex_9">
										<option value="F">Ž</option>
										<option value="M">M</option>
									</select>
								</td>
								<td>
									<label for="date_of_birth_9">Datum rojstva: </label><br>
									<input type="date" id="date_of_birth_9" name="date_of_birth_9"><br>
								</td>
							</tr>
						</table>
						<label for="player_nationality_9">Državljanstvo: </label><br>
						<input type="text" id="player_nationality_9" name="player_nationality_9" placeholder="slovensko"><br>		
						<table>
							<tr>
								<td>		
									<label for="player_emso_9">EMŠO: </label><br>
									<input type="number" id="player_emso_9" name="player_emso_9" placeholder="1211981500126"><br>
								</td>
								<td>
									<label for="player_document_no_9">Številka dokumenta: </label><br>
									<input type="text" id="player_document_no_9" name="player_document_no_9" placeholder="IE9876543"><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_position_9">Pozicija igralca: </label><br>
									<select id="player_position_9" name="player_position_9">
										<option value="Goalkeeper">Vratar</option>
										<option value="Field">Igrišče</option>
										<option value="Coach">Trener</option>
										<option value="Staff">Osebje</option>
									</select>
								</td>
								<td>
									<label for="player_jersey_9">Številka dresa: </label><br>
									<input type="number" id="player_jersey_9" name="player_jersey_9" placeholder="72"><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_class_p_9">Razred "P" igralec: </label><br>
									<select id="player_class_p_9" name="player_class_p_9">
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
								<td>
									<label for="player_class_p_plus_9">Razred "P+" igralec: </label><br>
									<select id="player_class_p_plus_9" name="player_class_p_plus_9">
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
							</tr>
						</table>						
						<label for="player_social_media_9">Socialna omrežja igralca: </label><br>
						<input type="text" id="player_social_media_9" name="player_social_media_9" placeholder="Instagram: @janezeknovak"><br>

						<div class="line"></div>
						<h4>Dodatno osebje 3</h4>
						<table>
							<tr>
								<td>
									<label for="name_10">Ime in priimek: </label><br>
									<input type="text" id="name_10" name="name_10" placeholder="Janez Novak"><br>
								</td>
								<td>
									<label for="nickname_10">Vzdevek: </label><br>
									<input type="text" id="nickname_10" name="nickname_10" placeholder="janko_kralj"><br>
								</td>
							</tr>
						</table>
						<label for="player_icon_10">Slika igralca: </label><br>
						<input type="file" id="player_icon_10" name="player_icon_10"><br>
						<table>
							<tr>
								<td>
									<label for="player_sex_10">Spol: </label><br>
									<select id="player_sex_10" name="player_sex_10">
										<option value="F">Ž</option>
										<option value="M">M</option>
									</select>
								</td>
								<td>
									<label for="date_of_birth_10">Datum rojstva: </label><br>
									<input type="date" id="date_of_birth_10" name="date_of_birth_10"><br>
								</td>
							</tr>
						</table>
						<label for="player_nationality_10">Državljanstvo: </label><br>
						<input type="text" id="player_nationality_10" name="player_nationality_10" placeholder="slovensko"><br>		
						<table>
							<tr>
								<td>		
									<label for="player_emso_10">EMŠO: </label><br>
									<input type="number" id="player_emso_10" name="player_emso_10" placeholder="1211981500126"><br>
								</td>
								<td>
									<label for="player_document_no_10">Številka dokumenta: </label><br>
									<input type="text" id="player_document_no_10" name="player_document_no_10" placeholder="IE9876543"><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_position_10">Pozicija igralca: </label><br>
									<select id="player_position_10" name="player_position_10">
										<option value="Goalkeeper">Vratar</option>
										<option value="Field">Igrišče</option>
										<option value="Coach">Trener</option>
										<option value="Staff">Osebje</option>
									</select>
								</td>
								<td>
									<label for="player_jersey_10">Številka dresa: </label><br>
									<input type="number" id="player_jersey_10" name="player_jersey_10" placeholder="72"><br>
								</td>
							</tr>
							<tr>
								<td>
									<label for="player_class_p_10">Razred "P" igralec: </label><br>
									<select id="player_class_p_10" name="player_class_p_10">
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
								<td>
									<label for="player_class_p_plus_10">Razred "P+" igralec: </label><br>
									<select id="player_class_p_plus_10" name="player_class_p_plus_10">
										<option value="1">Da</option>
										<option value="0">Ne</option>
									</select>
								</td>
							</tr>
						</table>						
						<label for="player_social_media_10">Socialna omrežja igralca: </label><br>
						<input type="text" id="player_social_media_10" name="player_social_media_10" placeholder="Instagram: @janezeknovak"><br>


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