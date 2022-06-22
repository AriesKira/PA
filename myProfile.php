<?php include "stylesheet/template/header.php"; ?>

<?php if (!isConnected()) {
   header("Location: ./index.php");
}

?>
<?php
$pdo = connectDB();

$queryPrepared = $pdo->prepare("SELECT * FROM AROOTS_USERS where idUser= ?");
$queryPrepared->execute(array($_SESSION['idUser']));
$results = $queryPrepared->fetch();

$queryPrepared2 = $pdo->prepare("SELECT * FROM AVATARS WHERE userId = :userId");
$queryPrepared2 -> execute(['userId'=>$userID]);
$avatar = $queryPrepared2->fetch();


$queryPrepared = $pdo->prepare("SELECT * FROM AROOTS_THREAD WHERE author=:author ORDER BY postDate DESC");
$queryPrepared->execute(["author"=>$_SESSION['idUser']]);
$threads = $queryPrepared->fetchAll();

$userHair =intval($avatar['hair']);
$userLeftEye = intval($avatar['leftEye']);
$userRightEye = intval($avatar['rightEye']);
$userMouth = intval($avatar['mouth']);

?>

<div class=" userProfileBody ">

   <div class="container-fluid userProfileBody">
      <?php
      if (!empty($_SESSION['errors']) && isset($_SESSION['errors'])) {
         echo '<div class="alert alert-danger" role="alert">';

         for ($i = 0; $i < count($_SESSION['errors']); $i++) {
            $element = $_SESSION['errors'][$i];
            echo '<h5 class="fw-bold">- ' . $element . '</h5>';
         }
         echo '</div>';
         unset($_SESSION['errors']);
      }
      ?>
      <div class="row">
         <div class="col-sm"></div>
         <div class="col-sm text-center">
            <div class="col" id="avatarHolder">
               <canvas id="avatarCanvas"></canvas>
            </div>
            <div class="col"><?php echo '<h2 class="userNickname pt-4">' . $results["pseudo"] . '</h2>' ?></div>
         </div>
         <div class="col-sm text-center ">
            <button id="modUserButton" onclick="displayModUser();">
               <lord-icon src="https://cdn.lordicon.com/ryyjawhw.json" title="CLIQUE MOI POUR MODIFIER TON PROFILE !" trigger="loop" colors="primary:#ef0b0b" style="width:70px;height:70px"></lord-icon>
            </button>
         </div>
      </div>
      <div class="row">
         <div class="col-sm"></div>
         <?php
         echo  '<div class=" col-sm table-responsive userInfo shadow ">
                  <table class="table  table-borderless text-white">
                     <tbody>
                        <tr>
                           <th scope="row">Nom</th>
                           <td userInfoText>' . $results["lastName"] . '</td>
                           <th scope="row">Mail</th>
                           <td userInfoText>' . $results["email"] . '</td>
                        </tr>
                        <tr>
                           <th scope="row">Prénom</th>
                           <td userInfoText>' . $results["firstName"] . '</td>
                           <th scope="row">Pays</th>
                           <td>';
         displayCountryFlag($results);
         echo '  
                       </tr>
                        <tr >
                           <th scope="row">Date de naissance</th>
                           <td id="birthdayRow" userInfoText>' . $results["birthday"] . '</td>
                           <th scope="row">Date de création du compte</th>
                           <td userInfoText>' . $results["signUpDate"] . '</td>
                        </tr>

                     </tbody>
                  </table>
               </div>
               ';
         ?>
         <div class="col-sm"></div>
      </div>
      <?php
      foreach ($threads as $thread) {
         $authorID = $thread['author'];
         $threadLikes = threadLikes($thread['idThread']);
         echo '
         <hr>
         <div class="row">
             <div class="col"></div>
             <div class="col">
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
                                     <img src="'.$thread["picture"].'">
                                 </div>
                             ';}else{echo'
                                 <div>
                                 ' . substr($thread['texte'], 0, 49) . '...
                                 </div>
                             ';}echo'
                         </div>
                         
                     </div>
                     <div class="card-footer">
                         <h6 class="text-start text-muted">' . getAuthor($thread['author']) . '</h6>
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
      <div class="row pb-5">
         <div class="col-sm">
            <div class="container-fluid overflow-auto userLikedArticles shadow">
               <!-- Is going to contain liked articles: need article bdd + favorite article -->
               <div class="row">
                  <h3 class="text-center">Articles Préféré</h3>
               </div>


            </div>
         </div>
         <div class="col-sm">
            <div class="container-fluid overflow-auto userStats shadow">
               <!-- Is going to contain user xp level-->
               <div class="row">
                  <div class="col-sm">
                     <h3 class="text-center">Niveau 0</h3>
                  </div>
               </div>
               <!-- current exercise-->
               <div class="row">
                  <div class="col-sm"></div>
                  <div class="col-5">
                     <a href="" class="text-center">Current Exercise</a>
                  </div>
                  <div class="col-sm"></div>
               </div>
               <!-- exercises done -->
               <div class="row">
                  <div class="">
                     Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt provident quis deleniti vel ut exercitationem deserunt officia molestiae voluptatibus in nam, accusantium soluta, eligendi doloribus beatae ea inventore tempora iure.
                     Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti harum facere ab laboriosam dolorem fugiat suscipit provident ratione, recusandae dolorum? Ad minus repellat quibusdam dolore voluptate similique, porro totam ratione?
                  </div>
               </div>
            </div>
         </div>
         <!-- Probably Friends List -->
         <div class="col-sm">
            <div class="container-fluid overflow-auto userFriendsList shadow">
               <div class="row">
                  <h3 class="text-center">Amis</h3>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div hidden id="modifyUserProfile">
   <?php include "./modMyProfile.php" ?>
</div>
<script src="./avatarJS/avatar.js"></script>
<script>
   window.onload = showUserAvatar();
</script>








<?php include "stylesheet/template/footer.php"; ?>