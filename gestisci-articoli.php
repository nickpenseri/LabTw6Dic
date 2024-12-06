<?php
    require_once "bootstrap.php";

    if(!isUserLoggedIn()){
        header("location: login.php");
    }

    $templateParams["infoarticolo"] = getEmptyArticle();

    if(isset($_GET["id"]) && !is_null($_GET["id"])){
        if($_GET["action"] != 2 && $_GET["action"] != 3){
            header("location: login.php");
        }
        else{
            $idarticolo = $_GET["id"];
            $templateParams["infoarticolo"] = $dbh->getPostById($idarticolo)[0];
        }
    }

    $templateParams["titolo"] = "BlogTW - Gestisci Articoli";
    $templateParams["nome"] = "admin-form.php";
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["articolicasuali"] = $dbh->getRandomPosts(2);


    $templateParams["azione"] = $_GET["action"];
    require "template/base.php"
?>