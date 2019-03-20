<script type="text/javascript">
    App = function() {
        "use strict";
        return App.chartsMorris = function(data) {
            var t, e, a, i, r, o, n, l, s, c;
            console.log(data.chart3);
            t = App.color.primary, e = tinycolor(App.color.primary).lighten(15).toString(), new Morris.Line({
                element: "line-chart",
                data: data.chart1,
                xkey: "day",
                ykeys: ["opd", "er", "dr", "or"],
                labels: ["OPD", "ER", "DR", "OR"],
                parseTime:false,
                lineColors: [t, e]
            }), a = tinycolor(App.color.primary).lighten(15).toString(), i = tinycolor(App.color.primary).brighten(3).toString(), Morris.Bar({
                element: "bar-chart",
                data: data.chart2,
                xkey: "hour",
                ykeys: ["opd", "er", "dr", "or"],
                labels: ["OPD", "ER", "DR", "OR"],
                barColors: [a, i],
                barRatio: .4,
                xLabelAngle: 35,
                hideHover: "auto"
            }), r = App.color.primary, o = tinycolor(App.color.primary).lighten(20), n = tinycolor(App.color.primary).lighten(10), Morris.Donut({
                element: "donut-chart",
                data: data.chart3,
                colors: [r, o, n],
                formatter: function(t) {
                    return t + "%"
                }
            }), l = App.color.primary, s = tinycolor(App.color.primary).lighten(10).toString(), c = tinycolor(App.color.primary).lighten(20).toString(), Morris.Area({
                element: "area-chart",
                data: data.chart4,
                xkey: "period",
                ykeys: ["opd", "er", "dr", "or"],
                labels: ["OPD", "ER", "DR", "OR"],
                parseTime:false,
                lineColors: [l, s, c],
                pointSize: 2,
                hideHover: "auto"
            })
        }, App
    }();
</script>