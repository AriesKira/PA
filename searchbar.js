function searchResponse(userStr) {
    if (userStr.length == 0) {
        getSearchResultSpace().innerHTML = "";
        return -1;
    } else {
        const request = new XMLHttpRequest();
        request.onload = function() {
            getSearchResultSpace().innerHTML = this.responseText;
        }
        request.open("GET", "./searchResult.php?uSearch=" + userStr, true);
        request.send();
    };

}