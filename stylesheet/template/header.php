<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
    <title>aROOTS</title>
  </head>
	<body>
	<header>
  	<nav  class="navbar navbar-expand-lg ">
	  <div class="container-fluid">
	    <a class="navbar-brand nav-link" href="/PA/index.php">Accueil</a>
	    <button class="navbar-toggler" type="button"  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div  id="navbarSupportedContent">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        

	      	<?php if(isConnected()){ ?>

		        <li class="nav-item">
		          <a class="nav-link" href="logout.php">Se deconnecter</a>
		        </li>

					<?php }else{ ?>

	      		<li class="nav-item">
		          <a class="nav-link" href="register.php">S'inscrire</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="login.php">Se connecter</a>
		        </li>

	      	<?php } ?>
	        
	    </div>
	  </div>
	</nav>
	</header>