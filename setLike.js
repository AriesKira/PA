function hasLikedJS(threadId) {
    const likeImage = getLikeImage(threadId);
    if (likeImage.getAttribute('src') == './stylesheet/images/logo/liked.png') {
        return true;
    } else {
        return false;
    }
}

function setLike(threadId, userId) {
    const likeCounter = document.getElementById("likeCounter_" + threadId);
    let count = parseInt(likeCounter.textContent)
    const likeImage = getLikeImage(threadId);
    const request = new XMLHttpRequest();
    request.onload = function() {
        if (hasLikedJS(threadId)) {
            likeImage.setAttribute('src', './stylesheet/images/logo/notLiked.png');
            likeCounter.textContent = count - 1;
        } else {
            likeImage.setAttribute('src', './stylesheet/images/logo/liked.png');
            likeCounter.textContent = count + 1;
        }

    }
    request.open('GET', './setLike.php?thread=' + threadId + '&userId=' + userId);

    request.send();
}

function setLikeComment(commentId, userId) {
    const likeCounter = document.getElementById("likeCounter_" + commentId);
    console.log(likeCounter);
    let count = parseInt(likeCounter.textContent);
    const likeImage = getLikeImage(commentId);
    const request = new XMLHttpRequest();
    request.onload = function() {

        if (hasLikedJS(commentId)) {
            likeImage.setAttribute('src', './stylesheet/images/logo/notLiked.png');
            likeCounter.textContent = count - 1;
        } else {
            likeImage.setAttribute('src', './stylesheet/images/logo/liked.png');
            likeCounter.textContent = count + 1;
        }

    }
    request.open('GET', './setLike.php?comment=' + commentId + '&userId=' + userId);

    request.send();
}