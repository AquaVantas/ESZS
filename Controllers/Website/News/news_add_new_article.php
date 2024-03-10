<?php
require_once("../../../Internal/news_database.php");
if (isset($_POST["article_id"])) {
    if (
        !isset($_POST["title"]) ||
        !isset($_POST["description"]) ||
        !isset($_POST["date"]) ||
        !isset($_POST["author_id"]) ||
        !isset($_POST["tags"]) ||
        !isset($_POST["content"]) ||
        !isset($_POST["shows_on_news"])
    ) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }    

    news::updateArticle($_POST["article_id"], $_POST["title"], $_POST["description"], $_POST["content"], $_POST["date"], $_POST["author_id"], $_POST["shows_on_news"]);
    $article_id = $_POST["article_id"];
} else {
    if (
        !isset($_POST["title"]) ||
        !isset($_POST["description"]) ||
        !isset($_FILES["preview_image"]) ||
        !isset($_POST["date"]) ||
        !isset($_POST["author_id"]) ||
        !isset($_POST["tags"]) ||
        !isset($_POST["content"]) ||
        !isset($_POST["shows_on_news"])
    ) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    $targetdir = '../../../Content/Images/Articles/Previews/';
    $targetfile = $targetdir . $_FILES['preview_image']['name'];

    if (!move_uploaded_file($_FILES['preview_image']['tmp_name'], $targetfile)) {
        header("HTTP/1.1 500 Internal Server Error");
        die();
    }

    $article_id = news::addArticle($_POST["title"], $_POST["description"], $_POST["content"], $targetfile, $_POST["date"], $_POST["author_id"], $_POST["shows_on_news"]);
}

$tags_arr = explode(",", $_POST["tags"]);
echo $_POST["tags"] . "<br><br>";

if (isset($_POST["article_id"])) {
    $tags = news::getTagsByArticle($article_id);
    foreach ($tags as $tag):
        news::removeTagFromArticle($article_id, $tag["news_tag_id"]);
    endforeach;
}

foreach ($tags_arr as $tag):
    $tag = strtolower(trim($tag));
    echo $tag . "<br>";

    $tag_id = news::tagExists($tag);
    if (!$tag_id) {
        $tag_id = news::addTag($tag);
        news::addTagToArticle($article_id, $tag_id);
    }
    if (!news::articleHasTag($article_id, $tag_id)) {
        news::addTagToArticle($article_id, $tag_id);
    }
endforeach;

?>
