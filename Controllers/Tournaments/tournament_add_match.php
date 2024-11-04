<?php    
	require_once("../../Internal/tournament_database.php");

    if (empty($_POST['dateTime']) || $_POST['dateTime'] === '0000-00-00 00:00:00') {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid or missing dateTime']);
        exit();
    }

    if (!isset($_POST['gameId'], $_POST['tournamentId'], $_POST['playerOne'], $_POST['playerTwo'], $_POST['playerOnePoints'], $_POST['playerTwoPoints'], $_POST['dateTime'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit();
    }
    
    $gameId = (int)$_POST['gameId'];
    $tournamentId = (int)$_POST['tournamentId'];
    $playerOne = filter_var($_POST['playerOne'], FILTER_SANITIZE_STRING);
    $playerTwo = filter_var($_POST['playerTwo'], FILTER_SANITIZE_STRING);
    $playerOnePoints = (int)$_POST['playerOnePoints'];
    $playerTwoPoints = (int)$_POST['playerTwoPoints'];
    $dateTime = filter_var($_POST['dateTime'], FILTER_SANITIZE_STRING);

    $matchId = tournament::addMatch($gameId, $tournamentId, $playerOne, $playerTwo, $playerOnePoints, $playerTwoPoints, $dateTime);

    if ($matchId) {
        echo json_encode(['status' => 'success', 'message' => 'Match added successfully', 'matchId' => $matchId]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Failed to add match']);
    }
?>