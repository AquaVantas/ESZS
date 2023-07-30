<?php if((isset($cpanel_tab)) && ($cpanel_tab == "tournament")) { ?>
	<div class="container user-body">
		<div class="row">
			<div class="col-12 create-bar">
				<a class="btn btn-primary" href="?tab=tournaments">Nazaj</a>
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
							<a href="" class="tournament"><?= $tournament['tournament_title'] ?></a>
						<?php } ?>
					</div>				
				<?php }
			?>
		</div>
	</div>
<?php } ?>