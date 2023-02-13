<!-- <pre> -->
<?php
    require_once 'data_shortDT.php';

    $arr_tmp1 = array();
    $arr_tmp2 = array();

    for ($i = 0 ; $i < count($data_short_downtime); $i++){
        if (!in_array($data_short_downtime[$i][2], $arr_tmp1, true)){
            array_push($arr_tmp1, $data_short_downtime[$i][2]);
            array_push($arr_tmp2, array($data_short_downtime[$i][2], 0 ,0));
        }
    }

    for ($i = 0 ; $i < count($data_short_downtime); $i++){
        if (in_array($data_short_downtime[$i][2], $arr_tmp1, true)){
            $temp1 = array_search($data_short_downtime[$i][2], $arr_tmp1);
            // echo $temp1 . "</br>";
            $arr_tmp2[$temp1][1]+=1;
            $arr_tmp2[$temp1][2]+= (int)$data_short_downtime[$i][6];
            $arr_tmp2[$temp1][3] = $data_short_downtime[$i][7];
        }
    }
    
    usort($arr_tmp2, function($a, $b) {
        return $b[1] <=> $a[1];
    });
    // for($i = 0; $i < count($arr_tmp2);$i++){
    //     for($j = 0; $j < count($arr_tmp2[$i]); $j++){
    //         echo "Hello" . $arr_tmp2[$i][$j] . ",";
    //     }
    // }
?>

<div class="col-sm-12">
    <div id="chart_short_downtime" style="width: 100%; height: 65vh; margin-top: 10px;"></div>     
</div>
<!-- <div class="col-sm-12">
    <div id="chart_defect" style="width: 100%; height: 65vh; margin-top: 10px;"></div>
</div> -->
<script src="/fiot-hdvn-losses/node_modules/highcharts/highcharts.js"></script>
<script src="/fiot-hdvn-losses/node_modules/highcharts/modules/accessibility.js"></script>
<script src="/fiot-hdvn-losses/node_modules/highcharts/modules/exporting.js"></script>
<script src="/fiot-hdvn-losses/node_modules/highcharts/modules/export-data.js"></script>
<script type="text/javascript">
    Highcharts.chart('chart_short_downtime', {
        chart: {
            type: 'column',
            // backgroundColor: {
            //     linearGradient: [0, 0, 500, 500],
            //     stops: [
            //         // [0, '#ffffff'],
            //         [0, '#222']
            //     ]
            // }
        },
        credits: {
            enabled: false //clear highcharts.com
        },
        title: {
            text: 'チョコ停ロスグラフ',
            style:{
                fontSize: '20px',
                color: 'black',
                fontWeight: 'bold'
            }
        },
        
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: [<?php for($i = 0; $i < count($arr_tmp2); $i++){
                echo '"'. $arr_tmp2[$i][0].'",';
            } ?>],
            labels:  {
                style: {
                    color: 'black',
                    fontSize: '12px'
                    // fontWeight: 'bold'
                }
                },
        },
        yAxis: [{
            allowDecimals: false,
            labels: {
                style: {
                    fontSize: '15px',
                    color: 'black',
                    fontWeight: 'bold'
                }
            },
            title: {
                text: 'Số phút <br> 分',
                style:{
                    fontSize: '20px',
                    color: 'black',
                    fontWeight: 'bold'
                }
            },
            opposite: true
        },{
            allowDecimals: false,
            labels: {
                style: {
                    fontSize: '15px',
                    color: 'black',
                    fontWeight: 'bold'
                }
            },
            title: {
                text: 'Số lần <br> 回数',
                style:{
                    fontSize: '20px',
                    color: 'black',
                    fontWeight: 'bold'
                }
            }
        },
        ],
        legend: {
            enabled: false
        },
        legend: {
            layout: 'horizontal',
            align: 'center',
            x: 0,
            verticalAlign: 'bottom',
            y: 0,
            itemStyle: {
                fontSize:'20px',
                color: 'black'
            },
            // floating: true,
            // backgroundColor:
            //     Highcharts.defaultOptions.legend.backgroundColor || // theme
            //     'rgba(255,255,255,0.25)'
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.0f}'
                }
            }
        },
    
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.1f}</b><br/>'
        },
    
        series: [
            {
                name: "Số lần <br> 回数",
                colorByPoint: true,
                // yAxis: 1,
                data: [<?php for($i = 0; $i < count($arr_tmp2); $i++){
                    echo $arr_tmp2[$i][1] . ",";
                } ?>],
                // color: 'blue'
            },
            {
                name: 'Thời gian (phút) <br> 時間（分）',
                type: 'spline',
                data: [<?php for($i = 0; $i < count($arr_tmp2); $i++){
                    echo round($arr_tmp2[$i][2] / 60, 0) . ",";
                } ?>],
                // tooltip: {
                //     valueSuffix: '°C'
                // },
                color: 'orange'
            },
        ]
    });
</script>