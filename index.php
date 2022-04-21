<?php

session_start();
require "functions.php";

?>

<?php include "../PA/stylesheet/template/header.php";?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="Test" content="Ma super Page" lang="FR">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" href="stylesheet/css/style.css">
      <title></title>
   </head>
   <body>
      <div id="animatedBackground" class="bloc">
         <video autoplay="autoplay" muted="" loop="infinite" src="stylesheet/videos/earth.mp4"></video> 
      </div>
      
   </body>
</html>

<?php include "/Applications/MAMP/htdocs/PA/stylesheet/template/footer.php";?>
