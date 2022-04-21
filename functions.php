<?php
require "config.inc.php";

function connectDB(){
	//création d'une nouvelle connexion à notre bdd
	try{
		
		$pdo = new PDO( DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT , DB_USER , DB_PWD );

    	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	}catch(Exception $e){
		die("Erreur SQL ".$e->getMessage());
	}


	return $pdo;
}

/*
	$token = createToken();
	updateToken($results["id"], $token);
*/

function createToken(){
	$token = sha1(md5(rand(0,100)."gdgfm432").uniqid());
	return $token;
}


function updateToken($userId, $token){

	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("UPDATE pa_user SET token=:token WHERE id_user=:id_user");
	$queryPrepared->execute(["token"=>$token, "id_user"=>$userId]);

}


function isConnected(){

	if(!isset($_SESSION["email_user"]) || !isset($_SESSION["token"])){
		return false;
	}

	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("SELECT id_user FROM pa_user WHERE email_user=:email_user AND token=:token");	
	$queryPrepared->execute(["email_user"=>$_SESSION["email_user"], "token"=>$_SESSION["token"]]);

	return $queryPrepared->fetch();

}







