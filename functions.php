<?php
require "config.inc.php";

function connectDB() {
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

function createToken() {
	$token = sha1(md5(rand(0, 100) . "gdgfm432") . uniqid());
	return $token;
}


function updateToken($userId, $token) {

	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("UPDATE AROOTS_USERS SET token=:token WHERE idUser=:idUser");
	$queryPrepared->execute(["token" => $token, "idUser" => $userId]);
}


function isConnected() {

	if (!isset($_SESSION["email"]) || !isset($_SESSION["token"])) {
		return false;
	}

	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("SELECT idUser FROM AROOTS_USERS WHERE email=:email AND token=:token");
	$queryPrepared->execute(["email" => $_SESSION["email"], "token" => $_SESSION["token"]]);

	return $queryPrepared->fetch();
}



function displayCountryFlag($results) {

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


function sendVerifyMail($email,$pseudo,$key) {
	
	$to = $email;
	$subject = 'Confirmation de mail';
	$message = 'Bienvenue sur ARoots' . "\r\n" . 'Veuillez cliquez sur le lien suivant pour valider votre email : http://141.94.251.167/authentication/verifyMail.php?key='.$key.'?pseudo='.$pseudo. "\r\n" .'Cordalement,'. "\r\n" ."L'équipe AROOTS";
	$headers = 'From: ARoots@ARoots.com'       . "\r\n" .
		'Reply-To: ARoots@ARoots.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	mail($to, $subject, $message, $headers);
}

function rdmKeyValues() {
	mt_rand();
}