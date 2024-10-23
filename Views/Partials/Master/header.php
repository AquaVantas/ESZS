<?php 
    if(!isset($_GET['page_id'])) {
        $page_id = 1;
    }
    else {
        $page_id = $_GET['page_id'];
    }

    if(!isset($_GET['lang_id'])) {
        $lang_id = 1;
    }
    else {            
        $lang_id = $_GET['lang_id'];
    }
    
    foreach(website::getSpecificWebsitePageDetails($page_id, $lang_id) as $page_details) { 
        if(strlen($page_details['page_title']) > 0) { ?>
            <title><?= $page_details['page_title'] ?></title>
        <?php }
        else {
            foreach(website::getWebsiteDefault($lang_id) as $default) { ?>
                <title><?= $default['website_title'] ?></title>
            <?php }
        } ?>
        <meta name="description" content="<?= $page_details['meta_description'] ?>">
        <meta name="keywords" content="<?= $page_details['meta_keyword'] ?>">
        <meta name="author" content="E�ZS">
    <?php }
    if(isset($_COOKIE['cookies']) && $_COOKIE['cookies'] == "yes") { ?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-Q1161MEK8Q"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-Q1161MEK8Q');
        </script>
    <?php }
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="Content/favicon.ico">
<link rel="stylesheet" href="Plugins/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="Style/Master.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
<script src="Plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="Scripts/Main.js"></script>