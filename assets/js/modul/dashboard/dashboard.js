var KTWidgets = {
    init: function () {
        var e, t, a, o, r;
        ! function () {
            var e = document.getElementById("kt_charts_widget_3_chart");
            if (e) {
                var t = {
                    self: null,
                    rendered: !1
                },
                    a = function () {
                        parseInt(KTUtil.css(e, "height"));
                        var a = KTUtil.getCssVariableValue("--bs-gray-500"),
                            o = KTUtil.getCssVariableValue("--bs-gray-200"),
                            r = KTUtil.getCssVariableValue("--bs-primary"),
                            s = {
                                series: [{
                                    name: "Jumlah Pendukung",
                                    data: value_chart
                                }],
                                chart: {
                                    fontFamily: "inherit",
                                    type: "area",
                                    height: 350,
                                    toolbar: {
                                        show: !1
                                    }
                                },
                                plotOptions: {},
                                legend: {
                                    show: !1
                                },
                                dataLabels: {
                                    enabled: !1
                                },
                                fill: {
                                    type: "solid",
                                    opacity: 1
                                },
                                stroke: {
                                    curve: "smooth",
                                    show: !0,
                                    width: 3,
                                    colors: [r]
                                },
                                xaxis: {
                                    categories: kategori,
                                    axisBorder: {
                                        show: !1
                                    },
                                    axisTicks: {
                                        show: !1
                                    },
                                    labels: {
                                        style: {
                                            colors: a,
                                            fontSize: "12px"
                                        }
                                    },
                                    crosshairs: {
                                        position: "front",
                                        stroke: {
                                            color: r,
                                            width: 1,
                                            dashArray: 3
                                        }
                                    },
                                    tooltip: {
                                        enabled: !0,
                                        formatter: void 0,
                                        offsetY: 0,
                                        style: {
                                            fontSize: "12px"
                                        }
                                    }
                                },
                                yaxis: {
                                    labels: {
                                        style: {
                                            colors: a,
                                            fontSize: "12px"
                                        }
                                    }
                                },
                                states: {
                                    normal: {
                                        filter: {
                                            type: "none",
                                            value: 0
                                        }
                                    },
                                    hover: {
                                        filter: {
                                            type: "none",
                                            value: 0
                                        }
                                    },
                                    active: {
                                        allowMultipleDataPointsSelection: !1,
                                        filter: {
                                            type: "none",
                                            value: 0
                                        }
                                    }
                                },
                                tooltip: {
                                    style: {
                                        fontSize: "12px"
                                    },
                                    y: {
                                        formatter: function (e) {
                                            return e + " Orang"
                                        }
                                    }
                                },
                                colors: [KTUtil.getCssVariableValue("--bs-info-light")],
                                grid: {
                                    borderColor: o,
                                    strokeDashArray: 4,
                                    yaxis: {
                                        lines: {
                                            show: !0
                                        }
                                    }
                                },
                                markers: {
                                    strokeColor: r,
                                    strokeWidth: 3
                                }
                            };
                        t.self = new ApexCharts(e, s), t.self.render(), t.rendered = !0
                    };
                a(), KTThemeMode.on("kt.thememode.change", (function () {
                    t.rendered && t.self.destroy(), a()
                }))
            }
        }(),
            function () {
                var e = document.querySelectorAll(".mixed-widget-17-chart");
                [].slice.call(e).map((function (e) {
                    var t = parseInt(KTUtil.css(e, "height"));
                    if (e) {
                        var a = e.getAttribute("data-kt-chart-color"),
                            o = {
                                labels: [label_pendukung],
                                series: [persentase_pendukung],
                                chart: {
                                    fontFamily: "inherit",
                                    height: t,
                                    type: "radialBar",
                                    offsetY: 0
                                },
                                plotOptions: {
                                    radialBar: {
                                        startAngle: -90,
                                        endAngle: 90,
                                        hollow: {
                                            margin: 0,
                                            size: "55%"
                                        },
                                        dataLabels: {
                                            showOn: "always",
                                            name: {
                                                show: !0,
                                                fontSize: "12px",
                                                fontWeight: "700",
                                                offsetY: -5,
                                                color: KTUtil.getCssVariableValue("--bs-gray-500")
                                            },
                                            value: {
                                                color: KTUtil.getCssVariableValue("--bs-gray-900"),
                                                fontSize: "20px",
                                                fontWeight: "600",
                                                offsetY: -40,
                                                show: !0,
                                                formatter: function (e) {
                                                    return persentase_pendukung + '%';
                                                }
                                            }
                                        },
                                        track: {
                                            background: KTUtil.getCssVariableValue("--bs-gray-300"),
                                            strokeWidth: "100%"
                                        }
                                    }
                                },

                                colors: [KTUtil.getCssVariableValue("--bs-" + a)],
                                stroke: {
                                    lineCap: "round"
                                }
                            };
                        new ApexCharts(e, o).render()
                    }
                }))
            }()
    }
};
"undefined" != typeof module && void 0 !== module.exports && (module.exports = KTWidgets), KTUtil.onDOMContentLoaded((function () {
    KTWidgets.init()
}));



var KTChartsWidget5 = function () {
    var e = {
        self: null,
        rendered: !1
    },
        t = function (e) {
            var t = document.getElementById("kt_charts_widget_5");
            if (t) {
                var a = KTUtil.getCssVariableValue("--bs-border-dashed-color"),
                    l = {
                        series: [{
                            name: "Pendukung",
                            data: pendukung,
                            show: !1
                        }],
                        chart: {
                            type: "bar",
                            height: 350,
                            toolbar: {
                                show: !1
                            }
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 4,
                                horizontal: !0,
                                distributed: !0,
                                barHeight: 23
                            }
                        },
                        dataLabels: {
                            enabled: !1
                        },
                        legend: {
                            show: !1
                        },
                        // colors: ["#3E97FF", "#F1416C", "#50CD89", "#FFC700", "#7239EA", "#50CDCD", "#3F4254"],
                        xaxis: {
                            categories: field,
                            labels: {
                                formatter: function (e) {
                                    return e
                                },
                                style: {
                                    colors: KTUtil.getCssVariableValue("--bs-gray-400"),
                                    fontSize: "14px",
                                    fontWeight: "600",
                                    align: "left"
                                }
                            },
                            axisBorder: {
                                show: !1
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: KTUtil.getCssVariableValue("--bs-gray-800"),
                                    fontSize: "14px",
                                    fontWeight: "600"
                                },
                                offsetY: 2,
                                align: "left"
                            }
                        },
                        grid: {
                            borderColor: a,
                            xaxis: {
                                lines: {
                                    show: !0
                                }
                            },
                            yaxis: {
                                lines: {
                                    show: !1
                                }
                            },
                            strokeDashArray: 4
                        }
                    };
                e.self = new ApexCharts(t, l), setTimeout((function () {
                    e.self.render(), e.rendered = !0
                }), 200)
            }
        };
    return {
        init: function () {
            t(e), KTThemeMode.on("kt.thememode.change", (function () {
                e.rendered && e.self.destroy(), t(e)
            }))
        }
    }
}();
"undefined" != typeof module && (module.exports = KTChartsWidget5), KTUtil.onDOMContentLoaded((function () {
    KTChartsWidget5.init()
}));