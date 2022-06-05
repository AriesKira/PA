<div class="container-fluid">
    <div class="row">
        <div class="col-7 text-center">

            <form id="userInformationForm" method="post" action="./updateUserProfile.php">
                <input type="text" class="form-control" name="firstname" value="<?php echo '' . $results['firstName'] . ''; ?>"><br>
                <input type="text" class="form-control" name="lastname" value="<?php echo '' . $results['lastName'] . ''; ?>"><br>
                <?php
                if (!isValidated($results['idUser'])) {
                    echo '
                <input type="email" class="form-control" name="email" value="' . $results['email'] . '"><br>
            ';
                }
                ?>
                <input type="date" class="form-control" name="birthday" value="<?php echo '' . $results['birthday'] . ''; ?>"><br>
                <input type="password" class="form-control" name="password" placeholder="Entrez mot de passe(actuel ou nouveau)" value=""><br>
                <input type="password" class="form-control" name="passwordConfirm" placeholder="Confirmer votre mot de passe" value=""><br>
                <select name="country" class="form-control"><br>
                    <option value="fr">France</option>
                    <option value="pl">Pologne</option>
                    <option value="ml">Mali</option>
                </select>
                <input type="submit" class="btn btn-primary mt-3" value="Modifier" onclick="submitUserForms()">
            </form>
        </div>
        <div class="col-5 text-center">
            <form id="userAvatarForm" method="GET" action="./updateUserProfile.php">
                <input id="userHair" type="hidden" form="userAvatarForm" name="userHair" value='<?php echo $userHair ?>'>
                <input id="userLeftEye" type="hidden" form="userAvatarForm" name="userLeftEye" value='<?php echo $userLeftEye ?>'>
                <input id="userRightEye" type="hidden" form="userAvatarForm" name="userRightEye" value='<?php echo $userRightEye ?>'>
                <input id="userMouth" type="hidden" form="userAvatarForm" name="userMouth" value='<?php echo $userMouth ?>'>
                <input id="formValue" type="hidden" form="userAvatarForm" name="form" value="2">
                <div class="row pt-3">
                    <div class="row pt-3">
                        <div class="col-2">
                            <input id="hairDown" type="button" class="btn btn-outline-light" value="<?php echo $userHair ?>" onclick="hairDecrement()"></input>
                        </div>
                        <div class="col-8">
                            <h4 style="color: white;">Cheveux</h4>
                        </div>
                        <div class="col-2">
                            <input id="hairUp" type="button" class="btn btn-outline-light" value="<?php echo $userHair ?>" onclick="hairIncrement()"></input>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-2">
                            <input id="leftEyeDown" type="button" class="btn btn-outline-light" value="<?php echo $userLeftEye ?>" onclick="leftEyeDecrement()"></input>
                        </div>
                        <div class="col-8">
                            <h4 style="color: white;">Oeuil gauche</h4>
                        </div>
                        <div class="col-2">
                            <input id="leftEyeUp" type="button" class="btn btn-outline-light" value="<?php echo $userLeftEye ?>" onclick="leftEyeIncrement()"></input>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-2">
                            <input id="rightEyeDown" type="button" class="btn btn-outline-light" value="<?php echo $userRightEye ?>" onclick="rightEyeDecrement()"></input>
                        </div>
                        <div class="col-8">
                            <h4 style="color: white;">Oeuil droit</h4>
                        </div>
                        <div class="col-2">
                            <input id="rightEyeUp" type="button" class="btn btn-outline-light" value="<?php echo $userRightEye ?>" onclick="rightEyeIncrement()"></input>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-2">
                            <input id="mouthDown" type="button" class="btn btn-outline-light" value="<?php echo $userMouth ?>" onclick="mouthDecrement()"></input>
                        </div>
                        <div class="col-8">
                            <h4 style="color: white;">Bouche</h4>
                        </div>
                        <div class="col-2">
                            <input id="mouthUp" type="button" class="btn btn-outline-light" value="<?php echo $userMouth ?>" onclick="mouthIncrement()"></input>
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" class="btn btn-primary mt-3" value="Enregistrer l'avatar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>