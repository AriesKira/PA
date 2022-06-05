function hairDecrement() {
    const hairMinus = getHairDown();
    if (userHair == 1) {
        userHair = 4;

        const avatarHairSource = './stylesheet/images/avatar_images/hair' + userHair + '.png';
        avatarHair.src = avatarHairSource;

        hairMinus.setAttribute('value', '' + userHair + '');
        getUserHairFormValue().setAttribute('value', '' + userHair + '');

        buildAvatar();
    } else {
        userHair = userHair - 1;

        const avatarHairSource = './stylesheet/images/avatar_images/hair' + userHair + '.png';
        avatarHair.src = avatarHairSource;

        hairMinus.setAttribute('value', '' + userHair + '');
        getUserHairFormValue().setAttribute('value', '' + userHair + '');

        buildAvatar();
    }
}

function hairIncrement() {
    const hairPlus = getHairUp();
    if (userHair == 4) {
        userHair = 1;

        const avatarHairSource = './stylesheet/images/avatar_images/hair' + userHair + '.png';
        avatarHair.src = avatarHairSource;

        hairPlus.setAttribute('value', '' + userHair + '');
        getUserHairFormValue().setAttribute('value', '' + userHair + '');

        buildAvatar();
    } else {
        userHair = userHair + 1;

        const avatarHairSource = './stylesheet/images/avatar_images/hair' + userHair + '.png';
        avatarHair.src = avatarHairSource;

        hairPlus.setAttribute('value', '' + userHair + '');
        getUserHairFormValue().setAttribute('value', '' + userHair + '');

        buildAvatar();
    }
}

function leftEyeDecrement() {
    const leftEyeMinus = getLeftEyeDown();

    if (userLeftEye == 1) {
        userLeftEye = 8;

        const avatarLeftEyeSource = './stylesheet/images/avatar_images/eye' + userLeftEye + '.png';
        avatarLeftEye.src = avatarLeftEyeSource;

        leftEyeMinus.setAttribute('value', '' + userLeftEye + '');
        getUserLeftEyeFormValue().setAttribute('value', '' + userLeftEye + '');

        buildAvatar();
    } else {
        userLeftEye = userLeftEye - 1;

        const avatarLeftEyeSource = './stylesheet/images/avatar_images/eye' + userLeftEye + '.png';
        avatarLeftEye.src = avatarLeftEyeSource;

        leftEyeMinus.setAttribute('value', '' + userLeftEye + '');
        getUserLeftEyeFormValue().setAttribute('value', '' + userLeftEye + '');

        buildAvatar();
    }
}

function leftEyeIncrement() {
    const leftEyePlus = getLeftEyeUp();

    if (userLeftEye == 8) {
        userLeftEye = 1;

        const avatarLeftEyeSource = './stylesheet/images/avatar_images/eye' + userLeftEye + '.png';
        avatarLeftEye.src = avatarLeftEyeSource;

        leftEyePlus.setAttribute('value', '' + userLeftEye + '');
        getUserLeftEyeFormValue().setAttribute('value', '' + userLeftEye + '');

        buildAvatar();
    } else {
        userLeftEye = userLeftEye + 1;

        const avatarLeftEyeSource = './stylesheet/images/avatar_images/eye' + userLeftEye + '.png';
        avatarLeftEye.src = avatarLeftEyeSource;

        leftEyePlus.setAttribute('value', '' + userLeftEye + '');
        getUserLeftEyeFormValue().setAttribute('value', '' + userLeftEye + '');

        buildAvatar();
    }
}

function rightEyeDecrement() {
    const rightEyeMinus = getRightEyeDown();

    if (userRightEye == 1) {
        userRightEye = 8;

        const avatarRightEyeSource = './stylesheet/images/avatar_images/eye' + userRightEye + '.png';
        avatarRightEye.src = avatarRightEyeSource;

        rightEyeMinus.setAttribute('value', '' + userRightEye + '');
        getUserRightEyeFormValue().setAttribute('value', '' + userRightEye + '');

        buildAvatar();
    } else {
        userRightEye = userRightEye - 1;

        const avatarRightEyeSource = './stylesheet/images/avatar_images/eye' + userRightEye + '.png';
        avatarRightEye.src = avatarRightEyeSource;

        rightEyeMinus.setAttribute('value', '' + userRightEye + '');
        getUserRightEyeFormValue().setAttribute('value', '' + userRightEye + '');

        buildAvatar();
    }
}

function rightEyeIncrement() {
    const rightEyePlus = getRightEyeUp();

    if (userRightEye == 8) {
        userRightEye = 1;

        const avatarRightEyeSource = './stylesheet/images/avatar_images/eye' + userRightEye + '.png';
        avatarRightEye.src = avatarRightEyeSource;

        rightEyePlus.setAttribute('value', '' + userRightEye + '');
        getUserRightEyeFormValue().setAttribute('value', '' + userRightEye + '');

        buildAvatar();
    } else {
        userRightEye = userRightEye + 1;

        const avatarRightEyeSource = './stylesheet/images/avatar_images/eye' + userRightEye + '.png';
        avatarRightEye.src = avatarRightEyeSource;

        rightEyePlus.setAttribute('value', '' + userRightEye + '');
        getUserRightEyeFormValue().setAttribute('value', '' + userRightEye + '');

        buildAvatar();
    }
}

function mouthDecrement() {
    const mouthMinus = getMouthDown();

    if (userMouth == 1) {
        userMouth = 6;

        const avatarMouthSource = './stylesheet/images/avatar_images/mouth' + userMouth + '.png';
        avatarMouth.src = avatarMouthSource;

        mouthMinus.setAttribute('value', '' + userMouth + '');
        getUserMouthFormValue().setAttribute('value', '' + userMouth + '');

        buildAvatar();
    } else {
        userMouth = userMouth - 1;

        const avatarMouthSource = './stylesheet/images/avatar_images/mouth' + userMouth + '.png';
        avatarMouth.src = avatarMouthSource;

        mouthMinus.setAttribute('value', '' + userMouth + '');
        getUserMouthFormValue().setAttribute('value', '' + userMouth + '');

        buildAvatar();
    }
}

function mouthIncrement() {
    const mouthPlus = getMouthUp();

    if (userMouth == 6) {
        userMouth = 1;

        const avatarMouthSource = './stylesheet/images/avatar_images/mouth' + userMouth + '.png';
        avatarMouth.src = avatarMouthSource;

        mouthPlus.setAttribute('value', '' + userMouth + '');
        getUserMouthFormValue().setAttribute('value', '' + userMouth + '');

        buildAvatar();
    } else {
        userMouth = userMouth + 1;

        const avatarMouthSource = './stylesheet/images/avatar_images/mouth' + userMouth + '.png';
        avatarMouth.src = avatarMouthSource;

        mouthPlus.setAttribute('value', '' + userMouth + '');
        getUserMouthFormValue().setAttribute('value', '' + userMouth + '');

        buildAvatar();
    }

}

function submitUserForms() {
    const avatarForm = getUserAvatarForm();
    const userInfoForm = getUserInfoForm();

    avatarForm.setAttribute('action', './updateUserProfile.php?userHair=' + userHair + '&userLeftEye=' + userLeftEye + '&userRightEye=' + userRightEye + '&userMouth=' + userMouth + '&form=1');
    userInfoForm.setAttribute('action', './updateUserProfile.php?userHair=' + userHair + '&userLeftEye=' + userLeftEye + '&userRightEye=' + userRightEye + '&userMouth=' + userMouth + '&form=1');

    avatarForm.submit();
    userInfoForm.submit();
}