<!-- <pre> -->
<?php
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];
    
    $date_now = date('Y-m-d H:i:s');
    $date = date('Y-m-d');

    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;

    $yesterday_tmp = mktime(0, 0, 0, date("m") , date("d")-1, date("Y"));
    $yesterday = date('Y-m-d', $yesterday_tmp);
    // echo $yesterday;
	  
    $year = date('Y');
    $month = date('m');
    // $month_next = date('m')+1;
    $month_next_tmp = mktime(0, 0, 0, date("m")+1 , date("d"), date("Y"));
    $month_next = date('Y-m', $month_next_tmp);
    $last_day = date('t');

    $count_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    $arr_month = array();

    for($i = 1; $i <= 12; $i++){
        if($i<10){
            array_push($arr_month, '0'. $i);
        }
        else{
            array_push($arr_month, $i);
        }
    }
    // array_push($arr_month, '01');
    // print_r($arr_month);
    // $arr_output_year = array();
    $arr_perform_monthly = array();

    for($k = 0; $k < count($arr_month); $k++){
        $select_month = date('Y') . "-" . $arr_month[$k];
        $last_day_month = date('Y-m-t', strtotime($select_month)) . "23:59:59";
        // $last_day_in_month = $last_day_month . " " . "23:59:59";
        // echo $last_day_month . "</br>";
        if($k == (count($arr_month)-1)){
            $select_next_month = date('Y')+1 . "-" . $arr_month[0];
        }else{
            $select_next_month = date('Y') . "-" . $arr_month[$k+1];
        }
        
        $fday_month = $select_month . "-01 06:00:00";
        $fday_next_month = $select_next_month . "-01 06:00:00";
        // echo $select_month . "</br>";
        $output_monthly = 0;
        $arr_time_of_day = array();
        $count_output_of_day = 0;
        
        $sql_output= "SELECT * FROM " . $select_line . "_hourly_output WHERE time BETWEEN '$fday_month' AND '$fday_next_month' ORDER BY time DESC";
        // echo $sql_output . "</br>";
        $result_output = mysqli_query( $connect, $sql_output );
        if ($result_output && $result_output->num_rows > 0) {
            $i = 0;
            while ($row = $result_output->fetch_assoc()) {
                $data_output[$i][0]=$row['id'];
                $data_output[$i][1]=$row['output'];
                $data_output[$i][2]=$row['time'];
                $i++;
            }
        }
        else{
            $data_output = [];
        }

        for ($i = 0; $i < count($data_output); $i++){
            if($data_output[$i][2] >= $fday_month && $data_output[$i][2] <= $last_day_month){
                $output_monthly += $data_output[$i][1];
                array_push($arr_time_of_day, substr($data_output[$i][2],0,10));
            }
        }
        // echo $output_monthly . "<br>";
        $count_output_of_day = count(array_unique($arr_time_of_day));
        // print_r($count_output_of_day);
        
        unset($data_output);
    
        // echo $output_year . "</br>";
        //------------------------------------------------------------//
        //select data output target
        $data_output_standard = 0;
        $output_standard = "SELECT sum(output_target) AS output_std FROM " . "aw3_output_target " . "ORDER BY id ASC";
    // echo $output_standard. "</br>";
        $result_output_standard = mysqli_query($connect, $output_standard);
        if($result_output_standard && $result_output_standard -> num_rows > 0){
            while ($row = mysqli_fetch_array($result_output_standard)) { 
                $data_output_standard = $row['output_std'];
                // echo $data_output_standard;
            }
        }
        
        // $perform_monthly = 0;
        if($count_output_of_day == 0){
            $perform_monthly = 'null';
            array_push($arr_perform_monthly, $perform_monthly);
        }
        else{
            $perform_monthly = round($output_monthly / ($data_output_standard * $count_output_of_day) * 100, 2);
            array_push($arr_perform_monthly, $perform_monthly);
        }
        
    }
    // print_r($arr_perform_monthly);
    $arr_month_test = array("4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月", "1月", "2月", "3月");
?>
        
<!-- <div class="col-sm-12"> -->
    <div id="oee-overrall-summary" style="width: 100%; height: 300px;"></div>     
<!-- </div> -->
            
        
    <script src="/fiot-hdvn-losses/node_modules/highcharts/highcharts.js"></script>
    <script src="/fiot-hdvn-losses/node_modules/highcharts/modules/accessibility.js"></script>
    <script src="/fiot-hdvn-losses/node_modules/highcharts/modules/exporting.js"></script>
    <script src="/fiot-hdvn-losses/node_modules/highcharts/modules/export-data.js"></script>
    
    <script type="text/javascript">
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
                categories: ["4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月", "1月", "2月", "3月"],
                // [
                //     <?php 
                //     for($i=0; $i<=12; $i++){
                //         echo '"' . $i . ' ' . '月' . '",';
                //         // echo $i . ",";
                //     } 
                //     ?>
                // ],
                crosshair: true,
            },
            yAxis: {
                // tickPositions: [50, 60, 70, 80, 90, 100],
                tickInterval: 10, //set range value yAxis
                title: {
                    useHTML: true,
                    text: 'Tỉ lệ(%) <br> 率(%)',
                    style: {
                      fontWeight: 'bold'
                    }
                },
                min: 50,
                max: 100,
                labels: {
                // format: "20{value.2f}%",
                    format: '{value}%',
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
                name: "Mục tiêu <br> 目標",
                type: "line",
                marker: false,
                lineWidth: 6,
                data: [
                    <?php for($i=1; $i<=12; $i++){
                        echo 86 . ",";
                    } ?>
                ],
                color: "#ff6633",
                },
                {
                name: "Hiệu suất thực tế <br> 実績可動率'",
                type: "line",
                marker: false,
                dataLabels: {
                    enabled: true //them value on top 
                },
                lineWidth: 6,
                data: [ 
                    88.2, 88.4, 87.5, 86.9, 86.3, 89.1, 86.6, 87.2, 88.5, 88.3, 87.5, 87.2
                ],
                // [
                //     <?php
                //         for($i = 0; $i < count($arr_perform_monthly); $i++){
                //             echo $arr_perform_monthly[$i] . ",";
                //         }
                //     ?>
                // ],
                color: "#005ce6",
                },
            ],
        });
    </script>
