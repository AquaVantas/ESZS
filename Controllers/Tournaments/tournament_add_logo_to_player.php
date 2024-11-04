<?php    
	require_once("../../Internal/tournament_database.php");

    if (!isset($_POST['player'], $_POST['tournament_id'], $_POST['logo'], $_POST['mimeType'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit();
    }

    $player = filter_var($_POST['player']);
    $tournamentId = (int)$_POST['tournament_id'];
    $logo = filter_var($_POST['logo']);
    $mimeType = filter_var($_POST['mimeType']);

    $allowedTypes = ['image/jpeg', 'image/png'];
    if(!in_array($mimeType, $allowedTypes)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Wrong image type of logo']);
        exit();
    }

    $gameId = 0;

    foreach(tournament::getTournamentGame($tournamentId) as $game) {
        $gameId = $game['game_id'];
    }

    switch($gameId) {
        case 0:
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Game of match could not be found']);
            exit();
        case 5:
            $affectedRows = tournament::addLogoToPlayerValorant($player, $logo, $mimeType);
            break;
        default:
            break;
    }

    if ($affectedRows > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Logo updated successfully']);
    } elseif($affectedRows === 0) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'No matching team found or logo not updated']);
    }
    else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Failed to add match']);
    }
?>