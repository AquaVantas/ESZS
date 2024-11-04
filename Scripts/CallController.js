function talkToDatabase(path, data) {
    $.ajax({
        url: path,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (response) {
            console.log("I made it!");
        },
        error: function (response) {
            console.log(response);            
        }
    });
}

function addMatch(event, gameId, tournamentId) {
    event.preventDefault();

    const playerOne = document.getElementById('playerOne').value;
    const playerTwo = document.getElementById('playerTwo').value;
    const dateTime = document.getElementById('match-start').value;

    const data = {
        gameId: gameId,
        tournamentId: tournamentId,
        playerOne: playerOne,
        playerTwo: playerTwo,
        playerOnePoints: 0,
        playerTwoPoints: 0,
        dateTime: dateTime
    };

    talkToDatabase("Controllers/Tournaments/tournament_add_match.php", data);
}