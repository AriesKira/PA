<?php
    session_start();
    require "functions.php";

    $title = $_POST["title"];
    $theme = $_POST["theme"];
    $texte = $_POST["texte"];
    $errors = [];




/* VERIFICATION DE L'IMAGE */

    $uploaddir = './stylesheet/images/articles/';
    $uploadfile = strtolower($uploaddir . substr(basename($_FILES['picture']['name']), -20, 20));
    $picture = $uploadfile;

    $extension = pathinfo($uploadfile, PATHINFO_EXTENSION);

    if(
        $extension !== 'png' &&
        $extension !== 'jpeg' &&
        $extension !== 'jpg' && 
        $extension !== 'gif') {
            die("L'extension de l'image n'a pas été reconnue. Insérer uniquement des fichiers PNG, GIF ou JPEG");
            header("Location: articles.php");
        }


    echo '<pre>';
    if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
        echo "Le fichier est valide, et a été téléchargé
            avec succès. Voici le lien de l'image :\n";
    } else {
        echo "Attaque potentielle par téléchargement de fichiers.
            Voici le lien de l'image :\n";
    }


    echo 'Voici quelques informations de débogage :';
    print_r($picture);

    echo '</pre>';


    /* Fonctions de redimension des images */

    function convertImageJpeg($source, $dst, $width, $height, $quality) {
        $imageSize = getimagesize($source);
        $imageRessource = imagecreatefromjpeg($source);
        $imageFinal = imagecreatetruecolor($width, $height);
        $final = imagecopyresampled($imageFinal, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);

        imagejpeg($imageFinal, $dst, $quality);
    }

    function convertImagePng($source, $dst, $width, $height, $quality) {
        $imageSize = getimagesize($source);
        $imageRessource = imagecreatefrompng($source);
        $imageFinal = imagecreatetruecolor($width, $height);
        $final = imagecopyresampled($imageFinal, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);

        imagepng($imageFinal, $dst, $quality);
    }

    function convertImageGif($source, $dst, $width, $height, $quality) {
        $imageSize = getimagesize($source);
        $imageRessource = imagecreatefromgif($source);
        $imageFinal = imagecreatetruecolor($width, $height);
        $final = imagecopyresampled($imageFinal, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);

        imagegif($imageFinal, $dst, $quality);
    }

    if($extension == 'png'){
        convertImagePng($uploadfile, $picture, 200, 100, 9);
    } elseif($extension == 'gif'){
        convertImageGif($uploadfile, $picture, 200, 100, 100);
    } elseif($extension == 'jpeg' || $extension == 'jpg') {
        convertImageJpeg($uploadfile, $picture, 200, 100, 100);
    } else{
        echo "L'extension n'est pas reconnue. Veuillez insérer uniquement des images : GIF, PNG ou JPEG";
    }




    /* VERIFICATION DES AUTRES CHAMPS DU FORMULAIRE */



    if(
        empty($_POST["title"]) ||
        empty($_POST["theme"]) ||
        empty($_POST["texte"]) ||
        count($_POST) !=3
    ){
        $errors[] = "Merci de remplir tous les champs";

        header("Location: addArticle.php");
    } else {

        $pdo = connectDB();

        $queryPrepared = $pdo->prepare("INSERT INTO AROOTS_ARTICLES ( title, theme, texte, picture) 
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
