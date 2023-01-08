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

        $statement = $db->prepare("SELECT id, game_title, game_short FROM tournament_games");
        $statement->execute();

        return $statement->fetchAll();
    }
}
?>
