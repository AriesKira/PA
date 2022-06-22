<?php
session_start();

require "functions.php";

$userID = $_SESSION['idUser'];

$errors = [];

$userThreadTitle = $_POST['threadTitle'];
$userThreadTheme = $_POST['threadTheme'];

$userThreadDescription = $_POST['threadDescription'];

$userThreadTitle = htmlspecialchars(trim($userThreadTitle));
$userThreadDescription = htmlspecialchars($userThreadDescription);


$userThreadImgName = $_FILES['threadImg']['name'];

if (strlen($userThreadTitle) > 255){
    $errors[]='Titre de Thread trop long (255 caractères maximum)';
    header('loaction: ./forum.php');
}

if (empty($userThreadImgName)&&empty($userThreadDescription)) {
    $errors[]='Interdiction de crée des thread sans contenu (image ou description minimum)';
    header('loaction: ./forum.php');
}
if (!empty($userThreadImgName)) {
    
    $allowedExtension = array('jpg', 'png', 'jpeg', 'gif');
    $tmp =(explode(".", $userThreadImgName));
    $extension = end($tmp);
    
    if (in_array($extension, $allowedExtension)) {
        $name = 'img' . $userID .'_'.mt_rand(0,999999).'.' . $extension . '';
        $imgPath = './stylesheet/images/threadImages/' . $name . '';
        move_uploaded_file($_FILES['threadImg']['tmp_name'], $imgPath);
    } else {
        $errors[]='Image Invalide';
        header("location: ./forum.php");
    }

    $imageSize = getimagesize($imgPath);
        if ($imageSize[0]>700 && $imageSize[1]>500) {
            switch($extension) {
                case 'jpeg' || 'jpg':
                    resizeImageJpeg($imgPath,$imgPath,700,500,100);
                    break;
                case 'png':
                    resizeImagePng($imgPath,$imgPath,700,500,100);
                    break;
                case 'gif':
                    resizeImageGif($imgPath,$imgPath,700,500,100);
                    break;
            }
        }elseif ($imageSize[0]<=700 && $imageSize[1]>800) {
            switch($extension) {
                case 'jpeg' || 'jpg':
                    resizeImageJpeg($imgPath,$imgPath,$imageSize[0],800,100);
                    break;
                case 'png':
                    resizeImagePng($imgPath,$imgPath,$imageSize[0],800,100);
                    break;
                case 'gif':
                    resizeImageGif($imgPath,$imgPath,$imageSize[0],800,100);
                    break;
            }
        }elseif($imageSize[0]>700 && $imageSize[1]<=500) {
            switch($extension) {
                case 'jpeg' || 'jpg':
                    resizeImageJpeg($imgPath,$imgPath,700,$imageSize[1],100);
                    break;
                case 'png':
                    resizeImagePng($imgPath,$imgPath,700,$imageSize[1],100);
                    break;
                case 'gif':
                    resizeImageGif($imgPath,$imgPath,700,$imageSize[1],100);
                    break;
            }
        }


    if (count($errors) == 0) {
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("INSERT INTO AROOTS_THREAD (author,title,theme,texte,picture) VALUES (:author,:title,:theme,:texte,:picture)");
        $queryPrepared->execute([
            "author" => $userID,
            "title" => $userThreadTitle,
            "theme" => $userThreadTheme,
            "texte" => $userThreadDescription,
            "picture" => $imgPath
        ]);
    
        header('location: ./forum.php');
    } else {
        $_SESSION['errors'] = $errors;
        header('location: ./forum.php');
    }
}

if (empty($userThreadImgName)) {

    if (count($errors) == 0) {
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("INSERT INTO AROOTS_THREAD (author,title,theme,texte) VALUES (:author,:title,:theme,:texte)");
        $queryPrepared->execute([
            "author" => $userID,
            "title" => $userThreadTitle,
            "theme" => $userThreadTheme,
            "texte" => $userThreadDescription
        ]);
    
        header('location: ./forum.php');
    } else {
        $_SESSION['errors'] = $errors;
        header('location: ./forum.php');
    }
}



