<?php
	require_once("../../Internal/tournament_database.php");

	if(!isset($_POST['team_one_score']) || !isset($_GET['team_two_score'])) {
		header("url=../../cpanel.php?tab=tournaments");
	}

	$team_one_score = $_POST['team_one_score'];
	$team_two_score = $_POST['team_two_score'];
	$match_done = isset($_POST['match_done']) ? 1 : 0;
	
	tournament::editTournamentMatch($_GET['match_id'], $team_one_score, $team_two_score, $match_done);

	header("Location:../../cpanel.php?tab=tournaments");
?>