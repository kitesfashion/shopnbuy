! function(t, e) {
    "use strict";
    "object" == typeof module && "object" == typeof module.exports ? module.exports = t.document ? e(t, !0) : function(t) {
        if (!t.document) throw new Error("jQuery requires a window with a document");
        return e(t)
    } : e(t)
}("undefined" != typeof window ? window : this, function(t, e) {
    "use strict";
    var n = [],
        i = t.document,
        r = Object.getPrototypeOf,
        s = n.slice,
        o = n.concat,
        a = n.push,
        l = n.indexOf,
        u = {},
        c = u.toString,
        h = u.hasOwnProperty,
        p = h.toString,
        d = p.call(Object),
        f = {},
        g = function(t) {
            return "function" == typeof t && "number" != typeof t.nodeType
        },
        m = function(t) {
            return null != t && t === t.window
        },
        v = {
            type: !0,
            src: !0,
            noModule: !0
        };

    function y(t, e, n) {
        var r, s = (e = e || i).createElement("script");
        if (s.text = t, n)
            for (r in v) n[r] && (s[r] = n[r]);
        e.head.appendChild(s).parentNode.removeChild(s)
    }

    function x(t) {
        return null == t ? t + "" : "object" == typeof t || "function" == typeof t ? u[c.call(t)] || "object" : typeof t
    }
    var w = function(t, e) {
            return new w.fn.init(t, e)
        },
        _ = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;

    function b(t) {
        var e = !!t && "length" in t && t.length,
            n = x(t);
        return !g(t) && !m(t) && ("array" === n || 0 === e || "number" == typeof e && e > 0 && e - 1 in t)
    }
    w.fn = w.prototype = {
        jquery: "3.3.1",
        constructor: w,
        length: 0,
        toArray: function() {
            return s.call(this)
        },
        get: function(t) {
            return null == t ? s.call(this) : t < 0 ? this[t + this.length] : this[t]
        },
        pushStack: function(t) {
            var e = w.merge(this.constructor(), t);
            return e.prevObject = this, e
        },
        each: function(t) {
            return w.each(this, t)
        },
        map: function(t) {
            return this.pushStack(w.map(this, function(e, n) {
                return t.call(e, n, e)
            }))
        },
        slice: function() {
            return this.pushStack(s.apply(this, arguments))
        },
        first: function() {
            return this.eq(0)
        },
        last: function() {
            return this.eq(-1)
        },
        eq: function(t) {
            var e = this.length,
                n = +t + (t < 0 ? e : 0);
            return this.pushStack(n >= 0 && n < e ? [this[n]] : [])
        },
        end: function() {
            return this.prevObject || this.constructor()
        },
        push: a,
        sort: n.sort,
        splice: n.splice
    }, w.extend = w.fn.extend = function() {
        var t, e, n, i, r, s, o = arguments[0] || {},
            a = 1,
            l = arguments.length,
            u = !1;
        for ("boolean" == typeof o && (u = o, o = arguments[a] || {}, a++), "object" == typeof o || g(o) || (o = {}), a === l && (o = this, a--); a < l; a++)
            if (null != (t = arguments[a]))
                for (e in t) n = o[e], o !== (i = t[e]) && (u && i && (w.isPlainObject(i) || (r = Array.isArray(i))) ? (r ? (r = !1, s = n && Array.isArray(n) ? n : []) : s = n && w.isPlainObject(n) ? n : {}, o[e] = w.extend(u, s, i)) : void 0 !== i && (o[e] = i));
        return o
    }, w.extend({
        expando: "jQuery" + ("3.3.1" + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function(t) {
            throw new Error(t)
        },
        noop: function() {},
        isPlainObject: function(t) {
            var e, n;
            return !(!t || "[object Object]" !== c.call(t) || (e = r(t)) && ("function" != typeof(n = h.call(e, "constructor") && e.constructor) || p.call(n) !== d))
        },
        isEmptyObject: function(t) {
            var e;
            for (e in t) return !1;
            return !0
        },
        globalEval: function(t) {
            y(t)
        },
        each: function(t, e) {
            var n, i = 0;
            if (b(t))
                for (n = t.length; i < n && !1 !== e.call(t[i], i, t[i]); i++);
            else
                for (i in t)
                    if (!1 === e.call(t[i], i, t[i])) break; return t
        },
        trim: function(t) {
            return null == t ? "" : (t + "").replace(_, "")
        },
        makeArray: function(t, e) {
            var n = e || [];
            return null != t && (b(Object(t)) ? w.merge(n, "string" == typeof t ? [t] : t) : a.call(n, t)), n
        },
        inArray: function(t, e, n) {
            return null == e ? -1 : l.call(e, t, n)
        },
        merge: function(t, e) {
            for (var n = +e.length, i = 0, r = t.length; i < n; i++) t[r++] = e[i];
            return t.length = r, t
        },
        grep: function(t, e, n) {
            for (var i = [], r = 0, s = t.length, o = !n; r < s; r++) !e(t[r], r) !== o && i.push(t[r]);
            return i
        },
        map: function(t, e, n) {
            var i, r, s = 0,
                a = [];
            if (b(t))
                for (i = t.length; s < i; s++) null != (r = e(t[s], s, n)) && a.push(r);
            else
                for (s in t) null != (r = e(t[s], s, n)) && a.push(r);
            return o.apply([], a)
        },
        guid: 1,
        support: f
    }), "function" == typeof Symbol && (w.fn[Symbol.iterator] = n[Symbol.iterator]), w.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function(t, e) {
        u["[object " + e + "]"] = e.toLowerCase()
    });
    var C = function(t) {
        var e, n, i, r, s, o, a, l, u, c, h, p, d, f, g, m, v, y, x, w = "sizzle" + 1 * new Date,
            _ = t.document,
            b = 0,
            C = 0,
            T = ot(),
            E = ot(),
            D = ot(),
            S = function(t, e) {
                return t === e && (h = !0), 0
            },
            k = {}.hasOwnProperty,
            j = [],
            A = j.pop,
            $ = j.push,
            N = j.push,
            L = j.slice,
            q = function(t, e) {
                for (var n = 0, i = t.length; n < i; n++)
                    if (t[n] === e) return n;
                return -1
            },
            z = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            H = "[\\x20\\t\\r\\n\\f]",
            P = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+",
            O = "\\[" + H + "*(" + P + ")(?:" + H + "*([*^$|!~]?=)" + H + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + P + "))|)" + H + "*\\]",
            M = ":(" + P + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + O + ")*)|.*)\\)|)",
            R = new RegExp(H + "+", "g"),
            I = new RegExp("^" + H + "+|((?:^|[^\\\\])(?:\\\\.)*)" + H + "+$", "g"),
            W = new RegExp("^" + H + "*," + H + "*"),
            B = new RegExp("^" + H + "*([>+~]|" + H + ")" + H + "*"),
            F = new RegExp("=" + H + "*([^\\]'\"]*?)" + H + "*\\]", "g"),
            U = new RegExp(M),
            X = new RegExp("^" + P + "$"),
            V = {
                ID: new RegExp("^#(" + P + ")"),
                CLASS: new RegExp("^\\.(" + P + ")"),
                TAG: new RegExp("^(" + P + "|[*])"),
                ATTR: new RegExp("^" + O),
                PSEUDO: new RegExp("^" + M),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + H + "*(even|odd|(([+-]|)(\\d*)n|)" + H + "*(?:([+-]|)" + H + "*(\\d+)|))" + H + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + z + ")$", "i"),
                needsContext: new RegExp("^" + H + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + H + "*((?:-\\d)?\\d*)" + H + "*\\)|)(?=[^-]|$)", "i")
            },
            Q = /^(?:input|select|textarea|button)$/i,
            G = /^h\d$/i,
            Y = /^[^{]+\{\s*\[native \w/,
            Z = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
            J = /[+~]/,
            K = new RegExp("\\\\([\\da-f]{1,6}" + H + "?|(" + H + ")|.)", "ig"),
            tt = function(t, e, n) {
                var i = "0x" + e - 65536;
                return i != i || n ? e : i < 0 ? String.fromCharCode(i + 65536) : String.fromCharCode(i >> 10 | 55296, 1023 & i | 56320)
            },
            et = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
            nt = function(t, e) {
                return e ? "\0" === t ? "\ufffd" : t.slice(0, -1) + "\\" + t.charCodeAt(t.length - 1).toString(16) + " " : "\\" + t
            },
            it = function() {
                p()
            },
            rt = yt(function(t) {
                return !0 === t.disabled && ("form" in t || "label" in t)
            }, {
                dir: "parentNode",
                next: "legend"
            });
        try {
            N.apply(j = L.call(_.childNodes), _.childNodes)
        } catch (t) {
            N = {
                apply: j.length ? function(t, e) {
                    $.apply(t, L.call(e))
                } : function(t, e) {
                    for (var n = t.length, i = 0; t[n++] = e[i++];);
                    t.length = n - 1
                }
            }
        }

        function st(t, e, i, r) {
            var s, a, u, c, h, f, v, y = e && e.ownerDocument,
                b = e ? e.nodeType : 9;
            if (i = i || [], "string" != typeof t || !t || 1 !== b && 9 !== b && 11 !== b) return i;
            if (!r && ((e ? e.ownerDocument || e : _) !== d && p(e), e = e || d, g)) {
                if (11 !== b && (h = Z.exec(t)))
                    if (s = h[1]) {
                        if (9 === b) {
                            if (!(u = e.getElementById(s))) return i;
                            if (u.id === s) return i.push(u), i
                        } else if (y && (u = y.getElementById(s)) && x(e, u) && u.id === s) return i.push(u), i
                    } else {
                        if (h[2]) return N.apply(i, e.getElementsByTagName(t)), i;
                        if ((s = h[3]) && n.getElementsByClassName && e.getElementsByClassName) return N.apply(i, e.getElementsByClassName(s)), i
                    }
                if (n.qsa && !D[t + " "] && (!m || !m.test(t))) {
                    if (1 !== b) y = e, v = t;
                    else if ("object" !== e.nodeName.toLowerCase()) {
                        for ((c = e.getAttribute("id")) ? c = c.replace(et, nt) : e.setAttribute("id", c = w), a = (f = o(t)).length; a--;) f[a] = "#" + c + " " + vt(f[a]);
                        v = f.join(","), y = J.test(t) && gt(e.parentNode) || e
                    }
                    if (v) try {
                        return N.apply(i, y.querySelectorAll(v)), i
                    } catch (t) {} finally {
                        c === w && e.removeAttribute("id")
                    }
                }
            }
            return l(t.replace(I, "$1"), e, i, r)
        }

        function ot() {
            var t = [];
            return function e(n, r) {
                return t.push(n + " ") > i.cacheLength && delete e[t.shift()], e[n + " "] = r
            }
        }

        function at(t) {
            return t[w] = !0, t
        }

        function lt(t) {
            var e = d.createElement("fieldset");
            try {
                return !!t(e)
            } catch (t) {
                return !1
            } finally {
                e.parentNode && e.parentNode.removeChild(e), e = null
            }
        }

        function ut(t, e) {
            for (var n = t.split("|"), r = n.length; r--;) i.attrHandle[n[r]] = e
        }

        function ct(t, e) {
            var n = e && t,
                i = n && 1 === t.nodeType && 1 === e.nodeType && t.sourceIndex - e.sourceIndex;
            if (i) return i;
            if (n)
                for (; n = n.nextSibling;)
                    if (n === e) return -1;
            return t ? 1 : -1
        }

        function ht(t) {
            return function(e) {
                return "input" === e.nodeName.toLowerCase() && e.type === t
            }
        }

        function pt(t) {
            return function(e) {
                var n = e.nodeName.toLowerCase();
                return ("input" === n || "button" === n) && e.type === t
            }
        }

        function dt(t) {
            return function(e) {
                return "form" in e ? e.parentNode && !1 === e.disabled ? "label" in e ? "label" in e.parentNode ? e.parentNode.disabled === t : e.disabled === t : e.isDisabled === t || e.isDisabled !== !t && rt(e) === t : e.disabled === t : "label" in e && e.disabled === t
            }
        }

        function ft(t) {
            return at(function(e) {
                return e = +e, at(function(n, i) {
                    for (var r, s = t([], n.length, e), o = s.length; o--;) n[r = s[o]] && (n[r] = !(i[r] = n[r]))
                })
            })
        }

        function gt(t) {
            return t && "undefined" != typeof t.getElementsByTagName && t
        }
        for (e in n = st.support = {}, s = st.isXML = function(t) {
                var e = t && (t.ownerDocument || t).documentElement;
                return !!e && "HTML" !== e.nodeName
            }, p = st.setDocument = function(t) {
                var e, r, o = t ? t.ownerDocument || t : _;
                return o !== d && 9 === o.nodeType && o.documentElement ? (f = (d = o).documentElement, g = !s(d), _ !== d && (r = d.defaultView) && r.top !== r && (r.addEventListener ? r.addEventListener("unload", it, !1) : r.attachEvent && r.attachEvent("onunload", it)), n.attributes = lt(function(t) {
                    return t.className = "i", !t.getAttribute("className")
                }), n.getElementsByTagName = lt(function(t) {
                    return t.appendChild(d.createComment("")), !t.getElementsByTagName("*").length
                }), n.getElementsByClassName = Y.test(d.getElementsByClassName), n.getById = lt(function(t) {
                    return f.appendChild(t).id = w, !d.getElementsByName || !d.getElementsByName(w).length
                }), n.getById ? (i.filter.ID = function(t) {
                    var e = t.replace(K, tt);
                    return function(t) {
                        return t.getAttribute("id") === e
                    }
                }, i.find.ID = function(t, e) {
                    if ("undefined" != typeof e.getElementById && g) {
                        var n = e.getElementById(t);
                        return n ? [n] : []
                    }
                }) : (i.filter.ID = function(t) {
                    var e = t.replace(K, tt);
                    return function(t) {
                        var n = "undefined" != typeof t.getAttributeNode && t.getAttributeNode("id");
                        return n && n.value === e
                    }
                }, i.find.ID = function(t, e) {
                    if ("undefined" != typeof e.getElementById && g) {
                        var n, i, r, s = e.getElementById(t);
                        if (s) {
                            if ((n = s.getAttributeNode("id")) && n.value === t) return [s];
                            for (r = e.getElementsByName(t), i = 0; s = r[i++];)
                                if ((n = s.getAttributeNode("id")) && n.value === t) return [s]
                        }
                        return []
                    }
                }), i.find.TAG = n.getElementsByTagName ? function(t, e) {
                    return "undefined" != typeof e.getElementsByTagName ? e.getElementsByTagName(t) : n.qsa ? e.querySelectorAll(t) : void 0
                } : function(t, e) {
                    var n, i = [],
                        r = 0,
                        s = e.getElementsByTagName(t);
                    if ("*" === t) {
                        for (; n = s[r++];) 1 === n.nodeType && i.push(n);
                        return i
                    }
                    return s
                }, i.find.CLASS = n.getElementsByClassName && function(t, e) {
                    if ("undefined" != typeof e.getElementsByClassName && g) return e.getElementsByClassName(t)
                }, v = [], m = [], (n.qsa = Y.test(d.querySelectorAll)) && (lt(function(t) {
                    f.appendChild(t).innerHTML = "<a id='" + w + "'></a><select id='" + w + "-\r\\' msallowcapture=''><option selected=''></option></select>", t.querySelectorAll("[msallowcapture^='']").length && m.push("[*^$]=" + H + "*(?:''|\"\")"), t.querySelectorAll("[selected]").length || m.push("\\[" + H + "*(?:value|" + z + ")"), t.querySelectorAll("[id~=" + w + "-]").length || m.push("~="), t.querySelectorAll(":checked").length || m.push(":checked"), t.querySelectorAll("a#" + w + "+*").length || m.push(".#.+[+~]")
                }), lt(function(t) {
                    t.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
                    var e = d.createElement("input");
                    e.setAttribute("type", "hidden"), t.appendChild(e).setAttribute("name", "D"), t.querySelectorAll("[name=d]").length && m.push("name" + H + "*[*^$|!~]?="), 2 !== t.querySelectorAll(":enabled").length && m.push(":enabled", ":disabled"), f.appendChild(t).disabled = !0, 2 !== t.querySelectorAll(":disabled").length && m.push(":enabled", ":disabled"), t.querySelectorAll("*,:x"), m.push(",.*:")
                })), (n.matchesSelector = Y.test(y = f.matches || f.webkitMatchesSelector || f.mozMatchesSelector || f.oMatchesSelector || f.msMatchesSelector)) && lt(function(t) {
                    n.disconnectedMatch = y.call(t, "*"), y.call(t, "[s!='']:x"), v.push("!=", M)
                }), m = m.length && new RegExp(m.join("|")), v = v.length && new RegExp(v.join("|")), e = Y.test(f.compareDocumentPosition), x = e || Y.test(f.contains) ? function(t, e) {
                    var n = 9 === t.nodeType ? t.documentElement : t,
                        i = e && e.parentNode;
                    return t === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : t.compareDocumentPosition && 16 & t.compareDocumentPosition(i)))
                } : function(t, e) {
                    if (e)
                        for (; e = e.parentNode;)
                            if (e === t) return !0;
                    return !1
                }, S = e ? function(t, e) {
                    if (t === e) return h = !0, 0;
                    var i = !t.compareDocumentPosition - !e.compareDocumentPosition;
                    return i || (1 & (i = (t.ownerDocument || t) === (e.ownerDocument || e) ? t.compareDocumentPosition(e) : 1) || !n.sortDetached && e.compareDocumentPosition(t) === i ? t === d || t.ownerDocument === _ && x(_, t) ? -1 : e === d || e.ownerDocument === _ && x(_, e) ? 1 : c ? q(c, t) - q(c, e) : 0 : 4 & i ? -1 : 1)
                } : function(t, e) {
                    if (t === e) return h = !0, 0;
                    var n, i = 0,
                        r = t.parentNode,
                        s = e.parentNode,
                        o = [t],
                        a = [e];
                    if (!r || !s) return t === d ? -1 : e === d ? 1 : r ? -1 : s ? 1 : c ? q(c, t) - q(c, e) : 0;
                    if (r === s) return ct(t, e);
                    for (n = t; n = n.parentNode;) o.unshift(n);
                    for (n = e; n = n.parentNode;) a.unshift(n);
                    for (; o[i] === a[i];) i++;
                    return i ? ct(o[i], a[i]) : o[i] === _ ? -1 : a[i] === _ ? 1 : 0
                }, d) : d
            }, st.matches = function(t, e) {
                return st(t, null, null, e)
            }, st.matchesSelector = function(t, e) {
                if ((t.ownerDocument || t) !== d && p(t), e = e.replace(F, "='$1']"), n.matchesSelector && g && !D[e + " "] && (!v || !v.test(e)) && (!m || !m.test(e))) try {
                    var i = y.call(t, e);
                    if (i || n.disconnectedMatch || t.document && 11 !== t.document.nodeType) return i
                } catch (t) {}
                return st(e, d, null, [t]).length > 0
            }, st.contains = function(t, e) {
                return (t.ownerDocument || t) !== d && p(t), x(t, e)
            }, st.attr = function(t, e) {
                (t.ownerDocument || t) !== d && p(t);
                var r = i.attrHandle[e.toLowerCase()],
                    s = r && k.call(i.attrHandle, e.toLowerCase()) ? r(t, e, !g) : void 0;
                return void 0 !== s ? s : n.attributes || !g ? t.getAttribute(e) : (s = t.getAttributeNode(e)) && s.specified ? s.value : null
            }, st.escape = function(t) {
                return (t + "").replace(et, nt)
            }, st.error = function(t) {
                throw new Error("Syntax error, unrecognized expression: " + t)
            }, st.uniqueSort = function(t) {
                var e, i = [],
                    r = 0,
                    s = 0;
                if (h = !n.detectDuplicates, c = !n.sortStable && t.slice(0), t.sort(S), h) {
                    for (; e = t[s++];) e === t[s] && (r = i.push(s));
                    for (; r--;) t.splice(i[r], 1)
                }
                return c = null, t
            }, r = st.getText = function(t) {
                var e, n = "",
                    i = 0,
                    s = t.nodeType;
                if (s) {
                    if (1 === s || 9 === s || 11 === s) {
                        if ("string" == typeof t.textContent) return t.textContent;
                        for (t = t.firstChild; t; t = t.nextSibling) n += r(t)
                    } else if (3 === s || 4 === s) return t.nodeValue
                } else
                    for (; e = t[i++];) n += r(e);
                return n
            }, (i = st.selectors = {
                cacheLength: 50,
                createPseudo: at,
                match: V,
                attrHandle: {},
                find: {},
                relative: {
                    ">": {
                        dir: "parentNode",
                        first: !0
                    },
                    " ": {
                        dir: "parentNode"
                    },
                    "+": {
                        dir: "previousSibling",
                        first: !0
                    },
                    "~": {
                        dir: "previousSibling"
                    }
                },
                preFilter: {
                    ATTR: function(t) {
                        return t[1] = t[1].replace(K, tt), t[3] = (t[3] || t[4] || t[5] || "").replace(K, tt), "~=" === t[2] && (t[3] = " " + t[3] + " "), t.slice(0, 4)
                    },
                    CHILD: function(t) {
                        return t[1] = t[1].toLowerCase(), "nth" === t[1].slice(0, 3) ? (t[3] || st.error(t[0]), t[4] = +(t[4] ? t[5] + (t[6] || 1) : 2 * ("even" === t[3] || "odd" === t[3])), t[5] = +(t[7] + t[8] || "odd" === t[3])) : t[3] && st.error(t[0]), t
                    },
                    PSEUDO: function(t) {
                        var e, n = !t[6] && t[2];
                        return V.CHILD.test(t[0]) ? null : (t[3] ? t[2] = t[4] || t[5] || "" : n && U.test(n) && (e = o(n, !0)) && (e = n.indexOf(")", n.length - e) - n.length) && (t[0] = t[0].slice(0, e), t[2] = n.slice(0, e)), t.slice(0, 3))
                    }
                },
                filter: {
                    TAG: function(t) {
                        var e = t.replace(K, tt).toLowerCase();
                        return "*" === t ? function() {
                            return !0
                        } : function(t) {
                            return t.nodeName && t.nodeName.toLowerCase() === e
                        }
                    },
                    CLASS: function(t) {
                        var e = T[t + " "];
                        return e || (e = new RegExp("(^|" + H + ")" + t + "(" + H + "|$)")) && T(t, function(t) {
                            return e.test("string" == typeof t.className && t.className || "undefined" != typeof t.getAttribute && t.getAttribute("class") || "")
                        })
                    },
                    ATTR: function(t, e, n) {
                        return function(i) {
                            var r = st.attr(i, t);
                            return null == r ? "!=" === e : !e || (r += "", "=" === e ? r === n : "!=" === e ? r !== n : "^=" === e ? n && 0 === r.indexOf(n) : "*=" === e ? n && r.indexOf(n) > -1 : "$=" === e ? n && r.slice(-n.length) === n : "~=" === e ? (" " + r.replace(R, " ") + " ").indexOf(n) > -1 : "|=" === e && (r === n || r.slice(0, n.length + 1) === n + "-"))
                        }
                    },
                    CHILD: function(t, e, n, i, r) {
                        var s = "nth" !== t.slice(0, 3),
                            o = "last" !== t.slice(-4),
                            a = "of-type" === e;
                        return 1 === i && 0 === r ? function(t) {
                            return !!t.parentNode
                        } : function(e, n, l) {
                            var u, c, h, p, d, f, g = s !== o ? "nextSibling" : "previousSibling",
                                m = e.parentNode,
                                v = a && e.nodeName.toLowerCase(),
                                y = !l && !a,
                                x = !1;
                            if (m) {
                                if (s) {
                                    for (; g;) {
                                        for (p = e; p = p[g];)
                                            if (a ? p.nodeName.toLowerCase() === v : 1 === p.nodeType) return !1;
                                        f = g = "only" === t && !f && "nextSibling"
                                    }
                                    return !0
                                }
                                if (f = [o ? m.firstChild : m.lastChild], o && y) {
                                    for (x = (d = (u = (c = (h = (p = m)[w] || (p[w] = {}))[p.uniqueID] || (h[p.uniqueID] = {}))[t] || [])[0] === b && u[1]) && u[2], p = d && m.childNodes[d]; p = ++d && p && p[g] || (x = d = 0) || f.pop();)
                                        if (1 === p.nodeType && ++x && p === e) {
                                            c[t] = [b, d, x];
                                            break
                                        }
                                } else if (y && (x = d = (u = (c = (h = (p = e)[w] || (p[w] = {}))[p.uniqueID] || (h[p.uniqueID] = {}))[t] || [])[0] === b && u[1]), !1 === x)
                                    for (;
                                        (p = ++d && p && p[g] || (x = d = 0) || f.pop()) && ((a ? p.nodeName.toLowerCase() !== v : 1 !== p.nodeType) || !++x || (y && ((c = (h = p[w] || (p[w] = {}))[p.uniqueID] || (h[p.uniqueID] = {}))[t] = [b, x]), p !== e)););
                                return (x -= r) === i || x % i == 0 && x / i >= 0
                            }
                        }
                    },
                    PSEUDO: function(t, e) {
                        var n, r = i.pseudos[t] || i.setFilters[t.toLowerCase()] || st.error("unsupported pseudo: " + t);
                        return r[w] ? r(e) : r.length > 1 ? (n = [t, t, "", e], i.setFilters.hasOwnProperty(t.toLowerCase()) ? at(function(t, n) {
                            for (var i, s = r(t, e), o = s.length; o--;) t[i = q(t, s[o])] = !(n[i] = s[o])
                        }) : function(t) {
                            return r(t, 0, n)
                        }) : r
                    }
                },
                pseudos: {
                    not: at(function(t) {
                        var e = [],
                            n = [],
                            i = a(t.replace(I, "$1"));
                        return i[w] ? at(function(t, e, n, r) {
                            for (var s, o = i(t, null, r, []), a = t.length; a--;)(s = o[a]) && (t[a] = !(e[a] = s))
                        }) : function(t, r, s) {
                            return e[0] = t, i(e, null, s, n), e[0] = null, !n.pop()
                        }
                    }),
                    has: at(function(t) {
                        return function(e) {
                            return st(t, e).length > 0
                        }
                    }),
                    contains: at(function(t) {
                        return t = t.replace(K, tt),
                            function(e) {
                                return (e.textContent || e.innerText || r(e)).indexOf(t) > -1
                            }
                    }),
                    lang: at(function(t) {
                        return X.test(t || "") || st.error("unsupported lang: " + t), t = t.replace(K, tt).toLowerCase(),
                            function(e) {
                                var n;
                                do {
                                    if (n = g ? e.lang : e.getAttribute("xml:lang") || e.getAttribute("lang")) return (n = n.toLowerCase()) === t || 0 === n.indexOf(t + "-")
                                } while ((e = e.parentNode) && 1 === e.nodeType);
                                return !1
                            }
                    }),
                    target: function(e) {
                        var n = t.location && t.location.hash;
                        return n && n.slice(1) === e.id
                    },
                    root: function(t) {
                        return t === f
                    },
                    focus: function(t) {
                        return t === d.activeElement && (!d.hasFocus || d.hasFocus()) && !!(t.type || t.href || ~t.tabIndex)
                    },
                    enabled: dt(!1),
                    disabled: dt(!0),
                    checked: function(t) {
                        var e = t.nodeName.toLowerCase();
                        return "input" === e && !!t.checked || "option" === e && !!t.selected
                    },
                    selected: function(t) {
                        return !0 === t.selected
                    },
                    empty: function(t) {
                        for (t = t.firstChild; t; t = t.nextSibling)
                            if (t.nodeType < 6) return !1;
                        return !0
                    },
                    parent: function(t) {
                        return !i.pseudos.empty(t)
                    },
                    header: function(t) {
                        return G.test(t.nodeName)
                    },
                    input: function(t) {
                        return Q.test(t.nodeName)
                    },
                    button: function(t) {
                        var e = t.nodeName.toLowerCase();
                        return "input" === e && "button" === t.type || "button" === e
                    },
                    text: function(t) {
                        var e;
                        return "input" === t.nodeName.toLowerCase() && "text" === t.type && (null == (e = t.getAttribute("type")) || "text" === e.toLowerCase())
                    },
                    first: ft(function() {
                        return [0]
                    }),
                    last: ft(function(t, e) {
                        return [e - 1]
                    }),
                    eq: ft(function(t, e, n) {
                        return [n < 0 ? n + e : n]
                    }),
                    even: ft(function(t, e) {
                        for (var n = 0; n < e; n += 2) t.push(n);
                        return t
                    }),
                    odd: ft(function(t, e) {
                        for (var n = 1; n < e; n += 2) t.push(n);
                        return t
                    }),
                    lt: ft(function(t, e, n) {
                        for (var i = n < 0 ? n + e : n; --i >= 0;) t.push(i);
                        return t
                    }),
                    gt: ft(function(t, e, n) {
                        for (var i = n < 0 ? n + e : n; ++i < e;) t.push(i);
                        return t
                    })
                }
            }).pseudos.nth = i.pseudos.eq, {
                radio: !0,
                checkbox: !0,
                file: !0,
                password: !0,
                image: !0
            }) i.pseudos[e] = ht(e);
        for (e in {
                submit: !0,
                reset: !0
            }) i.pseudos[e] = pt(e);

        function mt() {}

        function vt(t) {
            for (var e = 0, n = t.length, i = ""; e < n; e++) i += t[e].value;
            return i
        }

        function yt(t, e, n) {
            var i = e.dir,
                r = e.next,
                s = r || i,
                o = n && "parentNode" === s,
                a = C++;
            return e.first ? function(e, n, r) {
                for (; e = e[i];)
                    if (1 === e.nodeType || o) return t(e, n, r);
                return !1
            } : function(e, n, l) {
                var u, c, h, p = [b, a];
                if (l) {
                    for (; e = e[i];)
                        if ((1 === e.nodeType || o) && t(e, n, l)) return !0
                } else
                    for (; e = e[i];)
                        if (1 === e.nodeType || o)
                            if (c = (h = e[w] || (e[w] = {}))[e.uniqueID] || (h[e.uniqueID] = {}), r && r === e.nodeName.toLowerCase()) e = e[i] || e;
                            else {
                                if ((u = c[s]) && u[0] === b && u[1] === a) return p[2] = u[2];
                                if (c[s] = p, p[2] = t(e, n, l)) return !0
                            } return !1
            }
        }

        function xt(t) {
            return t.length > 1 ? function(e, n, i) {
                for (var r = t.length; r--;)
                    if (!t[r](e, n, i)) return !1;
                return !0
            } : t[0]
        }

        function wt(t, e, n, i, r) {
            for (var s, o = [], a = 0, l = t.length, u = null != e; a < l; a++)(s = t[a]) && (n && !n(s, i, r) || (o.push(s), u && e.push(a)));
            return o
        }

        function _t(t, e, n, i, r, s) {
            return i && !i[w] && (i = _t(i)), r && !r[w] && (r = _t(r, s)), at(function(s, o, a, l) {
                var u, c, h, p = [],
                    d = [],
                    f = o.length,
                    g = s || function(t, e, n) {
                        for (var i = 0, r = e.length; i < r; i++) st(t, e[i], n);
                        return n
                    }(e || "*", a.nodeType ? [a] : a, []),
                    m = !t || !s && e ? g : wt(g, p, t, a, l),
                    v = n ? r || (s ? t : f || i) ? [] : o : m;
                if (n && n(m, v, a, l), i)
                    for (u = wt(v, d), i(u, [], a, l), c = u.length; c--;)(h = u[c]) && (v[d[c]] = !(m[d[c]] = h));
                if (s) {
                    if (r || t) {
                        if (r) {
                            for (u = [], c = v.length; c--;)(h = v[c]) && u.push(m[c] = h);
                            r(null, v = [], u, l)
                        }
                        for (c = v.length; c--;)(h = v[c]) && (u = r ? q(s, h) : p[c]) > -1 && (s[u] = !(o[u] = h))
                    }
                } else v = wt(v === o ? v.splice(f, v.length) : v), r ? r(null, o, v, l) : N.apply(o, v)
            })
        }

        function bt(t) {
            for (var e, n, r, s = t.length, o = i.relative[t[0].type], a = o || i.relative[" "], l = o ? 1 : 0, c = yt(function(t) {
                    return t === e
                }, a, !0), h = yt(function(t) {
                    return q(e, t) > -1
                }, a, !0), p = [function(t, n, i) {
                    var r = !o && (i || n !== u) || ((e = n).nodeType ? c(t, n, i) : h(t, n, i));
                    return e = null, r
                }]; l < s; l++)
                if (n = i.relative[t[l].type]) p = [yt(xt(p), n)];
                else {
                    if ((n = i.filter[t[l].type].apply(null, t[l].matches))[w]) {
                        for (r = ++l; r < s && !i.relative[t[r].type]; r++);
                        return _t(l > 1 && xt(p), l > 1 && vt(t.slice(0, l - 1).concat({
                            value: " " === t[l - 2].type ? "*" : ""
                        })).replace(I, "$1"), n, l < r && bt(t.slice(l, r)), r < s && bt(t = t.slice(r)), r < s && vt(t))
                    }
                    p.push(n)
                }
            return xt(p)
        }

        function Ct(t, e) {
            var n = e.length > 0,
                r = t.length > 0,
                s = function(s, o, a, l, c) {
                    var h, f, m, v = 0,
                        y = "0",
                        x = s && [],
                        w = [],
                        _ = u,
                        C = s || r && i.find.TAG("*", c),
                        T = b += null == _ ? 1 : Math.random() || .1,
                        E = C.length;
                    for (c && (u = o === d || o || c); y !== E && null != (h = C[y]); y++) {
                        if (r && h) {
                            for (f = 0, o || h.ownerDocument === d || (p(h), a = !g); m = t[f++];)
                                if (m(h, o || d, a)) {
                                    l.push(h);
                                    break
                                }
                            c && (b = T)
                        }
                        n && ((h = !m && h) && v--, s && x.push(h))
                    }
                    if (v += y, n && y !== v) {
                        for (f = 0; m = e[f++];) m(x, w, o, a);
                        if (s) {
                            if (v > 0)
                                for (; y--;) x[y] || w[y] || (w[y] = A.call(l));
                            w = wt(w)
                        }
                        N.apply(l, w), c && !s && w.length > 0 && v + e.length > 1 && st.uniqueSort(l)
                    }
                    return c && (b = T, u = _), x
                };
            return n ? at(s) : s
        }
        return mt.prototype = i.filters = i.pseudos, i.setFilters = new mt, o = st.tokenize = function(t, e) {
            var n, r, s, o, a, l, u, c = E[t + " "];
            if (c) return e ? 0 : c.slice(0);
            for (a = t, l = [], u = i.preFilter; a;) {
                for (o in n && !(r = W.exec(a)) || (r && (a = a.slice(r[0].length) || a), l.push(s = [])), n = !1, (r = B.exec(a)) && (n = r.shift(), s.push({
                        value: n,
                        type: r[0].replace(I, " ")
                    }), a = a.slice(n.length)), i.filter) !(r = V[o].exec(a)) || u[o] && !(r = u[o](r)) || (n = r.shift(), s.push({
                    value: n,
                    type: o,
                    matches: r
                }), a = a.slice(n.length));
                if (!n) break
            }
            return e ? a.length : a ? st.error(t) : E(t, l).slice(0)
        }, a = st.compile = function(t, e) {
            var n, i = [],
                r = [],
                s = D[t + " "];
            if (!s) {
                for (e || (e = o(t)), n = e.length; n--;)(s = bt(e[n]))[w] ? i.push(s) : r.push(s);
                (s = D(t, Ct(r, i))).selector = t
            }
            return s
        }, l = st.select = function(t, e, n, r) {
            var s, l, u, c, h, p = "function" == typeof t && t,
                d = !r && o(t = p.selector || t);
            if (n = n || [], 1 === d.length) {
                if ((l = d[0] = d[0].slice(0)).length > 2 && "ID" === (u = l[0]).type && 9 === e.nodeType && g && i.relative[l[1].type]) {
                    if (!(e = (i.find.ID(u.matches[0].replace(K, tt), e) || [])[0])) return n;
                    p && (e = e.parentNode), t = t.slice(l.shift().value.length)
                }
                for (s = V.needsContext.test(t) ? 0 : l.length; s-- && !i.relative[c = (u = l[s]).type];)
                    if ((h = i.find[c]) && (r = h(u.matches[0].replace(K, tt), J.test(l[0].type) && gt(e.parentNode) || e))) {
                        if (l.splice(s, 1), !(t = r.length && vt(l))) return N.apply(n, r), n;
                        break
                    }
            }
            return (p || a(t, d))(r, e, !g, n, !e || J.test(t) && gt(e.parentNode) || e), n
        }, n.sortStable = w.split("").sort(S).join("") === w, n.detectDuplicates = !!h, p(), n.sortDetached = lt(function(t) {
            return 1 & t.compareDocumentPosition(d.createElement("fieldset"))
        }), lt(function(t) {
            return t.innerHTML = "<a href='#'></a>", "#" === t.firstChild.getAttribute("href")
        }) || ut("type|href|height|width", function(t, e, n) {
            if (!n) return t.getAttribute(e, "type" === e.toLowerCase() ? 1 : 2)
        }), n.attributes && lt(function(t) {
            return t.innerHTML = "<input/>", t.firstChild.setAttribute("value", ""), "" === t.firstChild.getAttribute("value")
        }) || ut("value", function(t, e, n) {
            if (!n && "input" === t.nodeName.toLowerCase()) return t.defaultValue
        }), lt(function(t) {
            return null == t.getAttribute("disabled")
        }) || ut(z, function(t, e, n) {
            var i;
            if (!n) return !0 === t[e] ? e.toLowerCase() : (i = t.getAttributeNode(e)) && i.specified ? i.value : null
        }), st
    }(t);
    w.find = C, w.expr = C.selectors, w.expr[":"] = w.expr.pseudos, w.uniqueSort = w.unique = C.uniqueSort, w.text = C.getText, w.isXMLDoc = C.isXML, w.contains = C.contains, w.escapeSelector = C.escape;
    var T = function(t, e, n) {
            for (var i = [], r = void 0 !== n;
                (t = t[e]) && 9 !== t.nodeType;)
                if (1 === t.nodeType) {
                    if (r && w(t).is(n)) break;
                    i.push(t)
                }
            return i
        },
        E = function(t, e) {
            for (var n = []; t; t = t.nextSibling) 1 === t.nodeType && t !== e && n.push(t);
            return n
        },
        D = w.expr.match.needsContext;

    function S(t, e) {
        return t.nodeName && t.nodeName.toLowerCase() === e.toLowerCase()
    }
    var k = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;

    function j(t, e, n) {
        return g(e) ? w.grep(t, function(t, i) {
            return !!e.call(t, i, t) !== n
        }) : e.nodeType ? w.grep(t, function(t) {
            return t === e !== n
        }) : "string" != typeof e ? w.grep(t, function(t) {
            return l.call(e, t) > -1 !== n
        }) : w.filter(e, t, n)
    }
    w.filter = function(t, e, n) {
        var i = e[0];
        return n && (t = ":not(" + t + ")"), 1 === e.length && 1 === i.nodeType ? w.find.matchesSelector(i, t) ? [i] : [] : w.find.matches(t, w.grep(e, function(t) {
            return 1 === t.nodeType
        }))
    }, w.fn.extend({
        find: function(t) {
            var e, n, i = this.length,
                r = this;
            if ("string" != typeof t) return this.pushStack(w(t).filter(function() {
                for (e = 0; e < i; e++)
                    if (w.contains(r[e], this)) return !0
            }));
            for (n = this.pushStack([]), e = 0; e < i; e++) w.find(t, r[e], n);
            return i > 1 ? w.uniqueSort(n) : n
        },
        filter: function(t) {
            return this.pushStack(j(this, t || [], !1))
        },
        not: function(t) {
            return this.pushStack(j(this, t || [], !0))
        },
        is: function(t) {
            return !!j(this, "string" == typeof t && D.test(t) ? w(t) : t || [], !1).length
        }
    });
    var A, $ = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
    (w.fn.init = function(t, e, n) {
        var r, s;
        if (!t) return this;
        if (n = n || A, "string" == typeof t) {
            if (!(r = "<" === t[0] && ">" === t[t.length - 1] && t.length >= 3 ? [null, t, null] : $.exec(t)) || !r[1] && e) return !e || e.jquery ? (e || n).find(t) : this.constructor(e).find(t);
            if (r[1]) {
                if (w.merge(this, w.parseHTML(r[1], (e = e instanceof w ? e[0] : e) && e.nodeType ? e.ownerDocument || e : i, !0)), k.test(r[1]) && w.isPlainObject(e))
                    for (r in e) g(this[r]) ? this[r](e[r]) : this.attr(r, e[r]);
                return this
            }
            return (s = i.getElementById(r[2])) && (this[0] = s, this.length = 1), this
        }
        return t.nodeType ? (this[0] = t, this.length = 1, this) : g(t) ? void 0 !== n.ready ? n.ready(t) : t(w) : w.makeArray(t, this)
    }).prototype = w.fn, A = w(i);
    var N = /^(?:parents|prev(?:Until|All))/,
        L = {
            children: !0,
            contents: !0,
            next: !0,
            prev: !0
        };

    function q(t, e) {
        for (;
            (t = t[e]) && 1 !== t.nodeType;);
        return t
    }
    w.fn.extend({
        has: function(t) {
            var e = w(t, this),
                n = e.length;
            return this.filter(function() {
                for (var t = 0; t < n; t++)
                    if (w.contains(this, e[t])) return !0
            })
        },
        closest: function(t, e) {
            var n, i = 0,
                r = this.length,
                s = [],
                o = "string" != typeof t && w(t);
            if (!D.test(t))
                for (; i < r; i++)
                    for (n = this[i]; n && n !== e; n = n.parentNode)
                        if (n.nodeType < 11 && (o ? o.index(n) > -1 : 1 === n.nodeType && w.find.matchesSelector(n, t))) {
                            s.push(n);
                            break
                        }
            return this.pushStack(s.length > 1 ? w.uniqueSort(s) : s)
        },
        index: function(t) {
            return t ? "string" == typeof t ? l.call(w(t), this[0]) : l.call(this, t.jquery ? t[0] : t) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        },
        add: function(t, e) {
            return this.pushStack(w.uniqueSort(w.merge(this.get(), w(t, e))))
        },
        addBack: function(t) {
            return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
        }
    }), w.each({
        parent: function(t) {
            var e = t.parentNode;
            return e && 11 !== e.nodeType ? e : null
        },
        parents: function(t) {
            return T(t, "parentNode")
        },
        parentsUntil: function(t, e, n) {
            return T(t, "parentNode", n)
        },
        next: function(t) {
            return q(t, "nextSibling")
        },
        prev: function(t) {
            return q(t, "previousSibling")
        },
        nextAll: function(t) {
            return T(t, "nextSibling")
        },
        prevAll: function(t) {
            return T(t, "previousSibling")
        },
        nextUntil: function(t, e, n) {
            return T(t, "nextSibling", n)
        },
        prevUntil: function(t, e, n) {
            return T(t, "previousSibling", n)
        },
        siblings: function(t) {
            return E((t.parentNode || {}).firstChild, t)
        },
        children: function(t) {
            return E(t.firstChild)
        },
        contents: function(t) {
            return S(t, "iframe") ? t.contentDocument : (S(t, "template") && (t = t.content || t), w.merge([], t.childNodes))
        }
    }, function(t, e) {
        w.fn[t] = function(n, i) {
            var r = w.map(this, e, n);
            return "Until" !== t.slice(-5) && (i = n), i && "string" == typeof i && (r = w.filter(i, r)), this.length > 1 && (L[t] || w.uniqueSort(r), N.test(t) && r.reverse()), this.pushStack(r)
        }
    });
    var z = /[^\x20\t\r\n\f]+/g;

    function H(t) {
        return t
    }

    function P(t) {
        throw t
    }

    function O(t, e, n, i) {
        var r;
        try {
            t && g(r = t.promise) ? r.call(t).done(e).fail(n) : t && g(r = t.then) ? r.call(t, e, n) : e.apply(void 0, [t].slice(i))
        } catch (t) {
            n.apply(void 0, [t])
        }
    }
    w.Callbacks = function(t) {
        t = "string" == typeof t ? function(t) {
            var e = {};
            return w.each(t.match(z) || [], function(t, n) {
                e[n] = !0
            }), e
        }(t) : w.extend({}, t);
        var e, n, i, r, s = [],
            o = [],
            a = -1,
            l = function() {
                for (r = r || t.once, i = e = !0; o.length; a = -1)
                    for (n = o.shift(); ++a < s.length;) !1 === s[a].apply(n[0], n[1]) && t.stopOnFalse && (a = s.length, n = !1);
                t.memory || (n = !1), e = !1, r && (s = n ? [] : "")
            },
            u = {
                add: function() {
                    return s && (n && !e && (a = s.length - 1, o.push(n)), function e(n) {
                        w.each(n, function(n, i) {
                            g(i) ? t.unique && u.has(i) || s.push(i) : i && i.length && "string" !== x(i) && e(i)
                        })
                    }(arguments), n && !e && l()), this
                },
                remove: function() {
                    return w.each(arguments, function(t, e) {
                        for (var n;
                            (n = w.inArray(e, s, n)) > -1;) s.splice(n, 1), n <= a && a--
                    }), this
                },
                has: function(t) {
                    return t ? w.inArray(t, s) > -1 : s.length > 0
                },
                empty: function() {
                    return s && (s = []), this
                },
                disable: function() {
                    return r = o = [], s = n = "", this
                },
                disabled: function() {
                    return !s
                },
                lock: function() {
                    return r = o = [], n || e || (s = n = ""), this
                },
                locked: function() {
                    return !!r
                },
                fireWith: function(t, n) {
                    return r || (n = [t, (n = n || []).slice ? n.slice() : n], o.push(n), e || l()), this
                },
                fire: function() {
                    return u.fireWith(this, arguments), this
                },
                fired: function() {
                    return !!i
                }
            };
        return u
    }, w.extend({
        Deferred: function(e) {
            var n = [
                    ["notify", "progress", w.Callbacks("memory"), w.Callbacks("memory"), 2],
                    ["resolve", "done", w.Callbacks("once memory"), w.Callbacks("once memory"), 0, "resolved"],
                    ["reject", "fail", w.Callbacks("once memory"), w.Callbacks("once memory"), 1, "rejected"]
                ],
                i = "pending",
                r = {
                    state: function() {
                        return i
                    },
                    always: function() {
                        return s.done(arguments).fail(arguments), this
                    },
                    catch: function(t) {
                        return r.then(null, t)
                    },
                    pipe: function() {
                        var t = arguments;
                        return w.Deferred(function(e) {
                            w.each(n, function(n, i) {
                                var r = g(t[i[4]]) && t[i[4]];
                                s[i[1]](function() {
                                    var t = r && r.apply(this, arguments);
                                    t && g(t.promise) ? t.promise().progress(e.notify).done(e.resolve).fail(e.reject) : e[i[0] + "With"](this, r ? [t] : arguments)
                                })
                            }), t = null
                        }).promise()
                    },
                    then: function(e, i, r) {
                        var s = 0;

                        function o(e, n, i, r) {
                            return function() {
                                var a = this,
                                    l = arguments,
                                    u = function() {
                                        var t, u;
                                        if (!(e < s)) {
                                            if ((t = i.apply(a, l)) === n.promise()) throw new TypeError("Thenable self-resolution");
                                            g(u = t && ("object" == typeof t || "function" == typeof t) && t.then) ? r ? u.call(t, o(s, n, H, r), o(s, n, P, r)) : u.call(t, o(++s, n, H, r), o(s, n, P, r), o(s, n, H, n.notifyWith)) : (i !== H && (a = void 0, l = [t]), (r || n.resolveWith)(a, l))
                                        }
                                    },
                                    c = r ? u : function() {
                                        try {
                                            u()
                                        } catch (t) {
                                            w.Deferred.exceptionHook && w.Deferred.exceptionHook(t, c.stackTrace), e + 1 >= s && (i !== P && (a = void 0, l = [t]), n.rejectWith(a, l))
                                        }
                                    };
                                e ? c() : (w.Deferred.getStackHook && (c.stackTrace = w.Deferred.getStackHook()), t.setTimeout(c))
                            }
                        }
                        return w.Deferred(function(t) {
                            n[0][3].add(o(0, t, g(r) ? r : H, t.notifyWith)), n[1][3].add(o(0, t, g(e) ? e : H)), n[2][3].add(o(0, t, g(i) ? i : P))
                        }).promise()
                    },
                    promise: function(t) {
                        return null != t ? w.extend(t, r) : r
                    }
                },
                s = {};
            return w.each(n, function(t, e) {
                var o = e[2],
                    a = e[5];
                r[e[1]] = o.add, a && o.add(function() {
                    i = a
                }, n[3 - t][2].disable, n[3 - t][3].disable, n[0][2].lock, n[0][3].lock), o.add(e[3].fire), s[e[0]] = function() {
                    return s[e[0] + "With"](this === s ? void 0 : this, arguments), this
                }, s[e[0] + "With"] = o.fireWith
            }), r.promise(s), e && e.call(s, s), s
        },
        when: function(t) {
            var e = arguments.length,
                n = e,
                i = Array(n),
                r = s.call(arguments),
                o = w.Deferred(),
                a = function(t) {
                    return function(n) {
                        i[t] = this, r[t] = arguments.length > 1 ? s.call(arguments) : n, --e || o.resolveWith(i, r)
                    }
                };
            if (e <= 1 && (O(t, o.done(a(n)).resolve, o.reject, !e), "pending" === o.state() || g(r[n] && r[n].then))) return o.then();
            for (; n--;) O(r[n], a(n), o.reject);
            return o.promise()
        }
    });
    var M = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
    w.Deferred.exceptionHook = function(e, n) {
        t.console && t.console.warn && e && M.test(e.name) && t.console.warn("jQuery.Deferred exception: " + e.message, e.stack, n)
    }, w.readyException = function(e) {
        t.setTimeout(function() {
            throw e
        })
    };
    var R = w.Deferred();

    function I() {
        i.removeEventListener("DOMContentLoaded", I), t.removeEventListener("load", I), w.ready()
    }
    w.fn.ready = function(t) {
        return R.then(t).catch(function(t) {
            w.readyException(t)
        }), this
    }, w.extend({
        isReady: !1,
        readyWait: 1,
        ready: function(t) {
            (!0 === t ? --w.readyWait : w.isReady) || (w.isReady = !0, !0 !== t && --w.readyWait > 0 || R.resolveWith(i, [w]))
        }
    }), w.ready.then = R.then, "complete" === i.readyState || "loading" !== i.readyState && !i.documentElement.doScroll ? t.setTimeout(w.ready) : (i.addEventListener("DOMContentLoaded", I), t.addEventListener("load", I));
    var W = function(t, e, n, i, r, s, o) {
            var a = 0,
                l = t.length,
                u = null == n;
            if ("object" === x(n))
                for (a in r = !0, n) W(t, e, a, n[a], !0, s, o);
            else if (void 0 !== i && (r = !0, g(i) || (o = !0), u && (o ? (e.call(t, i), e = null) : (u = e, e = function(t, e, n) {
                    return u.call(w(t), n)
                })), e))
                for (; a < l; a++) e(t[a], n, o ? i : i.call(t[a], a, e(t[a], n)));
            return r ? t : u ? e.call(t) : l ? e(t[0], n) : s
        },
        B = /^-ms-/,
        F = /-([a-z])/g;

    function U(t, e) {
        return e.toUpperCase()
    }

    function X(t) {
        return t.replace(B, "ms-").replace(F, U)
    }
    var V = function(t) {
        return 1 === t.nodeType || 9 === t.nodeType || !+t.nodeType
    };

    function Q() {
        this.expando = w.expando + Q.uid++
    }
    Q.uid = 1, Q.prototype = {
        cache: function(t) {
            var e = t[this.expando];
            return e || (e = {}, V(t) && (t.nodeType ? t[this.expando] = e : Object.defineProperty(t, this.expando, {
                value: e,
                configurable: !0
            }))), e
        },
        set: function(t, e, n) {
            var i, r = this.cache(t);
            if ("string" == typeof e) r[X(e)] = n;
            else
                for (i in e) r[X(i)] = e[i];
            return r
        },
        get: function(t, e) {
            return void 0 === e ? this.cache(t) : t[this.expando] && t[this.expando][X(e)]
        },
        access: function(t, e, n) {
            return void 0 === e || e && "string" == typeof e && void 0 === n ? this.get(t, e) : (this.set(t, e, n), void 0 !== n ? n : e)
        },
        remove: function(t, e) {
            var n, i = t[this.expando];
            if (void 0 !== i) {
                if (void 0 !== e) {
                    n = (e = Array.isArray(e) ? e.map(X) : (e = X(e)) in i ? [e] : e.match(z) || []).length;
                    for (; n--;) delete i[e[n]]
                }(void 0 === e || w.isEmptyObject(i)) && (t.nodeType ? t[this.expando] = void 0 : delete t[this.expando])
            }
        },
        hasData: function(t) {
            var e = t[this.expando];
            return void 0 !== e && !w.isEmptyObject(e)
        }
    };
    var G = new Q,
        Y = new Q,
        Z = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
        J = /[A-Z]/g;

    function K(t, e, n) {
        var i;
        if (void 0 === n && 1 === t.nodeType)
            if (i = "data-" + e.replace(J, "-$&").toLowerCase(), "string" == typeof(n = t.getAttribute(i))) {
                try {
                    n = function(t) {
                        return "true" === t || "false" !== t && ("null" === t ? null : t === +t + "" ? +t : Z.test(t) ? JSON.parse(t) : t)
                    }(n)
                } catch (t) {}
                Y.set(t, e, n)
            } else n = void 0;
        return n
    }
    w.extend({
        hasData: function(t) {
            return Y.hasData(t) || G.hasData(t)
        },
        data: function(t, e, n) {
            return Y.access(t, e, n)
        },
        removeData: function(t, e) {
            Y.remove(t, e)
        },
        _data: function(t, e, n) {
            return G.access(t, e, n)
        },
        _removeData: function(t, e) {
            G.remove(t, e)
        }
    }), w.fn.extend({
        data: function(t, e) {
            var n, i, r, s = this[0],
                o = s && s.attributes;
            if (void 0 === t) {
                if (this.length && (r = Y.get(s), 1 === s.nodeType && !G.get(s, "hasDataAttrs"))) {
                    for (n = o.length; n--;) o[n] && 0 === (i = o[n].name).indexOf("data-") && (i = X(i.slice(5)), K(s, i, r[i]));
                    G.set(s, "hasDataAttrs", !0)
                }
                return r
            }
            return "object" == typeof t ? this.each(function() {
                Y.set(this, t)
            }) : W(this, function(e) {
                var n;
                if (s && void 0 === e) {
                    if (void 0 !== (n = Y.get(s, t))) return n;
                    if (void 0 !== (n = K(s, t))) return n
                } else this.each(function() {
                    Y.set(this, t, e)
                })
            }, null, e, arguments.length > 1, null, !0)
        },
        removeData: function(t) {
            return this.each(function() {
                Y.remove(this, t)
            })
        }
    }), w.extend({
        queue: function(t, e, n) {
            var i;
            if (t) return i = G.get(t, e = (e || "fx") + "queue"), n && (!i || Array.isArray(n) ? i = G.access(t, e, w.makeArray(n)) : i.push(n)), i || []
        },
        dequeue: function(t, e) {
            var n = w.queue(t, e = e || "fx"),
                i = n.length,
                r = n.shift(),
                s = w._queueHooks(t, e);
            "inprogress" === r && (r = n.shift(), i--), r && ("fx" === e && n.unshift("inprogress"), delete s.stop, r.call(t, function() {
                w.dequeue(t, e)
            }, s)), !i && s && s.empty.fire()
        },
        _queueHooks: function(t, e) {
            var n = e + "queueHooks";
            return G.get(t, n) || G.access(t, n, {
                empty: w.Callbacks("once memory").add(function() {
                    G.remove(t, [e + "queue", n])
                })
            })
        }
    }), w.fn.extend({
        queue: function(t, e) {
            var n = 2;
            return "string" != typeof t && (e = t, t = "fx", n--), arguments.length < n ? w.queue(this[0], t) : void 0 === e ? this : this.each(function() {
                var n = w.queue(this, t, e);
                w._queueHooks(this, t), "fx" === t && "inprogress" !== n[0] && w.dequeue(this, t)
            })
        },
        dequeue: function(t) {
            return this.each(function() {
                w.dequeue(this, t)
            })
        },
        clearQueue: function(t) {
            return this.queue(t || "fx", [])
        },
        promise: function(t, e) {
            var n, i = 1,
                r = w.Deferred(),
                s = this,
                o = this.length,
                a = function() {
                    --i || r.resolveWith(s, [s])
                };
            for ("string" != typeof t && (e = t, t = void 0), t = t || "fx"; o--;)(n = G.get(s[o], t + "queueHooks")) && n.empty && (i++, n.empty.add(a));
            return a(), r.promise(e)
        }
    });
    var tt = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        et = new RegExp("^(?:([+-])=|)(" + tt + ")([a-z%]*)$", "i"),
        nt = ["Top", "Right", "Bottom", "Left"],
        it = function(t, e) {
            return "none" === (t = e || t).style.display || "" === t.style.display && w.contains(t.ownerDocument, t) && "none" === w.css(t, "display")
        },
        rt = function(t, e, n, i) {
            var r, s, o = {};
            for (s in e) o[s] = t.style[s], t.style[s] = e[s];
            for (s in r = n.apply(t, i || []), e) t.style[s] = o[s];
            return r
        };

    function st(t, e, n, i) {
        var r, s, o = 20,
            a = i ? function() {
                return i.cur()
            } : function() {
                return w.css(t, e, "")
            },
            l = a(),
            u = n && n[3] || (w.cssNumber[e] ? "" : "px"),
            c = (w.cssNumber[e] || "px" !== u && +l) && et.exec(w.css(t, e));
        if (c && c[3] !== u) {
            for (l /= 2, u = u || c[3], c = +l || 1; o--;) w.style(t, e, c + u), (1 - s) * (1 - (s = a() / l || .5)) <= 0 && (o = 0), c /= s;
            w.style(t, e, (c *= 2) + u), n = n || []
        }
        return n && (c = +c || +l || 0, r = n[1] ? c + (n[1] + 1) * n[2] : +n[2], i && (i.unit = u, i.start = c, i.end = r)), r
    }
    var ot = {};

    function at(t) {
        var e, n = t.ownerDocument,
            i = t.nodeName,
            r = ot[i];
        return r || (e = n.body.appendChild(n.createElement(i)), r = w.css(e, "display"), e.parentNode.removeChild(e), "none" === r && (r = "block"), ot[i] = r, r)
    }

    function lt(t, e) {
        for (var n, i, r = [], s = 0, o = t.length; s < o; s++)(i = t[s]).style && (n = i.style.display, e ? ("none" === n && (r[s] = G.get(i, "display") || null, r[s] || (i.style.display = "")), "" === i.style.display && it(i) && (r[s] = at(i))) : "none" !== n && (r[s] = "none", G.set(i, "display", n)));
        for (s = 0; s < o; s++) null != r[s] && (t[s].style.display = r[s]);
        return t
    }
    w.fn.extend({
        show: function() {
            return lt(this, !0)
        },
        hide: function() {
            return lt(this)
        },
        toggle: function(t) {
            return "boolean" == typeof t ? t ? this.show() : this.hide() : this.each(function() {
                it(this) ? w(this).show() : w(this).hide()
            })
        }
    });
    var ut = /^(?:checkbox|radio)$/i,
        ct = /<([a-z][^\/\0>\x20\t\r\n\f]+)/i,
        ht = /^$|^module$|\/(?:java|ecma)script/i,
        pt = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            thead: [1, "<table>", "</table>"],
            col: [2, "<table><colgroup>", "</colgroup></table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: [0, "", ""]
        };

    function dt(t, e) {
        var n;
        return n = "undefined" != typeof t.getElementsByTagName ? t.getElementsByTagName(e || "*") : "undefined" != typeof t.querySelectorAll ? t.querySelectorAll(e || "*") : [], void 0 === e || e && S(t, e) ? w.merge([t], n) : n
    }

    function ft(t, e) {
        for (var n = 0, i = t.length; n < i; n++) G.set(t[n], "globalEval", !e || G.get(e[n], "globalEval"))
    }
    pt.optgroup = pt.option, pt.tbody = pt.tfoot = pt.colgroup = pt.caption = pt.thead, pt.th = pt.td;
    var gt = /<|&#?\w+;/;

    function mt(t, e, n, i, r) {
        for (var s, o, a, l, u, c, h = e.createDocumentFragment(), p = [], d = 0, f = t.length; d < f; d++)
            if ((s = t[d]) || 0 === s)
                if ("object" === x(s)) w.merge(p, s.nodeType ? [s] : s);
                else if (gt.test(s)) {
            for (o = o || h.appendChild(e.createElement("div")), a = (ct.exec(s) || ["", ""])[1].toLowerCase(), o.innerHTML = (l = pt[a] || pt._default)[1] + w.htmlPrefilter(s) + l[2], c = l[0]; c--;) o = o.lastChild;
            w.merge(p, o.childNodes), (o = h.firstChild).textContent = ""
        } else p.push(e.createTextNode(s));
        for (h.textContent = "", d = 0; s = p[d++];)
            if (i && w.inArray(s, i) > -1) r && r.push(s);
            else if (u = w.contains(s.ownerDocument, s), o = dt(h.appendChild(s), "script"), u && ft(o), n)
            for (c = 0; s = o[c++];) ht.test(s.type || "") && n.push(s);
        return h
    }! function() {
        var t = i.createDocumentFragment().appendChild(i.createElement("div")),
            e = i.createElement("input");
        e.setAttribute("type", "radio"), e.setAttribute("checked", "checked"), e.setAttribute("name", "t"), t.appendChild(e), f.checkClone = t.cloneNode(!0).cloneNode(!0).lastChild.checked, t.innerHTML = "<textarea>x</textarea>", f.noCloneChecked = !!t.cloneNode(!0).lastChild.defaultValue
    }();
    var vt = i.documentElement,
        yt = /^key/,
        xt = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
        wt = /^([^.]*)(?:\.(.+)|)/;

    function _t() {
        return !0
    }

    function bt() {
        return !1
    }

    function Ct() {
        try {
            return i.activeElement
        } catch (t) {}
    }

    function Tt(t, e, n, i, r, s) {
        var o, a;
        if ("object" == typeof e) {
            for (a in "string" != typeof n && (i = i || n, n = void 0), e) Tt(t, a, n, i, e[a], s);
            return t
        }
        if (null == i && null == r ? (r = n, i = n = void 0) : null == r && ("string" == typeof n ? (r = i, i = void 0) : (r = i, i = n, n = void 0)), !1 === r) r = bt;
        else if (!r) return t;
        return 1 === s && (o = r, (r = function(t) {
            return w().off(t), o.apply(this, arguments)
        }).guid = o.guid || (o.guid = w.guid++)), t.each(function() {
            w.event.add(this, e, r, i, n)
        })
    }
    w.event = {
        global: {},
        add: function(t, e, n, i, r) {
            var s, o, a, l, u, c, h, p, d, f, g, m = G.get(t);
            if (m)
                for (n.handler && (n = (s = n).handler, r = s.selector), r && w.find.matchesSelector(vt, r), n.guid || (n.guid = w.guid++), (l = m.events) || (l = m.events = {}), (o = m.handle) || (o = m.handle = function(e) {
                        return "undefined" != typeof w && w.event.triggered !== e.type ? w.event.dispatch.apply(t, arguments) : void 0
                    }), u = (e = (e || "").match(z) || [""]).length; u--;) d = g = (a = wt.exec(e[u]) || [])[1], f = (a[2] || "").split(".").sort(), d && (h = w.event.special[d] || {}, h = w.event.special[d = (r ? h.delegateType : h.bindType) || d] || {}, c = w.extend({
                    type: d,
                    origType: g,
                    data: i,
                    handler: n,
                    guid: n.guid,
                    selector: r,
                    needsContext: r && w.expr.match.needsContext.test(r),
                    namespace: f.join(".")
                }, s), (p = l[d]) || ((p = l[d] = []).delegateCount = 0, h.setup && !1 !== h.setup.call(t, i, f, o) || t.addEventListener && t.addEventListener(d, o)), h.add && (h.add.call(t, c), c.handler.guid || (c.handler.guid = n.guid)), r ? p.splice(p.delegateCount++, 0, c) : p.push(c), w.event.global[d] = !0)
        },
        remove: function(t, e, n, i, r) {
            var s, o, a, l, u, c, h, p, d, f, g, m = G.hasData(t) && G.get(t);
            if (m && (l = m.events)) {
                for (u = (e = (e || "").match(z) || [""]).length; u--;)
                    if (d = g = (a = wt.exec(e[u]) || [])[1], f = (a[2] || "").split(".").sort(), d) {
                        for (h = w.event.special[d] || {}, p = l[d = (i ? h.delegateType : h.bindType) || d] || [], a = a[2] && new RegExp("(^|\\.)" + f.join("\\.(?:.*\\.|)") + "(\\.|$)"), o = s = p.length; s--;) c = p[s], !r && g !== c.origType || n && n.guid !== c.guid || a && !a.test(c.namespace) || i && i !== c.selector && ("**" !== i || !c.selector) || (p.splice(s, 1), c.selector && p.delegateCount--, h.remove && h.remove.call(t, c));
                        o && !p.length && (h.teardown && !1 !== h.teardown.call(t, f, m.handle) || w.removeEvent(t, d, m.handle), delete l[d])
                    } else
                        for (d in l) w.event.remove(t, d + e[u], n, i, !0);
                w.isEmptyObject(l) && G.remove(t, "handle events")
            }
        },
        dispatch: function(t) {
            var e, n, i, r, s, o, a = w.event.fix(t),
                l = new Array(arguments.length),
                u = (G.get(this, "events") || {})[a.type] || [],
                c = w.event.special[a.type] || {};
            for (l[0] = a, e = 1; e < arguments.length; e++) l[e] = arguments[e];
            if (a.delegateTarget = this, !c.preDispatch || !1 !== c.preDispatch.call(this, a)) {
                for (o = w.event.handlers.call(this, a, u), e = 0;
                    (r = o[e++]) && !a.isPropagationStopped();)
                    for (a.currentTarget = r.elem, n = 0;
                        (s = r.handlers[n++]) && !a.isImmediatePropagationStopped();) a.rnamespace && !a.rnamespace.test(s.namespace) || (a.handleObj = s, a.data = s.data, void 0 !== (i = ((w.event.special[s.origType] || {}).handle || s.handler).apply(r.elem, l)) && !1 === (a.result = i) && (a.preventDefault(), a.stopPropagation()));
                return c.postDispatch && c.postDispatch.call(this, a), a.result
            }
        },
        handlers: function(t, e) {
            var n, i, r, s, o, a = [],
                l = e.delegateCount,
                u = t.target;
            if (l && u.nodeType && !("click" === t.type && t.button >= 1))
                for (; u !== this; u = u.parentNode || this)
                    if (1 === u.nodeType && ("click" !== t.type || !0 !== u.disabled)) {
                        for (s = [], o = {}, n = 0; n < l; n++) void 0 === o[r = (i = e[n]).selector + " "] && (o[r] = i.needsContext ? w(r, this).index(u) > -1 : w.find(r, this, null, [u]).length), o[r] && s.push(i);
                        s.length && a.push({
                            elem: u,
                            handlers: s
                        })
                    }
            return u = this, l < e.length && a.push({
                elem: u,
                handlers: e.slice(l)
            }), a
        },
        addProp: function(t, e) {
            Object.defineProperty(w.Event.prototype, t, {
                enumerable: !0,
                configurable: !0,
                get: g(e) ? function() {
                    if (this.originalEvent) return e(this.originalEvent)
                } : function() {
                    if (this.originalEvent) return this.originalEvent[t]
                },
                set: function(e) {
                    Object.defineProperty(this, t, {
                        enumerable: !0,
                        configurable: !0,
                        writable: !0,
                        value: e
                    })
                }
            })
        },
        fix: function(t) {
            return t[w.expando] ? t : new w.Event(t)
        },
        special: {
            load: {
                noBubble: !0
            },
            focus: {
                trigger: function() {
                    if (this !== Ct() && this.focus) return this.focus(), !1
                },
                delegateType: "focusin"
            },
            blur: {
                trigger: function() {
                    if (this === Ct() && this.blur) return this.blur(), !1
                },
                delegateType: "focusout"
            },
            click: {
                trigger: function() {
                    if ("checkbox" === this.type && this.click && S(this, "input")) return this.click(), !1
                },
                _default: function(t) {
                    return S(t.target, "a")
                }
            },
            beforeunload: {
                postDispatch: function(t) {
                    void 0 !== t.result && t.originalEvent && (t.originalEvent.returnValue = t.result)
                }
            }
        }
    }, w.removeEvent = function(t, e, n) {
        t.removeEventListener && t.removeEventListener(e, n)
    }, w.Event = function(t, e) {
        if (!(this instanceof w.Event)) return new w.Event(t, e);
        t && t.type ? (this.originalEvent = t, this.type = t.type, this.isDefaultPrevented = t.defaultPrevented || void 0 === t.defaultPrevented && !1 === t.returnValue ? _t : bt, this.target = t.target && 3 === t.target.nodeType ? t.target.parentNode : t.target, this.currentTarget = t.currentTarget, this.relatedTarget = t.relatedTarget) : this.type = t, e && w.extend(this, e), this.timeStamp = t && t.timeStamp || Date.now(), this[w.expando] = !0
    }, w.Event.prototype = {
        constructor: w.Event,
        isDefaultPrevented: bt,
        isPropagationStopped: bt,
        isImmediatePropagationStopped: bt,
        isSimulated: !1,
        preventDefault: function() {
            var t = this.originalEvent;
            this.isDefaultPrevented = _t, t && !this.isSimulated && t.preventDefault()
        },
        stopPropagation: function() {
            var t = this.originalEvent;
            this.isPropagationStopped = _t, t && !this.isSimulated && t.stopPropagation()
        },
        stopImmediatePropagation: function() {
            var t = this.originalEvent;
            this.isImmediatePropagationStopped = _t, t && !this.isSimulated && t.stopImmediatePropagation(), this.stopPropagation()
        }
    }, w.each({
        altKey: !0,
        bubbles: !0,
        cancelable: !0,
        changedTouches: !0,
        ctrlKey: !0,
        detail: !0,
        eventPhase: !0,
        metaKey: !0,
        pageX: !0,
        pageY: !0,
        shiftKey: !0,
        view: !0,
        char: !0,
        charCode: !0,
        key: !0,
        keyCode: !0,
        button: !0,
        buttons: !0,
        clientX: !0,
        clientY: !0,
        offsetX: !0,
        offsetY: !0,
        pointerId: !0,
        pointerType: !0,
        screenX: !0,
        screenY: !0,
        targetTouches: !0,
        toElement: !0,
        touches: !0,
        which: function(t) {
            var e = t.button;
            return null == t.which && yt.test(t.type) ? null != t.charCode ? t.charCode : t.keyCode : !t.which && void 0 !== e && xt.test(t.type) ? 1 & e ? 1 : 2 & e ? 3 : 4 & e ? 2 : 0 : t.which
        }
    }, w.event.addProp), w.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function(t, e) {
        w.event.special[t] = {
            delegateType: e,
            bindType: e,
            handle: function(t) {
                var n, i = t.relatedTarget,
                    r = t.handleObj;
                return i && (i === this || w.contains(this, i)) || (t.type = r.origType, n = r.handler.apply(this, arguments), t.type = e), n
            }
        }
    }), w.fn.extend({
        on: function(t, e, n, i) {
            return Tt(this, t, e, n, i)
        },
        one: function(t, e, n, i) {
            return Tt(this, t, e, n, i, 1)
        },
        off: function(t, e, n) {
            var i, r;
            if (t && t.preventDefault && t.handleObj) return i = t.handleObj, w(t.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
            if ("object" == typeof t) {
                for (r in t) this.off(r, e, t[r]);
                return this
            }
            return !1 !== e && "function" != typeof e || (n = e, e = void 0), !1 === n && (n = bt), this.each(function() {
                w.event.remove(this, t, n, e)
            })
        }
    });
    var Et = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,
        Dt = /<script|<style|<link/i,
        St = /checked\s*(?:[^=]|=\s*.checked.)/i,
        kt = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;

    function jt(t, e) {
        return S(t, "table") && S(11 !== e.nodeType ? e : e.firstChild, "tr") && w(t).children("tbody")[0] || t
    }

    function At(t) {
        return t.type = (null !== t.getAttribute("type")) + "/" + t.type, t
    }

    function $t(t) {
        return "true/" === (t.type || "").slice(0, 5) ? t.type = t.type.slice(5) : t.removeAttribute("type"), t
    }

    function Nt(t, e) {
        var n, i, r, s, o, a, l, u;
        if (1 === e.nodeType) {
            if (G.hasData(t) && (s = G.access(t), o = G.set(e, s), u = s.events))
                for (r in delete o.handle, o.events = {}, u)
                    for (n = 0, i = u[r].length; n < i; n++) w.event.add(e, r, u[r][n]);
            Y.hasData(t) && (a = Y.access(t), l = w.extend({}, a), Y.set(e, l))
        }
    }

    function Lt(t, e) {
        var n = e.nodeName.toLowerCase();
        "input" === n && ut.test(t.type) ? e.checked = t.checked : "input" !== n && "textarea" !== n || (e.defaultValue = t.defaultValue)
    }

    function qt(t, e, n, i) {
        e = o.apply([], e);
        var r, s, a, l, u, c, h = 0,
            p = t.length,
            d = p - 1,
            m = e[0],
            v = g(m);
        if (v || p > 1 && "string" == typeof m && !f.checkClone && St.test(m)) return t.each(function(r) {
            var s = t.eq(r);
            v && (e[0] = m.call(this, r, s.html())), qt(s, e, n, i)
        });
        if (p && (s = (r = mt(e, t[0].ownerDocument, !1, t, i)).firstChild, 1 === r.childNodes.length && (r = s), s || i)) {
            for (l = (a = w.map(dt(r, "script"), At)).length; h < p; h++) u = r, h !== d && (u = w.clone(u, !0, !0), l && w.merge(a, dt(u, "script"))), n.call(t[h], u, h);
            if (l)
                for (c = a[a.length - 1].ownerDocument, w.map(a, $t), h = 0; h < l; h++) ht.test((u = a[h]).type || "") && !G.access(u, "globalEval") && w.contains(c, u) && (u.src && "module" !== (u.type || "").toLowerCase() ? w._evalUrl && w._evalUrl(u.src) : y(u.textContent.replace(kt, ""), c, u))
        }
        return t
    }

    function zt(t, e, n) {
        for (var i, r = e ? w.filter(e, t) : t, s = 0; null != (i = r[s]); s++) n || 1 !== i.nodeType || w.cleanData(dt(i)), i.parentNode && (n && w.contains(i.ownerDocument, i) && ft(dt(i, "script")), i.parentNode.removeChild(i));
        return t
    }
    w.extend({
        htmlPrefilter: function(t) {
            return t.replace(Et, "<$1></$2>")
        },
        clone: function(t, e, n) {
            var i, r, s, o, a = t.cloneNode(!0),
                l = w.contains(t.ownerDocument, t);
            if (!(f.noCloneChecked || 1 !== t.nodeType && 11 !== t.nodeType || w.isXMLDoc(t)))
                for (o = dt(a), i = 0, r = (s = dt(t)).length; i < r; i++) Lt(s[i], o[i]);
            if (e)
                if (n)
                    for (s = s || dt(t), o = o || dt(a), i = 0, r = s.length; i < r; i++) Nt(s[i], o[i]);
                else Nt(t, a);
            return (o = dt(a, "script")).length > 0 && ft(o, !l && dt(t, "script")), a
        },
        cleanData: function(t) {
            for (var e, n, i, r = w.event.special, s = 0; void 0 !== (n = t[s]); s++)
                if (V(n)) {
                    if (e = n[G.expando]) {
                        if (e.events)
                            for (i in e.events) r[i] ? w.event.remove(n, i) : w.removeEvent(n, i, e.handle);
                        n[G.expando] = void 0
                    }
                    n[Y.expando] && (n[Y.expando] = void 0)
                }
        }
    }), w.fn.extend({
        detach: function(t) {
            return zt(this, t, !0)
        },
        remove: function(t) {
            return zt(this, t)
        },
        text: function(t) {
            return W(this, function(t) {
                return void 0 === t ? w.text(this) : this.empty().each(function() {
                    1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = t)
                })
            }, null, t, arguments.length)
        },
        append: function() {
            return qt(this, arguments, function(t) {
                1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || jt(this, t).appendChild(t)
            })
        },
        prepend: function() {
            return qt(this, arguments, function(t) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var e = jt(this, t);
                    e.insertBefore(t, e.firstChild)
                }
            })
        },
        before: function() {
            return qt(this, arguments, function(t) {
                this.parentNode && this.parentNode.insertBefore(t, this)
            })
        },
        after: function() {
            return qt(this, arguments, function(t) {
                this.parentNode && this.parentNode.insertBefore(t, this.nextSibling)
            })
        },
        empty: function() {
            for (var t, e = 0; null != (t = this[e]); e++) 1 === t.nodeType && (w.cleanData(dt(t, !1)), t.textContent = "");
            return this
        },
        clone: function(t, e) {
            return t = null != t && t, e = null == e ? t : e, this.map(function() {
                return w.clone(this, t, e)
            })
        },
        html: function(t) {
            return W(this, function(t) {
                var e = this[0] || {},
                    n = 0,
                    i = this.length;
                if (void 0 === t && 1 === e.nodeType) return e.innerHTML;
                if ("string" == typeof t && !Dt.test(t) && !pt[(ct.exec(t) || ["", ""])[1].toLowerCase()]) {
                    t = w.htmlPrefilter(t);
                    try {
                        for (; n < i; n++) 1 === (e = this[n] || {}).nodeType && (w.cleanData(dt(e, !1)), e.innerHTML = t);
                        e = 0
                    } catch (t) {}
                }
                e && this.empty().append(t)
            }, null, t, arguments.length)
        },
        replaceWith: function() {
            var t = [];
            return qt(this, arguments, function(e) {
                var n = this.parentNode;
                w.inArray(this, t) < 0 && (w.cleanData(dt(this)), n && n.replaceChild(e, this))
            }, t)
        }
    }), w.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function(t, e) {
        w.fn[t] = function(t) {
            for (var n, i = [], r = w(t), s = r.length - 1, o = 0; o <= s; o++) n = o === s ? this : this.clone(!0), w(r[o])[e](n), a.apply(i, n.get());
            return this.pushStack(i)
        }
    });
    var Ht = new RegExp("^(" + tt + ")(?!px)[a-z%]+$", "i"),
        Pt = function(e) {
            var n = e.ownerDocument.defaultView;
            return n && n.opener || (n = t), n.getComputedStyle(e)
        },
        Ot = new RegExp(nt.join("|"), "i");

    function Mt(t, e, n) {
        var i, r, s, o, a = t.style;
        return (n = n || Pt(t)) && ("" !== (o = n.getPropertyValue(e) || n[e]) || w.contains(t.ownerDocument, t) || (o = w.style(t, e)), !f.pixelBoxStyles() && Ht.test(o) && Ot.test(e) && (i = a.width, r = a.minWidth, s = a.maxWidth, a.minWidth = a.maxWidth = a.width = o, o = n.width, a.width = i, a.minWidth = r, a.maxWidth = s)), void 0 !== o ? o + "" : o
    }

    function Rt(t, e) {
        return {
            get: function() {
                if (!t()) return (this.get = e).apply(this, arguments);
                delete this.get
            }
        }
    }! function() {
        function e() {
            if (c) {
                u.style.cssText = "position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0", c.style.cssText = "position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%", vt.appendChild(u).appendChild(c);
                var e = t.getComputedStyle(c);
                r = "1%" !== e.top, l = 12 === n(e.marginLeft), c.style.right = "60%", a = 36 === n(e.right), s = 36 === n(e.width), c.style.position = "absolute", o = 36 === c.offsetWidth || "absolute", vt.removeChild(u), c = null
            }
        }

        function n(t) {
            return Math.round(parseFloat(t))
        }
        var r, s, o, a, l, u = i.createElement("div"),
            c = i.createElement("div");
        c.style && (c.style.backgroundClip = "content-box", c.cloneNode(!0).style.backgroundClip = "", f.clearCloneStyle = "content-box" === c.style.backgroundClip, w.extend(f, {
            boxSizingReliable: function() {
                return e(), s
            },
            pixelBoxStyles: function() {
                return e(), a
            },
            pixelPosition: function() {
                return e(), r
            },
            reliableMarginLeft: function() {
                return e(), l
            },
            scrollboxSize: function() {
                return e(), o
            }
        }))
    }();
    var It = /^(none|table(?!-c[ea]).+)/,
        Wt = /^--/,
        Bt = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        },
        Ft = {
            letterSpacing: "0",
            fontWeight: "400"
        },
        Ut = ["Webkit", "Moz", "ms"],
        Xt = i.createElement("div").style;

    function Vt(t) {
        var e = w.cssProps[t];
        return e || (e = w.cssProps[t] = function(t) {
            if (t in Xt) return t;
            for (var e = t[0].toUpperCase() + t.slice(1), n = Ut.length; n--;)
                if ((t = Ut[n] + e) in Xt) return t
        }(t) || t), e
    }

    function Qt(t, e, n) {
        var i = et.exec(e);
        return i ? Math.max(0, i[2] - (n || 0)) + (i[3] || "px") : e
    }

    function Gt(t, e, n, i, r, s) {
        var o = "width" === e ? 1 : 0,
            a = 0,
            l = 0;
        if (n === (i ? "border" : "content")) return 0;
        for (; o < 4; o += 2) "margin" === n && (l += w.css(t, n + nt[o], !0, r)), i ? ("content" === n && (l -= w.css(t, "padding" + nt[o], !0, r)), "margin" !== n && (l -= w.css(t, "border" + nt[o] + "Width", !0, r))) : (l += w.css(t, "padding" + nt[o], !0, r), "padding" !== n ? l += w.css(t, "border" + nt[o] + "Width", !0, r) : a += w.css(t, "border" + nt[o] + "Width", !0, r));
        return !i && s >= 0 && (l += Math.max(0, Math.ceil(t["offset" + e[0].toUpperCase() + e.slice(1)] - s - l - a - .5))), l
    }

    function Yt(t, e, n) {
        var i = Pt(t),
            r = Mt(t, e, i),
            s = "border-box" === w.css(t, "boxSizing", !1, i),
            o = s;
        if (Ht.test(r)) {
            if (!n) return r;
            r = "auto"
        }
        return o = o && (f.boxSizingReliable() || r === t.style[e]), ("auto" === r || !parseFloat(r) && "inline" === w.css(t, "display", !1, i)) && (r = t["offset" + e[0].toUpperCase() + e.slice(1)], o = !0), (r = parseFloat(r) || 0) + Gt(t, e, n || (s ? "border" : "content"), o, i, r) + "px"
    }

    function Zt(t, e, n, i, r) {
        return new Zt.prototype.init(t, e, n, i, r)
    }
    w.extend({
        cssHooks: {
            opacity: {
                get: function(t, e) {
                    if (e) {
                        var n = Mt(t, "opacity");
                        return "" === n ? "1" : n
                    }
                }
            }
        },
        cssNumber: {
            animationIterationCount: !0,
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {},
        style: function(t, e, n, i) {
            if (t && 3 !== t.nodeType && 8 !== t.nodeType && t.style) {
                var r, s, o, a = X(e),
                    l = Wt.test(e),
                    u = t.style;
                if (l || (e = Vt(a)), o = w.cssHooks[e] || w.cssHooks[a], void 0 === n) return o && "get" in o && void 0 !== (r = o.get(t, !1, i)) ? r : u[e];
                "string" == (s = typeof n) && (r = et.exec(n)) && r[1] && (n = st(t, e, r), s = "number"), null != n && n == n && ("number" === s && (n += r && r[3] || (w.cssNumber[a] ? "" : "px")), f.clearCloneStyle || "" !== n || 0 !== e.indexOf("background") || (u[e] = "inherit"), o && "set" in o && void 0 === (n = o.set(t, n, i)) || (l ? u.setProperty(e, n) : u[e] = n))
            }
        },
        css: function(t, e, n, i) {
            var r, s, o, a = X(e);
            return Wt.test(e) || (e = Vt(a)), (o = w.cssHooks[e] || w.cssHooks[a]) && "get" in o && (r = o.get(t, !0, n)), void 0 === r && (r = Mt(t, e, i)), "normal" === r && e in Ft && (r = Ft[e]), "" === n || n ? (s = parseFloat(r), !0 === n || isFinite(s) ? s || 0 : r) : r
        }
    }), w.each(["height", "width"], function(t, e) {
        w.cssHooks[e] = {
            get: function(t, n, i) {
                if (n) return !It.test(w.css(t, "display")) || t.getClientRects().length && t.getBoundingClientRect().width ? Yt(t, e, i) : rt(t, Bt, function() {
                    return Yt(t, e, i)
                })
            },
            set: function(t, n, i) {
                var r, s = Pt(t),
                    o = "border-box" === w.css(t, "boxSizing", !1, s),
                    a = i && Gt(t, e, i, o, s);
                return o && f.scrollboxSize() === s.position && (a -= Math.ceil(t["offset" + e[0].toUpperCase() + e.slice(1)] - parseFloat(s[e]) - Gt(t, e, "border", !1, s) - .5)), a && (r = et.exec(n)) && "px" !== (r[3] || "px") && (t.style[e] = n, n = w.css(t, e)), Qt(0, n, a)
            }
        }
    }), w.cssHooks.marginLeft = Rt(f.reliableMarginLeft, function(t, e) {
        if (e) return (parseFloat(Mt(t, "marginLeft")) || t.getBoundingClientRect().left - rt(t, {
            marginLeft: 0
        }, function() {
            return t.getBoundingClientRect().left
        })) + "px"
    }), w.each({
        margin: "",
        padding: "",
        border: "Width"
    }, function(t, e) {
        w.cssHooks[t + e] = {
            expand: function(n) {
                for (var i = 0, r = {}, s = "string" == typeof n ? n.split(" ") : [n]; i < 4; i++) r[t + nt[i] + e] = s[i] || s[i - 2] || s[0];
                return r
            }
        }, "margin" !== t && (w.cssHooks[t + e].set = Qt)
    }), w.fn.extend({
        css: function(t, e) {
            return W(this, function(t, e, n) {
                var i, r, s = {},
                    o = 0;
                if (Array.isArray(e)) {
                    for (i = Pt(t), r = e.length; o < r; o++) s[e[o]] = w.css(t, e[o], !1, i);
                    return s
                }
                return void 0 !== n ? w.style(t, e, n) : w.css(t, e)
            }, t, e, arguments.length > 1)
        }
    }), w.Tween = Zt, (Zt.prototype = {
        constructor: Zt,
        init: function(t, e, n, i, r, s) {
            this.elem = t, this.prop = n, this.easing = r || w.easing._default, this.options = e, this.start = this.now = this.cur(), this.end = i, this.unit = s || (w.cssNumber[n] ? "" : "px")
        },
        cur: function() {
            var t = Zt.propHooks[this.prop];
            return t && t.get ? t.get(this) : Zt.propHooks._default.get(this)
        },
        run: function(t) {
            var e, n = Zt.propHooks[this.prop];
            return this.pos = e = this.options.duration ? w.easing[this.easing](t, this.options.duration * t, 0, 1, this.options.duration) : t, this.now = (this.end - this.start) * e + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : Zt.propHooks._default.set(this), this
        }
    }).init.prototype = Zt.prototype, (Zt.propHooks = {
        _default: {
            get: function(t) {
                var e;
                return 1 !== t.elem.nodeType || null != t.elem[t.prop] && null == t.elem.style[t.prop] ? t.elem[t.prop] : (e = w.css(t.elem, t.prop, "")) && "auto" !== e ? e : 0
            },
            set: function(t) {
                w.fx.step[t.prop] ? w.fx.step[t.prop](t) : 1 !== t.elem.nodeType || null == t.elem.style[w.cssProps[t.prop]] && !w.cssHooks[t.prop] ? t.elem[t.prop] = t.now : w.style(t.elem, t.prop, t.now + t.unit)
            }
        }
    }).scrollTop = Zt.propHooks.scrollLeft = {
        set: function(t) {
            t.elem.nodeType && t.elem.parentNode && (t.elem[t.prop] = t.now)
        }
    }, w.easing = {
        linear: function(t) {
            return t
        },
        swing: function(t) {
            return .5 - Math.cos(t * Math.PI) / 2
        },
        _default: "swing"
    }, w.fx = Zt.prototype.init, w.fx.step = {};
    var Jt, Kt, te = /^(?:toggle|show|hide)$/,
        ee = /queueHooks$/;

    function ne() {
        Kt && (!1 === i.hidden && t.requestAnimationFrame ? t.requestAnimationFrame(ne) : t.setTimeout(ne, w.fx.interval), w.fx.tick())
    }

    function ie() {
        return t.setTimeout(function() {
            Jt = void 0
        }), Jt = Date.now()
    }

    function re(t, e) {
        var n, i = 0,
            r = {
                height: t
            };
        for (e = e ? 1 : 0; i < 4; i += 2 - e) r["margin" + (n = nt[i])] = r["padding" + n] = t;
        return e && (r.opacity = r.width = t), r
    }

    function se(t, e, n) {
        for (var i, r = (oe.tweeners[e] || []).concat(oe.tweeners["*"]), s = 0, o = r.length; s < o; s++)
            if (i = r[s].call(n, e, t)) return i
    }

    function oe(t, e, n) {
        var i, r, s = 0,
            o = oe.prefilters.length,
            a = w.Deferred().always(function() {
                delete l.elem
            }),
            l = function() {
                if (r) return !1;
                for (var e = Jt || ie(), n = Math.max(0, u.startTime + u.duration - e), i = 1 - (n / u.duration || 0), s = 0, o = u.tweens.length; s < o; s++) u.tweens[s].run(i);
                return a.notifyWith(t, [u, i, n]), i < 1 && o ? n : (o || a.notifyWith(t, [u, 1, 0]), a.resolveWith(t, [u]), !1)
            },
            u = a.promise({
                elem: t,
                props: w.extend({}, e),
                opts: w.extend(!0, {
                    specialEasing: {},
                    easing: w.easing._default
                }, n),
                originalProperties: e,
                originalOptions: n,
                startTime: Jt || ie(),
                duration: n.duration,
                tweens: [],
                createTween: function(e, n) {
                    var i = w.Tween(t, u.opts, e, n, u.opts.specialEasing[e] || u.opts.easing);
                    return u.tweens.push(i), i
                },
                stop: function(e) {
                    var n = 0,
                        i = e ? u.tweens.length : 0;
                    if (r) return this;
                    for (r = !0; n < i; n++) u.tweens[n].run(1);
                    return e ? (a.notifyWith(t, [u, 1, 0]), a.resolveWith(t, [u, e])) : a.rejectWith(t, [u, e]), this
                }
            }),
            c = u.props;
        for (function(t, e) {
                var n, i, r, s, o;
                for (n in t)
                    if (r = e[i = X(n)], s = t[n], Array.isArray(s) && (r = s[1], s = t[n] = s[0]), n !== i && (t[i] = s, delete t[n]), (o = w.cssHooks[i]) && "expand" in o)
                        for (n in s = o.expand(s), delete t[i], s) n in t || (t[n] = s[n], e[n] = r);
                    else e[i] = r
            }(c, u.opts.specialEasing); s < o; s++)
            if (i = oe.prefilters[s].call(u, t, c, u.opts)) return g(i.stop) && (w._queueHooks(u.elem, u.opts.queue).stop = i.stop.bind(i)), i;
        return w.map(c, se, u), g(u.opts.start) && u.opts.start.call(t, u), u.progress(u.opts.progress).done(u.opts.done, u.opts.complete).fail(u.opts.fail).always(u.opts.always), w.fx.timer(w.extend(l, {
            elem: t,
            anim: u,
            queue: u.opts.queue
        })), u
    }
    w.Animation = w.extend(oe, {
            tweeners: {
                "*": [function(t, e) {
                    var n = this.createTween(t, e);
                    return st(n.elem, t, et.exec(e), n), n
                }]
            },
            tweener: function(t, e) {
                g(t) ? (e = t, t = ["*"]) : t = t.match(z);
                for (var n, i = 0, r = t.length; i < r; i++)(oe.tweeners[n = t[i]] = oe.tweeners[n] || []).unshift(e)
            },
            prefilters: [function(t, e, n) {
                var i, r, s, o, a, l, u, c, h = "width" in e || "height" in e,
                    p = this,
                    d = {},
                    f = t.style,
                    g = t.nodeType && it(t),
                    m = G.get(t, "fxshow");
                for (i in n.queue || (null == (o = w._queueHooks(t, "fx")).unqueued && (o.unqueued = 0, a = o.empty.fire, o.empty.fire = function() {
                        o.unqueued || a()
                    }), o.unqueued++, p.always(function() {
                        p.always(function() {
                            o.unqueued--, w.queue(t, "fx").length || o.empty.fire()
                        })
                    })), e)
                    if (te.test(r = e[i])) {
                        if (delete e[i], s = s || "toggle" === r, r === (g ? "hide" : "show")) {
                            if ("show" !== r || !m || void 0 === m[i]) continue;
                            g = !0
                        }
                        d[i] = m && m[i] || w.style(t, i)
                    }
                if ((l = !w.isEmptyObject(e)) || !w.isEmptyObject(d))
                    for (i in h && 1 === t.nodeType && (n.overflow = [f.overflow, f.overflowX, f.overflowY], null == (u = m && m.display) && (u = G.get(t, "display")), "none" === (c = w.css(t, "display")) && (u ? c = u : (lt([t], !0), u = t.style.display || u, c = w.css(t, "display"), lt([t]))), ("inline" === c || "inline-block" === c && null != u) && "none" === w.css(t, "float") && (l || (p.done(function() {
                            f.display = u
                        }), null == u && (u = "none" === (c = f.display) ? "" : c)), f.display = "inline-block")), n.overflow && (f.overflow = "hidden", p.always(function() {
                            f.overflow = n.overflow[0], f.overflowX = n.overflow[1], f.overflowY = n.overflow[2]
                        })), l = !1, d) l || (m ? "hidden" in m && (g = m.hidden) : m = G.access(t, "fxshow", {
                        display: u
                    }), s && (m.hidden = !g), g && lt([t], !0), p.done(function() {
                        for (i in g || lt([t]), G.remove(t, "fxshow"), d) w.style(t, i, d[i])
                    })), l = se(g ? m[i] : 0, i, p), i in m || (m[i] = l.start, g && (l.end = l.start, l.start = 0))
            }],
            prefilter: function(t, e) {
                e ? oe.prefilters.unshift(t) : oe.prefilters.push(t)
            }
        }), w.speed = function(t, e, n) {
            var i = t && "object" == typeof t ? w.extend({}, t) : {
                complete: n || !n && e || g(t) && t,
                duration: t,
                easing: n && e || e && !g(e) && e
            };
            return w.fx.off ? i.duration = 0 : "number" != typeof i.duration && (i.duration = i.duration in w.fx.speeds ? w.fx.speeds[i.duration] : w.fx.speeds._default), null != i.queue && !0 !== i.queue || (i.queue = "fx"), i.old = i.complete, i.complete = function() {
                g(i.old) && i.old.call(this), i.queue && w.dequeue(this, i.queue)
            }, i
        }, w.fn.extend({
            fadeTo: function(t, e, n, i) {
                return this.filter(it).css("opacity", 0).show().end().animate({
                    opacity: e
                }, t, n, i)
            },
            animate: function(t, e, n, i) {
                var r = w.isEmptyObject(t),
                    s = w.speed(e, n, i),
                    o = function() {
                        var e = oe(this, w.extend({}, t), s);
                        (r || G.get(this, "finish")) && e.stop(!0)
                    };
                return o.finish = o, r || !1 === s.queue ? this.each(o) : this.queue(s.queue, o)
            },
            stop: function(t, e, n) {
                var i = function(t) {
                    var e = t.stop;
                    delete t.stop, e(n)
                };
                return "string" != typeof t && (n = e, e = t, t = void 0), e && !1 !== t && this.queue(t || "fx", []), this.each(function() {
                    var e = !0,
                        r = null != t && t + "queueHooks",
                        s = w.timers,
                        o = G.get(this);
                    if (r) o[r] && o[r].stop && i(o[r]);
                    else
                        for (r in o) o[r] && o[r].stop && ee.test(r) && i(o[r]);
                    for (r = s.length; r--;) s[r].elem !== this || null != t && s[r].queue !== t || (s[r].anim.stop(n), e = !1, s.splice(r, 1));
                    !e && n || w.dequeue(this, t)
                })
            },
            finish: function(t) {
                return !1 !== t && (t = t || "fx"), this.each(function() {
                    var e, n = G.get(this),
                        i = n[t + "queue"],
                        r = n[t + "queueHooks"],
                        s = w.timers,
                        o = i ? i.length : 0;
                    for (n.finish = !0, w.queue(this, t, []), r && r.stop && r.stop.call(this, !0), e = s.length; e--;) s[e].elem === this && s[e].queue === t && (s[e].anim.stop(!0), s.splice(e, 1));
                    for (e = 0; e < o; e++) i[e] && i[e].finish && i[e].finish.call(this);
                    delete n.finish
                })
            }
        }), w.each(["toggle", "show", "hide"], function(t, e) {
            var n = w.fn[e];
            w.fn[e] = function(t, i, r) {
                return null == t || "boolean" == typeof t ? n.apply(this, arguments) : this.animate(re(e, !0), t, i, r)
            }
        }), w.each({
            slideDown: re("show"),
            slideUp: re("hide"),
            slideToggle: re("toggle"),
            fadeIn: {
                opacity: "show"
            },
            fadeOut: {
                opacity: "hide"
            },
            fadeToggle: {
                opacity: "toggle"
            }
        }, function(t, e) {
            w.fn[t] = function(t, n, i) {
                return this.animate(e, t, n, i)
            }
        }), w.timers = [], w.fx.tick = function() {
            var t, e = 0,
                n = w.timers;
            for (Jt = Date.now(); e < n.length; e++)(t = n[e])() || n[e] !== t || n.splice(e--, 1);
            n.length || w.fx.stop(), Jt = void 0
        }, w.fx.timer = function(t) {
            w.timers.push(t), w.fx.start()
        }, w.fx.interval = 13, w.fx.start = function() {
            Kt || (Kt = !0, ne())
        }, w.fx.stop = function() {
            Kt = null
        }, w.fx.speeds = {
            slow: 600,
            fast: 200,
            _default: 400
        }, w.fn.delay = function(e, n) {
            return e = w.fx && w.fx.speeds[e] || e, this.queue(n = n || "fx", function(n, i) {
                var r = t.setTimeout(n, e);
                i.stop = function() {
                    t.clearTimeout(r)
                }
            })
        },
        function() {
            var t = i.createElement("input"),
                e = i.createElement("select").appendChild(i.createElement("option"));
            t.type = "checkbox", f.checkOn = "" !== t.value, f.optSelected = e.selected, (t = i.createElement("input")).value = "t", t.type = "radio", f.radioValue = "t" === t.value
        }();
    var ae, le = w.expr.attrHandle;
    w.fn.extend({
        attr: function(t, e) {
            return W(this, w.attr, t, e, arguments.length > 1)
        },
        removeAttr: function(t) {
            return this.each(function() {
                w.removeAttr(this, t)
            })
        }
    }), w.extend({
        attr: function(t, e, n) {
            var i, r, s = t.nodeType;
            if (3 !== s && 8 !== s && 2 !== s) return "undefined" == typeof t.getAttribute ? w.prop(t, e, n) : (1 === s && w.isXMLDoc(t) || (r = w.attrHooks[e.toLowerCase()] || (w.expr.match.bool.test(e) ? ae : void 0)), void 0 !== n ? null === n ? void w.removeAttr(t, e) : r && "set" in r && void 0 !== (i = r.set(t, n, e)) ? i : (t.setAttribute(e, n + ""), n) : r && "get" in r && null !== (i = r.get(t, e)) ? i : null == (i = w.find.attr(t, e)) ? void 0 : i)
        },
        attrHooks: {
            type: {
                set: function(t, e) {
                    if (!f.radioValue && "radio" === e && S(t, "input")) {
                        var n = t.value;
                        return t.setAttribute("type", e), n && (t.value = n), e
                    }
                }
            }
        },
        removeAttr: function(t, e) {
            var n, i = 0,
                r = e && e.match(z);
            if (r && 1 === t.nodeType)
                for (; n = r[i++];) t.removeAttribute(n)
        }
    }), ae = {
        set: function(t, e, n) {
            return !1 === e ? w.removeAttr(t, n) : t.setAttribute(n, n), n
        }
    }, w.each(w.expr.match.bool.source.match(/\w+/g), function(t, e) {
        var n = le[e] || w.find.attr;
        le[e] = function(t, e, i) {
            var r, s, o = e.toLowerCase();
            return i || (s = le[o], le[o] = r, r = null != n(t, e, i) ? o : null, le[o] = s), r
        }
    });
    var ue = /^(?:input|select|textarea|button)$/i,
        ce = /^(?:a|area)$/i;

    function he(t) {
        return (t.match(z) || []).join(" ")
    }

    function pe(t) {
        return t.getAttribute && t.getAttribute("class") || ""
    }

    function de(t) {
        return Array.isArray(t) ? t : "string" == typeof t && t.match(z) || []
    }
    w.fn.extend({
        prop: function(t, e) {
            return W(this, w.prop, t, e, arguments.length > 1)
        },
        removeProp: function(t) {
            return this.each(function() {
                delete this[w.propFix[t] || t]
            })
        }
    }), w.extend({
        prop: function(t, e, n) {
            var i, r, s = t.nodeType;
            if (3 !== s && 8 !== s && 2 !== s) return 1 === s && w.isXMLDoc(t) || (r = w.propHooks[e = w.propFix[e] || e]), void 0 !== n ? r && "set" in r && void 0 !== (i = r.set(t, n, e)) ? i : t[e] = n : r && "get" in r && null !== (i = r.get(t, e)) ? i : t[e]
        },
        propHooks: {
            tabIndex: {
                get: function(t) {
                    var e = w.find.attr(t, "tabindex");
                    return e ? parseInt(e, 10) : ue.test(t.nodeName) || ce.test(t.nodeName) && t.href ? 0 : -1
                }
            }
        },
        propFix: {
            for: "htmlFor",
            class: "className"
        }
    }), f.optSelected || (w.propHooks.selected = {
        get: function(t) {
            return null
        },
        set: function(t) {}
    }), w.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
        w.propFix[this.toLowerCase()] = this
    }), w.fn.extend({
        addClass: function(t) {
            var e, n, i, r, s, o, a, l = 0;
            if (g(t)) return this.each(function(e) {
                w(this).addClass(t.call(this, e, pe(this)))
            });
            if ((e = de(t)).length)
                for (; n = this[l++];)
                    if (r = pe(n), i = 1 === n.nodeType && " " + he(r) + " ") {
                        for (o = 0; s = e[o++];) i.indexOf(" " + s + " ") < 0 && (i += s + " ");
                        r !== (a = he(i)) && n.setAttribute("class", a)
                    }
            return this
        },
        removeClass: function(t) {
            var e, n, i, r, s, o, a, l = 0;
            if (g(t)) return this.each(function(e) {
                w(this).removeClass(t.call(this, e, pe(this)))
            });
            if (!arguments.length) return this.attr("class", "");
            if ((e = de(t)).length)
                for (; n = this[l++];)
                    if (r = pe(n), i = 1 === n.nodeType && " " + he(r) + " ") {
                        for (o = 0; s = e[o++];)
                            for (; i.indexOf(" " + s + " ") > -1;) i = i.replace(" " + s + " ", " ");
                        r !== (a = he(i)) && n.setAttribute("class", a)
                    }
            return this
        },
        toggleClass: function(t, e) {
            var n = typeof t,
                i = "string" === n || Array.isArray(t);
            return "boolean" == typeof e && i ? e ? this.addClass(t) : this.removeClass(t) : g(t) ? this.each(function(n) {
                w(this).toggleClass(t.call(this, n, pe(this), e), e)
            }) : this.each(function() {
                var e, r, s, o;
                if (i)
                    for (r = 0, s = w(this), o = de(t); e = o[r++];) s.hasClass(e) ? s.removeClass(e) : s.addClass(e);
                else void 0 !== t && "boolean" !== n || ((e = pe(this)) && G.set(this, "__className__", e), this.setAttribute && this.setAttribute("class", e || !1 === t ? "" : G.get(this, "__className__") || ""))
            })
        },
        hasClass: function(t) {
            var e, n, i = 0;
            for (e = " " + t + " "; n = this[i++];)
                if (1 === n.nodeType && (" " + he(pe(n)) + " ").indexOf(e) > -1) return !0;
            return !1
        }
    });
    var fe = /\r/g;
    w.fn.extend({
        val: function(t) {
            var e, n, i, r = this[0];
            return arguments.length ? (i = g(t), this.each(function(n) {
                var r;
                1 === this.nodeType && (null == (r = i ? t.call(this, n, w(this).val()) : t) ? r = "" : "number" == typeof r ? r += "" : Array.isArray(r) && (r = w.map(r, function(t) {
                    return null == t ? "" : t + ""
                })), (e = w.valHooks[this.type] || w.valHooks[this.nodeName.toLowerCase()]) && "set" in e && void 0 !== e.set(this, r, "value") || (this.value = r))
            })) : r ? (e = w.valHooks[r.type] || w.valHooks[r.nodeName.toLowerCase()]) && "get" in e && void 0 !== (n = e.get(r, "value")) ? n : "string" == typeof(n = r.value) ? n.replace(fe, "") : null == n ? "" : n : void 0
        }
    }), w.extend({
        valHooks: {
            option: {
                get: function(t) {
                    var e = w.find.attr(t, "value");
                    return null != e ? e : he(w.text(t))
                }
            },
            select: {
                get: function(t) {
                    var e, n, i, r = t.options,
                        s = t.selectedIndex,
                        o = "select-one" === t.type,
                        a = o ? null : [],
                        l = o ? s + 1 : r.length;
                    for (i = s < 0 ? l : o ? s : 0; i < l; i++)
                        if (((n = r[i]).selected || i === s) && !n.disabled && (!n.parentNode.disabled || !S(n.parentNode, "optgroup"))) {
                            if (e = w(n).val(), o) return e;
                            a.push(e)
                        }
                    return a
                },
                set: function(t, e) {
                    for (var n, i, r = t.options, s = w.makeArray(e), o = r.length; o--;)((i = r[o]).selected = w.inArray(w.valHooks.option.get(i), s) > -1) && (n = !0);
                    return n || (t.selectedIndex = -1), s
                }
            }
        }
    }), w.each(["radio", "checkbox"], function() {
        w.valHooks[this] = {
            set: function(t, e) {
                if (Array.isArray(e)) return t.checked = w.inArray(w(t).val(), e) > -1
            }
        }, f.checkOn || (w.valHooks[this].get = function(t) {
            return null === t.getAttribute("value") ? "on" : t.value
        })
    }), f.focusin = "onfocusin" in t;
    var ge = /^(?:focusinfocus|focusoutblur)$/,
        me = function(t) {
            t.stopPropagation()
        };
    w.extend(w.event, {
        trigger: function(e, n, r, s) {
            var o, a, l, u, c, p, d, f, v = [r || i],
                y = h.call(e, "type") ? e.type : e,
                x = h.call(e, "namespace") ? e.namespace.split(".") : [];
            if (a = f = l = r = r || i, 3 !== r.nodeType && 8 !== r.nodeType && !ge.test(y + w.event.triggered) && (y.indexOf(".") > -1 && (y = (x = y.split(".")).shift(), x.sort()), c = y.indexOf(":") < 0 && "on" + y, (e = e[w.expando] ? e : new w.Event(y, "object" == typeof e && e)).isTrigger = s ? 2 : 3, e.namespace = x.join("."), e.rnamespace = e.namespace ? new RegExp("(^|\\.)" + x.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, e.result = void 0, e.target || (e.target = r), n = null == n ? [e] : w.makeArray(n, [e]), d = w.event.special[y] || {}, s || !d.trigger || !1 !== d.trigger.apply(r, n))) {
                if (!s && !d.noBubble && !m(r)) {
                    for (ge.test((u = d.delegateType || y) + y) || (a = a.parentNode); a; a = a.parentNode) v.push(a), l = a;
                    l === (r.ownerDocument || i) && v.push(l.defaultView || l.parentWindow || t)
                }
                for (o = 0;
                    (a = v[o++]) && !e.isPropagationStopped();) f = a, e.type = o > 1 ? u : d.bindType || y, (p = (G.get(a, "events") || {})[e.type] && G.get(a, "handle")) && p.apply(a, n), (p = c && a[c]) && p.apply && V(a) && (e.result = p.apply(a, n), !1 === e.result && e.preventDefault());
                return e.type = y, s || e.isDefaultPrevented() || d._default && !1 !== d._default.apply(v.pop(), n) || !V(r) || c && g(r[y]) && !m(r) && ((l = r[c]) && (r[c] = null), w.event.triggered = y, e.isPropagationStopped() && f.addEventListener(y, me), r[y](), e.isPropagationStopped() && f.removeEventListener(y, me), w.event.triggered = void 0, l && (r[c] = l)), e.result
            }
        },
        simulate: function(t, e, n) {
            var i = w.extend(new w.Event, n, {
                type: t,
                isSimulated: !0
            });
            w.event.trigger(i, null, e)
        }
    }), w.fn.extend({
        trigger: function(t, e) {
            return this.each(function() {
                w.event.trigger(t, e, this)
            })
        },
        triggerHandler: function(t, e) {
            var n = this[0];
            if (n) return w.event.trigger(t, e, n, !0)
        }
    }), f.focusin || w.each({
        focus: "focusin",
        blur: "focusout"
    }, function(t, e) {
        var n = function(t) {
            w.event.simulate(e, t.target, w.event.fix(t))
        };
        w.event.special[e] = {
            setup: function() {
                var i = this.ownerDocument || this,
                    r = G.access(i, e);
                r || i.addEventListener(t, n, !0), G.access(i, e, (r || 0) + 1)
            },
            teardown: function() {
                var i = this.ownerDocument || this,
                    r = G.access(i, e) - 1;
                r ? G.access(i, e, r) : (i.removeEventListener(t, n, !0), G.remove(i, e))
            }
        }
    });
    var ve = t.location,
        ye = Date.now(),
        xe = /\?/;
    w.parseXML = function(e) {
        var n;
        if (!e || "string" != typeof e) return null;
        try {
            n = (new t.DOMParser).parseFromString(e, "text/xml")
        } catch (t) {
            n = void 0
        }
        return n && !n.getElementsByTagName("parsererror").length || w.error("Invalid XML: " + e), n
    };
    var we = /\[\]$/,
        _e = /\r?\n/g,
        be = /^(?:submit|button|image|reset|file)$/i,
        Ce = /^(?:input|select|textarea|keygen)/i;

    function Te(t, e, n, i) {
        var r;
        if (Array.isArray(e)) w.each(e, function(e, r) {
            n || we.test(t) ? i(t, r) : Te(t + "[" + ("object" == typeof r && null != r ? e : "") + "]", r, n, i)
        });
        else if (n || "object" !== x(e)) i(t, e);
        else
            for (r in e) Te(t + "[" + r + "]", e[r], n, i)
    }
    w.param = function(t, e) {
        var n, i = [],
            r = function(t, e) {
                var n = g(e) ? e() : e;
                i[i.length] = encodeURIComponent(t) + "=" + encodeURIComponent(null == n ? "" : n)
            };
        if (Array.isArray(t) || t.jquery && !w.isPlainObject(t)) w.each(t, function() {
            r(this.name, this.value)
        });
        else
            for (n in t) Te(n, t[n], e, r);
        return i.join("&")
    }, w.fn.extend({
        serialize: function() {
            return w.param(this.serializeArray())
        },
        serializeArray: function() {
            return this.map(function() {
                var t = w.prop(this, "elements");
                return t ? w.makeArray(t) : this
            }).filter(function() {
                var t = this.type;
                return this.name && !w(this).is(":disabled") && Ce.test(this.nodeName) && !be.test(t) && (this.checked || !ut.test(t))
            }).map(function(t, e) {
                var n = w(this).val();
                return null == n ? null : Array.isArray(n) ? w.map(n, function(t) {
                    return {
                        name: e.name,
                        value: t.replace(_e, "\r\n")
                    }
                }) : {
                    name: e.name,
                    value: n.replace(_e, "\r\n")
                }
            }).get()
        }
    });
    var Ee = /%20/g,
        De = /#.*$/,
        Se = /([?&])_=[^&]*/,
        ke = /^(.*?):[ \t]*([^\r\n]*)$/gm,
        je = /^(?:GET|HEAD)$/,
        Ae = /^\/\//,
        $e = {},
        Ne = {},
        Le = "*/".concat("*"),
        qe = i.createElement("a");

    function ze(t) {
        return function(e, n) {
            "string" != typeof e && (n = e, e = "*");
            var i, r = 0,
                s = e.toLowerCase().match(z) || [];
            if (g(n))
                for (; i = s[r++];) "+" === i[0] ? (i = i.slice(1) || "*", (t[i] = t[i] || []).unshift(n)) : (t[i] = t[i] || []).push(n)
        }
    }

    function He(t, e, n, i) {
        var r = {},
            s = t === Ne;

        function o(a) {
            var l;
            return r[a] = !0, w.each(t[a] || [], function(t, a) {
                var u = a(e, n, i);
                return "string" != typeof u || s || r[u] ? s ? !(l = u) : void 0 : (e.dataTypes.unshift(u), o(u), !1)
            }), l
        }
        return o(e.dataTypes[0]) || !r["*"] && o("*")
    }

    function Pe(t, e) {
        var n, i, r = w.ajaxSettings.flatOptions || {};
        for (n in e) void 0 !== e[n] && ((r[n] ? t : i || (i = {}))[n] = e[n]);
        return i && w.extend(!0, t, i), t
    }
    qe.href = ve.href, w.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: ve.href,
            type: "GET",
            isLocal: /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(ve.protocol),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Le,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {
                xml: /\bxml\b/,
                html: /\bhtml/,
                json: /\bjson\b/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText",
                json: "responseJSON"
            },
            converters: {
                "* text": String,
                "text html": !0,
                "text json": JSON.parse,
                "text xml": w.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function(t, e) {
            return e ? Pe(Pe(t, w.ajaxSettings), e) : Pe(w.ajaxSettings, t)
        },
        ajaxPrefilter: ze($e),
        ajaxTransport: ze(Ne),
        ajax: function(e, n) {
            "object" == typeof e && (n = e, e = void 0);
            var r, s, o, a, l, u, c, h, p, d, f = w.ajaxSetup({}, n = n || {}),
                g = f.context || f,
                m = f.context && (g.nodeType || g.jquery) ? w(g) : w.event,
                v = w.Deferred(),
                y = w.Callbacks("once memory"),
                x = f.statusCode || {},
                _ = {},
                b = {},
                C = "canceled",
                T = {
                    readyState: 0,
                    getResponseHeader: function(t) {
                        var e;
                        if (c) {
                            if (!a)
                                for (a = {}; e = ke.exec(o);) a[e[1].toLowerCase()] = e[2];
                            e = a[t.toLowerCase()]
                        }
                        return null == e ? null : e
                    },
                    getAllResponseHeaders: function() {
                        return c ? o : null
                    },
                    setRequestHeader: function(t, e) {
                        return null == c && (t = b[t.toLowerCase()] = b[t.toLowerCase()] || t, _[t] = e), this
                    },
                    overrideMimeType: function(t) {
                        return null == c && (f.mimeType = t), this
                    },
                    statusCode: function(t) {
                        var e;
                        if (t)
                            if (c) T.always(t[T.status]);
                            else
                                for (e in t) x[e] = [x[e], t[e]];
                        return this
                    },
                    abort: function(t) {
                        var e = t || C;
                        return r && r.abort(e), E(0, e), this
                    }
                };
            if (v.promise(T), f.url = ((e || f.url || ve.href) + "").replace(Ae, ve.protocol + "//"), f.type = n.method || n.type || f.method || f.type, f.dataTypes = (f.dataType || "*").toLowerCase().match(z) || [""], null == f.crossDomain) {
                u = i.createElement("a");
                try {
                    u.href = f.url, u.href = u.href, f.crossDomain = qe.protocol + "//" + qe.host != u.protocol + "//" + u.host
                } catch (t) {
                    f.crossDomain = !0
                }
            }
            if (f.data && f.processData && "string" != typeof f.data && (f.data = w.param(f.data, f.traditional)), He($e, f, n, T), c) return T;
            for (p in (h = w.event && f.global) && 0 == w.active++ && w.event.trigger("ajaxStart"), f.type = f.type.toUpperCase(), f.hasContent = !je.test(f.type), s = f.url.replace(De, ""), f.hasContent ? f.data && f.processData && 0 === (f.contentType || "").indexOf("application/x-www-form-urlencoded") && (f.data = f.data.replace(Ee, "+")) : (d = f.url.slice(s.length), f.data && (f.processData || "string" == typeof f.data) && (s += (xe.test(s) ? "&" : "?") + f.data, delete f.data), !1 === f.cache && (s = s.replace(Se, "$1"), d = (xe.test(s) ? "&" : "?") + "_=" + ye++ + d), f.url = s + d), f.ifModified && (w.lastModified[s] && T.setRequestHeader("If-Modified-Since", w.lastModified[s]), w.etag[s] && T.setRequestHeader("If-None-Match", w.etag[s])), (f.data && f.hasContent && !1 !== f.contentType || n.contentType) && T.setRequestHeader("Content-Type", f.contentType), T.setRequestHeader("Accept", f.dataTypes[0] && f.accepts[f.dataTypes[0]] ? f.accepts[f.dataTypes[0]] + ("*" !== f.dataTypes[0] ? ", " + Le + "; q=0.01" : "") : f.accepts["*"]), f.headers) T.setRequestHeader(p, f.headers[p]);
            if (f.beforeSend && (!1 === f.beforeSend.call(g, T, f) || c)) return T.abort();
            if (C = "abort", y.add(f.complete), T.done(f.success), T.fail(f.error), r = He(Ne, f, n, T)) {
                if (T.readyState = 1, h && m.trigger("ajaxSend", [T, f]), c) return T;
                f.async && f.timeout > 0 && (l = t.setTimeout(function() {
                    T.abort("timeout")
                }, f.timeout));
                try {
                    c = !1, r.send(_, E)
                } catch (t) {
                    if (c) throw t;
                    E(-1, t)
                }
            } else E(-1, "No Transport");

            function E(e, n, i, a) {
                var u, p, d, _, b, C = n;
                c || (c = !0, l && t.clearTimeout(l), r = void 0, o = a || "", T.readyState = e > 0 ? 4 : 0, u = e >= 200 && e < 300 || 304 === e, i && (_ = function(t, e, n) {
                    for (var i, r, s, o, a = t.contents, l = t.dataTypes;
                        "*" === l[0];) l.shift(), void 0 === i && (i = t.mimeType || e.getResponseHeader("Content-Type"));
                    if (i)
                        for (r in a)
                            if (a[r] && a[r].test(i)) {
                                l.unshift(r);
                                break
                            }
                    if (l[0] in n) s = l[0];
                    else {
                        for (r in n) {
                            if (!l[0] || t.converters[r + " " + l[0]]) {
                                s = r;
                                break
                            }
                            o || (o = r)
                        }
                        s = s || o
                    }
                    if (s) return s !== l[0] && l.unshift(s), n[s]
                }(f, T, i)), _ = function(t, e, n, i) {
                    var r, s, o, a, l, u = {},
                        c = t.dataTypes.slice();
                    if (c[1])
                        for (o in t.converters) u[o.toLowerCase()] = t.converters[o];
                    for (s = c.shift(); s;)
                        if (t.responseFields[s] && (n[t.responseFields[s]] = e), !l && i && t.dataFilter && (e = t.dataFilter(e, t.dataType)), l = s, s = c.shift())
                            if ("*" === s) s = l;
                            else if ("*" !== l && l !== s) {
                        if (!(o = u[l + " " + s] || u["* " + s]))
                            for (r in u)
                                if ((a = r.split(" "))[1] === s && (o = u[l + " " + a[0]] || u["* " + a[0]])) {
                                    !0 === o ? o = u[r] : !0 !== u[r] && (s = a[0], c.unshift(a[1]));
                                    break
                                }
                        if (!0 !== o)
                            if (o && t.throws) e = o(e);
                            else try {
                                e = o(e)
                            } catch (t) {
                                return {
                                    state: "parsererror",
                                    error: o ? t : "No conversion from " + l + " to " + s
                                }
                            }
                    }
                    return {
                        state: "success",
                        data: e
                    }
                }(f, _, T, u), u ? (f.ifModified && ((b = T.getResponseHeader("Last-Modified")) && (w.lastModified[s] = b), (b = T.getResponseHeader("etag")) && (w.etag[s] = b)), 204 === e || "HEAD" === f.type ? C = "nocontent" : 304 === e ? C = "notmodified" : (C = _.state, p = _.data, u = !(d = _.error))) : (d = C, !e && C || (C = "error", e < 0 && (e = 0))), T.status = e, T.statusText = (n || C) + "", u ? v.resolveWith(g, [p, C, T]) : v.rejectWith(g, [T, C, d]), T.statusCode(x), x = void 0, h && m.trigger(u ? "ajaxSuccess" : "ajaxError", [T, f, u ? p : d]), y.fireWith(g, [T, C]), h && (m.trigger("ajaxComplete", [T, f]), --w.active || w.event.trigger("ajaxStop")))
            }
            return T
        },
        getJSON: function(t, e, n) {
            return w.get(t, e, n, "json")
        },
        getScript: function(t, e) {
            return w.get(t, void 0, e, "script")
        }
    }), w.each(["get", "post"], function(t, e) {
        w[e] = function(t, n, i, r) {
            return g(n) && (r = r || i, i = n, n = void 0), w.ajax(w.extend({
                url: t,
                type: e,
                dataType: r,
                data: n,
                success: i
            }, w.isPlainObject(t) && t))
        }
    }), w._evalUrl = function(t) {
        return w.ajax({
            url: t,
            type: "GET",
            dataType: "script",
            cache: !0,
            async: !1,
            global: !1,
            throws: !0
        })
    }, w.fn.extend({
        wrapAll: function(t) {
            var e;
            return this[0] && (g(t) && (t = t.call(this[0])), e = w(t, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && e.insertBefore(this[0]), e.map(function() {
                for (var t = this; t.firstElementChild;) t = t.firstElementChild;
                return t
            }).append(this)), this
        },
        wrapInner: function(t) {
            return g(t) ? this.each(function(e) {
                w(this).wrapInner(t.call(this, e))
            }) : this.each(function() {
                var e = w(this),
                    n = e.contents();
                n.length ? n.wrapAll(t) : e.append(t)
            })
        },
        wrap: function(t) {
            var e = g(t);
            return this.each(function(n) {
                w(this).wrapAll(e ? t.call(this, n) : t)
            })
        },
        unwrap: function(t) {
            return this.parent(t).not("body").each(function() {
                w(this).replaceWith(this.childNodes)
            }), this
        }
    }), w.expr.pseudos.hidden = function(t) {
        return !w.expr.pseudos.visible(t)
    }, w.expr.pseudos.visible = function(t) {
        return !!(t.offsetWidth || t.offsetHeight || t.getClientRects().length)
    }, w.ajaxSettings.xhr = function() {
        try {
            return new t.XMLHttpRequest
        } catch (t) {}
    };
    var Oe = {
            0: 200,
            1223: 204
        },
        Me = w.ajaxSettings.xhr();
    f.cors = !!Me && "withCredentials" in Me, f.ajax = Me = !!Me, w.ajaxTransport(function(e) {
        var n, i;
        if (f.cors || Me && !e.crossDomain) return {
            send: function(r, s) {
                var o, a = e.xhr();
                if (a.open(e.type, e.url, e.async, e.username, e.password), e.xhrFields)
                    for (o in e.xhrFields) a[o] = e.xhrFields[o];
                for (o in e.mimeType && a.overrideMimeType && a.overrideMimeType(e.mimeType), e.crossDomain || r["X-Requested-With"] || (r["X-Requested-With"] = "XMLHttpRequest"), r) a.setRequestHeader(o, r[o]);
                n = function(t) {
                    return function() {
                        n && (n = i = a.onload = a.onerror = a.onabort = a.ontimeout = a.onreadystatechange = null, "abort" === t ? a.abort() : "error" === t ? "number" != typeof a.status ? s(0, "error") : s(a.status, a.statusText) : s(Oe[a.status] || a.status, a.statusText, "text" !== (a.responseType || "text") || "string" != typeof a.responseText ? {
                            binary: a.response
                        } : {
                            text: a.responseText
                        }, a.getAllResponseHeaders()))
                    }
                }, a.onload = n(), i = a.onerror = a.ontimeout = n("error"), void 0 !== a.onabort ? a.onabort = i : a.onreadystatechange = function() {
                    4 === a.readyState && t.setTimeout(function() {
                        n && i()
                    })
                }, n = n("abort");
                try {
                    a.send(e.hasContent && e.data || null)
                } catch (t) {
                    if (n) throw t
                }
            },
            abort: function() {
                n && n()
            }
        }
    }), w.ajaxPrefilter(function(t) {
        t.crossDomain && (t.contents.script = !1)
    }), w.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /\b(?:java|ecma)script\b/
        },
        converters: {
            "text script": function(t) {
                return w.globalEval(t), t
            }
        }
    }), w.ajaxPrefilter("script", function(t) {
        void 0 === t.cache && (t.cache = !1), t.crossDomain && (t.type = "GET")
    }), w.ajaxTransport("script", function(t) {
        var e, n;
        if (t.crossDomain) return {
            send: function(r, s) {
                e = w("<script>").prop({
                    charset: t.scriptCharset,
                    src: t.url
                }).on("load error", n = function(t) {
                    e.remove(), n = null, t && s("error" === t.type ? 404 : 200, t.type)
                }), i.head.appendChild(e[0])
            },
            abort: function() {
                n && n()
            }
        }
    });
    var Re = [],
        Ie = /(=)\?(?=&|$)|\?\?/;
    w.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            var t = Re.pop() || w.expando + "_" + ye++;
            return this[t] = !0, t
        }
    }), w.ajaxPrefilter("json jsonp", function(e, n, i) {
        var r, s, o, a = !1 !== e.jsonp && (Ie.test(e.url) ? "url" : "string" == typeof e.data && 0 === (e.contentType || "").indexOf("application/x-www-form-urlencoded") && Ie.test(e.data) && "data");
        if (a || "jsonp" === e.dataTypes[0]) return r = e.jsonpCallback = g(e.jsonpCallback) ? e.jsonpCallback() : e.jsonpCallback, a ? e[a] = e[a].replace(Ie, "$1" + r) : !1 !== e.jsonp && (e.url += (xe.test(e.url) ? "&" : "?") + e.jsonp + "=" + r), e.converters["script json"] = function() {
            return o || w.error(r + " was not called"), o[0]
        }, e.dataTypes[0] = "json", s = t[r], t[r] = function() {
            o = arguments
        }, i.always(function() {
            void 0 === s ? w(t).removeProp(r) : t[r] = s, e[r] && (e.jsonpCallback = n.jsonpCallback, Re.push(r)), o && g(s) && s(o[0]), o = s = void 0
        }), "script"
    }), f.createHTMLDocument = function() {
        var t = i.implementation.createHTMLDocument("").body;
        return t.innerHTML = "<form></form><form></form>", 2 === t.childNodes.length
    }(), w.parseHTML = function(t, e, n) {
        return "string" != typeof t ? [] : ("boolean" == typeof e && (n = e, e = !1), e || (f.createHTMLDocument ? ((r = (e = i.implementation.createHTMLDocument("")).createElement("base")).href = i.location.href, e.head.appendChild(r)) : e = i), s = k.exec(t), o = !n && [], s ? [e.createElement(s[1])] : (s = mt([t], e, o), o && o.length && w(o).remove(), w.merge([], s.childNodes)));
        var r, s, o
    }, w.fn.load = function(t, e, n) {
        var i, r, s, o = this,
            a = t.indexOf(" ");
        return a > -1 && (i = he(t.slice(a)), t = t.slice(0, a)), g(e) ? (n = e, e = void 0) : e && "object" == typeof e && (r = "POST"), o.length > 0 && w.ajax({
            url: t,
            type: r || "GET",
            dataType: "html",
            data: e
        }).done(function(t) {
            s = arguments, o.html(i ? w("<div>").append(w.parseHTML(t)).find(i) : t)
        }).always(n && function(t, e) {
            o.each(function() {
                n.apply(this, s || [t.responseText, e, t])
            })
        }), this
    }, w.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(t, e) {
        w.fn[e] = function(t) {
            return this.on(e, t)
        }
    }), w.expr.pseudos.animated = function(t) {
        return w.grep(w.timers, function(e) {
            return t === e.elem
        }).length
    }, w.offset = {
        setOffset: function(t, e, n) {
            var i, r, s, o, a, l, u = w.css(t, "position"),
                c = w(t),
                h = {};
            "static" === u && (t.style.position = "relative"), a = c.offset(), s = w.css(t, "top"), l = w.css(t, "left"), ("absolute" === u || "fixed" === u) && (s + l).indexOf("auto") > -1 ? (o = (i = c.position()).top, r = i.left) : (o = parseFloat(s) || 0, r = parseFloat(l) || 0), g(e) && (e = e.call(t, n, w.extend({}, a))), null != e.top && (h.top = e.top - a.top + o), null != e.left && (h.left = e.left - a.left + r), "using" in e ? e.using.call(t, h) : c.css(h)
        }
    }, w.fn.extend({
        offset: function(t) {
            if (arguments.length) return void 0 === t ? this : this.each(function(e) {
                w.offset.setOffset(this, t, e)
            });
            var e, n, i = this[0];
            return i ? i.getClientRects().length ? {
                top: (e = i.getBoundingClientRect()).top + (n = i.ownerDocument.defaultView).pageYOffset,
                left: e.left + n.pageXOffset
            } : {
                top: 0,
                left: 0
            } : void 0
        },
        position: function() {
            if (this[0]) {
                var t, e, n, i = this[0],
                    r = {
                        top: 0,
                        left: 0
                    };
                if ("fixed" === w.css(i, "position")) e = i.getBoundingClientRect();
                else {
                    for (e = this.offset(), n = i.ownerDocument, t = i.offsetParent || n.documentElement; t && (t === n.body || t === n.documentElement) && "static" === w.css(t, "position");) t = t.parentNode;
                    t && t !== i && 1 === t.nodeType && ((r = w(t).offset()).top += w.css(t, "borderTopWidth", !0), r.left += w.css(t, "borderLeftWidth", !0))
                }
                return {
                    top: e.top - r.top - w.css(i, "marginTop", !0),
                    left: e.left - r.left - w.css(i, "marginLeft", !0)
                }
            }
        },
        offsetParent: function() {
            return this.map(function() {
                for (var t = this.offsetParent; t && "static" === w.css(t, "position");) t = t.offsetParent;
                return t || vt
            })
        }
    }), w.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    }, function(t, e) {
        var n = "pageYOffset" === e;
        w.fn[t] = function(i) {
            return W(this, function(t, i, r) {
                var s;
                if (m(t) ? s = t : 9 === t.nodeType && (s = t.defaultView), void 0 === r) return s ? s[e] : t[i];
                s ? s.scrollTo(n ? s.pageXOffset : r, n ? r : s.pageYOffset) : t[i] = r
            }, t, i, arguments.length)
        }
    }), w.each(["top", "left"], function(t, e) {
        w.cssHooks[e] = Rt(f.pixelPosition, function(t, n) {
            if (n) return n = Mt(t, e), Ht.test(n) ? w(t).position()[e] + "px" : n
        })
    }), w.each({
        Height: "height",
        Width: "width"
    }, function(t, e) {
        w.each({
            padding: "inner" + t,
            content: e,
            "": "outer" + t
        }, function(n, i) {
            w.fn[i] = function(r, s) {
                var o = arguments.length && (n || "boolean" != typeof r),
                    a = n || (!0 === r || !0 === s ? "margin" : "border");
                return W(this, function(e, n, r) {
                    var s;
                    return m(e) ? 0 === i.indexOf("outer") ? e["inner" + t] : e.document.documentElement["client" + t] : 9 === e.nodeType ? (s = e.documentElement, Math.max(e.body["scroll" + t], s["scroll" + t], e.body["offset" + t], s["offset" + t], s["client" + t])) : void 0 === r ? w.css(e, n, a) : w.style(e, n, r, a)
                }, e, o ? r : void 0, o)
            }
        })
    }), w.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function(t, e) {
        w.fn[e] = function(t, n) {
            return arguments.length > 0 ? this.on(e, null, t, n) : this.trigger(e)
        }
    }), w.fn.extend({
        hover: function(t, e) {
            return this.mouseenter(t).mouseleave(e || t)
        }
    }), w.fn.extend({
        bind: function(t, e, n) {
            return this.on(t, null, e, n)
        },
        unbind: function(t, e) {
            return this.off(t, null, e)
        },
        delegate: function(t, e, n, i) {
            return this.on(e, t, n, i)
        },
        undelegate: function(t, e, n) {
            return 1 === arguments.length ? this.off(t, "**") : this.off(e, t || "**", n)
        }
    }), w.proxy = function(t, e) {
        var n, i, r;
        if ("string" == typeof e && (n = t[e], e = t, t = n), g(t)) return i = s.call(arguments, 2), (r = function() {
            return t.apply(e || this, i.concat(s.call(arguments)))
        }).guid = t.guid = t.guid || w.guid++, r
    }, w.holdReady = function(t) {
        t ? w.readyWait++ : w.ready(!0)
    }, w.isArray = Array.isArray, w.parseJSON = JSON.parse, w.nodeName = S, w.isFunction = g, w.isWindow = m, w.camelCase = X, w.type = x, w.now = Date.now, w.isNumeric = function(t) {
        var e = w.type(t);
        return ("number" === e || "string" === e) && !isNaN(t - parseFloat(t))
    }, "function" == typeof define && define.amd && define("jquery", [], function() {
        return w
    });
    var We = t.jQuery,
        Be = t.$;
    return w.noConflict = function(e) {
        return t.$ === w && (t.$ = Be), e && t.jQuery === w && (t.jQuery = We), w
    }, e || (t.jQuery = t.$ = w), w
}),
function(t, e, n, i) {
    function r(e, n) {
        this.settings = null, this.options = t.extend({}, r.Defaults, n), this.$element = t(e), this._handlers = {}, this._plugins = {}, this._supress = {}, this._current = null, this._speed = null, this._coordinates = [], this._breakpoint = null, this._width = null, this._items = [], this._clones = [], this._mergers = [], this._widths = [], this._invalidated = {}, this._pipe = [], this._drag = {
            time: null,
            target: null,
            pointer: null,
            stage: {
                start: null,
                current: null
            },
            direction: null
        }, this._states = {
            current: {},
            tags: {
                initializing: ["busy"],
                animating: ["busy"],
                dragging: ["interacting"]
            }
        }, t.each(["onResize", "onThrottledResize"], t.proxy(function(e, n) {
            this._handlers[n] = t.proxy(this[n], this)
        }, this)), t.each(r.Plugins, t.proxy(function(t, e) {
            this._plugins[t.charAt(0).toLowerCase() + t.slice(1)] = new e(this)
        }, this)), t.each(r.Workers, t.proxy(function(e, n) {
            this._pipe.push({
                filter: n.filter,
                run: t.proxy(n.run, this)
            })
        }, this)), this.setup(), this.initialize()
    }
    r.Defaults = {
        items: 3,
        loop: !1,
        center: !1,
        rewind: !1,
        checkVisibility: !0,
        mouseDrag: !0,
        touchDrag: !0,
        pullDrag: !0,
        freeDrag: !1,
        margin: 0,
        stagePadding: 0,
        merge: !1,
        mergeFit: !0,
        autoWidth: !1,
        startPosition: 0,
        rtl: !1,
        smartSpeed: 250,
        fluidSpeed: !1,
        dragEndSpeed: !1,
        responsive: {},
        responsiveRefreshRate: 200,
        responsiveBaseElement: e,
        fallbackEasing: "swing",
        slideTransition: "",
        info: !1,
        nestedItemSelector: !1,
        itemElement: "div",
        stageElement: "div",
        refreshClass: "owl-refresh",
        loadedClass: "owl-loaded",
        loadingClass: "owl-loading",
        rtlClass: "owl-rtl",
        responsiveClass: "owl-responsive",
        dragClass: "owl-drag",
        itemClass: "owl-item",
        stageClass: "owl-stage",
        stageOuterClass: "owl-stage-outer",
        grabClass: "owl-grab"
    }, r.Width = {
        Default: "default",
        Inner: "inner",
        Outer: "outer"
    }, r.Type = {
        Event: "event",
        State: "state"
    }, r.Plugins = {}, r.Workers = [{
        filter: ["width", "settings"],
        run: function() {
            this._width = this.$element.width()
        }
    }, {
        filter: ["width", "items", "settings"],
        run: function(t) {
            t.current = this._items && this._items[this.relative(this._current)]
        }
    }, {
        filter: ["items", "settings"],
        run: function() {
            this.$stage.children(".cloned").remove()
        }
    }, {
        filter: ["width", "items", "settings"],
        run: function(t) {
            var e = this.settings.margin || "",
                n = this.settings.rtl,
                i = {
                    width: "auto",
                    "margin-left": n ? e : "",
                    "margin-right": n ? "" : e
                };
            !!this.settings.autoWidth && this.$stage.children().css(i), t.css = i
        }
    }, {
        filter: ["width", "items", "settings"],
        run: function(t) {
            var e = (this.width() / this.settings.items).toFixed(3) - this.settings.margin,
                n = null,
                i = this._items.length,
                r = !this.settings.autoWidth,
                s = [];
            for (t.items = {
                    merge: !1,
                    width: e
                }; i--;) n = this._mergers[i], n = this.settings.mergeFit && Math.min(n, this.settings.items) || n, t.items.merge = n > 1 || t.items.merge, s[i] = r ? e * n : this._items[i].width();
            this._widths = s
        }
    }, {
        filter: ["items", "settings"],
        run: function() {
            var e = [],
                n = this._items,
                i = this.settings,
                r = Math.max(2 * i.items, 4),
                s = 2 * Math.ceil(n.length / 2),
                o = i.loop && n.length ? i.rewind ? r : Math.max(r, s) : 0,
                a = "",
                l = "";
            for (o /= 2; o > 0;) e.push(this.normalize(e.length / 2, !0)), a += n[e[e.length - 1]][0].outerHTML, e.push(this.normalize(n.length - 1 - (e.length - 1) / 2, !0)), l = n[e[e.length - 1]][0].outerHTML + l, o -= 1;
            this._clones = e, t(a).addClass("cloned").appendTo(this.$stage), t(l).addClass("cloned").prependTo(this.$stage)
        }
    }, {
        filter: ["width", "items", "settings"],
        run: function() {
            for (var t = this.settings.rtl ? 1 : -1, e = this._clones.length + this._items.length, n = -1, i = 0, r = 0, s = []; ++n < e;) i = s[n - 1] || 0, r = this._widths[this.relative(n)] + this.settings.margin, s.push(i + r * t);
            this._coordinates = s
        }
    }, {
        filter: ["width", "items", "settings"],
        run: function() {
            var t = this.settings.stagePadding,
                e = this._coordinates,
                n = {
                    width: Math.ceil(Math.abs(e[e.length - 1])) + 2 * t,
                    "padding-left": t || "",
                    "padding-right": t || ""
                };
            this.$stage.css(n)
        }
    }, {
        filter: ["width", "items", "settings"],
        run: function(t) {
            var e = this._coordinates.length,
                n = !this.settings.autoWidth,
                i = this.$stage.children();
            if (n && t.items.merge)
                for (; e--;) t.css.width = this._widths[this.relative(e)], i.eq(e).css(t.css);
            else n && (t.css.width = t.items.width, i.css(t.css))
        }
    }, {
        filter: ["items"],
        run: function() {
            this._coordinates.length < 1 && this.$stage.removeAttr("style")
        }
    }, {
        filter: ["width", "items", "settings"],
        run: function(t) {
            t.current = t.current ? this.$stage.children().index(t.current) : 0, t.current = Math.max(this.minimum(), Math.min(this.maximum(), t.current)), this.reset(t.current)
        }
    }, {
        filter: ["position"],
        run: function() {
            this.animate(this.coordinates(this._current))
        }
    }, {
        filter: ["width", "position", "items", "settings"],
        run: function() {
            var t, e, n, i, r = this.settings.rtl ? 1 : -1,
                s = 2 * this.settings.stagePadding,
                o = this.coordinates(this.current()) + s,
                a = o + this.width() * r,
                l = [];
            for (n = 0, i = this._coordinates.length; n < i; n++) t = this._coordinates[n - 1] || 0, e = Math.abs(this._coordinates[n]) + s * r, (this.op(t, "<=", o) && this.op(t, ">", a) || this.op(e, "<", o) && this.op(e, ">", a)) && l.push(n);
            this.$stage.children(".active").removeClass("active"), this.$stage.children(":eq(" + l.join("), :eq(") + ")").addClass("active"), this.$stage.children(".center").removeClass("center"), this.settings.center && this.$stage.children().eq(this.current()).addClass("center")
        }
    }], r.prototype.initializeStage = function() {
        this.$stage = this.$element.find("." + this.settings.stageClass), this.$stage.length || (this.$element.addClass(this.options.loadingClass), this.$stage = t("<" + this.settings.stageElement + ">", {
            class: this.settings.stageClass
        }).wrap(t("<div/>", {
            class: this.settings.stageOuterClass
        })), this.$element.append(this.$stage.parent()))
    }, r.prototype.initializeItems = function() {
        var e = this.$element.find(".owl-item");
        if (e.length) return this._items = e.get().map(function(e) {
            return t(e)
        }), this._mergers = this._items.map(function() {
            return 1
        }), void this.refresh();
        this.replace(this.$element.children().not(this.$stage.parent())), this.isVisible() ? this.refresh() : this.invalidate("width"), this.$element.removeClass(this.options.loadingClass).addClass(this.options.loadedClass)
    }, r.prototype.initialize = function() {
        var t, e;
        this.enter("initializing"), this.trigger("initialize"), this.$element.toggleClass(this.settings.rtlClass, this.settings.rtl), this.settings.autoWidth && !this.is("pre-loading") && (t = this.$element.find("img"), e = this.$element.children(this.settings.nestedItemSelector ? "." + this.settings.nestedItemSelector : i).width(), t.length && e <= 0 && this.preloadAutoWidthImages(t)), this.initializeStage(), this.initializeItems(), this.registerEventHandlers(), this.leave("initializing"), this.trigger("initialized")
    }, r.prototype.isVisible = function() {
        return !this.settings.checkVisibility || this.$element.is(":visible")
    }, r.prototype.setup = function() {
        var e = this.viewport(),
            n = this.options.responsive,
            i = -1,
            r = null;
        n ? (t.each(n, function(t) {
            t <= e && t > i && (i = Number(t))
        }), "function" == typeof(r = t.extend({}, this.options, n[i])).stagePadding && (r.stagePadding = r.stagePadding()), delete r.responsive, r.responsiveClass && this.$element.attr("class", this.$element.attr("class").replace(new RegExp("(" + this.options.responsiveClass + "-)\\S+\\s", "g"), "$1" + i))) : r = t.extend({}, this.options), this.trigger("change", {
            property: {
                name: "settings",
                value: r
            }
        }), this._breakpoint = i, this.settings = r, this.invalidate("settings"), this.trigger("changed", {
            property: {
                name: "settings",
                value: this.settings
            }
        })
    }, r.prototype.optionsLogic = function() {
        this.settings.autoWidth && (this.settings.stagePadding = !1, this.settings.merge = !1)
    }, r.prototype.prepare = function(e) {
        var n = this.trigger("prepare", {
            content: e
        });
        return n.data || (n.data = t("<" + this.settings.itemElement + "/>").addClass(this.options.itemClass).append(e)), this.trigger("prepared", {
            content: n.data
        }), n.data
    }, r.prototype.update = function() {
        for (var e = 0, n = this._pipe.length, i = t.proxy(function(t) {
                return this[t]
            }, this._invalidated), r = {}; e < n;)(this._invalidated.all || t.grep(this._pipe[e].filter, i).length > 0) && this._pipe[e].run(r), e++;
        this._invalidated = {}, !this.is("valid") && this.enter("valid")
    }, r.prototype.width = function(t) {
        switch (t = t || r.Width.Default) {
            case r.Width.Inner:
            case r.Width.Outer:
                return this._width;
            default:
                return this._width - 2 * this.settings.stagePadding + this.settings.margin
        }
    }, r.prototype.refresh = function() {
        this.enter("refreshing"), this.trigger("refresh"), this.setup(), this.optionsLogic(), this.$element.addClass(this.options.refreshClass), this.update(), this.$element.removeClass(this.options.refreshClass), this.leave("refreshing"), this.trigger("refreshed")
    }, r.prototype.onThrottledResize = function() {
        e.clearTimeout(this.resizeTimer), this.resizeTimer = e.setTimeout(this._handlers.onResize, this.settings.responsiveRefreshRate)
    }, r.prototype.onResize = function() {
        return !!this._items.length && this._width !== this.$element.width() && !!this.isVisible() && (this.enter("resizing"), this.trigger("resize").isDefaultPrevented() ? (this.leave("resizing"), !1) : (this.invalidate("width"), this.refresh(), this.leave("resizing"), void this.trigger("resized")))
    }, r.prototype.registerEventHandlers = function() {
        t.support.transition && this.$stage.on(t.support.transition.end + ".owl.core", t.proxy(this.onTransitionEnd, this)), !1 !== this.settings.responsive && this.on(e, "resize", this._handlers.onThrottledResize), this.settings.mouseDrag && (this.$element.addClass(this.options.dragClass), this.$stage.on("mousedown.owl.core", t.proxy(this.onDragStart, this)), this.$stage.on("dragstart.owl.core selectstart.owl.core", function() {
            return !1
        })), this.settings.touchDrag && (this.$stage.on("touchstart.owl.core", t.proxy(this.onDragStart, this)), this.$stage.on("touchcancel.owl.core", t.proxy(this.onDragEnd, this)))
    }, r.prototype.onDragStart = function(e) {
        var i = null;
        3 !== e.which && (t.support.transform ? i = {
            x: (i = this.$stage.css("transform").replace(/.*\(|\)| /g, "").split(","))[16 === i.length ? 12 : 4],
            y: i[16 === i.length ? 13 : 5]
        } : (i = this.$stage.position(), i = {
            x: this.settings.rtl ? i.left + this.$stage.width() - this.width() + this.settings.margin : i.left,
            y: i.top
        }), this.is("animating") && (t.support.transform ? this.animate(i.x) : this.$stage.stop(), this.invalidate("position")), this.$element.toggleClass(this.options.grabClass, "mousedown" === e.type), this.speed(0), this._drag.time = (new Date).getTime(), this._drag.target = t(e.target), this._drag.stage.start = i, this._drag.stage.current = i, this._drag.pointer = this.pointer(e), t(n).on("mouseup.owl.core touchend.owl.core", t.proxy(this.onDragEnd, this)), t(n).one("mousemove.owl.core touchmove.owl.core", t.proxy(function(e) {
            var i = this.difference(this._drag.pointer, this.pointer(e));
            t(n).on("mousemove.owl.core touchmove.owl.core", t.proxy(this.onDragMove, this)), Math.abs(i.x) < Math.abs(i.y) && this.is("valid") || (e.preventDefault(), this.enter("dragging"), this.trigger("drag"))
        }, this)))
    }, r.prototype.onDragMove = function(t) {
        var e = null,
            n = null,
            i = null,
            r = this.difference(this._drag.pointer, this.pointer(t)),
            s = this.difference(this._drag.stage.start, r);
        this.is("dragging") && (t.preventDefault(), this.settings.loop ? (e = this.coordinates(this.minimum()), n = this.coordinates(this.maximum() + 1) - e, s.x = ((s.x - e) % n + n) % n + e) : (e = this.coordinates(this.settings.rtl ? this.maximum() : this.minimum()), n = this.coordinates(this.settings.rtl ? this.minimum() : this.maximum()), i = this.settings.pullDrag ? -1 * r.x / 5 : 0, s.x = Math.max(Math.min(s.x, e + i), n + i)), this._drag.stage.current = s, this.animate(s.x))
    }, r.prototype.onDragEnd = function(e) {
        var i = this.difference(this._drag.pointer, this.pointer(e)),
            r = this._drag.stage.current,
            s = i.x > 0 ^ this.settings.rtl ? "left" : "right";
        t(n).off(".owl.core"), this.$element.removeClass(this.options.grabClass), (0 !== i.x && this.is("dragging") || !this.is("valid")) && (this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed), this.current(this.closest(r.x, 0 !== i.x ? s : this._drag.direction)), this.invalidate("position"), this.update(), this._drag.direction = s, (Math.abs(i.x) > 3 || (new Date).getTime() - this._drag.time > 300) && this._drag.target.one("click.owl.core", function() {
            return !1
        })), this.is("dragging") && (this.leave("dragging"), this.trigger("dragged"))
    }, r.prototype.closest = function(e, n) {
        var r = -1,
            s = this.width(),
            o = this.coordinates();
        return this.settings.freeDrag || t.each(o, t.proxy(function(t, a) {
            return "left" === n && e > a - 30 && e < a + 30 ? r = t : "right" === n && e > a - s - 30 && e < a - s + 30 ? r = t + 1 : this.op(e, "<", a) && this.op(e, ">", o[t + 1] !== i ? o[t + 1] : a - s) && (r = "left" === n ? t + 1 : t), -1 === r
        }, this)), this.settings.loop || (this.op(e, ">", o[this.minimum()]) ? r = e = this.minimum() : this.op(e, "<", o[this.maximum()]) && (r = e = this.maximum())), r
    }, r.prototype.animate = function(e) {
        var n = this.speed() > 0;
        this.is("animating") && this.onTransitionEnd(), n && (this.enter("animating"), this.trigger("translate")), t.support.transform3d && t.support.transition ? this.$stage.css({
            transform: "translate3d(" + e + "px,0px,0px)",
            transition: this.speed() / 1e3 + "s" + (this.settings.slideTransition ? " " + this.settings.slideTransition : "")
        }) : n ? this.$stage.animate({
            left: e + "px"
        }, this.speed(), this.settings.fallbackEasing, t.proxy(this.onTransitionEnd, this)) : this.$stage.css({
            left: e + "px"
        })
    }, r.prototype.is = function(t) {
        return this._states.current[t] && this._states.current[t] > 0
    }, r.prototype.current = function(t) {
        if (t === i) return this._current;
        if (0 === this._items.length) return i;
        if (t = this.normalize(t), this._current !== t) {
            var e = this.trigger("change", {
                property: {
                    name: "position",
                    value: t
                }
            });
            e.data !== i && (t = this.normalize(e.data)), this._current = t, this.invalidate("position"), this.trigger("changed", {
                property: {
                    name: "position",
                    value: this._current
                }
            })
        }
        return this._current
    }, r.prototype.invalidate = function(e) {
        return "string" === t.type(e) && (this._invalidated[e] = !0, this.is("valid") && this.leave("valid")), t.map(this._invalidated, function(t, e) {
            return e
        })
    }, r.prototype.reset = function(t) {
        (t = this.normalize(t)) !== i && (this._speed = 0, this._current = t, this.suppress(["translate", "translated"]), this.animate(this.coordinates(t)), this.release(["translate", "translated"]))
    }, r.prototype.normalize = function(t, e) {
        var n = this._items.length,
            r = e ? 0 : this._clones.length;
        return !this.isNumeric(t) || n < 1 ? t = i : (t < 0 || t >= n + r) && (t = ((t - r / 2) % n + n) % n + r / 2), t
    }, r.prototype.relative = function(t) {
        return this.normalize(t -= this._clones.length / 2, !0)
    }, r.prototype.maximum = function(t) {
        var e, n, i, r = this.settings,
            s = this._coordinates.length;
        if (r.loop) s = this._clones.length / 2 + this._items.length - 1;
        else if (r.autoWidth || r.merge) {
            if (e = this._items.length)
                for (n = this._items[--e].width(), i = this.$element.width(); e-- && !((n += this._items[e].width() + this.settings.margin) > i););
            s = e + 1
        } else s = r.center ? this._items.length - 1 : this._items.length - r.items;
        return t && (s -= this._clones.length / 2), Math.max(s, 0)
    }, r.prototype.minimum = function(t) {
        return t ? 0 : this._clones.length / 2
    }, r.prototype.items = function(t) {
        return t === i ? this._items.slice() : (t = this.normalize(t, !0), this._items[t])
    }, r.prototype.mergers = function(t) {
        return t === i ? this._mergers.slice() : (t = this.normalize(t, !0), this._mergers[t])
    }, r.prototype.clones = function(e) {
        var n = this._clones.length / 2,
            r = n + this._items.length,
            s = function(t) {
                return t % 2 == 0 ? r + t / 2 : n - (t + 1) / 2
            };
        return t.map(this._clones, e === i ? function(t, e) {
            return s(e)
        } : function(t, n) {
            return t === e ? s(n) : null
        })
    }, r.prototype.speed = function(t) {
        return t !== i && (this._speed = t), this._speed
    }, r.prototype.coordinates = function(e) {
        var n, r = 1,
            s = e - 1;
        return e === i ? t.map(this._coordinates, t.proxy(function(t, e) {
            return this.coordinates(e)
        }, this)) : (this.settings.center ? (this.settings.rtl && (r = -1, s = e + 1), n = this._coordinates[e], n += (this.width() - n + (this._coordinates[s] || 0)) / 2 * r) : n = this._coordinates[s] || 0, n = Math.ceil(n))
    }, r.prototype.duration = function(t, e, n) {
        return 0 === n ? 0 : Math.min(Math.max(Math.abs(e - t), 1), 6) * Math.abs(n || this.settings.smartSpeed)
    }, r.prototype.to = function(t, e) {
        var n = this.current(),
            i = null,
            r = t - this.relative(n),
            s = (r > 0) - (r < 0),
            o = this._items.length,
            a = this.minimum(),
            l = this.maximum();
        this.settings.loop ? (!this.settings.rewind && Math.abs(r) > o / 2 && (r += -1 * s * o), (i = (((t = n + r) - a) % o + o) % o + a) !== t && i - r <= l && i - r > 0 && (t = i, this.reset(n = i - r))) : t = this.settings.rewind ? (t % (l += 1) + l) % l : Math.max(a, Math.min(l, t)), this.speed(this.duration(n, t, e)), this.current(t), this.isVisible() && this.update()
    }, r.prototype.next = function(t) {
        t = t || !1, this.to(this.relative(this.current()) + 1, t)
    }, r.prototype.prev = function(t) {
        t = t || !1, this.to(this.relative(this.current()) - 1, t)
    }, r.prototype.onTransitionEnd = function(t) {
        if (t !== i && (t.stopPropagation(), (t.target || t.srcElement || t.originalTarget) !== this.$stage.get(0))) return !1;
        this.leave("animating"), this.trigger("translated")
    }, r.prototype.viewport = function() {
        var i;
        return this.options.responsiveBaseElement !== e ? i = t(this.options.responsiveBaseElement).width() : e.innerWidth ? i = e.innerWidth : n.documentElement && n.documentElement.clientWidth ? i = n.documentElement.clientWidth : console.warn("Can not detect viewport width."), i
    }, r.prototype.replace = function(e) {
        this.$stage.empty(), this._items = [], e && (e = e instanceof jQuery ? e : t(e)), this.settings.nestedItemSelector && (e = e.find("." + this.settings.nestedItemSelector)), e.filter(function() {
            return 1 === this.nodeType
        }).each(t.proxy(function(t, e) {
            e = this.prepare(e), this.$stage.append(e), this._items.push(e), this._mergers.push(1 * e.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1)
        }, this)), this.reset(this.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0), this.invalidate("items")
    }, r.prototype.add = function(e, n) {
        var r = this.relative(this._current);
        n = n === i ? this._items.length : this.normalize(n, !0), e = e instanceof jQuery ? e : t(e), this.trigger("add", {
            content: e,
            position: n
        }), e = this.prepare(e), 0 === this._items.length || n === this._items.length ? (0 === this._items.length && this.$stage.append(e), 0 !== this._items.length && this._items[n - 1].after(e), this._items.push(e), this._mergers.push(1 * e.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1)) : (this._items[n].before(e), this._items.splice(n, 0, e), this._mergers.splice(n, 0, 1 * e.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1)), this._items[r] && this.reset(this._items[r].index()), this.invalidate("items"), this.trigger("added", {
            content: e,
            position: n
        })
    }, r.prototype.remove = function(t) {
        (t = this.normalize(t, !0)) !== i && (this.trigger("remove", {
            content: this._items[t],
            position: t
        }), this._items[t].remove(), this._items.splice(t, 1), this._mergers.splice(t, 1), this.invalidate("items"), this.trigger("removed", {
            content: null,
            position: t
        }))
    }, r.prototype.preloadAutoWidthImages = function(e) {
        e.each(t.proxy(function(e, n) {
            this.enter("pre-loading"), n = t(n), t(new Image).one("load", t.proxy(function(t) {
                n.attr("src", t.target.src), n.css("opacity", 1), this.leave("pre-loading"), !this.is("pre-loading") && !this.is("initializing") && this.refresh()
            }, this)).attr("src", n.attr("src") || n.attr("data-src") || n.attr("data-src-retina"))
        }, this))
    }, r.prototype.destroy = function() {
        for (var i in this.$element.off(".owl.core"), this.$stage.off(".owl.core"), t(n).off(".owl.core"), !1 !== this.settings.responsive && (e.clearTimeout(this.resizeTimer), this.off(e, "resize", this._handlers.onThrottledResize)), this._plugins) this._plugins[i].destroy();
        this.$stage.children(".cloned").remove(), this.$stage.unwrap(), this.$stage.children().contents().unwrap(), this.$stage.children().unwrap(), this.$stage.remove(), this.$element.removeClass(this.options.refreshClass).removeClass(this.options.loadingClass).removeClass(this.options.loadedClass).removeClass(this.options.rtlClass).removeClass(this.options.dragClass).removeClass(this.options.grabClass).attr("class", this.$element.attr("class").replace(new RegExp(this.options.responsiveClass + "-\\S+\\s", "g"), "")).removeData("owl.carousel")
    }, r.prototype.op = function(t, e, n) {
        var i = this.settings.rtl;
        switch (e) {
            case "<":
                return i ? t > n : t < n;
            case ">":
                return i ? t < n : t > n;
            case ">=":
                return i ? t <= n : t >= n;
            case "<=":
                return i ? t >= n : t <= n
        }
    }, r.prototype.on = function(t, e, n, i) {
        t.addEventListener ? t.addEventListener(e, n, i) : t.attachEvent && t.attachEvent("on" + e, n)
    }, r.prototype.off = function(t, e, n, i) {
        t.removeEventListener ? t.removeEventListener(e, n, i) : t.detachEvent && t.detachEvent("on" + e, n)
    }, r.prototype.trigger = function(e, n, i, s, o) {
        var a = {
                item: {
                    count: this._items.length,
                    index: this.current()
                }
            },
            l = t.camelCase(t.grep(["on", e, i], function(t) {
                return t
            }).join("-").toLowerCase()),
            u = t.Event([e, "owl", i || "carousel"].join(".").toLowerCase(), t.extend({
                relatedTarget: this
            }, a, n));
        return this._supress[e] || (t.each(this._plugins, function(t, e) {
            e.onTrigger && e.onTrigger(u)
        }), this.register({
            type: r.Type.Event,
            name: e
        }), this.$element.trigger(u), this.settings && "function" == typeof this.settings[l] && this.settings[l].call(this, u)), u
    }, r.prototype.enter = function(e) {
        t.each([e].concat(this._states.tags[e] || []), t.proxy(function(t, e) {
            this._states.current[e] === i && (this._states.current[e] = 0), this._states.current[e]++
        }, this))
    }, r.prototype.leave = function(e) {
        t.each([e].concat(this._states.tags[e] || []), t.proxy(function(t, e) {
            this._states.current[e]--
        }, this))
    }, r.prototype.register = function(e) {
        if (e.type === r.Type.Event) {
            if (t.event.special[e.name] || (t.event.special[e.name] = {}), !t.event.special[e.name].owl) {
                var n = t.event.special[e.name]._default;
                t.event.special[e.name]._default = function(t) {
                    return !n || !n.apply || t.namespace && -1 !== t.namespace.indexOf("owl") ? t.namespace && t.namespace.indexOf("owl") > -1 : n.apply(this, arguments)
                }, t.event.special[e.name].owl = !0
            }
        } else e.type === r.Type.State && (this._states.tags[e.name] = this._states.tags[e.name] ? this._states.tags[e.name].concat(e.tags) : e.tags, this._states.tags[e.name] = t.grep(this._states.tags[e.name], t.proxy(function(n, i) {
            return t.inArray(n, this._states.tags[e.name]) === i
        }, this)))
    }, r.prototype.suppress = function(e) {
        t.each(e, t.proxy(function(t, e) {
            this._supress[e] = !0
        }, this))
    }, r.prototype.release = function(e) {
        t.each(e, t.proxy(function(t, e) {
            delete this._supress[e]
        }, this))
    }, r.prototype.pointer = function(t) {
        var n = {
            x: null,
            y: null
        };
        return (t = (t = t.originalEvent || t || e.event).touches && t.touches.length ? t.touches[0] : t.changedTouches && t.changedTouches.length ? t.changedTouches[0] : t).pageX ? (n.x = t.pageX, n.y = t.pageY) : (n.x = t.clientX, n.y = t.clientY), n
    }, r.prototype.isNumeric = function(t) {
        return !isNaN(parseFloat(t))
    }, r.prototype.difference = function(t, e) {
        return {
            x: t.x - e.x,
            y: t.y - e.y
        }
    }, t.fn.owlCarousel = function(e) {
        var n = Array.prototype.slice.call(arguments, 1);
        return this.each(function() {
            var i = t(this),
                s = i.data("owl.carousel");
            s || (s = new r(this, "object" == typeof e && e), i.data("owl.carousel", s), t.each(["next", "prev", "to", "destroy", "refresh", "replace", "add", "remove"], function(e, n) {
                s.register({
                    type: r.Type.Event,
                    name: n
                }), s.$element.on(n + ".owl.carousel.core", t.proxy(function(t) {
                    t.namespace && t.relatedTarget !== this && (this.suppress([n]), s[n].apply(this, [].slice.call(arguments, 1)), this.release([n]))
                }, s))
            })), "string" == typeof e && "_" !== e.charAt(0) && s[e].apply(s, n)
        })
    }, t.fn.owlCarousel.Constructor = r
}(window.Zepto || window.jQuery, window, document),
function(t, e, n, i) {
    var r = function(e) {
        this._core = e, this._interval = null, this._visible = null, this._handlers = {
            "initialized.owl.carousel": t.proxy(function(t) {
                t.namespace && this._core.settings.autoRefresh && this.watch()
            }, this)
        }, this._core.options = t.extend({}, r.Defaults, this._core.options), this._core.$element.on(this._handlers)
    };
    r.Defaults = {
        autoRefresh: !0,
        autoRefreshInterval: 500
    }, r.prototype.watch = function() {
        this._interval || (this._visible = this._core.isVisible(), this._interval = e.setInterval(t.proxy(this.refresh, this), this._core.settings.autoRefreshInterval))
    }, r.prototype.refresh = function() {
        this._core.isVisible() !== this._visible && (this._visible = !this._visible, this._core.$element.toggleClass("owl-hidden", !this._visible), this._visible && this._core.invalidate("width") && this._core.refresh())
    }, r.prototype.destroy = function() {
        var t, n;
        for (t in e.clearInterval(this._interval), this._handlers) this._core.$element.off(t, this._handlers[t]);
        for (n in Object.getOwnPropertyNames(this)) "function" != typeof this[n] && (this[n] = null)
    }, t.fn.owlCarousel.Constructor.Plugins.AutoRefresh = r
}(window.Zepto || window.jQuery, window, document),
function(t, e, n, i) {
    var r = function(e) {
        this._core = e, this._loaded = [], this._handlers = {
            "initialized.owl.carousel change.owl.carousel resized.owl.carousel": t.proxy(function(e) {
                if (e.namespace && this._core.settings && this._core.settings.lazyLoad && (e.property && "position" == e.property.name || "initialized" == e.type)) {
                    var n = this._core.settings,
                        i = n.center && Math.ceil(n.items / 2) || n.items,
                        r = n.center && -1 * i || 0,
                        s = (e.property && void 0 !== e.property.value ? e.property.value : this._core.current()) + r,
                        o = this._core.clones().length,
                        a = t.proxy(function(t, e) {
                            this.load(e)
                        }, this);
                    for (n.lazyLoadEager > 0 && (i += n.lazyLoadEager, n.loop && (s -= n.lazyLoadEager, i++)); r++ < i;) this.load(o / 2 + this._core.relative(s)), o && t.each(this._core.clones(this._core.relative(s)), a), s++
                }
            }, this)
        }, this._core.options = t.extend({}, r.Defaults, this._core.options), this._core.$element.on(this._handlers)
    };
    r.Defaults = {
        lazyLoad: !1,
        lazyLoadEager: 0
    }, r.prototype.load = function(n) {
        var i = this._core.$stage.children().eq(n),
            r = i && i.find(".owl-lazy");
        !r || t.inArray(i.get(0), this._loaded) > -1 || (r.each(t.proxy(function(n, i) {
            var r, s = t(i),
                o = e.devicePixelRatio > 1 && s.attr("data-src-retina") || s.attr("data-src") || s.attr("data-srcset");
            this._core.trigger("load", {
                element: s,
                url: o
            }, "lazy"), s.is("img") ? s.one("load.owl.lazy", t.proxy(function() {
                s.css("opacity", 1), this._core.trigger("loaded", {
                    element: s,
                    url: o
                }, "lazy")
            }, this)).attr("src", o) : s.is("source") ? s.one("load.owl.lazy", t.proxy(function() {
                this._core.trigger("loaded", {
                    element: s,
                    url: o
                }, "lazy")
            }, this)).attr("srcset", o) : ((r = new Image).onload = t.proxy(function() {
                s.css({
                    "background-image": 'url("' + o + '")',
                    opacity: "1"
                }), this._core.trigger("loaded", {
                    element: s,
                    url: o
                }, "lazy")
            }, this), r.src = o)
        }, this)), this._loaded.push(i.get(0)))
    }, r.prototype.destroy = function() {
        var t, e;
        for (t in this.handlers) this._core.$element.off(t, this.handlers[t]);
        for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
    }, t.fn.owlCarousel.Constructor.Plugins.Lazy = r
}(window.Zepto || window.jQuery, window, document),
function(t, e, n, i) {
    var r = function(n) {
        this._core = n, this._previousHeight = null, this._handlers = {
            "initialized.owl.carousel refreshed.owl.carousel": t.proxy(function(t) {
                t.namespace && this._core.settings.autoHeight && this.update()
            }, this),
            "changed.owl.carousel": t.proxy(function(t) {
                t.namespace && this._core.settings.autoHeight && "position" === t.property.name && this.update()
            }, this),
            "loaded.owl.lazy": t.proxy(function(t) {
                t.namespace && this._core.settings.autoHeight && t.element.closest("." + this._core.settings.itemClass).index() === this._core.current() && this.update()
            }, this)
        }, this._core.options = t.extend({}, r.Defaults, this._core.options), this._core.$element.on(this._handlers), this._intervalId = null;
        var i = this;
        t(e).on("load", function() {
            i._core.settings.autoHeight && i.update()
        }), t(e).resize(function() {
            i._core.settings.autoHeight && (null != i._intervalId && clearTimeout(i._intervalId), i._intervalId = setTimeout(function() {
                i.update()
            }, 250))
        })
    };
    r.Defaults = {
        autoHeight: !1,
        autoHeightClass: "owl-height"
    }, r.prototype.update = function() {
        var e = this._core._current,
            n = e + this._core.settings.items,
            i = this._core.settings.lazyLoad,
            r = this._core.$stage.children().toArray().slice(e, n),
            s = [],
            o = 0;
        t.each(r, function(e, n) {
            s.push(t(n).height())
        }), (o = Math.max.apply(null, s)) <= 1 && i && this._previousHeight && (o = this._previousHeight), this._previousHeight = o, this._core.$stage.parent().height(o).addClass(this._core.settings.autoHeightClass)
    }, r.prototype.destroy = function() {
        var t, e;
        for (t in this._handlers) this._core.$element.off(t, this._handlers[t]);
        for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
    }, t.fn.owlCarousel.Constructor.Plugins.AutoHeight = r
}(window.Zepto || window.jQuery, window, document),
function(t, e, n, i) {
    var r = function(e) {
        this._core = e, this._videos = {}, this._playing = null, this._handlers = {
            "initialized.owl.carousel": t.proxy(function(t) {
                t.namespace && this._core.register({
                    type: "state",
                    name: "playing",
                    tags: ["interacting"]
                })
            }, this),
            "resize.owl.carousel": t.proxy(function(t) {
                t.namespace && this._core.settings.video && this.isInFullScreen() && t.preventDefault()
            }, this),
            "refreshed.owl.carousel": t.proxy(function(t) {
                t.namespace && this._core.is("resizing") && this._core.$stage.find(".cloned .owl-video-frame").remove()
            }, this),
            "changed.owl.carousel": t.proxy(function(t) {
                t.namespace && "position" === t.property.name && this._playing && this.stop()
            }, this),
            "prepared.owl.carousel": t.proxy(function(e) {
                if (e.namespace) {
                    var n = t(e.content).find(".owl-video");
                    n.length && (n.css("display", "none"), this.fetch(n, t(e.content)))
                }
            }, this)
        }, this._core.options = t.extend({}, r.Defaults, this._core.options), this._core.$element.on(this._handlers), this._core.$element.on("click.owl.video", ".owl-video-play-icon", t.proxy(function(t) {
            this.play(t)
        }, this))
    };
    r.Defaults = {
        video: !1,
        videoHeight: !1,
        videoWidth: !1
    }, r.prototype.fetch = function(t, e) {
        var n = t.attr("data-vimeo-id") ? "vimeo" : t.attr("data-vzaar-id") ? "vzaar" : "youtube",
            i = t.attr("data-vimeo-id") || t.attr("data-youtube-id") || t.attr("data-vzaar-id"),
            r = t.attr("data-width") || this._core.settings.videoWidth,
            s = t.attr("data-height") || this._core.settings.videoHeight,
            o = t.attr("href");
        if (!o) throw new Error("Missing video URL.");
        if ((i = o.match(/(http:|https:|)\/\/(player.|www.|app.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com|be\-nocookie\.com)|vzaar\.com)\/(video\/|videos\/|embed\/|channels\/.+\/|groups\/.+\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/))[3].indexOf("youtu") > -1) n = "youtube";
        else if (i[3].indexOf("vimeo") > -1) n = "vimeo";
        else {
            if (!(i[3].indexOf("vzaar") > -1)) throw new Error("Video URL not supported.");
            n = "vzaar"
        }
        this._videos[o] = {
            type: n,
            id: i = i[6],
            width: r,
            height: s
        }, e.attr("data-video", o), this.thumbnail(t, this._videos[o])
    }, r.prototype.thumbnail = function(e, n) {
        var i, r, s = n.width && n.height ? "width:" + n.width + "px;height:" + n.height + "px;" : "",
            o = e.find("img"),
            a = "src",
            l = "",
            u = this._core.settings,
            c = function(n) {
                r = '<div class="owl-video-play-icon"></div>', i = t("<div/>", u.lazyLoad ? {
                    class: "owl-video-tn " + l,
                    srcType: n
                } : {
                    class: "owl-video-tn",
                    style: "opacity:1;background-image:url(" + n + ")"
                }), e.after(i), e.after(r)
            };
        if (e.wrap(t("<div/>", {
                class: "owl-video-wrapper",
                style: s
            })), this._core.settings.lazyLoad && (a = "data-src", l = "owl-lazy"), o.length) return c(o.attr(a)), o.remove(), !1;
        "youtube" === n.type ? c("//img.youtube.com/vi/" + n.id + "/hqdefault.jpg") : "vimeo" === n.type ? t.ajax({
            type: "GET",
            url: "//vimeo.com/api/v2/video/" + n.id + ".json",
            jsonp: "callback",
            dataType: "jsonp",
            success: function(t) {
                c(t[0].thumbnail_large)
            }
        }) : "vzaar" === n.type && t.ajax({
            type: "GET",
            url: "//vzaar.com/api/videos/" + n.id + ".json",
            jsonp: "callback",
            dataType: "jsonp",
            success: function(t) {
                c(t.framegrab_url)
            }
        })
    }, r.prototype.stop = function() {
        this._core.trigger("stop", null, "video"), this._playing.find(".owl-video-frame").remove(), this._playing.removeClass("owl-video-playing"), this._playing = null, this._core.leave("playing"), this._core.trigger("stopped", null, "video")
    }, r.prototype.play = function(e) {
        var n, i = t(e.target).closest("." + this._core.settings.itemClass),
            r = this._videos[i.attr("data-video")],
            s = r.width || "100%",
            o = r.height || this._core.$stage.height();
        this._playing || (this._core.enter("playing"), this._core.trigger("play", null, "video"), i = this._core.items(this._core.relative(i.index())), this._core.reset(i.index()), (n = t('<iframe frameborder="0" allowfullscreen mozallowfullscreen webkitAllowFullScreen ></iframe>')).attr("height", o), n.attr("width", s), "youtube" === r.type ? n.attr("src", "//www.youtube.com/embed/" + r.id + "?autoplay=1&rel=0&v=" + r.id) : "vimeo" === r.type ? n.attr("src", "//player.vimeo.com/video/" + r.id + "?autoplay=1") : "vzaar" === r.type && n.attr("src", "//view.vzaar.com/" + r.id + "/player?autoplay=true"), t(n).wrap('<div class="owl-video-frame" />').insertAfter(i.find(".owl-video")), this._playing = i.addClass("owl-video-playing"))
    }, r.prototype.isInFullScreen = function() {
        var e = n.fullscreenElement || n.mozFullScreenElement || n.webkitFullscreenElement;
        return e && t(e).parent().hasClass("owl-video-frame")
    }, r.prototype.destroy = function() {
        var t, e;
        for (t in this._core.$element.off("click.owl.video"), this._handlers) this._core.$element.off(t, this._handlers[t]);
        for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
    }, t.fn.owlCarousel.Constructor.Plugins.Video = r
}(window.Zepto || window.jQuery, window, document),
function(t, e, n, i) {
    var r = function(e) {
        this.core = e, this.core.options = t.extend({}, r.Defaults, this.core.options), this.swapping = !0, this.previous = i, this.next = i, this.handlers = {
            "change.owl.carousel": t.proxy(function(t) {
                t.namespace && "position" == t.property.name && (this.previous = this.core.current(), this.next = t.property.value)
            }, this),
            "drag.owl.carousel dragged.owl.carousel translated.owl.carousel": t.proxy(function(t) {
                t.namespace && (this.swapping = "translated" == t.type)
            }, this),
            "translate.owl.carousel": t.proxy(function(t) {
                t.namespace && this.swapping && (this.core.options.animateOut || this.core.options.animateIn) && this.swap()
            }, this)
        }, this.core.$element.on(this.handlers)
    };
    r.Defaults = {
        animateOut: !1,
        animateIn: !1
    }, r.prototype.swap = function() {
        if (1 === this.core.settings.items && t.support.animation && t.support.transition) {
            this.core.speed(0);
            var e, n = t.proxy(this.clear, this),
                i = this.core.$stage.children().eq(this.previous),
                r = this.core.$stage.children().eq(this.next),
                s = this.core.settings.animateIn,
                o = this.core.settings.animateOut;
            this.core.current() !== this.previous && (o && (e = this.core.coordinates(this.previous) - this.core.coordinates(this.next), i.one(t.support.animation.end, n).css({
                left: e + "px"
            }).addClass("animated owl-animated-out").addClass(o)), s && r.one(t.support.animation.end, n).addClass("animated owl-animated-in").addClass(s))
        }
    }, r.prototype.clear = function(e) {
        t(e.target).css({
            left: ""
        }).removeClass("animated owl-animated-out owl-animated-in").removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut), this.core.onTransitionEnd()
    }, r.prototype.destroy = function() {
        var t, e;
        for (t in this.handlers) this.core.$element.off(t, this.handlers[t]);
        for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
    }, t.fn.owlCarousel.Constructor.Plugins.Animate = r
}(window.Zepto || window.jQuery, window, document),
function(t, e, n, i) {
    var r = function(e) {
        this._core = e, this._call = null, this._time = 0, this._timeout = 0, this._paused = !0, this._handlers = {
            "changed.owl.carousel": t.proxy(function(t) {
                t.namespace && "settings" === t.property.name ? this._core.settings.autoplay ? this.play() : this.stop() : t.namespace && "position" === t.property.name && this._paused && (this._time = 0)
            }, this),
            "initialized.owl.carousel": t.proxy(function(t) {
                t.namespace && this._core.settings.autoplay && this.play()
            }, this),
            "play.owl.autoplay": t.proxy(function(t, e, n) {
                t.namespace && this.play(e, n)
            }, this),
            "stop.owl.autoplay": t.proxy(function(t) {
                t.namespace && this.stop()
            }, this),
            "mouseover.owl.autoplay": t.proxy(function() {
                this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause()
            }, this),
            "mouseleave.owl.autoplay": t.proxy(function() {
                this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.play()
            }, this),
            "touchstart.owl.core": t.proxy(function() {
                this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause()
            }, this),
            "touchend.owl.core": t.proxy(function() {
                this._core.settings.autoplayHoverPause && this.play()
            }, this)
        }, this._core.$element.on(this._handlers), this._core.options = t.extend({}, r.Defaults, this._core.options)
    };
    r.Defaults = {
        autoplay: !1,
        autoplayTimeout: 5e3,
        autoplayHoverPause: !1,
        autoplaySpeed: !1
    }, r.prototype._next = function(i) {
        this._call = e.setTimeout(t.proxy(this._next, this, i), this._timeout * (Math.round(this.read() / this._timeout) + 1) - this.read()), this._core.is("interacting") || n.hidden || this._core.next(i || this._core.settings.autoplaySpeed)
    }, r.prototype.read = function() {
        return (new Date).getTime() - this._time
    }, r.prototype.play = function(n, i) {
        var r;
        this._core.is("rotating") || this._core.enter("rotating"), n = n || this._core.settings.autoplayTimeout, r = Math.min(this._time % (this._timeout || n), n), this._paused ? (this._time = this.read(), this._paused = !1) : e.clearTimeout(this._call), this._time += this.read() % n - r, this._timeout = n, this._call = e.setTimeout(t.proxy(this._next, this, i), n - r)
    }, r.prototype.stop = function() {
        this._core.is("rotating") && (this._time = 0, this._paused = !0, e.clearTimeout(this._call), this._core.leave("rotating"))
    }, r.prototype.pause = function() {
        this._core.is("rotating") && !this._paused && (this._time = this.read(), this._paused = !0, e.clearTimeout(this._call))
    }, r.prototype.destroy = function() {
        var t, e;
        for (t in this.stop(), this._handlers) this._core.$element.off(t, this._handlers[t]);
        for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
    }, t.fn.owlCarousel.Constructor.Plugins.autoplay = r
}(window.Zepto || window.jQuery, window, document),
function(t, e, n, i) {
    "use strict";
    var r = function(e) {
        this._core = e, this._initialized = !1, this._pages = [], this._controls = {}, this._templates = [], this.$element = this._core.$element, this._overrides = {
            next: this._core.next,
            prev: this._core.prev,
            to: this._core.to
        }, this._handlers = {
            "prepared.owl.carousel": t.proxy(function(e) {
                e.namespace && this._core.settings.dotsData && this._templates.push('<div class="' + this._core.settings.dotClass + '">' + t(e.content).find("[data-dot]").addBack("[data-dot]").attr("data-dot") + "</div>")
            }, this),
            "added.owl.carousel": t.proxy(function(t) {
                t.namespace && this._core.settings.dotsData && this._templates.splice(t.position, 0, this._templates.pop())
            }, this),
            "remove.owl.carousel": t.proxy(function(t) {
                t.namespace && this._core.settings.dotsData && this._templates.splice(t.position, 1)
            }, this),
            "changed.owl.carousel": t.proxy(function(t) {
                t.namespace && "position" == t.property.name && this.draw()
            }, this),
            "initialized.owl.carousel": t.proxy(function(t) {
                t.namespace && !this._initialized && (this._core.trigger("initialize", null, "navigation"), this.initialize(), this.update(), this.draw(), this._initialized = !0, this._core.trigger("initialized", null, "navigation"))
            }, this),
            "refreshed.owl.carousel": t.proxy(function(t) {
                t.namespace && this._initialized && (this._core.trigger("refresh", null, "navigation"), this.update(), this.draw(), this._core.trigger("refreshed", null, "navigation"))
            }, this)
        }, this._core.options = t.extend({}, r.Defaults, this._core.options), this.$element.on(this._handlers)
    };
    r.Defaults = {
        nav: !1,
        navText: ['<span aria-label="Previous">&#x2039;</span>', '<span aria-label="Next">&#x203a;</span>'],
        navSpeed: !1,
        navElement: 'button type="button" role="presentation"',
        navContainer: !1,
        navContainerClass: "owl-nav",
        navClass: ["owl-prev", "owl-next"],
        slideBy: 1,
        dotClass: "owl-dot",
        dotsClass: "owl-dots",
        dots: !0,
        dotsEach: !1,
        dotsData: !1,
        dotsSpeed: !1,
        dotsContainer: !1
    }, r.prototype.initialize = function() {
        var e, n = this._core.settings;
        for (e in this._controls.$relative = (n.navContainer ? t(n.navContainer) : t("<div>").addClass(n.navContainerClass).appendTo(this.$element)).addClass("disabled"), this._controls.$previous = t("<" + n.navElement + ">").addClass(n.navClass[0]).html(n.navText[0]).prependTo(this._controls.$relative).on("click", t.proxy(function(t) {
                this.prev(n.navSpeed)
            }, this)), this._controls.$next = t("<" + n.navElement + ">").addClass(n.navClass[1]).html(n.navText[1]).appendTo(this._controls.$relative).on("click", t.proxy(function(t) {
                this.next(n.navSpeed)
            }, this)), n.dotsData || (this._templates = [t('<button role="button">').addClass(n.dotClass).append(t("<span>")).prop("outerHTML")]), this._controls.$absolute = (n.dotsContainer ? t(n.dotsContainer) : t("<div>").addClass(n.dotsClass).appendTo(this.$element)).addClass("disabled"), this._controls.$absolute.on("click", "button", t.proxy(function(e) {
                var i = t(e.target).parent().is(this._controls.$absolute) ? t(e.target).index() : t(e.target).parent().index();
                e.preventDefault(), this.to(i, n.dotsSpeed)
            }, this)), this._overrides) this._core[e] = t.proxy(this[e], this)
    }, r.prototype.destroy = function() {
        var t, e, n, i, r;
        for (t in r = this._core.settings, this._handlers) this.$element.off(t, this._handlers[t]);
        for (e in this._controls) "$relative" === e && r.navContainer ? this._controls[e].html("") : this._controls[e].remove();
        for (i in this.overides) this._core[i] = this._overrides[i];
        for (n in Object.getOwnPropertyNames(this)) "function" != typeof this[n] && (this[n] = null)
    }, r.prototype.update = function() {
        var t, e, n = this._core.clones().length / 2,
            i = n + this._core.items().length,
            r = this._core.maximum(!0),
            s = this._core.settings,
            o = s.center || s.autoWidth || s.dotsData ? 1 : s.dotsEach || s.items;
        if ("page" !== s.slideBy && (s.slideBy = Math.min(s.slideBy, s.items)), s.dots || "page" == s.slideBy)
            for (this._pages = [], t = n, e = 0; t < i; t++) {
                if (e >= o || 0 === e) {
                    if (this._pages.push({
                            start: Math.min(r, t - n),
                            end: t - n + o - 1
                        }), Math.min(r, t - n) === r) break;
                    e = 0
                }
                e += this._core.mergers(this._core.relative(t))
            }
    }, r.prototype.draw = function() {
        var e, n = this._core.settings,
            i = this._core.items().length <= n.items,
            r = this._core.relative(this._core.current()),
            s = n.loop || n.rewind;
        this._controls.$relative.toggleClass("disabled", !n.nav || i), n.nav && (this._controls.$previous.toggleClass("disabled", !s && r <= this._core.minimum(!0)), this._controls.$next.toggleClass("disabled", !s && r >= this._core.maximum(!0))), this._controls.$absolute.toggleClass("disabled", !n.dots || i), n.dots && (e = this._pages.length - this._controls.$absolute.children().length, n.dotsData && 0 !== e ? this._controls.$absolute.html(this._templates.join("")) : e > 0 ? this._controls.$absolute.append(new Array(e + 1).join(this._templates[0])) : e < 0 && this._controls.$absolute.children().slice(e).remove(), this._controls.$absolute.find(".active").removeClass("active"), this._controls.$absolute.children().eq(t.inArray(this.current(), this._pages)).addClass("active"))
    }, r.prototype.onTrigger = function(e) {
        var n = this._core.settings;
        e.page = {
            index: t.inArray(this.current(), this._pages),
            count: this._pages.length,
            size: n && (n.center || n.autoWidth || n.dotsData ? 1 : n.dotsEach || n.items)
        }
    }, r.prototype.current = function() {
        var e = this._core.relative(this._core.current());
        return t.grep(this._pages, t.proxy(function(t, n) {
            return t.start <= e && t.end >= e
        }, this)).pop()
    }, r.prototype.getPosition = function(e) {
        var n, i, r = this._core.settings;
        return "page" == r.slideBy ? (n = t.inArray(this.current(), this._pages), i = this._pages.length, e ? ++n : --n, n = this._pages[(n % i + i) % i].start) : (n = this._core.relative(this._core.current()), i = this._core.items().length, e ? n += r.slideBy : n -= r.slideBy), n
    }, r.prototype.next = function(e) {
        t.proxy(this._overrides.to, this._core)(this.getPosition(!0), e)
    }, r.prototype.prev = function(e) {
        t.proxy(this._overrides.to, this._core)(this.getPosition(!1), e)
    }, r.prototype.to = function(e, n, i) {
        var r;
        !i && this._pages.length ? (r = this._pages.length, t.proxy(this._overrides.to, this._core)(this._pages[(e % r + r) % r].start, n)) : t.proxy(this._overrides.to, this._core)(e, n)
    }, t.fn.owlCarousel.Constructor.Plugins.Navigation = r
}(window.Zepto || window.jQuery, window, document),
function(t, e, n, i) {
    "use strict";
    var r = function(n) {
        this._core = n, this._hashes = {}, this.$element = this._core.$element, this._handlers = {
            "initialized.owl.carousel": t.proxy(function(n) {
                n.namespace && "URLHash" === this._core.settings.startPosition && t(e).trigger("hashchange.owl.navigation")
            }, this),
            "prepared.owl.carousel": t.proxy(function(e) {
                if (e.namespace) {
                    var n = t(e.content).find("[data-hash]").addBack("[data-hash]").attr("data-hash");
                    if (!n) return;
                    this._hashes[n] = e.content
                }
            }, this),
            "changed.owl.carousel": t.proxy(function(n) {
                if (n.namespace && "position" === n.property.name) {
                    var i = this._core.items(this._core.relative(this._core.current())),
                        r = t.map(this._hashes, function(t, e) {
                            return t === i ? e : null
                        }).join();
                    if (!r || e.location.hash.slice(1) === r) return;
                    e.location.hash = r
                }
            }, this)
        }, this._core.options = t.extend({}, r.Defaults, this._core.options), this.$element.on(this._handlers), t(e).on("hashchange.owl.navigation", t.proxy(function(t) {
            var n = e.location.hash.substring(1),
                i = this._core.$stage.children(),
                r = this._hashes[n] && i.index(this._hashes[n]);
            void 0 !== r && r !== this._core.current() && this._core.to(this._core.relative(r), !1, !0)
        }, this))
    };
    r.Defaults = {
        URLhashListener: !1
    }, r.prototype.destroy = function() {
        var n, i;
        for (n in t(e).off("hashchange.owl.navigation"), this._handlers) this._core.$element.off(n, this._handlers[n]);
        for (i in Object.getOwnPropertyNames(this)) "function" != typeof this[i] && (this[i] = null)
    }, t.fn.owlCarousel.Constructor.Plugins.Hash = r
}(window.Zepto || window.jQuery, window, document),
function(t, e, n, i) {
    function r(e, n) {
        var r = !1,
            s = e.charAt(0).toUpperCase() + e.slice(1);
        return t.each((e + " " + a.join(s + " ") + s).split(" "), function(t, e) {
            if (o[e] !== i) return r = !n || e, !1
        }), r
    }

    function s(t) {
        return r(t, !0)
    }
    var o = t("<support>").get(0).style,
        a = "Webkit Moz O ms".split(" "),
        l = {
            transition: {
                end: {
                    WebkitTransition: "webkitTransitionEnd",
                    MozTransition: "transitionend",
                    OTransition: "oTransitionEnd",
                    transition: "transitionend"
                }
            },
            animation: {
                end: {
                    WebkitAnimation: "webkitAnimationEnd",
                    MozAnimation: "animationend",
                    OAnimation: "oAnimationEnd",
                    animation: "animationend"
                }
            }
        };
    !!r("transition") && (t.support.transition = new String(s("transition")), t.support.transition.end = l.transition.end[t.support.transition]), !!r("animation") && (t.support.animation = new String(s("animation")), t.support.animation.end = l.animation.end[t.support.animation]), r("transform") && (t.support.transform = new String(s("transform")), t.support.transform3d = !!r("perspective"))
}(window.Zepto || window.jQuery, window, document);