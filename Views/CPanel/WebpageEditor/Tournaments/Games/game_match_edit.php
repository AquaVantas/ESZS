<?php if((isset($cpanel_tab)) && ($cpanel_tab == "match_edit")) { ?>
	<div class="container user-body">
        <div class="row">
            <div class="col-12 create-bar">
                <a class="btn btn-primary" href="?tab=tournament&tournament_id=<?= $_GET['tournament_id'] ?>">Nazaj</a>
            </div>
        </div>
    </div>
	<div class="container">
		<div class="row">
            <div class="col-12">
                <?php foreach(tournament::getTournamentMatchById($_GET['match']) as $match) { ?>
                <form class="row" method="post" action="Controllers/Tournaments/tournament_match_edit.php?match_id=<?= $_GET['match'] ?>">
                    <div class="col-6">
                        <label for="team_one_score">Rezultat <?= $match['player_one'] ?>:</label><br>
                        <input type="text" id="team_one_score" name="team_one_score" value="<?= $match['player_one_score'] ?>" required>
                    </div>								
                    <div class="col-6">
                        <label for="team_two_score">Rezultat <?= $match['player_two'] ?>:</label><br>
                        <input type="text" id="team_two_score" name="team_two_score" value="<?= $match['player_two_score'] ?>" required>
                    </div>	
                    <div class="col-6 match-status">
                    <input type="checkbox" id="match_done" name="match_done" value="1" <?= $match['match_end'] ? 'checked' : '' ?>>
                        <span>Tekma zaključena</span>
                    </div>
                    <div class="col-12 submit-field-edit">
                        <input class="btn btn-primary submit" type="submit" value="Posodobi podatke">
                    </div>								
                </form>
                <?php } ?>
            </div>
		</div>
	</div>
<?php } ?>