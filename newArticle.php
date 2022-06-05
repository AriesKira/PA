<?php

    session_start();
    require "functions.php";

    $title = $_POST["title"];
    $theme = $_POST["theme"];
    $texte = $_POST["texte"];
    $picture = $_POST["picture"];

    $errors = [];

    if(
        empty($_POST["title"]) ||
        empty($_POST["theme"]) ||
        empty($_POST["texte"]) ||
        empty($_POST["picture"]) ||
        count($_POST) !=4
    ){
        $errors[] = "Merci de remplir tous les champs";
    } else {

        $pdo = connectDB();

        $queryPrepared = $pdo->prepare("INSERT INTO AROOTS_ARTICLES (title, theme, texte, picture) 
		VALUES ( :title, :theme, :texte, :picture );");

	$queryPrepared->execute([
								"title"=>$title,
								"theme"=>$theme,
                                "texte"=>$texte,
                                "picture"=>$picture,
								]);

	header("Location: articles.php");	

    }
    ?>
