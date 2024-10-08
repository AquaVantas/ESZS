<?php
class media {
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

    public static function getImages() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT image_id, image_path, alt_text FROM website_images");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getImageByPath($path) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT image_id, image_path, alt_text FROM website_images WHERE image_path LIKE :image_path");
        $statement->bindParam(":image_path", $path, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function editImageAltText($imageID, $altText) {
        $db = self::getInstance();

        $statement = $db->prepare("UPDATE website_images SET alt_text = :alt_text WHERE image_id = :image_id");
        $statement->bindParam(":image_id", $imageID, PDO::PARAM_STR);
        $statement->bindParam(":alt_text", $altText, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }
}
?>
