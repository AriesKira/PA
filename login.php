<?php
	session_start();
	require "functions.php";
?>

<?php include "/Applications/MAMP/htdocs/PA/stylesheet/template/header.php";?>


<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="Description" content="::" lang="FR">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" href="stylesheet/css/style.css">
      <title></title>
   </head>
   <body id="loginBody">
		<div class="container" >
			<div class="row mt-4" id="loginBorder">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<?php

						if( !empty($_POST['email']) &&  !empty($_POST['pwd']) && count($_POST)==2 ){

							//Récupérer en bdd le mot de passe hashé pour l'email provenant du formulaire

							$pdo = connectDB();
							$queryPrepared = $pdo->prepare("SELECT * FROM pa_user WHERE email_user=:email_user");
							$queryPrepared->execute(["email"=>$_POST['email']]);
							$results = $queryPrepared->fetch();

							if(!empty($results) && password_verify($_POST['pwd_user'], $results['pwd_user'])){
									

								$token = createToken();
								updateToken($results["id"], $token);
								//Insertion dans la session du token
								$_SESSION['email_user'] = $_POST['email_user'];
								$_SESSION['id_user'] = $results["id_user"];
								$_SESSION['token'] = $token;
								header("location: index.php");

							}else{
								echo "Identifiants incorrects";
							}

						}

					?>

					<form method="POST" action="">
						<input type="email" class="form-control" name="email" placeholder="Votre email" required="required"><br>

						<input type="password" class="form-control" name="pwd" placeholder="Votre mot de passe" required="required"><br>

						<input type="submit" class="btn btn-primary" value="Se connecter">

					</form>
				</div>
			</div>
		</div>
   </body>
</html>
