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