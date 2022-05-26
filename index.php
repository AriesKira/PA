<?php include "../PA/stylesheet/template/header.php"; ?>

<div id="animatedBackground" class="bloc">
   <video autoplay="autoplay" muted="" loop="infinite" src="/stylesheet/videos/earth.mp4"></video>
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
   ?>
   <div id="pageIconsSelection" class="container-fluid">
      <div class="row">
         <div class="col text-center">
            <a href="./articles.php">
               <i id="articlePageIcon" class="fa-solid fa-book fa-7x zoom-box"></i>
            </a>
         </div>
         <div class="col text-center">
            <a href="">
               <i id="trainingPageIcon" class="fa-solid fa-gamepad fa-7x zoom-box"></i>
            </a>
         </div>
         <div class="col text-center">
            <a href="">
               <i id="forumPageIcon" class="fa-solid fa-people-group fa-7x zoom-box"></i>
            </a>
         </div>

         <?php if (isConnected()) { ?>
            <div class="col text-center">
               <a href="./myProfile.php">
                  <i id="userProfilePageIcon" class="fa-solid fa-user-astronaut fa-7x zoom-box"></i>
               </a>
            <?php } ?>
            </div>
      </div>
   </div>
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
<div hidden id="burgerMenuContent1">
   <?php include "./authentication/login.php" ?>
</div>
<div hidden id="burgerMenuContent2">
   <?php include "./authentication/login.php" ?>
</div>

<?php include "../PA/stylesheet/template/footer.php"; ?>