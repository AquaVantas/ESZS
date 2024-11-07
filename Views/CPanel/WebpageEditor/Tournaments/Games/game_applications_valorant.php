<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Prijave</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Tekme</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <table>
            <thead>
                <tr>
                    <th>Ime</th>
                    <th>Priimek</th>
                    <th>E-pošta</th>
                    <th>Discord</th>
                    <th>Nickname</th>                                     
                    <th>Ekipa</th>
                    <th>Datum rojstva</th>
                    <th>Poštna številka</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach(tournament::getPlayerValorant($game['apply_end_time'], $game['apply_start_time']) as $application) { ?>
                <tr>
                    <td><?= $application['player_name'] ?></td>
                    <td><?= $application['player_surname'] ?></td>
                    <td><?= $application['email'] ?></td>
                    <td><?= $application['discord'] ?></td>
                    <td><?= $application['nickname'] ?></td>
                    <td><?= $application['team'] ?></td>
                    <td><?= $application['date_of_birth'] ?></td>
                    <td><?= $application['postal_code'] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="add-game">
            <h3>Dodaj tekmo</h3>
            <form class="row" id="addMatchForm" onsubmit="addMatch(event, 5, <?= $_GET['tournament_id'] ?>)">
                <div class="col-12 col-lg-4">
                    <label for="playerOne">Ekipa 1:</label>
                    <select id="playerOne" name="playerOne" required>
                        <?php foreach(tournament::getTeamsValorant($game['apply_end_time'], $game['apply_start_time']) as $team) { ?>
                            <option value="<?= $team['team'] ?>"><?= $team['team'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-12 col-lg-4">
                    <label for="playerTwo">Ekipa 2:</label>
                    <select id="playerTwo" name="playerTwo" required>
                        <?php foreach(tournament::getTeamsValorant($game['apply_end_time'], $game['apply_start_time']) as $team) { ?>
                            <option value="<?= $team['team'] ?>"><?= $team['team'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-12 col-lg-4">
                    <label for="match-start">Začetek igre:</label>
                    <input type="datetime-local" id="match-start" name="match-start" value="<?= date('d-m-Y H:m', time()) ?>">
                </div>
                <div class="col-12 submit-button">                    
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="match-list">
            <div class="upcoming">
                <h3>Prihajajoče</h3>
                <div class="row">
                    <?php foreach(tournament::getTournamentMatches($_GET['tournament_id']) as $match) { ?>                        
                        <form id="teamFileLogoOne<?= $match['id'] ?>" class="visually-hidden">
                            <input type="file" id="logoFile" name="filename" onchange="uploadLogoToDatabase(event, '<?= $match['player_one'] ?>', <?= $_GET['tournament_id'] ?>)">
                            <input id="submit" type="submit" onclick="()">
                        </form>
                        <form id="teamFileLogoTwo<?= $match['id'] ?>" class="visually-hidden">
                            <input type="file" id="logoFile" name="filename" onchange="uploadLogoToDatabase(event, '<?= $match['player_two'] ?>', <?= $_GET['tournament_id'] ?>)">
                            <input id="submit" type="submit" onclick="()">
                        </form>
                        <div class="col-12 col-lg-4 match-wrapper">
                            <div class="vs-logos">
                                <div class="team-logo">
                                    <?php foreach(tournament::getTeamValorant($game['apply_end_time'], $game['apply_start_time'], $match['player_one']) as $team) { 
                                        if($team['logo']) { ?>
                                            <img src="data:<?= $team['logo_data_type'] ?>;base64, <?= $team['logo'] ?>" alt="<?= $match['player_one'] ?>">
                                        <?php } else { ?>
                                            <button class="btn btn-primary" onclick="openTeamLogoInput(event, 1, <?= $match['id'] ?>)">Dodaj LOGOTIP</button>
                                            <?= $match['player_one'] ?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <h4>VS</h4>
                                <div class="team-logo">
                                <?php foreach(tournament::getTeamValorant($game['apply_end_time'], $game['apply_start_time'], $match['player_two']) as $team) { 
                                        if($team['logo']) { ?>
                                            <img src="data:<?= $team['logo_data_type'] ?>;base64, <?= $team['logo'] ?>" alt="<?= $match['player_two'] ?>">
                                        <?php } else { ?>
                                            <button class="btn btn-primary" onclick="openTeamLogoInput(event, 2, <?= $match['id'] ?>)">Dodaj LOGOTIP</button>
                                            <?= $match['player_two'] ?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <span class="date-time-of-match"><?= $match['match_date'] ?></span>
                            <div class="edit-match">
                                <a class="btn btn-primary" href="?tab=match_edit&match=<?= $match['id'] ?>&tournament_id=<?= $match['tournament_id'] ?>">UREDI</a>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
            <div class="finished">
                <h3>Zaključene</h3>
            </div>
        </div>
    </div>
</div>