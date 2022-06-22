<?php
session_start();

require "functions.php";

$currentPage = $_GET['current'];
$tmp = explode("/",$currentPage);
$currentPage = end($tmp);
$tmp2 = end(explode('?',$currentPage));
$tmp2 = str_split($tmp2,1);
$tmp2 = $tmp2[3].$tmp2[4];

$threadId = intval($tmp2);
$userID = $_SESSION['idUser'];

$errors = [];

$userThreadComment = htmlspecialchars($_POST['userComment']);
$userThreadCommentImgName = $_FILES['commentImage']['name'];

if (empty($userThreadCommentImgName)&&empty($userThreadComment)) {
    $errors[]='Un commentaire ne peut être vide ! (texte ou image minimum)';
    header('loaction: '.$currentPage);
}

if (!empty($userThreadCommentImgName)) {
    
    $allowedExtension = array('jpg', 'png', 'jpeg', 'gif');
    $tmp =(explode(".", $userThreadCommentImgName));
    $extension = end($tmp);
    
    if (in_array($extension, $allowedExtension)) {
        $name = 'commentImg' . $userID .'_'.mt_rand(0,999999).'.' . $extension . '';
        $imgPath = './stylesheet/images/threadImages/' . $name . '';
        move_uploaded_file($_FILES['commentImage']['tmp_name'], $imgPath);
    } else {
        $errors[]='Image Invalide';
        header("location: ".$currentPage);
    }

    $imageSize = getimagesize($imgPath);
        if ($imageSize[0]>700 && $imageSize[1]>500) {
            switch($extension) {
                case 'jpeg' || 'jpg':
                    resizeImageJpeg($imgPath,$imgPath,500,300,100);
                    break;
                case 'png':
                    resizeImagePng($imgPath,$imgPath,500,300,100);
                    break;
                case 'gif':
                    resizeImageGif($imgPath,$imgPath,500,300,100);
                    break;
            }
        }elseif ($imageSize[0]<=300 && $imageSize[1]>600) {
            switch($extension) {
                case 'jpeg' || 'jpg':
                    resizeImageJpeg($imgPath,$imgPath,$imageSize[0],600,100);
                    break;
                case 'png':
                    resizeImagePng($imgPath,$imgPath,$imageSize[0],600,100);
                    break;
                case 'gif':
                    resizeImageGif($imgPath,$imgPath,$imageSize[0],600,100);
                    break;
            }
        }elseif($imageSize[0]>500 && $imageSize[1]<=300) {
            switch($extension) {
                case 'jpeg' || 'jpg':
                    resizeImageJpeg($imgPath,$imgPath,300,$imageSize[1],100);
                    break;
                case 'png':
                    resizeImagePng($imgPath,$imgPath,300,$imageSize[1],100);
                    break;
                case 'gif':
                    resizeImageGif($imgPath,$imgPath,300,$imageSize[1],100);
                    break;
            }
        }


    if (count($errors) == 0) {
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("INSERT INTO THREAD_COMMENT (idThread,author,texte,picture) VALUES (:idThread,:author,:texte,:picture)");
        $queryPrepared->execute([
            "idThread"=>$threadId,
            "author" => $userID,
            "texte" => $userThreadComment,
            "picture" => $imgPath
        ]);
    
        header('location: '.$currentPage);
    } else {
        $_SESSION['errors'] = $errors;
        header('location: '.$currentPage);
    }
}

if (empty($userThreadCommentImgName)) {

    if (count($errors) == 0) {
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("INSERT INTO THREAD_COMMENT (idThread,author,texte) VALUES (:idThread,:author,:texte)");
        $queryPrepared->execute([
            "idThread"=>$threadId,
            "author" => $userID,
            "texte" => $userThreadComment
        ]);
    
        header('location: '.$currentPage);
    } else {
        $_SESSION['errors'] = $errors;
        header('location: '.$currentPage);
    }
}