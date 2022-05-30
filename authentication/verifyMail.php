<?php

$user = $_GET['pseudo'];

$pdo = connectDB();

$queryPrepared = $pdo->prepare("SELECT mailKey FROM AROOTS_USERS where pseudo= $user");
$queryPrepared->execute();
$mailKey = $queryPrepared->fetch();

if($mailKey == $_GET['key']) {
    $queryPrepared = $pdo->prepare("UPDATE AROOTS_USERS SET validated = 1 where idUser= $user");
    $queryPrepared->execute(["validated" => 1]);
}
