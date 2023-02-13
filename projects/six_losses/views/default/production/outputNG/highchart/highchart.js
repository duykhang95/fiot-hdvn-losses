//Chart 1
Highcharts.chart("oee-overrall-summary", {
  chart: {
    // type: "column",
  },
  title: {
    text: null,
  },
  subtitle: {
    text: null,
  },
  credits: {
    enabled: false,
  },
  xAxis: {
    categories: [
      "3/1/2021",
      "3/2/2021",
      "3/3/2021",
      "3/4/2021",
      "3/5/2021",
      "3/6/2021",
      "3/7/2021",
      "3/8/2021",
      "3/9/2021",
      "3/10/2021",
      "3/11/2021",
      "3/12/2021",
      "3/13/2021",
      "3/14/2021",
      "3/15/2021",
      "3/16/2021",
      "3/17/2021",
      "3/18/2021",
      "3/19/2021",
      "3/20/2021",
      "3/21/2021",
      "3/22/2021",
      "3/23/2021",
      "3/24/2021",
      "3/25/2021",
      "3/26/2021",
      "3/27/2021",
      "3/28/2021",
      "3/29/2021",
      "3/30/2021",
      "3/31/2021",
    ],
    crosshair: true,
  },
  yAxis: {
    title: {
      useHTML: true,
      text: null,
    },
    min: 0,
    max: 120,
    labels: {
      format: "{value.2f}%",
    },
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat:
      '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.2f}%</b></td></tr>',
    footerFormat: "</table>",
    shared: true,
    useHTML: true,
  },
  legend: {
    backgroundColor: null,
    itemStyle: {
      color: "black",
      fontWeight: "bold",
      fontSize: 20,
    },
    // layout: 'vertical',
    // align: 'top',
    verticalAlign: "bottom",
    align: "center",

    enabled: true,
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0,
    },
  },
  series: [
    {
      name: "OEE",
      type: "column",
      data: [
        9, 10, 26, 7, 1, 46, 45, 56, 2, 52, 57, 38, 48, 12, 1, 49, 35, 38, 19,
        34, 39, 48, 44, 56, 27, 6, 20, 25, 37, 30, 51,
      ],
      color: "#ffad33",
    },
    {
      name: "Availability",
      type: "line",
      marker: false,
      lineWidth: 6,
      data: [
        76, 45, 45, 52, 62, 63, 66, 76, 78, 51, 54, 76, 44, 41, 60, 70, 59, 53,
        53, 79, 44, 73, 50, 72, 40, 63, 49, 63, 61, 75, 60,
      ],
      color: "#005ce6",
    },
    {
      name: "Quality",
      type: "line",
      marker: false,
      lineWidth: 6,
      data: [
        94, 93, 98, 97, 96, 97, 94, 90, 92, 95, 97, 98, 98, 94, 93, 90, 90, 93,
        99, 98, 93, 93, 90, 100, 99, 100, 99, 100, 94, 97, 90,
      ],
      color: "#ff6633",
    },
    {
      name: "Performance",
      type: "line",
      marker: false,
      lineWidth: 6,
      data: [
        44, 79, 40, 65, 59, 80, 43, 47, 44, 69, 64, 62, 43, 40, 72, 68, 56, 76,
        51, 71, 79, 48, 46, 64, 79, 75, 68, 67, 71, 79, 44,
      ],
      color: "#737373",
    },
  ],
});

//Chart 2

Highcharts.chart("output-summary", {
  chart: {
    // type: "column",
  },
  title: {
    text: null,
  },
  subtitle: {
    text: null,
  },
  credits: {
    enabled: false,
  },
  xAxis: {
    categories: [
      "07:00",
      "08:00",
      "09:00",
      "10:00",
      "11:00",
      "12:00",
      "13:00",
      "14:00",
      "15:00",
      "16:00",
      "17:00",
      "18:00",
      "19:00",
      "20:00",
      "21:00",
      "22:00",
      "23:00",
      "00:00",
      "01:00",
      "02:00",
      "03:00",
      "04:00",
      "05:00",
      "06:00",
    ],
    crosshair: true,
  },
  yAxis: {
    title: {
      useHTML: true,
      text: null,
    },
    labels: {
      format: "{value}pcs",
    },
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat:
      '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y}pcs</b></td></tr>',
    footerFormat: "</table>",
    shared: true,
    useHTML: true,
  },
  legend: {
    backgroundColor: null,
    itemStyle: {
      color: "black",
      fontWeight: "bold",
      fontSize: 20,
    },
    // layout: 'vertical',
    // align: 'top',
    verticalAlign: "bottom",
    align: "center",

    enabled: true,
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0,
    },
  },
  series: [
    {
      name: "Actual",
      type: "column",
      data: [
        57, 76, 45, 13, 50, 25, 37, 32, 22, 24, 72, 46, 29, 59, 45, 37, 75, 74,
        73, 28, 70, 37, 67, 22,
      ],
      color: "#e62e00",
    },
    {
      name: "Target",
      type: "line",
      marker: false,
      lineWidth: 6,
      data: [
        98, 87, 78, 72, 78, 88, 76, 87, 76, 84, 96, 93, 76, 89, 90, 92, 92, 81,
        70, 92, 83, 80, 83, 78,
      ],
      color: "#005ce6",
    },
  ],
});

// chart 3
Highcharts.chart("availability-time-summary", {
  chart: {
    type: "column",
  },
  title: {
    text: null,
  },
  subtitle: {
    text: null,
  },
  legend: {
    backgroundColor: null,
    itemStyle: {
      color: "black",
      fontWeight: "bold",
      fontSize: 20,
    },
    // layout: 'vertical',
    // align: 'top',
    verticalAlign: "bottom",
    align: "center",

    enabled: true,
  },
  credits: {
    enabled: false,
  },
  xAxis: {
    categories: [
      "07:00",
      "08:00",
      "09:00",
      "10:00",
      "11:00",
      "12:00",
      "13:00",
      "14:00",
      "15:00",
      "16:00",
      "17:00",
      "18:00",
      "19:00",
      "20:00",
      "21:00",
      "22:00",
      "23:00",
      "00:00",
      "01:00",
      "02:00",
      "03:00",
      "04:00",
      "05:00",
      "06:00",
    ],
  },
  yAxis: {
    min: 0,
    max: 100,
    title: {
      text: null,
    },
    labels: {
      format: "{value:.2f}%",
    },
  },
  tooltip: {
    pointFormat:
      '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}p</b> ({point.percentage:.2f}%)<br/>',
    shared: true,
  },
  plotOptions: {
    column: {
      stacking: "percent",
    },
  },
  series: [
    {
      name: "A1",
      data: [
        2, 1, 5, 6, 1, 4, 4, 4, 9, 1, 6, 4, 2, 0, 1, 10, 6, 8, 6, 6, 5, 3, 3, 2,
      ],
    },
    {
      name: "A2",
      data: [
        5, 5, 5, 6, 6, 2, 2, 9, 4, 7, 4, 6, 3, 1, 6, 3, 7, 0, 5, 8, 3, 5, 10, 0,
      ],
    },
    {
      name: "A3",
      data: [
        2, 7, 6, 3, 1, 6, 9, 2, 2, 5, 8, 10, 5, 0, 9, 9, 2, 3, 5, 9, 0, 0, 9, 9,
      ],
    },
    {
      name: "A4",
      data: [
        6, 2, 6, 10, 0, 2, 5, 3, 7, 5, 4, 9, 8, 1, 1, 2, 4, 5, 0, 0, 8, 5, 10,
        0,
      ],
    },
    {
      name: "A5",
      data: [
        10, 7, 1, 3, 7, 5, 6, 6, 4, 10, 2, 3, 6, 10, 2, 10, 9, 4, 0, 2, 4, 4, 6,
        3,
      ],
    },
    {
      name: "Stopping",
      data: [
        2, 13, 15, 16, 14, 1, 20, 13, 5, 15, 10, 17, 2, 3, 4, 14, 13, 0, 5, 18,
        16, 0, 13, 19,
      ],
      color: "#ff0000",
    },
    {
      name: "Running",
      data: [
        90, 71, 71, 79, 74, 79, 89, 74, 84, 72, 83, 88, 70, 76, 88, 82, 80, 74,
        90, 86, 81, 87, 81, 75,
      ],
      color: "#0099ff",
    },
  ],
});

// chart 4
Highcharts.chart("availability-pareto-downtime", {
  chart: {},
  title: {
    text: null,
  },
  subtitle: {
    text: null,
  },
  legend: {
    backgroundColor: null,
    itemStyle: {
      color: "black",
      fontWeight: "bold",
      fontSize: 20,
    },
    // layout: 'vertical',
    // align: 'top',
    verticalAlign: "bottom",
    align: "center",

    enabled: true,
  },
  credits: {
    enabled: false,
  },
  xAxis: [
    {
      categories: [
        "A52 - Tool change",
        "A50 - Tool problem",
        "A54 - New tool test",
        "A40 - Missing Personel",
        "A90 - Waiting time",
        "A11 - Mechanical repair",
        "A53 - Tool setup",
        "A60 - Machine setup",
        "A92 - Machine cleaning",
        "A91 - Training of new...",
        "A30 - Missing material",
        "A20 - Electrical repair",
        "A10 - Mechanical...",
        "A51 - Missing tool",
      ],
      crosshair: true,
    },
  ],
  yAxis: [
    {
      // Primary yAxis
      labels: {
        format: "{value}",
        style: {
          color: Highcharts.getOptions().colors[1],
        },
      },
      title: {
        text: null,
        style: {
          color: Highcharts.getOptions().colors[1],
        },
      },
    },
    {
      // Secondary yAxis
      title: {
        text: null,
        style: {
          color: "#ff6633",
        },
      },
      labels: {
        format: "{value:.2f}%",
        style: {
          color: "#ff6633",
        },
      },
      opposite: true,
    },
  ],
  tooltip: {
    shared: true,
  },

  series: [
    {
      name: "Downtime",
      type: "column",

      data: [
        14200, 8200, 6300, 5900, 3800, 2550, 500, 400, 380, 350, 300, 250, 0, 0,
      ],
      tooltip: {
        valueSuffix: "s",
      },
      color: "#0000cc",
    },
    {
      name: "Accumulation",
      type: "spline",
      yAxis: 1,
      marker: false,
      lineWidth: 6,
      data: [40, 50, 60, 70, 80, 90, 92, 94, 95, 96, 97, 98, 96, 97],
      tooltip: {
        valueDecimals: 2,
        valueSuffix: "%",
      },
      color: "#ff6633",
    },
  ],
});

//Chart 5

Highcharts.chart("performance-by-time", {
  chart: {
    // type: "column",
  },
  title: {
    text: null,
  },
  subtitle: {
    text: null,
  },
  credits: {
    enabled: false,
  },
  xAxis: {
    categories: [
      "07:00",
      "08:00",
      "09:00",
      "10:00",
      "11:00",
      "12:00",
      "13:00",
      "14:00",
      "15:00",
      "16:00",
      "17:00",
      "18:00",
      "19:00",
      "20:00",
      "21:00",
      "22:00",
      "23:00",
      "00:00",
      "01:00",
      "02:00",
      "03:00",
      "04:00",
      "05:00",
      "06:00",
    ],
    crosshair: true,
  },
  yAxis: {
    title: {
      useHTML: true,
      text: null,
    },
    labels: {
      format: "{value:.2f}%",
    },
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat:
      '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.2f}%</b></td></tr>',
    footerFormat: "</table>",
    shared: true,
    useHTML: true,
  },
  legend: {
    backgroundColor: null,
    itemStyle: {
      color: "black",
      fontWeight: "bold",
      fontSize: 20,
    },
    // layout: 'vertical',
    // align: 'top',
    verticalAlign: "bottom",
    align: "center",

    enabled: true,
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0,
    },
  },
  series: [
    {
      name: "Performance by time",
      type: "column",
      data: [
        95, 76, 45, 13, 50, 25, 37, 32, 22, 24, 72, 46, 29, 59, 45, 37, 75, 74,
        73, 28, 70, 37, 67, 22,
      ],
      color: "#0000cc",
    },
  ],
});

//Chart 6

Highcharts.chart("performance-by-employee", {
  chart: {
    // type: "column",
  },
  title: {
    text: null,
  },
  subtitle: {
    text: null,
  },
  credits: {
    enabled: false,
  },
  xAxis: {
    categories: [
      "07:00",
      "08:00",
      "09:00",
      "10:00",
      "11:00",
      "12:00",
      "13:00",
      "14:00",
      "15:00",
      "16:00",
      "17:00",
      "18:00",
      "19:00",
      "20:00",
      "21:00",
      "22:00",
      "23:00",
      "00:00",
      "01:00",
      "02:00",
      "03:00",
      "04:00",
      "05:00",
      "06:00",
    ],
    crosshair: true,
  },
  yAxis: {
    title: {
      useHTML: true,
      text: null,
    },
    labels: {
      format: "{value:.2f}%",
    },
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat:
      '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.2f}%</b></td></tr>',
    footerFormat: "</table>",
    shared: true,
    useHTML: true,
  },
  legend: {
    backgroundColor: null,
    itemStyle: {
      color: "black",
      fontWeight: "bold",
      fontSize: 20,
    },
    // layout: 'vertical',
    // align: 'top',
    verticalAlign: "bottom",
    align: "center",

    enabled: true,
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0,
    },
  },
  series: [
    {
      name: "Performance by employee",
      type: "column",
      data: [
        95, 76, 45, 13, 50, 25, 37, 32, 22, 24, 72, 46, 29, 59, 45, 37, 75, 74,
        73, 28, 70, 37, 67, 22,
      ],
      color: "#0000cc",
    },
  ],
});

//Chart 7

Highcharts.chart("performance-by-product", {
  chart: {
    // type: "column",
  },
  title: {
    text: null,
  },
  subtitle: {
    text: null,
  },
  credits: {
    enabled: false,
  },
  xAxis: {
    categories: [
      "2100 - 845510",
      "2100 - 857521",
      "2100 - 484290",
      "2100 - 466838",
      "2100 - 532210",
      "2100 - 584188",
      "2100 - 430346",
      "2100 - 893468",
      "2100 - 645857",
      "2100 - 705522",
      "2100 - 317278",
      "2100 - 386092",
      "2100 - 808173",
      "2100 - 811683",
      "2100 - 864875",
      "2100 - 665209",
      "2100 - 793932",
      "2100 - 524208",
      "2100 - 735027",
      "2100 - 455167",
      "2100 - 965387",
      "2100 - 2212",
      "2100 - 350643",
      "2100 - 464044",
    ],
    crosshair: true,
  },
  yAxis: {
    title: {
      useHTML: true,
      text: null,
    },
    labels: {
      format: "{value:.2f}%",
    },
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat:
      '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.2f}%</b></td></tr>',
    footerFormat: "</table>",
    shared: true,
    useHTML: true,
  },
  legend: {
    backgroundColor: null,
    itemStyle: {
      color: "black",
      fontWeight: "bold",
      fontSize: 20,
    },
    // layout: 'vertical',
    // align: 'top',
    verticalAlign: "bottom",
    align: "center",

    enabled: true,
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0,
    },
  },
  series: [
    {
      name: "Performance by product",
      type: "column",
      data: [
        95, 76, 45, 13, 50, 25, 37, 32, 22, 24, 72, 46, 29, 59, 45, 37, 75, 74,
        73, 28, 70, 37, 67, 22,
      ],
      color: "#0000cc",
    },
  ],
});

// chart 8
Highcharts.chart("quality-by-time", {
  chart: {
    type: "column",
  },
  title: {
    text: null,
  },
  subtitle: {
    text: null,
  },
  legend: {
    backgroundColor: null,
    itemStyle: {
      color: "black",
      fontWeight: "bold",
      fontSize: 20,
    },
    // layout: 'vertical',
    // align: 'top',
    verticalAlign: "bottom",
    align: "center",

    enabled: true,
  },
  credits: {
    enabled: false,
  },
  xAxis: {
    categories: [
      "3/1/2021",
      "3/2/2021",
      "3/3/2021",
      "3/4/2021",
      "3/5/2021",
      "3/6/2021",
      "3/7/2021",
      "3/8/2021",
      "3/9/2021",
      "3/10/2021",
      "3/11/2021",
      "3/12/2021",
      "3/13/2021",
      "3/14/2021",
      "3/15/2021",
      "3/16/2021",
      "3/17/2021",
      "3/18/2021",
      "3/19/2021",
      "3/20/2021",
      "3/21/2021",
      "3/22/2021",
      "3/23/2021",
      "3/24/2021",
      "3/25/2021",
      "3/26/2021",
      "3/27/2021",
      "3/28/2021",
      "3/29/2021",
      "3/30/2021",
      "3/31/2021",
    ],
  },
  yAxis: {
    min: 0,
    max: 100,
    title: {
      text: null,
    },
    labels: {
      format: "{value:.2f}%",
    },
  },
  tooltip: {
    pointFormat:
      '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.2f}%)<br/>',
    shared: true,
  },
  plotOptions: {
    column: {
      stacking: "percent",
    },
  },
  series: [
    {
      name: "Wrong dimensions",
      data: [
        10, 7, 1, 3, 7, 5, 6, 6, 4, 10, 2, 3, 6, 10, 2, 10, 9, 4, 0, 2, 4, 4, 6,
        3, 5, 1, 3, 7, 8, 9, 1,
      ],
      color: "#737373",
    },
    {
      name: "Scratch",
      data: [
        2, 13, 15, 16, 14, 1, 20, 13, 5, 15, 10, 17, 2, 3, 4, 14, 13, 0, 5, 18,
        16, 0, 13, 19, 17, 10, 18, 19, 20, 22, 15,
      ],
      color: "#ff6633",
    },
    {
      name: "Good part",
      data: [
        90, 71, 71, 79, 74, 79, 89, 74, 84, 72, 83, 88, 70, 76, 88, 82, 80, 74,
        90, 86, 81, 87, 81, 75, 80, 87, 90, 98, 99, 96, 80,
      ],
      color: "#0000cc",
    },
  ],
});
