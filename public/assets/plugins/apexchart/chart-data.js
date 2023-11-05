"use strict";
$(document).ready(function () {
    if ($("#apexcharts-area").length > 0) {
        var options = {
            chart: { height: 350, type: "line", toolbar: { show: false } },
            dataLabels: { enabled: false },
            stroke: { curve: "smooth" },
            series: [
                {
                    name: "Teachers",
                    color: "#3D5EE1",
                    data: [45, 60, 75, 51, 42, 42, 30],
                },
                {
                    name: "Students",
                    color: "#70C4CF",
                    data: [24, 48, 56, 32, 34, 52, 25],
                },
            ],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
            },
        };
        var chart = new ApexCharts(
            document.querySelector("#apexcharts-area"),
            options
        );
        chart.render();
    }
    if ($("#school-area").length > 0) {
        var options = {
            chart: { height: 350, type: "area", toolbar: { show: false } },
            dataLabels: { enabled: false },
            stroke: { curve: "straight" },
            series: [
                {
                    name: "Teachers",
                    color: "#3D5EE1",
                    data: [45, 60, 75, 51, 42, 42, 30],
                },
                {
                    name: "Students",
                    color: "#70C4CF",
                    data: [24, 48, 56, 32, 34, 52, 25],
                },
            ],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
            },
        };
        var chart = new ApexCharts(
            document.querySelector("#school-area"),
            options
        );
        chart.render();
    }

    // $(function() {
    //    'use strict'

    //    var colors = {
    //      primary        : "#6571ff",
    //      secondary      : "#7987a1",
    //      success        : "#05a34a",
    //      info           : "#66d1d1",
    //      warning        : "#fbbc06",
    //      danger         : "#ff3366",
    //      light          : "#e9ecef",
    //      dark           : "#060c17",
    //      muted          : "#7987a1",
    //      gridBorder     : "rgba(77, 138, 240, .15)",
    //      bodyColor      : "#000",
    //      cardBg         : "#fff"
    //    }

    //    var fontFamily = "'Roboto', Helvetica, sans-serif"

    //    var revenueChartData = [
    //      49.33,
    //      48.79,
    //      50.61,
    //      53.31,
    //      54.78,
    //      53.84,
    //      54.68,
    //      56.74,
    //      56.99,
    //      56.14,
    //      56.56,
    //      60.35,
    //      58.74,
    //      61.44,
    //      61.11,
    //      58.57,
    //      54.72,
    //      52.07,
    //      51.09,
    //      47.48,
    //      48.57,
    //      48.99,
    //      53.58,
    //      50.28,
    //      46.24,
    //      48.61,
    //      51.75,
    //      51.34,
    //      50.21,
    //      54.65,
    //      52.44,
    //      53.06,
    //      57.07,
    //      52.97,
    //      48.72,
    //      52.69,
    //      53.59,
    //      58.52,
    //      55.10,
    //      58.05,
    //      61.35,
    //      57.74,
    //      60.27,
    //      61.00,
    //      57.78,
    //      56.80,
    //      58.90,
    //      62.45,
    //      58.75,
    //      58.40,
    //      56.74,
    //      52.76,
    //      52.30,
    //      50.56,
    //      55.40,
    //      50.49,
    //      52.49,
    //      48.79,
    //      47.46,
    //      43.31,
    //      38.96,
    //      34.73,
    //      31.03,
    //      32.63,
    //      36.89,
    //      35.89,
    //      32.74,
    //      33.20,
    //      30.82,
    //      28.64,
    //      28.44,
    //      27.73,
    //      27.75,
    //      25.96,
    //      24.38,
    //      21.95,
    //      22.08,
    //      23.54,
    //      27.30,
    //      30.27,
    //      27.25,
    //      29.92,
    //      25.14,
    //      23.09,
    //      23.79,
    //      23.46,
    //      27.99,
    //      23.21,
    //      23.91,
    //      19.21,
    //      15.13,
    //      15.08,
    //      11.00,
    //      9.20,
    //      7.47,
    //      11.64,
    //      15.76,
    //      13.99,
    //      12.59,
    //      13.53,
    //      15.01,
    //      13.95,
    //      13.23,
    //      18.10,
    //      20.63,
    //      21.06,
    //      25.37,
    //      25.32,
    //      20.94,
    //      18.75,
    //      15.38,
    //      14.56,
    //      17.94,
    //      15.96,
    //      16.35,
    //      14.16,
    //      12.10,
    //      14.84,
    //      17.24,
    //      17.79,
    //      14.03,
    //      18.65,
    //      18.46,
    //      22.68,
    //      25.08,
    //      28.18,
    //      28.03,
    //      24.11,
    //      24.28,
    //      28.23,
    //      26.24,
    //      29.33,
    //      26.07,
    //      23.92,
    //      28.82,
    //      25.14,
    //      21.79,
    //      23.05,
    //      20.71,
    //      29.72,
    //      30.21,
    //      32.56,
    //      31.46,
    //      33.69,
    //      30.05,
    //      34.20,
    //      36.93,
    //      35.50,
    //      34.78,
    //      36.97
    //    ];

    //    var revenueChartCategories = [
    //      "Jan 01 2022", "Jan 02 2022", "jan 03 2022", "Jan 04 2022", "Jan 05 2022", "Jan 06 2022", "Jan 07 2022", "Jan 08 2022", "Jan 09 2022", "Jan 10 2022", "Jan 11 2022", "Jan 12 2022", "Jan 13 2022", "Jan 14 2022", "Jan 15 2022", "Jan 16 2022", "Jan 17 2022", "Jan 18 2022", "Jan 19 2022", "Jan 20 2022","Jan 21 2022", "Jan 22 2022", "Jan 23 2022", "Jan 24 2022", "Jan 25 2022", "Jan 26 2022", "Jan 27 2022", "Jan 28 2022", "Jan 29 2022", "Jan 30 2022", "Jan 31 2022",
    //      "Feb 01 2022", "Feb 02 2022", "Feb 03 2022", "Feb 04 2022", "Feb 05 2022", "Feb 06 2022", "Feb 07 2022", "Feb 08 2022", "Feb 09 2022", "Feb 10 2022", "Feb 11 2022", "Feb 12 2022", "Feb 13 2022", "Feb 14 2022", "Feb 15 2022", "Feb 16 2022", "Feb 17 2022", "Feb 18 2022", "Feb 19 2022", "Feb 20 2022","Feb 21 2022", "Feb 22 2022", "Feb 23 2022", "Feb 24 2022", "Feb 25 2022", "Feb 26 2022", "Feb 27 2022", "Feb 28 2022",
    //      "Mar 01 2022", "Mar 02 2022", "Mar 03 2022", "Mar 04 2022", "Mar 05 2022", "Mar 06 2022", "Mar 07 2022", "Mar 08 2022", "Mar 09 2022", "Mar 10 2022", "Mar 11 2022", "Mar 12 2022", "Mar 13 2022", "Mar 14 2022", "Mar 15 2022", "Mar 16 2022", "Mar 17 2022", "Mar 18 2022", "Mar 19 2022", "Mar 20 2022","Mar 21 2022", "Mar 22 2022", "Mar 23 2022", "Mar 24 2022", "Mar 25 2022", "Mar 26 2022", "Mar 27 2022", "Mar 28 2022", "Mar 29 2022", "Mar 30 2022", "Mar 31 2022",
    //      "Apr 01 2022", "Apr 02 2022", "Apr 03 2022", "Apr 04 2022", "Apr 05 2022", "Apr 06 2022", "Apr 07 2022", "Apr 08 2022", "Apr 09 2022", "Apr 10 2022", "Apr 11 2022", "Apr 12 2022", "Apr 13 2022", "Apr 14 2022", "Apr 15 2022", "Apr 16 2022", "Apr 17 2022", "Apr 18 2022", "Apr 19 2022", "Apr 20 2022","Apr 21 2022", "Apr 22 2022", "Apr 23 2022", "Apr 24 2022", "Apr 25 2022", "Apr 26 2022", "Apr 27 2022", "Apr 28 2022", "Apr 29 2022", "Apr 30 2022",
    //      "May 01 2022", "May 02 2022", "May 03 2022", "May 04 2022", "May 05 2022", "May 06 2022", "May 07 2022", "May 08 2022", "May 09 2022", "May 10 2022", "May 11 2022", "May 12 2022", "May 13 2022", "May 14 2022", "May 15 2022", "May 16 2022", "May 17 2022", "May 18 2022", "May 19 2022", "May 20 2022","May 21 2022", "May 22 2022", "May 23 2022", "May 24 2022", "May 25 2022", "May 26 2022", "May 27 2022", "May 28 2022", "May 29 2022", "May 30 2022",
    //    ]

    // ======================== fetch-monthly-production-data   monthlyProductionChart

    $(document).ready(function () {
        // Declare chartBar as a global variable outside the function
        var chartBar;
        var last12MonthsDate = new Date();
        last12MonthsDate.setMonth(last12MonthsDate.getMonth() - 12);
    
        function fetchAndRefreshChart() {
            $.ajax({
                url: "/fetch-monthly-production-data",
                method: "GET",
                dataType: "json",
                data: { startDate: last12MonthsDate.toISOString() },
                success: function (response) {
                    // console.log("Response:", response);
    
                    // Sort the response data based on the order of months
                    response.sort(function (a, b) {
                        return months.indexOf(a.month) - months.indexOf(b.month);
                    });
    
                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: 10,
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "55%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Productions",
                                color: "#70C4CF",
                                data: response.map((production) => production.count),
                            },
                        ],
                        labels: response.map((production) => production.month),
                        xaxis: {
                            labels: {
                                show: true,
                                rotate: -45,
                                style: {
                                    fontSize: "14px",
                                    colors: "#777",
                                },
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                        tooltip: {
                            x: {
                                formatter: function (value) {
                                    return value;
                                },
                            },
                        },
                    };
    
                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }
    
                    // Use the global chartBar variable
                    chartBar = new ApexCharts(
                        document.querySelector("#monthlyProductionChart"),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }
    
        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    
        // Months array to define the order of months
        var months = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];
    
        // Initial fetch
        fetchAndRefreshChart();
    });
    
    
    
    
    //end chart production

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;
        var last12MonthsDate = new Date();
        last12MonthsDate.setMonth(last12MonthsDate.getMonth() - 12);
        function fetchAndRefreshChart() {
            $.ajax({
                url: "/fetch-monthly-sinistres-dim-data",
                method: "GET",
                dataType: "json",
                data: { startDate: last12MonthsDate.toISOString() },
                success: function (response) {
                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                                // return val === 1 ? val + " Sinistre DIM" : val + " Sinistres DIM";
                            },
                            offsetY: 10, // Adjust the offset to position the labels properly
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "55%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Sinisters DIM",
                                color: "#70C4CF",
                                data: response.map(
                                    (sinistres_dim) => sinistres_dim.count
                                ),
                            },
                        ],
                        labels: response.map((production) => production.month),
                        xaxis: {
                            labels: {
                                show: true,
                                rotate: -45,
                                style: {
                                    fontSize: "14px",
                                    colors: "#777",
                                },
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    chartBar = new ApexCharts(
                        document.querySelector("#monthlySinistresDimChart"),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });
    //end chart sinistres dim

    // start chart sinistres at and rd
    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;
        var last12MonthsDate = new Date();
        last12MonthsDate.setMonth(last12MonthsDate.getMonth() - 12);

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/fetch-monthly-sinistres-at-rd-data",
                method: "GET",
                dataType: "json",
                data: { startDate: last12MonthsDate.toISOString() },
                success: function (response) {
                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                                // return val === 1 ? val + " Sinistre AT&RD" : val + " Sinistres AT&RD";
                            },
                            offsetY: 10, // Adjust the offset to position the labels properly
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "55%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Sinisters AT&RD",
                                color: "#70C4CF",
                                data: response.map(
                                    (sinistres_at_rd) => sinistres_at_rd.count
                                ),
                            },
                        ],
                        labels: response.map((production) => production.month),
                        xaxis: {
                            labels: {
                                show: true,
                                rotate: -45,
                                style: {
                                    fontSize: "14px",
                                    colors: "#777",
                                },
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    chartBar = new ApexCharts(
                        document.querySelector("#monthlySinistresAtRdChart"),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    //end chart sinistres at and rd

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartPie;
    
        function fetchAndRefreshChart() {
            $.ajax({
                url: "/pie-chart",
                method: "GET",
                dataType: "json",
                // Remove the date filtering to get data for all months
                success: function (response) {
                    //   console.log(response);
                    
                    new Chart(document.getElementById("pieChart"), {
                        type: "pie",
                        data: {
                            labels: response.labels,
                            datasets: [
                                {
                                    data: response.values,
                                    backgroundColor: [
                                        "#FF6384",
                                        "#36A2EB",
                                        "#FFCE56",
                                    ],
                                },
                            ],
                        },
                        options: {
                            maintainAspectRatio: false,
                            cutoutPercentage: 65,
                            tooltips: {
                                callbacks: {
                                    label: function (tooltipItem, data) {
                                        var dataset =
                                            data.datasets[
                                                tooltipItem.datasetIndex
                                            ];
                                        var total = dataset.data.reduce(
                                            function (
                                                previousValue,
                                                currentValue,
                                                currentIndex,
                                                array
                                            ) {
                                                return (
                                                    previousValue + currentValue
                                                );
                                            }
                                        );
                                        var currentValue =
                                            dataset.data[tooltipItem.index];
                                        var percentage = Math.floor(
                                            (currentValue / total) * 100 + 0.5
                                        );
                                        return currentValue + " (" + percentage + "%)";
                                    },
                                },
                            },
                        },
                    });
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }
    
        fetchAndRefreshChart();
    
        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    // Production details ============== //

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/production-chart-date-remise",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response);

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: 10,
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "30%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Mois",
                                data: [response.lastMonthData],
                            },
                            {
                                name: "Cumulé",
                                data: [response.last12MonthsData],
                            },
                        ],
                        labels: ["Mois", "Cumulé"],
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector("#productionDateRemise"),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    // production date de remise

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/production-chart-date-traitement",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response);

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: 10,
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "30%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Mois",
                                data: [response.lastMonthData],
                            },
                            {
                                name: "Cumulé",
                                data: [response.last12MonthsData],
                            },
                        ],
                        labels: ["Mois", "Cumulé"],
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector("#productionDateTraitement"),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/production-chart-date-traitement-null",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response);

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: 10,
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "30%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Mois",
                                data: [response.lastMonthData],
                            },
                            {
                                name: "Cumulé",
                                data: [response.last12MonthsData],
                            },
                        ],
                        labels: ["Mois", "Cumulé"],
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector("#productionDateTraitementNull"),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/production-chart-delai-traitement",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response);

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: 10,
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "30%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Mois",
                                data: [response.meanDelaiCurrentMonth],
                            },
                            {
                                name: "Cumulé",
                                data: [response.meanDelaiLast12Months],
                            },
                        ],
                        labels: ["Mois", "Cumulé"],
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector(
                            "#productionDelaiMoyenTraitement"
                        ),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/production-chart-charge-compte-last-month",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response.chargeCompteNames);

                    // Map charge_compte_ids to their corresponding names
                    var categoriesWithNames = response.chargeCompteIds.map(
                        function (id) {
                            return response.chargeCompteNames[id] || "Unknown";
                        }
                    );

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: true,
                            toolbar: { show: false },
                        },
                        plotOptions: {
                            bar: { horizontal: false, columnWidth: "55%" },
                        },
                        series: [
                            {
                                name: "Instance",
                                data: response.nullDateTraitementCount,
                            },
                            {
                                name: "Sorties",
                                data: response.dateTraitementCount,
                            },
                            {
                                name: "Entrées",
                                data: response.dateRemiseCount,
                            },
                        ],
                        xaxis: {
                            categories: categoriesWithNames,
                            labels: {
                                style: {
                                    fontSize: "12px",
                                },
                            },
                        },
                        legend: {
                            fontSize: "12px",
                        },
                        yaxis: {
                            title: {
                                text: "Comte",
                            },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector(
                            "#productionChartByChargeCompte"
                        ),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/production-chart-charge-compte-last-twelve-month",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response.chargeCompteNames);

                    // Map charge_compte_ids to their corresponding names
                    var categoriesWithNames = response.chargeCompteIds.map(
                        function (id) {
                            return response.chargeCompteNames[id] || "Unknown";
                        }
                    );

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: true,
                            toolbar: { show: false },
                        },
                        plotOptions: {
                            bar: { horizontal: false, columnWidth: "55%" },
                        },
                        series: [
                            {
                                name: "Instance",
                                data: response.nullDateTraitementCount,
                            },
                            {
                                name: "Sorties",
                                data: response.dateTraitementCount,
                            },
                            {
                                name: "Entrées",
                                data: response.dateRemiseCount,
                            },
                        ],
                        xaxis: {
                            categories: categoriesWithNames,
                            labels: {
                                style: {
                                    fontSize: "12px",
                                },
                            },
                        },
                        legend: {
                            fontSize: "12px",
                        },
                        yaxis: {
                            title: {
                                text: "Comte",
                            },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector(
                            "#productionChartChargeCompteTwelve"
                        ),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chart;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/calculate-mean-delai-traitement-by-charge-compte", // Adjust the URL to match your route
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log("Response:", response);

                    var categoriesWithNames = response.chargeCompteIds.map(
                        function (id) {
                            return response.chargeCompteNames[id] || "Unknown";
                        }
                    );

                    // console.log("Current Month Data:", response.meanDelaiTraitementCurrentMonth);
                    // console.log("Last 12 Months Data:", response.meanDelaiTraitementLast12Months);

                    // Convert string values to numbers
                    var currentMonthData = Object.values(
                        response.meanDelaiTraitementCurrentMonth
                    ).map(parseFloat);
                    var last12MonthsData = Object.values(
                        response.meanDelaiTraitementLast12Months
                    ).map(parseFloat);
                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        plotOptions: {
                            bar: { horizontal: false, columnWidth: "55%" },
                        },
                        series: [
                            {
                                name: "Mois",
                                data: currentMonthData,
                            },
                            {
                                name: "Cumulé",
                                data: last12MonthsData,
                            },
                        ],
                        xaxis: {
                            categories: categoriesWithNames,
                            labels: {
                                style: {
                                    fontSize: "12px",
                                },
                            },
                        },
                        legend: {
                            fontSize: "12px",
                        },
                        yaxis: {
                            title: {
                                text: "Délai moyen de traitement en Jours",
                            },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chart) {
                        chart.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chart = new ApexCharts(
                        document.querySelector(
                            "#meanDelaiTraitementChartGlobal"
                        ),
                        optionsBar
                    );
                    chart.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    // ==============================

    // Sinister AT & RD details ============== //

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-at-rd-chart-date-remise",
                method: "GET",
                dataType: "json",
                success: function (response) {

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: 10,
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "30%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Mois",
                                data: [response.lastMonthData],
                            },
                            {
                                name: "Cumulé",
                                data: [response.last12MonthsData],
                            },
                        ],
                        labels: ["Mois", "Cumulé"],
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector("#sinisterAtRdRemis"),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    // sinister date de remise

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-at-rd-chart-date-traitement",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response);

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: 10,
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "30%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Mois",
                                data: [response.lastMonthData],
                            },
                            {
                                name: "Cumulé",
                                data: [response.last12MonthsData],
                            },
                        ],
                        labels: ["Mois", "Cumulé"],
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector("#sinisterAtRDateTraitement"),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-at-rd-chart-date-traitement-null",
                method: "GET",
                dataType: "json",
                success: function (response) {

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: 10,
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "30%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Mois",
                                data: [response.lastMonthData],
                            },
                            {
                                name: "Cumulé",
                                data: [response.last12MonthsData],
                            },
                        ],
                        labels: ["Mois", "Cumulé"],
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector(
                            "#sinisterAtRdDateTraitementNull"
                        ),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-at-rd-chart-delai-traitement",
                method: "GET",
                dataType: "json",
                success: function (response) {

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: 10,
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "30%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Mois",
                                data: [response.meanDelaiCurrentMonth],
                            },
                            {
                                name: "Cumulé",
                                data: [response.meanDelaiLast12Months],
                            },
                        ],
                        labels: ["Mois", "Cumulé"],
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector(
                            "#sinisterAtRdDelaiMoyenTraitement"
                        ),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-at-rd-chart-charge-compte-last-month",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response.chargeCompteNames);

                    // Map charge_compte_ids to their corresponding names
                    var categoriesWithNames = response.chargeCompteIds.map(
                        function (id) {
                            return response.chargeCompteNames[id] || "Unknown";
                        }
                    );

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: true,
                            toolbar: { show: false },
                        },
                        plotOptions: {
                            bar: { horizontal: false, columnWidth: "55%" },
                        },
                        series: [
                            {
                                name: "Instance",
                                data: response.nullDateTraitementCount,
                            },
                            {
                                name: "Sorties",
                                data: response.dateTraitementCount,
                            },
                            {
                                name: "Entrées",
                                data: response.dateRemiseCount,
                            },
                        ],
                        xaxis: {
                            categories: categoriesWithNames,
                            labels: {
                                style: {
                                    fontSize: "12px",
                                },
                            },
                        },
                        legend: {
                            fontSize: "12px",
                        },
                        yaxis: {
                            title: {
                                text: "Comte",
                            },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector(
                            "#sinisterAtRdChartByChargeCompte"
                        ),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-at-rd-chart-charge-compte-last-twelve-month",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response.chargeCompteNames);

                    // Map charge_compte_ids to their corresponding names
                    var categoriesWithNames = response.chargeCompteIds.map(
                        function (id) {
                            return response.chargeCompteNames[id] || "Unknown";
                        }
                    );

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: true,
                            toolbar: { show: false },
                        },
                        plotOptions: {
                            bar: { horizontal: false, columnWidth: "55%" },
                        },
                        series: [
                            {
                                name: "Instance",
                                data: response.nullDateTraitementCount,
                            },
                            {
                                name: "Sorties",
                                data: response.dateTraitementCount,
                            },
                            {
                                name: "Entrées",
                                data: response.dateRemiseCount,
                            },
                        ],
                        xaxis: {
                            categories: categoriesWithNames,
                            labels: {
                                style: {
                                    fontSize: "12px",
                                },
                            },
                        },
                        legend: {
                            fontSize: "12px",
                        },
                        yaxis: {
                            title: {
                                text: "Comte",
                            },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector(
                            "#sinisterAtRdChartChargeCompteTwelve"
                        ),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chart;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-at-rd-mean-delai-traitement-by-charge-compte", // Adjust the URL to match your route
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log("Response:", response);

                    var categoriesWithNames = response.chargeCompteIds.map(
                        function (id) {
                            return response.chargeCompteNames[id] || "Unknown";
                        }
                    );

                    // console.log("Current Month Data:", response.meanDelaiTraitementCurrentMonth);
                    // console.log("Last 12 Months Data:", response.meanDelaiTraitementLast12Months);

                    // Convert string values to numbers
                    var currentMonthData = Object.values(
                        response.meanDelaiTraitementCurrentMonth
                    ).map(parseFloat);
                    var last12MonthsData = Object.values(
                        response.meanDelaiTraitementLast12Months
                    ).map(parseFloat);
                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        plotOptions: {
                            bar: { horizontal: false, columnWidth: "55%" },
                        },
                        series: [
                            {
                                name: "Mois",
                                data: currentMonthData,
                            },
                            {
                                name: "Cumulé",
                                data: last12MonthsData,
                            },
                        ],
                        xaxis: {
                            categories: categoriesWithNames,
                            labels: {
                                style: {
                                    fontSize: "12px",
                                },
                            },
                        },
                        legend: {
                            fontSize: "12px",
                        },
                        yaxis: {
                            title: {
                                text: "Délai moyen de traitement en Jours",
                            },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chart) {
                        chart.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chart = new ApexCharts(
                        document.querySelector(
                            "#meanDelaiTraitementGlobalSinisterAtRd"
                        ),
                        optionsBar
                    );
                    chart.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    // ==============================

    // Sinister DIM details ============== //

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-dim-chart-date-remise",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response);

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: 10,
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "30%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Mois",
                                data: [response.lastMonthData],
                            },
                            {
                                name: "Cumulé",
                                data: [response.last12MonthsData],
                            },
                        ],
                        labels: ["Mois", "Cumulé"],
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector("#sinisterDimRemis"),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    // sinister date de remise

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-dim-chart-date-traitement",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response);

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: 10,
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "30%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Mois",
                                data: [response.lastMonthData],
                            },
                            {
                                name: "Cumulé",
                                data: [response.last12MonthsData],
                            },
                        ],
                        labels: ["Mois", "Cumulé"],
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector("#sinisterDimDateTraitement"),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-dim-chart-date-traitement-null",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response);

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: 10,
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "30%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Mois",
                                data: [response.lastMonthData],
                            },
                            {
                                name: "Cumulé",
                                data: [response.last12MonthsData],
                            },
                        ],
                        labels: ["Mois", "Cumulé"],
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector(
                            "#sinisterDimDateTraitementNull"
                        ),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-dim-chart-delai-traitement",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response);

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: 10,
                            style: {
                                fontSize: "20px",
                                colors: ["#FFFFFF"],
                            },
                        },
                        plotOptions: {
                            bar: { columnWidth: "30%", endingShape: "flat" },
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        series: [
                            {
                                name: "Mois",
                                data: [response.meanDelaiCurrentMonth],
                            },
                            {
                                name: "Cumulé",
                                data: [response.meanDelaiLast12Months],
                            },
                        ],
                        labels: ["Mois", "Cumulé"],
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#777",
                                },
                            },
                        },
                        title: {
                            text: "",
                            align: "left",
                            style: { fontSize: "18px" },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector(
                            "#sinisterDimDelaiMoyenTraitement"
                        ),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-dim-chart-charge-compte-last-month",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response.chargeCompteNames);

                    // Map charge_compte_ids to their corresponding names
                    var categoriesWithNames = response.chargeCompteIds.map(
                        function (id) {
                            return response.chargeCompteNames[id] || "Unknown";
                        }
                    );

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: true,
                            toolbar: { show: false },
                        },
                        plotOptions: {
                            bar: { horizontal: false, columnWidth: "55%" },
                        },
                        series: [
                            {
                                name: "Instance",
                                data: response.nullDateTraitementCount,
                            },
                            {
                                name: "Sorties",
                                data: response.dateTraitementCount,
                            },
                            {
                                name: "Entrées",
                                data: response.dateRemiseCount,
                            },
                        ],
                        xaxis: {
                            categories: categoriesWithNames,
                            labels: {
                                style: {
                                    fontSize: "12px",
                                },
                            },
                        },
                        legend: {
                            fontSize: "12px",
                        },
                        yaxis: {
                            title: {
                                text: "Comte",
                            },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector(
                            "#sinisterDimChartByChargeCompte"
                        ),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-dim-chart-charge-compte-last-twelve-month",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response.chargeCompteNames);

                    // Map charge_compte_ids to their corresponding names
                    var categoriesWithNames = response.chargeCompteIds.map(
                        function (id) {
                            return response.chargeCompteNames[id] || "Unknown";
                        }
                    );

                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: true,
                            toolbar: { show: false },
                        },
                        plotOptions: {
                            bar: { horizontal: false, columnWidth: "55%" },
                        },
                        series: [
                            {
                                name: "Instance",
                                data: response.nullDateTraitementCount,
                            },
                            {
                                name: "Sorties",
                                data: response.dateTraitementCount,
                            },
                            {
                                name: "Entrées",
                                data: response.dateRemiseCount,
                            },
                        ],
                        xaxis: {
                            categories: categoriesWithNames,
                            labels: {
                                style: {
                                    fontSize: "12px",
                                },
                            },
                        },
                        legend: {
                            fontSize: "12px",
                        },
                        yaxis: {
                            title: {
                                text: "Comte",
                            },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chartBar) {
                        chartBar.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chartBar = new ApexCharts(
                        document.querySelector(
                            "#sinisterDimChartChargeCompteTwelve"
                        ),
                        optionsBar
                    );
                    chartBar.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chart;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/sinister-dim-mean-delai-traitement-by-charge-compte", // Adjust the URL to match your route
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log("Response:", response);

                    var categoriesWithNames = response.chargeCompteIds.map(function (id) {
                        return response.chargeCompteNames[id] || "Unknown";
                    });
                
                    // console.log("Mois:", response.meanDelaiTraitementCurrentMonth);
                    // console.log("Cumule:", response.meanDelaiTraitementLast12Months);
                
                    // Convert string values to numbers
                    var currentMonthData = Object.values(response.meanDelaiTraitementCurrentMonth).map(parseFloat);
                    var last12MonthsData = Object.values(response.meanDelaiTraitementLast12Months).map(parseFloat);
                    var optionsBar = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: false,
                            toolbar: { show: false },
                        },
                        plotOptions: {
                            bar: { horizontal: false, columnWidth: "55%" },
                        },
                        series: [
                            {
                                name: "Mois",
                                data: currentMonthData,
                            },
                            {
                                name: "Cumulé",
                                data: last12MonthsData,
                            },
                        ],
                        xaxis: {
                            categories: categoriesWithNames,
                            labels: {
                                style: {
                                    fontSize: "12px",
                                },
                            },
                        },
                        legend: {
                            fontSize: "12px",
                        },
                        yaxis: {
                            title: {
                                text: "Délai moyen de traitement en Jours",
                            },
                        },
                    };

                    // Destroy the existing chart before rendering a new one
                    if (chart) {
                        chart.destroy();
                    }

                    // Use the global variable instead of redeclaring it
                    chart = new ApexCharts(
                        document.querySelector(
                            "#meanDelaiTraitementGlobalSinisterDim"
                        ),
                        optionsBar
                    );
                    chart.render();
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        fetchAndRefreshChart();

        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });


    // ======== 3-	Données par Actes regroupés ======== // production
    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;
    
        function fetchAndRefreshChart() {
            // Ajax request to fetch data from the server
            $.ajax({
                url: "/total-act-gestion-by-categorie-month", // Replace with your actual API endpoint
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // Check if response is an object
                    if (typeof response === "object" && response !== null) {
                        // Configuration for the bar chart
                        var optionsBar = {
                            chart: {
                                type: "bar",
                                height: 350,
                                toolbar: { show: false },
                            },
                            plotOptions: {
                                bar: { horizontal: false, columnWidth: "40%" },
                            },
                            series: [
                                {
                                    name: "Entrées",
                                    data: response.entryCounts,
                                },
                                {
                                    name: "Sorties",
                                    data: response.outgoingCounts,
                                },
                                {
                                    name: "Instances",
                                    data: response.instanceCounts,
                                },
                            ],
                            xaxis: {
                                categories: response.categories,
                                labels: {
                                    style: {
                                        fontSize: "12px",
                                    },
                                },
                            },
                            legend: {
                                fontSize: "12px",
                            },
                            yaxis: {
                                title: {
                                    text: "Total",
                                },
                            },
                        };
    
                        // Destroy the existing chart before rendering a new one
                        if (chartBar) {
                            chartBar.destroy();
                        }
    
                        // Create a new chart instance
                        chartBar = new ApexCharts(
                            document.querySelector("#acteGestionMois"),
                            optionsBar
                        );
    
                        // Render the chart
                        chartBar.render();
                    } else {
                        console.error(
                            "Invalid response format. Expected an object."
                        );
                    }
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                    console.log("Status:", error.status);
                    console.log("Response Text:", error.responseText);
                },
            });
        }
     // Initial fetch and render
     fetchAndRefreshChart();
        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    
       
    });


    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/total-act-gestion-by-category-twelve-month", // Replace with your actual Laravel route
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // Check if response is an object
                    if (typeof response === "object" && response !== null) {
                        // Configuration for the bar chart
                        var optionsBar = {
                            chart: {
                                type: "bar",
                                height: 350,
                                toolbar: { show: false },
                            },
                            plotOptions: {
                                bar: { horizontal: false, columnWidth: "40%" },
                            },
                            series: [
                                {
                                    name: "Entrées",
                                    data: response.entryCounts,
                                },
                                {
                                    name: "Sorties",
                                    data: response.outgoingCounts,
                                },
                                {
                                    name: "Instances",
                                    data: response.instanceCounts,
                                },
                            ],
                            xaxis: {
                                categories: response.categories,
                                labels: {
                                    style: {
                                        fontSize: "12px",
                                    },
                                },
                            },
                            legend: {
                                fontSize: "12px",
                            },
                            yaxis: {
                                title: {
                                    text: "Total",
                                },
                            },
                        };
    
                        // Destroy the existing chart before rendering a new one
                        if (chartBar) {
                            chartBar.destroy();
                        }
    
                        // Create a new chart instance
                        chartBar = new ApexCharts(
                            document.querySelector("#acteGestionTwelveMois"),
                            optionsBar
                        );
    
                        // Render the chart
                        chartBar.render();
                    } else {
                        console.error(
                            "Invalid response format. Expected an object."
                        );
                    }
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                    console.log("Status:", error.status);
                    console.log("Response Text:", error.responseText);
                },
            });
        };
        // Initial fetch and render
     fetchAndRefreshChart();
     // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
     setInterval(fetchAndRefreshChart, 30000);
 
    
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;
    
        function fetchAndRefreshChart() {
            $.ajax({
                url: "/production-act-gestion-group-average-month", // Replace with your actual Laravel route
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // Check if response is an object
                    if (typeof response === "object" && response !== null) {
                        var currentMonthData = response.current_month_average || {};
                        var lastTwelveMonthsData = response.last_twelve_months_average || {};
    
                        var categories = Object.keys({ ...currentMonthData, ...lastTwelveMonthsData });
    
                        // Sort categories based on alphabetical order
                        categories.sort();
    
                        var currentMonthAverage = categories.map(category => currentMonthData[category] || null);
                        var lastTwelveMonthsAverage = categories.map(category => lastTwelveMonthsData[category] || null);
    
                        // Configuration for the bar chart
                        var optionsBar = {
                            chart: {
                                type: "bar",
                                height: 350,
                                toolbar: { show: false },
                            },
                            plotOptions: {
                                bar: { horizontal: false, columnWidth: "60%" },
                            },
                            series: [
                                {
                                    name: "La moyenne de mois",
                                    data: currentMonthAverage,
                                },
                                {
                                    name: "La moyenne cumulée",
                                    data: lastTwelveMonthsAverage,
                                },
                            ],
                            xaxis: {
                                categories: categories,
                                labels: {
                                    style: {
                                        fontSize: "12px",
                                    },
                                   
                                },
                            },
                            legend: {
                                fontSize: "12px",
                            },
                            yaxis: {
                                title: {
                                    text: "Moyenne par actes de gestion",
                                },
                                labels: {
                                    formatter: function (value) {
                                        return parseFloat(value).toFixed(2);
                                    },
                                },
                            },
                        };
    
                        // Destroy the existing chart before rendering a new one
                        if (chartBar) {
                            chartBar.destroy();
                        }
    
                        // Create a new chart instance
                        chartBar = new ApexCharts(
                            document.querySelector("#acteGestionAverageCurrentMois"),
                            optionsBar
                        );
    
                        // Render the chart
                        chartBar.render();
                    } else {
                        console.error("Invalid response format. Expected an object.");
                    }
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
    
                    // Log the status and response text
                    console.log("Status:", error.status);
                    console.log("Response Text:", error.responseText);
                },
            });
        }
    
        fetchAndRefreshChart();
    
        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });


    // ======== 3-	Données par Actes regroupés ======== // sinister dim
    
    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;
    
        function fetchAndRefreshChart() {
            // Ajax request to fetch data from the server
            $.ajax({
                url: "/total-act-gestion-by-categorie-month-dim", // Replace with your actual API endpoint
                method: "GET",
                dataType: "json",
                 success: function (response) {
                    // Check if response is an object
                    if (typeof response === "object" && response !== null) {
                        // Configuration for the bar chart
                        var optionsBar = {
                            chart: {
                                type: "bar",
                                height: 350,
                                toolbar: { show: false },
                            },
                            plotOptions: {
                                bar: { horizontal: false, columnWidth: "40%" },
                            },
                            series: [
                                {
                                    name: "Entrées",
                                    data: response.entryCounts,
                                },
                                {
                                    name: "Sorties",
                                    data: response.outgoingCounts,
                                },
                                {
                                    name: "Instances",
                                    data: response.instanceCounts,
                                },
                            ],
                            xaxis: {
                                categories: response.categories,
                                labels: {
                                    style: {
                                        fontSize: "12px",
                                    },
                                },
                            },
                            legend: {
                                fontSize: "12px",
                            },
                            yaxis: {
                                title: {
                                    text: "Total",
                                },
                            },
                        };
    
                        // Destroy the existing chart before rendering a new one
                        if (chartBar) {
                            chartBar.destroy();
                        }
    
                        // Create a new chart instance
                        chartBar = new ApexCharts(
                            document.querySelector("#acteGestionMoisDim"),
                            optionsBar
                        );
    
                        // Render the chart
                        chartBar.render();
                    } else {
                        console.error(
                            "Invalid response format. Expected an object."
                        );
                    }
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                    console.log("Status:", error.status);
                    console.log("Response Text:", error.responseText);
                },
            });
        }
     // Initial fetch and render
     fetchAndRefreshChart();
        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
                       
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/total-act-gestion-by-category-twelve-month-dim", // Replace with your actual Laravel route
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // Check if response is an object
                    if (typeof response === "object" && response !== null) {
                        // Configuration for the bar chart
                        var optionsBar = {
                            chart: {
                                type: "bar",
                                height: 350,
                                toolbar: { show: false },
                            },
                            plotOptions: {
                                bar: { horizontal: false, columnWidth: "40%" },
                            },
                            series: [
                                {
                                    name: "Entries",
                                    data: response.entryCounts,
                                },
                                {
                                    name: "Outings",
                                    data: response.outgoingCounts,
                                },
                                {
                                    name: "Instances",
                                    data: response.instanceCounts,
                                },
                            ],
                            xaxis: {
                                categories: response.categories,
                                labels: {
                                    style: {
                                        fontSize: "12px",
                                    },
                                },
                            },
                            legend: {
                                fontSize: "12px",
                            },
                            yaxis: {
                                title: {
                                    text: "Total",
                                },
                            },
                        };
    
                        // Destroy the existing chart before rendering a new one
                        if (chartBar) {
                            chartBar.destroy();
                        }
    
                        // Create a new chart instance
                        chartBar = new ApexCharts(
                            document.querySelector("#acteGestionTwelveMoisDim"),
                            optionsBar
                        );
    
                        // Render the chart
                        chartBar.render();
                    } else {
                        console.error(
                            "Invalid response format. Expected an object."
                        );
                    }
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                    console.log("Status:", error.status);
                    console.log("Response Text:", error.responseText);
                },
            });
        };
        // Initial fetch and render
     fetchAndRefreshChart();
     // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
     setInterval(fetchAndRefreshChart, 30000);
    });

    
    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;
        var desiredOrder = [
          
        ];
        function fetchAndRefreshChart() {
            $.ajax({
                url: "/act-gestion-group-average-month-dim", // Replace with your actual Laravel route
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // Check if response is an object
                    console.log(response)
                    if (typeof response === "object" && response !== null) {
                        var currentMonthData = response.current_month_average || {};
                        var lastTwelveMonthsData = response.last_twelve_months_average || {};
    
                        var categories = Object.keys({ ...currentMonthData, ...lastTwelveMonthsData });
    
                        // Sort categories based on alphabetical order
                        categories.sort();
    
                        var currentMonthAverage = categories.map(category => currentMonthData[category] || null);
                        var lastTwelveMonthsAverage = categories.map(category => lastTwelveMonthsData[category] || null);
    
                        // Configuration for the bar chart
                        var optionsBar = {
                            chart: {
                                type: "bar",
                                height: 350,
                                toolbar: { show: false },
                            },
                            plotOptions: {
                                bar: { horizontal: false, columnWidth: "60%" },
                            },
                            series: [
                                {
                                    name: "La moyenne de mois",
                                    data: currentMonthAverage,
                                },
                                {
                                    name: "La moyenne cumulée",
                                    data: lastTwelveMonthsAverage,
                                },
                            ],
                            xaxis: {
                                categories: categories,
                                labels: {
                                    style: {
                                        fontSize: "12px",
                                    },
                                },
                            },
                            legend: {
                                fontSize: "12px",
                            },
                            yaxis: {
                                title: {
                                    text: "Moyenne par actes de gestion",
                                },
                            },
                        };
    
                        // Destroy the existing chart before rendering a new one
                        if (chartBar) {
                            chartBar.destroy();
                        }
    
                        // Create a new chart instance
                        chartBar = new ApexCharts(
                            document.querySelector("#acteGestionAverageCurrentMoisDim"),
                            optionsBar
                        );
    
                        // Render the chart
                        chartBar.render();
                    } else {
                        console.error("Invalid response format. Expected an object.");
                    }
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
    
                    // Log the status and response text
                    console.log("Status:", error.status);
                    console.log("Response Text:", error.responseText);
                },
            });
        }
    
        fetchAndRefreshChart();
    
        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });


    // ======== 4-	Données par Actes regroupés ======== // sinister at rd
    
    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;
    
        function fetchAndRefreshChart() {
            // Ajax request to fetch data from the server
            $.ajax({
                url: "/total-act-gestion-by-categorie-month-atrd", // Replace with your actual API endpoint
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // Check if response is an object
                    if (typeof response === "object" && response !== null) {
                        // Configuration for the bar chart
                        var optionsBar = {
                            chart: {
                                type: "bar",
                                height: 350,
                                toolbar: { show: false },
                            },
                            plotOptions: {
                                bar: { horizontal: false, columnWidth: "40%" },
                            },
                            series: [
                                {
                                    name: "Entrées",
                                    data: response.entryCounts,
                                },
                                {
                                    name: "Sorties",
                                    data: response.outgoingCounts,
                                },
                                {
                                    name: "Instances",
                                    data: response.instanceCounts,
                                },
                            ],
                            xaxis: {
                                categories: response.categories,
                                labels: {
                                    style: {
                                        fontSize: "12px",
                                    },
                                },
                            },
                            legend: {
                                fontSize: "12px",
                            },
                            yaxis: {
                                title: {
                                    text: "Total",
                                },
                            },
                        };
    
                        // Destroy the existing chart before rendering a new one
                        if (chartBar) {
                            chartBar.destroy();
                        }
                        // Create a new chart instance
                        chartBar = new ApexCharts(
                            document.querySelector("#acteGestionMoisAtRd"),
                            optionsBar
                        );
    
                        // Render the chart
                        chartBar.render();
                    } else {
                        console.error(
                            "Invalid response format. Expected an object."
                        );
                    }
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                    console.log("Status:", error.status);
                    console.log("Response Text:", error.responseText);
                },
            });
        }
    
        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    
        // Initial fetch and render
        fetchAndRefreshChart();
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;

        function fetchAndRefreshChart() {
            $.ajax({
                url: "/total-act-gestion-by-category-twelve-month-atrd", // Replace with your actual Laravel route
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // Check if response is an object
                    if (typeof response === "object" && response !== null) {
                        // Configuration for the bar chart
                        var optionsBar = {
                            chart: {
                                type: "bar",
                                height: 350,
                                toolbar: { show: false },
                            },
                            plotOptions: {
                                bar: { horizontal: false, columnWidth: "40%" },
                            },
                            series: [
                                {
                                    name: "Entrées",
                                    data: response.entryCounts,
                                },
                                {
                                    name: "Sorties",
                                    data: response.outgoingCounts,
                                },
                                {
                                    name: "Instances",
                                    data: response.instanceCounts,
                                },
                            ],
                            xaxis: {
                                categories: response.categories,
                                labels: {
                                    style: {
                                        fontSize: "12px",
                                    },
                                },
                            },
                            legend: {
                                fontSize: "12px",
                            },
                            yaxis: {
                                title: {
                                    text: "Total",
                                },
                            },
                        };
    
                        // Destroy the existing chart before rendering a new one
                        if (chartBar) {
                            chartBar.destroy();
                        }
    
                        // Create a new chart instance
                        chartBar = new ApexCharts(
                            document.querySelector("#acteGestionTwelveMoisAtRd"),
                            optionsBar
                        );
    
                        // Render the chart
                        chartBar.render();
                    } else {
                        console.error(
                            "Invalid response format. Expected an object."
                        );
                    }
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                    console.log("Status:", error.status);
                    console.log("Response Text:", error.responseText);
                },
            });
        };
        // Initial fetch and render
     fetchAndRefreshChart();
     // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
     setInterval(fetchAndRefreshChart, 30000);
          
                  
    });

    $(document).ready(function () {
        // Variable to store the chart instance
        var chartBar;
        var desiredOrder = [
            "Attestations de salaire et documents administratifs",
            "Certificats médicaux et rapports",
            "Déclaration de sinistre",
            "Chèques et quittances de règlement",
            // Add more categories in the desired order
        ];
        function fetchAndRefreshChart() {
            $.ajax({
                url: "/act-gestion-group-average-month-atrd", // Replace with your actual Laravel route
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // Check if response is an object
                    // console.log(response)
                    if (typeof response === "object" && response !== null) {
                        var currentMonthData = response.current_month_average || {};
                        var lastTwelveMonthsData = response.last_twelve_months_average || {};
    
                        var categories = Object.keys({ ...currentMonthData, ...lastTwelveMonthsData });
    
                        // Sort categories based on alphabetical order
                        categories.sort();
    
                        var currentMonthAverage = categories.map(category => currentMonthData[category] || null);
                        var lastTwelveMonthsAverage = categories.map(category => lastTwelveMonthsData[category] || null);
    
                        // Configuration for the bar chart
                        var optionsBar = {
                            chart: {
                                type: "bar",
                                height: 350,
                                toolbar: { show: false },
                            },
                            plotOptions: {
                                bar: { horizontal: false, columnWidth: "60%" },
                            },
                            series: [
                                {
                                    name: "La moyenne de mois",
                                    data: currentMonthAverage,
                                },
                                {
                                    name: "La moyenne cumulée",
                                    data: lastTwelveMonthsAverage,
                                },
                            ],
                            xaxis: {
                                categories: categories,
                                labels: {
                                    style: {
                                        fontSize: "12px",
                                    },
                                },
                            },
                            legend: {
                                fontSize: "12px",
                            },
                            yaxis: {
                                title: {
                                    text: "Moyenne par actes de gestion",
                                },
                            },
                        };
    
                        // Destroy the existing chart before rendering a new one
                        if (chartBar) {
                            chartBar.destroy();
                        }
    
                        // Create a new chart instance
                        chartBar = new ApexCharts(
                            document.querySelector("#acteGestionAverageCurrentMoisAtRd"),
                            optionsBar
                        );
    
                        // Render the chart
                        chartBar.render();
                    } else {
                        console.error("Invalid response format. Expected an object.");
                    }
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
    
                    // Log the status and response text
                    console.log("Status:", error.status);
                    console.log("Response Text:", error.responseText);
                },
            });
        }
    
        fetchAndRefreshChart();
    
        // Set up a timer to refresh the chart periodically (e.g., every 30 seconds)
        setInterval(fetchAndRefreshChart, 30000);
    });

    // if ($("#s-line").length > 0) {
    //     var sline = {
    //         chart: {
    //             height: 350,
    //             type: "line",
    //             zoom: { enabled: false },
    //             toolbar: { show: false },
    //         },
    //         dataLabels: { enabled: false },
    //         stroke: { curve: "straight" },
    //         series: [
    //             {
    //                 name: "Desktops",
    //                 data: [10, 41, 35, 51, 49, 62, 69, 91, 148],
    //             },
    //         ],
    //         title: { text: "Product Trends by Month", align: "left" },
    //         grid: { row: { colors: ["#f1f2f3", "transparent"], opacity: 0.5 } },
    //         xaxis: {
    //             categories: [
    //                 "Jan",
    //                 "Feb",
    //                 "Mar",
    //                 "Apr",
    //                 "May",
    //                 "Jun",
    //                 "Jul",
    //                 "Aug",
    //                 "Sep",
    //             ],
    //         },
    //     };
    //     var chart = new ApexCharts(document.querySelector("#s-line"), sline);
    //     chart.render();
    // }
});

// if ($("#s-line-area").length > 0) {
//     var sLineArea = {
//         chart: { height: 350, type: "area", toolbar: { show: false } },
//         dataLabels: { enabled: false },
//         stroke: { curve: "smooth" },
//         series: [
//             { name: "series1", data: [31, 40, 28, 51, 42, 109, 100] },
//             { name: "series2", data: [11, 32, 45, 32, 34, 52, 41] },
//         ],
//         xaxis: {
//             type: "datetime",
//             categories: [
//                 "2018-09-19T00:00:00",
//                 "2018-09-19T01:30:00",
//                 "2018-09-19T02:30:00",
//                 "2018-09-19T03:30:00",
//                 "2018-09-19T04:30:00",
//                 "2018-09-19T05:30:00",
//                 "2018-09-19T06:30:00",
//             ],
//         },
//         tooltip: { x: { format: "dd/MM/yy HH:mm" } },
//     };
//     var chart = new ApexCharts(
//         document.querySelector("#s-line-area"),
//         sLineArea
//     );
//     chart.render();
// }

// if ($("#s-col").length > 0) {
//     var sCol = {
//         chart: { height: 350, type: "bar", toolbar: { show: false } },
//         plotOptions: {
//             bar: {
//                 horizontal: false,
//                 columnWidth: "55%",
//                 endingShape: "rounded",
//             },
//         },
//         dataLabels: { enabled: false },
//         stroke: { show: true, width: 2, colors: ["transparent"] },
//         series: [
//             { name: "Net Profit", data: [44, 55, 57, 56, 61, 58, 63, 60, 66] },
//             { name: "Revenue", data: [76, 85, 101, 98, 87, 105, 91, 114, 94] },
//         ],
//         xaxis: {
//             categories: [
//                 "Feb",
//                 "Mar",
//                 "Apr",
//                 "May",
//                 "Jun",
//                 "Jul",
//                 "Aug",
//                 "Sep",
//                 "Oct",
//             ],
//         },
//         yaxis: { title: { text: "$ (thousands)" } },
//         fill: { opacity: 1 },
//         tooltip: {
//             y: {
//                 formatter: function (val) {
//                     return "$ " + val + " thousands";
//                 },
//             },
//         },
//     };
//     var chart = new ApexCharts(document.querySelector("#s-col"), sCol);
//     chart.render();
// }

// if ($("#s-col-stacked").length > 0) {
//     var sColStacked = {
//         chart: {
//             height: 350,
//             type: "bar",
//             stacked: true,
//             toolbar: { show: false },
//         },
//         responsive: [
//             {
//                 breakpoint: 480,
//                 options: {
//                     legend: { position: "bottom", offsetX: -10, offsetY: 0 },
//                 },
//             },
//         ],
//         plotOptions: { bar: { horizontal: false } },
//         series: [
//             { name: "PRODUCT A", data: [44, 55, 41, 67, 22, 43] },
//             { name: "PRODUCT B", data: [13, 23, 20, 8, 13, 27] },
//             { name: "PRODUCT C", data: [11, 17, 15, 15, 21, 14] },
//             { name: "PRODUCT D", data: [21, 7, 25, 13, 22, 8] },
//         ],
//         xaxis: {
//             type: "datetime",
//             categories: [
//                 "01/01/2011 GMT",
//                 "01/02/2011 GMT",
//                 "01/03/2011 GMT",
//                 "01/04/2011 GMT",
//                 "01/05/2011 GMT",
//                 "01/06/2011 GMT",
//             ],
//         },
//         legend: { position: "right", offsetY: 40 },
//         fill: { opacity: 1 },
//     };
//     var chart = new ApexCharts(
//         document.querySelector("#s-col-stacked"),
//         sColStacked
//     );
//     chart.render();
// }

// if ($("#s-bar").length > 0) {
//     var sBar = {
//         chart: { height: 350, type: "bar", toolbar: { show: false } },
//         plotOptions: { bar: { horizontal: true } },
//         dataLabels: { enabled: false },
//         series: [
//             { data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380] },
//         ],
//         xaxis: {
//             categories: [
//                 "South Korea",
//                 "Canada",
//                 "United Kingdom",
//                 "Netherlands",
//                 "Italy",
//                 "France",
//                 "Japan",
//                 "United States",
//                 "China",
//                 "Germany",
//             ],
//         },
//     };
//     var chart = new ApexCharts(document.querySelector("#s-bar"), sBar);
//     chart.render();
// }

// if ($("#mixed-chart").length > 0) {
//     var options = {
//         chart: { height: 350, type: "line", toolbar: { show: false } },
//         series: [
//             {
//                 name: "Website Blog",
//                 type: "column",
//                 data: [
//                     440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160,
//                 ],
//             },
//             {
//                 name: "Social Media",
//                 type: "line",
//                 data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16],
//             },
//         ],
//         stroke: { width: [0, 4] },
//         title: { text: "Traffic Sources" },
//         labels: [
//             "01 Jan 2001",
//             "02 Jan 2001",
//             "03 Jan 2001",
//             "04 Jan 2001",
//             "05 Jan 2001",
//             "06 Jan 2001",
//             "07 Jan 2001",
//             "08 Jan 2001",
//             "09 Jan 2001",
//             "10 Jan 2001",
//             "11 Jan 2001",
//             "12 Jan 2001",
//         ],
//         xaxis: { type: "datetime" },
//         yaxis: [
//             { title: { text: "Website Blog" } },
//             { opposite: true, title: { text: "Social Media" } },
//         ],
//     };
//     var chart = new ApexCharts(document.querySelector("#mixed-chart"), options);
//     chart.render();
// }

// if ($("#donut-chart").length > 0) {
//     var donutChart = {
//         chart: { height: 350, type: "donut", toolbar: { show: false } },
//         series: [44, 55, 41, 17],
//         responsive: [
//             {
//                 breakpoint: 480,
//                 options: {
//                     chart: { width: 200 },
//                     legend: { position: "bottom" },
//                 },
//             },
//         ],
//     };
//     var donut = new ApexCharts(
//         document.querySelector("#donut-chart"),
//         donutChart
//     );
//     donut.render();
// }

// if ($("#radial-chart").length > 0) {
//     var radialChart = {
//         chart: { height: 350, type: "radialBar", toolbar: { show: false } },
//         plotOptions: {
//             radialBar: {
//                 dataLabels: {
//                     name: { fontSize: "22px" },
//                     value: { fontSize: "16px" },
//                     total: {
//                         show: true,
//                         label: "Total",
//                         formatter: function (w) {
//                             return 249;
//                         },
//                     },
//                 },
//             },
//         },
//         series: [44, 55, 67, 83],
//         labels: ["Apples", "Oranges", "Bananas", "Berries"],
//     };
//     var chart = new ApexCharts(
//         document.querySelector("#radial-chart"),
//         radialChart
//     );
//     chart.render();
// }
