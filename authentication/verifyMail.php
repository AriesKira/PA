<?php
include '../functions.php';

$user = $_GET['pseudo'];

$pdo = connectDB();
echo $user;
$queryPrepared = $pdo->prepare("SELECT mailKey FROM AROOTS_USERS where pseudo= :pseudo");
$queryPrepared->execute(["pseudo" => $user]);
$mailKey = $queryPrepared->fetch();
echo $mailKey[0];

if($mailKey == $_GET['key']) {
    echo '4';
    $queryPrepared = $pdo->prepare("UPDATE AROOTS_USERS SET validated = 1 where pseudo= :pseudo");
    $queryPrepared->execute(["pseudo" => $user]);

    header("location: ../index.php");
}
