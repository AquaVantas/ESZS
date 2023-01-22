<?php
class tournament {
    private static $host = "localhost";
    private static $user = "root";
    private static $password = "";
    private static $schema = "eszs";
    private static $instance = null;

    private static function getInstance() {
        if (!self::$instance) {
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
}
?>
