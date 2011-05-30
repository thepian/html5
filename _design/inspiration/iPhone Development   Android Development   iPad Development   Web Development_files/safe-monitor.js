var psi3T1sid = "xmLt2B1mz0f4";
// safe-monitor@gecko.js

var psi3T1iso;
try {
	psi3T1iso = (opener != null) && (typeof(opener.name) != "unknown") && (opener.psi3T1wid != null);
} catch(e) {
	psi3T1iso = false;
}
if (psi3T1iso) {
	window.psi3T1wid = opener.psi3T1wid + 1;
	psi3T1sid = psi3T1sid + "_" + window.psi3T1wid;
} else {
	window.psi3T1wid = 1;
}
function psi3T1n() {
	return (new Date()).getTime();
}
var psi3T1s = psi3T1n();
function psi3T1st(f, t) {
	if ((psi3T1n() - psi3T1s) < 7200000) {
		return setTimeout(f, t * 1000);
	} else {
		return null;
	}
}
var psi3T1il;
var psi3T1it;
function psi3T1pi() {
	var il;
	if (3 == 2) {
		il = window.pageXOffset + 50;
	} else if (3 == 3) {
		il = (window.innerWidth * 50 / 100) + window.pageXOffset;
	} else {
		il = 50;
	}
	il -= (271 / 2);
	var it;
	if (3 == 2) {
		it = window.pageYOffset + 50;
	} else if (3 == 3) {
		it = (window.innerHeight * 50 / 100) + window.pageYOffset;
	} else {
		it = 50;
	}
	it -= (191 / 2);
	if ((il != psi3T1il) || (it != psi3T1it)) {
		psi3T1il = il;
		psi3T1it = it;
		var d = document.getElementById('cii3T1');
		if (d != null) {
			d.style.left  = Math.round(psi3T1il) + "px";
			d.style.top  = Math.round(psi3T1it) + "px";
		}
	}
	setTimeout("psi3T1pi()", 100);
}
var psi3T1lc = 0;
function psi3T1si() {
	window.onscroll = psi3T1pi;
	window.onresize = psi3T1pi;
	psi3T1pi();
	psi3T1lc = 0;
	var url = "http://messenger.providesupport.com/invitation/sourcebits.html?ps_s=" + psi3T1sid + "&ps_t=" + psi3T1n() + "";
	var d = document.getElementById('cii3T1');
	if (d != null) {
		d.innerHTML = '<iframe allowtransparency="true" style="background:transparent;width=271;height=191" src="' + url + '" onload="psi3T1ld()" frameborder="no" width="271" height="191" scrolling="no"></iframe>';
	}
}
function psi3T1ld() {
	if (psi3T1lc == 1) {
		var d = document.getElementById('cii3T1');
		if (d != null) {
			d.innerHTML = "";
		}
	}
	psi3T1lc++;
}
if (false) {
	psi3T1si();
}
var psi3T1op = false;
function psi3T1co() {
	var w1 = psi3T1ci.width - 1;
	psi3T1scf((w1 & 2) != 0);
	var h = psi3T1ci.height;
	if (h != 2) {
		psi3T1op = false;
	} else if ((h == 2) && (!psi3T1op)) {
		psi3T1op = true;
		psi3T1si();
	}
}
var psi3T1ci = new Image();
psi3T1ci.onload = psi3T1co;
var psi3T1pm = false;
var psi3T1cp = psi3T1pm ? 30 : 60;
var psi3T1ct = null;
function psi3T1scf(p) {
	if (psi3T1pm != p) {
		psi3T1pm = p;
		psi3T1cp = psi3T1pm ? 30 : 60;
		if (psi3T1ct != null) {
			clearTimeout(psi3T1ct);
			psi3T1ct = null;
		}
		psi3T1ct = psi3T1st("psi3T1rc()", psi3T1cp);
	}
}
function psi3T1rc() {
	psi3T1ct = psi3T1st("psi3T1rc()", psi3T1cp);
	try {
		psi3T1ci.src = "http://image.providesupport.com/cmd/sourcebits?" + "ps_t=" + psi3T1n() + "&ps_l=" + escape(document.location) + "&ps_r=" + escape(document.referrer) + "&ps_s=" + psi3T1sid + "" + "";
	} catch(e) {
	}
}
psi3T1rc();


