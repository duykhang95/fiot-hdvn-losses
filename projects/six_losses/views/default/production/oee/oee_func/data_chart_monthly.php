<pre>
<?php 
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];
    
    $date_now = date('Y-m-d H:i:s');
    $date = date('Y-m-d');
    
    $yesterday_tmp = mktime(0, 0, 0, date("m") , date("d")-1, date("Y"));
    $yesterday = date('Y-m-d', $yesterday_tmp);

    $year = date('Y');
    $month = date('m');

    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;
    // $select_line = "aw3";
    $count_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    // $count_day = cal_days_in_month(CAL_GREGORIAN, 05, 2022);
    $select_month = date('Y-m') . "-01";
    // echo $select_month . "</br>";
    if($month == '12' ){
        $first_month_next = date('Y')+1 . "-" ."01" . "-01";
    }
    else{
        $first_month_next = date('Y') . "-" .date('m')+1 . "-01";
    }
    // $first_month_next = date('Y') . "-" .date('m')+1 . "-01";
    // $select_month = "2022-05";
    // echo $select_month . "</br>";
    // echo $count_day . "</br>";

    //-----------------------Lọc dữ liệu output full tháng--------------------------------
    $sql_output= "SELECT * FROM " . $select_line . "_output_5_2 " . "WHERE time BETWEEN '$select_month 06:00:00' AND '$first_month_next 06:00:00' ORDER BY time DESC";
    // echo $sql_output;
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

    // print_r($data_output);
    // time : 2022-05-11 07:42:03
    // $arr_day =["2022-05-01","2022-05-02","2022-05-03"];
    $arr_day = array();
    for($i=1; $i <= $count_day; $i++){
        if($i<10){
            array_push($arr_day, date('Y-m').'-0'. $i);
        }
        else{
            array_push($arr_day, date('Y-m').'-'. $i);
        }
    }
    array_push($arr_day, date('Y') . "-" .date('m')+1 . "-01");
    // $count = 0;
    // print_r($arr_day) . "<br>";
    $arr_output_day = array();
    // print_r($arr_day);
    for($i = 0; $i < count($arr_day)-1; $i++){
        $output_daily = 0;
        for($x = 0; $x < count($data_output); $x++){
            if($i <(count($arr_day)-1) && $data_output[$x][2] >= ($arr_day[$i] . " 06:00:00") && $data_output[$x][2] < ($arr_day[$i+1] . " 06:00:00")){
                $output_daily += $data_output[$x][1];
            }
        }
        array_push($arr_output_day, $output_daily);
    }
    // print_r($arr_output_day);

    //output target for one day
    // $output_standard = "SELECT sum(output_target) AS output_std FROM " . $select_line . "_output_target " . "ORDER BY id ASC";

    $output_standard = "SELECT sum(output_target) AS output_std FROM " . "aw3_output_target " . "WHERE id BETWEEN 1 AND 16";
    $result_output_standard = mysqli_query($connect, $output_standard);
    if($result_output_standard && $result_output_standard -> num_rows > 0){
        while ($row = mysqli_fetch_array($result_output_standard)) { 
            $data_output_standard = $row['output_std'];
            // echo $data_output_standard;
        }
    }

    // echo $data_output_standard . "</br>";
    $arr_perform = array();
    for($i = 0; $i < count($arr_output_day); $i++){
        $perform_daily = ($arr_output_day[$i] / $data_output_standard) * 100;
        $perform_daily = round($perform_daily, 2);
        array_push($arr_perform, $perform_daily);
    }
    // echo 'Hieu suat . <br>';
    // print_r($arr_perform);

    //-------------------------------Lọc data short_dt------------------------------------
    $sql_short_dt = "SELECT period, name, time FROM " . $select_line . "_long_downtime " . "WHERE time BETWEEN '$select_month 06:00:00' AND '$first_month_next 06:00:00' AND period < 300 ORDER BY time DESC";
    // echo $sql_short_dt . "</br>";
    $result_short_dt = mysqli_query( $connect, $sql_short_dt );
    if ($result_short_dt && $result_short_dt->num_rows > 0) {
        $i = 0;
        while ($row = $result_short_dt->fetch_assoc()) {
            $data_short_dt[$i][0]=$row['period'];
            $data_short_dt[$i][1]=$row['name'];
            $data_short_dt[$i][2]=$row['time'];
            $i++;
        }
    }
    else{
        $data_short_dt = [];
    }
    // print_r ($data_short_dt);

    $arr_shortDt_daily = array();
    for($i = 0; $i < count($arr_day)-1; $i++){
        $period_shortDt_daily = 0;
        for($x = 0; $x < count($data_short_dt); $x++){
            if($data_short_dt[$x][2] >= ($arr_day[$i] . " 06:00:00") && $data_short_dt[$x][2] < ($arr_day[$i+1] . " 06:00:00")){
                $period_shortDt_daily += ($data_short_dt[$x][0] / (60* 860)) * 100;
                // echo $period_shortDt_daily . "<br>";
            }
        }
        $period_shortDt_daily = round($period_shortDt_daily, 2);
        array_push($arr_shortDt_daily, $period_shortDt_daily);
    }
    // echo 'data_short_dt . </br>';
    // print_r($arr_shortDt_daily);

    // $perform_periodShort = array()
    // for($i = 0; $i < count($arr_shortDt_daily); $i++) {
    //     $perform_period = round(($arr_shortDt_daily[$i] / 60) / 1275);
    //     array_push($perform_periodShort, $perform_period )
    // }

    //-------------------------------Lọc data long_dt------------------------------------
    $sql_long_dt = "SELECT period, name, time FROM " . $select_line . "_long_downtime " . "WHERE time BETWEEN '$select_month 06:00:00' AND '$first_month_next 06:00:00' AND period > 300 ORDER BY time DESC";
    // echo $sql_long_dt . "</br>";
    $result_long_dt = mysqli_query( $connect, $sql_long_dt );
    if ($result_long_dt && $result_long_dt->num_rows > 0) {
        $i = 0;
        while ($row = $result_long_dt->fetch_assoc()) {
            $data_long_dt[$i][0]=$row['period'];
            $data_long_dt[$i][1]=$row['name'];
            $data_long_dt[$i][2]=$row['time'];
            $i++;
        }
    }
    else{
        $data_long_dt = [];
    }
    // print_r($data_long_dt);
    $arr_longDt_daily = array();
    for($i = 0; $i < count($arr_day)-1; $i++){
        $period_longDt_daily = 0;
        for($x = 0; $x < count($data_long_dt); $x++){
            if($data_long_dt[$x][2] >= ($arr_day[$i] . " 06:00:00") && $data_long_dt[$x][2] < ($arr_day[$i+1] . " 06:00:00")){
                $period_longDt_daily += ($data_long_dt[$x][0] / (60*860)) * 100;
                // echo $period_shortDt_daily . "<br>";
                
            }
        }
        $period_longDt_daily = round($period_longDt_daily, 2);
        array_push($arr_longDt_daily, $period_longDt_daily);
    }
    // echo 'data_long_dt . </br>';
    // print_r($arr_longDt_daily);

    //-------------------------------Lọc data output_ng------------------------------------
    $sql_output_ng = "SELECT defect_name, time FROM " . $select_line . "_output_ng_total " . "WHERE time BETWEEN '$select_month 06:00:00' AND '$first_month_next 06:00:00' ORDER BY time DESC";
    // echo $sql_output_ng . "</br>";
    $result_output_ng = mysqli_query( $connect, $sql_output_ng );
    if ($result_output_ng && $result_output_ng->num_rows > 0) {
        $i = 0;
        while ($row = $result_output_ng->fetch_assoc()) {
            $data_output_ng[$i][0]=$row['defect_name'];
            $data_output_ng[$i][1]=$row['time'];
            $i++;
        }
    }
    else{
        $data_output_ng = [];
    }

    // print_r($data_output_ng);

    $arr_outputNg_daily = array();
    for($i = 0; $i < count($arr_day)-1; $i++){
        $period_outputNg_daily = 0;
        for($x = 0; $x < count($data_output_ng); $x++){
            if($data_output_ng[$x][1] >= ($arr_day[$i] . " 06:00:00") && $data_output_ng[$x][1] < ($arr_day[$i+1] . " 06:00:00")){
                $period_outputNg_daily = (int)$data_output_ng[$x][0];
                $period_outputNg_daily++;
                $period_outputNg_daily = (($period_outputNg_daily * 3.8) / (60 * 860)) * 100;
                // echo $period_outputNg_daily . "<br>";
            }
        }
        $period_outputNg_daily = round($period_outputNg_daily, 2);
        array_push($arr_outputNg_daily, $period_outputNg_daily);
    }
    // echo 'data_ng . </br>';
    // print_r($arr_outputNg_daily);

    //-------------------------------Lọc data speed------------------------------------
    if($select_line == "aw2"){
        $sql_speed = "SELECT period, time FROM " ."aw2_summary_speed " . "WHERE op = 99 AND time BETWEEN '$select_month 06:00:00' 
            AND '$first_month_next 06:00:00' ORDER BY time DESC";
    }else{
        $sql_speed = "SELECT period, time FROM " . $select_line . "_summary_speed " . "WHERE time BETWEEN '$select_month 06:00:00' 
            AND '$first_month_next 06:00:00' ORDER BY time DESC";
    }
    
    // echo $sql_speed . "</br>";
    $result_speed = mysqli_query( $connect, $sql_speed );
    if ($result_speed && $result_speed->num_rows > 0) {
        $i = 0;
        while ($row = $result_speed->fetch_assoc()) {
            $data_speed[$i][0]=$row['period'];
            $data_speed[$i][1]=$row['time'];
            $i++;
        }
    }
    else{
        $data_speed = [];
    }

    $arr_speed_daily = array();
    for($i = 0; $i < count($arr_day)-1; $i++){
        $period_speed_daily = 0;
        for($x = 0; $x < count($data_speed); $x++){
            if($i <(count($arr_day)-1) && $data_speed[$x][1] >= ($arr_day[$i] . " 06:00:00") && $data_speed[$x][1] < ($arr_day[$i+1] . " 06:00:00")){
                // $period_speed_daily += round((($data_speed[$x][0] / 60) / 1275) * 100, 2);
                $period_speed_daily += ($data_speed[$x][0] / (60*860)) * 100;
                // echo $data_speed[$x][1] . "<br>";
                // echo $period_speed_daily . "<br>";
            }
        }
        $period_speed_daily = round($period_speed_daily, 2);
        array_push($arr_speed_daily, $period_speed_daily);
    }
    // echo 'data_speed . </br>';
    // print_r($arr_speed_daily);

    //-------------------------------Lọc data prepare------------------------------------
    $sql_prepare = "SELECT period, time FROM " . $select_line . "_line_prepare " . "WHERE time BETWEEN '$select_month 06:00:00' 
            AND '$first_month_next 06:00:00' ORDER BY time DESC";
    // echo $sql_prepare . "</br>";
    $result_prepare = mysqli_query( $connect, $sql_prepare );
    if ($result_prepare && $result_prepare->num_rows > 0) {
        $i = 0;
        while ($row = $result_prepare->fetch_assoc()) {
            $data_prepare[$i][0]=$row['period'];
            $data_prepare[$i][1]=$row['time'];
            $i++;
        }
    }
    else{
        $data_prepare = [];
    }

    $arr_prepare_daily = array();
    for($i = 0; $i < count($arr_day)-1; $i++){
        $period_prepare_daily = 0;
        for($x = 0; $x < count($data_prepare); $x++){
            if($data_prepare[$x][1] >= ($arr_day[$i] . " 06:00:00") && $data_prepare[$x][1] < ($arr_day[$i+1] . " 06:00:00")){
                $period_prepare_daily += ($data_prepare[$x][0] / (60*860)) * 100;
                // echo $period_speed_daily . "<br>";
            }
        }
        $period_prepare_daily = round($period_prepare_daily, 2);
        array_push($arr_prepare_daily, $period_prepare_daily);
    }
    // echo 'data_prepare . </br>';
    // print_r($arr_prepare_daily);

    //-------------------------------Lọc data changing------------------------------------
    $sql_wire_electrode = "SELECT period, time FROM " . $select_line . "_change_wire " . "WHERE time BETWEEN '$select_month 06:00:00' 
            AND '$first_month_next 06:00:00' ORDER BY time DESC";
    // echo $sql_wire_electrode . "</br>";
    $result_wire_electrode = mysqli_query( $connect, $sql_wire_electrode );
    if ($result_wire_electrode && $result_wire_electrode->num_rows > 0) {
        $i = 0;
        while ($row = $result_wire_electrode->fetch_assoc()) {
            $data_wire_electrode[$i][0]=$row['period'];
            $data_wire_electrode[$i][1]=$row['time'];
            // $data_wire_electrode[$i][2]=$row['name'];
            $i++;
        }
    }
    else{
        $data_wire_electrode = [];
    }

    $arr_wire_electrode_daily = array();
    for($i = 0; $i < count($arr_day)-1; $i++){
        $period_wire_electrode_daily = 0;
        for($x = 0; $x < count($data_wire_electrode); $x++){
            if($data_wire_electrode[$x][1] >= ($arr_day[$i] . " 06:00:00") && $data_wire_electrode[$x][1] < ($arr_day[$i+1] . " 06:00:00")){
                $period_wire_electrode_daily += ($data_wire_electrode[$x][0] / (60 * 860)) * 100;
                // echo $period_speed_daily . "<br>";
            }
        }
        $period_wire_electrode_daily = round($period_wire_electrode_daily, 2);
        array_push($arr_wire_electrode_daily, $period_wire_electrode_daily);
    }

    //data change code
    $sql_change_code = "SELECT period, time FROM " . $select_line . "_code_change " . "WHERE time BETWEEN '$select_month 06:00:00' 
            AND '$first_month_next 06:00:00' ORDER BY time DESC";
    // echo $sql_change_code . "</br>";
    $result_change_code = mysqli_query( $connect, $sql_change_code );
    if ($result_change_code && $result_change_code->num_rows > 0) {
        $i = 0;
        while ($row = $result_change_code->fetch_assoc()) {
            $data_change_code[$i][0]=$row['period'];
            $data_change_code[$i][1]=$row['time'];
            // $data_wire_electrode[$i][2]=$row['name'];
            $i++;
        }
    }
    else{
        $data_change_code = [];
    }

    $arr_change_code_daily = array();
    for($i = 0; $i < count($arr_day)-1; $i++){
        $period_change_code_daily = 0;
        for($x = 0; $x < count($data_change_code); $x++){
            if($data_change_code[$x][1] >= ($arr_day[$i] . " 06:00:00") && $data_change_code[$x][1] < ($arr_day[$i+1] . " 06:00:00")){
                $period_change_code_daily += ($data_change_code[$x][0] / (60 * 860)) * 100;
                // echo $period_speed_daily . "<br>";
            }
        }
        $period_change_code_daily = round($period_change_code_daily, 2);
        array_push($arr_change_code_daily, $period_change_code_daily);
    }
    // echo 'data_change . </br>';
    // print_r($arr_change_code_daily);
    
    //sum 2 array $arr_wire_electrode_daily and $arr_change_code_daily
    $arr_chaging_daily = array_map(function (...$arrays) {
        return array_sum($arrays);
    }, $arr_change_code_daily, $arr_wire_electrode_daily);
    
    // print_r($arr_chaging_daily);

    $sums_array = array();
    $sums_array = array_map(function (...$arrays){
        return array_sum($arrays);
    }, $arr_chaging_daily, $arr_prepare_daily, $arr_speed_daily, 
        $arr_outputNg_daily, $arr_longDt_daily, $arr_shortDt_daily, $arr_perform);

    // print_r($sums_array);
    for($i = 0; $i < count($arr_output_day); $i++){
        if($arr_output_day[$i] == 0){
            $arr_shortDt_daily[$i] = 'null';
            $arr_longDt_daily[$i] = 'null';
            $arr_outputNg_daily[$i] = 'null';
            $arr_speed_daily[$i] = 'null';
            $arr_prepare_daily[$i] = 'null';
            $arr_chaging_daily[$i] = 'null';
        }
    }
?>

