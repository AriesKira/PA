<?php include "./stylesheet/template/header.php"; ?>
<?php

if ($_GET['delete']) {
    $thread = htmlspecialchars(intval($_GET['delete']));
}else {
    die("erreur, suppréssion annulé");
}

deleteThread($thread);
$_SESSION['success'] = 1;
header("Location: ./forum.php");