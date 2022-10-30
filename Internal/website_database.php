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

        $statement = $db->prepare("SELECT page_detail_id, page_id, language_id, page_title, meta_name, meta_description, meta_keyword FROM website_page_details WHERE page_id = :page_id AND language_id = :language_id");        
        $statement->bindParam(":page_id", $page_id, PDO::PARAM_STR);
        $statement->bindParam(":language_id", $language_id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getSpecificWebsitePageDetailsLanguage($language_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT page_detail_id, page_id, language_id, page_title, meta_name, meta_description, meta_keyword FROM website_page_details WHERE language_id = :language_id");        
        $statement->bindParam(":language_id", $language_id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function automaticallyAddWebsitePageDetailsForCurrentLanguage($page_id, $language_id) {
        $db = self::getInstance();

        $statement = $db->prepare("INSERT INTO website_page_details(page_id, language_id, page_title, meta_name, meta_description, meta_keyword) VALUES (:page_id, :language_id, null, null, null, null)");
        $statement->bindParam(":page_id", $page_id, PDO::PARAM_STR);
        $statement->bindParam(":language_id", $language_id, PDO::PARAM_STR);
        $statement->execute();
                
        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function updateWebsitePageDetails($page_id, $language_id, $page_title, $meta_name, $meta_description, $meta_keyword) {
        $db = self::getInstance();

        $statement = $db->prepare("UPDATE website_page_details SET page_title = :page_title, meta_name = :meta_name, meta_description = :meta_description, meta_keyword = :meta_keyword WHERE page_id = :page_id AND language_id = :language_id");
        $statement->bindParam(":page_id", $page_id, PDO::PARAM_STR);
        $statement->bindParam(":language_id", $language_id, PDO::PARAM_STR);
        $statement->bindParam(":page_title", $page_title, PDO::PARAM_STR);
        $statement->bindParam(":meta_name", $meta_name, PDO::PARAM_STR);
        $statement->bindParam(":meta_description", $meta_description, PDO::PARAM_STR);
        $statement->bindParam(":meta_keyword", $meta_keyword, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function getWebsiteSectionVariants() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT variant_id, section_type FROM website_section_variants");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getWebsiteExistingPageSections($page_detail_id, $variant_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT MAX(sequence_num) AS sequence_num FROM website_section WHERE page_detail_id = :page_detail_id AND variant_id = :variant_id");
        $statement->bindParam(":page_detail_id", $page_detail_id, PDO::PARAM_STR);
        $statement->bindParam(":variant_id", $variant_id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getWebsiteLastSection() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT MAX(section_id) AS section_id FROM website_section");
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public static function addWebsiteSection($page_detail_id, $variant_id, $sequence_num) {
        $db = self::getInstance();

        $statement = $db->prepare("INSERT INTO website_section(sequence_num, page_detail_id, variant_id) VALUES(:sequence_num, :page_detail_id, :variant_id)");
        $statement->bindParam(":page_detail_id", $page_detail_id, PDO::PARAM_STR);
        $statement->bindParam(":variant_id", $variant_id, PDO::PARAM_STR);
        $statement->bindParam(":sequence_num", $sequence_num, PDO::PARAM_STR);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function addWebsiteSectionBlock($section_id) {
        $db = self::getInstance();

        $statement = $db->prepare("INSERT INTO website_section_block(section_name, section_id, block_template_id, section_class, block_header, block_subheader, block_rich_text) VALUES(NULL, :section_id, NULL, NULL, NULL, NULL, NULL)");
        $statement->bindParam(":section_id", $section_id, PDO::PARAM_STR);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function getWebsiteSections($page_detail_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT website_section.section_id AS WS_section_id, website_section.sequence_num AS WS_sequence_num, website_section.page_detail_id AS WS_page_detail_id, website_section.variant_id AS WS_variant_id,
                                    website_section_block.section_block_id AS WSB_section_block_id, website_section_block.section_name AS WSB_section_name, website_section_block.block_template_id AS WSB_block_template_id,
                                    website_section_block.section_class AS WSB_section_class, website_section_block.block_header AS WSB_block_header, website_section_block.block_subheader AS WSB_block_subheader,
                                    website_section_block.block_rich_text AS WSB_block_rich_text
                                    FROM website_section
                                    INNER JOIN website_section_block ON website_section.section_id = website_section_block.section_id
                                    WHERE website_section.page_detail_id = :page_detail_id
                                    ORDER BY website_section.sequence_num ASC");
        $statement->bindParam(":page_detail_id", $page_detail_id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }
}
?>
