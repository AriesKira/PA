<?php include "./functions.php"; 

$userId = intval($_GET['userId']);

$threadId = intval($_GET['thread']);

$commentId = intval($_GET['comment']);

if ($commentId) {
    setLikeComment($userId,$commentId);
}
if ($threadId){
    setLike($userId,$threadId);
}


