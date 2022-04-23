

<div>
    <div class="container" >
        <div class="row pt-4" id="loginBorder">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php

                if (!empty($_POST['email']) &&  !empty($_POST['pwd']) && count($_POST) == 2) {

                    //Récupérer en bdd le mot de passe hashé pour l'email provenant du formulaire

                    $pdo = connectDB();
                    $queryPrepared = $pdo->prepare("SELECT * FROM pa_user WHERE email_user=:email_user");
                    $queryPrepared->execute(["email" => $_POST['email']]);
                    $results = $queryPrepared->fetch();

                    if (!empty($results) && password_verify($_POST['pwd_user'], $results['pwd_user'])) {


                        $token = createToken();
                        updateToken($results["id"], $token);
                        //Insertion dans la session du token
                        $_SESSION['email_user'] = $_POST['email_user'];
                        $_SESSION['id_user'] = $results["id_user"];
                        $_SESSION['token'] = $token;
                        header("location: index.php");
                    } else {
                        echo "Identifiants incorrects";
                    }
                }

                ?>

                <form method="POST" action="">
                    <input type="email" class="form-control" name="email" placeholder="Votre email" required="required"><br>

                    <input type="password" class="form-control" name="pwd" placeholder="Votre mot de passe" required="required"><br>

                    <input type="submit" class="btn btn-primary mb-4" value="Se connecter">

                </form>
            </div>
        </div>
    </div>
</div>