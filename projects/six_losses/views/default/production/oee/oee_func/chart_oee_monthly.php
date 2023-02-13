<?php
    require_once "data_chart_monthly.php";
?>
<div id="oee_monthly"></div>


<script src="/fiot-hdvn-losses/node_modules/highcharts/highcharts.js"></script>
<script src="/fiot-hdvn-losses/node_modules/highcharts/modules/accessibility.js"></script>
<script src="/fiot-hdvn-losses/node_modules/highcharts/modules/exporting.js"></script>
<script src="/fiot-hdvn-losses/node_modules/highcharts/modules/export-data.js"></script>
<script type="text/javascript">
    Highcharts.chart("oee_monthly", {
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
            <?php for($i = 1; $i <= count($arr_perform); $i++){
                echo $i . ",";
            } ?>
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
        // tooltip: {
        //     pointFormat:
        //     '<span style="color:{series.color}">{series.name}</span>: <b>({point.percentage:.2f}%)</b> <br/>',
        //     shared: true,
        // },
        plotOptions: {
            column: {
                stacking: "normal",
            },
        },
        series: [
            {
            name: "Tốc độ",
            data: [<?php for($i = 0; $i < count($arr_speed_daily); $i++){
                echo $arr_speed_daily[$i] . ",";
            } ?>],
            },
            {
            name: "Chuẩn bị",
            data: [<?php for($i = 0; $i < count($arr_prepare_daily); $i++){
                echo $arr_prepare_daily[$i] . ",";
            } ?>],
            },
            {
            name: "Thay đổi",
            data: [<?php for($i = 0; $i < count($arr_chaging_daily); $i++){
                echo $arr_chaging_daily[$i] . ",";
            } ?>],
            },
            {
            name: "Hàng NG",
            data: [<?php for($i = 0; $i < count($arr_outputNg_daily); $i++){
                echo $arr_outputNg_daily[$i] . ",";
            } ?>],
            },
            {
            name: "Dừng dài",
            data: [<?php for($i = 0; $i < count($arr_longDt_daily); $i++){
                echo $arr_longDt_daily[$i] . ",";
            } ?>],
            },
            {
            name: "Dừng ngắn",
            data: [<?php for($i = 0; $i < count($arr_shortDt_daily); $i++){
                echo $arr_shortDt_daily[$i] . ",";
            } ?>],
            color: "#ff0000",
            },
            {
            name: "Hiệu suất",
            data: [<?php for($i = 0; $i < count($arr_perform); $i++){
                echo $arr_perform[$i] . ",";
            } ?>],
            color: "#0099ff",
            },
        ],
    });
</script>