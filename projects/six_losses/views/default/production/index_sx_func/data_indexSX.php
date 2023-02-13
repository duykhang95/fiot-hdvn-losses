<!-- <pre> -->
<?php
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];

    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;

    // $month_year = date('Y-m');
    // $count_day = cal_days_in_month(CAL_GREGORIAN, 05, 2022);

    $year = date('Y');
    $month = date('m');
    

    $count_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $curr_month = date('Y-m');

    $previous_month_tmp = mktime(0, 0, 0, date("m")-1 , date("d"), date("Y"));
    $previous_month = date('Y-m', $previous_month_tmp);
    // echo $previous_month . "<br>";

    $previous_2month_tmp = mktime(0, 0, 0, date("m")-2 , date("d"), date("Y"));
    $previous_2month = date('Y-m', $previous_2month_tmp);
    // echo $previous_2month . "<br>";

    $arr_shortDT_losses = array();
    $arr_longDT_losses = array();
    $arr_ng_losses = array();
    $arr_speed_losses = array();
    $arr_prepare_losses = array();
    $arr_changing_losses = array();

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

    // print_r($arr_month);

    for($k = 0; $k < count($arr_month); $k++){
        if($k == 0){
			$select_month = "2022-11";
			$select_next_month = "2022-12";
		}
		else if($k == 1){
			$select_month = "2022-12";
			$select_next_month = "2023-01";
		}
        else if($k == 2){
			$select_month = "2023-01";
			$select_next_month = "2023-02";
		}
        // if($k == 0 || $k == 1){
        //     $select_month = date('Y')-1 . "-" . $arr_month[$k];
        // }
        // else{
        //     $select_month = date('Y') . "-" . $arr_month[$k];
        // }
        // $select_month = date('Y') . "-" . $arr_month[$k];
        // $select_month = "2023-01";
        // if($k == (count($arr_month)-1)){
        //     $select_next_month = date('Y')+1 . "-" . $arr_month[0];
        // }else{
        //     $select_next_month = date('Y') . "-" . $arr_month[$k+1];
        // }
        // echo $select_month . "<br>";
        $count_output_of_day = 0;
        $arr_time_of_day = array();
        $output_monthly = 0;
        $output_monthly_nm = 0;
        $fday_month = $select_month . "-01 06:00:00";
        $fday_next_month = $select_next_month . "-01 06:00:00";
        $last_day_month = date('Y-m-t', strtotime($select_month)) . " " . "23:59:59";
        // echo $last_day_month . "<br>";
        //data output-----------------------------------------------------------------
        if($k == 0){
            $sql_output= "SELECT * FROM " . $select_line. "_hourly_output " . "WHERE time BETWEEN '2022-11-01 06:00:00' AND '2022-12-01 06:00:00' ORDER BY time DESC";
        }
        else if($k == 1){
            $sql_output= "SELECT * FROM " . $select_line. "_hourly_output " . "WHERE time BETWEEN '2022-12-01 06:00:00' AND '2023-01-01 06:00:00' ORDER BY time DESC";
        }
        else if($k == 2){
            $sql_output= "SELECT * FROM " . $select_line. "_hourly_output " . "WHERE time BETWEEN '2023-01-01 06:00:00' AND '2023-02-01 06:00:00' ORDER BY time DESC";
        }
        // $sql_output= "SELECT * FROM " . $select_line. "_hourly_output " . "WHERE time BETWEEN '$fday_month' AND '$fday_next_month' ORDER BY time DESC";
        // echo $sql_output . "<br>";
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
        unset($data_output);
        // echo $previous_2month . "<br>";
        // echo $select_month . "<br>";
        if($select_month == $previous_2month){
            // echo $hello . "<br>";
            //data short_downtime--------------------------------------------------------
            $short_downtime = "SELECT * FROM " . $select_line . "_long_downtime" . " WHERE time BETWEEN '$fday_month' AND '$fday_next_month' 
                                AND period < 300 ORDER BY time DESC";
            // echo $short_downtime . "<br>";
            $resultcheck_short = mysqli_query( $connect, $short_downtime );
            if ($resultcheck_short && $resultcheck_short->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_short->fetch_assoc()) {
                    //thêm k?t qu? vào m?ng
                    $data_short_downtime[$i][0]=$row['period'];
                    $data_short_downtime[$i][1]=$row['name'];
                    $i++;
                }
            }
            else{
                $data_short_downtime = [];
                // $data_short_downtime[0][2]='';        
            }
            // print_r($data_short_downtime);
            
            $arr_short_tmp1 = array();
            $arr_short_tmp2 = array();

            for ($i = 0 ; $i < count($data_short_downtime); $i++){
                if (!in_array($data_short_downtime[$i][1], $arr_short_tmp1, true)){
                    array_push($arr_short_tmp1, $data_short_downtime[$i][1]);
                    array_push($arr_short_tmp2, array($data_short_downtime[$i][1], 0 ,0));
                }
            }

            for ($i = 0 ; $i < count($data_short_downtime); $i++){
                if (in_array($data_short_downtime[$i][1], $arr_short_tmp1, true)){
                    $tmp_short = array_search($data_short_downtime[$i][1], $arr_short_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_short_tmp2[$tmp_short][1] += 1;
                    $arr_short_tmp2[$tmp_short][2] += (int)$data_short_downtime[$i][0];
                }
            }
            // print_r($arr_short_tmp2);
            // print_r($arr_short_tmp2);
            for($i = 0; $i < count($arr_short_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_short_tmp2[$i][2] = 'null';
                    // array_push($arr_shortDT_monthly, $arr_short_tmp2[$i][0]);
                }
                else{
                    $arr_short_tmp2[$i][2] = ($arr_short_tmp2[$i][2] /  (60*1275* $count_output_of_day))  * 100;
                    $arr_short_tmp2[$i][2] = round($arr_short_tmp2[$i][2], 2);
                    array_push($arr_shortDT_monthly, $arr_short_tmp2[$i][0]);
                }
            }

            // đổ dữ liệu vào arr_shortDT_losses--
            $arr_shortDT_losses[0] = $arr_short_tmp2;
            //--------------------------------end short_downtime--------------------------------------------

            //data long_downtime--------------------------------------------------------
            $long_downtime = "SELECT * FROM " . $select_line . "_long_downtime" . " WHERE time BETWEEN '$fday_month' AND '$fday_next_month' 
                                AND period >= 300 ORDER BY time DESC";
            // echo $long_downtime . "<br>";
            $resultcheck_long = mysqli_query( $connect, $long_downtime );
            if ($resultcheck_long && $resultcheck_long->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_long->fetch_assoc()) {
                    //thêm k?t qu? vào m?ng
                    $data_long_downtime[$i][0]=$row['period'];
                    $data_long_downtime[$i][1]=$row['name'];
                    // $data_long_downtime[$i][2]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_long_downtime = [];       
            }

            // print_r($data_long_downtime);
            
            $arr_long_tmp1 = array();
            $arr_long_tmp2 = array();

            for ($i = 0 ; $i < count($data_long_downtime); $i++){
                if (!in_array($data_long_downtime[$i][1], $arr_long_tmp1, true)){
                    array_push($arr_long_tmp1, $data_long_downtime[$i][1]);
                    array_push($arr_long_tmp2, array($data_long_downtime[$i][1], 0 ,0));
                }
            }

            for ($i = 0 ; $i < count($data_long_downtime); $i++){
                if (in_array($data_long_downtime[$i][1], $arr_long_tmp1, true)){
                    $tmp_long = array_search($data_long_downtime[$i][1], $arr_long_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_long_tmp2[$tmp_long][1] += 1;
                    $arr_long_tmp2[$tmp_long][2] += (int)$data_long_downtime[$i][0];
                }
            }
            // print_r($arr_long_tmp2);
            for($i = 0; $i < count($arr_long_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_long_tmp2[$i][2] = 'null';
                    // array_push($arr_longDT_monthly, $arr_long_tmp2[$i][0]);
                }
                else{
                    $arr_long_tmp2[$i][2] = ($arr_long_tmp2[$i][2] / (60*1275*$count_output_of_day)) * 100;
                    $arr_long_tmp2[$i][2] = round($arr_long_tmp2[$i][2], 2);
                    array_push($arr_longDT_monthly, $arr_long_tmp2[$i][0]);
                }
            }
            // đổ dữ liệu vào arr_longDT_losses--
            $arr_longDT_losses[0] = $arr_long_tmp2;
            //-----------------------end long_downtime------------------------------
            
            //data ng losses--------------------------------------------------------
            $ng_output = "SELECT * FROM " . $select_line . "_output_ng_total" . " WHERE `time` BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $ng_output . "<br>";
            $resultcheck_ng = mysqli_query( $connect, $ng_output );
            if ($resultcheck_ng && $resultcheck_ng->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_ng->fetch_assoc()) {
                    //thêm k?t qu? vào m?ng
                    $data_output_ng[$i][0]=$row['op'];
                    $data_output_ng[$i][1]=$row['defect_name'];                   
                    $i++;
                }
            }
            else{
                $data_output_ng = [];       
            }

            // print_r($data_long_downtime);
            
            $arr_ng_tmp1 = array();
            $arr_ng_tmp2 = array();

            for ($i = 0 ; $i < count($data_output_ng); $i++){
                if (!in_array($data_output_ng[$i][1], $arr_ng_tmp1, true)){
                    array_push($arr_ng_tmp1, $data_output_ng[$i][1]);
                    array_push($arr_ng_tmp2, array($data_output_ng[$i][1], 0));
                }
            }

            for ($i = 0 ; $i < count($data_output_ng); $i++){
                if (in_array($data_output_ng[$i][1], $arr_ng_tmp1, true)){
                    $tmp_ng = array_search($data_output_ng[$i][1], $arr_ng_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_ng_tmp2[$tmp_ng][1] += 1;
                }
            }
            // print_r($arr_ng_tmp2);
            for($i = 0; $i < count($arr_ng_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_ng_tmp2[$i][1] = 'null';
                }
                else{
                    $arr_ng_tmp2[$i][1] = (($arr_ng_tmp2[$i][1] * 3.8) / (60*1275*$count_output_of_day)) * 100;
                    $arr_ng_tmp2[$i][1] = round($arr_ng_tmp2[$i][1], 2);
                    array_push($arr_ng_monthly, $arr_ng_tmp2[$i][0]);
                }
            }

            // đổ dữ liệu vào arr_longDT_losses--
            $arr_ng_losses[0] = $arr_ng_tmp2;
            //-----------------------end long_downtime------------------------------

            //data speed------------------------------------------------------------
            $speed = "SELECT * FROM " . $select_line . "_summary_speed " . "WHERE op = 99 AND time 
                        BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $speed . "<br>";
            $resultcheck_speed = mysqli_query( $connect, $speed );
            if ($resultcheck_speed && $resultcheck_speed->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_speed->fetch_assoc()) {
                    $data_speed[$i][0]=$row['op'];
                    $data_speed[$i][1]=$row['period'];
                    $i++;
                }
            }
            else{
                $data_speed = [];
            }

            for($i = 0; $i < count($data_speed); $i++){
                $data_speed[$i][0] = "Kiểm tra đặc tính (特性検査)";   
            }
        
            $arr_speed_tmp1 = array();
            $arr_speed_tmp2 = array();
            for ($i = 0 ; $i < count($data_speed); $i++){
                if (!in_array($data_speed[$i][0], $arr_speed_tmp1, true)){
                    array_push($arr_speed_tmp1, $data_speed[$i][0]);
                    array_push($arr_speed_tmp2, array($data_speed[$i][0], 0, 0));
                }
            }
            for ($i = 0 ; $i < count($data_speed); $i++){
                if (in_array($data_speed[$i][0], $arr_speed_tmp1, true)){
                    $tmp_speed = array_search($data_speed[$i][0], $arr_speed_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_speed_tmp2[$tmp_speed][1] += 1;
                    $arr_speed_tmp2[$tmp_speed][2] += (int)$data_speed[$i][1];
                }
            }

            // print_r($arr_speed_tmp2);

            for($i = 0; $i < count($arr_speed_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_speed_tmp2[$i][1] = 'null';
                }
                else{
                    $arr_speed_tmp2[$i][1] = ($arr_speed_tmp2[$i][1] / (60*1275*$count_output_of_day)) * 100;
                    $arr_speed_tmp2[$i][1] = round($arr_speed_tmp2[$i][1], 2);
                    array_push($arr_speed_monthly, $arr_speed_tmp2[$i][0]);
                }
            }

            $arr_speed_losses[0] = $arr_speed_tmp2;

            //data preparing---------------------------------------------------------------
            $sql_prepare = "SELECT * FROM " . $select_line . "_line_prepare " . "WHERE time
                            BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $sql_prepare . "</br>";
            $result_prepare = mysqli_query( $connect, $sql_prepare );
            if ($result_prepare && $result_prepare->num_rows > 0) {
                $i = 0;
                while ($row = $result_prepare->fetch_assoc()) {
                    $data_line_prepare[$i][0]=$row['sub_time'];
                    $data_line_prepare[$i][1]=$row['period'];
                    $i++;
                }
            }
            else{
                $data_line_prepare = [];
            }

            for($i = 0; $i < count($data_line_prepare); $i++){
                if($data_line_prepare[$i][0] == "begin1" || $data_line_prepare[$i][0] == "begin2" || $data_line_prepare[$i][0] == "begin3"){
                    $data_line_prepare[$i][0] = "Đầu Ca";
                }
                else{
                    $data_line_prepare[$i][0] = "Cuối Ca";
                }
            }

            $arr_prepare_tmp1 = array();
            $arr_prepare_tmp2 = array();
            for ($i = 0 ; $i < count($data_line_prepare); $i++){
                if (!in_array($data_line_prepare[$i][0], $arr_prepare_tmp1, true)){
                    array_push($arr_prepare_tmp1, $data_line_prepare[$i][0]);
                    array_push($arr_prepare_tmp2, array($data_line_prepare[$i][0], 0, 0));
                }
            }
            for ($i = 0 ; $i < count($data_line_prepare); $i++){
                if (in_array($data_line_prepare[$i][0], $arr_prepare_tmp1, true)){
                    $tmp_prepare = array_search($data_line_prepare[$i][0], $arr_prepare_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_prepare_tmp2[$tmp_prepare][1] += 1;
                    $arr_prepare_tmp2[$tmp_prepare][2] += (int)$data_line_prepare[$i][1];
                }
            }

            for($i = 0; $i < count($arr_prepare_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_prepare_tmp2[$i][1] = 'null';
                }
                else{
                    $arr_prepare_tmp2[$i][1] = ($arr_prepare_tmp2[$i][2] / (60*1275*$count_output_of_day)) * 100;
                    $arr_prepare_tmp2[$i][1] = round($arr_prepare_tmp2[$i][1], 2);
                    array_push($arr_prepare_monthly, $arr_prepare_tmp2[$i][0]);
                }
            }

            $arr_prepare_losses[0] = $arr_prepare_tmp2;

            //data changing-------------------------------------------------------------
            $sql_change_code = "SELECT code, period FROM " . $select_line . "_code_change " . 
                                "WHERE time BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $sql_change_code . "</br>";
            $result_change_code = mysqli_query( $connect, $sql_change_code );
            if ($result_change_code && $result_change_code->num_rows > 0) {
                $i = 0;
                while ($row = $result_change_code->fetch_assoc()) {
                    $data_change_code[$i][0]=$row['code'];
                    $data_change_code[$i][1]=$row['period'];
                    $i++;
                }
            }
            else{
                $data_change_code = [];
            }
            // print_r($data_change_code);

            for($i = 0; $i < count($data_change_code); $i++){
                $data_change_code[$i][0]= 'Thay Mã';
            }

            $arr_change_code_tmp1 = array();
            $arr_change_code_tmp2 = array();
            for ($i = 0 ; $i < count($data_change_code); $i++){
                if (!in_array($data_change_code[$i][0], $arr_change_code_tmp1, true)){
                    array_push($arr_change_code_tmp1, $data_change_code[$i][0]);
                    array_push($arr_change_code_tmp2, array($data_change_code[$i][0], 0, 0));
                }
            }
            for ($i = 0 ; $i < count($data_change_code); $i++){
                if (in_array($data_change_code[$i][0], $arr_change_code_tmp1, true)){
                    $tmp_change_code = array_search($data_change_code[$i][0], $arr_change_code_tmp1);
                    $arr_change_code_tmp2[$tmp_change_code][1] += 1;
                    $arr_change_code_tmp2[$tmp_change_code][2] += (int)$data_change_code[$i][1];
                }
            }

            // print_r($arr_change_code_tmp2);

            $sql_wire_electrode = "SELECT id_name, period FROM " . $select_line . "_change_wire " . 
                                "WHERE time BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $sql_wire_electrode . "</br>";
            $result_wire_electrode = mysqli_query( $connect, $sql_wire_electrode );
            if ($result_wire_electrode && $result_wire_electrode->num_rows > 0) {
                $i = 0;
                while ($row = $result_wire_electrode->fetch_assoc()) {
                    $data_wire_electrode[$i][0]=$row['id_name'];
                    $data_wire_electrode[$i][1]=$row['period'];
                    $i++;
                }
            }
            else{
                $data_wire_electrode = [];
            }
            
            for($i = 0; $i < count($data_wire_electrode); $i++){
                if($data_wire_electrode[$i][0] == 1177 || $data_wire_electrode[$i][0] == 1178 || $data_wire_electrode[$i][0] == 1078
                    || $data_wire_electrode[$i][0] == 1079){
                    $data_wire_electrode[$i][0] = 'Thay Dây Đồng';
                }
                else{
                    $data_wire_electrode[$i][0] = 'Thay Điện Cực';
                }
            }

            // print_r($data_wire_electrode);
            $arr_wire_electrode_tmp1 = array();
            $arr_wire_electrode_tmp2 = array();
            for ($i = 0 ; $i < count($data_wire_electrode); $i++){
                if (!in_array($data_wire_electrode[$i][0], $arr_wire_electrode_tmp1, true)){
                    array_push($arr_wire_electrode_tmp1, $data_wire_electrode[$i][0]);
                    array_push($arr_wire_electrode_tmp2, array($data_wire_electrode[$i][0], 0, 0));
                }
            }
            for ($i = 0 ; $i < count($data_wire_electrode); $i++){
                if (in_array($data_wire_electrode[$i][0], $arr_wire_electrode_tmp1, true)){
                    $tmp_wire_electrode = array_search($data_wire_electrode[$i][0], $arr_wire_electrode_tmp1);
                    $arr_wire_electrode_tmp2[$tmp_wire_electrode][1] += 1;
                    $arr_wire_electrode_tmp2[$tmp_wire_electrode][2] += (int)$data_wire_electrode[$i][1];
                }
            }
            // print_r($arr_wire_electrode_tmp2);
            $data_changing = array_merge($arr_change_code_tmp2, $arr_wire_electrode_tmp2);
            for($i = 0; $i < count($data_changing); $i++){
                if($count_output_of_day == 0){
                    $data_changing[$i][2] = 'null';
                }
                else{
                    $data_changing[$i][2] = ($data_changing[$i][2] / (60*1275*$count_output_of_day)) * 100;
                    $data_changing[$i][2] = round($data_changing[$i][2], 2);
                    array_push($arr_changing_monthly, $data_changing[$i][0]);
                }
            }

            $arr_changing_losses[0] = $data_changing;
            // print_r($data_changing);
        }
        else if($select_month == $previous_month){
            //data short_downtime--------------------------------------------------------
            $short_downtime = "SELECT * FROM " . $select_line . "_long_downtime" . " WHERE time BETWEEN '$fday_month' AND '$fday_next_month' 
                                AND period < 300 ORDER BY time DESC";
            // echo $short_downtime . "<br>";
            $resultcheck_short = mysqli_query( $connect, $short_downtime );
            if ($resultcheck_short && $resultcheck_short->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_short->fetch_assoc()) {
                    //thêm k?t qu? vào m?ng
                    $data_short_downtime[$i][0]=$row['period'];
                    $data_short_downtime[$i][1]=$row['name'];
                    $i++;
                }
            }
            else{
                $data_short_downtime = [];
                // $data_short_downtime[0][2]='';        
            }
            // print_r($data_short_downtime);
            
            $arr_short_tmp1 = array();
            $arr_short_tmp2 = array();

            for ($i = 0 ; $i < count($data_short_downtime); $i++){
                if (!in_array($data_short_downtime[$i][1], $arr_short_tmp1, true)){
                    array_push($arr_short_tmp1, $data_short_downtime[$i][1]);
                    array_push($arr_short_tmp2, array($data_short_downtime[$i][1], 0 ,0));
                }
            }

            for ($i = 0 ; $i < count($data_short_downtime); $i++){
                if (in_array($data_short_downtime[$i][1], $arr_short_tmp1, true)){
                    $tmp_short = array_search($data_short_downtime[$i][1], $arr_short_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_short_tmp2[$tmp_short][1] += 1;
                    $arr_short_tmp2[$tmp_short][2] += (int)$data_short_downtime[$i][0];
                }
            }
            // print_r($arr_short_tmp2);
            // print_r($arr_short_tmp2);
            for($i = 0; $i < count($arr_short_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_short_tmp2[$i][2] = 'null';
                    // array_push($arr_shortDT_monthly, $arr_short_tmp2[$i][0]);
                }
                else{
                    $arr_short_tmp2[$i][2] = ($arr_short_tmp2[$i][2] /  (60*1275* $count_output_of_day))  * 100;
                    $arr_short_tmp2[$i][2] = round( $arr_short_tmp2[$i][2], 2);
                    array_push($arr_shortDT_monthly, $arr_short_tmp2[$i][0]);
                }
            }

            // đổ dữ liệu vào arr_shortDT_losses--
            $arr_shortDT_losses[1] = $arr_short_tmp2;
            //--------------------------------end short_downtime--------------------------------------------

            //data long_downtime--------------------------------------------------------
            $long_downtime = "SELECT * FROM " . $select_line . "_long_downtime" . " WHERE time BETWEEN '$fday_month' AND '$fday_next_month' 
                                AND period >= 300 ORDER BY time DESC";
            // echo $long_downtime . "<br>";
            $resultcheck_long = mysqli_query( $connect, $long_downtime );
            if ($resultcheck_long && $resultcheck_long->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_long->fetch_assoc()) {
                    //thêm k?t qu? vào m?ng
                    $data_long_downtime[$i][0]=$row['period'];
                    $data_long_downtime[$i][1]=$row['name'];
                    // $data_long_downtime[$i][2]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_long_downtime = [];       
            }

            // print_r($data_long_downtime);
            
            $arr_long_tmp1 = array();
            $arr_long_tmp2 = array();

            for ($i = 0 ; $i < count($data_long_downtime); $i++){
                if (!in_array($data_long_downtime[$i][1], $arr_long_tmp1, true)){
                    array_push($arr_long_tmp1, $data_long_downtime[$i][1]);
                    array_push($arr_long_tmp2, array($data_long_downtime[$i][1], 0 ,0));
                }
            }

            for ($i = 0 ; $i < count($data_long_downtime); $i++){
                if (in_array($data_long_downtime[$i][1], $arr_long_tmp1, true)){
                    $tmp_long = array_search($data_long_downtime[$i][1], $arr_long_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_long_tmp2[$tmp_long][1] += 1;
                    $arr_long_tmp2[$tmp_long][2] += (int)$data_long_downtime[$i][0];
                }
            }
            // print_r($arr_long_tmp2);
            for($i = 0; $i < count($arr_long_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_long_tmp2[$i][2] = 'null';
                    // array_push($arr_longDT_monthly, $arr_long_tmp2[$i][0]);
                }
                else{
                    $arr_long_tmp2[$i][2] = ($arr_long_tmp2[$i][2] / (60*1275*$count_output_of_day)) * 100;
                    $arr_long_tmp2[$i][2] = round($arr_long_tmp2[$i][2], 2);
                    array_push($arr_longDT_monthly, $arr_long_tmp2[$i][0]);
                }
            }
            // đổ dữ liệu vào arr_longDT_losses--
            $arr_longDT_losses[1] = $arr_long_tmp2;
            //-----------------------end long_downtime------------------------------
            
            //data ng losses--------------------------------------------------------
            $ng_output = "SELECT * FROM " . $select_line . "_output_ng_total" . " WHERE `time` BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $ng_output . "<br>";
            $resultcheck_ng = mysqli_query( $connect, $ng_output );
            if ($resultcheck_ng && $resultcheck_ng->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_ng->fetch_assoc()) {
                    //thêm k?t qu? vào m?ng
                    $data_output_ng[$i][0]=$row['op'];
                    $data_output_ng[$i][1]=$row['defect_name'];                   
                    $i++;
                }
            }
            else{
                $data_output_ng = [];       
            }

            // print_r($data_long_downtime);
            
            $arr_ng_tmp1 = array();
            $arr_ng_tmp2 = array();

            for ($i = 0 ; $i < count($data_output_ng); $i++){
                if (!in_array($data_output_ng[$i][1], $arr_ng_tmp1, true)){
                    array_push($arr_ng_tmp1, $data_output_ng[$i][1]);
                    array_push($arr_ng_tmp2, array($data_output_ng[$i][1], 0));
                }
            }

            for ($i = 0 ; $i < count($data_output_ng); $i++){
                if (in_array($data_output_ng[$i][1], $arr_ng_tmp1, true)){
                    $tmp_ng = array_search($data_output_ng[$i][1], $arr_ng_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_ng_tmp2[$tmp_ng][1] += 1;
                }
            }
            // print_r($arr_ng_tmp2);
            for($i = 0; $i < count($arr_ng_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_ng_tmp2[$i][1] = 'null';
                }
                else{
                    $arr_ng_tmp2[$i][1] = (($arr_ng_tmp2[$i][1] * 3.8) / (60*1275*$count_output_of_day)) * 100;
                    $arr_ng_tmp2[$i][1] = round($arr_ng_tmp2[$i][1], 2);
                    array_push($arr_ng_monthly, $arr_ng_tmp2[$i][0]);
                }
            }

            // đổ dữ liệu vào arr_longDT_losses--
            $arr_ng_losses[1] = $arr_ng_tmp2;
            //-----------------------end long_downtime------------------------------

            //data speed------------------------------------------------------------
            $speed = "SELECT * FROM " . $select_line . "_summary_speed " . "WHERE op = 99 AND time 
                        BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $speed . "<br>";
            $resultcheck_speed = mysqli_query( $connect, $speed );
            if ($resultcheck_speed && $resultcheck_speed->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_speed->fetch_assoc()) {
                    $data_speed[$i][0]=$row['op'];
                    $data_speed[$i][1]=$row['period'];
                    $i++;
                }
            }
            else{
                $data_speed = [];
            }

            for($i = 0; $i < count($data_speed); $i++){
                if($data_speed[$i][0] == 99){
                    $data_speed[$i][0] = "Kiểm tra đặc tính (特性検査)";
                }
            }
        
            $arr_speed_tmp1 = array();
            $arr_speed_tmp2 = array();
            for ($i = 0 ; $i < count($data_speed); $i++){
                if (!in_array($data_speed[$i][0], $arr_speed_tmp1, true)){
                    array_push($arr_speed_tmp1, $data_speed[$i][0]);
                    array_push($arr_speed_tmp2, array($data_speed[$i][0], 0, 0));
                }
            }
            for ($i = 0 ; $i < count($data_speed); $i++){
                if (in_array($data_speed[$i][0], $arr_speed_tmp1, true)){
                    $tmp_speed = array_search($data_speed[$i][0], $arr_speed_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_speed_tmp2[$tmp_speed][1] += 1;
                    $arr_speed_tmp2[$tmp_speed][2] += (int)$data_speed[$i][1];
                }
            }

            // print_r($arr_speed_tmp2);

            for($i = 0; $i < count($arr_speed_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_speed_tmp2[$i][1] = 'null';
                }
                else{
                    $arr_speed_tmp2[$i][1] = ($arr_speed_tmp2[$i][1] / (60*1275*$count_output_of_day)) * 100;
                    $arr_speed_tmp2[$i][1] = round($arr_speed_tmp2[$i][1], 2);
                    array_push($arr_speed_monthly, $arr_speed_tmp2[$i][0]);
                }
            }

            $arr_speed_losses[1] = $arr_speed_tmp2;

            //data preparing---------------------------------------------------------------
            $sql_prepare = "SELECT * FROM " . $select_line . "_line_prepare " . "WHERE time
                            BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $sql_prepare . "</br>";
            $result_prepare = mysqli_query( $connect, $sql_prepare );
            if ($result_prepare && $result_prepare->num_rows > 0) {
                $i = 0;
                while ($row = $result_prepare->fetch_assoc()) {
                    $data_line_prepare[$i][0]=$row['sub_time'];
                    $data_line_prepare[$i][1]=$row['period'];
                    $i++;
                }
            }
            else{
                $data_line_prepare = [];
            }

            for($i = 0; $i < count($data_line_prepare); $i++){
                if($data_line_prepare[$i][0] == "begin1" || $data_line_prepare[$i][0] == "begin2" || $data_line_prepare[$i][0] == "begin3"){
                    $data_line_prepare[$i][0] = "Đầu Ca";
                }
                else{
                    $data_line_prepare[$i][0] = "Cuối Ca";
                }
            }

            $arr_prepare_tmp1 = array();
            $arr_prepare_tmp2 = array();
            for ($i = 0 ; $i < count($data_line_prepare); $i++){
                if (!in_array($data_line_prepare[$i][0], $arr_prepare_tmp1, true)){
                    array_push($arr_prepare_tmp1, $data_line_prepare[$i][0]);
                    array_push($arr_prepare_tmp2, array($data_line_prepare[$i][0], 0, 0));
                }
            }
            for ($i = 0 ; $i < count($data_line_prepare); $i++){
                if (in_array($data_line_prepare[$i][0], $arr_prepare_tmp1, true)){
                    $tmp_prepare = array_search($data_line_prepare[$i][0], $arr_prepare_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_prepare_tmp2[$tmp_prepare][1] += 1;
                    $arr_prepare_tmp2[$tmp_prepare][2] += (int)$data_line_prepare[$i][1];
                }
            }

            for($i = 0; $i < count($arr_prepare_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_prepare_tmp2[$i][1] = 'null';
                }
                else{
                    $arr_prepare_tmp2[$i][1] = ($arr_prepare_tmp2[$i][2] / (60*1275*$count_output_of_day)) * 100;
                    $arr_prepare_tmp2[$i][1] = round($arr_prepare_tmp2[$i][1], 2);
                    array_push($arr_prepare_monthly, $arr_prepare_tmp2[$i][0]);
                }
            }
            $arr_prepare_losses[1] = $arr_prepare_tmp2;

            //data changing-------------------------------------------------------------
            $sql_change_code = "SELECT code, period FROM " . $select_line . "_code_change " . 
                                "WHERE time BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $sql_change_code . "</br>";
            $result_change_code = mysqli_query( $connect, $sql_change_code );
            if ($result_change_code && $result_change_code->num_rows > 0) {
                $i = 0;
                while ($row = $result_change_code->fetch_assoc()) {
                    $data_change_code[$i][0]=$row['code'];
                    $data_change_code[$i][1]=$row['period'];
                    $i++;
                }
            }
            else{
                $data_change_code = [];
            }
            // print_r($data_change_code);

            for($i = 0; $i < count($data_change_code); $i++){
                $data_change_code[$i][0]= 'Thay Mã';
            }

            $arr_change_code_tmp1 = array();
            $arr_change_code_tmp2 = array();
            for ($i = 0 ; $i < count($data_change_code); $i++){
                if (!in_array($data_change_code[$i][0], $arr_change_code_tmp1, true)){
                    array_push($arr_change_code_tmp1, $data_change_code[$i][0]);
                    array_push($arr_change_code_tmp2, array($data_change_code[$i][0], 0, 0));
                }
            }
            for ($i = 0 ; $i < count($data_change_code); $i++){
                if (in_array($data_change_code[$i][0], $arr_change_code_tmp1, true)){
                    $tmp_change_code = array_search($data_change_code[$i][0], $arr_change_code_tmp1);
                    $arr_change_code_tmp2[$tmp_change_code][1] += 1;
                    $arr_change_code_tmp2[$tmp_change_code][2] += (int)$data_change_code[$i][1];
                }
            }

            // print_r($arr_change_code_tmp2);

            $sql_wire_electrode = "SELECT id_name, period FROM " . $select_line . "_change_wire " . 
                                "WHERE time BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $sql_wire_electrode . "</br>";
            $result_wire_electrode = mysqli_query( $connect, $sql_wire_electrode );
            if ($result_wire_electrode && $result_wire_electrode->num_rows > 0) {
                $i = 0;
                while ($row = $result_wire_electrode->fetch_assoc()) {
                    $data_wire_electrode[$i][0]=$row['id_name'];
                    $data_wire_electrode[$i][1]=$row['period'];
                    $i++;
                }
            }
            else{
                $data_wire_electrode = [];
            }
            
            for($i = 0; $i < count($data_wire_electrode); $i++){
                if($data_wire_electrode[$i][0] == 1177 || $data_wire_electrode[$i][0] == 1178 || $data_wire_electrode[$i][0] == 1078
                    || $data_wire_electrode[$i][0] == 1079){
                    $data_wire_electrode[$i][0] = 'Thay Dây Đồng';
                }
                else{
                    $data_wire_electrode[$i][0] = 'Thay Điện Cực';
                }
            }

            // print_r($data_wire_electrode);
            $arr_wire_electrode_tmp1 = array();
            $arr_wire_electrode_tmp2 = array();
            for ($i = 0 ; $i < count($data_wire_electrode); $i++){
                if (!in_array($data_wire_electrode[$i][0], $arr_wire_electrode_tmp1, true)){
                    array_push($arr_wire_electrode_tmp1, $data_wire_electrode[$i][0]);
                    array_push($arr_wire_electrode_tmp2, array($data_wire_electrode[$i][0], 0, 0));
                }
            }
            for ($i = 0 ; $i < count($data_wire_electrode); $i++){
                if (in_array($data_wire_electrode[$i][0], $arr_wire_electrode_tmp1, true)){
                    $tmp_wire_electrode = array_search($data_wire_electrode[$i][0], $arr_wire_electrode_tmp1);
                    $arr_wire_electrode_tmp2[$tmp_wire_electrode][1] += 1;
                    $arr_wire_electrode_tmp2[$tmp_wire_electrode][2] += (int)$data_wire_electrode[$i][1];
                }
            }
            // print_r($arr_wire_electrode_tmp2);
            $data_changing = array_merge($arr_change_code_tmp2, $arr_wire_electrode_tmp2);
            for($i = 0; $i < count($data_changing); $i++){
                if($count_output_of_day == 0){
                    $data_changing[$i][2] = 'null';
                }
                else{
                    $data_changing[$i][2] = ($data_changing[$i][2] / (60*1275*$count_output_of_day)) * 100;
                    $data_changing[$i][2] = round($data_changing[$i][2], 2);
                    array_push($arr_changing_monthly, $data_changing[$i][0]);
                }
            }

            $arr_changing_losses[1] = $data_changing;
            // print_r($data_changing);
        }
        else if($select_month == $curr_month){
            //data short_downtime--------------------------------------------------------
            $short_downtime = "SELECT * FROM " . $select_line . "_long_downtime" . " WHERE time BETWEEN '$fday_month' AND '$fday_next_month' 
                                AND period < 300 ORDER BY time DESC";
            // echo $short_downtime . "<br>";
            $resultcheck_short = mysqli_query( $connect, $short_downtime );
            if ($resultcheck_short && $resultcheck_short->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_short->fetch_assoc()) {
                    //thêm k?t qu? vào m?ng
                    $data_short_downtime[$i][0]=$row['period'];
                    $data_short_downtime[$i][1]=$row['name'];
                    $i++;
                }
            }
            else{
                $data_short_downtime = [];
                // $data_short_downtime[0][2]='';        
            }
            // print_r($data_short_downtime);
            
            $arr_short_tmp1 = array();
            $arr_short_tmp2 = array();

            for ($i = 0 ; $i < count($data_short_downtime); $i++){
                if (!in_array($data_short_downtime[$i][1], $arr_short_tmp1, true)){
                    array_push($arr_short_tmp1, $data_short_downtime[$i][1]);
                    array_push($arr_short_tmp2, array($data_short_downtime[$i][1], 0 ,0));
                }
            }

            for ($i = 0 ; $i < count($data_short_downtime); $i++){
                if (in_array($data_short_downtime[$i][1], $arr_short_tmp1, true)){
                    $tmp_short = array_search($data_short_downtime[$i][1], $arr_short_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_short_tmp2[$tmp_short][1] += 1;
                    $arr_short_tmp2[$tmp_short][2] += (int)$data_short_downtime[$i][0];
                }
            }
            // print_r($arr_short_tmp2);
            // print_r($arr_short_tmp2);
            for($i = 0; $i < count($arr_short_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_short_tmp2[$i][2] = 'null';
                    // array_push($arr_shortDT_monthly, $arr_short_tmp2[$i][0]);
                }
                else{
                    $arr_short_tmp2[$i][2] = ($arr_short_tmp2[$i][2] /  (60*1275* $count_output_of_day))  * 100;
                    $arr_short_tmp2[$i][2] = round($arr_short_tmp2[$i][2], 2);
                    array_push($arr_shortDT_monthly, $arr_short_tmp2[$i][0]);
                }
            }

            // đổ dữ liệu vào arr_shortDT_losses--
            $arr_shortDT_losses[2] = $arr_short_tmp2;
            //--------------------------------end short_downtime--------------------------------------------

            //data long_downtime--------------------------------------------------------
            $long_downtime = "SELECT * FROM " . $select_line . "_long_downtime" . " WHERE time BETWEEN '$fday_month' AND '$fday_next_month' 
                                AND period >= 300 ORDER BY time DESC";
            // echo $long_downtime . "<br>";
            $resultcheck_long = mysqli_query( $connect, $long_downtime );
            if ($resultcheck_long && $resultcheck_long->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_long->fetch_assoc()) {
                    //thêm k?t qu? vào m?ng
                    $data_long_downtime[$i][0]=$row['period'];
                    $data_long_downtime[$i][1]=$row['name'];
                    // $data_long_downtime[$i][2]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_long_downtime = [];       
            }

            // print_r($data_long_downtime);
            
            $arr_long_tmp1 = array();
            $arr_long_tmp2 = array();

            for ($i = 0 ; $i < count($data_long_downtime); $i++){
                if (!in_array($data_long_downtime[$i][1], $arr_long_tmp1, true)){
                    array_push($arr_long_tmp1, $data_long_downtime[$i][1]);
                    array_push($arr_long_tmp2, array($data_long_downtime[$i][1], 0 ,0));
                }
            }

            for ($i = 0 ; $i < count($data_long_downtime); $i++){
                if (in_array($data_long_downtime[$i][1], $arr_long_tmp1, true)){
                    $tmp_long = array_search($data_long_downtime[$i][1], $arr_long_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_long_tmp2[$tmp_long][1] += 1;
                    $arr_long_tmp2[$tmp_long][2] += (int)$data_long_downtime[$i][0];
                }
            }
            // print_r($arr_long_tmp2);
            for($i = 0; $i < count($arr_long_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_long_tmp2[$i][2] = 'null';
                    // array_push($arr_longDT_monthly, $arr_long_tmp2[$i][0]);
                }
                else{
                    $arr_long_tmp2[$i][2] = ($arr_long_tmp2[$i][2] / (60*1275*$count_output_of_day)) * 100;
                    $arr_long_tmp2[$i][2] = round($arr_long_tmp2[$i][2], 2);
                    array_push($arr_longDT_monthly, $arr_long_tmp2[$i][0]);
                }
            }
            // đổ dữ liệu vào arr_longDT_losses--
            $arr_longDT_losses[2] = $arr_long_tmp2;
            //-----------------------end long_downtime------------------------------
            
            //data ng losses--------------------------------------------------------
            $ng_output = "SELECT * FROM " . $select_line . "_output_ng_total" . " WHERE `time` BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $ng_output . "<br>";
            $resultcheck_ng = mysqli_query( $connect, $ng_output );
            if ($resultcheck_ng && $resultcheck_ng->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_ng->fetch_assoc()) {
                    //thêm k?t qu? vào m?ng
                    $data_output_ng[$i][0]=$row['op'];
                    $data_output_ng[$i][1]=$row['defect_name'];                   
                    $i++;
                }
            }
            else{
                $data_output_ng = [];       
            }

            // print_r($data_long_downtime);
            
            $arr_ng_tmp1 = array();
            $arr_ng_tmp2 = array();

            for ($i = 0 ; $i < count($data_output_ng); $i++){
                if (!in_array($data_output_ng[$i][1], $arr_ng_tmp1, true)){
                    array_push($arr_ng_tmp1, $data_output_ng[$i][1]);
                    array_push($arr_ng_tmp2, array($data_output_ng[$i][1], 0));
                }
            }

            for ($i = 0 ; $i < count($data_output_ng); $i++){
                if (in_array($data_output_ng[$i][1], $arr_ng_tmp1, true)){
                    $tmp_ng = array_search($data_output_ng[$i][1], $arr_ng_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_ng_tmp2[$tmp_ng][1] += 1;
                }
            }
            // print_r($arr_ng_tmp2);
            for($i = 0; $i < count($arr_ng_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_ng_tmp2[$i][1] = 'null';
                }
                else{
                    $arr_ng_tmp2[$i][1] = (($arr_ng_tmp2[$i][1] * 3.8) / (60*1275*$count_output_of_day)) * 100;
                    $arr_ng_tmp2[$i][1] = round($arr_ng_tmp2[$i][1], 2);
                    array_push($arr_ng_monthly, $arr_ng_tmp2[$i][0]);
                }
            }

            // đổ dữ liệu vào arr_longDT_losses--
            $arr_ng_losses[2] = $arr_ng_tmp2;
            //-----------------------end long_downtime------------------------------

            //data speed------------------------------------------------------------
            $speed = "SELECT * FROM " . $select_line . "_summary_speed " . "WHERE op = 99 AND time 
                        BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $speed . "<br>";
            $resultcheck_speed = mysqli_query( $connect, $speed );
            if ($resultcheck_speed && $resultcheck_speed->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_speed->fetch_assoc()) {
                    $data_speed[$i][0]=$row['op'];
                    $data_speed[$i][1]=$row['period'];
                    $i++;
                }
            }
            else{
                $data_speed = [];
            }

            for($i = 0; $i < count($data_speed); $i++){
                $data_speed[$i][0] = "Kiểm tra đặc tính (特性検査)";
            }
        
            $arr_speed_tmp1 = array();
            $arr_speed_tmp2 = array();
            for ($i = 0 ; $i < count($data_speed); $i++){
                if (!in_array($data_speed[$i][0], $arr_speed_tmp1, true)){
                    array_push($arr_speed_tmp1, $data_speed[$i][0]);
                    array_push($arr_speed_tmp2, array($data_speed[$i][0], 0, 0));
                }
            }
            for ($i = 0 ; $i < count($data_speed); $i++){
                if (in_array($data_speed[$i][0], $arr_speed_tmp1, true)){
                    $tmp_speed = array_search($data_speed[$i][0], $arr_speed_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_speed_tmp2[$tmp_speed][1] += 1;
                    $arr_speed_tmp2[$tmp_speed][2] += (int)$data_speed[$i][1];
                }
            }

            for($i = 0; $i < count($arr_speed_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_speed_tmp2[$i][1] = 'null';
                }
                else{
                    $arr_speed_tmp2[$i][1] = ($arr_speed_tmp2[$i][1] / (60*1275*$count_output_of_day)) * 100;
                    $arr_speed_tmp2[$i][1] = round($arr_speed_tmp2[$i][1], 2);
                    array_push($arr_speed_monthly, $arr_speed_tmp2[$i][0]);
                }
            }

            $arr_speed_losses[2] = $arr_speed_tmp2;
            // print_r($arr_speed_tmp2);
        
            // for($i = 0; $i < count($arr_speed_tmp2); $i++){
            //     $arr_speed_tmp2[$i][2] = round(($arr_speed_tmp2[$i][2] / 60) / (1275 * $count_output_of_day) * 100, 2);
            // }
        
            // usort($arr_speed_tmp2, function($a, $b) {
            //     return $b[2] <=> $a[2];
            // });
            // $sum_arr_speed = array_sum(array_column($arr_speed_tmp2, 2));

            //data preparing---------------------------------------------------------------
            $sql_prepare = "SELECT * FROM " . $select_line . "_line_prepare " . "WHERE time
                            BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $sql_prepare . "</br>";
            $result_prepare = mysqli_query( $connect, $sql_prepare );
            if ($result_prepare && $result_prepare->num_rows > 0) {
                $i = 0;
                while ($row = $result_prepare->fetch_assoc()) {
                    $data_line_prepare[$i][0]=$row['sub_time'];
                    $data_line_prepare[$i][1]=$row['period'];
                    $i++;
                }
            }
            else{
                $data_line_prepare = [];
            }

            for($i = 0; $i < count($data_line_prepare); $i++){
                if($data_line_prepare[$i][0] == "begin1" || $data_line_prepare[$i][0] == "begin2" || $data_line_prepare[$i][0] == "begin3"){
                    $data_line_prepare[$i][0] = "Đầu Ca";
                }
                else{
                    $data_line_prepare[$i][0] = "Cuối Ca";
                }
            }

            $arr_prepare_tmp1 = array();
            $arr_prepare_tmp2 = array();
            for ($i = 0 ; $i < count($data_line_prepare); $i++){
                if (!in_array($data_line_prepare[$i][0], $arr_prepare_tmp1, true)){
                    array_push($arr_prepare_tmp1, $data_line_prepare[$i][0]);
                    array_push($arr_prepare_tmp2, array($data_line_prepare[$i][0], 0, 0));
                }
            }
            for ($i = 0 ; $i < count($data_line_prepare); $i++){
                if (in_array($data_line_prepare[$i][0], $arr_prepare_tmp1, true)){
                    $tmp_prepare = array_search($data_line_prepare[$i][0], $arr_prepare_tmp1);
                    // echo $temp1 . "</br>";
                    $arr_prepare_tmp2[$tmp_prepare][1] += 1;
                    $arr_prepare_tmp2[$tmp_prepare][2] += (int)$data_line_prepare[$i][1];
                }
            }

            for($i = 0; $i < count($arr_prepare_tmp2); $i++){
                if($count_output_of_day == 0){
                    $arr_prepare_tmp2[$i][1] = 'null';
                }
                else{
                    $arr_prepare_tmp2[$i][1] = ($arr_prepare_tmp2[$i][2] / (60*1275*$count_output_of_day)) * 100;
                    $arr_prepare_tmp2[$i][1] = round($arr_prepare_tmp2[$i][1], 2);
                    array_push($arr_prepare_monthly, $arr_prepare_tmp2[$i][0]);
                }
            }

            $arr_prepare_losses[2] = $arr_prepare_tmp2;
            //data changing-------------------------------------------------------------
            $sql_change_code = "SELECT code, period FROM " . $select_line . "_code_change " . 
                                "WHERE time BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $sql_change_code . "</br>";
            $result_change_code = mysqli_query( $connect, $sql_change_code );
            if ($result_change_code && $result_change_code->num_rows > 0) {
                $i = 0;
                while ($row = $result_change_code->fetch_assoc()) {
                    $data_change_code[$i][0]=$row['code'];
                    $data_change_code[$i][1]=$row['period'];
                    $i++;
                }
            }
            else{
                $data_change_code = [];
            }
            // print_r($data_change_code);

            for($i = 0; $i < count($data_change_code); $i++){
                $data_change_code[$i][0]= 'Thay Mã';
            }

            $arr_change_code_tmp1 = array();
            $arr_change_code_tmp2 = array();
            for ($i = 0 ; $i < count($data_change_code); $i++){
                if (!in_array($data_change_code[$i][0], $arr_change_code_tmp1, true)){
                    array_push($arr_change_code_tmp1, $data_change_code[$i][0]);
                    array_push($arr_change_code_tmp2, array($data_change_code[$i][0], 0, 0));
                }
            }
            for ($i = 0 ; $i < count($data_change_code); $i++){
                if (in_array($data_change_code[$i][0], $arr_change_code_tmp1, true)){
                    $tmp_change_code = array_search($data_change_code[$i][0], $arr_change_code_tmp1);
                    $arr_change_code_tmp2[$tmp_change_code][1] += 1;
                    $arr_change_code_tmp2[$tmp_change_code][2] += (int)$data_change_code[$i][1];
                }
            }

            // print_r($arr_change_code_tmp2);

            $sql_wire_electrode = "SELECT id_name, period FROM " . $select_line . "_change_wire " . 
                                "WHERE time BETWEEN '$fday_month' AND '$fday_next_month'";
            // echo $sql_wire_electrode . "</br>";
            $result_wire_electrode = mysqli_query( $connect, $sql_wire_electrode );
            if ($result_wire_electrode && $result_wire_electrode->num_rows > 0) {
                $i = 0;
                while ($row = $result_wire_electrode->fetch_assoc()) {
                    $data_wire_electrode[$i][0]=$row['id_name'];
                    $data_wire_electrode[$i][1]=$row['period'];
                    $i++;
                }
            }
            else{
                $data_wire_electrode = [];
            }
            
            for($i = 0; $i < count($data_wire_electrode); $i++){
                if($data_wire_electrode[$i][0] == 1177 || $data_wire_electrode[$i][0] == 1178 || $data_wire_electrode[$i][0] == 1078
                    || $data_wire_electrode[$i][0] == 1079){
                    $data_wire_electrode[$i][0] = 'Thay Dây Đồng';
                }
                else{
                    $data_wire_electrode[$i][0] = 'Thay Điện Cực';
                }
            }

            // print_r($data_wire_electrode);
            $arr_wire_electrode_tmp1 = array();
            $arr_wire_electrode_tmp2 = array();
            for ($i = 0 ; $i < count($data_wire_electrode); $i++){
                if (!in_array($data_wire_electrode[$i][0], $arr_wire_electrode_tmp1, true)){
                    array_push($arr_wire_electrode_tmp1, $data_wire_electrode[$i][0]);
                    array_push($arr_wire_electrode_tmp2, array($data_wire_electrode[$i][0], 0, 0));
                }
            }
            for ($i = 0 ; $i < count($data_wire_electrode); $i++){
                if (in_array($data_wire_electrode[$i][0], $arr_wire_electrode_tmp1, true)){
                    $tmp_wire_electrode = array_search($data_wire_electrode[$i][0], $arr_wire_electrode_tmp1);
                    $arr_wire_electrode_tmp2[$tmp_wire_electrode][1] += 1;
                    $arr_wire_electrode_tmp2[$tmp_wire_electrode][2] += (int)$data_wire_electrode[$i][1];
                }
            }
            
            $data_changing = array_merge($arr_change_code_tmp2, $arr_wire_electrode_tmp2);
            // print_r($data_changing . "Hello Changing");
            for($i = 0; $i < count($data_changing); $i++){
                if($count_output_of_day == 0){
                    $data_changing[$i][2] = 'null';
                }
                else{
                    $data_changing[$i][2] = ($data_changing[$i][2] / (60*1275*$count_output_of_day)) * 100;
                    $data_changing[$i][2] = round($data_changing[$i][2], 2);
                    array_push($arr_changing_monthly, $data_changing[$i][0]);
                }
            }

            $arr_changing_losses[2] = $data_changing;
            // print_r($data_changing . "Hello Changing");

            
            // print_r($data_changing);

            
        }
        unset($data_short_downtime);
        unset($arr_short_tmp2);
        unset($data_long_downtime);
        unset($arr_long_tmp2);
        unset($data_output_ng);
        unset($arr_ng_tmp2);
        unset($data_speed);
        unset($arr_speed_tmp2);
        unset($data_line_prepare);
        unset($arr_prepare_tmp2);
        unset($data_change_code);
        unset($data_wire_electrode);
        unset($data_changing);
    }
    // print_r($arr_changing_losses);
    // print_r($arr_speed_monthly);

    $arr_shortDT_monthly = array_unique($arr_shortDT_monthly);
    $arr_longDT_monthly = array_unique($arr_longDT_monthly);
    $arr_ng_monthly = array_unique($arr_ng_monthly);
    $arr_speed_monthly = array_unique($arr_speed_monthly);
    $arr_prepare_monthly = array_unique($arr_prepare_monthly);
    $arr_changing_monthly = array_unique($arr_changing_monthly);
    // print_r($arr_changing_monthly);
?>

<style>
    table {
        height: 160px;
        display: flex;
        flex-flow: column;
        width: 100%;
    }

    thead {
        flex: 0 0 auto;
    }

    tbody {
        flex: 1 1 auto;
        display: block;
        overflow-x: hidden;
        overflow-y: scroll;
        overflow: auto;
    }

    #table_shortDt tr {
        width: 100%;
        display: table;
        table-layout: fixed;
    }
    #table_longDt tr {
        width: 100%;
        display: table;
        table-layout: fixed;
    }
    #table_ng tr {
        width: 100%;
        display: table;
        table-layout: fixed;
    }

    #table_prepare tr {
        width: 100%;
        display: table;
        table-layout: fixed;
    }

    #table_prepare tr {
        width: 100%;
        display: table;
        table-layout: fixed;
    }

    #table_changing tr {
        width: 100%;
        display: table;
        table-layout: fixed;
    }

    #table_changing tr {
        width: 100%;
        display: table;
        table-layout: fixed;
    }

    #table_speed tr {
        width: 100%;
        display: table;
        table-layout: fixed;
    }

    table tbody::-webkit-scrollbar {
        display: none;
    }
    table tbody{
        -ms-overflow-style: none;  
        scrollbar-width: none;
    }

    /* .fixTableHead {
      overflow-y: scroll;
      height: 250px;
    }
    .fixTableHead thead th {
      position: sticky;
      top: 0;
    }
    table {
      border-collapse: collapse;        
      width: 100%;
    }
    th,
    td {
      padding: 8px 15px;
      border: 2px solid #529432;
    }
    th {
      background: white;
      color: black;
    }

    .fixTableHead::-webkit-scrollbar {
    display: none;
    } */

    /* Hide scrollbar for IE, Edge and Firefox */
    /* .fixTableHead {
    -ms-overflow-style: none;  
    scrollbar-width: none;
    } */
    h3 a {
        font-weight: bold;
        text-decoration: underline;
        font-size: 2.5vh;
        /* color: #000; */
    }
</style>

    <div class="row">
        
        <div class="col-sm-4">
            <h3 style="margin: 0; padding: 0;"><a href="shortDt/indexShortDt">Dừng ngắn / チョコ停</a></h3>
            <table id="table_shortDt" class="table table-dark table-hover" >
                <thead>
                    <tr>
                        <th style="width: 55%;">Hạng mục/項目</th>
                        <th style="width: 15%;"><?php echo $previous_2month; ?></th>
                        <th style="width: 15%;"><?php echo $previous_month; ?></th>
                        <th style="width: 15%;"><?php echo $curr_month; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // arsort($arr_shortDT_losses);
                        foreach ($arr_shortDT_monthly as $value_tmp) {
                            echo '<tr>
                            <td style="width:55%;">'.$value_tmp.'</td>';
                            $arr_tmp_loss = array();
                            for ($i=0; $i < count($arr_shortDT_losses); $i++) { 
                                
                                $flag_check = false;
                                for ($x=0; $x < count($arr_shortDT_losses[$i]); $x++) { 
                                    if($arr_shortDT_losses[$i][$x][0] != null || $arr_shortDT_losses[$i][$x][0] != ''){
                                        if($value_tmp == $arr_shortDT_losses[$i][$x][0]){
                                            $flag_check = true;
                                            echo '<td style="width:15%;">'.$arr_shortDT_losses[$i][$x][2]. "%".'</td>';
                                            array_push($arr_tmp_loss, $arr_shortDT_losses[$i][$x][2]);
                                        }
                                    }   
                                }
                                if($flag_check == false){
                                    echo '<td style="width:15%;"></td>';
                                }
                            }
                            echo '</tr>'; 
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <h3 style="margin: 0; padding: 0;"><a href="longDt/indexLongDt">Dừng dài / 大停止</a></h3>
            <table id="table_longDt" class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th style="width: 55%;">Hạng mục/項目</th>
                        <th style="width: 15%;"><?php echo $previous_2month; ?></th>
                        <th style="width: 15%;"><?php echo $previous_month; ?></th>
                        <th style="width: 15%;"><?php echo $curr_month; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // arsort($arr_shortDT_losses);
                        foreach ($arr_longDT_monthly as $value_tmp) {
                            echo '<tr>
                            <td style="width:55%;">'.$value_tmp.'</td>';
                            $arr_tmp_loss = array();
                            for ($i=0; $i < count($arr_longDT_losses); $i++) { 
                                
                                $flag_check = false;
                                for ($x=0; $x < count($arr_longDT_losses[$i]); $x++) { 
                                    if($arr_longDT_losses[$i][$x][0] != null || $arr_longDT_losses[$i][$x][0] != ''){
                                        if($value_tmp == $arr_longDT_losses[$i][$x][0]){
                                            $flag_check = true;
                                            echo '<td style="width:15%;">'.$arr_longDT_losses[$i][$x][2]. "%".'</td>';
                                            array_push($arr_tmp_loss, $arr_longDT_losses[$i][$x][2]);
                                            
                                        }
                                    }   
                                }
                                if($flag_check == false){
                                    echo '<td style="width:15%;"></td>';
                                }
                            }
                            echo '</tr>'; 
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <h3 style="margin: 0; padding: 0;"><a href="outputNG/indexOutputNG">Tỉ lệ lỗi / 不良率</a></h3>
            <table id="table_ng" class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th style="width: 55%;">Hạng mục/項目</th>
                        <th style="width: 15%;"><?php echo $previous_2month; ?></th>
                        <th style="width: 15%;"><?php echo $previous_month; ?></th>
                        <th style="width: 15%;"><?php echo $curr_month; ?></th>
                    </tr>
                </thead>
                <tbody>
                      <?php
                          foreach ($arr_ng_monthly as $value_tmp) {
                            echo '<tr>
                            <td style="width:55%;">'.$value_tmp.'</td>';
                            for ($i=0; $i < count($arr_ng_losses); $i++) { 
                                $flag_check = false;
                                for ($x=0; $x < count($arr_ng_losses[$i]); $x++) {                           
                                    if($arr_ng_losses[$i][$x][0] != null || $arr_ng_losses[$i][$x][0] != ''){
                                        if($value_tmp == $arr_ng_losses[$i][$x][0]){
                                            $flag_check = true;
                                            echo '<td style="width:15%;">'.$arr_ng_losses[$i][$x][1]. "%".'</td>';
                                        }
                                    }
                                    // else{
                                    //     echo '<td></td>';
                                    // }
                                }
                                if($flag_check == false){
                                    echo '<td style="width:15%;"></td>';
                                }
                            }
                            echo '</tr>';
                        }
                      ?>
                  </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <h3 style="margin: 0; padding: 0;"><a href="changing/indexChanging">Thay đổi / 段取り</a></h3>
            <table id="table_changing" class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th style="width: 55%;">Hạng mục/項目</th>
                        <th style="width: 15%;"><?php echo $previous_2month; ?></th>
                        <th style="width: 15%;"><?php echo $previous_month; ?></th>
                        <th style="width: 15%;"><?php echo $curr_month; ?></th>
                    </tr>
                </thead>
                <tbody>
                      <?php
                          foreach ($arr_changing_monthly as $value_tmp) {
                            echo '<tr>
                            <td style="width:55%;">'.$value_tmp.'</td>';
                            for ($i=0; $i < count($arr_changing_losses); $i++) { 
                                $flag_check = false;
                                for ($x=0; $x < count($arr_changing_losses[$i]); $x++) {                           
                                    if($arr_changing_losses[$i][$x][0] != null || $arr_changing_losses[$i][$x][0] != ''){
                                        if($value_tmp == $arr_changing_losses[$i][$x][0]){
                                            $flag_check = true;
                                            echo '<td style="width:15%;">'.$arr_changing_losses[$i][$x][2]. "%".'</td>';
                                        }
                                    }
                                }
                                if($flag_check == false){
                                    echo '<td style="width:15%;"></td>';
                                }
                            }
                            echo '</tr>';
                        }
                      ?>
                  </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <h3 style="margin: 0; padding: 0;"><a href="preparing/indexPreparing">Chuẩn bị / 準備</a></h3>
            <table id="table_prepare" class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th style="width: 55%;">Hạng mục/項目</th>
                        <th style="width: 15%;"><?php echo $previous_2month; ?></th>
                        <th style="width: 15%;"><?php echo $previous_month; ?></th>
                        <th style="width: 15%;"><?php echo $curr_month; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($arr_prepare_monthly as $value_tmp) {
                            echo '<tr>
                            <td style="width:55%;">'.$value_tmp.'</td>';
                            for ($i=0; $i < count($arr_prepare_losses); $i++) { 
                                $flag_check = false;
                                for ($x=0; $x < count($arr_prepare_losses[$i]); $x++) {                           
                                    if($arr_prepare_losses[$i][$x][0] != null || $arr_prepare_losses[$i][$x][0] != ''){
                                        if($value_tmp == $arr_prepare_losses[$i][$x][0]){
                                            $flag_check = true;
                                            echo '<td style="width:15%;">'.$arr_prepare_losses[$i][$x][1]. "%".'</td>';
                                        }
                                    }
                                }
                                if($flag_check == false){
                                    echo '<td style="width:15%;"></td>';
                                }
                            }
                            echo '</tr>';
                        }
                    ?>
                  </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <h3 style="margin: 0; padding: 0;"><a href="speed/indexSpeed">Tốc độ / 速度</a></h3>
            <table id="table_speed" class="table table-dark table-hover" style="margin-top: 6px;">
                <thead>
                    <tr>
                        <th style="width: 55%;">Hạng mục/項目</th>
                        <th style="width: 15%;"><?php echo $previous_2month; ?></th>
                        <th style="width: 15%;"><?php echo $previous_month; ?></th>
                        <th style="width: 15%;"><?php echo $curr_month; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($arr_speed_monthly as $value_tmp) {
                            echo '<tr>
                            <td style="width:55%;">'.$value_tmp.'</td>';
                            for ($i=0; $i < count($arr_speed_losses); $i++) { 
                                $flag_check = false;
                                for ($x=0; $x < count($arr_speed_losses[$i]); $x++) {                           
                                    if($arr_speed_losses[$i][$x][0] != null || $arr_speed_losses[$i][$x][0] != ''){
                                        if($value_tmp == $arr_speed_losses[$i][$x][0]){
                                            $flag_check = true;
                                            echo '<td style="width:15%;">'.$arr_speed_losses[$i][$x][1]. "%".'</td>';
                                        }
                                    }
                                }
                                if($flag_check == false){
                                    echo '<td style="width:15%;"></td>';
                                }
                            }
                            echo '</tr>';
                        }
                    ?>
                  </tbody>
            </table>
        </div>
    </div>
        
<!-- <script src="
    <?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/six_losses/views/default/js/datatables_func.js" ?>">
</script> -->

<script type="text/javascript">
    $(function () {
        // $("#example1").DataTable({
        //   "responsive": true, "lengthChange": false, "autoWidth": false,
        //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#table_shortDt').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });

        $('#table_longDt').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });

        $('#table_ng').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });

        $('#table_prepare').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });

        $('#table_speed').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
        $('#table_changing').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<!-- <script type="text/javascript">
    createDataTable('table_shortDt', 4, false);
</script> -->


