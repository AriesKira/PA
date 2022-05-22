<?php include("stylesheet/template/header.php") ?>



<?php
if (isConnected("Admin")) {
?>

    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center">
                <button class="btn btn-info" id="add-btn">
                    <a href="addArticle.php">Ajouter un article</a>
                </button>
            </div>

        </div>

    </div>

<?php
}
?>


<div class="container">
    <div class="row articleNav">
        <div class="col-lg-5">
            <img src="../PA/stylesheet/images/articles/social-networks.png" alt="réseaux sociaux">
        </div>
        <div class="col-lg-7">
            <p>
            <h2 class="article-title"> Bien sécuriser ses réseaux sociaux </h2>
            Les réseaux sociaux sont l’un des principaux moyens d’obtenir des informations sur une cible.
            Que ce soit légalement avec l’OSINFO (à ne pas confondre avec l’OSINT),
            ou illégalement en obtenant des accès non autorisés à un ou plusieurs compte d’utilisateurs.
            Les méthodes d’authentifications à deux facteurs peuvent se révéler efficaces.
            Par contre, certaines sont à éviter. Aujourd’hui, nous tenons à vous présenter un outil qui vous
            permettra d’obtenir le meilleur niveau d’authentification.
            </p>
            <button type="button" class="btn btn-info">Lire l'article</button>
        </div>
    </div>
</div>




<?php include("stylesheet/template/footer.php") ?>