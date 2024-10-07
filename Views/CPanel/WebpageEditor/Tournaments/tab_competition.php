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
                        <?php if($game['game_id'] == 6) {
                            include "Games/game_applications_cs_go.php";
                        }
                        if($game['game_id'] == 8) { 
                            include "Games/game_applications_dirt_rally_2_0.php";
                        }
                        if($game['game_id'] == 9) { 
                            include "Games/game_applications_efootball.php";
                        }
                        if($game['game_id'] == 10) { 
                            include "Games/game_applications_mobile_legends.php";
                        } ?>
                    </div>              
                <?php }
            ?>
        </div>
    </div>
<?php } ?>