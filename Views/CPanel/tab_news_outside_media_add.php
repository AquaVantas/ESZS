<?php 
if(isset($cpanel_tab) && $cpanel_tab == "news_outside_media_add" && ($role_admin || $role_news)) { ?>
	<div class="user-body container">
		<div class="row">
			<div class="col-12 create-bar">
				<a class="btn btn-primary" href="?tab=user_list"><div class="arrow-icon"></div>Prekliči</a>
			</div>
			<div class="col-8 offset-2 create-user">s
			<form class="row" method="post" action="Controllers/news_add_outside_media.php">
					<div class="col-6">
						<label for="media-name">Ime medija:</label><br>
						<input type="text" id="media-name" name="media-name" placeholder="Radio 1" required>
					</div>								
					<div class="col-6">
						<label for="media-type">Tip medija:</label><br>
						<select id="media-type" name="media-type" required>
							<option value="Televizija">Televizija</option>
							<option value="Časopis">Časopis</option>
							<option value="Radio">Radio</option>
							<option value="Ostalo">Ostalo</option>
						</select>
					</div>				
					<div class="col-6">
						<label for="contact-name">Ime kontaktne osebe:</label><br>
						<input type="text" id="contact-name" name="contact-name" placeholder="Janez">
					</div>								
					<div class="col-6">
						<label for="contact-surname">Priimek kontakne osebe:</label><br>
						<input type="text" id="contact-surname" name="contact-surname" placeholder="Novak">
					</div>
					<div class="col-12">
						<label for="contact-title">Naziv kontaktne osebe:</label><br>
						<input type="text" id="contact-title" name="contact-title" placeholder="Odgovorni urednik športnega programa">
					</div>
					<div class="col-12">
						<label for="email">Email:</label><br>	
						<input type="text" id="email" name="email" placeholder="janez.novak@eszs.si">
					</div>
					<div class="col-6">
						<label for="phone-number">Telefonska številka:</label><br>
						<input type="text" id="phone-number" name="phone-number" placeholder="+386 40 420 690">
					</div>
					<div class="col-6">
						<label for="responsive">Odzivnost:</label><br>
						<select id="responsive" name="responsive" required>
							<option value="Yes">Da</option>
							<option value="No">Ne</option>
						</select>
					</div>
					<div class="col-12 submit-field">
						<input class="btn btn-primary submit" type="submit" value="Dodaj medij">
					</div>								
				</form>
			</div>
		</div>
	</div>
	<div class="user-body container">
		<div class="row">
			<div class="col-12">
				<table>
					<tr>
						<td>Medij</td>
						<td>Tip medija</td>
						<td>Kontaktna oseba</td>
						<td>Naziv kontaktne osebe</td>
						<td>Email</td>
						<td>Telefon</td>
						<td>Odzivnost</td>
					</tr>
					<?php
						foreach(news::getAllOutsideMedia() as $media) { ?>
							<tr>
								<td><?= $media['media_title'] ?></td>
								<td><?= $media['media_type'] ?></td>
								<td><?= $media['person_name'] ?> <?= $media['person_surname'] ?></td>
								<td><?= $media['person_title'] ?></td>
								<td><?= $media['email'] ?></td>
								<td><?= $media['phone'] ?></td>
								<td><?= $media['responsive'] ?></td>
							</tr>
							<?php
						}
					?>
				</table>
			</div>
		</div>
	</div>
<?php } ?>