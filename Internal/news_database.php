<?php
class news {
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

    
    public static function getAllOutsideMedia() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT media_id, media_title, media_type, person_name, person_surname, person_title, email, phone, responsive FROM news_outside_media ORDER BY media_id DESC");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function addOutsideMedia($media_title, $media_type, $person_name, $person_surname, $person_title, $email, $phone, $responsive) {
        $db = self::getInstance();
        
        $statement = $db->prepare("INSERT INTO news_outside_media(media_title, media_type, person_name, person_surname, person_title, email, phone, responsive) VALUES(:media_title, :media_type, :person_name, :person_surname, :person_title, :email, :phone, :responsive)");
        $statement->bindParam(":media_title", $media_title, PDO::PARAM_STR);
        $statement->bindParam(":media_type", $media_type, PDO::PARAM_STR);
        $statement->bindParam(":person_name", $person_name, PDO::PARAM_STR);
        $statement->bindParam(":person_surname", $person_surname, PDO::PARAM_STR);
        $statement->bindParam(":person_title", $person_title, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":phone", $phone, PDO::PARAM_STR);
        $statement->bindParam(":responsive", $responsive, PDO::PARAM_STR);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }
}
?>
