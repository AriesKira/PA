<?php include "./functions.php"; 

$userId = htmlspecialchars(intval($_GET['userId']));

$threadId = htmlspecialchars(intval($_GET['thread']));

$commentId= htmlspecialchars(intval($_GET['comment']));



if (isset($threadId)){
    setLike($userId,$threadId);
}
if (isset($commentId)) {
    setLikeComment($userId,$commentId);
}

