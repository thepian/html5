onmessage = function(event) {
    document.body.appendChild(document.createTextNode('worker message  '));
}

setInterval(function() {
    document.body.appendChild(document.createTextNode('worker tick  '));
}, 1000);