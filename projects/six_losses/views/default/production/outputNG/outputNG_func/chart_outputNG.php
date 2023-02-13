<?php
    require_once 'data_outputNG.php';

    $arr_ng_tmp1 = array();
    $arr_ng_tmp2 = array();

    for ($i = 0 ; $i < count($data_ng); $i++){
        if (!in_array($data_ng[$i][2], $arr_ng_tmp1, true)){
            array_push($arr_ng_tmp1, $data_ng[$i][2]);
            array_push($arr_ng_tmp2, array($data_ng[$i][2], 0));
        }
    }

    for ($i = 0 ; $i < count($data_ng); $i++){
        if (in_array($data_ng[$i][2], $arr_ng_tmp1, true)){
            $tmp_ng = array_search($data_ng[$i][2], $arr_ng_tmp1);
            // echo $temp1 . "</br>";
            $arr_ng_tmp2[$tmp_ng][1] += 1;
        }
    }

    usort($arr_ng_tmp2, function($a, $b) {
        return $b[1] <=> $a[1];
    });
?>

    <div class="col-sm-12">
        <div id="chart_ng" style="width: 100%; height: 65vh; margin-top: 10px;"></div>       
    </div>
<script src="/fiot-hdvn-losses/node_modules/highcharts/highcharts.js"></script>
<script src="/fiot-hdvn-losses/node_modules/highcharts/modules/accessibility.js"></script>
<script src="/fiot-hdvn-losses/node_modules/highcharts/modules/exporting.js"></script>
<script src="/fiot-hdvn-losses/node_modules/highcharts/modules/export-data.js"></script>
<script type="text/javascript">
    Highcharts.chart('chart_ng', {
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
            text: '不良ロスグラフ',
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
            categories: [<?php for($i = 0; $i < count($arr_ng_tmp2); $i++){
                echo '"'. $arr_ng_tmp2[$i][0].'",';
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
            // title: {
            //     text: 'Số lần <br> 回数',
            //     style:{
            //         fontSize: '20px',
            //         color: 'black',
            //         fontWeight: 'bold'
            //     }
            // }
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
                },
                // point: {
                //     events: {
                //         click: function () {
                //             location.href = this.options.url;
                //         }
                //     }
                // },
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
                data: [<?php for($i = 0; $i < count($arr_ng_tmp2); $i++){
                    echo $arr_ng_tmp2[$i][1] . ",";
                } ?>],
                // color: 'blue'
            }
        ]
    });
</script>