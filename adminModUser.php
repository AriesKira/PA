<?php include "./stylesheet/template/header.php"; ?>
<?php 

$user = $_GET['user'];
if(!isset($user)) {
    $errors[] = "Erreur utilisateur";
    $_SESSION['errors'] = $errors;
    header('location : ./admin.php'); 
}

$pdo = connectDB();
$getUserInfos = $pdo -> prepare("SELECT email,firstname,lastname,pseudo,birthday,country FROM AROOTS_USERS WHERE idUser = :idUser ");
$getUserInfos -> execute(['idUser'=> $user]);
$userInfos = $getUserInfos ->fetch();

?>

<div class="bg-dark">
    <div class="container-fluid pt-5">
        <div class="row">
            <div class="col"></div>
            <div class="col text-center ">
                <form method="POST" action="./adminUpdateUser.php">
                    <input type="hidden" value="<?php echo $user ?>" name="userId">
                    <div class="card text-center">
                        <div class="card-header text-center">MAIL : <?php echo $userInfos['email']?></div>
                        <div class="card-body">
                            <input type="email" class="form-control text-center" name="email" placeholder="Email"><br>
                        </div>
                    </div>
                    <div class="card text-center">
                        <div class="card-header text-center">PRÉNOM : <?php echo $userInfos['firstname']?></div>
                        <div class="card-body">
                            <input type="text" class="form-control text-center" name="firstname" placeholder="Prénom">
                        </div>
                    </div>
                    <div class="card text-center">
                        <div class="card-header text-center">NOM : <?php echo $userInfos['lastname']?></div>
                        <div class="card-body">
                            <input type="text" class="form-control text-center" name="lastname" placeholder="Nom">
                        </div>
                    </div>
                    <div class="card text-center">
                        <div class="card-header text-center">PSEUDO : <?php echo $userInfos['pseudo']?></div>
                        <div class="card-body">
                            <input type="text" class="form-control text-center" name="pseudo" placeholder="Pseudo" >
                        </div>
                    </div>
                    <div class="card text-center">
                        <div class="card-header text-center">DATE DE NAISSANCE : <?php echo $userInfos['birthday']?></div>
                        <div class="card-body">
                            <input type="date" class="form-control text-center" name="birthday" placeholder="Date de naissance">
                        </div>
                    </div>
                    <div class="card text-center">
                        <div class="card-header text-center">MOT DE PASSE</div>
                        <div class="card-body">
                            <input type="password" class="form-control text-center" name="password" placeholder="Mot de passe"><br>
                            <input type="password" class="form-control text-center" name="passwordConfirm" placeholder="Confirmation">
                        </div>
                    </div>
                    <div class="card text-center">
                        <div class="card-header text-center">PAYS : <?php displayCountryFlag($userInfos)?></div>
                        <div class="card-body">
                            <select name="country" class="form-control">
                                <option value="fr" class="text-center">France</option>
                                <option value="pl" class="text-center">Pologne</option>
                                <option value="ml" class="text-center">Mali</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-outline-light mb-4 mt-4 " value="Modifier">
                </form>
                <a type="button" class="btn btn-outline-danger" href="./admin.php">ANNULER</a>
            </div>
            <div class="col"></div>
        </div>
    </div>
</div>
<div id="searchResults"></div>
<?php include "./stylesheet/template/footer.php"; ?>