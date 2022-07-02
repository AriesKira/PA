function getMessages() {

    url = window.location.href;
    splitedUrl = url.split("conv=");
    conv = splitedUrl[1];

    const request = new XMLHttpRequest();
    request.open('GET', './messagesHandler.php?conv=' + conv);
    request.onload = function() {
        const result = JSON.parse(request.responseText);
        const html = result.reverse().map(function(message) {
            return `
              <div class="message rem-25 px-3">
                <span class="date">${message.postDate.substr(11,16)}</span>
                <span class="author">${message.pseudo}</span> : 
                <span class="content">${message.texte}</span>
              </div>
            `
        }).join('');
        const messages = document.querySelector('.messages');
        messages.innerHTML = html;
        messages.scrollTop = messages.scrollHeight;
    }
    request.send();
}



function postMessage(event) {

    event.preventDefault();


    url = window.location.href;
    splitedUrl = url.split("conv=");
    conv = splitedUrl[1];


    const content = document.querySelector('#content-text');

    const data = new FormData();
    data.append('content-text', content.value);

    const request = new XMLHttpRequest();
    request.open('POST', './messagesHandler.php?conv=' + conv + '&task=write');

    request.onload = function() {
        content.value = '';
        content.focus();
        getMessages();
    }

    request.send(data);
}

document.getElementById('messageForm').addEventListener('submit', postMessage);

const interval = window.setInterval(getMessages, 3000);

getMessages();