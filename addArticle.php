<?php include "../PA/stylesheet/template/header.php"; ?>

<div class="container">

    <div>
        <form method="POST" action="addArticle.php">
             Illustration de l'article
            <input type="file" class="form-control" name="article-illustration" required="required"><br>
            <input type="text" class="form-control" name="article-title" placeholder="Titre de l'article" required="required"><br>
            <input type="text" class="form-control" name="article-presentation" placeholder="Paragraphe de prÃ©sentation"><br>
            <input type="text" class="form-control" name="article-body" placeholder="Corps de l'article"><br>
            <input type="submit" class="btn btn-info" placeholder="Envoyer">
        </form>
    </div>

</div>

<?php include "../PA/stylesheet/template/footer.php"; ?>