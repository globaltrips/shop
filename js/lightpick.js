!function(t, e) {
    if ("function" == typeof define && define.amd)
        define(["moment"], function(t) {
            return e(t)
        });
    else if ("object" == typeof module && module.exports) {
        var s = "undefined" != typeof window && void 0 !== window.moment ? window.moment : require("moment");
        module.exports = e(s)
    } else
        t.Lightpick = e(t.moment)
}(this, function(u) {
    "use strict";
    var p = window.document
      , i = {
        field: null,
        secondField: null,
        firstDay: 1,
        parentEl: "body",
        lang: "auto",
        format: "DD/MM/YYYY",
        separator: " - ",
        numberOfMonths: 1,
        numberOfColumns: 2,
        singleDate: !0,
        autoclose: !0,
        repick: !1,
        startDate: null,
        endDate: null,
        minDate: null,
        maxDate: null,
        disableDates: null,
        selectForward: !1,
        selectBackward: !1,
        minDays: null,
        maxDays: null,
        hoveringTooltip: !0,
        hideOnBodyClick: !0,
        footer: !1,
        disabledDatesInRange: !0,
        tooltipNights: !1,
        orientation: "auto",
        disableWeekends: !1,
        inline: !1,
        dropdowns: {
            years: {
                min: 1900,
                max: null
            },
            months: !0
        },
        locale: {
            buttons: {
                prev: "&leftarrow;",
                next: "&rightarrow;",
                close: "&times;",
                reset: "Reset",
                apply: "Apply"
            },
            tooltip: {
                one: "day",
                other: "days"
            },
            tooltipOnDisabled: null,
            pluralize: function(t, e) {
                return "string" == typeof t && (t = parseInt(t, 10)),
                1 === t && "one"in e ? e.one : "other"in e ? e.other : ""
            }
        },
        onSelect: null,
        onOpen: null,
        onClose: null,
        onError: null
    }
      , f = function(t) {
        return '<div class="lightpick__toolbar"><button type="button" class="lightpick__previous-action skiptranslate">' + t.locale.buttons.prev + '</button><button type="button" class="lightpick__next-action skiptranslate">' + t.locale.buttons.next + "</button>" + (t.autoclose || t.inline ? "" : '<button type="button" class="lightpick__close-action">' + t.locale.buttons.close + "</button>") + "</div>"
    }
      , _ = function(t, e, s) {
        return new Date(1970,0,e).toLocaleString(t.lang, {
            weekday: s ? "short" : "long"
        })
    }
      , m = function(t, e, s, i) {
        if (s)
            return "<div></div>";
        e = u(e);
        var a = u(e).subtract(1, "month")
          , n = u(e).add(1, "month")
          , o = {
            time: u(e).valueOf(),
            className: ["lightpick__day skiptranslate", "is-available"]
        };
        if (i instanceof Array || "[object Array]" === Object.prototype.toString.call(i) ? (i = i.filter(function(t) {
            return 0 <= ["lightpick__day", "is-available", "is-previous-month", "is-next-month"].indexOf(t)
        }),
        o.className = o.className.concat(i)) : o.className.push(i),
        t.disableDates)
            for (var l = 0; l < t.disableDates.length; l++) {
                if (t.disableDates[l]instanceof Array || "[object Array]" === Object.prototype.toString.call(t.disableDates[l])) {
                    var r = u(t.disableDates[l][0])
                      , d = u(t.disableDates[l][1]);
                    r.isValid() && d.isValid() && e.isBetween(r, d, "day", "[]") && o.className.push("is-disabled")
                } else
                    u(t.disableDates[l]).isValid() && u(t.disableDates[l]).isSame(e, "day") && o.className.push("is-disabled");
                0 <= o.className.indexOf("is-disabled") && (t.locale.tooltipOnDisabled && (!t.startDate || e.isAfter(t.startDate) || t.startDate && t.endDate) && o.className.push("disabled-tooltip"),
                0 <= o.className.indexOf("is-start-date") ? (this.setStartDate(null),
                this.setEndDate(null)) : 0 <= o.className.indexOf("is-end-date") && this.setEndDate(null))
            }
        if (t.minDays && t.startDate && !t.endDate && e.isBetween(u(t.startDate).subtract(t.minDays - 1, "day"), u(t.startDate).add(t.minDays - 1, "day"), "day") && (o.className.push("is-disabled"),
        t.selectForward && e.isSameOrAfter(t.startDate) && (o.className.push("is-forward-selected"),
        o.className.push("is-in-range"))),
        t.maxDays && t.startDate && !t.endDate && (e.isSameOrBefore(u(t.startDate).subtract(t.maxDays, "day"), "day") ? o.className.push("is-disabled") : e.isSameOrAfter(u(t.startDate).add(t.maxDays, "day"), "day") && o.className.push("is-disabled")),
        t.repick && (t.minDays || t.maxDays) && t.startDate && t.endDate) {
            var c = u(t.repickTrigger == t.field ? t.endDate : t.startDate);
            t.minDays && e.isBetween(u(c).subtract(t.minDays - 1, "day"), u(c).add(t.minDays - 1, "day"), "day") && o.className.push("is-disabled"),
            t.maxDays && (e.isSameOrBefore(u(c).subtract(t.maxDays, "day"), "day") ? o.className.push("is-disabled") : e.isSameOrAfter(u(c).add(t.maxDays, "day"), "day") && o.className.push("is-disabled"))
        }
        e.isSame(new Date, "day") && o.className.push("is-today"),
        e.isSame(t.startDate, "day") && o.className.push("is-start-date"),
        e.isSame(t.endDate, "day") && o.className.push("is-end-date"),
        t.startDate && t.endDate && e.isBetween(t.startDate, t.endDate, "day", "[]") && o.className.push("is-in-range"),
        u().isSame(e, "month") || (a.isSame(e, "month") ? o.className.push("is-previous-month") : n.isSame(e, "month") && o.className.push("is-next-month")),
        t.minDate && e.isBefore(t.minDate, "day") && o.className.push("is-disabled"),
        t.maxDate && e.isAfter(t.maxDate, "day") && o.className.push("is-disabled"),
        t.selectForward && !t.singleDate && t.startDate && !t.endDate && e.isBefore(t.startDate, "day") && o.className.push("is-disabled"),
        t.selectBackward && !t.singleDate && t.startDate && !t.endDate && e.isAfter(t.startDate, "day") && o.className.push("is-disabled"),
        !t.disableWeekends || 6 != e.isoWeekday() && 7 != e.isoWeekday() || o.className.push("is-disabled"),
        o.className = o.className.filter(function(t, e, s) {
            return s.indexOf(t) === e
        }),
        0 <= o.className.indexOf("is-disabled") && 0 <= o.className.indexOf("is-available") && o.className.splice(o.className.indexOf("is-available"), 1);
        var h = p.createElement("div");
        return h.className = o.className.join(" "),
        h.innerHTML = e.get("date"),
        h.setAttribute("data-time", o.time),
        h.outerHTML
    }
      , D = function(t, e) {
        for (var s = u(t), i = p.createElement("select"), a = 0; a < 12; a++) {
            s.set("month", a);
            var n = p.createElement("option");
            n.value = s.toDate().getMonth(),
            n.text = s.toDate().toLocaleString(e.lang, {
                month: "long"
            }),
            a === t.toDate().getMonth() && n.setAttribute("selected", "selected"),
            i.appendChild(n)
        }
        return i.className = "lightpick__select lightpick__select-months text-capitalize",
        i.dir = "rtl",
        e.dropdowns && e.dropdowns.months || (i.disabled = !0),
        i.outerHTML
    }
      , g = function(t, e) {
        var s = u(t)
          , i = p.createElement("select")
          , a = e.dropdowns && e.dropdowns.years ? e.dropdowns.years : null
          , n = a && a.min ? a.min : 1900
          , o = a && a.max ? a.max : Number.parseInt(u().format("YYYY"));
        Number.parseInt(t.format("YYYY")) < n && (n = Number.parseInt(t.format("YYYY"))),
        Number.parseInt(t.format("YYYY")) > o && (o = Number.parseInt(t.format("YYYY")));
        for (var l = n; l <= o; l++) {
            s.set("year", l);
            var r = p.createElement("option");
            r.value = s.toDate().getFullYear(),
            r.text = s.toDate().getFullYear(),
            l === t.toDate().getFullYear() && r.setAttribute("selected", "selected"),
            i.appendChild(r)
        }
        return i.className = "lightpick__select lightpick__select-years skiptranslate",
        e.dropdowns && e.dropdowns.years || (i.disabled = !0),
        i.outerHTML
    }
      , e = function(t, e) {
        for (var s = "", i = u(e.calendar[0]), a = 0; a < e.numberOfMonths; a++) {
            var n = u(i);
            s += '<section class="lightpick__month">',
            s += '<header class="lightpick__month-title-bar">',
            s += '<div class="lightpick__month-title">' + D(n, e) + g(n, e) + "</div>",
            1 === e.numberOfMonths && (s += f(e)),
            s += "</header>",
            s += '<div class="lightpick__days-of-the-week">';
            for (var o = e.firstDay + 4; o < 7 + e.firstDay + 4; ++o)
                s += '<div class="lightpick__day-of-the-week text-capitalize" title="' + _(e, o) + '">' + _(e, o, !0) + "</div>";
            if (s += "</div>",
            s += '<div class="lightpick__days">',
            n.isoWeekday() !== e.firstDay)
                for (var l = 0 < n.isoWeekday() - e.firstDay ? n.isoWeekday() - e.firstDay : n.isoWeekday(), r = u(n).subtract(l, "day"), d = r.daysInMonth(), c = r.get("date"); c <= d; c++)
                    s += m(e, r, 0 < a, "is-previous-month"),
                    r.add(1, "day");
            for (d = n.daysInMonth(),
            new Date,
            c = 0; c < d; c++)
                s += m(e, n),
                n.add(1, "day");
            var h = u(n)
              , p = 7 - h.isoWeekday() + e.firstDay;
            if (p < 7)
                for (c = h.get("date"); c <= p; c++)
                    s += m(e, h, a < e.numberOfMonths - 1, "is-next-month"),
                    h.add(1, "day");
            s += "</div>",
            s += "</section>",
            i.add(1, "month")
        }
        e.calendar[1] = u(i),
        t.querySelector(".lightpick__months").innerHTML = s
    }
      , l = function(t, e) {
        var s = t.querySelectorAll(".lightpick__day");
        [].forEach.call(s, function(t) {
            t.outerHTML = m(e, parseInt(t.getAttribute("data-time")), !1, t.className.split(" "))
        }),
        a(t, e)
    }
      , a = function(t, s) {
        if (!s.disabledDatesInRange && s.startDate && !s.endDate && s.disableDates) {
            var e = t.querySelectorAll(".lightpick__day")
              , i = s.disableDates.map(function(t) {
                return t instanceof Array || "[object Array]" === Object.prototype.toString.call(t) ? t[0] : t
            })
              , a = u(i.filter(function(t) {
                return u(t).isBefore(s.startDate)
            }).sort(function(t, e) {
                return u(e).isAfter(u(t))
            })[0])
              , n = u(i.filter(function(t) {
                return u(t).isAfter(s.startDate)
            }).sort(function(t, e) {
                return u(t).isAfter(u(e))
            })[0]);
            [].forEach.call(e, function(t) {
                var e = u(parseInt(t.getAttribute("data-time")));
                (a && e.isBefore(a) && s.startDate.isAfter(a) || n && e.isAfter(n) && n.isAfter(s.startDate)) && (t.classList.remove("is-available"),
                t.classList.add("is-disabled"))
            })
        }
    }
      , t = function(t) {
        var d = this
          , i = d.config(t);
        d.el = p.createElement("section"),
        d.el.className = "lightpick lightpick--" + i.numberOfColumns + "-columns is-hidden",
        i.inline && (d.el.className += " lightpick--inlined");
        var e = '<div class="lightpick__inner">' + (1 < i.numberOfMonths ? f(i) : "") + '<div class="lightpick__months"></div><div class="lightpick__tooltip" style="visibility: hidden"></div>';
        i.footer && (e += '<div class="lightpick__footer">',
        !0 === i.footer ? (e += '<button type="button" class="lightpick__reset-action">' + i.locale.buttons.reset + "</button>",
        e += '<div class="lightpick__footer-message"></div>',
        e += '<button type="button" class="lightpick__apply-action">' + i.locale.buttons.apply + "</button>") : e += i.footer,
        e += "</div>"),
        e += "</div>",
        d.el.innerHTML = e,
        i.parentEl instanceof Node ? i.parentEl.appendChild(d.el) : "body" === i.parentEl && i.inline ? i.field.parentNode.appendChild(d.el) : p.querySelector(i.parentEl).appendChild(d.el),
        d._onMouseDown = function(t) {
            if (d.isShowing) {
                var e = (t = t || window.event).target || t.srcElement;
                if (e) {
                    t.stopPropagation(),
                    e.classList.contains("lightpick__select") || t.preventDefault();
                    var s = d._opts;
                    if (e.classList.contains("lightpick__day") && e.classList.contains("is-available")) {
                        var i = u(parseInt(e.getAttribute("data-time")));
                        if (!s.disabledDatesInRange && s.disableDates && s.startDate) {
                            var a = i.isAfter(s.startDate) ? u(s.startDate) : u(i)
                              , n = i.isAfter(s.startDate) ? u(i) : u(s.startDate);
                            if (s.disableDates.filter(function(t) {
                                if (t instanceof Array || "[object Array]" === Object.prototype.toString.call(t)) {
                                    var e = u(t[0])
                                      , s = u(t[1]);
                                    return e.isValid() && s.isValid() && (e.isBetween(a, n, "day", "[]") || s.isBetween(a, n, "day", "[]"))
                                }
                                return u(t).isBetween(a, n, "day", "[]")
                            }).length)
                                return d.setStartDate(null),
                                d.setEndDate(null),
                                e.dispatchEvent(new Event("mousedown")),
                                d.el.querySelector(".lightpick__tooltip").style.visibility = "hidden",
                                void l(d.el, s)
                        }
                        if (s.singleDate || !s.startDate && !s.endDate || s.startDate && s.endDate ? s.repick && s.startDate && s.endDate ? (s.repickTrigger === s.field ? (d.setStartDate(i),
                        e.classList.add("is-start-date")) : (d.setEndDate(i),
                        e.classList.add("is-end-date")),
                        s.startDate.isAfter(s.endDate) && d.swapDate(),
                        s.autoclose && setTimeout(function() {
                            d.hide()
                        }, 100)) : (d.setStartDate(i),
                        d.setEndDate(null),
                        e.classList.add("is-start-date"),
                        s.singleDate && s.autoclose ? setTimeout(function() {
                            d.hide()
                        }, 100) : s.singleDate && !s.inline || l(d.el, s)) : s.startDate && !s.endDate && (d.setEndDate(i),
                        s.startDate.isAfter(s.endDate) && d.swapDate(),
                        e.classList.add("is-end-date"),
                        s.autoclose ? setTimeout(function() {
                            d.hide()
                        }, 100) : l(d.el, s)),
                        !s.disabledDatesInRange && 0 === d.el.querySelectorAll(".lightpick__day.is-available").length && (d.setStartDate(null),
                        l(d.el, s),
                        s.footer))
                            if ("function" == typeof d._opts.onError)
                                d._opts.onError.call(d, "Invalid range");
                            else {
                                var o = d.el.querySelector(".lightpick__footer-message");
                                o && (o.innerHTML = s.locale.not_allowed_range,
                                setTimeout(function() {
                                    o.innerHTML = ""
                                }, 3e3))
                            }
                    } else
                        e.classList.contains("lightpick__previous-action") ? d.prevMonth() : e.classList.contains("lightpick__next-action") ? d.nextMonth() : e.classList.contains("lightpick__close-action") || e.classList.contains("lightpick__apply-action") ? d.hide() : e.classList.contains("lightpick__reset-action") && d.reset()
                }
            }
        }
        ,
        d._onMouseEnter = function(t) {
            if (d.isShowing) {
                var e = (t = t || window.event).target || t.srcElement;
                if (e) {
                    var s = d._opts;
                    if (e.classList.contains("lightpick__day") && e.classList.contains("disabled-tooltip") && s.locale.tooltipOnDisabled)
                        d.showTooltip(e, s.locale.tooltipOnDisabled);
                    else if (d.hideTooltip(),
                    !s.singleDate && (s.startDate || s.endDate) && (e.classList.contains("lightpick__day") || e.classList.contains("is-available")) && (s.startDate && !s.endDate || s.repick)) {
                        var i = u(parseInt(e.getAttribute("data-time")));
                        if (!i.isValid())
                            return;
                        var a = s.startDate && !s.endDate || s.repick && s.repickTrigger === s.secondField ? s.startDate : s.endDate
                          , n = d.el.querySelectorAll(".lightpick__day");
                        if ([].forEach.call(n, function(t) {
                            var e = u(parseInt(t.getAttribute("data-time")));
                            t.classList.remove("is-flipped"),
                            e.isValid() && e.isSameOrAfter(a, "day") && e.isSameOrBefore(i, "day") ? (t.classList.add("is-in-range"),
                            s.repickTrigger === s.field && e.isSameOrAfter(s.endDate) && t.classList.add("is-flipped")) : e.isValid() && e.isSameOrAfter(i, "day") && e.isSameOrBefore(a, "day") ? (t.classList.add("is-in-range"),
                            (s.startDate && !s.endDate || s.repickTrigger === s.secondField) && e.isSameOrBefore(s.startDate) && t.classList.add("is-flipped")) : t.classList.remove("is-in-range"),
                            s.startDate && s.endDate && s.repick && s.repickTrigger === s.field ? t.classList.remove("is-start-date") : t.classList.remove("is-end-date")
                        }),
                        s.hoveringTooltip) {
                            n = Math.abs(i.isAfter(a) ? i.diff(a, "day") : a.diff(i, "day")),
                            s.tooltipNights || (n += 1);
                            d.el.querySelector(".lightpick__tooltip");
                            if (0 < n && !e.classList.contains("is-disabled")) {
                                var o = "";
                                "function" == typeof s.locale.pluralize && (o = s.locale.pluralize.call(d, n, s.locale.tooltip)),
                                d.showTooltip(e, n + " " + o)
                            } else
                                d.hideTooltip()
                        }
                        s.startDate && s.endDate && s.repick && s.repickTrigger === s.field ? e.classList.add("is-start-date") : e.classList.add("is-end-date")
                    }
                }
            }
        }
        ,
        d._onChange = function(t) {
            var e = (t = t || window.event).target || t.srcElement;
            e && (e.classList.contains("lightpick__select-months") ? d.gotoMonth(e.value) : e.classList.contains("lightpick__select-years") && d.gotoYear(e.value))
        }
        ,
        d._onInputChange = function(t) {
            t.target || t.srcElement;
            d._opts.singleDate && (d._opts.autoclose || d.gotoDate(i.field.value)),
            d.syncFields(),
            d.isShowing || d.show()
        }
        ,
        d._onInputFocus = function(t) {
            var e = t.target || t.srcElement;
            d.show(e)
        }
        ,
        d._onInputClick = function(t) {
            var e = t.target || t.srcElement;
            d.show(e)
        }
        ,
        d._onClick = function(t) {
            var e = (t = t || window.event).target || t.srcElement
              , s = e;
            if (e) {
                do {
                    if (s.classList && s.classList.contains("lightpick") || s === i.field || i.secondField && s === i.secondField)
                        return
                } while (s = s.parentNode);d.isShowing && i.hideOnBodyClick && e !== i.field && s !== i.field && d.hide()
            }
        }
        ,
        d.showTooltip = function(t, e) {
            var s = d.el.querySelector(".lightpick__tooltip")
              , i = d.el.classList.contains("lightpick--inlined")
              , a = t.getBoundingClientRect()
              , n = i ? d.el.parentNode.getBoundingClientRect() : d.el.getBoundingClientRect()
              , o = a.left - n.left + a.width / 2
              , l = a.top - n.top;
            s.style.visibility = "visible",
            s.textContent = e;
            var r = s.getBoundingClientRect();
            l -= r.height,
            o -= r.width / 2,
            setTimeout(function() {
                s.style.top = l + "px",
                s.style.left = o + "px"
            }, 10)
        }
        ,
        d.hideTooltip = function() {
            d.el.querySelector(".lightpick__tooltip").style.visibility = "hidden"
        }
        ,
        d.el.addEventListener("mousedown", d._onMouseDown, !0),
        d.el.addEventListener("mouseenter", d._onMouseEnter, !0),
        d.el.addEventListener("touchend", d._onMouseDown, !0),
        d.el.addEventListener("change", d._onChange, !0),
        i.inline ? d.show() : d.hide(),
        i.field.addEventListener("change", d._onInputChange),
        i.field.addEventListener("click", d._onInputClick),
        i.field.addEventListener("focus", d._onInputFocus),
        i.secondField && (i.secondField.addEventListener("change", d._onInputChange),
        i.secondField.addEventListener("click", d._onInputClick),
        i.secondField.addEventListener("focus", d._onInputFocus))
    };
    return t.prototype = {
        config: function(t) {
            var e = Object.assign({}, i, t);
            if (e.field = e.field && e.field.nodeName ? e.field : null,
            e.calendar = [u().set("date", 1)],
            1 === e.numberOfMonths && 1 < e.numberOfColumns && (e.numberOfColumns = 1),
            e.minDate = e.minDate && u(e.minDate).isValid() ? u(e.minDate) : null,
            e.maxDate = e.maxDate && u(e.maxDate).isValid() ? u(e.maxDate) : null,
            "auto" === e.lang) {
                var s = navigator.language || navigator.userLanguage;
                e.lang = s || "en-US"
            }
            return e.secondField && e.singleDate && (e.singleDate = !1),
            e.hoveringTooltip && e.singleDate && (e.hoveringTooltip = !1),
            "[object Object]" === Object.prototype.toString.call(t.locale) && (e.locale = Object.assign({}, i.locale, t.locale)),
            window.innerWidth < 480 && 1 < e.numberOfMonths && (e.numberOfMonths = 1,
            e.numberOfColumns = 1),
            e.repick && !e.secondField && (e.repick = !1),
            e.inline && (e.autoclose = !1,
            e.hideOnBodyClick = !1),
            this._opts = Object.assign({}, e),
            this.syncFields(),
            this.setStartDate(this._opts.startDate, !0),
            this.setEndDate(this._opts.endDate, !0),
            this._opts
        },
        syncFields: function() {
            if (this._opts.singleDate || this._opts.secondField)
                u(this._opts.field.value, this._opts.format).isValid() && (this._opts.startDate = u(this._opts.field.value, this._opts.format)),
                this._opts.secondField && u(this._opts.secondField.value, this._opts.format).isValid() && (this._opts.endDate = u(this._opts.secondField.value, this._opts.format));
            else {
                var t = this._opts.field.value.split(this._opts.separator);
                2 === t.length && (u(t[0], this._opts.format).isValid() && (this._opts.startDate = u(t[0], this._opts.format)),
                u(t[1], this._opts.format).isValid() && (this._opts.endDate = u(t[1], this._opts.format)))
            }
        },
        swapDate: function() {
            var t = u(this._opts.startDate);
            this.setDateRange(this._opts.endDate, t)
        },
        gotoToday: function() {
            this.gotoDate(new Date)
        },
        gotoDate: function(t) {
            (t = u(t)).isValid() || (t = u()),
            t.set("date", 1),
            this._opts.calendar = [u(t)],
            e(this.el, this._opts)
        },
        gotoMonth: function(t) {
            isNaN(t) || (this._opts.calendar[0].set("month", t),
            e(this.el, this._opts))
        },
        gotoYear: function(t) {
            isNaN(t) || (this._opts.calendar[0].set("year", t),
            e(this.el, this._opts))
        },
        prevMonth: function() {
            this._opts.calendar[0] = u(this._opts.calendar[0]).subtract(this._opts.numberOfMonths, "month"),
            e(this.el, this._opts),
            a(this.el, this._opts)
        },
        nextMonth: function() {
            this._opts.calendar[0] = u(this._opts.calendar[1]),
            e(this.el, this._opts),
            a(this.el, this._opts)
        },
        updatePosition: function() {
            if (!this.el.classList.contains("lightpick--inlined")) {
                this.el.classList.remove("is-hidden");
                var t = this._opts.field.getBoundingClientRect()
                  , e = this.el.getBoundingClientRect()
                  , s = this._opts.orientation.split(" ")
                  , i = 0
                  , a = 0;
                "auto" != s[0] && /top|bottom/.test(s[0]) ? (i = t[s[0]] + window.pageYOffset,
                "top" == s[0] && (i -= e.height)) : i = t.bottom + e.height > window.innerHeight && window.pageYOffset > e.height ? t.top + window.pageYOffset - e.height : t.bottom + window.pageYOffset,
                /left|right/.test(s[0]) || s[1] && "auto" != s[1] && /left|right/.test(s[1]) ? (a = /left|right/.test(s[0]) ? t[s[0]] + window.pageXOffset : t[s[1]] + window.pageXOffset,
                "right" != s[0] && "right" != s[1] || (a -= e.width)) : a = t.left + e.width > window.innerWidth ? t.right + window.pageXOffset - e.width : t.left + window.pageXOffset,
                this.el.classList.add("is-hidden"),
                this.el.style.top = i + "px",
                this.el.style.left = a + "px"
            }
        },
        setStartDate: function(t, e) {
            var s = u(t, u.ISO_8601)
              , i = u(t, this._opts.format);
            if (!s.isValid() && !i.isValid())
                return this._opts.startDate = null,
                void (this._opts.field.value = "");
            this._opts.startDate = u(s.isValid() ? s : i),
            this._opts.singleDate || this._opts.secondField ? this._opts.field.value = this._opts.startDate.format(this._opts.format) : this._opts.field.value = this._opts.startDate.format(this._opts.format) + this._opts.separator + "...",
            e || "function" != typeof this._opts.onSelect || this._opts.onSelect.call(this, this.getStartDate(), this.getEndDate())
        },
        setEndDate: function(t, e) {
            var s = u(t, u.ISO_8601)
              , i = u(t, this._opts.format);
            if (!s.isValid() && !i.isValid())
                return this._opts.endDate = null,
                void (this._opts.secondField ? this._opts.secondField.value = "" : !this._opts.singleDate && this._opts.startDate && (this._opts.field.value = this._opts.startDate.format(this._opts.format) + this._opts.separator + "..."));
            this._opts.endDate = u(s.isValid() ? s : i),
            this._opts.secondField ? (this._opts.field.value = this._opts.startDate.format(this._opts.format),
            this._opts.secondField.value = this._opts.endDate.format(this._opts.format)) : this._opts.field.value = this._opts.startDate.format(this._opts.format) + this._opts.separator + this._opts.endDate.format(this._opts.format),
            e || "function" != typeof this._opts.onSelect || this._opts.onSelect.call(this, this.getStartDate(), this.getEndDate())
        },
        setDate: function(t, e) {
            this._opts.singleDate && (this.setStartDate(t, e),
            this.isShowing && l(this.el, this._opts))
        },
        setDateRange: function(t, e, s) {
            this._opts.singleDate || (this.setStartDate(t, !0),
            this.setEndDate(e, !0),
            this.isShowing && l(this.el, this._opts),
            s || "function" != typeof this._opts.onSelect || this._opts.onSelect.call(this, this.getStartDate(), this.getEndDate()))
        },
        setDisableDates: function(t) {
            this._opts.disableDates = t,
            this.isShowing && l(this.el, this._opts)
        },
        getStartDate: function() {
            return u(this._opts.startDate).isValid() ? this._opts.startDate : null
        },
        getEndDate: function() {
            return u(this._opts.endDate).isValid() ? this._opts.endDate : null
        },
        getDate: function() {
            return u(this._opts.startDate).isValid() ? this._opts.startDate : null
        },
        toString: function(t) {
            return this._opts.singleDate ? u(this._opts.startDate).isValid() ? this._opts.startDate.format(t) : "" : u(this._opts.startDate).isValid() && u(this._opts.endDate).isValid() ? this._opts.startDate.format(t) + this._opts.separator + this._opts.endDate.format(t) : u(this._opts.startDate).isValid() && !u(this._opts.endDate).isValid() ? this._opts.startDate.format(t) + this._opts.separator + "..." : !u(this._opts.startDate).isValid() && u(this._opts.endDate).isValid() ? "..." + this._opts.separator + this._opts.endDate.format(t) : ""
        },
        show: function(t) {
            this.isShowing || (this.isShowing = !0,
            this._opts.repick && (this._opts.repickTrigger = t),
            this.syncFields(),
            this._opts.secondField && this._opts.secondField === t && this._opts.endDate ? this.gotoDate(this._opts.endDate) : this.gotoDate(this._opts.startDate),
            p.addEventListener("click", this._onClick),
            this.updatePosition(),
            this.el.classList.remove("is-hidden"),
            "function" == typeof this._opts.onOpen && this._opts.onOpen.call(this),
            p.activeElement && p.activeElement != p.body && p.activeElement.blur())
        },
        hide: function() {
            this.isShowing && (this.isShowing = !1,
            p.removeEventListener("click", this._onClick),
            this.el.classList.add("is-hidden"),
            this.el.querySelector(".lightpick__tooltip").style.visibility = "hidden",
            "function" == typeof this._opts.onClose && this._opts.onClose.call(this))
        },
        destroy: function() {
            var t = this._opts;
            this.hide(),
            this.el.removeEventListener("mousedown", self._onMouseDown, !0),
            this.el.removeEventListener("mouseenter", self._onMouseEnter, !0),
            this.el.removeEventListener("touchend", self._onMouseDown, !0),
            this.el.removeEventListener("change", self._onChange, !0),
            t.field.removeEventListener("change", this._onInputChange),
            t.field.removeEventListener("click", this._onInputClick),
            t.field.removeEventListener("focus", this._onInputFocus),
            t.secondField && (t.secondField.removeEventListener("change", this._onInputChange),
            t.secondField.removeEventListener("click", this._onInputClick),
            t.secondField.removeEventListener("focus", this._onInputFocus)),
            this.el.parentNode && this.el.parentNode.removeChild(this.el)
        },
        reset: function() {
            this.setStartDate(null, !0),
            this.setEndDate(null, !0),
            l(this.el, this._opts),
            "function" == typeof this._opts.onSelect && this._opts.onSelect.call(this, this.getStartDate(), this.getEndDate()),
            this.el.querySelector(".lightpick__tooltip").style.visibility = "hidden"
        },
        reloadOptions: function(t) {
            this._opts = Object.assign({}, this._opts, t)
        }
    },
    t
});