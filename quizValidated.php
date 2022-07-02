<?php

session_start();
require "functions.php";


$scoreIncrement = $_POST['finalScore'];



$pdo = connectDB();

            $queryPrepared = $pdo->prepare("SELECT * from AROOTS_ARTICLES"); 

        $queryPrepared-> fetchAll();

?>

