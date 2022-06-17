$(function () {
  "use strict";
  let items = [0, 0, 30, 0, 0, 0, 4, 2];
  let e = {
    series: [
      {
        name: "Kunjungan",
        data: items,
      },
    ],
    chart: {
      foreColor: "#9ba7b2",
      height: 310,
      type: "area",
      zoom: {
        enabled: !1,
      },
      toolbar: {
        show: !0,
      },
      dropShadow: {
        enabled: !0,
        top: 3,
        left: 14,
        blur: 4,
        opacity: 0.1,
      },
    },
    stroke: {
      width: 5,
      curve: "smooth",
    },
    xaxis: {
      type: "datetime",
      categories: [
        "11/7/2021",
        "11/8/2021",
        "11/9/2021",
        "11/10/2021",
        "11/11/2021",
        "11/12/2021",
        "11/13/2021",
        "11/14/2021",
      ],
    },
    title: {
      text: "Kunjungan Harian",
      align: "left",
      style: {
        fontSize: "16px",
        color: "#666",
      },
    },
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        gradientToColors: ["#0d6efd"],
        shadeIntensity: 1,
        type: "vertical",
        opacityFrom: 0.7,
        opacityTo: 0.2,
        stops: [0, 100, 100, 100],
      },
    },
    markers: {
      size: 5,
      colors: ["#0d6efd"],
      strokeColors: "#fff",
      strokeWidth: 2,
      hover: {
        size: 7,
      },
    },
    dataLabels: {
      enabled: !1,
    },
    colors: ["#0d6efd"],
    yaxis: {
      title: {
        text: "Kunjungan Harian",
      },
    },
  };
  new ApexCharts(document.querySelector("#chart1"), e).render();
});
