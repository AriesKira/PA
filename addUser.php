<?php
session_start();

require "functions.php";



//Est-ce que je recois ce que j'ai demandé

if(
	empty($_POST["email_user"]) ||
	!isset($_POST["firstname_user"]) ||
	!isset($_POST["lastname_user"]) || 
	empty($_POST["pseudo_user"]) ||
	empty($_POST["password_user"]) ||
	empty($_POST["passwordConfirm"]) ||
	empty($_POST["country_user"]) ||
	empty($_POST["cgu"]) ||
	!isset($_POST["birthday_user"])||
	count($_POST)!=9
){

	die("Tentative de Hack ...");

}




//récupérer les données du formulaire
$email = $_POST["email_user"];
$firstname = $_POST["firstname_user"];
$lastname = $_POST["lastname_user"];
$pseudo = $_POST["pseudo_user"];
$pwd = $_POST["password_user"];
$pwdConfirm = $_POST["passwordConfirm"];
$birthday = $_POST["birthday_user"];
$country = $_POST["country_user"];
$cgu = $_POST["cgu"];



//nettoyer les données

$email = strtolower(trim($email));
$firstname = ucwords(strtolower(trim($firstname)));
$lastname = mb_strtoupper(trim($lastname));
$pseudo = ucwords(strtolower(trim($pseudo)));


//vérifier les données
$errors = [];

//Email OK
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$errors[] = "Email incorrect";
}else{

	//Vérification l'unicité de l'email
	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("SELECT id_user from pa_user WHERE email_user=:email_user");

	$queryPrepared->execute(["email_user"=>$email]);
	
	if(!empty($queryPrepared->fetch())){
		$errors[] = "L'email existe déjà en bdd";
	}


}

//prénom : Min 2, Max 45 ou empty
if( strlen($firstname)==1 || strlen($firstname)>45 ){
	$errors[] = "Votre prénom doit faire plus de 2 caractères";
}

//nom : Min 2, Max 100 ou empty
if( strlen($lastname)==1 || strlen($lastname)>100 ){
	$errors[] = "Votre nom doit faire plus de 2 caractères";
}

//pseudo : Min 4 Max 60
if( strlen($pseudo)<4 || strlen($pseudo)>60 ){
	$errors[] = "Votre pseudo doit faire entre 4 et 60 caractères";
}

//Date anniversaire : YYYY-mm-dd
//entre 16 et 100 ans
$birthdayExploded = explode("-", $birthday);

if( count($birthdayExploded)!=3 || !checkdate($birthdayExploded[1], $birthdayExploded[2], $birthdayExploded[0])){
	$errors[] = "date incorrecte";
}else{
	$age = (time() - strtotime($birthday))/60/60/24/365.2425;
	if($age < 16 || $age > 100){
		$errors[] = "Vous êtes trop jeune ou trop vieux";
	}
}


//Mot de passe : Min 8, Maj, Min et chiffre
if(strlen($pwd) < 8 ||
preg_match("#\d#", $pwd)==0 ||
preg_match("#[a-z]#", $pwd)==0 ||
preg_match("#[A-Z]#", $pwd)==0 
) {
	$errors[] = "Votre mot de passe doit faire plus de 8 caractères avec une minuscule, une majuscule et un chiffre";
}


//Confirmation : égalité
if( $pwd != $pwdConfirm){
	$errors[] = "Votre mot de passe de confirmation ne correspond pas";
}

//Pays
$countryAuthorized = ["fr", "ml", "pl"];
if( !in_array($country, $countryAuthorized) ){
	$errors[] = "Votre pays n'existe pas";
}


if(count($errors) == 0){

	

	//$email = "y.skrzypczy@gmail.com";
	//$firstname = "');DELETE FROM users;";

	$queryPrepared = $pdo->prepare("INSERT INTO pa_user (email_user, firstname_user, lastname_user, pseudo_user, country_user, birthday_user, pwd_user) 
		VALUES ( :email , :firstname, :lastname, :pseudo, :country, :birthday, :pwd );");


	$pwd = password_hash($pwd, PASSWORD_DEFAULT);
	
	$queryPrepared->execute([
								"email_user"=>$email,
								"firstname_user"=>$firstname,
								"lastname_user"=>$lastname,
								"pseudo_user"=>$pseudo,
								"country_user"=>$country,
								"birthday_user"=>$birthday,
								"pwd_user"=>$pwd,
							]);

	header("Location: login.php");	

}else{
	
	$_SESSION['errors'] = $errors;
	header("Location: register.php");
}


//Si aucune erreur insérer l'utilisateur en base de données puis rediriger sur la page de connexion


//Si il y a des erreurs rediriger sur la page d'inscription et afficher les erreurs

