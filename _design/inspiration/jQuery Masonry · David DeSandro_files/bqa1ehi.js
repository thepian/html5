/*{"mac":"1:4ef948fc3bbf731cdde0d09f058a98538d7fd256cc9a4f1c5de06a20e4693ac8","created":"2011-03-29T17:10:04Z","version":"3441862","k":"0.9.0"}*/
; (function(window, document, undefined) {
    var i = true,
    k = null,
    p = false;
    function r(a) {
        return function(c) {
            this[a] = c
        }
    }
    function s(a) {
        return function() {
            return this[a]
        }
    }
    var t;
    function u(a, c) {
        var b = arguments.length > 2 ? Array.prototype.slice.call(arguments, 2) : [];
        return function() {
            b.push.apply(b, arguments);
            return c.apply(a, b)
        }
    }
    function v(a, c) {
        this.p = a;
        this.i = c
    }
    t = v.prototype;
    t.createElement = function(a, c, b) {
        a = this.p.createElement(a);
        if (c) for (var d in c) if (c.hasOwnProperty(d)) if (d == "style" && this.i.getName() == "MSIE") a.style.cssText = c[d];
        else a.setAttribute(d, c[d]);
        b && a.appendChild(this.p.createTextNode(b));
        return a
    };
    t.insertInto = function(a, c) {
        var b = this.p.getElementsByTagName(a)[0];
        if (!b) b = document.documentElement;
        if (b && b.lastChild) {
            b.insertBefore(c, b.lastChild);
            return i
        }
        return p
    };
    t.whenBodyExists = function(a) {
        function c() {
            document.body ? a() : setTimeout(c, 0)
        }
        c()
    };
    t.removeElement = function(a) {
        if (a.parentNode) {
            a.parentNode.removeChild(a);
            return i
        }
        return p
    };
    t.createCssLink = function(a) {
        return this.createElement("link", {
            rel: "stylesheet",
            href: a
        })
    };
    t.appendClassName = function(a, c) {
        for (var b = a.className.split(/\s+/), d = 0, e = b.length; d < e; d++) if (b[d] == c) return;
        b.push(c);
        a.className = b.join(" ").replace(/^\s+/, "")
    };
    t.removeClassName = function(a, c) {
        for (var b = a.className.split(/\s+/), d = [], e = 0, f = b.length; e < f; e++) b[e] != c && d.push(b[e]);
        a.className = d.join(" ").replace(/^\s+/, "").replace(/\s+$/, "")
    };
    t.hasClassName = function(a, c) {
        for (var b = a.className.split(/\s+/), d = 0, e = b.length; d < e; d++) if (b[d] == c) return i;
        return p
    };
    function w(a, c, b, d, e, f, j, g) {
        this.O = a;
        this.Ma = c;
        this.sa = b;
        this.ra = d;
        this.Fa = e;
        this.Ea = f;
        this.qa = j;
        this.Oa = g
    }
    t = w.prototype;
    t.getName = s("O");
    t.getVersion = s("Ma");
    t.getEngine = s("sa");
    t.getEngineVersion = s("ra");
    t.getPlatform = s("Fa");
    t.getPlatformVersion = s("Ea");
    t.getDocumentMode = s("qa");
    function x(a, c) {
        this.i = a;
        this.u = c
    }
    var aa = new w("Unknown", "Unknown", "Unknown", "Unknown", "Unknown", "Unknown", undefined, p);
    x.prototype.parse = function() {
        var a;
        if (this.i.indexOf("MSIE") != -1) {
            a = y(this, this.i, /(MSIE [\d\w\.]+)/, 1);
            if (a != "") {
                var c = a.split(" ");
                a = c[0];
                c = c[1];
                a = new w(a, c, a, c, z(this), A(this), B(this, this.u), C(this, c) >= 6)
            } else a = new w("MSIE", "Unknown", "MSIE", "Unknown", z(this), A(this), B(this, this.u), p)
        } else {
            if (this.i.indexOf("Opera") != -1) a: {
                c = a = "Unknown";
                var b = y(this, this.i, /(Presto\/[\d\w\.]+)/, 1);
                if (b != "") {
                    c = b.split("/");
                    a = c[0];
                    c = c[1]
                } else {
                    if (this.i.indexOf("Gecko") != -1) a = "Gecko";
                    b = y(this, this.i, /rv:([^\)]+)/,
                    1);
                    if (b != "") c = b
                }
                if (this.i.indexOf("Version/") != -1) {
                    b = y(this, this.i, /Version\/([\d\.]+)/, 1);
                    if (b != "") {
                        a = new w("Opera", b, a, c, z(this), A(this), B(this, this.u), C(this, b) >= 10);
                        break a
                    }
                }
                b = y(this, this.i, /Opera[\/ ]([\d\.]+)/, 1);
                a = b != "" ? new w("Opera", b, a, c, z(this), A(this), B(this, this.u), C(this, b) >= 10) : new w("Opera", "Unknown", a, c, z(this), A(this), B(this, this.u), p)
            } else {
                if (this.i.indexOf("AppleWebKit") != -1) {
                    a = z(this);
                    c = A(this);
                    b = y(this, this.i, /AppleWebKit\/([\d\.]+)/, 1);
                    if (b == "") b = "Unknown";
                    var d = "Unknown";
                    if (this.i.indexOf("Chrome") != -1) d = "Chrome";
                    else if (this.i.indexOf("Safari") != -1) d = "Safari";
                    else if (this.i.indexOf("AdobeAIR") != -1) d = "AdobeAIR";
                    var e = "Unknown";
                    if (this.i.indexOf("Version/") != -1) e = y(this, this.i, /Version\/([\d\.\w]+)/, 1);
                    else if (d == "Chrome") e = y(this, this.i, /Chrome\/([\d\.]+)/, 1);
                    else if (d == "AdobeAIR") e = y(this, this.i, /AdobeAIR\/([\d\.]+)/, 1);
                    var f = p;
                    if (d == "AdobeAIR") {
                        f = y(this, e, /\d+\.(\d+)/, 1);
                        f = C(this, e) > 2 || C(this, e) == 2 && parseInt(f, 10) >= 5
                    } else {
                        f = y(this, b, /\d+\.(\d+)/, 1);
                        f = C(this, b) >=
                        526 || C(this, b) >= 525 && parseInt(f, 10) >= 13
                    }
                    a = new w(d, e, "AppleWebKit", b, a, c, B(this, this.u), f)
                } else {
                    if (this.i.indexOf("Gecko") != -1) {
                        c = a = "Unknown";
                        d = p;
                        if (this.i.indexOf("Firefox") != -1) {
                            a = "Firefox";
                            b = y(this, this.i, /Firefox\/([\d\w\.]+)/, 1);
                            if (b != "") {
                                d = y(this, b, /\d+\.(\d+)/, 1);
                                c = b;
                                d = b != "" && C(this, b) >= 3 && parseInt(d, 10) >= 5
                            }
                        } else if (this.i.indexOf("Mozilla") != -1) a = "Mozilla";
                        b = y(this, this.i, /rv:([^\)]+)/, 1);
                        if (b == "") b = "Unknown";
                        else if (!d) {
                            d = C(this, b);
                            e = parseInt(y(this, b, /\d+\.(\d+)/, 1), 10);
                            f = parseInt(y(this,
                            b, /\d+\.\d+\.(\d+)/, 1), 10);
                            d = d > 1 || d == 1 && e > 9 || d == 1 && e == 9 && f >= 2 || b.match(/1\.9\.1b[123]/) != k || b.match(/1\.9\.1\.[\d\.]+/) != k
                        }
                        a = new w(a, c, "Gecko", b, z(this), A(this), B(this, this.u), d)
                    } else a = aa;
                    a = a
                }
                a = a
            }
            a = a
        }
        return a
    };
    function z(a) {
        var c = y(a, a.i, /(iPod|iPad|iPhone|Android)/, 1);
        if (c != "") return c;
        a = y(a, a.i, /(Linux|Mac_PowerPC|Macintosh|Windows)/, 1);
        if (a != "") {
            if (a == "Mac_PowerPC") a = "Macintosh";
            return a
        }
        return "Unknown"
    }
    function A(a) {
        var c = y(a, a.i, /(OS X|Windows NT|Android) ([^;)]+)/, 2);
        if (c) return c;
        if (c = y(a, a.i, /(iPhone )?OS ([\d_]+)/, 2)) return c;
        if (a = y(a, a.i, /Linux ([i\d]+)/, 1)) return a;
        return "Unknown"
    }
    function C(a, c) {
        var b = y(a, c, /(\d+)/, 1);
        if (b != "") return parseInt(b, 10);
        return - 1
    }
    function y(a, c, b, d) {
        if ((a = c.match(b)) && a[d]) return a[d];
        return ""
    }
    function B(a, c) {
        if (c.documentMode) return c.documentMode
    }
    function ba(a, c, b, d) {
        this.f = a;
        this.j = c;
        this.R = b;
        this.n = d || "wf";
        this.l = new D("-")
    }
    function E(a) {
        a.f.removeClassName(a.j, a.l.k(a.n, "loading"));
        a.f.hasClassName(a.j, a.l.k(a.n, "active")) || a.f.appendClassName(a.j, a.l.k(a.n, "inactive"));
        F(a, "inactive")
    }
    function F(a, c, b, d) {
        a.R[c] && a.R[c](b, d)
    }
    function G(a, c, b, d, e) {
        this.f = a;
        this.w = c;
        this.z = b;
        this.s = d;
        this.L = e;
        this.U = 0;
        this.ma = this.ca = p
    }
    G.prototype.watch = function(a, c, b, d) {
        for (var e = a.length, f = 0; f < e; f++) {
            var j = a[f];
            c[j] || (c[j] = ["n4"]);
            this.U += c[j].length
        }
        if (d) this.ca = d;
        for (f = 0; f < e; f++) {
            j = a[f];
            d = c[j];
            for (var g = b[j], h = 0, o = d.length; h < o; h++) {
                var m = d[h],
                q = this.w,
                l = j,
                n = m;
                q.f.appendClassName(q.j, q.l.k(q.n, l, n, "loading"));
                F(q, "fontloading", l, n);
                q = u(this, this.ta);
                l = u(this, this.ua);
                new I(q, l, this.f, this.z, this.s, this.L, j, m, g)
            }
        }
    };
    G.prototype.ta = function(a, c) {
        var b = this.w;
        b.f.removeClassName(b.j, b.l.k(b.n, a, c, "loading"));
        b.f.removeClassName(b.j, b.l.k(b.n, a, c, "inactive"));
        b.f.appendClassName(b.j, b.l.k(b.n, a, c, "active"));
        F(b, "fontactive", a, c);
        this.ma = i;
        J(this)
    };
    G.prototype.ua = function(a, c) {
        var b = this.w;
        b.f.removeClassName(b.j, b.l.k(b.n, a, c, "loading"));
        b.f.hasClassName(b.j, b.l.k(b.n, a, c, "active")) || b.f.appendClassName(b.j, b.l.k(b.n, a, c, "inactive"));
        F(b, "fontinactive", a, c);
        J(this)
    };
    function J(a) {
        if (--a.U == 0 && a.ca) if (a.ma) {
            a = a.w;
            a.f.removeClassName(a.j, a.l.k(a.n, "loading"));
            a.f.removeClassName(a.j, a.l.k(a.n, "inactive"));
            a.f.appendClassName(a.j, a.l.k(a.n, "active"));
            F(a, "active")
        } else E(a.w)
    }
    function I(a, c, b, d, e, f, j, g, h) {
        this.oa = a;
        this.xa = c;
        this.f = b;
        this.z = d;
        this.s = e;
        this.L = f;
        this.Ba = new K;
        this.wa = new ca;
        this.X = j;
        this.W = g;
        this.va = h || "BESs";
        this.Ca = da(this, "arial,'URW Gothic L',sans-serif");
        this.Da = da(this, "Georgia,'Century Schoolbook L',serif");
        this.ia = L(this, "arial,'URW Gothic L',sans-serif");
        this.ja = L(this, "Georgia,'Century Schoolbook L',serif");
        this.Ka = f();
        this.S()
    }
    I.prototype.S = function() {
        var a = this.z.M(this.ja);
        if (this.Ca != this.z.M(this.ia) || this.Da != a) ea(this, this.oa);
        else this.L() - this.Ka < 5E3 ? fa(this) : ea(this, this.xa)
    };
    function fa(a) {
        a.s(function(c, b) {
            return function() {
                b.call(c)
            }
        } (a, a.S), 50)
    }
    function ea(a, c) {
        a.f.removeElement(a.ia);
        a.f.removeElement(a.ja);
        c(a.X, a.W)
    }
    function da(a, c) {
        var b = L(a, c, i),
        d = a.z.M(b);
        a.f.removeElement(b);
        return d
    }
    function L(a, c, b) {
        var d = a.wa.expand(a.W);
        c = a.f.createElement("span", {
            style: "position:absolute;top:-999px;font-size:300px;width:auto;height:auto;line-height:normal;margin:0;padding:0;font-variant:normal;font-family:" + (b ? "": a.Ba.quote(a.X) + ",") + c + ";" + d
        },
        a.va);
        a.f.insertInto("body", c);
        return c
    }
    function D(a) {
        this.za = a || "-"
    }
    D.prototype.k = function() {
        for (var a = [], c = 0; c < arguments.length; c++) a.push(arguments[c].replace(/[\W_]+/g, "").toLowerCase());
        return a.join(this.za)
    };
    function K() {
        this.ha = "'"
    }
    K.prototype.quote = function(a) {
        var c = [];
        a = a.split(/,\s*/);
        for (var b = 0; b < a.length; b++) {
            var d = a[b].replace(/['"]/g, "");
            d.indexOf(" ") == -1 ? c.push(d) : c.push(this.ha + d + this.ha)
        }
        return c.join(",")
    };
    function ca() {
        this.fa = ga;
        this.B = ha
    }
    var ga = ["font-style", "font-weight"],
    ha = {
        "font-style": [["n", "normal"], ["i", "italic"], ["o", "oblique"]],
        "font-weight": [["1", "100"], ["2", "200"], ["3", "300"], ["4", "400"], ["5", "500"], ["6", "600"], ["7", "700"], ["8", "800"], ["9", "900"], ["4", "normal"], ["7", "bold"]]
    };
    function ia(a, c, b) {
        this.ya = a;
        this.Ga = c;
        this.B = b
    }
    ia.prototype.expand = function(a, c) {
        for (var b = 0; b < this.B.length; b++) if (c == this.B[b][0]) {
            a[this.ya] = this.Ga + ":" + this.B[b][1];
            break
        }
    };
    ca.prototype.expand = function(a) {
        if (a.length != 2) return k;
        for (var c = [k, k], b = 0, d = this.fa.length; b < d; b++) {
            var e = this.fa[b]; (new ia(b, e, this.B[e])).expand(c, a.substr(b, 1))
        }
        return c[0] && c[1] ? c.join(";") + ";": k
    };
    function M(a, c) {
        this.p = a;
        this.i = c
    }
    M.prototype = v.prototype;
    M.prototype.isHttps = function() {
        return this.p.location.protocol == "https:"
    };
    M.prototype.getHostName = function() {
        return this.p.location.hostname
    };
    M.prototype.loadScript = function(a, c) {
        var b = this.p.getElementsByTagName("head")[0];
        if (b) {
            var d = this.p.createElement("script");
            d.src = a;
            var e = p;
            d.onload = d.onreadystatechange = function() {
                if (!e && (!this.readyState || this.readyState == "loaded" || this.readyState == "complete")) {
                    e = i;
                    c && c();
                    d.onload = d.onreadystatechange = k;
                    d.parentNode.tagName == "HEAD" && b.removeChild(d)
                }
            };
            b.appendChild(d)
        }
    };
    M.prototype.createStyle = function(a) {
        var c = this.p.createElement("style");
        c.setAttribute("type", "text/css");
        if (c.styleSheet) c.styleSheet.cssText = a;
        else c.appendChild(document.createTextNode(a));
        return c
    };
    function ja(a) {
        for (var c = a.Ia.join(","), b = [], d = 0; d < a.V.length; d++) {
            var e = a.V[d];
            b.push(e.name + ":" + e.value + ";")
        }
        return c + "{" + b.join("") + "}"
    }
    function ka(a, c) {
        this.D = a;
        this.Z = c;
        this.Y = {}
    }
    function N(a, c) {
        return c ? (a.Y[c.getStylesheetFormatId()] || a.Z).slice(0) : a.Z.slice(0)
    }
    function la(a, c, b) {
        for (var d = N(a), e, f = [], j = {},
        g = 0; g < d.length; g++) {
            e = d[g];
            if (e.length > 0 && !j[e]) {
                j[e] = i;
                f.push(e)
            }
        }
        b = b.ga ? b.ga(f) : f;
        a.Y[c.getStylesheetFormatId()] = b
    }
    ka.prototype.watch = function(a, c, b) {
        var d = [],
        e = {};
        d.push(this.D);
        e[this.D] = N(this, c);
        a.watch(d, e, {},
        b)
    };
    function O(a, c, b) {
        this.Ja = a;
        this.N = c;
        this.Ha = b
    }
    O.prototype.buildUrl = function(a, c) {
        var b = this.Ja && a ? "https:": "http:",
        d = typeof this.N == "function" ? this.N(b) : this.N;
        return b + "//" + d + this.Ha + c
    };
    function ma(a, c, b) {
        if (a.$) {
            var d = function() {
                try {
                    c._gat._getTracker("UA-8850781-3")._trackPageview();
                    c.tkKitsTracked || (c.tkKitsTracked = 0);
                    c.tkKitsTracked++
                } catch(e) {}
            };
            if (c._gat) d();
            else {
                a = a.$.buildUrl(b.isHttps(), "/ga.js");
                b.loadScript(a, d)
            }
        }
    }
    function P(a, c, b) {
        this.A = a;
        this.la = c;
        this.ba = b
    }
    P.prototype.getId = s("A");
    P.prototype.getStylesheetFormatId = s("la");
    P.prototype.isUserAgent = function(a) {
        return this.ba ? this.ba(a.getName(), a.getVersion(), a.getEngine(), a.getEngineVersion(), a.getPlatform(), a.getPlatformVersion(), a.getDocumentMode()) : p
    };
    P.prototype.buildCssUrl = function(a, c, b, d) {
        b = "/" + b + "-" + this.la + ".css";
        if (d) b += "?" + d;
        return c.buildUrl(a, b)
    };
    function Q() {
        this.t = []
    }
    Q.prototype.addBrowser = function(a) {
        this.getBrowserById(a.getId()) || this.t.push(a)
    };
    Q.prototype.getBrowserById = function(a) {
        for (var c = 0; c < this.t.length; c++) {
            var b = this.t[c];
            if (a === b.getId()) return b
        }
        return k
    };
    Q.prototype.findBrowser = function(a) {
        for (var c = 0; c < this.t.length; c++) {
            var b = this.t[c];
            if (b.isUserAgent(a)) return b
        }
        return k
    };
    Q.prototype.addBrowsersToBrowserSet = function(a) {
        for (var c = 0; c < this.t.length; c++) a.addBrowser(this.t[c])
    };
    function na(a) {
        this.A = a;
        this.I = new Q;
        this.m = [];
        this.J = [];
        this.K = this.T = this.v = k
    }
    t = na.prototype;
    t.getId = s("A");
    t.setSecurityToken = r("ka");
    t.setNestedUrl = r("da");
    t.setFontFilterSet = r("K");
    t.setKitOptions = r("G");
    t.addBrowser = function(a) {
        this.I.addBrowser(a)
    };
    t.addFontFamily = function(a) {
        this.m.push(a)
    };
    t.addCssRule = function(a) {
        this.J.push(a)
    };
    t.supportsBrowser = function(a) {
        return !! this.I.getBrowserById(a.getId())
    };
    t.addBrowsersToBrowserSet = function(a) {
        this.I.addBrowsersToBrowserSet(a)
    };
    t.init = function(a) {
        for (var c = [], b = 0; b < this.J.length; b++) c.push(ja(this.J[b]));
        a.insertInto("head", a.createStyle(c.join("")))
    };
    t.load = function(a, c, b, d) {
        if (this.K) for (var e = oa(this.K, b.getStylesheetFormatId()), f = 0; f < this.m.length; f++) la(this.m[f], b, e);
        if (this.v && this.T) {
            this.v.pa(new pa(b.getStylesheetFormatId()));
            f = new qa(a, this.C, this.m);
            e = ra(this.T, b.getStylesheetFormatId(), f);
            for (f = 0; f < e.length; f++) this.v.pa(e[f]);
            this.v.Na(this.ka);
            f = this.v.buildUrl(a.isHttps(), this.da)
        } else f = b.buildCssUrl(a.isHttps(), this.da, this.A, this.ka);
        a.insertInto("head", a.createCssLink(f));
        c && a.whenBodyExists(function(j, g, h, o) {
            return function() {
                for (var m =
                0; m < j.m.length; m++) j.m[m].watch(g, h, o && m == j.m.length - 1)
            }
        } (this, c, b, d))
    };
    t.collectFontFamilies = function(a, c, b) {
        for (var d = 0; d < this.m.length; d++) {
            var e = this.m[d],
            f = a,
            j = b;
            c.push(e.D);
            j[e.D] = N(e, f)
        }
    };
    t.performOptionalActions = function(a, c, b) {
        this.G && b.whenBodyExists(function(d, e, f, j) {
            return function() {
                ma(d.G, e, j);
                var g = d.G;
                if (g.ea) {
                    g = g.ea.buildUrl(j.isHttps());
                    j.loadScript(g)
                }
                var h = d.G;
                g = d.A;
                if (h.Q) {
                    h = h.Q.k(g, f, j);
                    h.setAttribute("id", "typekit-badge-" + g);
                    j.insertInto("body", h)
                }
            }
        } (this, a, c, b))
    };
    function R(a, c, b, d, e) {
        this.Aa = a;
        this.f = c;
        this.i = b;
        this.j = d;
        this.s = e;
        this.o = []
    }
    R.prototype.H = function(a) {
        this.o.push(a)
    };
    R.prototype.load = function(a, c) {
        var b = a,
        d = c || {};
        if (typeof b == "string") b = [b];
        else if (b && b.length) b = b;
        else {
            d = b || {};
            b = []
        }
        if (b.length) for (var e = this, f = b.length, j = 0; j < b.length; j++) this.na(b[j],
        function() {--f == 0 && e.P(d)
        });
        else this.P(d)
    };
    R.prototype.na = function(a, c) {
        this.f.loadScript(this.Aa.buildUrl(this.f.isHttps(), "/" + a + ".js"), c)
    };
    R.prototype.P = function(a) {
        if (a.userAgent) this.i = (new x(a.userAgent, document)).parse();
        a = new ba(this.f, this.j, a);
        for (var c = new Q, b = 0; b < this.o.length; b++) this.o[b].addBrowsersToBrowserSet(c);
        c = c.findBrowser(this.i);
        for (b = 0; b < this.o.length; b++) this.o[b].init(this.f);
        if (c) {
            a.f.appendClassName(a.j, a.l.k(a.n, "loading"));
            F(a, "loading");
            sa(this, c, a)
        } else E(a);
        this.o = []
    };
    function sa(a, c, b) {
        b = new G(a.f, b, {
            M: function(f) {
                return f.offsetWidth
            }
        },
        a.s,
        function() {
            return + new Date
        });
        for (var d = 0; d < a.o.length; d++) {
            var e = a.o[d];
            if (e.supportsBrowser(c)) {
                e.load(a.f, b, c, d == a.o.length - 1);
                e.performOptionalActions(window, a.i, a.f)
            }
        }
    }
    function S(a, c, b) {
        this.aa = a;
        this.f = c;
        this.s = b;
        this.o = []
    }
    S.prototype.H = function(a) {
        this.o.push(a)
    };
    S.prototype.load = function() {
        var a = this.aa.__webfonttypekitmodule__;
        if (a) for (var c = 0; c < this.o.length; c++) {
            var b = this.o[c],
            d = a[b.getId()];
            if (d) {
                var e = this.f,
                f = this.s;
                d(function(j, g, h) {
                    var o = new Q;
                    b.addBrowsersToBrowserSet(o);
                    g = [];
                    var m = {};
                    if (o = o.findBrowser(j)) {
                        b.init(e);
                        b.load(e, k, o, f);
                        b.collectFontFamilies(o, g, m);
                        b.performOptionalActions(window, j, e, f)
                    }
                    h( !! o, g, m)
                })
            }
        }
    };
    function T(a, c) {
        this.O = a;
        this.ga = c
    }
    T.prototype.getName = s("O");
    function U(a, c) {
        for (var b = 0; b < a.F.length; b++) {
            var d = a.F[b];
            if (c === d.getName()) return d
        }
        return k
    }
    function oa(a, c) {
        var b = a.q[c];
        return b ? U(a, b) : k
    }
    function ra(a, c, b) {
        var d = [];
        a = a.r[c] || [];
        for (c = 0; c < a.length; c++) {
            var e;
            a: switch (a[c]) {
            case "observeddomain":
                e = new ta(b.f);
                break a;
            case "fontmask":
                e = new ua(b.C, b.m);
                break a;
            default:
                e = k
            }
            e && d.push(e)
        }
        return d
    }
    function qa(a, c, b) {
        this.f = a;
        this.C = c;
        this.m = b
    }
    function pa(a) {
        this.La = a
    }
    pa.prototype.toString = s("La");
    function ta(a) {
        this.f = a
    }
    ta.prototype.toString = function() {
        return this.f.getHostName ? this.f.getHostName() : document.location.hostname
    };
    function ua(a, c) {
        this.C = a;
        this.m = c
    }
    ua.prototype.toString = function() {
        for (var a = [], c = 0; c < this.m.length; c++) {
            var b = this.m[c],
            d = N(b);
            b = N(b, this.C);
            for (var e = 0; e < d.length; e++) {
                var f;
                a: {
                    for (f = 0; f < b.length; f++) if (d[e] === b[f]) {
                        f = i;
                        break a
                    }
                    f = p
                }
                a.push(f ? 1: 0)
            }
        }
        a = a.join("");
        c = [];
        for (d = a.length; d > 0; d -= 8) {
            b = a.slice(d - 8 < 0 ? 0: d - 8, d);
            c.unshift(parseInt(b, 2).toString(16))
        }
        return c.join("")
    };
    var V = new Q;
    V.addBrowser(new P("chrome6-linux-osx", "d",
    function(a, c, b, d, e, f, j) {
        var g = p;
        g = (g = g ||
        function(h, o, m, q, l, n) {
            h = /^([0-9]+)(_|.)([0-9]+)/.exec(n);
            if (l == "Macintosh" && h) {
                l = parseInt(h[1], 10);
                n = parseInt(h[3], 10);
                if (l == 10) return n > 3;
                else if (l > 10) return i
            } else return l == "Macintosh" && n == "Unknown" ? i: p
        } (a, c, b, d, e, f, j)) || (e == "Ubuntu" || e == "Linux" ? i: p);
        if (!g) return p;
        return function(h, o) {
            if (h == "Chrome") {
                var m = /([0-9]+.[0-9]+).([0-9]+).([0-9]+)/.exec(o);
                if (m) if (parseFloat(m[1]) >= 6) return i
            }
        } (a, c, b, d, e, f, j)
    }));
    V.addBrowser(new P("ie-win2003-win7-winvista-winxp", "c",
    function(a, c, b, d, e, f, j) {
        var g = p;
        g = (g = (g = (g = g || (e == "Windows" && f == "5.1" ? i: p)) || (e == "Windows" && f == "5.2" ? i: p)) || (e == "Windows" && f == "6.0" ? i: p)) || (e == "Windows" && f == "6.1" ? i: p);
        if (!g) return p;
        return function(h, o, m, q, l, n, H) {
            if (h == "MSIE") {
                if (h = /([0-9]+.[0-9]+)/.exec(o)) return parseFloat(h[1]) >= 6 && (H === undefined || H < 9);
                return p
            }
        } (a, c, b, d, e, f, j)
    }));
    V.addBrowser(new P("ff36-linux-osx-win2003-win7-winvista-winxp", "e",
    function(a, c, b, d, e, f, j) {
        var g = p;
        g = (g = (g = (g = (g = (g = g || (e == "Windows" && f == "5.1" ? i: p)) || (e == "Windows" && f == "5.2" ? i: p)) || (e == "Windows" && f == "6.0" ? i: p)) || (e == "Windows" && f == "6.1" ? i: p)) ||
        function(h, o, m, q, l, n) {
            h = /^([0-9]+)(_|.)([0-9]+)/.exec(n);
            if (l == "Macintosh" && h) {
                l = parseInt(h[1], 10);
                n = parseInt(h[3], 10);
                if (l == 10) return n > 3;
                else if (l > 10) return i
            } else return l == "Macintosh" && n == "Unknown" ? i: p
        } (a, c, b, d, e, f, j)) || (e == "Ubuntu" || e == "Linux" ? i: p);
        if (!g) return p;
        return function(h, o, m, q) {
            if (m == "Gecko") if (o = /([0-9]+.[0-9]+)(.([0-9]+)|)/.exec(q)) {
                h = parseFloat(o[1]);
                o = parseInt(o[3], 10);
                return h > 1.9 || h >= 1.9 && o > 1
            }
            return p
        } (a, c, b, d, e, f, j)
    }));
    V.addBrowser(new P("ff35-linux-osx-win2003-win7-winvista-winxp", "b",
    function(a, c, b, d, e, f, j) {
        var g = p;
        g = (g = (g = (g = (g = (g = g || (e == "Windows" && f == "5.1" ? i: p)) || (e == "Windows" && f == "5.2" ? i: p)) || (e == "Windows" && f == "6.0" ? i: p)) || (e == "Windows" && f == "6.1" ? i: p)) ||
        function(h, o, m, q, l, n) {
            h = /^([0-9]+)(_|.)([0-9]+)/.exec(n);
            if (l == "Macintosh" && h) {
                l = parseInt(h[1], 10);
                n = parseInt(h[3], 10);
                if (l == 10) return n > 3;
                else if (l > 10) return i
            } else return l == "Macintosh" && n == "Unknown" ? i: p
        } (a, c, b, d, e, f, j)) || (e == "Ubuntu" || e == "Linux" ? i: p);
        if (!g) return p;
        return function(h, o, m, q) {
            if (m == "Gecko") {
                h = /1.9.1b[1-3]{1}/;
                return /1.9.1/.test(q) && !h.test(q)
            }
            return p
        } (a, c, b, d, e, f, j)
    }));
    V.addBrowser(new P("safari-osx-win2003-win7-winvista-winxp", "b",
    function(a, c, b, d, e, f, j) {
        var g = p;
        g = (g = (g = (g = (g = g || (e == "Windows" && f == "5.1" ? i: p)) || (e == "Windows" && f == "5.2" ? i: p)) || (e == "Windows" && f == "6.0" ? i: p)) || (e == "Windows" && f == "6.1" ? i: p)) ||
        function(h, o, m, q, l, n) {
            h = /^([0-9]+)(_|.)([0-9]+)/.exec(n);
            if (l == "Macintosh" && h) {
                l = parseInt(h[1], 10);
                n = parseInt(h[3], 10);
                if (l == 10) return n > 3;
                else if (l > 10) return i
            } else return l == "Macintosh" && n == "Unknown" ? i: p
        } (a, c, b, d, e, f, j);
        if (!g) return p;
        return function(h, o, m, q, l) {
            if (h ==
            "Safari" && m == "AppleWebKit" || h == "Unknown" && m == "AppleWebKit" && (l == "iPhone" || l == "iPad")) if (h = /([0-9]+.[0-9]+)/.exec(q)) return parseFloat(h[1]) >= 525.13;
            return p
        } (a, c, b, d, e, f, j)
    }));
    V.addBrowser(new P("safari-android", "a",
    function(a, c, b, d, e, f, j) {
        var g = p;
        g = g ||
        function(h, o, m, q, l, n) {
            h = /([0-9]+).([0-9]+)/.exec(n);
            if (l == "Android" && h) {
                l = parseInt(h[1]);
                h = parseInt(h[2]);
                return l > 2 || l == 2 && h >= 2
            } else return p
        } (a, c, b, d, e, f, j);
        if (!g) return p;
        return function(h, o, m, q, l) {
            if (h == "Safari" && m == "AppleWebKit" || h == "Unknown" && m == "AppleWebKit" && (l == "iPhone" || l == "iPad")) if (h = /([0-9]+.[0-9]+)/.exec(q)) return parseFloat(h[1]) >= 525.13;
            return p
        } (a, c, b, d, e, f, j)
    }));
    V.addBrowser(new P("ie9-win7", "g",
    function(a, c, b, d, e, f, j) {
        var g = p;
        g = g || (e == "Windows" && f == "6.1" ? i: p);
        if (!g) return p;
        return function(h, o, m, q, l, n, H) {
            if (h == "MSIE") {
                if (h = /([0-9]+.[0-9]+)/.exec(o)) return parseFloat(h[1]) >= 9 && H >= 9;
                return p
            }
        } (a, c, b, d, e, f, j)
    }));
    V.addBrowser(new P("chrome-linux-osx-win2003-win7-winvista-winxp", "b",
    function(a, c, b, d, e, f, j) {
        var g = p;
        g = (g = (g = (g = (g = (g = g || (e == "Windows" && f == "5.1" ? i: p)) || (e == "Windows" && f == "5.2" ? i: p)) || (e == "Windows" && f == "6.0" ? i: p)) || (e == "Windows" && f == "6.1" ? i: p)) ||
        function(h, o, m, q, l, n) {
            h = /^([0-9]+)(_|.)([0-9]+)/.exec(n);
            if (l == "Macintosh" && h) {
                l = parseInt(h[1], 10);
                n = parseInt(h[3], 10);
                if (l == 10) return n > 3;
                else if (l > 10) return i
            } else return l == "Macintosh" && n == "Unknown" ? i: p
        } (a, c, b, d, e, f, j)) || (e == "Ubuntu" || e == "Linux" ? i: p);
        if (!g) return p;
        return function(h, o) {
            if (h == "Chrome") {
                var m = /([0-9]+.[0-9]+).([0-9]+).([0-9]+)/.exec(o);
                if (m) {
                    var q = parseFloat(m[1]),
                    l = parseInt(m[2], 10);
                    m = parseInt(m[3], 10);
                    if (q >= 6) return p;
                    else if (q > 4) return i;
                    else if (q == 4 && l > 249) return i;
                    else if (q == 4 && l == 249 && m >= 4) return i
                }
            }
            return p
        } (a, c, b, d, e, f, j)
    }));
    V.addBrowser(new P("ie9-winvista", "h",
    function(a, c, b, d, e, f, j) {
        var g = p;
        g = g || (e == "Windows" && f == "6.0" ? i: p);
        if (!g) return p;
        return function(h, o, m, q, l, n, H) {
            if (h == "MSIE") {
                if (h = /([0-9]+.[0-9]+)/.exec(o)) return parseFloat(h[1]) >= 9 && H >= 9;
                return p
            }
        } (a, c, b, d, e, f, j)
    }));
    V.addBrowser(new P("chrome6-win2003-win7-winvista-winxp", "e",
    function(a, c, b, d, e, f, j) {
        var g = p;
        g = (g = (g = (g = g || (e == "Windows" && f == "5.1" ? i: p)) || (e == "Windows" && f == "5.2" ? i: p)) || (e == "Windows" && f == "6.0" ? i: p)) || (e == "Windows" && f == "6.1" ? i: p);
        if (!g) return p;
        return function(h, o) {
            if (h == "Chrome") {
                var m = /([0-9]+.[0-9]+).([0-9]+).([0-9]+)/.exec(o);
                if (m) if (parseFloat(m[1]) >= 6) return i
            }
        } (a, c, b, d, e, f, j)
    }));
    V.addBrowser(new P("air-linux-osx-win", "b",
    function(a, c, b, d, e, f, j) {
        var g = p;
        g = (g = (g = g || (e == "Windows" && f == "Unknown" ? i: p)) ||
        function(h, o, m, q, l, n) {
            h = /^([0-9]+)(_|.)([0-9]+)/.exec(n);
            if (l == "Macintosh" && h) {
                l = parseInt(h[1], 10);
                n = parseInt(h[3], 10);
                if (l == 10) return n > 3;
                else if (l > 10) return i
            } else return l == "Macintosh" && n == "Unknown" ? i: p
        } (a, c, b, d, e, f, j)) || (e == "Ubuntu" || e == "Linux" ? i: p);
        if (!g) return p;
        return function(h, o) {
            if (h == "AdobeAIR") {
                var m = /([0-9]+.[0-9]+)/.exec(o);
                if (m) return parseFloat(m[1]) >= 2.5
            }
            return p
        } (a,
        c, b, d, e, f, j)
    }));
    V.addBrowser(new P("opera-linux-osx-win2003-win7-winvista-winxp", "b",
    function(a, c, b, d, e, f, j) {
        var g = p;
        g = (g = (g = (g = (g = (g = g || (e == "Windows" && f == "5.1" ? i: p)) || (e == "Windows" && f == "5.2" ? i: p)) || (e == "Windows" && f == "6.0" ? i: p)) || (e == "Windows" && f == "6.1" ? i: p)) ||
        function(h, o, m, q, l, n) {
            h = /^([0-9]+)(_|.)([0-9]+)/.exec(n);
            if (l == "Macintosh" && h) {
                l = parseInt(h[1], 10);
                n = parseInt(h[3], 10);
                if (l == 10) return n > 3;
                else if (l > 10) return i
            } else return l == "Macintosh" && n == "Unknown" ? i: p
        } (a, c, b, d, e, f, j)) || (e == "Ubuntu" || e == "Linux" ? i: p);
        if (!g) return p;
        a = a == "Opera" ? parseFloat(c) >= 10.54: p;
        return a
    }));
    var W = new
    function() {
        this.F = [];
        this.q = {}
    },
    va = new T("AllFonts",
    function(a) {
        return a
    });
    U(W, va.getName()) || W.F.push(va);
    var wa = new T("IEVisibleFonts",
    function(a) {
        function c(j, g) {
            for (var h = 0; h < j.length; h++) if (g[j[h]]) return g[j[h]];
            return []
        }
        for (var b, d, e = {},
        f = 0; f < a.length; f++) {
            b = a[f];
            d = b.charAt(1); (e[d] || (e[d] = [])).push(b)
        }
        a = c([4, 3, 2, 1, 5, 6, 7, 8, 9], e);
        e = c([7, 8, 9, 6, 5, 4, 3, 2, 1], e);
        if (a.length && e.length && a[0].charAt(1) == e[0].charAt(1)) return a;
        return a.concat(e)
    });
    U(W, wa.getName()) || W.F.push(wa);
    W.q.a = "AllFonts";
    W.q.b = "AllFonts";
    W.q.c = "IEVisibleFonts";
    W.q.d = "AllFonts";
    W.q.e = "AllFonts";
    W.q.g = "AllFonts";
    W.q.h = "AllFonts";
    var X = new
    function() {
        this.r = {}
    };
    X.r.a = [];
    X.r.b = [];
    X.r.c = ["observeddomain", "fontmask"];
    X.r.d = [];
    X.r.e = [];
    X.r.g = ["observeddomain"];
    X.r.h = ["observeddomain"];
    if (!window.Typekit) {
        var xa = new O(p, "use.typekit.com", "/"),
        ya = (new x(navigator.userAgent, document)).parse(),
        za = new M(document, ya),
        Aa = function(a, c) {
            setTimeout(a, c)
        },
        Y = new R(xa, za, ya, document.documentElement, Aa),
        Z = new S(window, za, Aa);
        window.Typekit = Y;
        window.Typekit.load = Y.load;
        window.Typekit.addKit = Y.H
    }
    var Ba,
    Ca,
    $;
    Ba = new O(p, "use.typekit.com", "/k");
    Ca = new
    function(a, c, b) {
        this.Q = a;
        this.$ = c;
        this.ea = b
    } (k, k, k);
    $ = new na("bqa1ehi");
    $.setSecurityToken("3bb2a6e53c9684ffdc9a99f61f5b2a62903f1c1625298e6d593d790846cfa19f489850475760319cc4e7168a60bbeae258644bee2dbd3ee1f33fbf698504a00e127cf12c06c99657990ef2484b1bfdcda89c7f7af1302719d3b8777e3c41a6eb4286327f862edda85a06091c661cbaa89e0e900651b2c7eefb1da823bb65316eb403c7b8abbd7e3bdd531be37290a3f6acac05b03ec4361d3c1734d18ddbff7d34b1e62493190a78ac5528caf52d52bb7ab7e3a5604295c9ace55ac237b8a0d869598f107a03e8c94c5c27029d93ceba0587da9a885c46bf4ad9e67c146178d6790a0a91486d527ca7d8f9b723b7eaea3542de47380313da3276f2d3803b8ac7a6ce28b6a3cc14edf4a17482efe4e0f13f3b4c7e525e7d7dccb4625e59fa0f5c4d8b8d4fa00e2da9f14c93fe2dcfffc03d");
    $.setNestedUrl(Ba);
    $.setKitOptions(Ca);
    $.addFontFamily(new ka('"proxima-nova-1","proxima-nova-2"', ["n1", "i1", "n4", "i4", "n7", "i7", "n9", "i9"]));
    $.addCssRule(new
    function(a, c) {
        this.Ia = a;
        this.V = c
    } ([".tk-proxima-nova", ".tk_proxima_nova"], [{
        value: '"proxima-nova-1","proxima-nova-2","Helvetica Neue","Arial",sans-serif',
        name: "font-family"
    }]));
    $.addBrowser(V.getBrowserById("air-linux-osx-win"));
    $.addBrowser(V.getBrowserById("chrome-linux-osx-win2003-win7-winvista-winxp"));
    $.addBrowser(V.getBrowserById("chrome6-linux-osx"));
    $.addBrowser(V.getBrowserById("chrome6-win2003-win7-winvista-winxp"));
    $.addBrowser(V.getBrowserById("ff35-linux-osx-win2003-win7-winvista-winxp"));
    $.addBrowser(V.getBrowserById("ff36-linux-osx-win2003-win7-winvista-winxp"));
    $.addBrowser(V.getBrowserById("ie-win2003-win7-winvista-winxp"));
    $.addBrowser(V.getBrowserById("ie9-win7"));
    $.addBrowser(V.getBrowserById("ie9-winvista"));
    $.addBrowser(V.getBrowserById("opera-linux-osx-win2003-win7-winvista-winxp"));
    $.addBrowser(V.getBrowserById("safari-android"));
    $.addBrowser(V.getBrowserById("safari-osx-win2003-win7-winvista-winxp"));
    $.setFontFilterSet(W);
    if (Z && Z.aa.__webfonttypekitmodule__) {
        Z.H($);
        Z.load()
    } else window.Typekit.addKit($);
})(this, document);