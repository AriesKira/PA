function getLoginPopUp() {
    return document.getElementById("loginBody");
}

function getRegisterPopUp() {
    return document.getElementById("registerBody");
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

function hideElement(element, hidden) {
    element.hidden = hidden;
    element.style.zIndex = hidden ? -1 : 100;

}