//RETURN CURRENT VALUES
function getUserHair() {
    const hairButton = getHairDown();
    return hairButton.getAttribute('value');
}

function getUserLeftEye() {
    const eyeButton = getLeftEyeDown();
    return eyeButton.getAttribute('value');
}

function getUserRightEye() {
    const rightEyeButton = getRightEyeDown();
    return rightEyeButton.getAttribute('value');
}

function getUserMouth() {
    const mouthButton = getMouthDown();
    return mouthButton.getAttribute('value');
}




//Set vars
let userHair = parseInt(getUserHair());
let userLeftEye = parseInt(getUserLeftEye());
let userRightEye = parseInt(getUserRightEye());
let userMouth = parseInt(getUserMouth());


//HEAD
let avatarHead = new Image();
const avatarHeadSource = "./stylesheet/images/avatar_images/head.png";

avatarHead.src = avatarHeadSource;

//Hair
let avatarHair = new Image();
const avatarHairSource = './stylesheet/images/avatar_images/hair' + userHair + '.png';

avatarHair.src = avatarHairSource;

//EYES
let avatarLeftEye = new Image();
const avatarLeftEyeSource = './stylesheet/images/avatar_images/eye' + userLeftEye + '.png';

avatarLeftEye.src = avatarLeftEyeSource;

let avatarRightEye = new Image();
const avatarRightEyeSource = './stylesheet/images/avatar_images/eye' + userRightEye + '.png';

avatarRightEye.src = avatarRightEyeSource;

//MOUTH
let avatarMouth = new Image();
const avatarMouthSource = './stylesheet/images/avatar_images/mouth' + userMouth + '.png';

avatarMouth.src = avatarMouthSource;


function showUserAvatar() {

    // building


    avatarHead.onload = function() {
        buildAvatar();
    }
    avatarHair.onload = function() {
        buildAvatar();
    }
    avatarLeftEye.onload = function() {
        buildAvatar();
    }
    avatarRightEye.onload = function() {
        buildAvatar();
    }
    avatarMouth.onload = function() {
        buildAvatar();
    }

}

function buildAvatar() {
    const canvas = document.getElementById('avatarCanvas');
    const ctx = canvas.getContext('2d');

    ctx.clearRect(0, 0, 0, 0)
    canvas.width = 250;
    canvas.height = 250;

    ctx.drawImage(avatarHead, ((275 - canvas.width) / 2), 50);

    if (userHair == 1) {
        ctx.drawImage(avatarHair, 70, 0);
    }
    if (userHair == 2) {
        ctx.drawImage(avatarHair, 100, 50);
    }
    if (userHair == 3) {
        ctx.drawImage(avatarHair, 4.5, 10);
    }
    if (userHair == 4) {
        ctx.drawImage(avatarHair, 70, 40);
    }

    ctx.drawImage(avatarLeftEye, 75, 130);

    ctx.drawImage(avatarRightEye, 130, 130);

    ctx.drawImage(avatarMouth, 75, 170);

}