<?php include "../PA/stylesheet/template/header.php"; ?>

<div id="animatedBackground" class="bloc">
   <video autoplay="autoplay" muted="" loop="infinite" src="stylesheet/videos/earth.mp4"></video>
   <div id="pageIconsSelection">
      <a href="">
         <i id="articlePageIcon"class="fa-solid fa-book fa-7x zoom-box"></i>
      </a>
      <a href="">
         <i id="trainingPageIcon"class="fa-solid fa-gamepad fa-7x zoom-box"></i>
      </a>
      <a href="">
         <i id="forumPageIcon" class="fa-solid fa-people-group fa-7x zoom-box"></i>
      </a>
      <a href="">
         <i id="advicePageIcon" class="fa-solid fa-comment-medical fa-7x zoom-box"></i>
      </a>  
      <a href="./userProfile.php">
         <i id="userProfilePageIcon" class="fa-solid fa-user-astronaut fa-7x zoom-box"></i>
      </a>
   </div>
</div>
<div hidden id="loginBody">
   <?php include "./authentication/login.php" ?>
</div>
<div hidden id="registerBody">
   <?php include "./authentication/register.php" ?>
</div>




<?php include "/Applications/MAMP/htdocs/PA/stylesheet/template/footer.php"; ?>