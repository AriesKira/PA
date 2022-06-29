function validate(userId) {
    const request = new XMLHttpRequest();
    request.onload = function() {
        location.reload();
    }
    request.open("GET", "./adminMod.php?validate=1&user=" + userId);
    request.send();
}

function deleteUser(userId) {
    const request = new XMLHttpRequest();
    request.onload = function() {
        location.reload();
    }
    request.open("GET", "./adminMod.php?delete=1&user=" + userId);
    request.send();
}

function setNormal(userId) {
    const request = new XMLHttpRequest();
    request.onload = function() {
        location.reload();
    }
    request.open("GET", "./adminMod.php?set=1&user=" + userId);
    request.send();
}

function setWebmaster(userId) {
    const request = new XMLHttpRequest();
    request.onload = function() {
        location.reload();
    }
    request.open("GET", "./adminMod.php?set=2&user=" + userId);
    request.send();
}

function setAdmin(userId) {
    const request = new XMLHttpRequest();
    request.onload = function() {
        location.reload();
    }
    request.open("GET", "./adminMod.php?set=3&user=" + userId);
    request.send();
}