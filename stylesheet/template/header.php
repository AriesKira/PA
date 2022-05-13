<?php

session_start();
require "functions.php";
if(isConnected()) {
	$userID = $_SESSION['id'];
}


?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link id="myCss" rel="stylesheet" href="/PA/stylesheet/css/style.css">
	<script src="/PA/authentication/authentification.js"></script>
	<script src="https://kit.fontawesome.com/ae4e8edb66.js" crossorigin="anonymous"></script>
	<title>aROOTS - Home</title>
</head>

<body>
	<header>
		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg ">
				<div class="col-sm">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" alt="Page d'accueil" href="/PA/index.php">Accueil</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" alt="Page articles" href="">Articles</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" alt="Page d'entrainement" href="">Entrainement</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" alt="Page forum" href="">Forum</a>
						</li>
						<li>
							<a class="nav-link" alt="Page conseil" href="">Nos conseils</a>
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
								<a class="nav-link" href="/PA/authentication/logout.php">Se deconnecter</a>
							</li>

						<?php } else { ?>
							<li class="nav-item">
								<a class="nav-link" onclick="popUpRegister()">S'inscrire</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" onclick="popUpLogin()">Se connecter</a>
							</li>

						<?php } ?>
						<a id="ModeButton" type="button" class="btn btn-outline-light">
							<i id="modeSwitch" class="fa-solid fa-sun fa-2x"></i>
						</a>
					</ul>
				</div>
			</nav>
		</div>
	</header>