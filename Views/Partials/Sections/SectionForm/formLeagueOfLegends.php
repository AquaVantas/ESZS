<div class="container" style="padding-top: 50px;">
	<div class="row">
		<div class="col-xxl-2 col-xl-2 col-lg-2"></div>
		<div class="col-xxl-8 col-xl-8 col-lg-8" style="padding-bottom: 70px;">
			<img src="<?= str_repeat("../", count($pageRoutePath) - 1) ?>Content/WebsiteImages/Images/Events/SDP/2023-2024/Valorant_prijave_odprte.jpg" width="100%">
			<br><br><br>
			<h1>Prijavnica na kvalifikacije za svetovno prvenstvo iz Valorant</h1>
			Polja označena z <span style="color: red;">*</span> so obvezna!<br>
			Prijave se zbirajo do 8. 9. 2023.
					
					
			<form method="post" action="Controllers/Website/submitEFootball.php"><br>
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
				<label for="nickname">Playstation ID: <span style="color: red;">*</span></label><br>
				<input type="text" id="nickname" name="nickname" placeholder="KawaiiJanez"><br>
				<label for="dateofbirth">Datum rojstva: <span style="color: red;">*</span></label><br>
				<input type="date" id="dateofbirth" name="dateofbirth"><br>
				<label for="postalcode">Poštna številka: <span style="color: red;">*</span></label><br>
				<input type="text" id="postalcode" name="postalcode" placeholder="1000"><br><br>
						
				<table width="100%">
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
		</div>
		<div class="col-xxl-2 col-xl-2 col-lg-2"></div>
		<div class="col-12" style="width: 100vw; height: 100vh; display: flex; justify-content: center; align-items: center;">
			<h1>Prijavnice se odprejo 19. 12. 2022!</h1>
		</div>
	</div>
</div>