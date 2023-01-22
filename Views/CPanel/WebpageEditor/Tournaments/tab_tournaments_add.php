<?php if((isset($cpanel_tab)) && ($cpanel_tab == "tournament_add") && $role_admin) { ?>
	<div class="user-body container">
		<div class="row">
			<div class="col-12 create-bar">
				<a class="btn btn-primary" href="?tab=tournaments"><div class="arrow-icon"></div>Nazaj</a>
			</div>
		</div>
	</div>
	<div class="container user-body">
		<div class="row">
			<div class="create-user col-8 offset-2">						
				<form class="row" method="post" action="Controllers/tournament_add_tournament.php">
					<div class="col-6">
						<label for="title">Naslov turnirja:</label><br>
						<input type="text" id="title" name="title" placeholder="SDP League of Legends" required>
					</div>								
					<div class="col-6">
						<label for="game">Igra:</label><br>
						<select id="game" name="game" required>
							<?php foreach(tournament::getAllGames() as $game) { ?>
								<option value="<?= $game['id'] ?>"><?= $game['game_title'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-6">
						<label for="tournament-start">Začetek prijav:</label>
						<input type="datetime-local" id="tournament-start" name="tournament-start" value="<?= date('d-m-Y H:m', time()) ?>">
					</div>
					<div class="col-6">
						<label for="tournament-end">Konec prijav:</label>
						<input type="datetime-local" id="tournament-end" name="tournament-end" value="<?= date('d-m-Y H:m', time()) ?>">
					</div>
					<div class="col-12 submit-field">
						<input class="btn btn-primary submit" type="submit" value="Dodaj turnir">
					</div>								
				</form>
			</div>
		</div>
	</div>
<?php } ?>