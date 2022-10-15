<?php
class website {
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

    
    public static function getAllWebsiteLanguages() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT language_id, title, short FROM website_language");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getSpecificWebsiteLanguage($language_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT language_id, title, short FROM website_language WHERE language_id = :language_id");
        $statement->bindParam(":language_id", $language_id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }    

    public static function addWebsiteLanguage($title, $short) {
        $db = self::getInstance();

        $statement = $db->prepare("INSERT INTO website_language(title, short) VALUES(:title, :short)");
        $statement->bindParam(":title", $title, PDO::PARAM_STR);
        $statement->bindParam(":short", $short, PDO::PARAM_STR);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function updateWebsiteLanguage($language_id, $title, $short) {
        $db = self::getInstance();

        $statement = $db->prepare("UPDATE website_language SET title = :title, short = :short WHERE language_id = :language_id");
        $statement->bindParam(":language_id", $language_id, PDO::PARAM_STR);
        $statement->bindParam(":title", $title, PDO::PARAM_STR);
        $statement->bindParam(":short", $short, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function deleteWebsiteLanguage($language_id) {
        $db = self::getInstance();

        $statement = $db->prepare("DELETE FROM website_language WHERE language_id = :language_id");
        $statement->bindParam(":language_id", $language_id, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function getAllWebsitePages() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT page_id, page_title FROM website_page");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getSpecificWebsitePage($page_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT page_id, page_title FROM website_page WHERE page_id = :page_id");
        $statement->bindParam(":page_id", $page_id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function updateWebsitePage($page_id, $page_title) {
        $db = self::getInstance();

        $statement = $db->prepare("UPDATE website_page SET page_title = :page_title WHERE page_id = :page_id");
        $statement->bindParam(":page_id", $page_id, PDO::PARAM_STR);
        $statement->bindParam(":page_title", $page_title, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function getSpecificWebsitePageDetails($page_id, $language_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT page_detail_id, page_id, language_id, page_title, meta_name, meta_description, meta_keywords FROM website_page_details WHERE page_id = :page_id AND language_id = :language_id");        
        $statement->bindParam(":page_id", $page_id, PDO::PARAM_STR);
        $statement->bindParam(":language_id", $language_id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function automaticallyAddWebsitePageDetailsForCurrentLanguage($page_id, $language_id) {
        $db = self::getInstance();

        $statement = $db->prepare("INSERT INTO website_page_details(page_id, language_id, page_title, meta_name, meta_description, meta_keywords) VALUES (:page_id, :language_id, null, null, null, null)");
        $statement->execute();

        return $statement->fetchAll();
    }
    
}
?>
