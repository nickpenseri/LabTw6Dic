<?php
    require_once "bootstrap.php";

    if(!isUserLoggedIn()){
        header("location: login.php");
    }

    $templateParams["titolo"] = "BlogTW - Gestisci Articoli";
    $templateParams["nome"] = "admin-form.php";
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["articolicasuali"] = $dbh->getRandomPosts(2);


    $templateParams["azione"] = $_GET["action"];
    require "template/base.php"
?>