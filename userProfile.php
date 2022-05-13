<?php include "../PA/stylesheet/template/header.php"; ?>

<?php
$pdo = connectDB();

$queryPrepared = $pdo->prepare("SELECT * FROM aroots_user where id= ?");
$queryPrepared->execute(array($_SESSION['id']));
$results = $queryPrepared->fetch();


?>

<div class="d-flex justify-content-center userProfileBody">
   <div class="preview d-flex justify-content-center mt-5 userProfileBody">
      <input id="userIconImg" type="file" accept="image/*" onchange="showPreview(event);">
      <img id="imgPreview" class="userIcon">
   </div>
</div>
<div class="d-flex justify-content-center userProfileBody">
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
         echo '<div class="col-sm userInfo">
                  <h5 class="pt-4">' . $results["lastname"] . '</h5>
                  <div class="row">
                     <h5 class="pt-4">' . $results["firstname"] . '</h5>
                  </div>
                  <div class="row">
                     <h5 class="pt-4">Date de naissance : <p class="">' . $results["birthday"] . '</p></h5>
                  </div>
               </div>' ?>
         <div class="col-sm"></div>
      </div>
   </div>

</div>



<script>
   function showPreview(event) {
      if (event.target.files.length > 0) {
         var src = URL.createObjectURL(event.target.files[0]);
         var preview = document.getElementById("imgPreview");
         preview.src = src;
         preview.style.display = "block";
      }
   }
</script>

<?php if (!isConnected()) {
   header("Location: /PA/index.php");
}



?>


<?php include "../PA/stylesheet/template/footer.php"; ?>