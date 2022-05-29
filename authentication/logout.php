<?php

	session_start();
	unset($_SESSION['email']);
	unset($_SESSION['token']);
	unset($_SESSION['pseudo']);
	unset($_SESSION['idUser']);
	header("Location: ../index.php");