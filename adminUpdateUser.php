<?php include "./stylesheet/template/header.php"; ?>
<?php

    
    $user = htmlspecialchars(intval($_POST['userId']));
    if (isset($_POST['email'])) {
    $email = htmlspecialchars(strtolower(trim($_POST['email'])));
    }
    if (isset($_POST['firstname'])) {
    $firstname = htmlspecialchars(ucwords(strtolower(trim($_POST['firstname']))));
    }
    if (isset($_POST['lastname'])) {
    $lastname = htmlspecialchars(strtoupper(trim($_POST['lastname'])));
    }
    if (isset($_POST['pseudo'])) {
    $pseudo = htmlspecialchars(ucwords(strtolower(trim($_POST['pseudo']))));
    }
    if (isset($_POST["password"])) {
    $pwd = $_POST["password"];
    }
    if (isset($_POST["passwordConfirm"])) {
    $pwdConfirm = $_POST["passwordConfirm"];
    }
    if (isset($_POST["birthday"])) {
    $birthday = $_POST["birthday"];
    }
    if (isset( $_POST["country"])) {
    $country = $_POST["country"];
    }

    $errors = [];

    if ($email) {
        //Email OK
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email incorrect";
        } else {

            //Vérification l'unicité de l'email
            $pdo = connectDB();
            $queryPrepared = $pdo->prepare("SELECT idUser from AROOTS_USERS WHERE email=:email");

            $queryPrepared->execute(["email" => $email]);

            if (!empty($queryPrepared->fetch())) {
                $errors[] = "L'email existe déjà";
            }
        }
    }
    if ($firstname) {
        //prénom : Min 2, Max 45 ou empty
        if (strlen($firstname) == 1 || strlen($firstname) > 40) {
            $errors[] = "Le prénom doit faire plus de 2 caractères et moins de 40";
        }
    } 

    if ($lastname) {
        //nom : Min 2, Max 100 ou empty
        if (strlen($lastname) == 1 || strlen($lastname) > 100) {
            $errors[] = "Le nom doit faire plus de 2 caractères";
        }
    }

    if ($pseudo) {
        //pseudo : Min 4 Max 60 et uicité
        if (strlen($pseudo) < 4 || strlen($pseudo) > 40) {
            $errors[] = "Le pseudo doit faire entre 4 et 40 caractères";
        } else {
            $pdo = connectDB();
            $queryPrepared = $pdo->prepare("SELECT pseudo from AROOTS_USERS WHERE pseudo=:pseudo");

            $queryPrepared->execute(["pseudo" => $pseudo]);

            if (!empty($queryPrepared->fetch())) {
                $errors[] = "Ce pseudo est déjà pris";
            }
        }
    }

    if ($birthday) {
        //Date anniversaire : YYYY-mm-dd
        //entre 16 et 100 ans
        $birthdayExploded = explode("-", $birthday);

        if (count($birthdayExploded) != 3 || !checkdate($birthdayExploded[1], $birthdayExploded[2], $birthdayExploded[0])) {
            $errors[] = "date incorrecte";
        } else {
            $age = (time() - strtotime($birthday)) / 60 / 60 / 24 / 365.2425;
            if ($age < 16) {
                $errors[] = "Age incorrecte";
            }
        }
    }

    //Mot de passe : Min 8, Maj, Min et chiffre
    if ($pwd){
        if(!$pwdConfirm){
            $errors[] = "Le mot de passe de confirmation doit être remplie";
        }

        if (isset($pwd) && isset($pwdConfirm)) {
            if (strlen($pwd) < 8 || preg_match("#\d#", $pwd) == 0 || preg_match("#[a-z]#", $pwd) == 0 || preg_match("#[A-Z]#", $pwd) == 0) {
                $errors[] = "Le mot de passe doit faire plus de 8 caractères avec une minuscule, une majuscule et un chiffre";
            }
        
            //Confirmation : égalité
            if ($pwd != $pwdConfirm) {
                $errors[] = "Le mot de passe de confirmation ne correspond pas";
            }
        }
    }
    //Pays
    if ($country){
        $countryAuthorized = ["fr", "ml", "pl"];
        if (!in_array($country, $countryAuthorized)) {
            $errors[] = "Pays invalide";
        }
    }

    if (empty($errors)) {
        $success = 0;
        if ($email) {
            $pdo = connectDB();
            $newEmail = $pdo -> prepare("UPDATE AROOTS_USERS SET email = :email WHERE idUser = :idUser");
            $newEmail->execute(['email'=>$email,"idUser"=>$user]);
            $success = $success + 1;
        }

        if ($firstname) {
            $pdo = connectDB();
            $newEmail = $pdo -> prepare("UPDATE AROOTS_USERS SET firstname = :firstname WHERE idUser = :idUser");
            $newEmail->execute(['firstname'=>$firstname,"idUser"=>$user]);
            $success = $success + 1;
        }

        if ($lastname) {
            $pdo = connectDB();
            $newEmail = $pdo -> prepare("UPDATE AROOTS_USERS SET lastname = :lastname WHERE idUser = :idUser");
            $newEmail->execute(['lastname'=>$lastname,"idUser"=>$user]);
            $success = $success + 1;  
        }

        if ($pseudo) {
            $pdo = connectDB();
            $newEmail = $pdo -> prepare("UPDATE AROOTS_USERS SET pseudo = :pseudo WHERE idUser = :idUser");
            $newEmail->execute(['pseudo'=>$pseudo,"idUser"=>$user]);
            $success = $success + 1;
        }

        if ($birthday) {
            $pdo = connectDB();
            $newEmail = $pdo -> prepare("UPDATE AROOTS_USERS SET birthday = :birthday WHERE idUser = :idUser");
            $newEmail->execute(['birthday'=>$birthday,"idUser"=>$user]);
            $success = $success + 1;
        }

        if ($pwd && $pwdConfirm && $pwd == $pwdConfirm) {

            $pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $pdo = connectDB();
            $newEmail = $pdo -> prepare("UPDATE AROOTS_USERS SET pwd = :pwd WHERE idUser = :idUser");
            $newEmail->execute(['pwd'=>$pwd,"idUser"=>$user]);
            $success = $success + 1;
        }

        if ($country) {
            $pdo = connectDB();
            $newEmail = $pdo -> prepare("UPDATE AROOTS_USERS SET country = :country WHERE idUser = :idUser");
            $newEmail->execute(['country'=>$country,"idUser"=>$user]);
        }

        $_SESSION['success'] = $success;
        header('location : ./admin.php');
    }else {
        $_SESSION['errors'] = $errors;
        header('location : ./admin.php');
    }

?>
<?php include "./stylesheet/template/footer.php"; ?>