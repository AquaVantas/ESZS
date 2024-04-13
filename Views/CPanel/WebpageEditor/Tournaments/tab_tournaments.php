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
				foreach(tournament::getAllGames() as $game) { 
					if(($game['game_title'] == "League of Legends" && $role_admin_league_of_legends) || 
					($game['game_title'] == "FIFA" && $role_admin_fifa) || 
					($game['game_title'] == "Valorant" && $role_admin_valorant) || 
					($game['game_title'] == "Counter Strike: Global Offensive" && $role_admin_cs_go) || 
					($game['game_title'] == "Assetto Corsa: Competizione" && $role_admin_acc) || 
					($game['game_title'] == "DiRT Rally 2.0" && $role_admin_dirt_rally_2_0) || 
					($game['game_title'] == "EFootball" && $role_admin_efootball) || 
					($game['game_title'] == "Mobile Legends" && $role_admin_mobile_legends) || 
					($game['game_title'] == "Rocket League" && $role_admin_rocket_league) || 
					($game['game_title'] == "Rainbow Six: Siege" && $role_admin_ranbox_six_siege) || 
					($game['game_title'] == "PUBG Mobile" && $role_admin_pubg_mobile) || 
					$role_admin) { ?>					
						<div class="col-4 tournament-list">
							<h4><?= $game['game_title'] ?></h4>
							<?php foreach(tournament::getTournamentsByGame($game['id']) as $tournament) { ?>
								<a href="?tab=tournament&tournament_id=<?= $tournament['id'] ?>" class="tournament"><?= $tournament['tournament_title'] ?></a>
							<?php } ?>
						</div>				
					<?php }
				}
			?>
		</div>
	</div>
<?php } ?>