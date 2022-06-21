<?php include "./stylesheet/template/header.php"; ?>

<div class="container">
    <div class="row mt-4">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="POST" action="./newArticle.php" enctype="multipart/form-data">

                <input type="text" class="form-control" name="title" placeholder="Titre de l'article" require="required"><br>
                <input type="text" class="form-control" name="theme" placeholder="Thème de l'article" required="required"><br>
                <textarea type="text" class="form-control" name="texte" placeholder="Corps de l'article" required="required">
                </textarea><br>

                <input type="file" class="form-control" id="picture" name="picture" />
                <input type="submit" class="btn btn-outline-dark mb-4 mt-4 submitButton" value="Mettre en ligne">
            </form>
        </div>
    </div>
</div>

<?php include "./stylesheet/template/footer.php"; ?>

