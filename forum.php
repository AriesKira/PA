<?php include "./stylesheet/template/header.php"; ?>
<?php if (!isConnected()) {
    $errors[]="Vous devez être inscrit pour pouvoir accéder à cette page.";
    $_SESSION['errors'] = $errors;
    header("Location: ./index.php");
}
?>
<div class="container-fluid forumBody">
    <div class="text-center forumBody pt-3 pb-3">
        <h1 style="color:white">FORUM</h1>
    </div>
    <?php
    echo '<div id="infoPanel">';
    if (!empty($_SESSION['errors']) && isset($_SESSION['errors'])) {
        echo '<div class="alert alert-danger mt-4 pb-1" role="alert">';

        for ($i = 0; $i < count($_SESSION['errors']); $i++) {
            $element = $_SESSION['errors'][$i];
            echo '<h5 class="fw-bold">- ' . $element . '</h5>';
        }
        echo '</div>';
        unset($_SESSION['errors']);
    }
    echo '</div>';


    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT * FROM AROOTS_THREAD ORDER BY postDate DESC");
    $queryPrepared->execute();
    $threads = $queryPrepared->fetchAll();

    foreach ($threads as $thread) {
        $authorID = $thread['author'];
        $threadLikes = threadLikes($thread['idThread']);
        echo '
        <hr>
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="card threadsPreviews shadow">
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
                                    <img src="'.$thread["picture"].'">
                                </div>
                            ';}else{echo'
                                <div>
                                ' . substr($thread['texte'], 0, 99) . '...
                                </div>
                            ';}echo'
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <h6 class="text-start text-muted">' . getThreadAuthor($thread['author']) . '</h6>
                        <div class="text-center" id="like_'.$thread['idThread'].'">
                            <a class="btn btn-primary mt-2 threadLink" href="./thread.php?id='.$thread['idThread'].'&title='.$thread['title'].'">Suivre ce thread</a>
                            <button type="button" class="userLikeButton" onclick="setLike('.$thread['idThread'].','.$userID.')">';if(hasLiked($userID,$thread['idThread'])){echo '<img id="likeImage_'.$thread['idThread'].'" src="./stylesheet/images/logo/liked.png">';}else{echo'<img id="likeImage_'.$thread['idThread'].'" src="./stylesheet/images/logo/notLiked.png">';} echo'</button>
                            <span id="likeCounter_'.$thread['idThread'].'" style=" color:black">
                                '.$threadLikes.'
                            </span>
                        </div>
                        <h6 class="text-end text-muted">' . $thread['postDate'] . '</h6>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>

        ';
    }
    ?>
    <a class="btn makeThreadButton" onclick="PopUpMakeThread()">Crée ton Thread</a>
</div>

<div hidden id="makeThread">
    <?php include "./makeThread.php" ?>
</div>
<div hidden id="loginBody">
   <?php include "./authentication/login.php" ?>
</div>
<div hidden id="registerBody">
   <?php include "./authentication/register.html" ?>
</div>
<div hidden id="captchaBody">
   <?php include "./authentication/captcha.php" ?>
</div>
<?php include "./stylesheet/template/footer.php"; ?>