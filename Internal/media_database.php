<?php
class media {
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

    
    public static function getLastImageID() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT MAX(image_id) as max_image_id FROM website_images");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function addImage($image_path, $alt_text) {
        $db = self::getInstance();

        $statement = $db->prepare("INSERT INTO website_images(image_path, alt_text) VALUES(:image_path, :alt_text)");
        $statement->bindParam(":image_path", $image_path, PDO::PARAM_STR);
        $statement->bindParam(":alt_text", $alt_text, PDO::PARAM_STR);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }
}
?>
