<?php include './stylesheet/template/header.php'; ?>


<?php if (!isConnected()) {

header("Location: ./index.php");
}
?>



<div class="container" id="quizForm">


    <h3 id="quizTitle"> Sélectionnez la bonne réponse</h3>

    <p id="quizLevel">
      Difficulté : Facile |
      Chaque question vaut 1 point
    </p>

    <form name="devquiz1" method="POST" action="myProfile.php">
        <div class="quizItem">
          <h4>1. Quelle balise utilisera-t-on de préférence pour le titre principal d'une page html ?</h4>
          <input type="radio" name="q1" value="h1"> h1<br>
          <input type="radio" name="q1" value="title"> title<br>
          <input type="radio" name="q1" value="head"> head<br>
        </div>

        <div class="quizItem">
          <h4>2. Utiliser la balise h1 signifie que l'on veut que le titre apparaisse plus gros que si l'on utilisait la balise h2 :</h4>
          <input type="radio" name="q2" value="Vrai"> Vrai<br>
          <input type="radio" name="q2" value="Faux"> Faux<br>
          <input type="radio" name="q2" value="Faux"> Tout dépend de sa position dans la page<br>
        </div>

        <div class="quizItem">
          <h4>3. Pour mettre en gras une partie de texte dans une page html:</h4>
          <input type="radio" name="q3" value="On utilise une balise html spéciale"> On utilise une balise html spéciale <br>
          <input type="radio" name="q3" value="On utilise une propriété css"> on utilise une propriété css<br>
          <input type="radio" name="q3" value="on doit obligatoirement le faire avec du javascript"> on doit obligatoirement le faire avec du javascript<br>
        </div>


        <div class="quizItem">
          <h4>4. En javascript, on peut écrire du contenu HTML</h4>
          <input type="radio" name="q4" value="En utilisant le DOM"> En utilisant le DOM <br>
          <input type="radio" name="q4" value="Avec des API Web"> Avec des API Web <br>
          <input type="radio" name="q4" value="Ce n'est pas possible"> Ce n'est pas possible <br>
        </div>


        <div class="quizItem">
          <h4>5. Le langage PHP sert à </h4>
          <input type="radio" name="q5" value="Créer des sites responsives"> Créer des sites responsives<br>
          <input type="radio" name="q5" value="Créer des sites dynamiques"> Créer des sites dynamiques<br>
          <input type="radio" name="q5" value="Créer des sites statiques"> Créer des sites statiques<br>
        </div>

          
        <div class="quizItem">
          <h4>6. Dans la balise &lt;a&gt;, pour créer un lien vers une page, on utilise</h4>
          <input type="radio" name="q6" value="href"> href <br>
          <input type="radio" name="q6" value="target"> target <br>
          <input type="radio" name="q6" value="link"> link <br>
        </div>


        <div class="quizItem">
          <h4>7. Qui est le créateur du langage C ? </h4>
          <input type="radio" name="q7" value="Dennis Ritchie">Dennis Ritchie<br>
          <input type="radio" name="q7" value="Linus Torvalds">Linus Torvalds<br>
          <input type="radio" name="q7" value="Alan Turing">Alan Turing<br>
        </div>



        <div>
          <h4>8. Quels éléments sont nécessaires pour créer une liste dont les items ne sont pas numérotés ?</h4>
          <input type="radio" name="q8" value="ul et li">ul et li<br>
          <input type="radio" name="q8" value="ol et li">ol et li<br>
          <input type="radio" name="q8" value="ul et ol">ul et ol<br>
        </div>


        <div>
          <h4>9. En Javascript, comment écrit-on "Hello wolrd" dans une boîte d'alerte ?</h4>
          <input type="radio" name="q9" value="alert('Hello World');"> alert('Hello World'); <br>
          <input type="radio" name="q9" value="msg('Hello World');"> msg('Hello World'); <br>
          <input type="radio" name="q9" value="alertBox('Hello World');"> alertBox('Hello World');<br>
        </div>


        <div>
          <h4>10. Le rôle du CSS est de:</h4>
          <input type="radio" name="q10" value="Mettre en forme les éléments html d'une page">Mettre en forme les éléments html d'une page.<br>
          <input type="radio" name="q10" value="Définir des formulaires.">Définir des formulaires.<br>
          <input type="radio" name="q10" value="Créer des sites responsive">Créer des sites responsive<br>
        </div>


          <input type="button" class="btn btn-primary" value="Score" id="quizValidation"
            onClick="devquizOne(this.form)" data-bs-toggle="modal" data-bs-target="#scoreResult">
            


            <div class="modal" id="scoreResult" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content col-12">

                <div class="modal-body" id="scoreModal">
                    
                </div>

                <div class="modal-footer">
                <h5>Votre score est de <span id="scoreIncrement" name="finalScore" required="required"> </span>  points</h5><br>
                <p id="scoreValidated"></p>
                
                <a href="myProfile.php">
                  <button type="submit" class="btn btn-info" data-bs-dismiss="modal" aria-label="Close">OK</button>
                </a>

                </div>
              </div>
          </div>
    </div>


    <div id="modalScore">
  
    </div>

    </form>

	










</div>


<script src="quiz.js"></script>
