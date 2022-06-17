<?php include("./stylesheet/template/header.php") ?>



<?php
	if (isConnected()&&(isAdmin($userID)||isWebmaster($userID))) {
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

<?php
    $pdo = connectDB();

            $queryPrepared = $pdo->prepare("SELECT * FROM AROOTS_ARTICLES");
            $queryPrepared->execute();
            $results = $queryPrepared->fetchAll();
?>



				
	<?php
	foreach ($results as $aroots_articles) {
		echo '


		<div class="article-div">
			<div class="article-image">
				<img src="'.$aroots_articles["picture"].'">
			</div>

			<div class="article-item">
				<h2 class="article-title col-lg-8">'.$aroots_articles["title"].' </h2>
				<p class="article-theme">'.$aroots_articles["theme"].' </p>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal"data-bs-target="#article-modal'.$aroots_articles["title"].' ">Lire l\'article</button>
				</button>
			</div>
		</div>
	

		<div class="modal fade container-fluid" id="article-modal'.$aroots_articles["title"].'" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content col-12">
                          <div class="modal-header">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>

                          <div class="modal-body">
						  	<h2 class="article-title col-lg-8">'.$aroots_articles["title"].' </h2>
						  	<p class="article-theme">'.$aroots_articles["texte"].' </p>
                          </div>

                          <div class="modal-footer">
                            <i class="bi bi-hand-thumbs-up"></i>
                            <i class="bi bi-hand-thumbs-down"></i>
                          </div>
                      </div>
                  </div>
              </div>

		';
	}
	?>

</div>