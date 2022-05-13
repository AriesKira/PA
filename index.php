<?php include "../PA/stylesheet/template/header.php"; ?>

<div id="animatedBackground" class="bloc">
   <video autoplay="autoplay" muted="" loop="infinite" src="stylesheet/videos/earth.mp4"></video>
   <?php
   if (!empty($_SESSION['errors']) && isset($_SESSION['errors'])) {
      echo '<div class="alert alert-danger mt-4 pb-1" role="alert">';

      for ($i = 0; $i < count($_SESSION['errors']); $i++) {
         $element = $_SESSION['errors'][$i];
         echo '<h5 class="fw-bold">- ' . $element . '</h5>';
      }
      echo '</div>';
      unset($_SESSION['errors']);
   } ?>
   <div id="pageIconsSelection">
      <a href="">
         <i id="articlePageIcon" class="fa-solid fa-book fa-7x zoom-box"></i>
      </a>
      <a href="">
         <i id="trainingPageIcon" class="fa-solid fa-gamepad fa-7x zoom-box"></i>
      </a>
      <a href="">
         <i id="forumPageIcon" class="fa-solid fa-people-group fa-7x zoom-box"></i>
      </a>
      <a href="">
         <i id="advicePageIcon" class="fa-solid fa-comment-medical fa-7x zoom-box"></i>
      </a>
      <?php if (isConnected()) { ?>
         <a href="./userProfile.php">
            <i id="userProfilePageIcon" class="fa-solid fa-user-astronaut fa-7x zoom-box"></i>
         </a>
      <?php } ?>
   </div>
</div>
<div hidden id="loginBody">
   <?php include "./authentication/login.php" ?>
</div>
<div hidden id="registerBody">
   <?php include "./authentication/register.php" ?>
</div>


<?php include "../PA/stylesheet/template/footer.php"; ?>