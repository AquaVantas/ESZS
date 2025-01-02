<?php
    function getRouteFinalPageId($routeLanguage, $routeParentId, $routePages, $urlFunctionIndex) {
        if(count($routePages) != $urlFunctionIndex) {
            if($routeParentId == null) {
                foreach(website::getAllWebsiteRootPagesByLanguage($routeLanguage) as $searchingForPage) {
                    if(replaceSpecialCharacters(str_replace("/", "-", $searchingForPage['page_title'])) == $routePages[$urlFunctionIndex]) {
                        return getRouteFinalPageId($routeLanguage, $searchingForPage['page_id'], $routePages, $urlFunctionIndex + 1);
                    }
                } 
            }
            else {
                foreach(website::getAllWebsitePageSubpagesPageNavigationWithUnpublished($routeParentId, $routeLanguage) as $searchingForPage) {
                    if(replaceSpecialCharacters(str_replace("/", "-", $searchingForPage['WPD_page_title'])) == $routePages[$urlFunctionIndex]) {
                        return getRouteFinalPageId($routeLanguage, $searchingForPage['WP_page_id'], $routePages, $urlFunctionIndex + 1);
                    }
                }
            }
        }
        else {
            return $routeParentId;
        }
    }

    $route = isset($_GET['route']) ? $_GET['route'] : '';
    $pageRoutePath = explode("/", $route);
    $urlStartingIndex = 0;

    foreach(website::getAllWebsiteLanguages() as $language) {
        if(in_array($language['iso'], $pageRoutePath)) {
            $lang_id = $language['language_id'];
            $urlStartingIndex = 1;
        } else {
            $lang_id = 1;
        }
        if(isset($_GET['lang_id'])) {            
            $lang_id = $_GET['lang_id'];
        }
    }

    if(!isset($_GET['page_id'])) {
        $page_id = ($pageRoutePath[0] == "") ? 1 : getRouteFinalPageId($lang_id, null, $pageRoutePath, $urlStartingIndex);
    }
    else {
        $page_id = $_GET['page_id'];
    }
?>