<?php


require "config.inc.php";

function connectDB()
{
	//création d'une nouvelle connexion à notre bdd
	try {

		$pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PWD);

		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		die("Erreur SQL " . $e->getMessage());
	}


	return $pdo;
}

/*
	$token = createToken();
	updateToken($results["id"], $token);
*/

function createToken()
{
	$token = sha1(md5(rand(0, 100) . "gdgfm432") . uniqid());
	return $token;
}


function updateToken($userId, $token)
{

	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("UPDATE AROOTS_USERS SET token=:token WHERE idUser=:idUser");
	$queryPrepared->execute(["token" => $token, "idUser" => $userId]);
}


function isConnected()
{

	if (!isset($_SESSION["email"]) || !isset($_SESSION["token"])) {
		return false;
	}

	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("SELECT idUser FROM AROOTS_USERS WHERE email=:email AND token=:token");
	$queryPrepared->execute(["email" => $_SESSION["email"], "token" => $_SESSION["token"]]);

	return $queryPrepared->fetch();
}



function displayCountryFlag($results)
{

	if ($results["country"] == "fr") {
		$countryFlag = 'france';
	} elseif ($results["country"] == "pl") {
		$countryFlag = 'pologne';
	} elseif ($results["country"] == "ml") {
		$countryFlag = 'mali';
	}

	$countryDisplay = '<img src="stylesheet/images/flags/' . $countryFlag . '.png">';
	echo '' . $countryDisplay . '';
}


function sendVerifyMail($email, $pseudo, $key)
{

	$to = $email;
	$subject = 'Confirmation de mail';
	$message = 'Bienvenue sur ARoots' . "\r\n" . 'Veuillez cliquez sur le lien suivant pour valider votre email : http://141.94.251.167/authentication/verifyMail.php?key=' . $key . '&pseudo=' . $pseudo . "\r\n" . 'Cordalement,' . "\r\n" . "L'équipe AROOTS";
	$headers = 'From: <arootsverify@gmail.com>'       . "\r\n" .
		'Reply-To: <arootsverify@gmail.com>' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	mail($to, $subject, $message, $headers);
}

function rdmKeyValues()
{
	return mt_rand();
}

function isValidated($idUser) {

	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("SELECT validated FROM AROOTS_USERS where idUser= :idUser");
	$queryPrepared->execute(["idUser" => $idUser]);
	$results = $queryPrepared->fetch();

	$validated = $results[0];

	if ($validated == 1) {
		return true;
	}

	return false;
}


function isWebmaster($idUser)
{
	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("SELECT userRole FROM AROOTS_USERS where idUser = :idUser");
	$queryPrepared->execute(["idUser" => $idUser]);
	$results = $queryPrepared->fetch();

	$webmaster = $results['userRole'];

	if ($webmaster == 2) {
		return true;
	}

	return false;
}


function isAdmin($idUser){
	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("SELECT userRole FROM AROOTS_USERS where idUser = :idUser");
	$queryPrepared->execute(["idUser" => $idUser]);
	$results = $queryPrepared->fetch();

	$admin = $results['userRole'];

	if ($admin == 3) {
		return true;
	}

	return false;
}

function getThreadAuthor($authorID) {

	$pdo = connectDB();
	$getAuthorName = $pdo -> prepare("SELECT pseudo FROM AROOTS_USERS WHERE idUser =:idUser");
	$getAuthorName ->execute(["idUser" => $authorID]);
	$authorName = $getAuthorName -> fetch();

	return $authorName[0];
}

function getThreadCommentAuthor($authorID) {

	$pdo = connectDB();
	$getAuthorName = $pdo -> prepare("SELECT pseudo FROM AROOTS_USERS WHERE idUser =:idUser");
	$getAuthorName ->execute(["idUser" => $authorID]);
	$authorName = $getAuthorName -> fetch();

	return $authorName[0];
}

function hasLiked($userId,$therdId) {
	
	$pdo = connectDB();
	$verifyLike = $pdo ->prepare("SELECT count(idThread) FROM THREAD_LIKE WHERE idThread = :idThread AND idUser=:idUser");
	$verifyLike->execute(['idThread'=>$therdId,'idUser'=>$userId]);
	$isLiked = $verifyLike ->fetch();

	if ($isLiked[0] != 0) {
		return true;
	}
	return false;
}
function hasLikedThreadComment($userId,$commentId) {
	
	$pdo = connectDB();
	$verifyLike = $pdo ->prepare("SELECT count(commentId) FROM THREAD_COMMENT_LIKE WHERE commentId = :commentId AND userId=:userId");
	$verifyLike->execute(['commentId'=>$commentId,'userId'=>$userId]);
	$isLiked = $verifyLike ->fetch();

	if ($isLiked[0] != 0) {
		return true;
	}
	return false;
}

function likeThread($userId,$threadId) {

	$pdo = connectDB();
	$setLike = $pdo->prepare("INSERT INTO THREAD_LIKE (idUser,idThread) VALUES (:idUser,:idThread)");
	$setLike -> execute(['idUser'=>$userId,'idThread'=>$threadId]);

}
function likeThreadComment($userId,$commentId) {

	$pdo = connectDB();
	$setLike = $pdo->prepare("INSERT INTO THREAD_COMMENT_LIKE (userId,commentId) VALUES (:userId,:commentId)");
	$setLike -> execute(['userId'=>$userId,'commentId'=>$commentId]);

}

function unLikeThread($userId,$threadId) {

	$pdo = connectDB();
	$unsetLike = $pdo->prepare("DELETE FROM THREAD_LIKE WHERE idUser=:idUser AND idThread=:idThread");
	$unsetLike->execute(['idUser'=>$userId,'idThread'=>$threadId]);

}
function unLikeThreadComment($userId,$commentId) {

	$pdo = connectDB();
	$unsetLike = $pdo->prepare("DELETE FROM THREAD_COMMENT_LIKE WHERE userId=:userId AND commentId=:commentId");
	$unsetLike->execute(['userId'=>$userId,'commentId'=>$commentId]);

}

function setLike($userId,$contentId) {
	if(hasLiked($userId,$contentId)) {
		unLikeThread($userId,$contentId);
	}else{
		likeThread($userId,$contentId);
	}
}

function setLikeComment($userId,$contentId) {
	if(hasLikedThreadComment($userId,$contentId)) {
		unLikeThreadComment($userId,$contentId);
	}else{
		likeThreadComment($userId,$contentId);
	}
}

function hasImage($threadId) {
	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("SELECT picture FROM AROOTS_THREAD WHERE idThread=:idThread");
	$queryPrepared ->execute(['idThread'=> $threadId]);
	$results = $queryPrepared->fetch();

	if ($results[0]== null) {
		return false;
	}
	return true;
}
function commentHasImage($idThreadComment) {
	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("SELECT picture FROM THREAD_COMMENT WHERE idThreadComment=:idThreadComment");
	$queryPrepared ->execute(['idThreadComment'=> $idThreadComment]);
	$results = $queryPrepared->fetch();

	if ($results[0]== null) {
		return false;
	}
	return true;
}

function threadLikes($threadId) {
	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("SELECT count(idThread) FROM THREAD_LIKE WHERE idThread = :idThread");
	$queryPrepared ->execute(['idThread'=> $threadId]);
	$likes = $queryPrepared ->fetch();
	return $likes[0];
}
function threadCommentLikes($commentId) {
	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("SELECT count(commentId) FROM THREAD_COMMENT_LIKE WHERE commentId = :commentId");
	$queryPrepared ->execute(['commentId'=> $commentId]);
	$likes = $queryPrepared ->fetch();
	return $likes[0];
}


 /* Fonctions de redimension des images */

 function resizeImageJpeg($source, $dst, $width, $height, $quality) {
	$imageSize = getimagesize($source);
	$imageRessource = imagecreatefromjpeg($source);
	$imageFinal = imagecreatetruecolor($width, $height);
	$final = imagecopyresampled($imageFinal, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);

	imagejpeg($imageFinal, $dst, $quality);
}


function resizeImagePng($source, $dst, $width, $height, $quality) {
	$imageSize = getimagesize($source);
	$imageRessource = imagecreatefrompng($source);
	$imageFinal = imagecreatetruecolor($width, $height);
	$final = imagecopyresampled($imageFinal, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);

	imagepng($imageFinal, $dst, $quality);
}

function resizeImageGif($source, $dst, $width, $height, $quality) {
	$imageSize = getimagesize($source);
	$imageRessource = imagecreatefromgif($source);
	$imageFinal = imagecreatetruecolor($width, $height);
	$final = imagecopyresampled($imageFinal, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);

	imagegif($imageFinal, $dst, $quality);
}