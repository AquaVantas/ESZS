<?php 
if((isset($cpanel_tab) && $cpanel_tab == "news_editor")  && ($role_admin || $role_news)) { 
	$edit_existing = false;
    $title = "";
    $description = "";
    $date = "";
    $author_id = 0;
    $content = "";
    $article_id = 0;
    $tags_string = "";
    $shows_on_news = 0;

    if (isset($_GET["news_id"])) {
        $edit_existing = true;
        $article = news::getArticleById($_GET["news_id"]);

        if (!$article) {
            echo "Ta clanek ne obstaja!";
            die();
        }

    $title = $article["news_article_title"];
    $description = $article["news_article_description"];
    $date = $article["news_article_date"];
    $author_id = $article["news_author_id"];
    $content = $article["news_article_content"];
    $shows_on_news = $article["shows_on_news"];
    $article_id = $article["news_article_id"];

    $tags = news::getTagsByArticle($article_id);
    $tag_arr = array();
    $i = 0;

    foreach ($tags as $tag):
        $tag_arr[$i] = $tag["news_tag_name"];
        $i = $i+1;
    endforeach;

    $tags_string = join(", ", $tag_arr);
}
?>
<div class="container" id="container">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="news-editor-wrapper edit-cloud">
                <div id="save_indicator" style="display: none; min-width: 20em; min-height: 1em; font-size: 1.5em; background-color: green;">Članek shranjen</div>
                <div id="error_indicator" style="display: none; min-width: 20em; min-height: 1em; font-size: 1.5em; background-color: red;">Napaka pri shranjevanju</div>
                <br><br><br>
                <label for="title">Naslov: </label><br>
                <input required type="text" id="title" name="title" value="<?= $title ?>"><br>
                <label for="description">Opis: </label><br>
                <textarea style="resize: both;" id="description" name="description"><?= $description ?></textarea><br>
                <label for="date">Datum: </label><br>
                <input type="datetime-local" id="date" name="date" value="<?= $date ?>"><br>
                <label for="title">Tags: </label><br>
                <input type="text" id="tags" name="tags" value="<?= $tags_string ?>"><br>
                <label for="author_id">Avtor: </label>
                <select id="author_id" name="author_id">
                    <?php
                    $authors = news::getAuthors();
                    foreach ($authors as $author):
                        if ($author['news_author_id'] == $author_id) {?>
                            <option selected="true" value="<?= $author['news_author_id'] ?>"><?= $author['news_author_name'] ?></option>
                        <?php } else { ?>
                            <option value="<?= $author['news_author_id'] ?>"><?= $author['news_author_name'] ?></option>
                    <?php }
                    endforeach; ?>
                </select><br>
                <label for="preview_image">Slika: </label><input type="file" id="preview_image" name="preview_image" accept="image/*">
                <label for="news-text">Besedilo novice:</label>
                <?php include "Views/CPanel/Universal/rich_text_editor.php" ?>
                <div class="news-checkbox-wrapper">
                    <input type="checkbox" id="shows-on-news" name="shows-on-news" <?= ($shows_on_news) == 1 ? 'checked' : '' ?>>
                    <label for="shows-on-news">Je novica</label><br>
                </div>
                <input class="btn btn-primary" type="button" value="Shrani" name="submit" onclick="saveArticle()">
            </div>
        </div>
    </div>
</div>
<script src="quill.min.js"></script>
<script src="image-resize.min.js"></script>
<script src="quill.imageUploader.min.js"></script>
<script>
    Quill.register("modules/imageUploader", ImageUploader);
    var editor = new Quill('#editor-container', {
        modules: {
            toolbar: '#editor-toolbar',
            imageResize: {
                modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
            },
            imageUploader: {
                upload: file => {
                    return new Promise((resolve, reject) => {
                        const formData = new FormData();
                        formData.append("image", file);

                        fetch(
                            "/Controllers/Website/News/news_image_upload.php",
                            {
                                method: "POST",
                                body: formData
                            }
                        )
                            .then(response => {
                                if (response.status == 200){
                                    response.text().then(
                                                txt => resolve(txt)
                                            )
                                } else if (response.status != 0) {
                                    reject("Upload failed");
                                }
                                })
                            .catch(error => {
                                reject("Upload failed");
                                console.error("Error:", error);
                            });
                    });
                }
            }
        },
        theme: 'snow'
    });
</script>
<script>
    function saveArticle() {
        let fd = new FormData();
        //$title, $description, $content, $preview_image, $date, $author_id
        fd.append("title", document.getElementById("title").value);
        fd.append("description", document.getElementById("description").value);
        fd.append("preview_image", document.getElementById("preview_image").files[0]);
        fd.append("tags", document.getElementById("tags").value);
        fd.append("date", document.getElementById("date").value);
        fd.append("author_id", document.getElementById("author_id").value);
        fd.append("shows_on_news", document.getElementById("shows-on-news").checked ? 1 : 0);
        fd.append("content", $(".ql-editor").html());
        <?php
        if ($edit_existing) { ?>
            fd.append("article_id", <?= $article_id ?>);
        <?php }?>

        let xhr = new XMLHttpRequest();

        xhr.open("POST", "Controllers/Website/News/news_add_new_article.php");
        xhr.send(fd);
    }
</script>
<?php } ?>