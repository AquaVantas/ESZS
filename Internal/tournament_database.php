<?php
class tournament {
    private static $host;
    private static $user;
    private static $password;
    private static $schema;
    private static $instance = null;

    private static function init() {
        if (!defined('HOST') || !defined('USER') || !defined('PASSWORD') || !defined('SCHEMA')) {
            include "info.php";
        }
    
        self::$host = HOST;
        self::$user = USER;
        self::$password = PASSWORD;
        self::$schema = SCHEMA;
    }

    private static function getInstance() {
        if (!self::$instance) {
            self::init();
            $config = "mysql:host=" . self::$host
                    . ";dbname=" . self::$schema;
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            );

            self::$instance = new PDO($config, self::$user, self::$password, $options);
        }

        return self::$instance;
    }

    
    public static function getAllGames() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT id, game_title, game_short FROM tournament_games ORDER BY game_title ASC");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getTournamentGame($tournament_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT game_id, tournament_title, apply_start_time, apply_end_time FROM tournament_list WHERE id = :tournament_id");
        $statement->bindParam(":tournament_id", $tournament_id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function addTournament($tournament_title, $game_id, $start, $end) {
        $db = self::getInstance();
        
        $statement = $db->prepare("INSERT INTO tournament_list(tournament_title, game_id, apply_start_time, apply_end_time) VALUES(:tournament_title, :game_id, :apply_start_time, :apply_end_time)");
        $statement->bindParam(":tournament_title", $tournament_title, PDO::PARAM_STR);
        $statement->bindParam(":game_id", $game_id, PDO::PARAM_STR);
        $statement->bindParam(":apply_start_time", $start, PDO::PARAM_STR);
        $statement->bindParam(":apply_end_time", $end, PDO::PARAM_STR);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function getTournamentsByGame($game_id) {
         $db = self::getInstance();

        $statement = $db->prepare("SELECT id, tournament_title, game_id, apply_start_time, apply_end_time FROM tournament_list WHERE game_id = :game_id ORDER BY apply_end_time DESC");
        $statement->bindParam(":game_id", $game_id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getTournamentsById($tournament_id) {
        $db = self::getInstance();

       $statement = $db->prepare("SELECT id, tournament_title, game_id, apply_start_time, apply_end_time FROM tournament_list WHERE id = :tournament_id");
       $statement->bindParam(":tournament_id", $tournament_id, PDO::PARAM_STR);
       $statement->execute();

       return $statement->fetchAll();
   }

    public static function addMatch($game_id, $tournament_id, $player_one, $player_two, $player_one_points, $player_two_points, $match_date) {
        $db = self::getInstance();
    
        try {
            $db->beginTransaction();
    
            $statement = $db->prepare("INSERT INTO tournament_match (game_id, tournament_id, player_one, player_two, match_date, player_one_score, player_two_score) 
                                       VALUES (:game_id, :tournament_id, :player_one, :player_two, :match_date, :player_one_score, :player_two_score)");
            
            $statement->bindParam(":game_id", $game_id, PDO::PARAM_INT);
            $statement->bindParam(":tournament_id", $tournament_id, PDO::PARAM_INT);
            $statement->bindParam(":player_one", $player_one, PDO::PARAM_STR);
            $statement->bindParam(":player_two", $player_two, PDO::PARAM_STR);
            $statement->bindParam(":match_date", $match_date, PDO::PARAM_STR);
            $statement->bindParam(":player_one_score", $player_one_points, PDO::PARAM_INT);
            $statement->bindParam(":player_two_score", $player_two_points, PDO::PARAM_INT);
            
            $statement->execute();
    
            $lastInsertId = $db->lastInsertId();
    
            $db->commit();
    
            return $lastInsertId;
        } catch (Exception $e) {
            $db->rollBack();

            error_log("Error adding match: " . $e->getMessage());

            return false;
        }
    }

    public static function getTournamentMatches($tournament_id) {
        $db = self::getInstance();

       $statement = $db->prepare("SELECT id, game_id, tournament_id, player_one, player_two, match_date, player_one_score, player_two_score, map_played, match_end
                                   FROM tournament_match WHERE tournament_id = :tournament_id");
       $statement->bindParam(":tournament_id", $tournament_id, PDO::PARAM_STR);
       $statement->execute();

       return $statement->fetchAll();
    }

    public static function getTournamentMatchesAll() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT id, game_id, tournament_id, player_one, player_two, match_date, player_one_score, player_two_score, map_played, match_end
                                    FROM tournament_match");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getTournamentMatchesAllDesc() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT id, game_id, tournament_id, player_one, player_two, match_date, player_one_score, player_two_score, map_played, match_end
                                    FROM tournament_match ORDER BY match_date DESC");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getTournamentMatchById($match_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT id, game_id, tournament_id, player_one, player_two, match_date, player_one_score, player_two_score, map_played, match_end
                                FROM tournament_match WHERE id = :id");
        $statement->bindParam(":id", $match_id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function editTournamentMatch($id, $score_one, $score_two, $match_done) {
        $db = self::getInstance();

        $statement = $db->prepare("UPDATE tournament_match SET player_one_score = :score_one, player_two_score = :score_two, match_end = :match_done WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_STR);
        $statement->bindParam(":score_one", $score_one, PDO::PARAM_STR);
        $statement->bindParam(":score_two", $score_two, PDO::PARAM_STR);
        $statement->bindParam(":match_done", $match_done, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function getTournamentsACCEntries($from, $to) {
         $db = self::getInstance();

        $statement = $db->prepare("SELECT application_id, player_name, player_surname, email, address, discord, steam_id, team
                                    FROM tournament_assetto_corsa WHERE game_id = :game_id ORDER BY apply_end_time DESC");
        $statement->bindParam(":game_id", $game_id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getPlayerCSGO($date_to, $date_from) {
        $db = self::getInstance();

       $statement = $db->prepare("SELECT player_name, player_surname, email, discord, nickname, nationality, team
                                   FROM tournament_CS_GO WHERE apply_time <= :date_to AND apply_time >= :date_from");
       $statement->bindParam(":date_to", $date_to, PDO::PARAM_STR);
       $statement->bindParam(":date_from", $date_from, PDO::PARAM_STR);
       $statement->execute();

       return $statement->fetchAll();
   }

    public static function addPlayerValorant($team, $name, $surname, $email, $discord, $nickname, $dateofbirth, $postalcode) {
        $db = self::getInstance();
        
        $statement = $db->prepare("INSERT INTO tournament_valorant(player_name, player_surname, email, discord, nickname, date_of_birth, postal_code, apply_time, team) VALUES(:player_name, :player_surname, :email, :discord, :nickname, :date_of_birth, :postal_code, NOW(), :team)");
        $statement->bindParam(":team", $team, PDO::PARAM_STR);
        $statement->bindParam(":player_name", $name, PDO::PARAM_STR);
        $statement->bindParam(":player_surname", $surname, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":discord", $discord, PDO::PARAM_STR);
        $statement->bindParam(":nickname", $nickname, PDO::PARAM_STR);
        $statement->bindParam(":date_of_birth", $dateofbirth, PDO::PARAM_STR);
        $statement->bindParam(":postal_code", $postalcode, PDO::PARAM_STR);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function addLogoToPlayerValorant($team, $logo, $mimeType) {
        $db = self::getInstance();
        
        $statement = $db->prepare("UPDATE tournament_valorant SET logo = :logo, logo_data_type = :mimeType WHERE team = :team");
        $statement->bindParam(":team", $team, PDO::PARAM_STR);
        $statement->bindParam(":logo", $logo, PDO::PARAM_STR);
        $statement->bindParam(":mimeType", $mimeType, PDO::PARAM_STR);
        $statement->execute();

        return $statement->rowCount();
    }

    public static function getPlayerValorant($date_to, $date_from) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT player_name, player_surname, email, discord, nickname, team, date_of_birth, postal_code
                                   FROM tournament_valorant WHERE apply_time <= :date_to AND apply_time >= :date_from");
        $statement->bindParam(":date_to", $date_to, PDO::PARAM_STR);
        $statement->bindParam(":date_from", $date_from, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    } 

    public static function getTeamsValorant($date_to, $date_from) {
        $db = self::getInstance();

       $statement = $db->prepare("SELECT team, logo_data_type, logo FROM tournament_valorant WHERE apply_time <= :date_to AND apply_time >= :date_from GROUP BY team");
       $statement->bindParam(":date_to", $date_to, PDO::PARAM_STR);
       $statement->bindParam(":date_from", $date_from, PDO::PARAM_STR);
       $statement->execute();

       return $statement->fetchAll();
    } 

    public static function getTeamValorant($date_to, $date_from, $team) {
        $db = self::getInstance();

       $statement = $db->prepare("SELECT team, logo_data_type, logo FROM tournament_valorant WHERE apply_time <= :date_to AND apply_time >= :date_from AND team LIKE :team GROUP BY team");
       $statement->bindParam(":date_to", $date_to, PDO::PARAM_STR);
       $statement->bindParam(":date_from", $date_from, PDO::PARAM_STR);
       $statement->bindParam(":team", $team, PDO::PARAM_STR);
       $statement->execute();

       return $statement->fetchAll();
    }

    public static function addPlayerMobileLegends($team, $name, $surname, $from, $discord, $nickname, $ingameId, $serverId, $nationality, $dateofbirth, $postalcode) {
        $db = self::getInstance();
        
        $statement = $db->prepare("INSERT INTO tournament_mobile_legends(team, player_name, player_surname, email, discord, nickname, game_id, server_id, nationality, date_of_birth, postal_code, apply_time) 
        VALUES(:team, :name, :surname, :from, :discord, :nickname, :ingameId, :serverId, :nationality, :dateofbirth, :postalcode, NOW())");
        $statement->bindParam(":team", $team, PDO::PARAM_STR);
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":surname", $surname, PDO::PARAM_STR);
        $statement->bindParam(":from", $from, PDO::PARAM_STR);
        $statement->bindParam(":discord", $discord, PDO::PARAM_STR);
        $statement->bindParam(":nickname", $nickname, PDO::PARAM_STR);
        $statement->bindParam(":ingameId", $ingameId, PDO::PARAM_STR);
        $statement->bindParam(":serverId", $serverId, PDO::PARAM_STR);
        $statement->bindParam(":nationality", $nationality, PDO::PARAM_STR);
        $statement->bindParam(":dateofbirth", $dateofbirth, PDO::PARAM_STR);
        $statement->bindParam(":postalcode", $postalcode, PDO::PARAM_STR);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function getPlayerMobileLegends($date_to, $date_from) {
        $db = self::getInstance();

       $statement = $db->prepare("SELECT player_name, player_surname, email, discord, nickname, game_id, nationality, team, server_id, date_of_birth, postal_code
                                   FROM tournament_mobile_legends WHERE apply_time <= :date_to AND apply_time >= :date_from");
       $statement->bindParam(":date_to", $date_to, PDO::PARAM_STR);
       $statement->bindParam(":date_from", $date_from, PDO::PARAM_STR);
       $statement->execute();

       return $statement->fetchAll();
   } 

    public static function addPlayerPubgMobile($team, $name, $surname, $from, $discord, $nickname, $ingameId, $serverId, $nationality, $dateofbirth, $postalcode) {
        $db = self::getInstance();
        
        $statement = $db->prepare("INSERT INTO tournament_pubg_mobile(team, player_name, player_surname, email, discord, nickname, game_id, player_role, nationality, date_of_birth, postal_code, apply_time) 
        VALUES(:team, :name, :surname, :from, :discord, :nickname, :ingameId, :serverId, :nationality, :dateofbirth, :postalcode, NOW())");
        $statement->bindParam(":team", $team, PDO::PARAM_STR);
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":surname", $surname, PDO::PARAM_STR);
        $statement->bindParam(":from", $from, PDO::PARAM_STR);
        $statement->bindParam(":discord", $discord, PDO::PARAM_STR);
        $statement->bindParam(":nickname", $nickname, PDO::PARAM_STR);
        $statement->bindParam(":ingameId", $ingameId, PDO::PARAM_STR);
        $statement->bindParam(":serverId", $serverId, PDO::PARAM_STR);
        $statement->bindParam(":nationality", $nationality, PDO::PARAM_STR);
        $statement->bindParam(":dateofbirth", $dateofbirth, PDO::PARAM_STR);
        $statement->bindParam(":postalcode", $postalcode, PDO::PARAM_STR);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function addPlayerFifa($first_name, $last_name, $nickname, $discord, $from, $ekipa, $platform, $term, $dateofbirth, $postalcode) {
        $db = self::getInstance();
        
        $statement = $db->prepare("INSERT INTO tournament_fifa(player_name, player_surname, nickname, email, discord, team, platform, date_of_birth, postal_code, time_applied) VALUES(:ime, :priimek, :nickname, :email, :discord, :ekipa, :platform, :date_of_birth, :postal_code, NOW())");

        $statement->bindParam(":ime", $first_name, PDO::PARAM_STR);
        $statement->bindParam(":priimek", $last_name, PDO::PARAM_STR);
        $statement->bindParam(":nickname", $nickname, PDO::PARAM_STR);
        $statement->bindParam(":email", $from, PDO::PARAM_STR); // Assuming email corresponds to "SignedUpTo" in the table.
        $statement->bindParam(":discord", $discord, PDO::PARAM_STR);
        $statement->bindParam(":ekipa", $ekipa, PDO::PARAM_STR);
        $statement->bindParam(":platform", $platform, PDO::PARAM_STR);
        $statement->bindParam(":date_of_birth", $dateofbirth, PDO::PARAM_STR); // Assuming date_of_birth is a string.
        $statement->bindParam(":postal_code", $postalcode, PDO::PARAM_INT); // Assuming postal_code is an integer.

        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function addPlayerEFootball($first_name, $last_name, $nickname, $discord, $from, $dateofbirth, $postalcode, $nationality) {
        $db = self::getInstance();
        
        $statement = $db->prepare("INSERT INTO tournament_efootball(player_name, player_surname, playstation_id, email, discord, date_of_birth, postal_code, time_applied, nationality) VALUES(:ime, :priimek, :nickname, :email, :discord, :date_of_birth, :postal_code, NOW(), :nationality)");

        $statement->bindParam(":ime", $first_name, PDO::PARAM_STR);
        $statement->bindParam(":priimek", $last_name, PDO::PARAM_STR);
        $statement->bindParam(":nickname", $nickname, PDO::PARAM_STR);
        $statement->bindParam(":email", $from, PDO::PARAM_STR); // Assuming email corresponds to "SignedUpTo" in the table.
        $statement->bindParam(":discord", $discord, PDO::PARAM_STR);
        $statement->bindParam(":date_of_birth", $dateofbirth, PDO::PARAM_STR); // Assuming date_of_birth is a string.
        $statement->bindParam(":postal_code", $postalcode, PDO::PARAM_INT); // Assuming postal_code is an integer.
        $statement->bindParam(":nationality", $nationality, PDO::PARAM_STR); 

        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function getPlayerEFootball($date_to, $date_from) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT player_name, player_surname, email, discord, playstation_id, nationality, date_of_birth, postal_code
                                    FROM tournament_efootball WHERE time_applied <= :date_to AND time_applied >= :date_from");
        $statement->bindParam(":date_to", $date_to, PDO::PARAM_STR);
        $statement->bindParam(":date_from", $date_from, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    } 

   public static function getPlayerDirtRally20($date_to, $date_from) {
    $db = self::getInstance();

    $statement = $db->prepare("SELECT player_name, surname, email, discord, race_username, racecar, team, raceteam, date_of_birth, postal_code
                                FROM tournament_dirt_rally_2_0 WHERE time_applied <= :date_to AND time_applied >= :date_from");
    $statement->bindParam(":date_to", $date_to, PDO::PARAM_STR);
    $statement->bindParam(":date_from", $date_from, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetchAll();
    } 
}
?>