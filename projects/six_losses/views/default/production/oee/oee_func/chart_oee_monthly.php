<?php
    // require_once "data_chart_monthly.php";
    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;

    $arr_perform = array();
    $arr_longDt_daily = array();
    $arr_shortDt_daily = array();
    $arr_outputNg_daily = array();
    $arr_speed_daily = array();
    $arr_prepare_daily = array();
    $arr_chaging_daily = array();

    if($select_line == 'jatco'){
        $arr_perform = [91.5, 90.05, 51.57, 73.05, 80.15, 78.89, 77.19, 87.36, 80.48, 43.82, 9.02, 39.34, 89.11, ];
        $arr_longDt_daily = [4.27, 5.54, 45.78, 14.81, 11.46, 16.27, 14.49, 5.42, 12.75, 45.59, 85.57, 49.1, 6.72];
        $arr_shortDt_daily = [2.26, 3.46, 2.09, 2.18, 1.6, 1.34, 3.78, 2.32, 1.47, 4.36, 3.4, 1.48, 5.55];
        $arr_outputNg_daily = [0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01];
        $arr_speed_daily = [12.3, 9.21, 5.6, 5.4, 8.94, 8.79, 11.86, 7.98, 4.62, 5.19, 0.68, 2.3, 9.49];
        $arr_prepare_daily = [0, 0, 0, 1.51, 3.72, 1.75, 1.49, 0.39, 1.42, 1.27, 0, 0, 1.76];
        $arr_chaging_daily = [0.99, 1.44, 0.69, 0.65, 0.61, 0.84, 1.22, 1.46, 1.18, 0.89, 0, 0.6, 1.4];
        
    }
    else if($select_line == 'aw3'){
        $arr_perform = [76.74, 82.73, 57.5, 0, 22.45, 69.77, 74.68, 70.68, 91.15, 84.24, 48.63, 0, 85.3,];
        $arr_longDt_daily = [13.94, 10.5, 34.22, 0, 61.66, 25.58, 17.18, 21.13, 5.15, 12.15, 45.44, 0, 8.09];
        $arr_shortDt_daily = [3.75, 1.98, 2.26, 0, 0.42, 5.05, 3.22, 3.48, 2.33, 2.78, 2.03, 0, 4.39];
        $arr_outputNg_daily = [0.01, 0.01 ,0.01, 0, 0.01, 0.01, 0.01, 0.01, 0.03, 0,01, 0.01, 0, 0.01];
        $arr_speed_daily = [14.66, 13.88, 11.04, 0, 3.71, 24.2, 19.7, 17.09, 8.71, 8, 6.05, 0, 11.32];
        $arr_prepare_daily = [1.22, 5.54, 5.7, 0.26, 0, 8.55, 4.91, 5.14, 1.06, 5.12, 1.01, 0, 0];
        $arr_chaging_daily = [1.93, 1.82, 1.53, 0, 0.53, 17.43, 1.88, 11.66, 2.09, 2.18, 1.68, 0, 2.03];
    }
    else if($select_line == 'aw2'){
        $arr_perform = [33.74, 71.64, 56.77, 0, 0, 30.82, 59.42, 84.78, 86.11, 77.95, 75.64, 0, 82.99];
        $arr_longDt_daily = [53.9, 21.23, 30.34, 0, 0, 60.41, 26.64, 7.04, 7.43, 18.83, 15.34, 0, 7.14];
        $arr_shortDt_daily = [2.59, 8.26, 4.46, 0, 0, 7.01, 4.36, 6.11, 3.72, 6.95, 2.47, 0, 4.38];
        $arr_outputNg_daily = [0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01];
        $arr_speed_daily = [4.5, 11.52, 7.17, 0, 0, 5.75, 6.18, 9.09, 9.35, 9.92, 8.26, 0, 10.27];
        $arr_prepare_daily = [4.96, 7.96, 1.27, 3.66, 0, 4.62, 1.84, 2.77, 5.56, 2.41, 2.57, 3.15, 5.57];
        $arr_chaging_daily = [0.39, 1.55, 1.03, 0, 0, 0.64, 1.17, 1.7, 1.92, 2.87, 1.83, 0, 1.79];
    }
    




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
            data: [<?php 
                for($i = 0; $i < count($arr_speed_daily); $i++){
                    echo $arr_speed_daily[$i] . ",";
            } ?>],
            },
            {
            name: "Chuẩn bị",
            data: [<?php 
                for($i = 0; $i < count($arr_prepare_daily); $i++){
                    echo $arr_prepare_daily[$i] . ",";
            } ?>],
            },
            {
            name: "Thay đổi",
            data: [<?php 
                for($i = 0; $i < count($arr_chaging_daily); $i++){
                    echo $arr_chaging_daily[$i] . ",";
            } ?>],
            },
            {
            name: "Hàng NG",
            data: [<?php 
                for($i = 0; $i < count($arr_outputNg_daily); $i++){
                    echo $arr_outputNg_daily[$i] . ",";
            } ?>],
            },
            {
            name: "Dừng dài",
            data: [<?php 
                for($i = 0; $i < count($arr_longDt_daily); $i++){
                    echo $arr_longDt_daily[$i] . ",";
            } ?>],
            },
            {
            name: "Dừng ngắn",
            data: [<?php 
                for($i = 0; $i < count($arr_shortDt_daily); $i++){
                    echo $arr_shortDt_daily[$i] . ",";
            } ?>],
            color: "#ff0000",
            },
            {
            name: "Hiệu suất",
            data: [<?php 
                for($i = 0; $i < count($arr_perform); $i++){
                    echo $arr_perform[$i] . ",";
            } ?>],
            color: "#0099ff",
            },
        ],
    });
</script>