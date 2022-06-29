<?php

session_start();
require "logs.php";
require "functions.php";
if (isConnected()) {
	$userID = $_SESSION['idUser'];
}

generateLogs();
?>
<!doctype html>
<html lang="fr">

<head>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	<link type="text/css" rel="stylesheet" href="stylesheet/css/style.css">
	<script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
	<script src="./getStuff.js"></script>
	<script src="./avatarJS/modifyAvatar.js"></script>
	<script src="./authentication/authentification.js"></script>
	<script src="./setLike.js"></script>
	<script src="./searchbar.js"></script>
	<script src="./adminMod.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/ae4e8edb66.js" crossorigin="anonymous"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AROOTS</title>
</head>

<body class="min-vh-100">
	<header>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<div class="container-fluid">
				<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
					<ul class="navbar-nav me-auto">
						<li class="nav-item active">
							<a class="nav-link" href="../../index.php">Acceuil</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../../articles.php">Articles</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Entrainements</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../../forum.php">Forum</a>
						</li>
					</ul>
				</div>


				<div class="mx-auto order-0">
					<a class="navbar-brand mx-auto" href="../../index.php">ARoots</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".dual-collapse2">
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>
				<?php if (isConnected()) { 
					if (isAdmin($userID)) {?>
					<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
						<ul class="navbar-nav ms-auto">
							<li class="nav-item">
								<a class="nav-link" href="../../admin.php">Administration</a>
							</li>
						</ul>
					</div>
					<?php }?>
					<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
						<ul class="navbar-nav ms-auto">
							<li class="nav-item">
								<a class="nav-link" href="../../authentication/logout.php">Deconnexion</a>
							</li>
						</ul>
					</div>
				<?php
				} else { ?>
					<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
						<ul class="navbar-nav ms-auto">
							<li class="nav-item">
								<a id="registerButton" class="nav-link" onclick="popUpRegister()">S'inscrire</a>
							</li>
							<li class="nav-item">
								<a id="loginButton" class="nav-link" onclick="popUpLogin()">Se connecter</a>
							</li>
						</ul>
					</div>
				<?php
				}; ?>
			</div>
		</nav>
	</header>