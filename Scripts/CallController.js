function talkToDatabase(path, formData) {
    fetch(path, {
        method: 'POST',
        body: formData, // Pass FormData directly
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        Swal.fire({
            icon: "success",
            title: "Vaše delo je bilo uspešno zabeleženo.",
            text: "Osvežite stran."
        });
    })
    .catch(error => {
        Swal.fire({
            icon: "error",
            title: "Napaka",
            text: "Nekaj je šlo narobe."
        });
        console.error('There was a problem with the fetch operation:', error);
    });
}

function addPhygitalApplication(event, pathBack) {
    event.preventDefault();

    const formData = new FormData();
    formData.append('company_name', document.getElementById('company_name').value);
    formData.append('team_name', document.getElementById('team_name').value);
    formData.append('team_logo', document.getElementById('team_logo').files[0]); // Add file
    formData.append('country', document.getElementById('country').value);
    formData.append('city', document.getElementById('city').value);
    formData.append('team_representative', document.getElementById('team_representative').value);
    formData.append('contact_number', document.getElementById('contact_number').value);
    formData.append('contact_email', document.getElementById('contact_email').value);
    formData.append('about', document.getElementById('about').value);
    formData.append('team_social_media', document.getElementById('team_social_media').value);
    formData.append('name_1', document.getElementById('name_1').value);
    formData.append('nickname_1', document.getElementById('nickname_1').value);
    formData.append('player_icon_1', document.getElementById('player_icon_1').files[0]); // Add file
    formData.append('player_sex_1', document.getElementById('player_sex_1').value);
    formData.append('date_of_birth_1', document.getElementById('date_of_birth_1').value);
    formData.append('player_nationality_1', document.getElementById('player_nationality_1').value);
    formData.append('player_emso_1', document.getElementById('player_emso_1').value);
    formData.append('player_document_no_1', document.getElementById('player_document_no_1').value);
    formData.append('player_position_1', document.getElementById('player_position_1').value);
    formData.append('player_jersey_1', document.getElementById('player_jersey_1').value);
    formData.append('player_class_p_1', document.getElementById('player_class_p_1').value);
    formData.append('player_class_p_plus_1', document.getElementById('player_class_p_plus_1').value);
    formData.append('player_social_media_1', document.getElementById('player_social_media_1').value);

    formData.append('name_2', document.getElementById('name_2').value);
    formData.append('nickname_2', document.getElementById('nickname_2').value);
    formData.append('player_icon_2', document.getElementById('player_icon_2').files[0]); // Add file
    formData.append('player_sex_2', document.getElementById('player_sex_2').value);
    formData.append('date_of_birth_2', document.getElementById('date_of_birth_2').value);
    formData.append('player_nationality_2', document.getElementById('player_nationality_2').value);
    formData.append('player_emso_2', document.getElementById('player_emso_2').value);
    formData.append('player_document_no_2', document.getElementById('player_document_no_2').value);
    formData.append('player_position_2', document.getElementById('player_position_2').value);
    formData.append('player_jersey_2', document.getElementById('player_jersey_2').value);
    formData.append('player_class_p_2', document.getElementById('player_class_p_2').value);
    formData.append('player_class_p_plus_2', document.getElementById('player_class_p_plus_2').value);
    formData.append('player_social_media_2', document.getElementById('player_social_media_2').value);

    formData.append('name_3', document.getElementById('name_3').value);
    formData.append('nickname_3', document.getElementById('nickname_3').value);
    formData.append('player_icon_3', document.getElementById('player_icon_3').files[0]); // Add file
    formData.append('player_sex_3', document.getElementById('player_sex_3').value);
    formData.append('date_of_birth_3', document.getElementById('date_of_birth_3').value);
    formData.append('player_nationality_3', document.getElementById('player_nationality_3').value);
    formData.append('player_emso_3', document.getElementById('player_emso_3').value);
    formData.append('player_document_no_3', document.getElementById('player_document_no_3').value);
    formData.append('player_position_3', document.getElementById('player_position_3').value);
    formData.append('player_jersey_3', document.getElementById('player_jersey_3').value);
    formData.append('player_class_p_3', document.getElementById('player_class_p_3').value);
    formData.append('player_class_p_plus_3', document.getElementById('player_class_p_plus_3').value);
    formData.append('player_social_media_3', document.getElementById('player_social_media_3').value);

    formData.append('name_4', document.getElementById('name_4').value);
    formData.append('nickname_4', document.getElementById('nickname_4').value);
    formData.append('player_icon_4', document.getElementById('player_icon_4').files[0]); // Add file
    formData.append('player_sex_4', document.getElementById('player_sex_4').value);
    formData.append('date_of_birth_4', document.getElementById('date_of_birth_4').value);
    formData.append('player_nationality_4', document.getElementById('player_nationality_4').value);
    formData.append('player_emso_4', document.getElementById('player_emso_4').value);
    formData.append('player_document_no_4', document.getElementById('player_document_no_4').value);
    formData.append('player_position_4', document.getElementById('player_position_4').value);
    formData.append('player_jersey_4', document.getElementById('player_jersey_4').value);
    formData.append('player_class_p_4', document.getElementById('player_class_p_4').value);
    formData.append('player_class_p_plus_4', document.getElementById('player_class_p_plus_4').value);
    formData.append('player_social_media_4', document.getElementById('player_social_media_4').value);

    formData.append('name_5', document.getElementById('name_5').value);
    formData.append('nickname_5', document.getElementById('nickname_5').value);
    formData.append('player_icon_5', document.getElementById('player_icon_5').files[0]); // Add file
    formData.append('player_sex_5', document.getElementById('player_sex_5').value);
    formData.append('date_of_birth_5', document.getElementById('date_of_birth_5').value);
    formData.append('player_nationality_5', document.getElementById('player_nationality_5').value);
    formData.append('player_emso_5', document.getElementById('player_emso_5').value);
    formData.append('player_document_no_5', document.getElementById('player_document_no_5').value);
    formData.append('player_position_5', document.getElementById('player_position_5').value);
    formData.append('player_jersey_5', document.getElementById('player_jersey_5').value);
    formData.append('player_class_p_5', document.getElementById('player_class_p_5').value);
    formData.append('player_class_p_plus_5', document.getElementById('player_class_p_plus_5').value);
    formData.append('player_social_media_5', document.getElementById('player_social_media_5').value);

    formData.append('name_6', document.getElementById('name_6').value);
    formData.append('nickname_6', document.getElementById('nickname_6').value);
    formData.append('player_icon_6', document.getElementById('player_icon_6').files[0]); // Add file
    formData.append('player_sex_6', document.getElementById('player_sex_6').value);
    formData.append('date_of_birth_6', document.getElementById('date_of_birth_6').value);
    formData.append('player_nationality_6', document.getElementById('player_nationality_6').value);
    formData.append('player_emso_6', document.getElementById('player_emso_6').value);
    formData.append('player_document_no_6', document.getElementById('player_document_no_6').value);
    formData.append('player_position_6', document.getElementById('player_position_6').value);
    formData.append('player_jersey_6', document.getElementById('player_jersey_6').value);
    formData.append('player_class_p_6', document.getElementById('player_class_p_6').value);
    formData.append('player_class_p_plus_6', document.getElementById('player_class_p_plus_6').value);
    formData.append('player_social_media_6', document.getElementById('player_social_media_6').value);

    formData.append('name_7', document.getElementById('name_7').value);
    formData.append('nickname_7', document.getElementById('nickname_7').value);
    formData.append('player_icon_7', document.getElementById('player_icon_7').files[0]); // Add file
    formData.append('player_sex_7', document.getElementById('player_sex_7').value);
    formData.append('date_of_birth_7', document.getElementById('date_of_birth_7').value);
    formData.append('player_nationality_7', document.getElementById('player_nationality_7').value);
    formData.append('player_emso_7', document.getElementById('player_emso_7').value);
    formData.append('player_document_no_7', document.getElementById('player_document_no_7').value);
    formData.append('player_position_7', document.getElementById('player_position_7').value);
    formData.append('player_jersey_7', document.getElementById('player_jersey_7').value);
    formData.append('player_class_p_7', document.getElementById('player_class_p_7').value);
    formData.append('player_class_p_plus_7', document.getElementById('player_class_p_plus_7').value);
    formData.append('player_social_media_7', document.getElementById('player_social_media_7').value);

    formData.append('name_8', document.getElementById('name_8').value);
    formData.append('nickname_8', document.getElementById('nickname_8').value);
    formData.append('player_icon_8', document.getElementById('player_icon_8').files[0]); // Add file
    formData.append('player_sex_8', document.getElementById('player_sex_8').value);
    formData.append('date_of_birth_8', document.getElementById('date_of_birth_8').value);
    formData.append('player_nationality_8', document.getElementById('player_nationality_8').value);
    formData.append('player_emso_8', document.getElementById('player_emso_8').value);
    formData.append('player_document_no_8', document.getElementById('player_document_no_8').value);
    formData.append('player_position_8', document.getElementById('player_position_8').value);
    formData.append('player_jersey_8', document.getElementById('player_jersey_8').value);
    formData.append('player_class_p_8', document.getElementById('player_class_p_8').value);
    formData.append('player_class_p_plus_8', document.getElementById('player_class_p_plus_8').value);
    formData.append('player_social_media_8', document.getElementById('player_social_media_8').value);

    formData.append('name_9', document.getElementById('name_9').value);
    formData.append('nickname_9', document.getElementById('nickname_9').value);
    formData.append('player_icon_9', document.getElementById('player_icon_9').files[0]); // Add file
    formData.append('player_sex_9', document.getElementById('player_sex_9').value);
    formData.append('date_of_birth_9', document.getElementById('date_of_birth_9').value);
    formData.append('player_nationality_9', document.getElementById('player_nationality_9').value);
    formData.append('player_emso_9', document.getElementById('player_emso_9').value);
    formData.append('player_document_no_9', document.getElementById('player_document_no_9').value);
    formData.append('player_position_9', document.getElementById('player_position_9').value);
    formData.append('player_jersey_9', document.getElementById('player_jersey_9').value);
    formData.append('player_class_p_9', document.getElementById('player_class_p_9').value);
    formData.append('player_class_p_plus_9', document.getElementById('player_class_p_plus_9').value);
    formData.append('player_social_media_9', document.getElementById('player_social_media_9').value);

    formData.append('name_10', document.getElementById('name_10').value);
    formData.append('nickname_10', document.getElementById('nickname_10').value);
    formData.append('player_icon_10', document.getElementById('player_icon_10').files[0]); // Add file
    formData.append('player_sex_10', document.getElementById('player_sex_10').value);
    formData.append('date_of_birth_10', document.getElementById('date_of_birth_10').value);
    formData.append('player_nationality_10', document.getElementById('player_nationality_10').value);
    formData.append('player_emso_10', document.getElementById('player_emso_10').value);
    formData.append('player_document_no_10', document.getElementById('player_document_no_10').value);
    formData.append('player_position_10', document.getElementById('player_position_10').value);
    formData.append('player_jersey_10', document.getElementById('player_jersey_10').value);
    formData.append('player_class_p_10', document.getElementById('player_class_p_10').value);
    formData.append('player_class_p_plus_10', document.getElementById('player_class_p_plus_10').value);
    formData.append('player_social_media_10', document.getElementById('player_social_media_10').value);

    talkToDatabase(pathBack + "Controllers/Tournaments/tournament_phygital_football.php", formData);
}

function addMatch(event, gameId, tournamentId) {
    event.preventDefault();

    const formData = new FormData();
    formData.append('gameId', gameId);
    formData.append('tournamentId', tournamentId);
    formData.append('playerOne', document.getElementById('playerOne').value);
    formData.append('playerTwo', document.getElementById('playerTwo').value);
    formData.append('playerOnePoints', 0);
    formData.append('playerTwoPoints', 0);
    formData.append('dateTime', document.getElementById('match-start').value);

    talkToDatabase("Controllers/Tournaments/tournament_add_match.php", formData);
}
