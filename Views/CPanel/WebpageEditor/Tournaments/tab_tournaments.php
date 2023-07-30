<?php if((isset($cpanel_tab)) && ($cpanel_tab == "tournaments")) { ?>
	<div class="container user-body">
		<div class="row">
			<div class="col-12 create-bar">
				<a class="btn btn-primary" href="?tab=tournament_add">Ustvari turnir</a>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<?php 
				foreach(tournament::getAllGames() as $game) { ?>
					<div class="col-4 tournament-list">
						<h4><?= $game['game_title'] ?></h4>
						<?php foreach(tournament::getTournamentsByGame($game['id']) as $tournament) { ?>
							<a href="?tab=tournament&tournament_id=<?= $tournament['id'] ?>" class="tournament"><?= $tournament['tournament_title'] ?></a>
						<?php } ?>
					</div>				
				<?php }
			?>
		</div>
	</div>
<?php } ?>