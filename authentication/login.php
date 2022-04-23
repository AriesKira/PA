

<div>
    <div class="container" >
        <div class="row pt-4" id="loginBorder">  
            <div class="col-md-6">
                <?php
                    echo "poulet";
                if (!empty($_POST['email']) &&  !empty($_POST['pwd']) && count($_POST) == 2) {

                    //Récupérer en bdd le mot de passe hashé pour l'email provenant du formulaire

                    $pdo = connectDB();
                    $queryPrepared = $pdo->prepare("SELECT * FROM aroots_user WHERE email=:email");
                    $queryPrepared->execute(["email" => $_POST['email']]);
                    $results = $queryPrepared->fetch();

                    if (!empty($results) && password_verify($_POST['pwd'], $results['pwd'])) {


                        $token = createToken();
                        updateToken($results["id"], $token);
                        //Insertion dans la session du token
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['id'] = $results["id"];
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