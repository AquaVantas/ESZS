<?php	
	require_once("../Internal/tournament_database.php");

	if(!isset($_POST['title']) || !isset($_POST['game']) || !isset($_POST['tournament-start']) || !isset($_POST['tournament-end'])) {
		header("url=../cpanel.php?tab=tournament");
	}

	$title = $_POST['title'];
	$game_id = $_POST['game'];
	$start = $_POST['tournament-start'];
	$end = $_POST['tournament-end'];

	//add to database
	if($_POST['title'] != NULL) {
		tournament::addTournament($title, $game_id, $start, $end);
	}

	//reditect back to tournament list
	header("Location:../cpanel.php?tab=tournament");

	echo $start;
?>