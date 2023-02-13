<pre>
<?php
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];

    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;

    $year = date('Y');
    $month = date('m');
    

    $count_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $curr_month = date('Y-m');

    $previous_month_tmp = mktime(0, 0, 0, date("m")-1 , date("d"), date("Y"));
    $previous_month = date('Y-m', $previous_month_tmp);

    $previous_2month_tmp = mktime(0, 0, 0, date("m")-2 , date("d"), date("Y"));
    $previous_2month = date('Y-m', $previous_2month_tmp);

    $sql_zeroOutput = "SELECT * FROM " . $select_line . "_output_5 WHERE output = 0 and time LIKE '2023-01%'";
    $result_zeroOutput = mysqli_query( $connect, $sql_zeroOutput );
    if ($result_zeroOutput && $result_zeroOutput->num_rows > 0) {
        $i = 0;
        while ($row = $result_zeroOutput->fetch_assoc()) {
            $data_output_zero[$i][0]=$row['id'];
            $data_output_zero[$i][1]=$row['output'];
            $data_output_zero[$i][2]=$row['time'];
            $i++;
        }
    }
    else{
        $data_output_zero = [];
    }

    for($i = 0; $i < count($data_output_zero); $i++){
        if($data_output_zero[$i][2]){
            
        }
    }
    print_r($data_output_zero);

    // $arr_shortDT_losses = array();
    // $arr_longDT_losses = array();
    // $arr_ng_losses = array();
    // $arr_speed_losses = array();


    $arr_shortDT_monthly = array();
    $arr_longDT_monthly = array();
    $arr_ng_monthly = array();
    $arr_speed_monthly = array();
    $arr_prepare_monthly = array();
    $arr_changing_monthly = array();
    $arr_perform_monthly = array();
    
    //array for month of year
    $arr_month = array();
    for($i = 1; $i <= 12; $i++){
        if($i<10){
            array_push($arr_month, '0'. $i);
        }
        else{
            array_push($arr_month, $i);
        }
    }

    for($k = 0; $k < count($arr_month); $k++){
        $select_month = date('Y') . "-" . $arr_month[$k];
        // echo $select_month . "<br>";
        if($k == (count($arr_month)-1)){
            $select_next_month = date('Y')+1 . "-" . $arr_month[0];
        }else{
            $select_next_month = date('Y') . "-" . $arr_month[$k+1];
        }

        $count_output_of_day = 0;
        $arr_time_of_day = array();
        $output_monthly = 0;
        $fday_month = $select_month . "-01 06:00:00";
        $fday_next_month = $select_next_month . "-01 06:00:00";
        $last_day_month = date('Y-m-t', strtotime($select_month)) . "23:59:59";

        //data output-----------------------------------------------------------------
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
        
        $count_output_of_day = count(array_unique($arr_time_of_day));
        // print_r($count_output_of_day);
        
        unset($data_output);
        
        $output_standard = "SELECT sum(output_target) AS output_std FROM " . "aw3_output_target " . "ORDER BY id ASC";
        $result_output_standard = mysqli_query($connect, $output_standard);
        if($result_output_standard && $result_output_standard -> num_rows > 0){
            while ($row = mysqli_fetch_array($result_output_standard)) { 
                $data_output_standard = $row['output_std'];
                // echo $data_output_standard;
            }
        }
        
        //data_shortDT------------------------------------------------------------------
        $short_downtime = "SELECT sum(period) as period_monthly FROM " . $select_line . "_long_downtime" . " WHERE id_name NOT IN (1177,1178,1228) AND time BETWEEN '$fday_month' AND '$fday_next_month' 
                                AND period < 300 ORDER BY time DESC";
        // echo $sql_short_dt . "</br>";
        $result_short_dt = mysqli_query( $connect, $short_downtime );
        if ($result_short_dt && $result_short_dt->num_rows > 0) {
            while ($row = $result_short_dt->fetch_assoc()) {
                $data_short_dt=$row['period_monthly'];
            }
        }
    
        //data_longDt--------------------------------------------------------------------
        $long_downtime = "SELECT sum(period) as period_monthly FROM " . $select_line . "_long_downtime" . " WHERE id_name NOT IN (1177,1178,1228) AND time BETWEEN '$fday_month' AND '$fday_next_month' 
                                AND period >= 300 ORDER BY time DESC";
        // echo $sql_short_dt . "</br>";
        $result_long_dt = mysqli_query( $connect, $long_downtime );
        if ($result_long_dt && $result_long_dt->num_rows > 0) {
            while ($row = $result_long_dt->fetch_assoc()) {
                $data_long_dt=$row['period_monthly'];
            }
        }

        //data ng losses--------------------------------------------------------
        $ng_output = "SELECT COUNT(defect_name) as defect_monthly FROM " . $select_line . "_output_ng_total" . " WHERE `time` 
                        BETWEEN '$fday_month' AND '$fday_next_month'";
        // echo $ng_output . "<br>";
        $resultcheck_ng = mysqli_query( $connect, $ng_output );
        if ($resultcheck_ng && $resultcheck_ng->num_rows > 0) {
            while ($row = $resultcheck_ng->fetch_assoc()) {
                //thêm k?t qu? vào m?ng
                $data_output_ng = $row['defect_monthly'];
            }
        }
        
        //data speed------------------------------------------------------------
        $speed = "SELECT sum(period) as period_monthly FROM " . $select_line . "_hourly_speed " . "WHERE time 
                    BETWEEN '$fday_month' AND '$fday_next_month'";
        // echo $speed . "<br>";
        $resultcheck_speed = mysqli_query( $connect, $speed );
        if ($resultcheck_speed && $resultcheck_speed->num_rows > 0) {
            while ($row = $resultcheck_speed->fetch_assoc()) {
                $data_speed =$row['period_monthly'];
            }
        }

        //-------------------------------Lọc data prepare------------------------------------
        $sql_prepare = "SELECT sum(period) as period_prepare_monthly FROM " . $select_line . "_line_prepare " . "WHERE time
                            BETWEEN '$fday_month' AND '$fday_next_month'";
        // echo $sql_prepare . "</br>";
        $result_prepare = mysqli_query( $connect, $sql_prepare );
        if ($result_prepare && $result_prepare->num_rows > 0) {
            while ($row = $result_prepare->fetch_assoc()) {
                $data_prepare=$row['period_prepare_monthly'];
            }
        }
        // echo $data_prepare . "<br>";


        //-------------------------------Lọc data changing------------------------------------
        $sql_wire_electrode = "SELECT sum(period) as period_wire_electrode_monthly FROM " . $select_line . "_change_wire " . 
                                "WHERE time BETWEEN '$fday_month' AND '$fday_next_month'";
        // echo $sql_wire_electrode . "</br>";
        $result_wire_electrode = mysqli_query( $connect, $sql_wire_electrode );
        if ($result_wire_electrode && $result_wire_electrode->num_rows > 0) {
            while ($row = $result_wire_electrode->fetch_assoc()) {
                $data_wire_electrode=$row['period_wire_electrode_monthly'];
                // echo $data_wire_electrode . "<br>";
            }
        }
        // echo $data_wire_electrode . "<br>";

        $sql_change_code = "SELECT sum(period) as period_code_monthly FROM " . $select_line . "_code_change " . 
                                "WHERE time BETWEEN '$fday_month' AND '$fday_next_month'";
        // echo $sql_change_code . "</br>";
        $result_change_code = mysqli_query( $connect, $sql_change_code );
        if ($result_change_code && $result_change_code->num_rows > 0) {
            while ($row = $result_change_code->fetch_assoc()) {
                $data_change_code=$row['period_code_monthly'];
            }
        }

        $data_changing = $data_change_code + $data_wire_electrode;
        // echo $data_changing . "<br>";

        if($count_output_of_day == 0){
            $perform_monthly = 'null';
            array_push($arr_perform_monthly, $perform_monthly);
            $period_shortDt_monthly = 'null';
            array_push($arr_shortDT_monthly, $period_shortDt_monthly);
            $period_longDt_monthly = 'null';
            array_push($arr_longDT_monthly, $period_longDt_monthly);
            $output_ng_monthly = 'null';
            array_push($arr_ng_monthly, $output_ng_monthly);
            $period_speed_monthly = 'null';
            array_push($arr_speed_monthly, $period_speed_monthly);
            $period_prepare_monthly = 'null';
            array_push($arr_prepare_monthly, $period_prepare_monthly);
            $period_changing_monthly = 'null';
            array_push($arr_changing_monthly, $period_changing_monthly);
        }
        else{
            $perform_monthly = ($output_monthly / ($data_output_standard * $count_output_of_day)) * 100;
            $perform_monthly = round($perform_monthly, 2);
            array_push($arr_perform_monthly, $perform_monthly);
            $period_shortDt_monthly = ($data_short_dt / (60*1275 * $count_output_of_day)) * 100;
            $period_shortDt_monthly = round($period_shortDt_monthly, 2);
            array_push($arr_shortDT_monthly, $period_shortDt_monthly);
            $period_longDt_monthly = ($data_long_dt / (60*1275 * $count_output_of_day)) * 100;
            $period_longDt_monthly = round($period_longDt_monthly, 2);
            array_push($arr_longDT_monthly, $period_longDt_monthly);
            $output_ng_monthly = (($data_output_ng * 3.8) / (60* 1275 * $count_output_of_day)) * 100;
            $output_ng_monthly = round($output_ng_monthly, 2);
            array_push($arr_ng_monthly, $output_ng_monthly);
            $period_speed_monthly = ($data_speed / (60* 1275 * $count_output_of_day)) * 100;
            // echo $period_speed_monthly . "<br>";
            $period_speed_monthly = round($period_speed_monthly, 2);
            array_push($arr_speed_monthly, $period_speed_monthly);
            $period_prepare_monthly = ($data_prepare / (60* 1275 * $count_output_of_day)) * 100;
            $period_prepare_monthly = round($period_prepare_monthly, 2);
            array_push($arr_prepare_monthly, $period_prepare_monthly);
            $period_changing_monthly = ($data_changing / (60* 1275 * $count_output_of_day)) * 100;
            $period_changing_monthly = round($period_changing_monthly, 2);
            array_push($arr_changing_monthly, $period_changing_monthly);
        }

    }
    $arr_data = array();
    if($select_line == 'aw3'){
        $arr_data = [88.2, 88.4, 87.5, 86.9, 86.3, 89.1, 86.6, 87.2, 88.5, 88.3, 87.5, 87.2];
    }
    else if($select_line == 'aw2'){
        $arr_data = [86.2, 89.4, 86.5, 87.9, 85.3, 86.1, 87.6, 88.2, 89.5, 86.3, 88.5, 88.2];
    }
    else if($select_line == 'jatco'){
        $arr_data = [87.2, 90.4, 89.5, 88.9, 88.3, 87.1, 85.6, 89.2, 87.5, 85.3, 89.5, 86.2];
    }
    // print_r($arr_data);
    // $arr_month_test = array("4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月", "1月", "2月", "3月");
    // print_r($arr_longDT_monthly);
?>
    <div id="oee_monthly" style="width: 100%; height: 300px;"></div>

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
                categories: ["4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月", "1月", "2月", "3月"],
                <?php 
                    // for($i = 1; $i <= 12; $i++){
                    //     echo '"' . $i . ' ' . '月' . '",';
                    // } 
                ?>
                <?php 
                //     for($i = 0; $i < count($arr_month_test); $i++){
                //     echo $arr_month_test[$i] . ",";
                // } 
                ?>
                
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
                    stacking: 'percent'
                }
            },
            series: [
                {
                name: "Tốc độ / 速度ロス",
                data: [1.3, 2.1, 2.3, 2.5, 1.8, 2.6, 1.6, 2.8, 2.2, 2.1, 2.4, 2.5],
                //     [<?php 
                //     for($i = 0; $i < count($arr_speed_monthly); $i++){
                //     echo $arr_speed_monthly[$i] . ",";
                // } ?>],
                },
                {
                name: "Chuẩn bị / 準備ロス",
                data: [1.3, 2.1, 2.3, 2.5, 1.8, 2.6, 1.6, 2.8, 2.2, 2.1, 2.4, 2.5],
                // [<?php 
                // for($i = 0; $i < count($arr_prepare_monthly); $i++){
                //     echo $arr_prepare_monthly[$i] . ",";
                // } ?>],
                },
                {
                name: "Thay đổi / 段取りロス",
                data: [1.3, 2.1, 2.3, 2.5, 1.8, 2.6, 1.6, 2.8, 2.2, 2.1, 2.4, 2.5],
                //     [<?php 
                //     for($i = 0; $i < count($arr_changing_monthly); $i++){
                //     echo $arr_changing_monthly[$i] . ",";
                // } ?>],
                },
                {
                name: "Tỉ lệ lỗi / 不良",
                data: [1.3, 2.1, 2.3, 2.5, 1.8, 2.6, 1.6, 2.8, 2.2, 2.1, 2.4, 2.5],
                //     [<?php 
                //     for($i = 0; $i < count($arr_ng_monthly); $i++){
                //         echo $arr_ng_monthly[$i] . ",";
                // } ?>],
                },
                {
                name: "Dừng dài / 大停止",
                data: [1.3, 2.1, 2.3, 2.5, 1.8, 2.6, 1.6, 2.8, 2.2, 2.1, 2.4, 2.5],
                //     [<?php 
                //     for($i = 0; $i < count($arr_longDT_monthly); $i++){
                //     echo $arr_longDT_monthly[$i] . ",";
                // } ?>],
                },
                {
                name: "Dừng ngắn / チョコ停",
                data: [1.3, 2.1, 2.3, 2.5, 1.8, 1.6, 1.6, 2.8, 2.2, 2.1, 2.4, 2.5],
                //     [<?php 
                //     for($i = 0; $i < count($arr_shortDT_monthly); $i++){
                //         echo $arr_shortDT_monthly[$i] . ",";
                // } 
                // ?>],

                color: "#ff0000",
                },
                {
                name: "Hiệu suất / 可動率",
                data: [88.2, 88.4, 87.5, 86.9, 86.3, 89.1, 86.6, 87.2, 88.5, 88.3, 87.5, 87.2],
                
                //     [<?php 
                //     for($i = 0; $i < count($arr_perform_monthly); $i++){
                //     echo $arr_perform_monthly[$i] . ",";
                // } ?>],
                color: "#0099ff",
                },
            ],
        });
    </script>