<?php include "./stylesheet/template/header.php"; ?>

<?php
if (!isConnected()) {
    header('location : ./index.php');
}
if (!isAdmin($userID)) {
    $errors = [];
    $errors[] = "Rôle Invalide";
    $_SESSION['errors'] = $errors;
    header("Location: ./index.php");
}
$user = intval($_GET['user']);

$validate = htmlspecialchars(intval($_GET['validate']));
$delete = htmlspecialchars(intval($_GET['delete']));
$set = htmlspecialchars(intval($_GET['set']));


if (!isset($user)) {
    die("Erreur avec l'utilisateur choisit");
}

if (isset($validate) && $validate == 1){
    validateUser($user);
}
if (isset($delete) && $delete == 1) { 
    deleteUser($user);
}
if (isset($set) && $set == 1) {
    setNormalUser($user);
}
if (isset($set) && $set == 2) {
    setWebmasterUser($user);
}
if (isset($set) && $set == 3) {
    setAdminUser($user);
}
