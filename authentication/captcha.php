<?php


// je veux afficher 4 images, 1 image réponse et 3 choix, l'utilisateur devra séléctioner l'image corespondante


$imageArray = [
    "captcha1.jpeg",
    "captcha2.jpeg",
    "captcha3.jpeg"
];


//returns random image from array
function returnImage($array)
{
    shuffle($array);
    return $array[0];
}

//here is our answer
$answerImage = returnImage($imageArray);

$displayAnswerImage = '<img src="/PA/stylesheet/images/captcha_images/' . $answerImage . '">';


shuffle($imageArray);
$choice1 = $imageArray[0];
$choice2 = $imageArray[1];
$choice3 = $imageArray[2];

$displayChoice1 = '<img src="/PA/stylesheet/images/captcha_images/' . $choice1 . '">';
$displayChoice2 = '<img src="/PA/stylesheet/images/captcha_images/' . $choice2 . '">';
$displayChoice3 = '<img src="/PA/stylesheet/images/captcha_images/' . $choice3 . '">';

echo '
<div class="container">
    <div class="row pt-5">
        <div class="col-2"></div>
        <div class="col-8 text-center">
            <p>Selectionner l\'image corespondante</p>
        </div>
        <div class="col-2"></div>
    </div>
    <div class="row justify-content-center pt-3">
        <div class="col"></div>
        <div class="col">
            ' . $displayAnswerImage . '
        </div>
        <div class="col"></div>
    </div>
    
    <div class="row pt-5">
        <div class="col-4"><button onclick="popUpCaptcha(); verifyCaptcha();" class="captchaAnswer">' . $displayChoice1 . '</button></div>
        <div class="col-4"><button class="captchaAnswer">' . $displayChoice2 . '</button></div>
        <div class="col-4"><button class="captchaAnswer">' . $displayChoice3 . '</button></div>
    </div>
    
</div>
';

function verifyCaptcha(){
    
}