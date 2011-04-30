var writeroot,
    testEl,
    testLayer,
    counter=0;

window.onload = function () {
    writeroot = document.getElementById('writeroot');
    testEl = document.getElementById('testEl');
    testLayer = document.getElementById('huge');
    document.getElementById('testButton').onclick = refreshTest;
    document.getElementById('stretch').onclick = stretchDiv;
    refreshTest();
    refreshTest(); //repeat so that the writeroot is filled with data at the moment its height is measured.
}

function refreshTest() {
    log('Iteration ' + counter);
    counter +=1;
    log('screen.width/height = ' + screen.width + ' / ' + screen.height); // + ' = ' + screen.width/screen.height);
    log('documentElement.offset = ' + document.documentElement.offsetWidth + ' / ' + document.documentElement.offsetHeight);
    log('documentElement.client = ' + document.documentElement.clientWidth + ' / ' + document.documentElement.clientHeight);
    log('documentElement.scroll = ' + document.documentElement.scrollLeft + ' / ' + document.documentElement.scrollTop);
    log('body.offset = ' + document.body.offsetWidth + ' / ' + document.body.offsetHeight);
    log('body.client = ' + document.body.clientWidth + ' / ' + document.body.clientHeight);
    log('writeroot.offset = ' + writeroot.offsetWidth + ' / ' + writeroot.offsetHeight);
    log('window.innerWidth/Height = ' + window.innerWidth + ' / ' + window.innerHeight);
    log('window.page = ' + window.pageXOffset+ ' / ' + window.pageYOffset);
    set();
}

var stretched = false;
function stretchDiv() {
    if (!stretched) {
        writeroot.style.width = '1500px';
        this.innerHTML = 'Release writeroot';
    } else {
        writeroot.style.width = '';
        this.innerHTML = 'Stretch writeroot';
    }
    stretched = !stretched;
}

var msgString = '';
function log(msg) {
    msgString += msg + "<br>";
}

function set() {
    writeroot.innerHTML = msgString;
    msgString = '';
}