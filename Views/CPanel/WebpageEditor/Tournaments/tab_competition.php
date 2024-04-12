<?php if((isset($cpanel_tab)) && ($cpanel_tab == "tournament")) { ?>
    <div class="container user-body">
        <div class="row">
            <div class="col-12 create-bar">
                <a class="btn btn-primary" href="?tab=tournaments">Nazaj</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php 
                foreach(tournament::getTournamentGame($_GET['tournament_id']) as $game) { ?>
                    <div class="col-12">
                        <h2><?= $game['tournament_title'] ?></h2>
                        <?php if($game['game_id'] == 10) { ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Ime</th>
                                        <th>Priimek</th>
                                        <th>E-pošta</th>
                                        <th>Discord</th>
                                        <th>Nickname</th>                                        
                                        <th>Game ID</th>                                        
                                        <th>Ekipa</th>                                        
                                        <th>Server ID</th>
                                        <th>Datum rojstva</th>
                                        <th>Poštna številka</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach(tournament::getPlayerMobileLegends($game['apply_end_time'], $game['apply_start_time']) as $application) { ?>
                                    <tr>
                                        <td><?= $application['player_name'] ?></td>
                                        <td><?= $application['player_surname'] ?></td>
                                        <td><?= $application['email'] ?></td>
                                        <td><?= $application['discord'] ?></td>
                                        <td><?= $application['nickname'] ?></td>
                                        <td><?= $application['game_id'] ?></td>
                                        <td><?= $application['team'] ?></td>
                                        <td><?= $application['server_id'] ?></td>
                                        <td><?= $application['date_of_birth'] ?></td>
                                        <td><?= $application['postal_code'] ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>              
                <?php }
            ?>
        </div>
    </div>
<?php } ?>