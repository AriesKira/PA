<?php
include '../functions.php';

$user = $_GET['pseudo'];

$pdo = connectDB();
echo $user;
$queryPrepared = $pdo->prepare("SELECT mailKey FROM AROOTS_USERS where pseudo= $user");
$queryPrepared->execute(["pseudo" => $user]);
echo '3';
$mailKey = $queryPrepared->fetch();

if($mailKey == $_GET['key']) {
    echo '4';
    $queryPrepared = $pdo->prepare("UPDATE AROOTS_USERS SET validated = 1 where idUser= $user");
    $queryPrepared->execute(["validated" => 1]);

    header("location: ../index.php");
}
