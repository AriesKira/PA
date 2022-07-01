<?php 
include "./functions.php";
session_start();

$conv = htmlspecialchars(intval($_GET['conv']));

$user1 = getUsersFromConv($conv);
$user1 = $user1[0];

$user2 = getUsersFromConv($conv);
$user2 = $user2[1];


$task = "list";

if (array_key_exists('task',$_GET)) {
    $task = $_GET['task'];
}

if ($task =="write") {
    postMessage($conv);
}else {
    getMessages($conv);
}

function postMessage($conv) {


	$author = intval($_SESSION['idUser']);
	$content = htmlspecialchars($_POST['content-text']);

	$pdo = connectDB();
	$queryPrepared = $pdo -> prepare("INSERT INTO MESSAGES (author,texte,idConv) VALUES (:author,:texte,:idConv)");
	$queryPrepared -> execute(['author'=>$author,'texte'=>$content,'idConv'=>$conv]);

	echo json_encode(['status'=>'success']);

}

function getMessages($idConv) {
	$pdo = connectDB();
	$getMessages = $pdo -> prepare("SELECT texte,postDate,pseudo FROM MESSAGES JOIN AROOTS_USERS ON idUser = author WHERE idConv = :idConv ORDER BY postDate DESC LIMIT 30");
	$getMessages -> execute(['idConv'=>$idConv]);
	$messages = $getMessages->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($messages);
}