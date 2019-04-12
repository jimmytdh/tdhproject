

App = function() {
    "use strict";
    return App.chartsMorris = function(data) {
        var t, e, a, i, r, o, n, l, s, c, d = [{
            day: "Feb 22",
            opd: 450,
            er: 400
        }, {
            day: "Feb 23",
            opd: 350,
            er: 550
        }, {
            day: "Feb 24",
            opd: 500,
            er: 700
        }, {
            day: "Feb 25",
            opd: 250,
            er: 380
        }, {
            day: "Feb 26",
            opd: 350,
            er: 240
        }, {
            day: "Feb 27",
            opd: 180,
            er: 300
        }, {
            day: "Feb 28",
            opd: 300,
            er: 250
        }];

        t = App.color.primary, e = tinycolor(App.color.primary).lighten(15).toString(), new Morris.Line({
            element: "line-chart",
            data: d,
            xkey: "day",
            ykeys: ["opd", "er"],
            labels: ["OPD", "ER/DR"],
            parseTime:false,
            lineColors: [t, e]
        }), a = tinycolor(App.color.primary).lighten(15).toString(), i = tinycolor(App.color.primary).brighten(3).toString(), Morris.Bar({
            element: "bar-chart",
            data: [{
                hour: "6am-10am",
                opd: 136,
                er: 180
            }, {
                hour: "10am-2pm",
                opd: 300,
                er: 200
            }, {
                hour: "2pm-6pm",
                opd: 123,
                er: 150
            }, {
                hour: "6pm-10pm",
                opd: 50,
                er: 10
            }, {
                hour: "10pm-2am",
                opd: 0,
                er: 3
            }, {
                hour: "2am-6am",
                opd: 0,
                er: 12
            }],
            xkey: "hour",
            ykeys: ["opd", "er"],
            labels: ["OPD", "ER/DR"],
            barColors: [a, i],
            barRatio: .4,
            xLabelAngle: 35,
            hideHover: "auto"
        }), r = App.color.primary, o = tinycolor(App.color.primary).lighten(20), n = tinycolor(App.color.primary).lighten(10), Morris.Donut({
            element: "donut-chart",
            data: [{
                label: "OPD",
                value: 60
            }, {
                label: "ER/DR",
                value: 36
            }, {
                label: "OR",
                value: 4
            }],
            colors: [r, o, n],
            formatter: function(t) {
                return t + "%"
            }
        }), l = App.color.primary, s = tinycolor(App.color.primary).lighten(10).toString(), c = tinycolor(App.color.primary).lighten(20).toString(), Morris.Area({
            element: "area-chart",
            data: [{
                period: "2019 Jan",
                opd: 2666,
                er: null,
                or: 2647
            }, {
                period: "2019 Feb",
                opd: 2778,
                er: 2294,
                or: 2441
            }, {
                period: "2019 March",
                opd: 4912,
                er: 1969,
                or: 2501
            }],
            xkey: "period",
            ykeys: ["opd", "er", "or"],
            labels: ["OPD", "ER/DR", "OR"],
            parseTime:false,
            lineColors: [l, s, c],
            pointSize: 2,
            hideHover: "auto"
        })
    }, App
}();