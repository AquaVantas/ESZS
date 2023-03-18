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
					<div class="col-4">
						<h3><?= $game['game_title'] ?></h3>
					</div>				
				<?php }
			?>
		</div>
	</div>
<?php } ?>