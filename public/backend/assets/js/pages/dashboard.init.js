var options = {
    series: [

        {
            name: "2019",
            type: "line",
            data: [23, 32, 27, 38, 27, 32, 27, 38, 22, 31, 21, 16],
        },
    ],
    chart: { height: 350, type: "line", toolbar: { show: !1 } },
    stroke: { width: [0, 2.3], curve: "straight" },
    plotOptions: { bar: { horizontal: !1, columnWidth: "34%" } },
    dataLabels: { enabled: !1 },
    legend: { show: !1 },
    yaxis: {
        labels: {
            formatter: function (e) {
                return e + "k";
            },
        },
        tickAmount: 5,
        min: 0,
        max: 50,
    },
    colors: ["#0f9cf3", "#6fd088"],
    labels: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ],
};
(chart = new ApexCharts(
    document.querySelector("#column_line_chart"),
    options
)).render();
options = {
    series: [42, 26, 15],
    chart: { height: 286, type: "donut" },
    labels: ["Market Place", "Last Week", "Last Month"],
    plotOptions: {
        pie: {
            donut: {
                size: "73%",
                labels: {
                    show: !0,
                    name: { show: !0, fontSize: "18px", offsetY: 5 },
                    value: {
                        show: !1,
                        fontSize: "20px",
                        color: "#343a40",
                        offsetY: 8,
                    },
                    total: {
                        show: !0,
                        fontSize: "17px",
                        label: "Ethereum",
                        color: "#6c757d",
                        fontWeight: 600,
                    },
                },
            },
        },
    },
    dataLabels: { enabled: !1 },
    legend: { show: !1 },
    colors: ["#0f9cf3", "#6fd088", "#ffbb44"],
};
(chart = new ApexCharts(
    document.querySelector("#donut-chart"),
    options
)).render();
