<?php include "./functions.php"; 

$userId = intval($_GET['userId']);

$threadId = intval($_GET['thread']);

$commentId=intval($_GET['comment']);

if (isset($threadId)){
    setLike($userId,$threadId);
}elseif (isset($commentId)) {
    setLikeComment($userId,$commentId);
}

