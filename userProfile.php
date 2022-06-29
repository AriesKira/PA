<?php include "stylesheet/template/header.php"; ?>

<?php 
    if (!isConnected()) {
        header("Location: ./index.php");
    }
    if ($_SESSION['pseudo']==$_GET['pseudo']){
        header("location: ./myProfile.php");
    }else {
        $pdo = connectDB();

        //user info's
        $queryPrepared = $pdo->prepare("SELECT idUser,pseudo,country FROM AROOTS_USERS where pseudo= ?");
        $queryPrepared->execute(array($_GET['pseudo']));
        $results = $queryPrepared->fetch();

        //AVATAR
        $queryPrepared2 = $pdo->prepare("SELECT * FROM AVATARS WHERE userId = :userId");
        $queryPrepared2 -> execute(['userId'=>$results[0]]);
        $avatar = $queryPrepared2->fetch();

        $userHair =intval($avatar['hair']);
        $userLeftEye = intval($avatar['leftEye']);
        $userRightEye = intval($avatar['rightEye']);
        $userMouth = intval($avatar['mouth']);

        //user Threads
        $queryPrepared3 = $pdo->prepare("SELECT * FROM AROOTS_THREAD WHERE author=:author ORDER BY postDate DESC");
        $queryPrepared3->execute(["author"=>$results[0]]);
        $threads = $queryPrepared3->fetchAll();
        $nbThreads = $queryPrepared3->rowCount();

    
        ?>
        <input id="userProfileHair" type="hidden" disabled  value="<?php echo $userHair ?>">
        <input id="userProfileLeftEye" type="hidden" disabled  value="<?php echo $userLeftEye ?>">
        <input id="userProfileRightEye" type="hidden" disabled  value="<?php echo $userRightEye ?>">
        <input id="userProfileMouth" type="hidden" disabled  value="<?php echo $userMouth ?>">

        <div class="userProfileBody">
            <div class="row">
                <div class="col-sm"></div>
                <div class="col-sm text-center">
                    <div class="col" id="avatarHolder">
                    <canvas id="avatarCanvas"></canvas>
                    </div>
                    <div class="col"><?php echo '<h2 class="userNickname pt-4"style="color:#EF0B0B">' . $results["pseudo"] . '</h2>';displayCountryFlag($results); ?></div>
                </div>
                <div class="col-sm text-center "></div>
            </div>
            <?php if ($nbThreads != 0) {?>
                <div class="row pt-5">
                    <div class="col-sm"></div>
                    <div class="col-sm">
                        <div class="row">
                            <h4 class="text-center" style="color:aliceblue;">Thread de l'utilisateur :</h4>
                        </div>
                        <?php
                            
                            foreach ($threads as $thread) {
                                $authorID = $thread['author'];
                                $threadLikes = threadLikes($thread['idThread']);
                                echo '
                                <hr>
                                <div class="row">
                                    <div class="col-2"></div>
                                    <div class="col-8">
                                        <div class="card threadsPreviews">
                                            <div class="card-header text-center"><h6>Theme : ' . $thread['theme'] . '</h6></div>
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
                                                        ' . substr($thread['texte'], 0, 49) . '...
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
                                    <div class="col-2"></div>
                                </div>
                        
                                ';
                            } 

                        
                        }else{
                            echo '
                            <div class="row pt-5">
                                <div class="col-sm"></div>
                                <div class="col-sm">
                                    <div class="row">
                                        <h4 class="text-center" style="color:aliceblue;">Cette utilisateur n\'a rien posté pour le moment</h4>
                                    </div>
                                    <div class="row">
                                        <img src="./stylesheet/images/threadImages/noPostYet.gif">
                                    </div>
                                </div>
                                <div class="col-sm"></div>
                            </div>
                            ';
                        }
                     ?>
                </div>
                <div class="col-sm"></div>
            </div>
        </div>
   <?php }?>



<script src="./avatarJS/avatar.js"></script>
<script>
   window.onload = showUsersAvatar();
</script>

<?php include "stylesheet/template/footer.php"; ?>