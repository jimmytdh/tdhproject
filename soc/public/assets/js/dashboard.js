

App = function() {
    "use strict";
    return App.dashboard = function(data) {
        console.log(url);
        function t(t, e) {
            $("#" + t).bind("plothover", function(t, a, i) {
                var r = $(".tooltip-chart").width();
                i ? $(".tooltip-chart").css({
                    top: i.pageY - e,
                    left: i.pageX - (r / 2 - 2)
                }).fadeIn(200) : $(".tooltip-chart").hide()
            })
        }
        //for department graph
        var e, a, i, r, o, n, l, s, c, d, p;
        e = App.color.primary, a = tinycolor(App.color.primary).brighten(5).saturate(15), i = tinycolor(App.color.primary).brighten(15).saturate(15),
             t("develop-chart", 65), $('[data-toggle="counter"]').each(function(t, e) {
            var a = $(this),
                i = "",
                r = "",
                o = 0,
                n = 0,
                l = 0,
                s = 2.5;
            a.data("prefix") && (i = a.data("prefix")), a.data("suffix") && (r = a.data("suffix")), a.data("start") && (o = a.data("start")), a.data("end") && (n = a.data("end")), a.data("decimals") && (l = a.data("decimals")), a.data("duration") && (s = a.data("duration")), new CountUp(a.get(0), o, n, l, s, {
                suffix: r,
                prefix: i
            }).start()
        }), r = App.color.primary, $.plot($("#week-chart"), [{
            // weekly activity
            data: data.weekly,
            label: "Visits"
        }], {
            series: {
                lines: {
                    show: !0,
                    lineWidth: 4,
                    fill: !1
                },
                points: {
                    show: !1
                },
                shadowSize: 0
            },
            legend: {
                show: !1
            },
            grid: {
                margin: {
                    left: 30,
                    right: 30,
                    top: 20,
                    botttom: 40
                },
                labelMargin: 0,
                axisMargin: 500,
                hoverable: !0,
                clickable: !0,
                tickColor: "rgba(0,0,0,0.15)",
                borderWidth: 0
            },
            tooltip: {
                show: !0,
                cssClass: "tooltip-chart",
                content: "<div class='content-chart'> <span> %s </span> <div class='label'> <div class='label-x'> %x.0 </div> - <div class='label-y'> %y.0 </div> </div></div>",
                defaultTheme: !1
            },
            colors: [r],
            xaxis: {
                min: 1,
                max: 7,
                mode: "time",
                ticks: [
                    [1, "Sun"],
                    [2, "Mon"],
                    [3, "Tue"],
                    [4, "Wed"],
                    [5, "Thu"],
                    [6, "Fri"],
                    [7, "Sat"]
                ],
                timeformat: "%a"
            },
            yaxis: {
                tickFormatter: function() {
                    return ""
                },
                min: 0,
                max: data.total,
                ticks: 8
            }
        }), t("week-chart", 65), o = tinycolor(App.color.primary).brighten(9).toString(), n = tinycolor(App.color.primary).lighten(13).toString(), l = tinycolor(App.color.primary).lighten(20).toString(), s = tinycolor(App.color.primary).lighten(27).toString(), $.plot("#users-chart", [{
            data: data.im,
            label: "Internal Medicine"
        }, {
            data: data.pedia,
            label: "Pedia"
        }, {
            data: data.surgery,
            label: "Surgery"
        }, {
            data: data.ob,
            label: "OB-Gyne"
        }, {
            data: data.dental,
            label: "Dental"
        }, {
            data: data.bite,
            label: "Animal Bite"
        }], {
            series: {
                pie: {
                    show: !0,
                    innerRadius: .7,
                    shadow: {
                        top: 5,
                        left: 15,
                        alpha: .3
                    },
                    stroke: {
                        width: 0
                    },
                    label: {
                        show: !1,
                        formatter: function(t, e) {
                            return '<div style="font-size:12px;text-align:center;padding:2px;color:#333;">' + t + "</div>"
                        }
                    },
                    highlight: {
                        opacity: .08
                    }
                }
            },
            grid: {
                hoverable: !0,
                clickable: !0
            },
            tooltip: {
                show: !0,
                cssClass: "tooltip-chart",
                content: "<div class='content-chart arrow-none'> <span> %s </span> <div class='label'> <div class='label-x'> %x.0% </div> </div></div>",
                defaultTheme: !1
            },
            colors: ['#000080', '#41bfed', '#f3422e', '#ec528d','#800080','#fb1c03'],
            legend: {
                show: !1
            }
        }), c = tinycolor(App.color.primary).lighten(5).toString(), d = App.color.primary, $.plot("#ads-chart", [{
            data: data.weeklySection.pedia,
            canvasRender: !0,
            showLabels: !0,
            label: "Pedia",
            labelPlacement: "below"
        }, {
            data: data.weeklySection.im,
            canvasRender: !0,
            showLabels: !0,
            label: "IM",
            labelPlacement: "below"
        }, {
            data: data.weeklySection.surgery,
            canvasRender: !0,
            showLabels: !0,
            label: "Surgery",
            labelPlacement: "below"
        }, {
            data: data.weeklySection.ob,
            canvasRender: !0,
            showLabels: !0,
            label: "OB-Gyne",
            labelPlacement: "below"
        }, {
            data: data.weeklySection.dental,
            canvasRender: !0,
            showLabels: !0,
            label: "Dental",
            labelPlacement: "below"
        }, {
            data: data.weeklySection.bite,
            canvasRender: !0,
            showLabels: !0,
            label: "Animal Bite",
            labelPlacement: "below"
        }], {
            series: {
                lines: {
                    show: !0,
                    lineWidth: 0,
                    fill: !0,
                    fillColor: {
                        colors: [{
                            opacity: 0.3
                        }, {
                            opacity: 0.3
                        }]
                    }
                },
                fillColor: "rgba(0, 0, 0, 1)",
                shadowSize: 0,
                curvedLines: {
                    apply: !0,
                    active: !0,
                    monotonicFit: !0
                }
            },
            legend: {
                show: !0,
                position: "nw",
                background: "green",
                container: $("#ads-chart-legend")
            },
            grid: {
                show: !1,
                hoverable: !0,
                clickable: !0
            },
            tooltip: {
                show: !0,
                cssClass: "tooltip-chart",
                content: "<div class='content-chart'> <span> %s </span> <div class='label'> <div class='label-x'> %x.0 </div> - <div class='label-y'> %y.0 </div> </div></div>",
                defaultTheme: !1
            },
            colors: ['#59eddd','#000080', '#f3422e', '#ec528d','#800080','#fb6069'],
            xaxis: {
                autoscaleMargin: 0,
                ticks: 11,
                tickDecimals: 0
            },
            yaxis: {
                autoscaleMargin: .5,
                ticks: 5,
                tickDecimals: 0
            }
        }), t("ads-chart", 65), p = tinycolor(App.color.light).darken(15).toString(), $.plot("#earnings-chart", [{
            data: [
                [1, 40],
                [2, 60],
                [3, 30],
                [4, 80],
                [5, 60]
            ],
            canvasRender: !0,
            showLabels: !1
        }], {
            series: {
                lines: {
                    show: !0,
                    fill: !0,
                    lineWidth: 4,
                    fillColor: {
                        colors: [{
                            opacity: .4
                        }, {
                            opacity: .4
                        }]
                    }
                },
                fillColor: "rgba(0, 0, 0, 1)",
                shadowSize: 0,
                curvedLines: {
                    apply: !0,
                    active: !0,
                    monotonicFit: !0
                }
            },
            legend: {
                show: !1
            },
            grid: {
                show: !1,
                hoverable: !0
            },
            tooltip: {
                show: !0,
                cssClass: "tooltip-chart",
                content: "<div class='content-chart'> <div class='label'> <div class='label-x'> %x.0 </div> - <div class='label-y'> %y.0 </div> </div></div>",
                defaultTheme: !1
            },
            colors: [p],
            xaxis: {
                autoscaleMargin: 0,
                ticks: 11
            },
            yaxis: {
                ticks: 9
            }
        }), t("earnings-chart", 45)
    }, App
}();

