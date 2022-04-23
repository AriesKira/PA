function getLoginPopUp() {
    return document.getElementById("loginBody");
}

function getRegisterPopUp() {
    return document.getElementById("registerBody");
}


function popUpLogin() {
    const loginPopUp = getLoginPopUp();
    getRegisterPopUp().hidden = true;
    loginPopUp.hidden = !loginPopUp.hidden;
}

function popUpRegister() {
    const registerPopUp = getRegisterPopUp();
    getLoginPopUp().hidden = true;
    registerPopUp.hidden = !registerPopUp.hidden;

}