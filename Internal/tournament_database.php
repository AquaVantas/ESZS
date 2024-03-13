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

    public static function getTournamentsACCEntries($from, $to) {
         $db = self::getInstance();

        $statement = $db->prepare("SELECT application_id, player_name, player_surname, email, address, discord, steam_id, team
                                    FROM tournament_assetto_corsa WHERE game_id = :game_id ORDER BY apply_end_time DESC");
        $statement->bindParam(":game_id", $game_id, PDO::PARAM_STR);
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

    public static function addPlayerMobileLegends($team, $name, $surname, $from, $discord, $nickname, $ingameId, $serverId, $nationality, $dateofbirth, $postalcode) {
        $db = self::getInstance();
        
        $statement = $db->prepare("INSERT INTO tournament_mobile_legends(ekipa, ime, priimek, email, discord, ingameName, ingameID, serverID, nationality, dateOfBirth, postal_code, apply_time) 
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
        
        $statement = $db->prepare("INSERT INTO tournament_fifa(ime, priimek, nick, email, discord, ekipa, platform, date_of_birth, postal_code, time_applied) VALUES(:ime, :priimek, :nickname, :email, :discord, :ekipa, :platform, :date_of_birth, :postal_code, NOW())");

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
}
?>