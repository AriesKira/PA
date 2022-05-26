<?php

session_start();
require "functions.php";
if (isConnected()) {
	$userID = $_SESSION['idUser'];
}

$burger1 = "burgerMenuContent1";
$burger2 = "burgerMenuContent2";

?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link type="text/css" rel="stylesheet" href="stylesheet/css/style.css">
	<script src="./authentication/authentification.js"></script>
	<script src="./stylesheet/burgersMenus/animations.js"></script>
	<script src="https://kit.fontawesome.com/ae4e8edb66.js" crossorigin="anonymous"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>aROOTS - Home</title>
</head>

<body>
	<header>
		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg ">
				<button class="pageBurgers" onclick="burgerPopUp1()">
					<i class="fa-solid fa-bars"></i>
				</button>
				<div class="col-sm">
					<!-- AFFICHER POUR PC--->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" alt="Page d'accueil" href="../../index.php">Accueil</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" alt="Page articles" href="../../articles.php">Articles</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" alt="Page d'entrainement" href="">Entrainement</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" alt="Page forum" href="">Forum</a>
						</li>
					</ul>
				</div>
				<div class="col-sm">
					<input id="searchbar" alt="Barre de recherche" type="text" name="search" placeholder="     ---Recherche---">
				</div>
				<div class="col-sm ">

					<ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-end">

						<?php if (isConnected()) { ?>
							<li class="nav-item">
								<a class="nav-link logs-links" href="../../authentication/logout.php">Se deconnecter</a>
							</li>

						<?php } else { ?>
							<li class="nav-item">
								<a class="nav-link logs-links" id="registerButton" onclick="popUpRegister()">S'inscrire</a>
							</li>
							<li class="nav-item">
								<a class="nav-link logs-link" id="loginButton" onclick="popUpLogin()">Se connecter</a>
							</li>

						<?php } ?>
						<a id="ModeButton" type="button" class="btn btn-outline-light nav-link">
							<i id="modeSwitch" class="fa-solid fa-sun fa-2x"></i>
						</a>

					</ul>
				</div>
				<button class="pageBurgers" onclick="burgerPopUp2()">
					<i class="fa-solid fa-bars"></i>
				</button>
			</nav>
		</div>
	</header>