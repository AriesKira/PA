function getBurgerPopUp1() {

}

function burgerPopUp1() {
    const burgerPopUp = getBurgerPopUp1();
    hideElement(burgerPopUp, !burgerPopUp.hidden);
    console.log('poulet');
}


function hideElement(element, hidden) {
    element.hidden = hidden;
    element.style.zIndex = hidden ? -1 : 100;
}