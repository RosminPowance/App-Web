/*
@license
Webix <%= pkg.productName %> v.<%= pkg.version %>
This software is covered by Webix Trial License.
Usage without proper license is prohibited.
(c) XB Software Ltd.
*/
!(function (t, e) {
    "object" == typeof exports && "undefined" != typeof module
        ? e(exports)
        : "function" == typeof define && define.amd
        ? define(["exports"], e)
        : e(((t = t || self).pivot = {}));
})(this, function (t) {
    "use strict";
    class e {}
    class i {
        constructor(t, e) {
            (this.webixJet = !0),
                (this.webix = t),
                (this._events = []),
                (this._subs = {}),
                (this._data = {}),
                e && e.params && t.extend(this._data, e.params);
        }
        getRoot() {
            return this._root;
        }
        destructor() {
            this._detachEvents(),
                this._destroySubs(),
                (this._events =
                    this._container =
                    this.app =
                    this._parent =
                    this._root =
                        null);
        }
        setParam(t, e, i) {
            if (
                this._data[t] !== e &&
                ((this._data[t] = e), this._segment.update(t, e, 0), i)
            )
                return this.show(null);
        }
        getParam(t, e) {
            const i = this._data[t];
            if (void 0 !== i || !e) return i;
            const s = this.getParentView();
            return s ? s.getParam(t, e) : void 0;
        }
        getUrl() {
            return this._segment.suburl();
        }
        getUrlString() {
            return this._segment.toString();
        }
        getParentView() {
            return this._parent;
        }
        $$(t) {
            if ("string" == typeof t) {
                const e = this.getRoot();
                return e.queryView(
                    (i) =>
                        (i.config.id === t || i.config.localId === t) &&
                        i.$scope === e.$scope,
                    "self"
                );
            }
            return t;
        }
        on(t, e, i) {
            const s = t.attachEvent(e, i);
            return this._events.push({ obj: t, id: s }), s;
        }
        contains(t) {
            for (const e in this._subs) {
                const i = this._subs[e].view;
                if (i === t || i.contains(t)) return !0;
            }
            return !1;
        }
        getSubView(t) {
            const e = this.getSubViewInfo(t);
            if (e) return e.subview.view;
        }
        getSubViewInfo(t) {
            const e = this._subs[t || "default"];
            return e
                ? { subview: e, parent: this }
                : "_top" === t
                ? ((this._subs[t] = { url: "", id: null, popup: !0 }),
                  this.getSubViewInfo(t))
                : this._parent
                ? this._parent.getSubViewInfo(t)
                : null;
        }
        _detachEvents() {
            const t = this._events;
            for (let e = t.length - 1; e >= 0; e--)
                t[e].obj.detachEvent(t[e].id);
        }
        _destroySubs() {
            for (const t in this._subs) {
                const e = this._subs[t].view;
                e && e.destructor();
            }
            this._subs = {};
        }
        _init_url_data() {
            const t = this._segment.current();
            (this._data = {}), this.webix.extend(this._data, t.params, !0);
        }
        _getDefaultSub() {
            if (this._subs.default) return this._subs.default;
            for (const t in this._subs) {
                const e = this._subs[t];
                if (!e.branch && e.view && "_top" !== t) {
                    const t = e.view._getDefaultSub();
                    if (t) return t;
                }
            }
        }
        _routed_view() {
            const t = this.getParentView();
            if (!t) return !0;
            const e = t._getDefaultSub();
            return !(!e && e !== this) && t._routed_view();
        }
    }
    function s(t) {
        "/" === t[0] && (t = t.substr(1));
        const e = t.split("/"),
            i = [];
        for (let t = 0; t < e.length; t++) {
            const s = e[t],
                r = {};
            let n = s.indexOf(":");
            if ((-1 === n && (n = s.indexOf("?")), -1 !== n)) {
                const t = s.substr(n + 1).split(/[\:\?\&]/g);
                for (const e of t) {
                    const t = e.split("=");
                    r[t[0]] = decodeURIComponent(t[1]);
                }
            }
            i[t] = { page: n > -1 ? s.substr(0, n) : s, params: r, isNew: !0 };
        }
        return i;
    }
    function r(t) {
        const e = [];
        for (const i of t) {
            e.push("/" + i.page);
            const t = n(i.params);
            t && e.push("?" + t);
        }
        return e.join("");
    }
    function n(t) {
        const e = [];
        for (const i in t)
            "object" != typeof t[i] &&
                (e.length && e.push("&"),
                e.push(i + "=" + encodeURIComponent(t[i])));
        return e.join("");
    }
    class o {
        constructor(t, e) {
            (this._next = 1),
                (this.route =
                    "string" == typeof t ? { url: s(t), path: t } : t),
                (this.index = e);
        }
        current() {
            return this.route.url[this.index];
        }
        next() {
            return this.route.url[this.index + this._next];
        }
        suburl() {
            return this.route.url.slice(this.index);
        }
        shift(t) {
            const e = new o(this.route, this.index + this._next);
            return e.setParams(e.route.url, t, e.index), e;
        }
        setParams(t, e, i) {
            if (e) {
                const r = t[i].params;
                for (var s in e) r[s] = e[s];
            }
        }
        refresh() {
            const t = this.route.url;
            for (let e = this.index + 1; e < t.length; e++) t[e].isNew = !0;
        }
        toString() {
            const t = r(this.suburl());
            return t ? t.substr(1) : "";
        }
        _join(t, e) {
            let i = this.route.url;
            if (null === t) return i;
            const r = this.route.url;
            let n = !0;
            if (((i = r.slice(0, this.index + (e ? this._next : 0))), t)) {
                i = i.concat(s(t));
                for (let t = 0; t < i.length; t++)
                    r[t] && (i[t].view = r[t].view),
                        n && r[t] && i[t].page === r[t].page
                            ? (i[t].isNew = !1)
                            : i[t].isNew && (n = !1);
            }
            return i;
        }
        append(t) {
            const e = this._join(t, !0);
            return (
                (this.route.path = r(e)), (this.route.url = e), this.route.path
            );
        }
        show(t, i, s) {
            const n = this._join(t.url, s);
            return (
                this.setParams(n, t.params, this.index + (s ? this._next : 0)),
                new Promise((t, s) => {
                    const o = r(n),
                        a = { url: n, redirect: o, confirm: Promise.resolve() },
                        l = i ? i.app : null;
                    if (l) {
                        if (!l.callEvent("app:guard", [a.redirect, i, a]))
                            return void s(new e());
                    }
                    a.confirm
                        .catch((t) => s(t))
                        .then(() => {
                            if (null !== a.redirect) {
                                if (a.redirect !== o)
                                    return l.show(a.redirect), void s(new e());
                                (this.route.path = o),
                                    (this.route.url = n),
                                    t();
                            } else s(new e());
                        });
                })
            );
        }
        size(t) {
            this._next = t;
        }
        split() {
            const t = { url: this.route.url.slice(this.index + 1), path: "" };
            return t.url.length && (t.path = r(t.url)), new o(t, 0);
        }
        update(t, e, i) {
            const s = this.route.url[this.index + (i || 0)];
            if (!s)
                return (
                    this.route.url.push({ page: "", params: {} }),
                    this.update(t, e, i)
                );
            "" === t ? (s.page = e) : (s.params[t] = e),
                (this.route.path = r(this.route.url));
        }
    }
    class a extends i {
        constructor(t, e) {
            super(t.webix), (this.app = t), (this._children = []);
        }
        ui(t, e) {
            const s = (e = e || {}).container || t.container,
                r = this.app.createView(t);
            return (
                this._children.push(r),
                r.render(s, this._segment, this),
                "object" != typeof t || t instanceof i ? r : r.getRoot()
            );
        }
        show(t, e) {
            if (((e = e || {}), "object" == typeof t)) {
                for (const e in t) this.setParam(e, t[e]);
                t = null;
            } else {
                if ("/" === t.substr(0, 1)) return this.app.show(t, e);
                if (
                    (0 === t.indexOf("./") && (t = t.substr(2)),
                    0 === t.indexOf("../"))
                ) {
                    const i = this.getParentView();
                    return i
                        ? i.show(t.substr(3), e)
                        : this.app.show("/" + t.substr(3));
                }
                const i = this.getSubViewInfo(e.target);
                if (i) {
                    if (i.parent !== this) return i.parent.show(t, e);
                    if (e.target && "default" !== e.target)
                        return this._renderFrameLock(e.target, i.subview, {
                            url: t,
                            params: e.params,
                        });
                } else if (t) return this.app.show("/" + t, e);
            }
            return this._show(
                this._segment,
                { url: t, params: e.params },
                this
            );
        }
        _show(t, e, i) {
            return t
                .show(e, i, !0)
                .then(() => (this._init_url_data(), this._urlChange()))
                .then(() => {
                    t.route.linkRouter &&
                        (this.app.getRouter().set(t.route.path, { silent: !0 }),
                        this.app.callEvent("app:route", [t.route.path]));
                });
        }
        init(t, e) {}
        ready(t, e) {}
        config() {
            this.app.webix.message("View:Config is not implemented");
        }
        urlChange(t, e) {}
        destroy() {}
        destructor() {
            this.destroy(),
                this._destroyKids(),
                this._root && (this._root.destructor(), super.destructor());
        }
        use(t, e) {
            t(this.app, this, e);
        }
        refresh() {
            this.getUrl();
            return (
                this.destroy(),
                this._destroyKids(),
                this._destroySubs(),
                this._detachEvents(),
                this._container.tagName && this._root.destructor(),
                this._segment.refresh(),
                this._render(this._segment)
            );
        }
        render(t, e, i) {
            "string" == typeof e && (e = new o(e, 0)),
                (this._segment = e),
                (this._parent = i),
                this._init_url_data();
            const s =
                "string" == typeof (t = t || document.body)
                    ? this.webix.toNode(t)
                    : t;
            return this._container !== s
                ? ((this._container = s), this._render(e))
                : this._urlChange().then(() => this.getRoot());
        }
        _render(t) {
            const e = this.config();
            return e.then
                ? e.then((e) => this._render_final(e, t))
                : this._render_final(e, t);
        }
        _render_final(t, e) {
            let i,
                s = null,
                r = null,
                n = !1;
            if (
                (this._container.tagName
                    ? (r = this._container)
                    : ((s = this._container),
                      s.popup
                          ? ((r = document.body), (n = !0))
                          : (r = this.webix.$$(s.id))),
                !this.app || !r)
            )
                return Promise.reject(null);
            const o = this._segment.current(),
                a = { ui: {} };
            this.app.copyConfig(t, a.ui, this._subs),
                this.app.callEvent("app:render", [this, e, a]),
                (a.ui.$scope = this),
                !s && o.isNew && o.view && o.view.destructor();
            try {
                if (s && !n) {
                    const t = r,
                        e = t.getParentView();
                    e &&
                        "multiview" === e.name &&
                        !a.ui.id &&
                        (a.ui.id = t.config.id);
                }
                this._root = this.app.webix.ui(a.ui, r);
                const t = this._root;
                n && t.setPosition && !t.isVisible() && t.show(),
                    s &&
                        (s.view &&
                            s.view !== this &&
                            s.view !== this.app &&
                            s.view.destructor(),
                        (s.id = this._root.config.id),
                        this.getParentView() || !this.app.app
                            ? (s.view = this)
                            : (s.view = this.app)),
                    o.isNew && ((o.view = this), (o.isNew = !1)),
                    (i = Promise.resolve(this._init(this._root, e)).then(() =>
                        this._urlChange().then(
                            () => (
                                (this._initUrl = null),
                                this.ready(this._root, e.suburl())
                            )
                        )
                    ));
            } catch (t) {
                i = Promise.reject(t);
            }
            return i.catch((t) => this._initError(this, t));
        }
        _init(t, e) {
            return this.init(t, e.suburl());
        }
        _urlChange() {
            this.app.callEvent("app:urlchange", [this, this._segment]);
            const t = [];
            for (const e in this._subs) {
                const i = this._subs[e],
                    s = this._renderFrameLock(e, i, null);
                s && t.push(s);
            }
            return Promise.all(t).then(() =>
                this.urlChange(this._root, this._segment.suburl())
            );
        }
        _renderFrameLock(t, e, i) {
            if (!e.lock) {
                const s = this._renderFrame(t, e, i);
                s &&
                    (e.lock = s.then(
                        () => (e.lock = null),
                        () => (e.lock = null)
                    ));
            }
            return e.lock;
        }
        _renderFrame(t, e, i) {
            if ("default" === t) {
                if (this._segment.next()) {
                    let t = i ? i.params : null;
                    return (
                        e.params && (t = this.webix.extend(t || {}, e.params)),
                        this._createSubView(e, this._segment.shift(t))
                    );
                }
                e.view && e.popup && (e.view.destructor(), (e.view = null));
            }
            if (
                (null !== i &&
                    ((e.url = i.url),
                    e.params &&
                        (i.params = this.webix.extend(
                            i.params || {},
                            e.params
                        ))),
                e.route)
            ) {
                if (null !== i)
                    return e.route
                        .show(i, e.view)
                        .then(() => this._createSubView(e, e.route));
                if (e.branch) return;
            }
            let s = e.view;
            if (!s && e.url) {
                if ("string" == typeof e.url)
                    return (
                        (e.route = new o(e.url, 0)),
                        i && e.route.setParams(e.route.route.url, i.params, 0),
                        e.params &&
                            e.route.setParams(e.route.route.url, e.params, 0),
                        this._createSubView(e, e.route)
                    );
                "function" != typeof e.url ||
                    s instanceof e.url ||
                    (s = new (this.app._override(e.url))(this.app, "")),
                    s || (s = e.url);
            }
            if (s) return s.render(e, e.route || this._segment, this);
        }
        _initError(t, e) {
            return this.app && this.app.error("app:error:initview", [e, t]), !0;
        }
        _createSubView(t, e) {
            return this.app
                .createFromURL(e.current())
                .then((i) => i.render(t, e, this));
        }
        _destroyKids() {
            const t = this._children;
            for (let e = t.length - 1; e >= 0; e--)
                t[e] && t[e].destructor && t[e].destructor();
            this._children = [];
        }
    }
    class l extends a {
        constructor(t, e) {
            super(t, e), (this._ui = e.ui);
        }
        config() {
            return this._ui;
        }
    }
    class h {
        constructor(t, e, i) {
            (this.path = ""), (this.app = i);
        }
        set(t, e) {
            this.path = t;
            const i = this.app;
            i.app.getRouter().set(i._segment.append(this.path), { silent: !0 });
        }
        get() {
            return this.path;
        }
    }
    let c = !0;
    class u extends i {
        constructor(t) {
            const e = (t || {}).webix || window.webix;
            (t = e.extend(
                { name: "App", version: "1.0", start: "/home" },
                t,
                !0
            )),
                super(e, t),
                (this.config = t),
                (this.app = this.config.app),
                (this.ready = Promise.resolve()),
                (this._services = {}),
                this.webix.extend(this, this.webix.EventSystem);
        }
        getUrl() {
            return this._subSegment.suburl();
        }
        getUrlString() {
            return this._subSegment.toString();
        }
        getService(t) {
            let e = this._services[t];
            return (
                "function" == typeof e && (e = this._services[t] = e(this)), e
            );
        }
        setService(t, e) {
            this._services[t] = e;
        }
        destructor() {
            this.getSubView().destructor(), super.destructor();
        }
        copyConfig(t, e, s) {
            if (
                ((t instanceof i ||
                    ("function" == typeof t && t.prototype instanceof i)) &&
                    (t = { $subview: t }),
                void 0 !== t.$subview)
            )
                return this.addSubView(t, e, s);
            const r = t instanceof Array;
            e = e || (r ? [] : {});
            for (const n in t) {
                let o = t[n];
                if (
                    ("function" == typeof o &&
                        o.prototype instanceof i &&
                        (o = { $subview: o }),
                    !o ||
                        "object" != typeof o ||
                        o instanceof this.webix.DataCollection ||
                        o instanceof RegExp ||
                        o instanceof Map)
                )
                    e[n] = o;
                else if (o instanceof Date) e[n] = new Date(o);
                else {
                    const t = this.copyConfig(
                        o,
                        o instanceof Array ? [] : {},
                        s
                    );
                    null !== t && (r ? e.push(t) : (e[n] = t));
                }
            }
            return e;
        }
        getRouter() {
            return this.$router;
        }
        clickHandler(t, e) {
            if (t && (e = e || t.target || t.srcElement) && e.getAttribute) {
                const i = e.getAttribute("trigger");
                if (i)
                    return (
                        this._forView(e, (t) => t.app.trigger(i)),
                        (t.cancelBubble = !0),
                        t.preventDefault()
                    );
                const s = e.getAttribute("route");
                if (s)
                    return (
                        this._forView(e, (t) => t.show(s)),
                        (t.cancelBubble = !0),
                        t.preventDefault()
                    );
            }
            const i = e.parentNode;
            i && this.clickHandler(t, i);
        }
        getRoot() {
            return this.getSubView().getRoot();
        }
        refresh() {
            return this._subSegment
                ? this.getSubView()
                      .refresh()
                      .then(
                          (t) => (
                              this.callEvent("app:route", [this.getUrl()]), t
                          )
                      )
                : Promise.resolve(null);
        }
        loadView(t) {
            const e = this.config.views;
            let i = null;
            if ("" === t)
                return Promise.resolve(
                    this._loadError(
                        "",
                        new Error("Webix Jet: Empty url segment")
                    )
                );
            try {
                e &&
                    ((i = "function" == typeof e ? e(t) : e[t]),
                    "string" == typeof i && ((t = i), (i = null))),
                    i ||
                        ("_hidden" === t
                            ? (i = { hidden: !0 })
                            : "_blank" === t
                            ? (i = {})
                            : ((t = t.replace(/\./g, "/")),
                              (i = this.require("jet-views", t))));
            } catch (e) {
                i = this._loadError(t, e);
            }
            return (
                i.then || (i = Promise.resolve(i)),
                (i = i
                    .then((t) => (t.__esModule ? t.default : t))
                    .catch((e) => this._loadError(t, e))),
                i
            );
        }
        _forView(t, e) {
            const i = this.webix.$$(t);
            i && e(i.$scope);
        }
        _loadViewDynamic(t) {
            return null;
        }
        createFromURL(t) {
            let e;
            return (
                (e =
                    t.isNew || !t.view
                        ? this.loadView(t.page).then((e) =>
                              this.createView(e, name, t.params)
                          )
                        : Promise.resolve(t.view)),
                e
            );
        }
        _override(t) {
            const e = this.config.override;
            if (e) {
                let i;
                for (; t; ) (i = t), (t = e.get(t));
                return i;
            }
            return t;
        }
        createView(t, e, s) {
            let r;
            if ("function" == typeof (t = this._override(t))) {
                if (t.prototype instanceof u)
                    return new t({ app: this, name: e, params: s, router: h });
                if (t.prototype instanceof i)
                    return new t(this, { name: e, params: s });
                t = t(this);
            }
            return (
                (r = t instanceof i ? t : new l(this, { name: e, ui: t })), r
            );
        }
        show(t, e) {
            return t && this.app && 0 == t.indexOf("//")
                ? this.app.show(t.substr(1), e)
                : this.render(this._container, t || this.config.start, e);
        }
        trigger(t, ...e) {
            this.apply(t, e);
        }
        apply(t, e) {
            this.callEvent(t, e);
        }
        action(t) {
            return this.webix.bind(function (...e) {
                this.apply(t, e);
            }, this);
        }
        on(t, e) {
            this.attachEvent(t, e);
        }
        use(t, e) {
            t(this, null, e);
        }
        error(t, e) {
            if (
                (this.callEvent(t, e),
                this.callEvent("app:error", e),
                this.config.debug)
            )
                for (var i = 0; i < e.length; i++)
                    if ((console.error(e[i]), e[i] instanceof Error)) {
                        let t = e[i].message;
                        0 === t.indexOf("Module build failed")
                            ? ((t = t.replace(/\x1b\[[0-9;]*m/g, "")),
                              (document.body.innerHTML = `<pre style='font-size:16px; background-color: #ec6873; color: #000; padding:10px;'>${t}</pre>`))
                            : ((t += "<br><br>Check console for more details"),
                              this.webix.message({
                                  type: "error",
                                  text: t,
                                  expire: -1,
                              }));
                    }
        }
        render(t, e, i) {
            this._container =
                "string" == typeof t
                    ? this.webix.toNode(t)
                    : t || document.body;
            let s = null;
            !this.$router
                ? (c &&
                      "tagName" in this._container &&
                      (this.webix.event(document.body, "click", (t) =>
                          this.clickHandler(t)
                      ),
                      (c = !1)),
                  "string" == typeof e && (e = new o(e, 0)),
                  (this._subSegment = this._first_start(e)),
                  (this._subSegment.route.linkRouter = !0))
                : (s =
                      "string" == typeof e
                          ? e
                          : this.app
                          ? e.split().route.path || this.config.start
                          : e.toString());
            const r = i ? i.params : this.config.params || null,
                n = this.getSubView(),
                a = this._subSegment,
                l = a
                    .show({ url: s, params: r }, n)
                    .then(() => this.createFromURL(a.current()))
                    .then((e) => e.render(t, a))
                    .then(
                        (t) => (
                            this.$router.set(a.route.path, { silent: !0 }),
                            this.callEvent("app:route", [this.getUrl()]),
                            t
                        )
                    );
            return (this.ready = this.ready.then(() => l)), l;
        }
        getSubView() {
            if (this._subSegment) {
                const t = this._subSegment.current().view;
                if (t) return t;
            }
            return new a(this, {});
        }
        require(t, e) {
            return null;
        }
        _first_start(t) {
            this._segment = t;
            if (
                ((this.$router = new this.config.router(
                    (t) =>
                        setTimeout(() => {
                            this.show(t).catch((t) => {
                                if (!(t instanceof e)) throw t;
                            });
                        }, 1),
                    this.config,
                    this
                )),
                this._container === document.body &&
                    !1 !== this.config.animation)
            ) {
                const t = this._container;
                this.webix.html.addCss(t, "webixappstart"),
                    setTimeout(() => {
                        this.webix.html.removeCss(t, "webixappstart"),
                            this.webix.html.addCss(t, "webixapp");
                    }, 10);
            }
            if (t) {
                if (this.app) {
                    const e = t.current().view;
                    (t.current().view = this),
                        t.next()
                            ? (t.refresh(), (t = t.split()))
                            : (t = new o(this.config.start, 0)),
                        (t.current().view = e);
                }
            } else {
                let e = this.$router.get();
                e ||
                    ((e = this.config.start),
                    this.$router.set(e, { silent: !0 })),
                    (t = new o(e, 0));
            }
            return t;
        }
        _loadError(t, e) {
            return this.error("app:error:resolve", [e, t]), { template: " " };
        }
        addSubView(t, e, i) {
            const s = !0 !== t.$subview ? t.$subview : null,
                r = t.name || (s ? this.webix.uid() : "default");
            e.id = t.id || "s" + this.webix.uid();
            return (i[r] = {
                id: e.id,
                url: s,
                branch: t.branch,
                popup: t.popup,
                params: t.params,
            }).popup
                ? null
                : e;
        }
    }
    class p {
        constructor(t, e) {
            (this.config = e || {}),
                this._detectPrefix(),
                (this.cb = t),
                (window.onpopstate = () => this.cb(this.get()));
        }
        set(t, e) {
            if (this.config.routes) {
                const e = t.split("?", 2);
                for (const i in this.config.routes)
                    if (this.config.routes[i] === e[0]) {
                        t = i + (e.length > 1 ? "?" + e[1] : "");
                        break;
                    }
            }
            this.get() !== t &&
                window.history.pushState(
                    null,
                    null,
                    this.prefix + this.sufix + t
                ),
                (e && e.silent) || setTimeout(() => this.cb(t), 1);
        }
        get() {
            let t = this._getRaw()
                .replace(this.prefix, "")
                .replace(this.sufix, "");
            if (((t = "/" !== t && "#" !== t ? t : ""), this.config.routes)) {
                const e = t.split("?", 2),
                    i = this.config.routes[e[0]];
                i && (t = i + (e.length > 1 ? "?" + e[1] : ""));
            }
            return t;
        }
        _detectPrefix() {
            const t = this.config.routerPrefix;
            (this.sufix = "#" + (void 0 === t ? "!" : t)),
                (this.prefix = document.location.href.split("#", 2)[0]);
        }
        _getRaw() {
            return document.location.href;
        }
    }
    let d = !1;
    function g(t) {
        if (d || !t) return;
        d = !0;
        const e = window;
        e.Promise || (e.Promise = t.promise);
        const i = t.version.split(".");
        10 * i[0] + 1 * i[1] < 53 &&
            (t.ui.freeze = function (e) {
                const i = e();
                return (
                    i && i.then
                        ? i.then(function (e) {
                              return (t.ui.$freeze = !1), t.ui.resize(), e;
                          })
                        : ((t.ui.$freeze = !1), t.ui.resize()),
                    i
                );
            });
        const s = t.ui.baselayout.prototype.addView,
            r = t.ui.baselayout.prototype.removeView,
            n = {
                addView(t, e) {
                    if (this.$scope && this.$scope.webixJet && !t.queryView) {
                        const i = this.$scope,
                            r = {};
                        (t = i.app.copyConfig(t, {}, r)), s.apply(this, [t, e]);
                        for (const t in r)
                            i._renderFrame(t, r[t], null).then(() => {
                                i._subs[t] = r[t];
                            });
                        return t.id;
                    }
                    return s.apply(this, arguments);
                },
                removeView() {
                    if (
                        (r.apply(this, arguments),
                        this.$scope && this.$scope.webixJet)
                    ) {
                        const e = this.$scope._subs;
                        for (const i in e) {
                            const s = e[i];
                            t.$$(s.id) || (s.view.destructor(), delete e[i]);
                        }
                    }
                },
            };
        t.extend(t.ui.layout.prototype, n, !0),
            t.extend(t.ui.baselayout.prototype, n, !0),
            t.protoUI(
                {
                    name: "jetapp",
                    $init(e) {
                        this.$app = new this.app(e);
                        const i = t.uid().toString();
                        (e.body = { id: i }),
                            this.$ready.push(function () {
                                this.callEvent("onInit", [this.$app]),
                                    this.$app.render({ id: i });
                            });
                    },
                },
                t.ui.proxy,
                t.EventSystem
            );
    }
    class f extends u {
        constructor(t) {
            (t.router = t.router || p), super(t), g(this.webix);
        }
        require(t, e) {
            return require(t + "/" + e);
        }
    }
    class m {
        constructor(t, e) {
            (this.path = ""), (this.cb = t);
        }
        set(t, e) {
            (this.path = t), (e && e.silent) || setTimeout(() => this.cb(t), 1);
        }
        get() {
            return this.path;
        }
    }
    function _(t, e) {
        return Object.prototype.hasOwnProperty.call(t, e);
    }
    function w(t, e, i) {
        for (var s in t) _(t, s) && e.call(i || t, t[s], s, t);
    }
    function b(t) {
        (t = "Warning: " + t),
            "undefined" != typeof console && console.error(t);
        try {
            throw new Error(t);
        } catch (t) {}
    }
    var v = String.prototype.replace,
        x = String.prototype.split,
        y = function (t) {
            var e = t % 10;
            return 11 !== t && 1 === e
                ? 0
                : 2 <= e && e <= 4 && !(t >= 12 && t <= 14)
                ? 1
                : 2;
        },
        S = {
            arabic: function (t) {
                if (t < 3) return t;
                var e = t % 100;
                return e >= 3 && e <= 10 ? 3 : e >= 11 ? 4 : 5;
            },
            bosnian_serbian: y,
            chinese: function () {
                return 0;
            },
            croatian: y,
            french: function (t) {
                return t > 1 ? 1 : 0;
            },
            german: function (t) {
                return 1 !== t ? 1 : 0;
            },
            russian: y,
            lithuanian: function (t) {
                return t % 10 == 1 && t % 100 != 11
                    ? 0
                    : t % 10 >= 2 &&
                      t % 10 <= 9 &&
                      (t % 100 < 11 || t % 100 > 19)
                    ? 1
                    : 2;
            },
            czech: function (t) {
                return 1 === t ? 0 : t >= 2 && t <= 4 ? 1 : 2;
            },
            polish: function (t) {
                if (1 === t) return 0;
                var e = t % 10;
                return 2 <= e && e <= 4 && (t % 100 < 10 || t % 100 >= 20)
                    ? 1
                    : 2;
            },
            icelandic: function (t) {
                return t % 10 != 1 || t % 100 == 11 ? 1 : 0;
            },
            slovenian: function (t) {
                var e = t % 100;
                return 1 === e ? 0 : 2 === e ? 1 : 3 === e || 4 === e ? 2 : 3;
            },
        },
        $ = {
            arabic: ["ar"],
            bosnian_serbian: ["bs-Latn-BA", "bs-Cyrl-BA", "srl-RS", "sr-RS"],
            chinese: [
                "id",
                "id-ID",
                "ja",
                "ko",
                "ko-KR",
                "lo",
                "ms",
                "th",
                "th-TH",
                "zh",
            ],
            croatian: ["hr", "hr-HR"],
            german: [
                "fa",
                "da",
                "de",
                "en",
                "es",
                "fi",
                "el",
                "he",
                "hi-IN",
                "hu",
                "hu-HU",
                "it",
                "nl",
                "no",
                "pt",
                "sv",
                "tr",
            ],
            french: ["fr", "tl", "pt-br"],
            russian: ["ru", "ru-RU"],
            lithuanian: ["lt"],
            czech: ["cs", "cs-CZ", "sk"],
            polish: ["pl"],
            icelandic: ["is"],
            slovenian: ["sl-SL"],
        };
    function C(t) {
        var e,
            i =
                ((e = {}),
                w($, function (t, i) {
                    w(t, function (t) {
                        e[t] = i;
                    });
                }),
                e);
        return i[t] || i[x.call(t, /-/, 1)[0]] || i.en;
    }
    function k(t) {
        return t.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
    }
    var V = /\$/g,
        O = /%\{(.*?)\}/g;
    function R(t, e, i, s) {
        if ("string" != typeof t)
            throw new TypeError(
                "Polyglot.transformPhrase expects argument #1 to be string"
            );
        if (null == e) return t;
        var r = t,
            n = s || O,
            o = "number" == typeof e ? { smart_count: e } : e;
        if (null != o.smart_count && r) {
            var a = x.call(r, "||||");
            r = (
                a[
                    (function (t, e) {
                        return S[C(t)](e);
                    })(i || "en", o.smart_count)
                ] || a[0]
            ).replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, "");
        }
        return (r = v.call(r, n, function (t, e) {
            return _(o, e) && null != o[e] ? v.call(o[e], V, "$$") : t;
        }));
    }
    function P(t) {
        var e = t || {};
        (this.phrases = {}),
            this.extend(e.phrases || {}),
            (this.currentLocale = e.locale || "en");
        var i = e.allowMissing ? R : null;
        (this.onMissingKey =
            "function" == typeof e.onMissingKey ? e.onMissingKey : i),
            (this.warn = e.warn || b),
            (this.tokenRegex = (function (t) {
                var e = (t && t.prefix) || "%{",
                    i = (t && t.suffix) || "}";
                if ("||||" === e || "||||" === i)
                    throw new RangeError(
                        '"||||" token is reserved for pluralization'
                    );
                return new RegExp(k(e) + "(.*?)" + k(i), "g");
            })(e.interpolation));
    }
    (P.prototype.locale = function (t) {
        return t && (this.currentLocale = t), this.currentLocale;
    }),
        (P.prototype.extend = function (t, e) {
            w(
                t,
                function (t, i) {
                    var s = e ? e + "." + i : i;
                    "object" == typeof t
                        ? this.extend(t, s)
                        : (this.phrases[s] = t);
                },
                this
            );
        }),
        (P.prototype.unset = function (t, e) {
            "string" == typeof t
                ? delete this.phrases[t]
                : w(
                      t,
                      function (t, i) {
                          var s = e ? e + "." + i : i;
                          "object" == typeof t
                              ? this.unset(t, s)
                              : delete this.phrases[s];
                      },
                      this
                  );
        }),
        (P.prototype.clear = function () {
            this.phrases = {};
        }),
        (P.prototype.replace = function (t) {
            this.clear(), this.extend(t);
        }),
        (P.prototype.t = function (t, e) {
            var i,
                s,
                r = null == e ? {} : e;
            if ("string" == typeof this.phrases[t]) i = this.phrases[t];
            else if ("string" == typeof r._) i = r._;
            else if (this.onMissingKey) {
                s = (0, this.onMissingKey)(
                    t,
                    r,
                    this.currentLocale,
                    this.tokenRegex
                );
            } else
                this.warn('Missing translation for key: "' + t + '"'), (s = t);
            return (
                "string" == typeof i &&
                    (s = R(i, r, this.currentLocale, this.tokenRegex)),
                s
            );
        }),
        (P.prototype.has = function (t) {
            return _(this.phrases, t);
        }),
        (P.transformPhrase = function (t, e, i) {
            return R(t, e, i);
        });
    var E = P;
    let A = window.webix;
    A && g(A);
    const L = function (t, e, i) {
            const s = (i = i || {}).storage;
            let r = s ? s.get("lang") || "en" : i.lang || "en";
            function n(e, n, o) {
                n.__esModule && (n = n.default);
                const l = { phrases: n };
                i.polyglot && t.webix.extend(l, i.polyglot);
                const h = (a.polyglot = new E(l));
                if (
                    (h.locale(e),
                    (a._ = t.webix.bind(h.t, h)),
                    (r = e),
                    s && s.put("lang", r),
                    i.webix)
                ) {
                    const s = i.webix[e];
                    s && t.webix.i18n.setLocale(s);
                }
                return o ? Promise.resolve() : t.refresh();
            }
            function o(e, s) {
                if (!1 === i.path) return;
                const r = (i.path ? i.path + "/" : "") + e;
                n(e, t.require("jet-locales", r), s);
            }
            const a = {
                getLang: function () {
                    return r;
                },
                setLang: o,
                setLangData: n,
                _: null,
                polyglot: null,
            };
            t.setService("locale", a), o(r, !0);
        },
        F = window;
    F.Promise || (F.Promise = F.webix.promise);
    let j = !1;
    function I(t, e, i) {
        const s = e.$width,
            r = e.$height;
        t.config._fillApp
            ? t.define({ width: s, height: r })
            : t.define({ left: (s - t.$width) / 2, top: (r - t.$height) / 2 }),
            i || t.resize();
    }
    function M(t, e) {
        const i = e.getRoot();
        t.attachEvent("onHide", () => {
            webix.html.removeCss(i.$view, "webix_win_inside"), i.enable();
        });
        const s = e.attachEvent("view:resize", () => {
            I(t, i);
        });
        t.attachEvent("onDestruct", () => {
            e.detachEvent(s);
        });
    }
    var D = 1;
    function H(t, e, i) {
        Object.defineProperty(e, i, {
            get: () => t[i],
            set: (e) => (t[i] = e),
        });
    }
    function T(t, e) {
        e = e || {};
        const i = {},
            s = {},
            r = function (t, e) {
                const r = D++;
                return (
                    (i[r] = { mask: t, handler: e }),
                    e("*" === t ? s : s[t], void 0, t),
                    r
                );
            },
            n = [];
        let o = !1;
        const a = function (t, e, s, r) {
            if (o) return void n.push([t, e, s, r]);
            const a = Object.keys(i);
            for (let n = 0; n < a.length; n++) {
                const o = i[a[n]];
                o &&
                    (("*" !== o.mask && o.mask !== t) || o.handler(s, e, t, r));
            }
        };
        return (
            Object.defineProperty(s, "$changes", {
                value: {
                    attachEvent: r,
                    detachEvent: function (t) {
                        delete i[t];
                    },
                },
                enumerable: !1,
                configurable: !1,
            }),
            Object.defineProperty(s, "$observe", {
                value: r,
                enumerable: !1,
                configurable: !1,
            }),
            Object.defineProperty(s, "$batch", {
                value: function (t) {
                    if ("function" != typeof t) {
                        const e = t;
                        t = () => {
                            for (const t in e) s[t] = e[t];
                        };
                    }
                    for (o = !0, t(s), o = !1; n.length; ) {
                        const t = n.shift();
                        a.apply(this, t);
                    }
                },
                enumerable: !1,
                configurable: !1,
            }),
            Object.defineProperty(s, "$extend", {
                value: function (t, i) {
                    i = i || e;
                    for (const e in t)
                        if (t.hasOwnProperty(e)) {
                            const r = t[e];
                            i.nested && "object" == typeof r && r
                                ? (s[e] = T(r, i))
                                : z(s, r, e, a);
                        }
                },
                enumerable: !1,
                configurable: !1,
            }),
            s.$extend(t, e),
            s
        );
    }
    function z(t, e, i, s) {
        Object.defineProperty(t, i, {
            get: function () {
                return e;
            },
            set: function (t) {
                if (
                    null === e || null === t
                        ? e !== t
                        : e.valueOf() != t.valueOf()
                ) {
                    var r = e;
                    (e = t), s(i, r, t, null);
                }
            },
            enumerable: !0,
            configurable: !1,
        });
    }
    webix.protoUI(
        {
            name: "pivot-portlet",
            $reorderOnly: !0,
            $drag: function (t) {
                webix.html.addCss(this.$view, "portlet_in_drag");
                const e = webix.DragControl.getContext();
                (e.source = e.from = t), webix.callEvent("onClick", []);
                const i = this.$scope.app.getService("local"),
                    s = this.getChildViews()[0].getValues();
                let r = "";
                if ("complex" == s.operation) r = i.fixMath(s.math);
                else if (
                    ((r = s.name ? i.getField(s.name).value : ""), s.name2)
                )
                    r += (r ? ", " : "") + i.getField(s.name2).value;
                else if (r) s.operation && (r += ` (${s.operation})`);
                else {
                    r = (0, this.$scope.app.getService("locale")._)(
                        "Field not defined"
                    );
                }
                const n = webix.skin.$active;
                return `<div class="webix_pivot_portlet_drag" style="${`width:${
                    this.$width - n.inputHeight
                }px;height:${
                    this.$height
                }px;`}">\n\t\t\t\t<span class="webix_icon ${
                    this.config.icon
                }"></span>${r}\n\t\t\t</div>`;
            },
        },
        webix.ui.portlet
    );
    class U extends a {
        constructor(t, e, i) {
            super(t, e),
                i || (i = {}),
                (this.plusLabel = i.plusLabel),
                (this.field = i.field);
        }
        config() {
            const t = webix.skin.$active;
            return {
                borderless: !0,
                type: "clean",
                paddingY: 8,
                rows: [
                    { localId: "forms", type: "clean", rows: [] },
                    {
                        template: `<div class="webix_pivot_handle_add_value">\n\t\t\t\t\t\t<span class="webix_icon wxi-plus-circle"></span><span>${this.plusLabel}</span>\n\t\t\t\t\t</div>`,
                        css: "webix_pivot_add_value",
                        height: t.inputHeight - 2 * t.inputPadding,
                        localId: "addValue",
                        onClick: {
                            webix_pivot_handle_add_value: () => {
                                const t = this.$$("forms").getChildViews();
                                this.Add(null, t.length);
                                const e = t[t.length - 1].queryView({
                                    name: "name",
                                });
                                e &&
                                    (e.focus(),
                                    webix.html.triggerEvent(
                                        e.getInputNode(),
                                        "MouseEvent",
                                        "click"
                                    )),
                                    "values" != this.field &&
                                        t.length ==
                                            this.app.getState().fields.length &&
                                        this.$$("addValue").hide();
                            },
                        },
                    },
                ],
            };
        }
        init() {
            this.on(webix, "onAfterPortletMove", (t) => {
                t == this.$$("forms") &&
                    this.app.callEvent("property:change", [
                        this.field,
                        this.GetValue(),
                    ]);
            }),
                this.on(webix, "onPortletDrag", function (t, e) {
                    if (t.$reorderOnly)
                        return t.getParentView() === e.getParentView();
                });
        }
        ListTemplate(t) {
            const e = this._activeInput,
                i =
                    "values" == this.field &&
                    e &&
                    !e.$destructed &&
                    "wavg" == e.getFormView().elements.operation.getValue(),
                s = this.getParentView().GetCorrections()[this.field],
                r = t.value;
            if (!i && s) {
                let e = "webix_pivot_list_marker";
                return (
                    this.CheckCorrections(s, t.id) &&
                        (e += " webix_pivot_list_marker_fill"),
                    `<div class="${e}"> ${r}</div>`
                );
            }
            return r;
        }
        CheckCorrections(t, e) {
            if (this._activeInput && e == this._activeInput.getValue())
                return !0;
            const i = this.app.getStructure();
            for (let s = 0; s < t.length; s++) {
                const r = i[t[s]];
                if (r)
                    if ("string" == typeof r) {
                        if (r == e) return !0;
                    } else
                        for (let t = 0; t < r.length; t++) {
                            let i = r[t];
                            if ((i.name && (i = i.name), i == e)) return !0;
                        }
            }
            return !1;
        }
        GetValue() {
            const t = this.$$("forms").getChildViews();
            let e = [];
            return (
                t.forEach((t) => {
                    const i = t.getChildViews()[0].getValues().name;
                    i && e.push(i);
                }),
                e
            );
        }
        SetValue(t) {
            const e = this.$$("forms"),
                i = e.getChildViews();
            for (let t = i.length - 1; t >= 0; t--) e.removeView(i[t]);
            for (let e = 0; e < t.length; e++)
                t[e].external || this.Add(t[e], e);
        }
        Add(t, e) {
            this.$$("forms").addView({
                view: "pivot-portlet",
                mode: "replace",
                borderless: !0,
                body: {
                    view: "form",
                    paddingY: 0,
                    paddingX: 2,
                    elements: [{ margin: 2, cols: this.ItemConfig(t, e) }],
                    on: {
                        onChange: (t, e, i) => {
                            "user" == i &&
                                this.app.callEvent("property:change", [
                                    this.field,
                                    this.GetValue(),
                                ]);
                        },
                    },
                },
            });
        }
        ItemConfig(t) {
            return [
                { width: webix.skin.$active.inputHeight },
                {
                    view: "richselect",
                    name: "name",
                    value: this.PrepareValue(t),
                    hidden: t && "complex" == t.operation,
                    options: {
                        css: "webix_pivot_suggest",
                        data: this.app.getState().fields,
                        on: {
                            onBeforeShow: function () {
                                const t = webix.$$(this.config.master),
                                    e = t.$scope,
                                    i = e.GetValue();
                                (e._activeInput = t),
                                    this.getList().filter((s) =>
                                        e.FilterSuggest(i, t.getValue(), s)
                                    );
                            },
                        },
                        body: { template: (t) => this.ListTemplate(t) },
                    },
                },
                {
                    view: "icon",
                    icon: "wxi-close",
                    css: "webix_pivot_close_icon",
                    pivotPropertyRemove: !0,
                    click: function () {
                        const t = this.$scope;
                        t.$$("addValue").show(),
                            t
                                .$$("forms")
                                .removeView(
                                    this.queryView("pivot-portlet", "parent")
                                ),
                            t.app.callEvent("property:change", [
                                t.field,
                                t.GetValue(),
                            ]);
                    },
                },
            ];
        }
        PrepareValue(t) {
            return (
                t
                    ? ("object" == typeof t && (t = t.name),
                      webix.isArray(t) && (t = t[0]))
                    : (t = ""),
                t
            );
        }
        FilterSuggest(t, e, i) {
            return (
                (i = i.id) == e ||
                !t.find((t) => (t.name && (t = t.name), i == t))
            );
        }
    }
    function B(t) {
        const e = t.charCodeAt(0);
        return e <= 122 ? e >= 65 : e > 191;
    }
    function G(t) {
        for (let e = t.length - 1; e >= 0; e--) if (!B(t[e])) return e + 1;
        return 0;
    }
    function N(t, e) {
        return 0 === t.toLowerCase().indexOf(e.toLowerCase());
    }
    webix.protoUI(
        {
            name: "suggest-math",
            $enterKey() {
                const t = this.getList();
                this.isVisible() &&
                    !t.getSelectedId() &&
                    t.count() &&
                    (t.select(t.data.order[1]), (this._addFirst = 1)),
                    webix.ui.suggest.prototype.$enterKey.apply(this, arguments),
                    webix.delay(() => {
                        delete this._addFirst;
                    });
            },
            defaults: {
                filter(t, e) {
                    const i = webix.$$(this.config.master),
                        s = i.getInputNode().selectionStart,
                        r = e.substring(0, s),
                        n = r.substring(G(r)),
                        o = e.charAt(s);
                    if (
                        (!n || (s !== e.length && B(o)) || (e = n), t.disabled)
                    ) {
                        const s = i.$scope.app;
                        if ("$fields" == t.id) {
                            return !!s
                                .getState()
                                .fields.find((t) => N(t.value, e));
                        }
                        if ("$methods" == t.id) {
                            const t = s.getService("locale")._;
                            return !!s
                                .getService("local")
                                .operations.find((i) => N(t(i.id), e));
                        }
                    }
                    return N(t.value, e);
                },
            },
        },
        webix.ui.suggest
    ),
        webix.protoUI(
            {
                name: "math-editor",
                $init() {
                    this.$view.className += " webix_el_text";
                },
                $onBlur() {
                    const t = webix
                        .$$(this.config.suggest)
                        .$view.contains(document.activeElement);
                    webix.delay(() => {
                        const e = webix.UIManager.getFocus();
                        (e && e.config.pivotPropertyRemove) ||
                            t ||
                            this.callEvent("onChange", [
                                this.getValue(),
                                null,
                                "user",
                            ]);
                    });
                },
                setValue() {
                    const t = webix.$$(this.config.suggest);
                    t.isVisible() ||
                        t._addFirst ||
                        webix.ui.text.prototype.setValue.apply(this, arguments);
                },
                $setValueHere(t) {
                    this.setValueHere(t);
                },
                setValueHere(t) {
                    const e = this.getValue(),
                        i = this.getInputNode().selectionStart;
                    let s = e.substring(0, i);
                    const r = e.substring(i);
                    "(" == s[s.length - 1] &&
                        (s = s.substring(0, s.length - 1)),
                        (s = s.substring(0, G(s)) + t);
                    this.$scope.app
                        .getService("local")
                        .operations.find((e) => e.value == t) &&
                        (s += "(" == r[0] ? "" : "("),
                        this.$setValue(s + r),
                        this.getInputNode().setSelectionRange(
                            s.length,
                            s.length
                        );
                },
            },
            webix.ui.text
        );
    class W extends U {
        constructor(t, e, i) {
            super(t, e, i),
                (this.Local = this.app.getService("local")),
                (this._ = this.app.getService("locale")._),
                (this.typeName = "operation"),
                (this.plusLabel = this._("Add value")),
                (this.field = "values"),
                (this.operations = this.Local.operations),
                this.operations.map((t) => ((t.value = this._(t.id)), t));
        }
        init() {
            super.init(),
                (this.State = this.app.getState()),
                this.on(this.State.$changes, "mode", (t) => {
                    this.ToggleColors("chart" == t);
                });
        }
        GetValue() {
            const t = this.$$("forms").getChildViews(),
                e = [];
            return (
                t.forEach((t) => {
                    const i = t.getChildViews()[0].getValues({ hidden: !1 });
                    webix.isUndefined(i.name2) ||
                        (i.name && i.name2
                            ? ((i.name = [i.name, i.name2]), delete i.name2)
                            : (i.name = "")),
                        "" != i.name &&
                            "" != i.math &&
                            (i.math && (i.math = this.OutComplexMath(i.math)),
                            e.push(i));
                }),
                e
            );
        }
        ItemConfig(t, e) {
            const i = super.ItemConfig(t);
            let s;
            if (t) s = t.operation;
            else {
                const t = this.app.config.defaultOperation,
                    e = Math.max(
                        this.operations.findIndex((e) => e.id == t),
                        0
                    );
                s = this.operations[e].id;
            }
            i.splice(2, 0, {
                view: "richselect",
                name: "operation",
                width: 110,
                value: s,
                options: { css: "webix_pivot_suggest", data: this.operations },
                on: {
                    onChange: function (t) {
                        this.$scope.SetOperation(t, this);
                    },
                },
            }),
                i.splice(2, 0, {
                    view: "richselect",
                    hidden: !t || "wavg" != t.operation,
                    value: t && webix.isArray(t.name) ? t.name[1] : "",
                    name: "name2",
                    options: {
                        css: "webix_pivot_suggest",
                        data: this.app.getState().fields,
                    },
                }),
                i.splice(1, 0, {
                    view: "math-editor",
                    name: "math",
                    hidden: !t || "complex" != t.operation,
                    value: t && t.math ? this.Local.fixMath(t.math) : "",
                    suggest: { view: "suggest-math", data: this.SuggestData() },
                });
            const r =
                    "mini" == webix.skin.$name || "compact" == webix.skin.$name,
                n = this.Local.getPalette(),
                o = (t && t.color) || this.Local.getValueColor(e);
            return (
                i.splice(1, 0, {
                    view: "colorpicker",
                    hidden: "chart" != this.State.mode,
                    name: "color",
                    css: "webix_pivot_value_color",
                    value: o,
                    width: r ? 30 : 38,
                    suggest: {
                        type: "colorboard",
                        body: {
                            width: 150,
                            height: 150,
                            view: "colorboard",
                            palette: n,
                        },
                    },
                }),
                i
            );
        }
        ToggleColors(t) {
            const e = this.$$("forms").getChildViews();
            for (let i = 0; i < e.length; i++) {
                const s = e[i].getChildViews()[0].elements.color;
                t ? s.show() : s.hide();
            }
        }
        FilterSuggest() {
            return !0;
        }
        SetOperation(t, e) {
            const i = e.getFormView().elements;
            "wavg" == t
                ? (i.name.show(), i.name2.show(), i.math.hide())
                : "complex" == t
                ? (i.name.hide(),
                  i.name2.hide(),
                  i.math.show(),
                  i.name.setValue(),
                  i.name2.setValue())
                : (i.name.show(), i.name2.hide(), i.math.hide());
        }
        SuggestData() {
            return [
                {
                    value: this._("Fields"),
                    id: "$fields",
                    disabled: !0,
                    $css: "webix_pivot_values_section",
                },
                ...this.app.getState().fields,
                {
                    value: this._("Methods"),
                    id: "$methods",
                    disabled: !0,
                    $css: "webix_pivot_values_section",
                },
                ...this.operations.filter((t) => "complex" != t.id),
            ];
        }
        OutComplexMath(t) {
            const e = this.app.getState().fields,
                i = new RegExp(
                    "(\\(|\\s|,|^)(" +
                        e.map((t) => t.value).join("|") +
                        ")(\\)|\\s|,|$)",
                    "g"
                ),
                s = Array.from(t.matchAll(i));
            for (let i = s.length - 1; i >= 0; i--) {
                const r = s[i];
                t =
                    t.substring(0, r.index + r[1].length) +
                    e.find((t) => t.value == r[2]).id +
                    t.substring(r.index + r[0].length - r[3].length, t.length);
            }
            const r = this.operations,
                n = new RegExp(
                    "(\\(|,|\\+|-|\\/|\\*|\\s|^)(" +
                        r.map((t) => t.value).join("|") +
                        ")\\(",
                    "g"
                ),
                o = Array.from(t.matchAll(n));
            for (let e = o.length - 1; e >= 0; e--) {
                const i = o[e];
                t =
                    t.substring(0, i.index + i[1].length) +
                    this.operations.find((t) => t.value == i[2]).id +
                    t.substring(i.index + i[0].length - 1, t.length);
            }
            return t;
        }
    }
    class X extends U {
        constructor(t, e) {
            super(t, e), (this.field = "groupBy");
        }
        config() {
            return {
                padding: 10,
                rows: [
                    {
                        view: "richselect",
                        localId: "group",
                        options: {
                            css: "webix_pivot_suggest",
                            data: this.app.getState().fields,
                            body: { template: (t) => this.ListTemplate(t) },
                            on: {
                                onBeforeShow: () => {
                                    this._activeInput = this.$$("group");
                                },
                            },
                        },
                        on: {
                            onChange: (t, e, i) => {
                                "user" == i &&
                                    this.app.callEvent("property:change", [
                                        this.field,
                                        t,
                                    ]);
                            },
                        },
                    },
                ],
            };
        }
        GetValue() {
            return this.$$("group").getValue();
        }
        SetValue(t) {
            this.$$("group").setValue(t);
        }
    }
    class Y extends a {
        config() {
            const t = this.app.getService("locale")._;
            return {
                view: "form",
                complexData: !0,
                padding: 10,
                elementsConfig: { labelWidth: 120 },
                elements: [
                    {
                        name: "type",
                        view: "richselect",
                        value: "bar",
                        options: {
                            css: "webix_pivot_suggest",
                            data: [
                                { id: "bar", value: t("Bar") },
                                { id: "line", value: t("Line") },
                                { id: "radar", value: t("Radar") },
                                { id: "area", value: t("Area") },
                                { id: "spline", value: t("Spline") },
                                { id: "splineArea", value: t("Spline Area") },
                            ],
                        },
                    },
                    {
                        name: "xAxis.title",
                        view: "text",
                        label: t("X axis title"),
                        batch: "axis",
                    },
                    {
                        name: "yAxis.title",
                        view: "text",
                        label: t("Y axis title"),
                        batch: "axis",
                    },
                    {
                        name: "scaleColor",
                        view: "colorpicker",
                        editable: !0,
                        label: t("Scale color"),
                        suggest: {
                            type: "colorboard",
                            body: {
                                width: 150,
                                height: 150,
                                view: "colorboard",
                                palette: this.app
                                    .getService("local")
                                    .getPalette(),
                            },
                        },
                    },
                    {
                        name: "stacked",
                        view: "checkbox",
                        batch: "stacked",
                        labelWidth: 0,
                        labelRight: t("Stacked"),
                    },
                    {
                        name: "horizontal",
                        view: "checkbox",
                        batch: "bar",
                        labelWidth: 0,
                        labelRight: t("Horizontal"),
                    },
                    {
                        name: "scale",
                        view: "checkbox",
                        checkValue: "logarithmic",
                        uncheckValue: "linear",
                        labelWidth: 0,
                        labelRight: t("Logarithmic scale"),
                    },
                    {
                        name: "yAxis.lineShape",
                        view: "checkbox",
                        batch: "radar",
                        checkValue: "arc",
                        labelWidth: 0,
                        labelRight: t("Circled lines"),
                    },
                    {
                        name: "lines",
                        view: "checkbox",
                        labelWidth: 0,
                        labelRight: t("Lines"),
                    },
                ],
                on: {
                    onChange: (t, e, i) => {
                        if ("user" == i) {
                            const t = this.OutValues(
                                this.getRoot().getValues()
                            );
                            (this.innerChange = !0),
                                (this.State.chart = Object.assign({}, t)),
                                this.HandleVisibility(),
                                delete this.innerChange;
                        }
                    },
                },
            };
        }
        init() {
            (this.State = this.getParam("state", !0)),
                this.on(this.State.$changes, "chart", (t) => {
                    this.innerChange ||
                        (this.getRoot().setValues(this.InValues(t)),
                        this.HandleVisibility());
                });
        }
        HandleVisibility() {
            const t = this.getRoot(),
                e = t.getValues().type;
            if ("radar" == e) t.showBatch("radar");
            else {
                t.showBatch("axis");
                const i = "bar" == e;
                (i || "area" == e) &&
                    (i && t.showBatch("bar", !0), t.showBatch("stacked", !0));
            }
        }
        InValues(t) {
            const e = (t = webix.copy(t)).type.toLowerCase(),
                i = "stackedarea" == e;
            return (
                (-1 != e.indexOf("bar") || i) &&
                    (-1 != e.indexOf("stacked") && (t.stacked = 1),
                    -1 != e.indexOf("h") && (t.horizontal = 1),
                    (t.type = i ? "area" : "bar")),
                t
            );
        }
        OutValues(t) {
            const e = "bar" == t.type;
            return (
                (e || "area" == t.type) &&
                    (e &&
                        t.horizontal &&
                        ((t.type += "H"), delete t.horizontal),
                    t.stacked &&
                        ((t.type =
                            "stacked" +
                            t.type[0].toUpperCase() +
                            t.type.slice(1)),
                        delete t.stacked)),
                t
            );
        }
    }
    class q extends a {
        config() {
            const t = this.app.getService("locale")._;
            return {
                view: "form",
                padding: 10,
                elements: [
                    {
                        name: "cleanRows",
                        localId: "cleanRows",
                        view: "checkbox",
                        labelWidth: 0,
                        labelRight: t("Clean rows"),
                    },
                    { view: "label", height: 20, label: t("Highlight") },
                    {
                        cols: [
                            {
                                name: "minX",
                                view: "checkbox",
                                labelWidth: 0,
                                labelRight: t("Min X"),
                            },
                            {
                                name: "maxX",
                                view: "checkbox",
                                labelWidth: 0,
                                labelRight: t("Max X"),
                            },
                            {
                                name: "minY",
                                view: "checkbox",
                                labelWidth: 0,
                                labelRight: t("Min Y"),
                            },
                            {
                                name: "maxY",
                                view: "checkbox",
                                labelWidth: 0,
                                labelRight: t("Max Y"),
                            },
                        ],
                    },
                    { view: "label", height: 20, label: t("Footer") },
                    {
                        view: "radio",
                        name: "footer",
                        options: [
                            { id: 1, value: t("Off") },
                            { id: 2, value: t("On") },
                            { id: 3, value: t("Sum Only") },
                        ],
                        value: 1,
                    },
                    { view: "label", height: 20, label: t("Total Column") },
                    {
                        view: "radio",
                        name: "totalColumn",
                        options: [
                            { id: 1, value: t("Off") },
                            { id: 2, value: t("On") },
                            { id: 3, value: t("Sum Only") },
                        ],
                        value: 1,
                    },
                ],
                on: {
                    onChange: (t, e, i) => {
                        if ("user" == i) {
                            const t = this.OutValues(
                                this.getRoot().getValues()
                            );
                            (this.innerChange = !0),
                                (this.State.datatable = Object.assign({}, t)),
                                delete this.innerChange;
                        }
                    },
                },
            };
        }
        init() {
            (this.State = this.getParam("state", !0)),
                this.on(this.State.$changes, "datatable", (t) => {
                    this.innerChange ||
                        this.getRoot().setValues(this.InValues(t));
                }),
                this.on(this.State.$changes, "mode", (t) => {
                    "table" == t
                        ? this.$$("cleanRows").show()
                        : this.$$("cleanRows").hide();
                });
        }
        InValues(t) {
            return (
                (t = webix.copy(t)).footer
                    ? (t.footer = "sumOnly" == t.footer ? 3 : 2)
                    : (t.footer = 1),
                t.totalColumn
                    ? (t.totalColumn = "sumOnly" == t.totalColumn ? 3 : 2)
                    : (t.totalColumn = 1),
                t
            );
        }
        OutValues(t) {
            switch (t.footer) {
                case "1":
                    delete t.footer;
                    break;
                case "2":
                    t.footer = !0;
                    break;
                case "3":
                    t.footer = "sumOnly";
            }
            switch (t.totalColumn) {
                case "1":
                    delete t.totalColumn;
                    break;
                case "2":
                    t.totalColumn = !0;
                    break;
                case "3":
                    t.totalColumn = "sumOnly";
            }
            return t;
        }
    }
    class K extends a {
        config() {
            return (
                (this.Local = this.app.getService("local")),
                {
                    view: "popup",
                    css: "webix_pivot_filter_popup",
                    body: {
                        view: "filter",
                        field: "value",
                        on: {
                            onChange: (t) => {
                                if ("user" == t) {
                                    const t = this.app.getState(),
                                        e = webix.copy(t.structure);
                                    let i;
                                    (e.filters = e.filters.filter((t) => {
                                        const e = t.name == this.field,
                                            s = e && !t.external;
                                        return (
                                            s &&
                                                (i = t.value =
                                                    this.filter.getValue()),
                                            !e || s
                                        );
                                    })),
                                        (t.structure = e),
                                        this.app.callEvent("filter:change", [
                                            this.field,
                                            i,
                                        ]);
                                }
                            },
                        },
                    },
                }
            );
        }
        Show(t, e) {
            const i = this.getRoot(),
                s = (this.filter = i.getBody());
            this.field = e.name;
            const r = s.getChildViews()[2],
                n = this.Local.getField(this.field),
                o = webix.copy(this.Local.collectFieldValues(this.field));
            r.clearAll(),
                r.parse(o),
                r.define({
                    template: (t) => {
                        let e = t.value;
                        return (
                            "date" == n.type && (e = new Date(e)),
                            n.predicate
                                ? this.app.config.predicates[n.predicate](e)
                                : e
                        );
                    },
                }),
                s.define({ mode: n.type }),
                (s.config.value = ""),
                s.setValue(webix.copy(e.value || {})),
                i.show(t);
        }
    }
    class J extends a {
        config() {
            const t = this.app.getService("locale")._;
            this.Compact = this.getParam("compact");
            const e = webix.skin.$active,
                i = "mini" == webix.skin.$name || "compact" == webix.skin.$name,
                s = {
                    height: e.toolbarHeight,
                    cols: [
                        {
                            view: "segmented",
                            localId: "modes",
                            align: "middle",
                            inputHeight:
                                e.inputHeight - e.inputPadding * (i ? 0 : 2),
                            optionWidth: 80,
                            width: 244,
                            options: [
                                { id: "table", value: t("Table") },
                                { id: "tree", value: t("Tree") },
                                { id: "chart", value: t("Chart") },
                            ],
                            on: {
                                onChange: (t, e, i) => {
                                    "user" == i && this.SetMode(t);
                                },
                            },
                        },
                        { width: e.dataPadding },
                    ],
                };
            return (
                this.Compact &&
                    ((s.css = "webix_pivot_footer"),
                    (s.cols[1].width = 0),
                    s.cols.unshift({})),
                s
            );
        }
        init() {
            (this.State = this.getParam("state")),
                this.on(this.State.$changes, "mode", (t) => {
                    this.$$("modes").setValue(t);
                });
        }
        SetMode(t) {
            this.State.mode = t;
        }
    }
    class Z extends a {
        config() {
            const t = this.app.getService("locale")._;
            let e;
            if (
                ((this.Compact = this.getParam("compact")),
                (this.State = this.getParam("state")),
                this.Compact)
            )
                e = {
                    view: "icon",
                    icon: "pt-settings",
                    inputHeight: webix.skin.$active.buttonHeight,
                    on: { onItemClick: () => this.ToggleConfig() },
                };
            else {
                const i = t("Configure Pivot"),
                    s = "webix_template webix_pivot_measure_size";
                e = {
                    view: "template",
                    borderless: !0,
                    width: 28 + webix.html.getTextSize(i, s).width,
                    template: () =>
                        `\n\t\t\t\t\t\t<span>${i}</span>\n\t\t\t\t\t\t<span class="pt-settings webix_pivot_toolbar_icon"></span>`,
                    onClick: {
                        webix_pivot_settings: () => this.ToggleConfig(),
                    },
                };
            }
            (e.localId = "config"),
                (e.css = "webix_pivot_settings"),
                (e.tooltip = t("Click to configure"));
            const i = webix.env.$customScroll ? 0 : this._GetScrollWidth(),
                s = webix.skin.$active.toolbarHeight + i;
            let r = "webix_pivot_toolbar";
            i &&
                (webix.html.addStyle(
                    `.webix_pivot_bar_with_scroll .webix_pivot_settings>.webix_template{ line-height: ${s}px; }`
                ),
                (r += " webix_pivot_bar_with_scroll"));
            const n = {
                css: r,
                margin: this.Compact ? 12 : 0,
                padding: {
                    left: this.Compact ? webix.skin.$active.inputPadding : 0,
                },
                height: s,
                cols: [e, this.GetFilters()],
            };
            return this.Compact || n.cols.push(J), n;
        }
        init() {
            (this.filterPopup = this.ui(K)),
                this.on(this.State.$changes, "fields", (t) => {
                    if (t.length) {
                        const t = this.$$("filters").getParentView();
                        webix.ui(this.GetFilters(), t);
                    }
                }),
                this.on(this.State.$changes, "structure", (t, e) => {
                    if (e && this.FiltersChanged(t, e)) {
                        const t = this.$$("filters").getParentView();
                        webix.ui(this.GetFilters(), t);
                    }
                }),
                this.on(this.State.$changes, "readonly", (t) => {
                    this.ToggleReadonly(t);
                });
        }
        FiltersChanged(t, e) {
            if (t.filters.length != e.filters.length) return !0;
            for (let i = 0; i < t.filters.length; i++) {
                const s = t.filters[i],
                    r = e.filters[i];
                if (s.name != r.name || s.external != r.external) return !0;
                if (JSON.stringify(s.value) != JSON.stringify(r.value))
                    return !0;
            }
            return !1;
        }
        ToggleConfig() {
            this.State.config = !this.State.config;
        }
        ToggleReadonly(t) {
            t ? this.$$("config").hide() : this.$$("config").show();
        }
        GetFilters() {
            const t = this.State.structure,
                e = [];
            this.State.fields.length &&
                t.filters.forEach((t) => {
                    t.external || e.push(this.FilterConfig(t));
                });
            const i = webix.skin.$active,
                s = (i.toolbarHeight - i.buttonHeight) / 2;
            return {
                view: "scrollview",
                borderless: !0,
                scroll: "x",
                body: {
                    margin: 8,
                    padding: {
                        left: this.Compact ? 0 : 8,
                        top: s + i.inputPadding,
                        bottom: s + i.inputPadding,
                    },
                    localId: "filters",
                    cols: e,
                },
            };
        }
        FilterConfig(t) {
            const e = this.app.getService("local").getField(t.name).value;
            return {
                view: "template",
                borderless: !0,
                width:
                    (this.Compact ? 0 : 28) +
                    webix.html.getTextSize(
                        e,
                        "webix_template webix_pivot_measure_size"
                    ).width,
                css: "webix_pivot_filter",
                template: () => {
                    const i = t.value,
                        s =
                            i && (i.includes || i.condition.filter)
                                ? "webix_pivot_active_filter"
                                : "",
                        r = this.Compact
                            ? ""
                            : "<span class='pt-filter webix_pivot_toolbar_icon'></span>";
                    return `<div class="webix_pivot_filter_inner ${s}">\n\t\t\t\t\t<span>${e}</span>\n\t\t\t\t\t${r}\n\t\t\t\t</div>`;
                },
                onClick: {
                    webix_pivot_filter: function () {
                        this.$scope.filterPopup.Show(this.$view, t);
                    },
                },
            };
        }
        _GetScrollWidth() {
            const t = webix.html.create("DIV", {
                    style: "visibility:hidden;overflow:scroll;",
                }),
                e = webix.html.create("DIV");
            document.body.appendChild(t), t.appendChild(e);
            const i = t.offsetWidth - e.offsetWidth;
            return t.parentNode.removeChild(t), i;
        }
    }
    const Q = { JetView: a };
    (Q.chart = class extends a {
        config() {
            const t = (this.State = this.getParam("state", !0)),
                e = {
                    view: "chart",
                    $mainView: !0,
                    borderless: !0,
                    localId: "data",
                    xAxis: {},
                    yAxis: {},
                };
            webix.extend(e, webix.copy(t.chart), !0);
            const i = e.type;
            "barH" == i || "stackedBarH" == i
                ? e.yAxis.template ||
                  (e.yAxis.template = (t) => t[t.length - 1])
                : e.xAxis.template ||
                  (e.xAxis.template = (t) => t[t.length - 1]);
            const s = { lines: e.lines };
            return (
                e.scaleColor && (s.color = s.lineColor = e.scaleColor),
                webix.extend(e.xAxis, s, !0),
                webix.extend(e.yAxis, s, !0),
                e
            );
        }
        init() {
            (this.Local = this.app.getService("local")),
                this.LoadData(),
                this.on(this.State.$changes, "structure", (t, e) => {
                    e && this.UpdateStructure();
                }),
                this.on(this.State.$changes, "chart", (t, e) => {
                    e && this.refresh();
                });
        }
        LoadData() {
            return this.Local.getData().then((t) => {
                this.UpdateChart(t);
            });
        }
        UpdateStructure() {
            const t = this.Local.getPivotData();
            this.UpdateChart(t);
        }
        UpdateChart(t) {
            this.$$("data").clearAll(),
                this.$$("data").removeAllSeries(),
                this.SetSeries(t.values),
                this.$$("data").parse(t.data);
        }
        SetSeries(t) {
            const e = this.State.chart.type,
                i = this.app.getService("locale")._;
            for (let s = 0; s < t.length; s++)
                if (
                    (this.$$("data").addSeries({
                        value: (t) => t[s],
                        alpha: "area" == e || "splineArea" == e ? 0.7 : 1,
                        color: t[s].color,
                        tooltip: (t) => t[s],
                        item: { color: t[s].color, borderColor: t[s].color },
                        line: { color: t[s].color },
                    }),
                    "complex" == t[s].operation)
                )
                    t[s].text = this.Local.fixMath(t[s].text);
                else {
                    let e = t[s].text.split(",");
                    (e = e.map((t) => this.Local.getField(t).value).join(", ")),
                        (t[s].text = `${e} (${i(t[s].operation)})`);
                }
            this.SetLegend(t);
        }
        SetLegend(t) {
            const e = webix.extend(
                { values: t, valign: "middle", align: "right", layout: "y" },
                this.State.chart.legend || {},
                !0
            );
            this.$$("data").define({ legend: e });
        }
    }),
        (Q.config = class extends a {
            config() {
                const t = this.app.getService("locale")._;
                (this.State = this.app.getState()),
                    (this.Compact = this.getParam("compact", !0));
                return {
                    margin: 0,
                    rows: [
                        {
                            type: "form",
                            borderless: !0,
                            padding: { left: 16, right: 14, top: 8, bottom: 4 },
                            cols: [
                                {},
                                {
                                    view: "button",
                                    label: t("Done"),
                                    hotkey: "esc",
                                    autowidth: !0,
                                    css: "webix_primary",
                                    click: () => this.ToggleForm(),
                                },
                            ],
                        },
                        {
                            borderless: !0,
                            view: "scrollview",
                            scroll: "y",
                            body: {
                                view: "accordion",
                                css: "webix_pivot_configuration",
                                localId: "settings",
                                multi: !0,
                                type: "space",
                                padding: {
                                    left: 16,
                                    right: 16,
                                    top: 4,
                                    bottom: 16,
                                },
                                margin: 20,
                                rows: [
                                    this.GroupConfig(
                                        t("Rows"),
                                        "pt-rows",
                                        {
                                            name: "rows",
                                            $subview: new U(this.app, "", {
                                                field: "rows",
                                                plusLabel: t("Add row"),
                                            }),
                                        },
                                        "table"
                                    ),
                                    this.GroupConfig(
                                        t("Columns"),
                                        "pt-columns",
                                        {
                                            name: "columns",
                                            $subview: new U(this.app, "", {
                                                field: "columns",
                                                plusLabel: t("Add column"),
                                            }),
                                        },
                                        "table"
                                    ),
                                    this.GroupConfig(t("Values"), "pt-values", {
                                        name: "values",
                                        $subview: W,
                                    }),
                                    this.GroupConfig(
                                        t("Group By"),
                                        "pt-group",
                                        { name: "groupBy", $subview: X },
                                        "chart"
                                    ),
                                    this.GroupConfig(
                                        t("Filters"),
                                        "pt-filter",
                                        {
                                            name: "filters",
                                            $subview: new U(this.app, "", {
                                                field: "filters",
                                                plusLabel: t("Add filter"),
                                            }),
                                        }
                                    ),
                                    this.GroupConfig(
                                        t("Chart"),
                                        "pt-chart",
                                        { $subview: Y },
                                        "chart"
                                    ),
                                    this.GroupConfig(
                                        t("Table"),
                                        "wxi-columns",
                                        { $subview: q },
                                        "table"
                                    ),
                                    {},
                                ],
                            },
                        },
                    ],
                };
            }
            init() {
                this.on(this.State.$changes, "readonly", (t, e) => {
                    webix.isUndefined(e) || this.ToggleForm();
                });
            }
            ready() {
                this.on(this.app, "property:change", (t, e) => {
                    this.HandleFieldChange(t, e);
                }),
                    this.on(this.State.$changes, "structure", () => {
                        this.innerChange || this.SetValues();
                    }),
                    this.on(this.State.$changes, "mode", (t, e) => {
                        const i = "chart" == t;
                        this.$$("settings").showBatch(i ? "chart" : "table"),
                            e && (i || "chart" == e) && this.SetValues();
                    });
            }
            ToggleForm() {
                this.State.config = !this.State.config;
            }
            SetValues() {
                const t = this.State.structure;
                ["rows", "columns", "values", "filters", "groupBy"].forEach(
                    (e) => {
                        const i = t[e] || this.State[e];
                        if (i) {
                            this.getSubView(e).SetValue(i);
                        }
                    }
                );
            }
            HandleFieldChange(t, e) {
                const i = webix.copy(this.State.structure);
                "filters" == t
                    ? (e = this.CorrectFilters(i, e))
                    : this.CorrectInputs(i, t, e),
                    (i[t] = e),
                    (this.innerChange = !0),
                    this.app.setStructure(i),
                    delete this.innerChange;
            }
            GroupConfig(t, e, i, s) {
                return {
                    batch: s,
                    header: `\n\t\t\t\t<span class="webix_icon webix_pivot_config_icon ${e}"></span>\n\t\t\t\t<span class="webix_pivot_config_label">${t}</span>\n\t\t\t`,
                    body: i,
                    borderless: !0,
                };
            }
            GetCorrections() {
                return {
                    rows: ["columns", "values", "groupBy"],
                    columns: ["rows", "values"],
                    values: ["rows", "columns", "groupBy"],
                    groupBy: ["rows", "values"],
                };
            }
            CorrectFilters(t, e) {
                for (let i = 0; i < e.length; i++) {
                    const s = t.filters.find((t) => {
                        if (t.name == e[i]) return !0;
                    });
                    (e[i] = { name: e[i] }),
                        s && !s.external && (e[i].value = s.value);
                }
                const i = t.filters.filter((t) => t.external);
                return (e = e.concat(i));
            }
            CorrectInputs(t, e, i) {
                const s = this.GetCorrections()[e];
                s &&
                    ("string" == typeof i && (i = [i]),
                    (i = i.map((t) => (t.name ? t.name : t))),
                    s.forEach((e) => {
                        const s = this.getSubView(e);
                        let r = s.GetValue();
                        "string" == typeof r
                            ? i.find((t) => t == r) && (r = "")
                            : (r = r.filter(
                                  (t) => (
                                      t.name && (t = t.name), -1 == i.indexOf(t)
                                  )
                              )),
                            (t[e] = r),
                            s.SetValue(r);
                    }));
            }
        }),
        (Q["config/popup"] = class extends a {
            config() {
                return this.app
                    .getService("jet-win")
                    .updateConfig({
                        view: "window",
                        borderless: !0,
                        fullscreen: !0,
                        head: !1,
                        body: { $subview: !0 },
                    });
            }
        }),
        (Q["config/properties/chart"] = Y),
        (Q["config/properties/group"] = X),
        (Q["config/properties"] = U),
        (Q["config/properties/table"] = q),
        (Q["config/properties/values"] = W),
        (Q.filter = K),
        (Q.main = class extends a {
            config() {
                j ||
                    ((j = !0),
                    webix.protoUI(
                        {
                            name: "r-layout",
                            sizeTrigger(t, e, i) {
                                (this._compactValue = i),
                                    (this._compactHandler = e),
                                    (this._app = t);
                                const s = t.config;
                                (this._forceCompact = s.params.forceCompact),
                                    (this._compactWidth = s.compactWidth),
                                    this._forceCompact ||
                                        this._checkTrigger(this.$view.width, i);
                            },
                            _checkTrigger(t, e) {
                                return (
                                    !this._compactWidth ||
                                    !(
                                        (t <= this._compactWidth && !e) ||
                                        (t > this._compactWidth && e)
                                    ) ||
                                    ((this._compactWidth = null),
                                    this._compactHandler(!e),
                                    !1)
                                );
                            },
                            $setSize(t, e) {
                                (this._forceCompact ||
                                    this._checkTrigger(
                                        t,
                                        this._compactValue
                                    )) &&
                                    webix.ui.layout.prototype.$setSize.call(
                                        this,
                                        t,
                                        e
                                    ),
                                    this._app &&
                                        this._app.callEvent("view:resize", []);
                            },
                        },
                        webix.ui.layout
                    ));
                const t = this.getParam("forceCompact");
                webix.isUndefined(t) || this.setParam("compact", t),
                    (this.Compact = this.getParam("compact"));
                const e = [
                    Z,
                    {
                        view: "r-layout",
                        localId: "main",
                        cols: [{ $subview: !0 }],
                    },
                ];
                return (
                    this.Compact
                        ? e.push(J, { $subview: !0, name: "edit", popup: !0 })
                        : e[1].cols.push({
                              view: "proxy",
                              maxWidth: 450,
                              localId: "edit",
                              css: "webix_pivot_config_container webix_shadow_medium",
                              borderless: !0,
                              hidden: !0,
                              body: { $subview: !0, name: "edit" },
                          }),
                    {
                        margin: 0,
                        rows: e,
                        view: webix.isUndefined(t) ? "r-layout" : "layout",
                    }
                );
            }
            init() {
                const t = this.getParam("state");
                this.$$("main").sizeTrigger(
                    this.app,
                    (t) => this.SetCompactMode(t),
                    !!this.Compact
                ),
                    this.on(t.$changes, "mode", (t) => {
                        this.show("./" + ("chart" == t ? "chart" : "table"));
                    }),
                    this.on(t.$changes, "config", (t) => {
                        t ? this.ShowConfig() : this.HideConfig();
                    });
            }
            ShowConfig() {
                this.Compact
                    ? this.show("config.popup/config", { target: "edit" })
                    : (this.$$("edit").show(),
                      this.show("config", { target: "edit" }));
            }
            HideConfig() {
                this.show("_blank", { target: "edit" }),
                    this.Compact || this.$$("edit").hide();
            }
            SetCompactMode(t) {
                webix.delay(() => {
                    this.setParam("compact", t),
                        t || webix.fullscreen.exit(),
                        this.refresh();
                });
            }
        }),
        (Q.mode = J),
        (Q.table = class extends a {
            config() {
                this.Local = this.app.getService("local");
                const t = (this.State = this.getParam("state", !0)),
                    e = t.structure.rows.length,
                    i = {
                        view: "treetable",
                        $mainView: !0,
                        localId: "data",
                        css: "webix_data_border webix_header_border",
                        select: !0,
                        leftSplit: "table" == t.mode ? e : e ? 1 : 0,
                        resizeColumn: !0,
                        borderless: !0,
                        columns: [],
                        footer: t.datatable.footer,
                    };
                return webix.extend(i, t.datatable, !0), i;
            }
            init() {
                this.LoadData(),
                    this.on(this.State.$changes, "structure", (t, e) => {
                        e && this.UpdateStructure();
                    }),
                    this.on(this.State.$changes, "datatable", (t, e) => {
                        e && this.refresh();
                    }),
                    this.on(this.State.$changes, "mode", (t, e) => {
                        e && "chart" != e && this.refresh();
                    });
            }
            LoadData() {
                return this.Local.getData().then((t) => {
                    this.UpdateTable(t);
                });
            }
            UpdateStructure() {
                const t = this.Local.getPivotData();
                this.UpdateTable(t);
            }
            UpdateTable(t) {
                const e = this.$$("data");
                e.clearAll();
                const i = this.CheckFreeze();
                let s = 0,
                    r = 0;
                const n = t.totalColumn[0];
                if (n) {
                    const e = this.State.structure.values,
                        s = n.filter((t) => t || 0 === t).length;
                    i && (r = s);
                    for (let i = 0; i < n.length; i++)
                        if (n[i] || 0 === n[i]) {
                            let r = e[i].name;
                            webix.isArray(r) && (r = r.join()),
                                t.header.push({
                                    header: [
                                        { name: "total", colspan: s },
                                        {
                                            text: r || e[i].operation,
                                            operation: e[i].operation,
                                        },
                                    ],
                                    id: t.header.length + 1,
                                });
                        }
                    const o = { i: 0 };
                    t.data = t.data.map((e) =>
                        this._addTotal(e, t.totalColumn, o)
                    );
                }
                if (i) {
                    const t = "table" == this.State.mode,
                        e = this.State.structure.rows.length;
                    s = t ? e : e ? 1 : 0;
                }
                e.define({ leftSplit: s, rightSplit: r }, !0),
                    e.refreshColumns(
                        this.SetColumns(t.header, t.footer, t.marks)
                    ),
                    e.parse(t.data);
            }
            CheckFreeze() {
                const t = this.app.config.freezeColumns,
                    e = this.getParam("compact", !0);
                return webix.isUndefined(t) ? !e : t;
            }
            _addTotal(t, e, i) {
                if (t.data) t.data = t.data.map((t) => this._addTotal(t, e, i));
                else {
                    const s = t.id;
                    ((t = t.concat(e[i.i].filter((t) => t || 0 === t))).id = s),
                        i.i++;
                }
                return t;
            }
            SetColumns(t, e, i) {
                const s = this.app.getService("locale")._,
                    r = this.State.structure.rows.length,
                    n = "table" == this.State.mode ? r : r ? 1 : 0;
                for (let r = 0; r < t.length; r++)
                    if (r < n)
                        this.SetFirstColumn(
                            t[r],
                            !r && this.State.datatable.footer,
                            s
                        );
                    else {
                        (t[r].sort = "int"),
                            t[r].format || (t[r].format = this.CellFormat),
                            i &&
                                (t[r].cssFormat = (t, e, s, r) => {
                                    const n = i[s - 1],
                                        o = n ? n[r - 1] : null;
                                    return o ? o.join(" ") : "";
                                });
                        const n = t[r].header;
                        for (let t = 0; t < n.length; t++) {
                            let e = n[t];
                            e &&
                                (t || "total" != e.name
                                    ? t == n.length - 1 &&
                                      (e.text = this.HeaderTemplate(e, s))
                                    : (e.text = s("Total")));
                        }
                        e.length && (t[r].footer = this.CellFormat(e[r]));
                    }
                return t;
            }
            SetFirstColumn(t, e, i) {
                "tree" == this.State.mode
                    ? ((t.header = {
                          text: this.State.structure.rows
                              .map((t) => this.Local.getField(t).value)
                              .join(
                                  "<span class='webix_icon wxi-angle-right'></span>"
                              ),
                          css: "webix_pivot_tree_header",
                      }),
                      (t.width = 300),
                      (t.template = (t, e) => e.treetable(t, e) + t[1]))
                    : ((t.header = this.Local.getField(t.header[0].text).value),
                      (t.width = 200)),
                    e && (t.footer = i("Total"));
            }
            HeaderTemplate(t, e) {
                if (t.operation && "complex" != t.operation) {
                    let i = t.text.split(",");
                    return (
                        (i = i
                            .map((t) => this.Local.getField(t).value)
                            .join(", ")),
                        `${i} <span class="webix_pivot_operation">${e(
                            t.operation
                        )}</span>`
                    );
                }
                return this.Local.fixMath(t.text);
            }
            CellFormat(t) {
                return (
                    t || (t = 0 === t ? "0" : ""),
                    t ? parseFloat(t).toFixed(3) : t
                );
            }
        }),
        (Q.toolbar = Z);
    const tt = (t, e) => (t.key > e.key ? 1 : -1),
        et = (t, e) => (t.key < e.key ? 1 : -1);
    class it {
        constructor(t, e, i, s, r) {
            "desc" === r
                ? (this._sort = et)
                : "asc" === r
                ? (this._sort = tt)
                : r && (this._sort = (t, e) => r(t.key, e.key)),
                (this._label = i),
                (this._meta = s || null),
                (this._table = t),
                (this._getter = e),
                (this._prepared = 0);
        }
        getIndexes() {
            return this._indexes;
        }
        getValue(t) {
            return this._values[t].key;
        }
        getSize() {
            return this._values.length;
        }
        getLabel() {
            return this._label;
        }
        getOptions() {
            return this._prepareOptions(), this._values.map((t) => t.key);
        }
        getMeta() {
            return this._meta;
        }
        reset() {
            this._prepared = 0;
        }
        prepare() {
            if (1 & this._prepared) return;
            (this._prepared = 1 | this._prepared), this._prepareOptions();
            const { _table: t, _getter: e, _keys: i } = this,
                s = t.count();
            this._values.forEach((t, e) => (t.index = e));
            const r = (this._indexes = new Array(s));
            for (let t = 0; t < s; t++) {
                const s = e(t);
                r[t] = i.get(s).index;
            }
        }
        _prepareOptions() {
            if (2 & this._prepared) return;
            this._prepared = 2 | this._prepared;
            const { _table: t, _getter: e } = this,
                i = t.count(),
                s = (this._keys = new Map()),
                r = (this._values = []);
            for (let t = 0; t < i; t++) {
                const i = e(t);
                void 0 === s.get(i) &&
                    s.set(i, (r[r.length] = { key: i, index: 0 }));
            }
            this._sort && r.sort(this._sort);
        }
    }
    class st {
        constructor(t) {
            this._pivot = t;
        }
        toArray({ cleanRows: t, filters: e, ops: i }) {
            const s = [],
                r = this._pivot.getLimit().rows || 0;
            this._pivot.filter(e),
                this._pivot.operations(i),
                this._pivot.resetCursor();
            let n = 0;
            const o = new Set(),
                a = new Map(),
                l = [];
            for (;;) {
                const t = {},
                    e = this._pivot.next(o, s.length, a, t);
                if (!e) break;
                if ((s.push(e), l.push(t), n++, r === n)) break;
            }
            const [h, c] = this._pivot.getWidth();
            t && this._cleanRows(s, h);
            const u = {
                data: s,
                columns: Array.from(o).sort((t, e) => (t > e ? 1 : -1)),
                width: c + h,
                scaleWidth: h,
                rowData: l,
            };
            return (
                (u.columnData = this._pivot.aggregateColumns(u, a)),
                (u.marks = this._pivot.mark(u, a)),
                u
            );
        }
        toNested({ filters: t, ops: e }) {
            this._pivot.filter(t),
                this._pivot.operations(e),
                this._pivot.resetCursor();
            const i = new Map(),
                s = this._pivot.nested(i);
            return (
                (s.columnData = this._pivot.aggregateColumns(s, i)),
                (s.marks = this._pivot.mark(s, i)),
                s
            );
        }
        toXHeader(t, e) {
            return this._pivot.getXHeader(t, e);
        }
        _cleanRows(t, e) {
            const i = t.length,
                s = new Array(e);
            for (let r = 0; r < i; r++) {
                const i = t[r];
                for (let t = 0; t < e; t++) {
                    if (s[t] !== i[t]) {
                        for (let r = t; r < e; r++) s[r] = i[r];
                        break;
                    }
                    i[t] = "";
                }
            }
        }
    }
    function rt(t, e) {
        return new Function(
            e.propertyName,
            e.methodName,
            e.contextName,
            "return " +
                (function (t, e) {
                    let i = "";
                    const s = t.length;
                    let r = 0,
                        n = !1,
                        o = !1,
                        a = 0;
                    for (; r < s; ) {
                        const s = t[r];
                        if ((r++, '"' === s))
                            n ? (i += t.substr(a, r - a)) : (a = r - 1),
                                (n = !n);
                        else {
                            if (n) continue;
                            const l =
                                    "," === s ||
                                    "/" === s ||
                                    "*" === s ||
                                    "+" === s ||
                                    "-" === s ||
                                    "(" === s ||
                                    ")" === s,
                                h =
                                    " " === s ||
                                    "\t" === s ||
                                    " \n" === s ||
                                    "\r" === s;
                            if (o) {
                                if (!l && !h) continue;
                                {
                                    const n = t.substr(a, r - a - 1);
                                    (i +=
                                        "(" === s
                                            ? e.method(n)
                                            : e.property(n)),
                                        (o = !1);
                                }
                            }
                            if (h) continue;
                            l ||
                            "0" === s ||
                            "1" === s ||
                            "2" === s ||
                            "3" === s ||
                            "4" === s ||
                            "5" === s ||
                            "6" === s ||
                            "7" === s ||
                            "8" === s ||
                            "9" === s
                                ? (i += s)
                                : ((o = !0), (a = r - 1));
                        }
                    }
                    return o && (i += e.property(t.substr(a, r - a))), i;
                })(t, e)
        );
    }
    function nt(t, e, i, s) {
        const r = ct(t, i),
            n = {
                table: t,
                order: e,
                from: 0,
                to: 0,
                array: (t, e) => {
                    const i = e.to - e.from,
                        s = new Array(i),
                        r = ht[t];
                    for (let t = 0; t < i; t++) s[t] = r(e.order[t + e.from]);
                    return s;
                },
            };
        return function (t, e) {
            return (n.from = t), (n.to = e), r(0, s, n);
        };
    }
    function ot(t, e, i, s) {
        const r = ct(t, i),
            n = {
                table: t,
                order: e,
                range: [],
                array: (t, e) => {
                    const i = n.range.length,
                        s = [],
                        r = ht[t];
                    for (let t = 0; t < i; t += 2) {
                        const i = n.range[t],
                            o = n.range[t + 1];
                        for (let t = i; t < o; t++) s.push(r(e.order[t]));
                    }
                    return s;
                },
            };
        return function (t) {
            return (n.range = t), r(0, s, n);
        };
    }
    function at(t, e) {
        const i = rt(t, {
            propertyName: "d",
            methodName: "m",
            contextName: "c",
            property: () => "d",
            method: (t) => "m." + t.toLowerCase(),
        });
        return function (t) {
            return i(t, e, null);
        };
    }
    let lt = 0;
    const ht = [];
    function ct(t, e) {
        return rt(e, {
            propertyName: "d",
            methodName: "m",
            contextName: "c",
            property: (e) => {
                const i = lt;
                return (
                    (ht[i] = t.getColumn(e).getter),
                    (lt += 1),
                    `c.array("${i}", c)`
                );
            },
            method: (t) => "m." + t.toLowerCase(),
        });
    }
    const ut = (t, e) => (i) => t(i) && e(i);
    function pt(t, e, i, s) {
        const r = s.getter(t, e);
        if ("object" != typeof i) {
            const t = s.compare.eq(i);
            return (e) => t(r(e));
        }
        {
            const t = Object.keys(i);
            let e = null;
            for (let n = 0; n < t.length; n++) {
                const o = s.compare[t[n].toLowerCase()](i[t[n]]),
                    a = (t) => o(r(t));
                e = e ? ut(e, a) : a;
            }
            return e;
        }
    }
    function dt(t, e, i, s) {
        const r = (function (t, e, i) {
            const s = Object.keys(e);
            let r = null;
            for (let n = 0; n < s.length; n++) {
                const o = s[n],
                    a = pt(t, o, e[o], i);
                r = r ? ut(r, a) : a;
            }
            return r;
        })(e, i, s);
        return t.filter((t) => r(t));
    }
    class gt {
        constructor(t, e, i, s, r) {
            (this._rows = e),
                (this._cols = i),
                (this._dims = e.concat(i)),
                (this._table = t),
                (this._context = r),
                (this._cursor = -1),
                (this._order = this._base_order = this._sort()),
                (this._data = this._dims.map((t) => t.getIndexes())),
                this.filter(s, !0);
        }
        resetCursor() {
            (this._cursor = 0),
                (this._group = this._dims.map(() => null)),
                this._order.length &&
                    (this._rows.length && this._nextRow(),
                    this._cols.length && this._nextColumn());
        }
        next(t, e, i, s) {
            const {
                _cursor: r,
                _cols: n,
                _order: o,
                _group: a,
                _ops: l,
                _rows: h,
            } = this;
            if (this._cursor >= o.length) return null;
            const c = h.length,
                u = new Array(c + l.length * n.length);
            for (let t = 0; t < c; t++) u[t] = h[t].getValue(a[t]);
            const p = this._rows.length
                ? this._nextRow(n.length > 0)
                : o.length;
            return this._fillRow(u, e, r, p, c, t, i, s), (this._cursor = p), u;
        }
        nested(t) {
            const { _cols: e, _order: i, _rows: s } = this,
                r = new Set(),
                n = s.length,
                o = n > 0 ? 1 : 0,
                a = [{ data: [], values: [] }],
                l = [];
            let h = [],
                c = [],
                u = this._cursor,
                p = 0;
            const { _groupOps: d } = this,
                g = [{}].concat(s.map(() => ({}))),
                f = [],
                m = this._context.limit.rows,
                _ = Math.min(
                    this._context.limit.columns,
                    (e.length ? this._sizes[0] * e[0].getSize() : 0) + o
                ),
                w = function (e) {
                    if (a[e])
                        for (; e < n; e++)
                            for (const [i, s] of t) {
                                const t = g[e][i] || 0;
                                if (0 === t || s.length > t)
                                    for (let r = 0; r < d.length; r++) {
                                        const n = d[r];
                                        n &&
                                            ((a[e].values[o + i + r] = n(
                                                s.slice(t + 1)
                                            )),
                                            (g[e][i] = s.length - 1));
                                    }
                            }
                };
            for (; this._cursor < i.length; ) {
                const g = new Array(_);
                (h = c), (c = [].concat(this._group));
                const b = this._rows.length
                    ? this._nextRow(e.length > 0)
                    : i.length;
                if (null !== d)
                    for (let t = 0; t < n; t++)
                        if (c[t] != h[t]) {
                            w(t + 1);
                            break;
                        }
                const v = {};
                if (
                    (this._fillRow(g, l.length, u, b, o, r, t, v),
                    f.push(v),
                    n > 0)
                ) {
                    for (let t = 0; t < n; t++)
                        if (c[t] != h[t]) {
                            for (let e = t; e < n; e++) {
                                const t = e + 1,
                                    i = t === n,
                                    r = (a[t] = {
                                        id: i ? l.length + 1 : 0,
                                        data: i ? null : [],
                                        values: i ? g : [s[e].getValue(c[e])],
                                    });
                                a[e].data.push(r);
                            }
                            break;
                        }
                    (g[0] = s[n - 1].getValue(c[n - 1])), (a[n].values = g);
                } else a[0].data.push({ data: null, values: g });
                if ((l.push(g), p++, p >= m)) break;
                this._cursor = u = b;
            }
            null !== d && w(1);
            const b = Array.from(r).sort((t, e) => (t > e ? 1 : -1)),
                v = {
                    tree: a[0].data,
                    data: l,
                    width: _,
                    scaleWidth: o,
                    columns: b,
                    rowData: f,
                };
            return this._fillGroupRow(a[0], v, t, s.length - 1), v;
        }
        getLimit() {
            return this._context.limit;
        }
        getWidth() {
            return [
                this._rows.length,
                this._cols.length && this._ops.length
                    ? this._cols[0].getSize() * this._sizes[0]
                    : 0,
                this._ops.length,
            ];
        }
        getXHeader(t, e) {
            const { _cols: i, _rows: s, _ops: r, _opInfo: n } = this,
                { nonEmpty: o, meta: a } = e || {},
                l = t.tree,
                h = [],
                c = t.tree ? Math.min(s.length, 1) : s.length,
                u = r.length,
                p = i.map((t) => t.getSize()),
                d = p.reduce((t, e) => t * e, u),
                g = t.columns,
                f =
                    c +
                    Math.min(o ? g.length * u : d, this._context.limit.columns);
            let m = d;
            const _ = p.map((t) => (m /= t)),
                w = [];
            if ((this._cols.forEach(() => w.push(new Array(f))), o)) {
                for (let t = 0; t < c; t++) h.push(t);
                for (let t = 0; t < g.length; t++) {
                    const e = c + g[t];
                    for (let t = 0; t < u; t++) h.push(e + t);
                }
                for (let t = 0; t < i.length; t++) {
                    const e = _[t];
                    let s,
                        r = -1,
                        n = 0,
                        o = 0;
                    for (let a = c; a < h.length; a += u) {
                        const l = h[a];
                        if (l < n) o += u;
                        else {
                            0 !== o && (w[t][r] = { colspan: o, text: s });
                            const h = Math.floor((l - c) / e);
                            (r = a),
                                (n = (h + 1) * e + c),
                                (o = u),
                                (s = i[t].getValue(h % p[t]));
                        }
                    }
                    0 !== o && (w[t][r] = { colspan: o, text: s });
                }
            } else
                for (let t = 0; t < i.length; t++) {
                    const e = p[t],
                        s = _[t];
                    let r = 0;
                    for (let n = c; n < f; n += s)
                        (w[t][n] =
                            1 === s
                                ? i[t].getValue(r++)
                                : { text: i[t].getValue(r++), colspan: s }),
                            r >= e && (r = 0);
                }
            if (this._ops) {
                const t = new Array(f),
                    e = r.length;
                for (let i = c; i < f; i += e)
                    for (let s = 0; s < e; s++) t[i + s] = n[s].label;
                w.push(t);
            }
            for (let t = 0; t < c; t++) {
                const e = i.length + (this._ops ? 1 : 0);
                if (l) {
                    w[0][0] = { text: "", rowspan: e };
                    break;
                }
                const r = s[t].getLabel();
                w[0][t] = e > 1 ? { text: r, rowspan: e } : r;
            }
            const b = { data: w };
            if ((o && (b.nonEmpty = h), a)) {
                const t = new Array(f);
                for (let e = 0; e < c; e++) t[e] = s[e].getMeta();
                const e = r.length;
                for (let i = c; i < f; i += e)
                    for (let s = 0; s < e; s++) t[i + s] = n[s].meta;
                b.meta = t;
            }
            return b;
        }
        filter(t, e) {
            if (!t || 0 === Object.keys(t).length) {
                if (e || !this._masterRules)
                    return void (this._order = this._base_order);
                t = Object.assign(Object.assign({}, this._masterRules), t);
            }
            e && (this._masterRules = t),
                (this._order = dt(
                    this._base_order,
                    this._table,
                    t,
                    this._context
                ));
        }
        operations(t) {
            const { _table: e, _order: i, _context: s } = this;
            (t = t || []),
                (this._ops = t.map((t) =>
                    nt(e, i, "string" == typeof t ? t : t.math, s.math)
                )),
                (this._groupResultOps = t.map((t) =>
                    "result" === t.branchMode
                        ? at(
                              "string" == typeof t ? t : t.branchMath || t.math,
                              s.math
                          )
                        : null
                )),
                this._groupResultOps.find((t) => null !== t) ||
                    (this._groupResultOps = null),
                (this._groupOps = t.map((t) =>
                    "raw" === t.branchMode
                        ? ot(
                              e,
                              i,
                              "string" == typeof t ? t : t.branchMath || t.math,
                              s.math
                          )
                        : null
                )),
                this._groupOps.find((t) => null !== t) ||
                    (this._groupOps = null),
                (this._opInfo = t.map((t) =>
                    "string" == typeof t
                        ? { label: t, math: t }
                        : Object.assign(Object.assign({}, t), {
                              label: t.label || t.math,
                          })
                )),
                (this._rowResultOps = ft(t, "row", "result", (t, e) => ({
                    name: e,
                    op: at(t, s.math),
                }))),
                (this._rowOps = ft(t, "row", "raw", (t, r) => ({
                    name: r,
                    op: nt(e, i, t, s.math),
                }))),
                (this._colResultOps = ft(t, "column", "result", (t, e) => ({
                    name: e,
                    op: at(t, s.math),
                }))),
                (this._colOps = ft(t, "column", "raw", (t, r) => ({
                    name: r,
                    op: ot(e, i, t, s.math),
                }))),
                (this._marks = t.map((t) => t.marks || null)),
                this._marks.find((t) => null !== t) || (this._marks = null),
                this._setSizes();
        }
        aggregateColumns(t, e) {
            const { _colOps: i, _colResultOps: s } = this,
                { columns: r, data: n, scaleWidth: o } = t;
            if (!i && !s) return [];
            const a = this._ops.length,
                l = [];
            for (let t = 0; t < r.length; t++) {
                const h = r[t],
                    c = e.get(h);
                if (!c) continue;
                const u = Array.from(c[0].keys());
                for (let t = 0; t < a; t++) {
                    const e = {};
                    if (s) {
                        const i = s[t];
                        if (i) {
                            const s = u.map((e) => n[e][h + t + o]);
                            i.forEach((t) => (e[t.name] = t.op(s)));
                        }
                    }
                    if (i) {
                        const s = i[t];
                        s && s.forEach((t) => (e[t.name] = t.op(c.slice(1))));
                    }
                    l[o + h + t] = e;
                }
            }
            return l;
        }
        _optimizeGroup(t) {
            const e = {};
            let i = !0;
            for (const s in t) {
                const r = t[s];
                (e[s] = at(r, this._context.math)), (i = !1);
            }
            return i ? null : e;
        }
        mark(t, e) {
            const i = [],
                { _marks: s, _ops: r } = this;
            if (!s) return i;
            const n = r.length,
                { scaleWidth: o, data: a, columnData: l, rowData: h } = t;
            for (const [t, s] of e) {
                const e = s[0];
                for (let s = 0; s < n; s++) {
                    const r = this._marks[s];
                    if (null !== r)
                        for (const n of e) {
                            const e = t + s + o,
                                c = n,
                                u = [];
                            for (let t = 0; t < r.length; t++)
                                r[t].check(a[c][e], l[e] || {}, h[c] || {}) &&
                                    u.push(r[t].name);
                            if (u.length) {
                                let t = i[c];
                                void 0 === t && (t = i[c] = []), (t[e] = u);
                            }
                        }
                }
            }
            return i;
        }
        __getHeaderStub() {
            return {};
        }
        _fillGroupRow(t, e, i, s) {
            const { _groupResultOps: r } = this,
                { columns: n, scaleWidth: o } = e;
            if (r)
                for (let e = 0; e < n.length; e++) {
                    const i = n[e];
                    for (let e = 0; e < r.length; e++) {
                        const n = r[e];
                        n &&
                            s > 0 &&
                            this._fillGroupRowInner(t, n, i + e + o, s);
                    }
                }
        }
        _fillGroupRowInner(t, e, i, s) {
            const r = [];
            if (s > 0)
                t.data.forEach((t) => {
                    const n = this._fillGroupRowInner(t, e, i, s - 1);
                    null !== n && r.push(n);
                });
            else
                for (let e = 0; e < t.data.length; e++) {
                    const s = t.data[e].values[i];
                    void 0 !== s && r.push(s);
                }
            return r.length ? (t.values[i] = e(r)) : null;
        }
        _fillRow(t, e, i, s, r, n, o, a) {
            const {
                    _cols: l,
                    _group: h,
                    _ops: c,
                    _sizes: u,
                    _rows: p,
                    _rowResultOps: d,
                    _rowOps: g,
                } = this,
                f = p.length,
                m =
                    null !== this._colResultOps ||
                    null !== this._colOps ||
                    null !== this._marks;
            let _ = [];
            if ((null !== d && (_ = d.map(() => [])), c.length))
                if (l.length) {
                    let a = i;
                    for (; a < s; ) {
                        let i = 0;
                        for (let t = 0; t < l.length; t++) i += u[t] * h[f + t];
                        const s = this._nextColumn();
                        for (let e = 0; e < c.length; e++) {
                            const n = (t[i + r + e] = c[e](a, s));
                            null !== d && _[e].push(n);
                        }
                        if (m) {
                            let t = o.get(i);
                            t
                                ? t.push(a, s)
                                : o.set(i, (t = [new Set(), a, s])),
                                t[0].add(e);
                        }
                        n.add(i), (this._cursor = a = s);
                    }
                } else {
                    for (let e = 0; e < c.length; e++) t[e + r] = c[e](i, s);
                    if (m) {
                        let t = o.get(0);
                        t ? t.push(i, s) : o.set(0, (t = [new Set(), i, s])),
                            t[0].add(e);
                    }
                    n.add(0);
                }
            null !== d &&
                d.forEach((t, e) => {
                    const i = _[e];
                    t &&
                        i.length &&
                        t.forEach((t) => {
                            a[t.name] = t.op(_[e]);
                        });
                }),
                null !== g &&
                    g.forEach((t) => {
                        null == t ||
                            t.forEach((t) => {
                                a[t.name] = t.op(i, s);
                            });
                    });
        }
        _sort() {
            const { _table: t, _dims: e } = this,
                i = Math.min(t.count(), this._context.limit.raws),
                s = new Array(i);
            for (let t = 0; t < i; t++) s[t] = t;
            const r = e.length,
                n = e.map((t) => t.getIndexes());
            return (
                s.sort((t, e) => {
                    for (let i = 0; i < r; i++) {
                        const s = n[i][t],
                            r = n[i][e];
                        if (s > r) return 1;
                        if (s < r) return -1;
                    }
                    return 0;
                }),
                s
            );
        }
        _nextRow(t) {
            const { _data: e, _order: i, _group: s, _rows: r } = this,
                n = r.length;
            let o = !0,
                a = this._cursor;
            for (;;) {
                const r = i[a];
                for (let i = 0; i < n; i++)
                    e[i][r] != s[i] && (t || (s[i] = e[i][r]), (o = !1));
                if (!o) break;
                a++;
            }
            return a;
        }
        _nextColumn() {
            const { _data: t, _order: e, _group: i, _rows: s, _cols: r } = this,
                n = r.length + s.length;
            let o = !0,
                a = this._cursor;
            for (;;) {
                const s = e[a];
                for (let e = 0; e < n; e++)
                    t[e][s] != i[e] && ((i[e] = t[e][s]), (o = !1));
                if (!o) break;
                a++;
            }
            return a;
        }
        _setSizes() {
            const t = this._cols.map((t) => t.getSize());
            let e = this._ops.length || 1;
            for (let i = t.length - 1; i >= 0; i--) {
                const s = e;
                (e *= t[i]), (t[i] = s);
            }
            this._sizes = t;
        }
    }
    function ft(t, e, i, s) {
        const r = t.map((t) => {
            const r = t[e];
            if (!r) return null;
            const n = r
                .map((t) =>
                    (t.source || "raw") === i
                        ? "string" == typeof t
                            ? s(t, mt(t))
                            : s(t.math, t.as || mt(t.math))
                        : null
                )
                .filter((t) => null !== t);
            return n.length ? n : null;
        });
        return r.find((t) => !!t) ? r : null;
    }
    function mt(t) {
        const e = t.indexOf("(");
        return -1 === e ? t.trim() : t.substring(0, e).trim();
    }
    class _t {
        constructor(t) {
            (this._columns = t.fields), this.parse(t.data);
        }
        parse(t) {
            (this._raw = t), this._parse_inner();
        }
        prepare() {
            if (this._prepared) return;
            this._prepared = !0;
            const t = this._raw,
                e = this._columns.filter((t) => 3 === t.type);
            if (!t || !e.length) return;
            const i = t.length,
                s = e.length;
            for (let t = 0; t < i; t++)
                for (let i = 0; i < s; i++) {
                    const s = e[i],
                        r = s.getter(t);
                    "string" == typeof r && s.setter(t, new Date(r));
                }
        }
        _parse_inner() {
            this._columns.forEach((t) => {
                const e = t.id;
                (t.getter = (t) => this._raw[t][e]),
                    (t.setter = (t, i) => (this._raw[t][e] = i));
            });
        }
        getColumn(t) {
            return this._columns.find((e) => e.id === t);
        }
        count() {
            return this._raw.length;
        }
    }
    class wt extends _t {
        parse(t) {
            this._parse_init(t.length);
            const e = t.length,
                i = this._columns.length;
            for (let s = 0; s < e; s++) {
                const e = t[s];
                for (let t = 0; t < i; t++) {
                    const i = this._columns[t];
                    i.data[s] = e[i.id];
                }
            }
        }
        _parse_init(t) {
            this._columns.forEach((e) => {
                const i = (e.data = new Array(t));
                (e.getter = (t) => i[t]), (e.setter = (t, e) => (i[t] = e));
            });
        }
        count() {
            return this._columns[0].data.length;
        }
    }
    const bt = {
            round: (t) => Math.round(t),
            sum: (t) => t.reduce((t, e) => t + e, 0),
            min: (t) =>
                t.reduce((t, e) => (e < t ? e : t), t.length ? t[0] : 0),
            max: (t) =>
                t.reduce((t, e) => (e > t ? e : t), t.length ? t[0] : 0),
            avg: (t) =>
                t.length ? t.reduce((t, e) => t + e, 0) / t.length : 0,
            wavg: (t, e) => {
                if (!t.length) return 0;
                let i = 0,
                    s = 0;
                for (let r = t.length - 1; r >= 0; r--)
                    (i += e[r]), (s += t[r] * e[r]);
                return s / i;
            },
            count: (t) => t.length,
            any: (t) => (t.length ? t[0] : null),
        },
        vt = {
            eq: (t) => (e) => e == t,
            neq: (t) => (e) => e != t,
            gt: (t) => (e) => e > t,
            gte: (t) => (e) => e >= t,
            lt: (t) => (e) => e < t,
            lte: (t) => (e) => e <= t,
            in: (t) => (e) => t[e],
            hasPrefix: (t) => (e) => 0 === e.indexOf(t),
            contains: (t) => (e) => -1 !== e.indexOf(t),
        },
        xt = {
            year: (t) => t.getFullYear(),
            month: (t) => t.getMonth(),
            day: (t) => t.getDay(),
            hour: (t) => t.getHours(),
            minute: (t) => t.getMinutes(),
        };
    class yt {
        constructor(t) {
            (this._tables = {}),
                (this._dimensions = {}),
                (this._preds = Object.assign({}, xt)),
                (this._maths = Object.assign({}, bt)),
                (this._comps = Object.assign({}, vt)),
                t && t.tables && t.tables.forEach((t) => this.addTable(t)),
                t &&
                    t.dimensions &&
                    t.dimensions.forEach((t) => this.addDimension(t));
        }
        addPredicate(t, e) {
            this._preds[t.toLowerCase()] = e;
        }
        addMath(t, e) {
            this._maths[t.toLowerCase()] = e;
        }
        addComparator(t, e) {
            this._comps[t.toLowerCase()] = e;
        }
        getDimension(t) {
            return this._dimensions[t];
        }
        addDimension(t) {
            if (this._dimensions[t.id]) return;
            const e = this._tables[t.table],
                i = this._predicateGetter(e, t.rule.by);
            this._dimensions[t.id] = new it(
                e,
                i,
                t.label || t.id,
                t.meta || t,
                t.sort
            );
        }
        resetDimensions(t, e) {
            const i = this._dimensions;
            (this._dimensions = {}),
                t &&
                    t.forEach((t) => {
                        const s = i[t.id];
                        e && s
                            ? (this._dimensions[t.id] = s)
                            : this.addDimension(t);
                    });
        }
        addTable(t) {
            const e = "raw" === (t.driver || "raw") ? _t : wt,
                i = (this._tables[t.id] = new e(t));
            t.prepare && i.prepare();
        }
        getTable(t) {
            return this._tables[t];
        }
        compact(t, e) {
            const { rows: i, cols: s, filters: r, limit: n } = e,
                o = this._tables[t],
                a = i ? i.map((t) => this._dimensions[t]) : [],
                l = s ? s.map((t) => this._dimensions[t]) : [];
            [...a, ...l].forEach((t) => t.prepare());
            const h = new gt(o, a, l, r, {
                getter: this._predicateGetter.bind(this),
                math: this._maths,
                compare: this._comps,
                limit: Object.assign(
                    { rows: 1e4, columns: 5e3, raws: 1 / 0 },
                    n || {}
                ),
            });
            return new st(h);
        }
        _predicateGetter(t, e) {
            const i = e.indexOf("(");
            if (-1 !== i) {
                const s = this._preds[e.substr(0, i).toLowerCase()];
                e = e.substr(i + 1, e.length - i - 2);
                const r = t.getColumn(e).getter;
                return (t) => s(r(t));
            }
            return t.getColumn(e).getter;
        }
    }
    class St {
        constructor(t) {
            (this._app = t),
                (this._store = {}),
                (this._data = []),
                (this._filtersHash = {}),
                (this._state = t.getState()),
                this._initRengine();
        }
        _setOperations() {
            this.operations = [
                { id: "sum" },
                { id: "min" },
                { id: "max" },
                { id: "avg" },
                { id: "wavg" },
                { id: "count" },
                { id: "any" },
                { id: "complex" },
            ];
            const t = this._app.config.operations;
            if (t)
                for (let e in t)
                    this._reng.addMath(e, t[e]),
                        this.operations.push({ id: e });
        }
        _setFilters() {
            for (let t in webix.filters)
                this._reng.addComparator(
                    t,
                    (e) => (i) => (
                        "date" == t && (i = i.valueOf()),
                        !e ||
                            (e.includes
                                ? -1 != e.includes.indexOf(i)
                                : !e.condition.filter ||
                                  webix.filters[t][e.condition.type](
                                      i,
                                      e.condition.filter
                                  ))
                    )
                );
        }
        _setPredicates() {
            const t = this._app.config.predicates;
            if (t) for (let e in t) this._reng.addPredicate(e, t[e]);
        }
        getFields(t) {
            let e = this._app.config.fields;
            if (!e) {
                e = [];
                for (let i in t) {
                    let s;
                    const r = typeof t[i];
                    switch (r) {
                        case "string":
                            s = "text";
                            break;
                        case "number":
                            s = r;
                            break;
                        default:
                            s = "date";
                    }
                    e.push({ id: i, value: i, type: s });
                }
            }
            return e;
        }
        getData(t) {
            return !Object.keys(this._store).length || t
                ? this._app
                      .getService("backend")
                      .data()
                      .then(
                          (t) => (
                              (this._filtersHash = {}),
                              (this._table = this.getTable(t)),
                              this._reng.addTable(this._table),
                              (this._store = this.getPivotData()),
                              this._store
                          )
                      )
                : ((this._store = this.getPivotData()),
                  webix.promise.resolve(this._store));
        }
        _initRengine() {
            (this._reng = new yt()),
                this._setFilters(),
                this._setOperations(),
                this._setPredicates();
        }
        getPivotData() {
            if (!this._table)
                return { data: [], header: [], total: [], marks: [] };
            const t = this._state.mode,
                e = this._state.datatable;
            this.setDimensions();
            const i = {};
            for (let t = 0; t < this._state.structure.filters.length; t++) {
                const e = this._state.structure.filters[t],
                    s = this._state.fields.find((t) => t.id == e.name);
                i[e.name] = { [s.type]: e.value };
            }
            const s = this._reng.compact(this._table.id, {
                    rows: this.getRows(),
                    cols: this.getColumns(),
                    limit: this.getLimits(),
                }),
                r = this._state.structure.values;
            let n,
                o,
                a = [];
            for (let i = 0; i < r.length; i++) {
                const s = r[i].format,
                    n = r[i].operation,
                    o = r[i].color,
                    l = "complex" == n;
                let h = l ? r[i].math : r[i].name;
                h = webix.isArray(h) ? h.join(",") : h;
                const c = l ? h : `${n}(${h})`,
                    u = {
                        math: c,
                        branchMode: h ? "result" : "raw",
                        label: h,
                        meta: { operation: n, format: s, color: o },
                        column: [],
                        row: [],
                        marks: [],
                    };
                "chart" != t &&
                    (e.footer &&
                        (("sumOnly" == e.footer && "sum" == n) ||
                            "sumOnly" != e.footer) &&
                        u.column.push({ math: c, as: "value" }),
                    e.totalColumn &&
                        (("sumOnly" == e.totalColumn && "sum" == n) ||
                            "sumOnly" != e.totalColumn) &&
                        u.row.push({ math: c, as: "" + i }),
                    e.minY &&
                        (u.column.push({
                            as: "minY",
                            math: "min(group)",
                            source: "result",
                        }),
                        u.marks.push({
                            name: "webix_min_y",
                            check: (t, e) => t == e.minY,
                        })),
                    e.maxY &&
                        (u.column.push({
                            as: "maxY",
                            math: "max(group)",
                            source: "result",
                        }),
                        u.marks.push({
                            name: "webix_max_y",
                            check: (t, e) => t == e.maxY,
                        })),
                    e.minX &&
                        (u.row.push({
                            as: "minX" + c,
                            math: "min(group)",
                            source: "result",
                        }),
                        u.marks.push({
                            name: "webix_min_x",
                            check: (t, e, i) => t == i["minX" + c],
                        })),
                    e.maxX &&
                        (u.row.push({
                            as: "maxX" + c,
                            math: "max(group)",
                            source: "result",
                        }),
                        u.marks.push({
                            name: "webix_max_x",
                            check: (t, e, i) => t == i["maxX" + c],
                        }))),
                    a.push(u);
            }
            try {
                if ("table" == t)
                    (n = s.toArray({
                        filters: i,
                        ops: a,
                        cleanRows: e.cleanRows,
                    })),
                        (o = this.getHeader(s, n)),
                        (n.data = n.data.map(
                            (t, e) => (t.unshift(e + 1), (t.id = e + 1), t)
                        ));
                else {
                    if (((n = s.toNested({ filters: i, ops: a })), "tree" != t))
                        return this.getChartData(s, n, a);
                    (o = this.getHeader(s, n)),
                        (n.tree = n.tree.map((t) => this._toTree(t)));
                }
            } catch (t) {
                return this.loadError();
            }
            let l = [];
            return (
                "chart" != t &&
                    e.totalColumn &&
                    (l = n.rowData.map((t) => {
                        const e = [];
                        for (let i in t)
                            -1 == i.indexOf("minX") &&
                                -1 == i.indexOf("maxX") &&
                                (e[i] = t[i]);
                        return e;
                    })),
                {
                    data: n.tree ? n.tree : n.data,
                    header: o,
                    marks: n.marks,
                    footer: n.columnData.map((t) => t.value),
                    totalColumn: l,
                }
            );
        }
        loadError() {
            return (
                webix.message({
                    text: this._app
                        .getService("locale")
                        ._("Incorrect formula in values"),
                    type: "error",
                }),
                {
                    data: [],
                    values: [],
                    header: [],
                    marks: [],
                    footer: [],
                    totalColumn: [],
                }
            );
        }
        _toTree(t) {
            const e = t.values;
            return (
                e.unshift(""),
                t.data
                    ? ((e.open = !0),
                      (e.data = t.data.map((t) => this._toTree(t))))
                    : (e.id = t.id),
                e
            );
        }
        getTable(t) {
            const e = this.getFields(t[0]);
            (this._state.fields = e), (this._data = t = this.prepareData(t, e));
            return {
                id: "webixpivot" + webix.uid(),
                prepare: !0,
                driver: "raw",
                fields: webix.copy(e),
                data: t,
            };
        }
        prepareData(t, e) {
            return (
                (e = e.filter((t) => t.prepare || "date" == t.type)).length &&
                    (t = t.map(
                        (t) => (
                            e.forEach((e) => {
                                t[e.id] = e.prepare
                                    ? e.prepare(t[e.id])
                                    : new Date(t[e.id]);
                            }),
                            t
                        )
                    )),
                t
            );
        }
        collectFieldValues(t) {
            if (this._filtersHash[t]) return this._filtersHash[t];
            const e = this.getField(t),
                i = {},
                s = [];
            for (let r = 0; r < this._data.length; r++) {
                let n = this._data[r][t];
                (n || 0 === n) &&
                    ("date" == e.type && (n = n.valueOf()),
                    i[n] || ((i[n] = !0), s.push({ value: n, id: n })));
            }
            return (this._filtersHash[t] = s), s;
        }
        fixMath(t) {
            const e = this._app.getService("locale")._,
                i = this._state.fields,
                s = new RegExp(
                    i.map((t) => "\\b" + t.id + "\\b(?!\\()").join("|"),
                    "g"
                ),
                r = this.operations,
                n = new RegExp(
                    r.map((t) => "\\b" + t.id + "\\b\\(").join("|"),
                    "g"
                );
            return t
                .replaceAll(s, (t) => i.find((e) => e.id == t).value)
                .replaceAll(n, (t) => e(t.substring(0, t.length - 1)) + "(");
        }
        getField(t) {
            return this._state.fields.find((e) => e.id == t);
        }
        getColumns() {
            const t = this._state.structure;
            return "chart" == this._state.mode && t.groupBy
                ? [t.groupBy]
                : t.columns;
        }
        getRows() {
            return "chart" != this._state.mode
                ? this._state.structure.rows
                : [];
        }
        getLimits() {
            return {};
        }
        getHeader(t, e) {
            const i = t.toXHeader(e, { meta: !0, nonEmpty: !0 }),
                s = i.data,
                r = [];
            return (
                i.nonEmpty.forEach((t) => {
                    r.push({
                        id: t + 1,
                        header: s.map((e) => {
                            e =
                                e[t] && !webix.isUndefined(e[t].text)
                                    ? e[t]
                                    : { text: e[t] || "" };
                            const s = i.meta[t] && i.meta[t].operation;
                            return s && (e.operation = s), e;
                        }),
                        format: i.meta[t] && i.meta[t].format,
                    });
                }),
                r
            );
        }
        setDimensions() {
            this._reng.resetDimensions();
            const t = this.getColumns().concat(this.getRows() || []);
            for (let e = 0; e < t.length; e++) {
                const i = this.getField(t[e]);
                this._reng.addDimension({
                    id: t[e],
                    table: this._table.id,
                    label: t[e],
                    rule: {
                        by: i.predicate ? `${i.predicate}(${t[e]})` : t[e],
                    },
                });
            }
        }
        getChartData(t, e, i) {
            const s = [],
                r = [];
            if (e.data.length) {
                const r = webix.copy(e.data[0]),
                    n = this._state.structure.groupBy
                        ? t.toXHeader(e).data[0]
                        : r.map(() => "");
                let o = 0;
                for (; r.length; ) {
                    const t = r.splice(0, i.length);
                    if (!t.length) break;
                    t.push(n[o].text || n[o]), s.push(t), (o += i.length);
                }
            }
            for (let t = 0; t < i.length; t++)
                r.push({
                    text: i[t].label || i[t].meta.operation,
                    operation: i[t].meta.operation,
                    color: i[t].meta.color,
                });
            return { data: s, values: r };
        }
        getPalette() {
            return [
                [
                    "#e33fc7",
                    "#a244ea",
                    "#476cee",
                    "#36abee",
                    "#58dccd",
                    "#a7ee70",
                ],
                [
                    "#d3ee36",
                    "#eed236",
                    "#ee9336",
                    "#ee4339",
                    "#595959",
                    "#b85981",
                ],
                [
                    "#c670b8",
                    "#9984ce",
                    "#b9b9e2",
                    "#b0cdfa",
                    "#a0e4eb",
                    "#7faf1b",
                ],
                [
                    "#b4d9a4",
                    "#f2f79a",
                    "#ffaa7d",
                    "#d6806f",
                    "#939393",
                    "#d9b0d1",
                ],
                [
                    "#780e3b",
                    "#684da9",
                    "#242464",
                    "#205793",
                    "#5199a4",
                    "#065c27",
                ],
                [
                    "#54b15a",
                    "#ecf125",
                    "#c65000",
                    "#990001",
                    "#363636",
                    "#800f3e",
                ],
            ];
        }
        getValueColor(t) {
            const e = this.getPalette();
            let i = t / e[0].length;
            i = i > e.length ? 0 : parseInt(i, 10);
            const s = t % e[0].length;
            return e[i][s];
        }
        clearAll() {
            (this._app.config.fields = null),
                (this._state.fields = []),
                this._app.setStructure({}),
                delete this._table,
                (this._store = this.getPivotData()),
                (this._data = []),
                (this._filtersHash = {});
        }
    }
    class $t {
        constructor(t, e) {
            (this.app = t), (this._url = e);
        }
        url(t) {
            return this._url + (t || "");
        }
        data() {
            return webix.ajax(this.url()).then((t) => t.json());
        }
    }
    class Ct extends f {
        constructor(t) {
            const e = t.mode || "tree";
            let i = t.structure || {};
            const s = t.chart || {};
            webix.extend(s, { type: "bar", scale: "linear", lines: !0 }),
                delete s.id;
            const r = t.datatable || {};
            delete r.id;
            const n = T({
                    mode: e,
                    structure: i,
                    readonly: t.readonly || !1,
                    fields: t.fields || [],
                    datatable: r,
                    chart: s,
                    config: !1,
                }),
                o = {
                    router: m,
                    version: "9.3.1",
                    debug: !0,
                    compactWidth: 720,
                    start: "main/" + ("chart" == e ? "chart" : "table"),
                    params: { state: n, forceCompact: t.compact },
                };
            super(Object.assign(Object.assign({}, o), t)),
                this.setService(
                    "backend",
                    new (this.dynamic($t))(this, this.config.url)
                ),
                this.setService("local", new (this.dynamic(St))(this, t)),
                (function (t) {
                    let e;
                    const i = {
                        updateConfig(i) {
                            const s = t.getRoot(),
                                r = s.$view;
                            e
                                ? e && !r.id && (r.id = e)
                                : (r.id
                                      ? (e = r.id)
                                      : (r.id = e = "webix_" + webix.uid()),
                                  webix.html.addStyle(
                                      ".webix_win_inside *:not(.webix_modal_box):not(.webix_modal_cover){ z-index: 0; }"
                                  ),
                                  webix.html.addStyle(
                                      `#${e}{ position: relative; }`
                                  ),
                                  webix.html.addStyle(
                                      `#${e} .webix_window{ z-index:2 !important; }`
                                  ),
                                  webix.html.addStyle(
                                      `#${e} .webix_disabled{ z-index:1 !important; }`
                                  )),
                                (i.container = e),
                                i.fullscreen &&
                                    ((i._fillApp = !0), delete i.fullscreen),
                                i.on || (i.on = {});
                            let n = !0;
                            const o = i.on.onShow;
                            return (
                                (i.on.onShow = function () {
                                    o && o.apply(this, arguments),
                                        n &&
                                            ((this.$setSize = (t, e) => {
                                                I(this, s, !0),
                                                    webix.ui.window.prototype.$setSize.apply(
                                                        this,
                                                        [t, e]
                                                    );
                                            }),
                                            M(this, t),
                                            (n = null)),
                                        webix.callEvent("onClick", []),
                                        webix.html.addCss(
                                            r,
                                            "webix_win_inside"
                                        ),
                                        s.disable(),
                                        I(this, s);
                                }),
                                i
                            );
                        },
                    };
                    t.setService("jet-win", i);
                })(this),
                (i = this.prepareStructure(i, !0)),
                this.use(
                    L,
                    this.config.locale || { lang: "en", webix: { en: "en-US" } }
                );
        }
        dynamic(t) {
            return (this.config.override && this.config.override.get(t)) || t;
        }
        require(t, e) {
            return "jet-views" === t
                ? Q[e]
                : "jet-locales" === t
                ? Vt[e]
                : null;
        }
        getState() {
            return this.config.params.state;
        }
        setStructure(t) {
            this.getState().structure = this.prepareStructure(t);
        }
        getStructure() {
            return this.getState().structure;
        }
        prepareStructure(t, e) {
            const i = this.getState().mode;
            webix.extend(t, { rows: [], columns: [], values: [], filters: [] }),
                e
                    ? ("chart" == i && t.groupBy) || !t.columns.length
                        ? t.groupBy && (t.columns = [t.groupBy])
                        : (t.groupBy = t.columns[0])
                    : "chart" != i
                    ? (t.groupBy = t.columns[0])
                    : t.groupBy
                    ? t.columns[0] !== t.groupBy && (t.columns = [t.groupBy])
                    : (t.columns = []);
            const s = [];
            for (let e = 0; e < t.values.length; e++) {
                const i = t.values[e];
                if (webix.isArray(i.operation)) {
                    i.color =
                        (webix.isArray(i.color) ? i.color : [i.color]) || [];
                    for (let t = 0; t < i.operation.length; t++) {
                        const e = Object.assign({}, i);
                        (e.operation = i.operation[t]),
                            (e.color = i.color && i.color[t]),
                            s.push(e);
                    }
                } else s.push(i);
            }
            for (let t = 0; t < s.length; t++)
                s[t].color ||
                    (s[t].color = this.getService("local").getValueColor(t)),
                    s[t].name ||
                        s[t].math ||
                        ((s[t].math = s[t].operation),
                        (s[t].operation = "complex"));
            return (t.values = s), t;
        }
    }
    webix.protoUI(
        {
            name: "pivot",
            app: Ct,
            defaults: { borderless: !1 },
            $init: function () {
                (this.name = "pivot"), (this.$view.className += " webix_pivot");
                const t = this.$app.getState();
                for (let e in t) H(t, this.config, e);
                this.$app.attachEvent("filter:change", (t, e) =>
                    this.callEvent("onFilterChange", [t, e])
                );
            },
            $exportView: function (t) {
                const e = this.$app.getRoot().queryView({ $mainView: !0 });
                return e.$exportView ? e.$exportView(t) : e;
            },
            getState() {
                return this.$app.getState();
            },
            getService(t) {
                return this.$app.getService(t);
            },
            setStructure: function (t) {
                this.$app.setStructure(t);
            },
            getStructure: function () {
                return this.$app.getStructure();
            },
            clearAll: function () {
                this.$app.getService("local").clearAll();
            },
        },
        webix.ui.jetapp
    );
    const kt = { Backend: $t, LocalData: St },
        Vt = {
            en: {
                Done: "Done",
                Table: "Table",
                Tree: "Tree",
                Chart: "Chart",
                "Click to configure": "Click to configure",
                "Configure Pivot": "Configure Pivot",
                Total: "Total",
                Fields: "Fields",
                Methods: "Methods",
                Columns: "Columns",
                "Add column": "Add column",
                Rows: "Rows",
                "Add row": "Add row",
                "Clean rows": "Clean rows",
                Filters: "Filters",
                "Add filter": "Add filter",
                "Group By": "Group By",
                "Chart type": "Chart type",
                "Logarithmic scale": "Logarithmic scale",
                "X axis title": "X axis title",
                "Y axis title": "Y axis title",
                "Scale color": "Scale color",
                "Circled lines": "Circled lines",
                Horizontal: "Horizontal",
                Stacked: "Stacked",
                Lines: "Lines",
                Line: "Line",
                Radar: "Radar",
                Bar: "Bar",
                Area: "Area",
                Spline: "Spline",
                "Spline Area": "Spline Area",
                Values: "Values",
                "Add value": "Add value",
                "Field not defined": "Field not defined",
                Highlight: "Highlight",
                "Min X": "Min X",
                "Max X": "Max X",
                "Min Y": "Min Y",
                "Max Y": "Max Y",
                Footer: "Footer",
                "Total Column": "Total Column",
                Off: "Off",
                On: "On",
                "Sum Only": "Sum Only",
                count: "count",
                max: "max",
                min: "min",
                avg: "avg",
                wavg: "wavg",
                any: "any",
                sum: "sum",
                complex: "complex",
                "Incorrect formula in values": "Incorrect formula in values",
            },
        };
    (t.App = Ct),
        (t.locales = Vt),
        (t.services = kt),
        (t.views = Q),
        Object.defineProperty(t, "__esModule", { value: !0 });
});
//# sourceMappingURL=pivot.min.js.map
