<?php include("stylesheet/template/header.php") ?>



<?php
if (isConnected()) {
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



<table class="table" id="articles-table">
			<thead>
				<tr>
					<th>Auteur</th>
					<th>Titre</th>
					<th>Texte</th>
				</tr>
			</thead>

			<tbody>
				
				<?php
				foreach ($results as $aroots_articles) {
					echo
						'<div id="articles-nav">
								<tr>
									<td>'.$aroots_articles["author"].'</td>
									<td>'.$aroots_articles["title"].'</td>
									<td>'.$aroots_articles["theme"].'</td>
									<td>'.$aroots_articles["texte"].'</td>
									<td>'.$aroots_articles["picture"].'</td>
										<div class="btn-group">
										</div>
									</td>
								</tr>
						</div>'
						;
				}
				?>

									

			</tbody>
		</table>




<?php include("stylesheet/template/footer.php") ?>