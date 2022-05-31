<?php include "stylesheet/template/header.php"; ?>

<?php if (!isConnected()) {
   header("Location: index.php");
}

?>
<?php
$pdo = connectDB();

$queryPrepared = $pdo->prepare("SELECT * FROM AROOTS_USERS where idUser= ?");
$queryPrepared->execute(array($_SESSION['idUser']));
$results = $queryPrepared->fetch();
?>

<div class=" userProfileBody ">

   <div class="container-fluid userProfileBody">
      <div class="row">
         <div class="col-sm"></div>
         <div class="col-sm text-center" id="avatarHolder">
            <button onclick="displayAvatarHead()">click me</button>
               <img class="avatarImg"></img>
               <img class="avatarImg"></img>
               <img class="avatarImg"></img>
               <img class="avatarImg"></img>
            <?php echo '<h2 class="userNickname pt-4">' . $results["pseudo"] . '</h2>' ?>
         </div>
         <div class="col-sm"></div>
      </div>
      <div class="row">
         <div class="col-sm"></div>
         <?php
         echo  '<div class=" col-sm table-responsive userInfo">
                  <table class="table  table-borderless ">
                     <tbody>
                        <tr>
                           <th scope="row">Nom</th>
                           <td>' . $results["lastName"] . '</td>
                           <th scope="row">Mail</th>
                           <td>' . $results["email"] . '</td>
                        </tr>
                        <tr>
                           <th scope="row">Prénom</th>
                           <td>' . $results["firstName"] . '</td>
                           <th scope="row">Pays</th>
                           <td>';
         displayCountryFlag($results);
         echo '  
                       </tr>
                        <tr >
                           <th scope="row">Date de naissance</th>
                           <td id="birthdayRow">' . $results["birthday"] . '</td>
                           <th scope="row">Date de création du compte</th>
                           <td>' . $results["signUpDate"] . '</td>
                        </tr>

                     </tbody>
                  </table>
               </div>
               ';
         ?>
         <div class="col-sm"></div>
      </div>
      <div class="row">
         <div class="col-sm">
            <div class="container-fluid overflow-auto userLikedArticles">
               <!-- Is going to contain liked articles: need article bdd + favorite article -->
               <div class="row">
                  <h3 class="text-center">Articles Préféré</h3>
               </div>


            </div>
         </div>
         <div class="col-sm">
            <div class="container-fluid overflow-auto userStats">
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
            <div class="container-fluid overflow-auto userFriendsList">
               <div class="row">
                  <h3 class="text-center">Amis</h3>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>










<?php include "stylesheet/template/footer.php"; ?>