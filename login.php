<?php
require_once 'bootstrap.php';

//Controllo se utente sta facendo login(se ricevo in post username e password)
if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result) == 0){
        //Login fallito
        $templateParams["errorelogin"] = "Errore! Controllare username o password";
    }
    else{
        //Login con successo
        registerLoggedUser($login_result[0]);
    }
}


$templateParams["articoli"] = [];


//Controllo se l'utente è loggato
if(isUserLoggedIn()){
    //Utente loggato
    $templateParams["titolo"] = "Blog TW - Admin";
    $templateParams["nome"] = "login-home.php";
    $templateParams["articoli"] = $dbh->getPostByAuthorId($_SESSION["idautore"]);
    if(isset($_GET["formmsg"])){
        $templateParams["formmsg"] = $_GET["formmsg"];
    }

}
else{
    //Utente non loggato
    $templateParams["titolo"] = "Blog TW - Login";
    $templateParams["nome"] = "login-form.php";

    
}





$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);

require 'template/base.php';
?>