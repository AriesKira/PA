<?php

    session_start();
    require "functions.php";

    $title = $_POST["title"];
    $theme = $_POST["theme"];
    $texte = $_POST["texte"];
    $errors = [];




/* VERIFICATION DE L'IMAGE */

    $uploaddir = 'stylesheet/images/articles/';
    $uploadfile = strtolower($uploaddir .substr(basename($_FILES['picture']['name']), -20, 20));
    $picture = $uploadfile;

    $extension = pathinfo($uploadfile, PATHINFO_EXTENSION);




    if($extension == 'png'){
        resizeImagePng($uploadfile, $picture, 200, 100, 9);
    } elseif($extension == 'gif'){
        resizeImageGif($uploadfile, $picture, 200, 100, 100);
    } elseif($extension == 'jpeg' || $extension == 'jpg') {
        resizeImageJpeg($uploadfile, $picture, 200, 100, 100);
    } else{
        die("L'extension de l'image n'a pas été reconnue. Insérer uniquement des fichiers PNG, GIF ou JPEG");
        header("Location: ./articles.php");
    }




    /* VERIFICATION DES AUTRES CHAMPS DU FORMULAIRE */



        if(
            empty($_POST["title"]) ||
            empty($_POST["theme"]) ||
            empty($_POST["texte"]) ||
            count($_POST) !=3
        ){
            $errors[] = "Merci de remplir tous les champs";
            header("Location: ./addArticle.php"); 
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

        header("Location: ./articles.php");	

        }

    ?>