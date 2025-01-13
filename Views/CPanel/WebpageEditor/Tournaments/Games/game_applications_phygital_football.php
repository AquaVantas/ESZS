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
    <div class="accordion" id="accordionExample">
    <?php 
        $currentTeam = ""; 
        $accordionIndex = 0; // Counter for unique IDs
        foreach (tournament::getPlayerPhygitalFootball($game['apply_end_time'], $game['apply_start_time']) as $application) { 
            if ($currentTeam != $application['team_name']) {
                if ($currentTeam != "") { 
                    // Close the previous team's accordion item
                    echo '</div></div></div>';
                }
                $accordionIndex++; // Increment index for unique ID
                $currentTeam = $application['team_name']; 
        ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?= $accordionIndex ?>">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $accordionIndex ?>" aria-expanded="true" aria-controls="collapse<?= $accordionIndex ?>">
                            <?= htmlspecialchars($application['team_name']) ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $accordionIndex ?>" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table>
                                <tr>
                                    <td rowspan="12">
                                        <?php if (!empty($application['team_logo'])): ?>
                                            <img src="data:image/jpeg;base64,<?= base64_encode($application['player_image']) ?>" alt="<?= htmlspecialchars($application['full_name']) ?>" style="max-width: 250px; height: auto;">
                                        <?php else: ?>
                                            No image available
                                        <?php endif; ?>
                                    </td>
                                    <td><b>Ime podjetja: </b><?= $application['company_name'] ?></td>
                                </tr>
                                <tr><td><b>Država: </b><?= $application['country'] ?></td></tr>
                                <tr><td><b>Mesto: </b><?= $application['city'] ?></td></tr>
                                <tr><td><b>Zastopnik: </b><?= $application['team_representative'] ?></td></tr>
                                <tr><td><b>Kontaktna številka: </b><?= $application['contact_number'] ?></td></tr>
                                <tr><td><b>Kontaktna e-pošta: </b><?= $application['contact_email'] ?></td></tr>
                                <tr><td><b>O ekipi:</b><?= $application['about'] ?></td></tr>
                                <tr><td><b>Socialna omrežja: </b><?= $application['social_media'] ?></td></tr>
                            </table>
                            <h2 style="margin-top: 30px;">Seznam igralcev: </h2>
        <?php 
            } 
        ?>
            <table>
                <tr>
                    <td rowspan="12">
                        <?php if (!empty($application['player_image'])): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($application['player_image']) ?>" alt="<?= htmlspecialchars($application['full_name']) ?>" style="max-width: 250px; height: auto;">
                        <?php else: ?>
                            No image available
                        <?php endif; ?>
                    </td>
                    <td><b>Ime in priimek:</b> <?= htmlspecialchars($application['full_name']) ?></td>
                </tr>
                <tr><td><b>Nickname:</b> <?= htmlspecialchars($application['nickname']) ?></td></tr>
                <tr><td><b>Spol:</b> <?= htmlspecialchars($application['sex']) ?></td></tr>
                <tr><td><b>Datum rojstva:</b> <?= htmlspecialchars($application['date_of_birth']) ?></td></tr>
                <tr><td><b>Državljanstvo:</b> <?= htmlspecialchars($application['nationality']) ?></td></tr>
                <tr><td><b>EMŠO:</b> <?= htmlspecialchars($application['emso']) ?></td></tr>
                <tr><td><b>Številka dokumenta:</b> <?= htmlspecialchars($application['id_number']) ?></td></tr>
                <tr><td><b>Pozicija:</b> <?= htmlspecialchars($application['player_position']) ?></td></tr>
                <tr><td><b>Številka dresa:</b> <?= htmlspecialchars($application['jersey_number']) ?></td></tr>
                <tr><td><b>Igralec razreda P:</b> <?= htmlspecialchars($application['class_p_player']) ?></td></tr>
                <tr><td><b>Igralec razreda P plus:</b> <?= htmlspecialchars($application['class_p_plus_player']) ?></td></tr>
                <tr><td><b>Socialna omrežja:</b> <?= htmlspecialchars($application['social_media_links']) ?></td></tr>
            </table>
        <?php } ?>
            </div>
        </div>
    </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <!-- <div class="add-game">
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
                    <?php foreach(tournament::getTournamentMatches($_GET['tournament_id']) as $match) { 
                        if($match['match_end'] != 1) { ?>                        
                            <form id="teamFileLogoOne<?= $match['id'] ?>" class="visually-hidden">
                                <input type="file" id="logoFile" name="filename" onchange="uploadLogoToDatabase(event, '<?= $match['player_one'] ?>', <?= $_GET['tournament_id'] ?>)">
                                <input id="submit" type="submit" onclick="()">
                            </form>
                            <form id="teamFileLogoTwo<?= $match['id'] ?>" class="visually-hidden">
                                <input type="file" id="logoFile" name="filename" onchange="uploadLogoToDatabase(event, '<?= $match['player_two'] ?>', <?= $_GET['tournament_id'] ?>)">
                                <input id="submit" type="submit" onclick="()">
                            </form>
                            <div class="col-12 col-lg-4">
                                <div class="match-wrapper">
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
                                    <span class="date-time-of-match">
                                        <?php 
                                            $date = new DateTime($match['match_date']);

                                            $slovenianDays = [
                                                'Monday'    => 'ponedeljek',
                                                'Tuesday'   => 'torek',
                                                'Wednesday' => 'sreda',
                                                'Thursday'  => 'četrtek',
                                                'Friday'    => 'petek',
                                                'Saturday'  => 'sobota',
                                                'Sunday'    => 'nedelja'
                                            ];

                                            $englishDay = $date->format('l');
                                            $day = $date->format('d');
                                            $month = $date->format('m');
                                            $year = $date->format('Y');

                                            $slovenianDay = strtoupper($slovenianDays[$englishDay]);

                                            $formattedDate = "$slovenianDay, $day. $month. $year";
                                        ?>
                                        <?= $formattedDate ?>
                                    </span>
                                    <div class="edit-match">
                                        <a class="btn btn-primary" href="?tab=match_edit&match=<?= $match['id'] ?>&tournament_id=<?= $match['tournament_id'] ?>">UREDI</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
            <div class="finished">
                <h3>Zaključene</h3>
                <div class="row">
                    <?php foreach(tournament::getTournamentMatches($_GET['tournament_id']) as $match) { 
                        if($match['match_end'] == 1) { ?>                        
                            <form id="teamFileLogoOne<?= $match['id'] ?>" class="visually-hidden">
                                <input type="file" id="logoFile" name="filename" onchange="uploadLogoToDatabase(event, '<?= $match['player_one'] ?>', <?= $_GET['tournament_id'] ?>)">
                                <input id="submit" type="submit" onclick="()">
                            </form>
                            <form id="teamFileLogoTwo<?= $match['id'] ?>" class="visually-hidden">
                                <input type="file" id="logoFile" name="filename" onchange="uploadLogoToDatabase(event, '<?= $match['player_two'] ?>', <?= $_GET['tournament_id'] ?>)">
                                <input id="submit" type="submit" onclick="()">
                            </form>
                            <div class="col-12 col-lg-4">
                                <div class="match-wrapper">
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
                                    <span class="date-time-of-match">
                                        <?php 
                                            $date = new DateTime($match['match_date']);

                                            $slovenianDays = [
                                                'Monday'    => 'ponedeljek',
                                                'Tuesday'   => 'torek',
                                                'Wednesday' => 'sreda',
                                                'Thursday'  => 'četrtek',
                                                'Friday'    => 'petek',
                                                'Saturday'  => 'sobota',
                                                'Sunday'    => 'nedelja'
                                            ];

                                            $englishDay = $date->format('l');
                                            $day = $date->format('d');
                                            $month = $date->format('m');
                                            $year = $date->format('Y');

                                            $slovenianDay = strtoupper($slovenianDays[$englishDay]);

                                            $formattedDate = "$slovenianDay, $day. $month. $year";
                                        ?>                                        
                                        <?= $formattedDate ?>
                                    </span>
                                    <span class="score">
                                        <?= $match['player_one_score'] ?> : <?= $match['player_two_score'] ?>
                                    </span>
                                    <div class="edit-match">
                                        <a class="btn btn-primary" href="?tab=match_edit&match=<?= $match['id'] ?>&tournament_id=<?= $match['tournament_id'] ?>">UREDI</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </div> -->
    </div>
</div>