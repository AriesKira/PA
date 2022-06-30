<?php include "./stylesheet/template/header.php"; ?>

<div id="animatedBackground" class="bloc">
   <video autoplay="autoplay" muted="" loop="infinite" src="stylesheet/videos/earth.mp4"></video>
   <?php
   if (isConnected()) {
		if (!isValidated($userID)) {
			echo '<div id="infoPanel" class="alert mt-4 pb-1 alert-primary" role="alert">Un mail de vérification vous à été envoyé.</div>';
		}
	}
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
            <a href="./forum.php">
               <i id="forumPageIcon" class="fa-solid fa-people-group fa-7x zoom-box"></i>
            </a>
         </div>

         <?php if (isConnected()) { 
            echo '<div class="col text-center">
               <a href="./myProfile.php">
                  <i id="userProfilePageIcon" class="fa-solid fa-user-astronaut fa-7x zoom-box"></i>
               </a>
         
            </div>';
         } ?>
      </div>
   </div>
</div>
<div id="searchResults"></div>

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