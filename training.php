<?php include "./stylesheet/template/header.php"; ?>


<?php if (!isConnected()) {

header("Location: ./index.php");
}
?>


<?php
    $devQuizList = glob("devquiz*.php");
    ?>


    <div class="container" id="trainingNav" data-aos="fade-up">
            <div class="row">
                <a href="rules.php">
                    <button class="btn btn-info" id="rules-btn">
                            Règlement
                    </button>
                </a>
            </div>

            <div class="row gy-4">
                <div class="col-lg-12 trainingItem" id="devop">
                    <div class="box">
                    <h3 class="trainingItemTitle"><a href="<?php echo $devQuizList[ array_rand($devQuizList)]; ?>">Développement</a></h3>
                    <p class="training-description">Testez vos conaissances en HTML / CSS, C, PHP, Javascript…</p>
                    </div>
                </div>

                <div class="col-lg-12 trainingItem" id="security">
                    <div class="box">
                    <h3 class="trainingItemTitle"><a href="securityQuiz.php">Sécurité</a></h3>
                    <p class="training-description">OSINT, Sécurisation d'appli web… De nombreux quiz vous sont proposés</p>
                    </div>
                </div>

                <div class="col-lg-12 trainingItem" id="other">
                    <div class="box">
                    <h3 class="trainingItemTitle"><a href="otherQuiz.php">Autres</a></h3>
                    <p class="training-description">D'autres QCM sur des domaines divers sont disponibles</p>
                    </div>
                </div>
            </div>
    </div>





<?php include "./stylesheet/template/footer.php"; ?>

