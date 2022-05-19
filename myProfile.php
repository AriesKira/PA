<?php include "../PA/stylesheet/template/header.php"; ?>

<?php
$pdo = connectDB();

$queryPrepared = $pdo->prepare("SELECT * FROM aroots_user where id= ?");
$queryPrepared->execute(array($_SESSION['id']));
$results = $queryPrepared->fetch();


?>

<div class="d-flex justify-content-center userProfileBody ">

   <div class="container-fluid userProfileBody">
      <div class="row">
         <div class="col-sm"></div>
         <div class="col-sm text-center">
            <?php echo '<h2 class="userNickname pt-4">' . $results["pseudo"] . '</h2>' ?>
         </div>
         <div class="col-sm"></div>
      </div>
      <div class="row">
         <div class="col-sm"></div>
         <?php
         $countryDisplay = "<img src=" . './stylesheet/images/flags/france.png' . ">";
         echo  '<div class="col-sm userInfo">
                  <table class="table ">
                     
                     <tbody>
                        <tr>
                           <th scope="row">Nom</th>
                           <td>' . $results["lastname"] . '</td>
                           <th scope="row">Mail</th>
                           <td>' . $results["email"] . '</td>
                        </tr>
                        <tr>
                           <th scope="row">Prénom</th>
                           <td>' . $results["firstname"] . '</td>
                           <th scope="row">Pays</th>
                           <td>';
         if ($results["country"] == "fr") {
            echo '' . $countryDisplay . '';
         };
         echo '</td>
                           
                        </tr>
                        <tr >
                           <th scope="row">Date de naissance</th>
                           <td id="birthdayRow">' . $results["birthday"] . '</td>
                           <th scope="row">Date de création du compte</th>
                           <td>' . $results["date_inserted"] . '</td>
                        </tr>

                     </tbody>
                  </table>
               </div>
               ';
         ?>
         <div class="col-sm"></div>
      </div>
   </div>

</div>





<?php if (!isConnected()) {
   header("Location: /PA/index.php");
}



?>


<?php include "../PA/stylesheet/template/footer.php"; ?>