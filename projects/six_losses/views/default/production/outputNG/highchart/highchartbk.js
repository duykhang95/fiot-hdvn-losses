/* global Chart:false */

$(function () {
  "use strict";

  var ticksStyle = {
    fontColor: "#495057",
    fontStyle: "bold",
  };

  var mode = "index";
  var intersect = true;

  var $visitorsChart = $("#visitors-chart");
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: [
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
      plotOptions: {
        series: {
          marker: {
            enabled: false,
            states: {
              hover: {
                enabled: false,
              },
            },
          },
        },
      },
      datasets: [
        {
          name: "Quality",
          type: "line",
          data: [
            100, 90, 91, 92, 80, 85, 90, 92, 98, 99, 100, 90, 91, 92, 80, 85,
            90, 92, 98, 99, 100, 90, 91, 92, 80, 85, 90, 92, 98, 99, 87,
          ],
          backgroundColor: "transparent",
          borderColor: "#ff6633",
          pointBorderColor: "#ff6633",
          pointBackgroundColor: "#ff6633",
          fill: false,
          pointHoverBackgroundColor: "#ff6633",
          pointHoverBorderColor: "#ff6633",
        },
        {
          name: "Availability",
          type: "line",
          data: [
            80, 78, 60, 90, 60, 55, 70, 75, 88, 60, 90, 100, 91, 92, 80, 85, 76,
            92, 40, 99, 60, 90, 91, 92, 72, 85, 90, 92, 40, 60, 87,
          ],
          backgroundColor: "transparent",
          borderColor: "#005ce6",
          pointBorderColor: "#005ce6",
          pointBackgroundColor: "#005ce6",
          fill: false,
          pointHoverBackgroundColor: "#005ce6",
          pointHoverBorderColor: "#005ce6",
        },
      ],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect,
      },
      hover: {
        mode: mode,
        intersect: intersect,
      },
      legend: {
        display: false,
      },
      scales: {
        yAxes: [
          {
            // display: false,
            gridLines: {
              display: true,
              // lineWidth: "4px",
              color: "rgba(0, 0, 0, .2)",
              zeroLineColor: "transparent",
            },
            ticks: $.extend(
              {
                beginAtZero: true,
                suggestedMax: 120,
              },
              ticksStyle
            ),
          },
        ],
        xAxes: [
          {
            display: true,
            gridLines: {
              display: false,
            },
            ticks: ticksStyle,
          },
        ],
      },
    },
  });

  //   chart 2
  var $visitorsChart2 = $("#visitors-chart2");
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart2, {
    data: {
      labels: ["18th", "20th", "22nd", "24th", "26th", "28th", "30th"],
      datasets: [
        {
          type: "line",
          data: [100, 120, 170, 167, 180, 177, 160],
          backgroundColor: "transparent",
          borderColor: "#007bff",
          pointBorderColor: "#007bff",
          pointBackgroundColor: "#007bff",
          fill: false,
          // pointHoverBackgroundColor: '#007bff',
          // pointHoverBorderColor    : '#007bff'
        },
        {
          type: "line",
          data: [60, 80, 70, 67, 80, 77, 100],
          backgroundColor: "transparent",
          borderColor: "#ced4da",
          pointBorderColor: "#ced4da",
          pointBackgroundColor: "#ced4da",
          fill: false,
          // pointHoverBackgroundColor: '#ced4da',
          // pointHoverBorderColor    : '#ced4da'
        },
      ],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect,
      },
      hover: {
        mode: mode,
        intersect: intersect,
      },
      legend: {
        display: false,
      },
      scales: {
        yAxes: [
          {
            // display: false,
            gridLines: {
              display: true,
              lineWidth: "4px",
              color: "rgba(0, 0, 0, .2)",
              zeroLineColor: "transparent",
            },
            ticks: $.extend(
              {
                beginAtZero: true,
                suggestedMax: 200,
              },
              ticksStyle
            ),
          },
        ],
        xAxes: [
          {
            display: true,
            gridLines: {
              display: false,
            },
            ticks: ticksStyle,
          },
        ],
      },
    },
  });

  //   chart 3
  var $visitorsChart3 = $("#visitors-chart3");
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart3, {
    data: {
      labels: ["18th", "20th", "22nd", "24th", "26th", "28th", "30th"],
      datasets: [
        {
          type: "line",
          data: [100, 120, 170, 167, 180, 177, 160],
          backgroundColor: "transparent",
          borderColor: "#007bff",
          pointBorderColor: "#007bff",
          pointBackgroundColor: "#007bff",
          fill: false,
          // pointHoverBackgroundColor: '#007bff',
          // pointHoverBorderColor    : '#007bff'
        },
        {
          type: "line",
          data: [60, 80, 70, 67, 80, 77, 100],
          backgroundColor: "transparent",
          borderColor: "#ced4da",
          pointBorderColor: "#ced4da",
          pointBackgroundColor: "#ced4da",
          fill: false,
          // pointHoverBackgroundColor: '#ced4da',
          // pointHoverBorderColor    : '#ced4da'
        },
      ],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect,
      },
      hover: {
        mode: mode,
        intersect: intersect,
      },
      legend: {
        display: false,
      },
      scales: {
        yAxes: [
          {
            // display: false,
            gridLines: {
              display: true,
              lineWidth: "4px",
              color: "rgba(0, 0, 0, .2)",
              zeroLineColor: "transparent",
            },
            ticks: $.extend(
              {
                beginAtZero: true,
                suggestedMax: 200,
              },
              ticksStyle
            ),
          },
        ],
        xAxes: [
          {
            display: true,
            gridLines: {
              display: false,
            },
            ticks: ticksStyle,
          },
        ],
      },
    },
  });

  //   chart 4
  var $visitorsChart4 = $("#visitors-chart4");
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart4, {
    data: {
      labels: ["18th", "20th", "22nd", "24th", "26th", "28th", "30th"],
      datasets: [
        {
          type: "line",
          data: [100, 120, 170, 167, 180, 177, 160],
          backgroundColor: "transparent",
          borderColor: "#007bff",
          pointBorderColor: "#007bff",
          pointBackgroundColor: "#007bff",
          fill: false,
          // pointHoverBackgroundColor: '#007bff',
          // pointHoverBorderColor    : '#007bff'
        },
        {
          type: "line",
          data: [60, 80, 70, 67, 80, 77, 100],
          backgroundColor: "transparent",
          borderColor: "#ced4da",
          pointBorderColor: "#ced4da",
          pointBackgroundColor: "#ced4da",
          fill: false,
          // pointHoverBackgroundColor: '#ced4da',
          // pointHoverBorderColor    : '#ced4da'
        },
      ],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect,
      },
      hover: {
        mode: mode,
        intersect: intersect,
      },
      legend: {
        display: false,
      },
      scales: {
        yAxes: [
          {
            // display: false,
            gridLines: {
              display: true,
              lineWidth: "4px",
              color: "rgba(0, 0, 0, .2)",
              zeroLineColor: "transparent",
            },
            ticks: $.extend(
              {
                beginAtZero: true,
                suggestedMax: 200,
              },
              ticksStyle
            ),
          },
        ],
        xAxes: [
          {
            display: true,
            gridLines: {
              display: false,
            },
            ticks: ticksStyle,
          },
        ],
      },
    },
  });
});

// lgtm [js/unused-local-variable]
