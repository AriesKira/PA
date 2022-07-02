<?php

session_start();
require "functions.php";

$userID = $_SESSION['idUser'];
$scoreIncrement = $_POST['finalScore'];



$pdo = connectDB();
    $queryPrepared = $pdo->prepare("UPDATE 'level' from AROOTS_USER where idUser = $userID")

?>

