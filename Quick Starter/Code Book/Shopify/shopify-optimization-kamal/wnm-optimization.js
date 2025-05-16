var src, srcset, wnw_windowWidth, wnw_windowHeight, critical2, cls_css, lazyBackground, lazyIframe, lazybg, lazybg2, s, i, flag = 1,
    external_single_loaded = 1;
document.addEventListener("DOMContentLoaded", function() {
    wnw_windowWidth = screen.width, wnw_windowHeight = screen.height, lazyLoadImg2(), lazyLoadBackground2(), window.addEventListener("scroll", function() {
        wnw_init()
    }), window.addEventListener("mousemove", function() {
        wnw_init()
    }), window.addEventListener("touchstart", function() {
        wnw_init()
    }), setTimeout(function() {
        wnw_init()
    }, 8e3)
});

function wnw_init() {
    lazyLoadCss(), lazyLoadStyle(), lazyLoadImg(), lazyLoadBackground(), lazyLoadIframe(), flag && (flag = 0, load_all_js())
}

function insertAfter(e, t) {
    t.parentNode.insertBefore(e, t.nextSibling)
}

function lazyLoadImg() {
    var e = document.querySelectorAll("img.lazy2");
    for (i = 0; i < e.length; i++) wnw_windowWidth < 600 ? src = e[i].dataset.mobsrc === void 0 ? e[i].dataset.src : e[i].dataset.mobsrc : src = e[i].dataset.src === void 0 ? e[i].src : e[i].dataset.src, srcset = e[i].getAttribute("data-srcset") ? e[i].getAttribute("data-srcset") : "", src != null && src != "" && (e[i].src = src), srcset != null && srcset != "" && (e[i].srcset = srcset), e[i].classList.remove("lazy2")
}

function lazyLoadImg2() {
    var e = document.querySelectorAll("img.lazy3");
    for (i = 0; i < e.length; i++) {
        var t = e[i].getBoundingClientRect();
        t.top != 0 && t.top - wnw_windowHeight < 0 && (wnw_windowWidth < 600 ? src = e[i].dataset.mobsrc === void 0 ? e[i].dataset.src : e[i].dataset.mobsrc : src = e[i].dataset.src === void 0 ? e[i].src : e[i].dataset.src, srcset = e[i].getAttribute("data-srcset") ? e[i].getAttribute("data-srcset") : "", src != null && src != "" && (e[i].src = src), srcset != null && srcset != "" && (e[i].srcset = srcset), e[i].classList.remove("lazy3"))
    }
}

function lazyLoadBackground() {
    lazyBackground = document.querySelectorAll(".lazybg"), lazyBackground.forEach(function(e) {
        wnw_windowWidth < 600 ? lazybg = e.dataset.mobstyle === void 0 ? e.dataset.style : e.dataset.mobstyle : lazybg = e.dataset.style === void 0 ? e.style : e.dataset.style, lazybg != null && lazybg != "" && (e.style = lazybg), e.classList.remove("lazybg")
    })
}

function lazyLoadBackground2() {
    lazyBackground = document.querySelectorAll(".lazybg2"), lazyBackground.forEach(function(e) {
        var t = e.getBoundingClientRect();
        t.top != 0 && t.top - wnw_windowHeight < 0 && (wnw_windowWidth < 600 ? lazybg = e.dataset.mobstyle === void 0 ? e.dataset.style : e.dataset.mobstyle : lazybg = e.dataset.style === void 0 ? e.style : e.dataset.style, lazybg != null && lazybg != "" && (e.style = lazybg), e.classList.remove("lazybg2"))
    })
}

function lazyLoadCss() {
    cls_css = document.querySelectorAll(".cls_css"), cls_css.forEach(function(n) {
        n.remove()
    });
    var e = document.querySelectorAll("link[data-href]");
    for (i = 0; i < e.length; i++) {
        var t = document.createElement("link");
        t.href = e[i].getAttribute("data-href"), t.rel = "stylesheet", e[i].parentNode.insertBefore(t, e[i]), delete e[i].dataset.href, e[i].parentNode.removeChild(e[i])
    }
    setTimeout(function() {
        critical2 = document.querySelectorAll(".critical2"), critical2.forEach(function(n) {
            n.remove()
        })
    }, 8e3)
}

function lazyLoadStyle() {
    var e = document.querySelectorAll("style[type=lazyload2]");
    for (i = 0; i < e.length; i++) {
        var t = document.createElement("style");
        t.innerHTML = e[i].innerHTML, e[i].parentNode.insertBefore(t, e[i]), e[i].parentNode.removeChild(e[i])
    }
}

function lazyLoadIframe() {
    lazyIframe = document.querySelectorAll("iframe"), lazyIframe.forEach(function(e) {
        e.dataset.src != null && e.dataset.src != "" && (e.src = e.dataset.src, delete e.dataset.src)
    })
}

function w3_load_js_uri(e) {
    var t = document.createElement("script");
    if (typeof e.attributes != "undefined")
        for (var n, o = 0, r = e.attributes, a = r.length; o < a; o++) n = r[o], n.nodeName != "data-src" && n.nodeName != "type" && t.setAttribute(n.nodeName, n.nodeValue);
    return t.src = e.getAttribute("data-src"), insertAfter(t, e), delete e.dataset.src, delete e.type, e.parentNode.removeChild(e), t
}

function w3_load_inline_js_single(e) {
    if (!external_single_loaded) return setTimeout(function() {
        w3_load_inline_js_single(e)
    }, 200), !1;
    s = document.createElement("script");
    for (var t = 0; t < e.attributes.length; t++) {
        var n = e.attributes[t];
        n.name != "type" && s.setAttribute(n.name, n.value)
    }
    s.innerHTML = e.innerHTML, insertAfter(s, e), e.parentNode.removeChild(e)
}

function lazyLoadScripts() {
    var e = document.querySelectorAll("script[type=lazyload2]");
    if (e.length < 1) {
        document.body.classList.add("wnw_loaded"), fullJSLoadedCB();
        return
    }
    if (e[0].getAttribute("data-src") !== null) {
        var t = w3_load_js_uri(e[0]);
        t.onload = function() {
            lazyLoadScripts()
        }, t.onerror = function() {
            lazyLoadScripts()
        }
    } else w3_load_inline_js_single(e[0]), lazyLoadScripts()
}

function wnwAnalytics() {
    var e = document.querySelectorAll(".analytics");
    e.forEach(function(t) {
        trekkie.integrations = !1, s = document.createElement("script"), s.innerHTML = t.innerHTML, insertAfter(s, t), t.parentNode.removeChild(t)
    })
}

function load_all_js() {
    Shopify.designMode || window.location.href.indexOf("cart") > -1 || window.location.href.indexOf("checkout") > -1 ? console.log("No-optimization") : (console.log("Yes-optimization"), setTimeout(function() {
        wnwAnalytics()
    }, 100), setTimeout(function() {
        var e = document.createEvent("Event");
        e.initEvent("wnw_load", !0, !0), window.document.dispatchEvent(e)
    }, 500), setTimeout(function() {
        var e = document.createEvent("Event");
        e.initEvent("DOMContentLoaded2", !0, !0), window.document.dispatchEvent(e)
    }, 5e3)), lazyLoadScripts(), setInterval(function() {
        lazyLoadImg(), lazyLoadIframe()
    })
}

function fullJSLoadedCB() {
    setTimeout(function() {})
}
//# sourceMappingURL=/s/files/1/0631/7978/4450/t/14/assets/wnw-optimization.js.map?v=66171849873808390441653495695