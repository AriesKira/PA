

    var numQues = 10;
    var numChoi = 3;



    function devquizOne(form) {

        var answers = new Array(10);
        answers[0] = "title";
        answers[1] = "Faux";
        answers[2] = "On utilise une balise html spéciale";
        answers[3] = "En utilisant le DOM";
        answers[4] = "Créer des sites responsives";
        answers[5] = "Dennis Ritchie";
        answers[6] = "Wikipédia";
        answers[7] = "ol et li";
        answers[8] = "msg('Hello World');";
        answers[9] = "Mettre en forme les éléments html d'une page.";

      var score = 0;
      var currElement;
      var currSelection;

      for (i=0; i<numQues; i++) {
        currElement = i*numChoi;
        for (j=0; j<numChoi; j++) {
          currSelection = form.elements[currElement + j];
          if (currSelection.checked) {
            if (currSelection.value == answers[i]) {
              score++;
              break;
                }
          }
        }
      }

      let viewScore = document.getElementById('scoreModal');
      viewScore.innerHTML = '<h5> Vous avez ' + score + '/10 </h5>';

      let scoreIncrement = document.getElementById('scoreIncrement');
      scoreIncrement.innerHTML = score;


      let finalScore = document.getElementById('scoreValidated');
      finalScore.innerHTML = '<input type="hidden" name="finalScore" value =" '+ score + ' ">';

    }

