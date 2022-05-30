<?php
include '../functions.php';
echo '1';
$user = $_GET['pseudo'];

$pdo = connectDB();
echo $user;
$queryPrepared = $pdo->prepare("SELECT mailKey FROM AROOTS_USERS where pseudo= $user");
echo '2';
$queryPrepared->execute();
$mailKey = $queryPrepared->fetch();
echo '3';
if($mailKey == $_GET['key']) {
    echo '4';
    $queryPrepared = $pdo->prepare("UPDATE AROOTS_USERS SET validated = 1 where idUser= $user");
    $queryPrepared->execute(["validated" => 1]);

    header("location: ../index.php");
}
