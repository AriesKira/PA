<?php
session_start();

include 'functions.php';
$userID = $_SESSION['idUser'];
//USER INFO FORM
if (isset($_POST['email'])) {
    $email = $_POST["email"];
}
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$pwd = $_POST["password"];
$pwdConfirm = $_POST["passwordConfirm"];
$birthday = $_POST["birthday"];
$country = $_POST["country"];

if (isset($_POST['email'])) {
    $email = htmlspecialchars(strtolower(trim($email)));
}
$firstname = htmlspecialchars(ucwords(strtolower(trim($firstname))));
$lastname = htmlspecialchars(strtoupper(trim($lastname)));


$errors = [];
if (isset($_POST['email'])) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email incorrect";
    } else {
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("SELECT email FROM AROOTS_USERS where email = :email AND idUser != :idUser ");
        $queryPrepared->execute(['email' => $email, 'idUser' => $userID]);
        $count = $queryPrepared->rowCount();

        if ($count != 0) {
            $errors[] = "Email existe déjà";
        }
    }
}

if (strlen($firstname) < 2 || strlen($firstname) > 40) {
    $errors[] = "Votre prénom doit faire plus de 2 caractères et moins de 40";
}

if (strlen($lastname) == 1 || strlen($lastname) > 100) {
    $errors[] = "Votre nom doit faire plus de 2 caractères";
}

$birthdayExploded = explode("-", $birthday);

if (count($birthdayExploded) != 3 || !checkdate($birthdayExploded[1], $birthdayExploded[2], $birthdayExploded[0])) {
    $errors[] = "date incorrecte";
} else {
    $age = (time() - strtotime($birthday)) / 60 / 60 / 24 / 365.2425;
    if ($age < 16) {
        $errors[] = "Vous devez avoir plus de 16 ans pour vous inscrire";
    }
}

if (
    strlen($pwd) < 8 ||
    preg_match("#\d#", $pwd) == 0 ||
    preg_match("#[a-z]#", $pwd) == 0 ||
    preg_match("#[A-Z]#", $pwd) == 0
) {
    $errors[] = "Votre mot de passe doit faire plus de 8 caractères avec une minuscule, une majuscule et un chiffre";
}

if ($pwd != $pwdConfirm) {
    $errors[] = "Votre mot de passe de confirmation ne correspond pas";
}

$countryAuthorized = ["fr", "ml", "pl"];
if (!in_array($country, $countryAuthorized)) {
    $errors[] = "Votre pays n'existe pas";
}

$key = rdmKeyValues();
if (isset($_POST['email'])) {
    if (count($errors) == 0) {
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("UPDATE AROOTS_USERS SET firstName = :firstName, lastName = :lastName, email = :email, country = :country, birthday = :birthday, pwd=:pwd , mailKey = :mailKey WHERE idUser = $userID ");
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);

        $queryPrepared->execute([
            'firstName' => $firstname,
            'lastName' => $lastname,
            'email' => $email,
            'country' => $country,
            'birthday' => $birthday,
            'pwd' => $pwd,
            'mailKey' => $key,
        ]);

        sendVerifyMail($email, $pseudo, $key);
    } else {
        $_SESSION['errors'] = $errors;
    }
} else {
    if (count($errors) == 0) {
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("UPDATE AROOTS_USERS SET firstName = :firstName, lastName = :lastName, country = :country, birthday = :birthday, pwd=:pwd WHERE idUser = $userID ");
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);

        $queryPrepared->execute([
            'firstName' => $firstname,
            'lastName' => $lastname,
            'country' => $country,
            'birthday' => $birthday,
            'pwd' => $pwd,
        ]);
    } else {
        $_SESSION['errors'] = $errors;
    }
}


//USER AVATAR FORM

$userHair = $_GET['userHair'];

$userLeftEye = $_GET['userLeftEye'];

$userRightEye = $_GET['userRightEye'];

$userMouth = $_GET['userMouth'];

if (is_numeric($userHair) && is_numeric($userLeftEye) && is_numeric($userRightEye) && is_numeric($userMouth)) {


    $pdo = connectDB();
    $queryPrepared2 = $pdo->prepare("UPDATE AVATARS SET hair =:hair , leftEye = :leftEye, rightEye=:rightEye, mouth=:mouth WHERE userId= $userID");
    $queryPrepared2->execute([
        'hair' => $userHair,
        'leftEye' => $userLeftEye,
        'rightEye' => $userRightEye,
        'mouth' => $userMouth,
    ]);


    header('location: ./myProfile.php');
}

$errors[] = "Valeur invalide";
$_SESSION['errors'] = $errors;
header('location : ./index.php');
