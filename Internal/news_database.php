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

    public static function getArticlesPreviews() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT news_article_id, news_article_title, news_article_description, news_article_preview_image, news_article_date FROM news_articles WHERE news_article_hidden is FALSE AND news_article_date <= NOW() ORDER BY news_article_date DESC");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getFeaturedArticles() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT news_article_id, news_article_title, news_article_description, news_article_preview_image, news_article_date FROM news_articles WHERE news_article_featured IS TRUE AND news_article_hidden is FALSE ORDER BY news_article_date DESC");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getTags() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT news_tag_id, news_tag_name FROM news_tags ORDER BY news_tag_name DESC");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getAuthors() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT news_author_id, news_author_name FROM news_authors ORDER BY news_author_name DESC");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function tagExists($tag_name) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT news_tag_id FROM news_tags WHERE news_tag_name = :tag_name LIMIT 1");
        $statement->bindParam(":tag_name", $tag_name, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function getArticleById($article_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT news_articles.*, news_authors.* FROM news_articles LEFT JOIN news_authors USING (news_author_id) WHERE news_article_id = :article_id");

        $statement->bindParam(":article_id", $article_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getTagsByArticle($article_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT news_tags.* FROM news_articles_tags JOIN news_tags USING (news_tag_id) WHERE news_article_id = :article_id");
        $statement->bindParam(":article_id", $article_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getArticlesByTag($tag_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT news_article_id, news_article_title, news_article_description, news_article_preview_image, news_article_date, news_tags.* FROM news_tags JOIN news_articles_tags USING (news_tag_id) JOIN news_articles USING (news_article_id) WHERE news_tag_id = :tag_id AND news_article_hidden is FALSE");

        $statement->bindParam(":tag_id", $tag_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getArticlesByAuthor($author_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT news_article_id, news_article_title, news_article_description, news_article_preview_image, news_article_date FROM news_authors JOIN news_articles USING (news_author_id) WHERE news_author_id = :author_id AND news_article_hidden is FALSE");
        $statement->bindParam(":author_id", $author_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getArticlesByYearsMonths() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT news_article_id, news_article_title, YEAR(news_article_date) AS year, MONTH(news_article_date) AS month FROM news_articles WHERE news_article_hidden is FALSE ORDER BY YEAR(news_article_date), MONTH(news_article_date)");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function articleHasTag($article_id, $tag_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT true FROM news_articles_tags WHERE news_article_id = :article_id AND news_tag_id = :tag_id");
        $statement->bindParam(":article_id", $article_id, PDO::PARAM_INT);
        $statement->bindParam(":tag_id", $tag_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function getArticleByPage($page_name) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT news_articles.* FROM news_articles JOIN news_pages USING (news_article_id) WHERE news_page_name = :page_name");
        $statement->bindParam(":page_name", $page_name, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function addAuthor($name, $description) {
        $db = self::getInstance();

        $statement = $db->prepare("INSERT INTO news_authors(news_author_name) VALUES(:name)");
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":description", $description, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function addArticle($title, $description, $content, $preview_image, $date, $author_id) {
        $db = self::getInstance();

        $statement = $db->prepare("INSERT INTO news_articles(news_article_title, news_article_description, news_article_content, news_article_preview_image, news_article_date, news_author_id) VALUES(:title, :description, :content, :preview_image, :date, :author_id)");
        $statement->bindParam(":title", $title, PDO::PARAM_STR);
        $statement->bindParam(":description", $description, PDO::PARAM_STR);
        $statement->bindParam(":content", $content, PDO::PARAM_STR);
        $statement->bindParam(":preview_image", $preview_image, PDO::PARAM_STR);
        $statement->bindParam(":date", $date, PDO::PARAM_STR);
        $statement->bindParam(":author_id", $author_id, PDO::PARAM_INT);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function addTag($tag_name) {
        $db = self::getInstance();

        $statement = $db->prepare("INSERT INTO news_tags(news_tag_name) VALUES(:tag_name)");
        $statement->bindParam(":tag_name", $tag_name, PDO::PARAM_STR);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function addTagToArticle($article_id, $tag_id) {
        $db = self::getInstance();

        $statement = $db->prepare("INSERT INTO news_articles_tags(news_article_id, news_tag_id) VALUES(:article_id, :tag_id)");
        $statement->bindParam(":article_id", $article_id, PDO::PARAM_INT);
        $statement->bindParam(":tag_id", $tag_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function deleteTag($tag_id) {
        $db = self::getInstance();

        $statement = $db->prepare("DELETE FROM  news_tags WHERE news_tag_id = :tag_id");
        $statement->bindParam(":tag_id", $tag_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function removeTagFromArticle($article_id, $tag_id) {
        $db = self::getInstance();

        $statement = $db->prepare("DELETE FROM news_articles_tags WHERE news_article_id = :article_id AND news_tag_id = :tag_id");
        $statement->bindParam(":article_id", $article_id, PDO::PARAM_INT);
        $statement->bindParam(":tag_id", $tag_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function deleteArticle($article_id) {
        $db = self::getInstance();

        $statement = $db->prepare("DELETE FROM news_articles WHERE news_article_id = :article_id");
        $statement->bindParam(":article_id", $article_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function deleteAuthor($author_id) {
        $db = self::getInstance();

        $statement = $db->prepare("DELETE FROM news_authors WHERE news_author_id = :author_id");
        $statement->bindParam(":author_id", $author_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function updateArticle($article_id, $title, $description, $content, $date, $author_id) {
        $db = self::getInstance();

        $statement = $db->prepare("UPDATE news_articles SET news_article_title = :title, news_article_description = :description, news_article_content = :content, news_article_date = :date, news_author_id = :author_id WHERE news_article_id = :article_id");
        $statement->bindParam(":title", $title, PDO::PARAM_STR);
        $statement->bindParam(":description", $description, PDO::PARAM_STR);
        $statement->bindParam(":content", $content, PDO::PARAM_STR);
        $statement->bindParam(":date", $date, PDO::PARAM_STR);
        $statement->bindParam(":author_id", $author_id, PDO::PARAM_INT);
        $statement->bindParam(":article_id", $article_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function setArticleFeatured($article_id, $featured) {
        $db = self::getInstance();

        $statement = $db->prepare("UPDATE news_articles SET news_article_featured = :featured WHERE news_article_id = :article_id");
        $statement->bindParam(":article_id", $article_id, PDO::PARAM_INT);
        $statement->bindParam(":featured", $featured, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function createPage($page_name) {
        $db = self::getInstance();

        $statement = $db->prepare("INSERT INTO news_articles(news_article_title, news_article_content, news_article_preview_image, news_article_date, news_article_hidden, news_author_id) VALUES (:page_name, '', 'images/articles/previews/white.png', CURDATE(), TRUE, NULL)");
        $statement->bindParam(":page_name", $page_name, PDO::PARAM_INT);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        $article_id = $statement->fetchColumn();

        $page_name_not_space = preg_replace('/\s+/', '_', $page_name);

        $statement = $db->prepare("INSERT INTO news_pages(news_article_id, news_page_name, news_page_title) VALUES (:article_id, :page_name_not_space, :page_name)");
        $statement->bindParam(":article_id", $article_id, PDO::PARAM_INT);
        $statement->bindParam(":page_name_not_space", $page_name_not_space, PDO::PARAM_INT);
        $statement->bindParam(":page_name", $page_name, PDO::PARAM_INT);
        $statement->execute();
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
