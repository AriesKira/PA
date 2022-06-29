<?php include "./stylesheet/template/header.php"; ?>
<?php
$current = $_SERVER['REQUEST_URI'];
$threadId = $_GET['id'];

$pdo = connectDB();
$queryPrepared = $pdo->prepare("SELECT * FROM AROOTS_THREAD WHERE idThread = :idThread");
$queryPrepared->execute(['idThread'=>$threadId]);
$thread = $queryPrepared->fetch();

$queryPrepared2 = $pdo->prepare("SELECT * FROM THREAD_COMMENT WHERE idThread=:idThread");
$queryPrepared2->execute(["idThread"=>$threadId]);
$comments = $queryPrepared2->fetchAll();
$nbComment = $queryPrepared2->rowCount();



$authorID = $thread['author'];
$threadLikes = threadLikes($thread['idThread']);

if (!isConnected()) {
    $errors[]="Vous devez être inscrit pour pouvoir accéder à cette page.";
    $_SESSION['errors'] = $errors;
    header("Location: ./index.php");
}
if (empty($thread)){
    $errors[]="Thread inexistant";
    $_SESSION['errors'] = $errors;
    header("Location: ./forum.php");
}
echo '
<div class="forumBody">
    <div class="row pt-5">
        <div class="col"></div>
        <div class="col text-center">
            <h4 style="color:white">'.getThreadAuthor($authorID).'</h4>
        </div>
        <div class="col"></div>
    </div>
    <div class="row pt-5">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card threadsPreviews">
                <div class="card-header text-center"><h6>Theme : ' . $thread['theme'] . '</h6>
                </div>
                <div class="card-title card-header text-center"><h5>
                ' . substr($thread['title'], 0, 49) . '</h5>
                </div>
                <div class="card-body">
                    <div class="card-text text-muted">
                        ';
                        if (hasImage($thread['idThread'])&& empty($thread['texte'])){echo '
                            <div class="threadPreviewImage text-center">
                                <img class="img-fluid" src="'.$thread["picture"].'">
                            </div>
                        ';}else{echo'
                            <div>
                                <div class="pt-4">
                                    <p style="color:black">' . $thread['texte'] . '</p>
                                </div>
                                <div class="threadPreviewImage text-center pt-3">
                                    <img class="img-fluid" src="'.$thread["picture"].'">
                                </div>
                            </div>
                        ';}echo'
                    </div>                    
                </div>
                <div class="card-footer">  
                    <div class="text-center">
                        <button type="button" class="btn btn-outline-dark" onclick="PopUpMakeThreadComment()" >Commenter</button> 
                        <button type="button" class="userLikeButton " onclick="setLike('.$thread['idThread'].','.$userID.')">';if(hasLiked($userID,$thread['idThread'])){echo '<img id="likeImage_'.$thread['idThread'].'" src="./stylesheet/images/logo/liked.png">';}else{echo'<img id="likeImage_'.$thread['idThread'].'" src="./stylesheet/images/logo/notLiked.png">';} echo'</button>
                        <span id="likeCounter_'.$thread['idThread'].'" style=" color:black">
                            '.$threadLikes.'
                        </span>
                    </div>
                    <h6 class="text-end text-muted">' . $thread['postDate'] . '</h6>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>                        
<hr>
<div class="row">
    <div class="col"></div>
    <div class="col text-center"><h4 style="color:white;">Réponse</h4></div>
    <div class="col"></div>
</div>
<hr>
';

if ($nbComment != 0) {
    foreach($comments as $comment) {
        echo '
        <div class="row pb-4">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-start">
                        <button type="button" class="userLikeButton" onclick="setLikeComment('.$comment['idThreadComment'].','.$userID.')">';if(hasLikedThreadComment($userID,$comment['idThreadComment'])){echo '<img id="likeImage_'.$comment['idThreadComment'].'" src="./stylesheet/images/logo/liked.png">';}else{echo'<img id="likeImage_'.$comment['idThreadComment'].'" src="./stylesheet/images/logo/notLiked.png">';} echo'</button>
                        <span id="likeCounter_'.$comment['idThreadComment'].'" style=" color:black">
                            '.$commentLikes = threadCommentLikes($comment['idThreadComment']).'
                        </span>
                        <div class="text-center">
                            <h5>'.getThreadCommentAuthor($comment['author']).'</h5>
                        </div>
                        <div class="text-end">'.$comment['postDate'].'</div>
                    </div>
                    <div class="card-body">
                        <div class="card-text text-muted">
                            ';
                            if (commentHasImage($comment['idThreadComment'])&& empty($comment['texte'])){echo '
                                <div class="threadPreviewImage text-center">
                                    <img class="img-fluid" src="'.$comment["picture"].'">
                                </div>
                            ';}else{echo'
                                <div>
                                    <div class="pt-4">
                                        <p style="color:black">' . $comment['texte'] . '</p>
                                    </div>
                                    <div class="threadPreviewImage text-center pt-3">
                                        <img class="img-fluid" src="'.$comment["picture"].'">
                                    </div>
                                </div>
                            ';}echo'
                        </div>                    
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
        ';
    } 
}else {
    echo '
      <div class="row pt-2 pb-4">
          <div class="col-2"></div>
          <div class="col-8">
              <div class="row">
                  <h4 class="text-center" style="color:aliceblue;">Aucune réponse pour le moment</h4>
              </div>
              <div class="row">
                  <img src="./stylesheet/images/threadImages/noCommentYet.gif">
              </div>
          </div>
          <div class="col-2"></div>
      </div>
    ';
}
    ?>
<div id="searchResults"></div>
<div hidden id="makeThreadComment">
    <?php include "./makeThreadComment.php" ?>
</div>

<?php include "./stylesheet/template/footer.php"; ?>

