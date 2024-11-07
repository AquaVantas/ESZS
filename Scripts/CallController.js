function talkToDatabase(path, data) {
    $.ajax({
        url: path,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (response) {
            Swal.fire({
                icon: "success",
                title: "Tvoje delo je bilo shranjeno.",
                text: "Za prikaz sprememb osveži stran."
            });
        },
        error: function (response) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Your programmer did a fucky wucky! Please poke her on Discord so she can rectify her miserable excuse of an existance."
            });
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