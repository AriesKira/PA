function getLoginPopUp() {
    return document.getElementById("loginBody");
}

function getRegisterPopUp() {
    return document.getElementById("registerBody");
}

function getCaptchaPopUp() {
    return document.getElementById("captchaBody");
}

function getVideoBody() {
    return document.getElementById("animatedBackground");
}

function getPageIcons() {
    return document.getElementById("pageIconsSelection");
}

function popUpLogin() {
    const loginPopUp = getLoginPopUp();
    hideElement(getRegisterPopUp(), true);
    hideElement(loginPopUp, !loginPopUp.hidden);
}

function popUpRegister() {
    const registerPopUp = getRegisterPopUp();
    hideElement(getLoginPopUp(), true);
    hideElement(registerPopUp, !registerPopUp.hidden);

}

function popUpCaptcha() {
    const captchaPopUp = getCaptchaPopUp();
    hideElement(getRegisterPopUp(), true);
    hideElement(captchaPopUp, !captchaPopUp.hidden);
    fadeBackground(getVideoBody(), !getVideoBody().hidden);
    hideElement(getPageIcons(), !getPageIcons().hidden);
}

function hideElement(element, hidden) {
    element.hidden = hidden;
    element.style.zIndex = hidden ? -1 : 100;
}

function fadeBackground(element, hidden) {
    const fadedBackground = 'linear-gradient( rgba(0, 0, 0, 0.90), rgba(0, 0, 0, 0.90) )';
    const normalBackground = 'linear-gradient( rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) )';
    element.style.background = !hidden ? fadedBackground : normalBackground;
}