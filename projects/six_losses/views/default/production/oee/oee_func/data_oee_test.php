<?php 
    
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];
    
    $date_now = date('Y-m-d H:i:s');
    $date = date('Y-m-d');

    $yesterday_tmp = mktime(0, 0, 0, date("m") , date("d")-1, date("Y"));
    $yesterday = date('Y-m-d', $yesterday_tmp);

    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;
    // print($yesterday);
    
    //test 
    // $date_now = "2022-03-29 05:00:00";
    // $date = "2022-03-29";
    // $yesterday = "2022-03-28";
    
// 	date_default_timezone_set("Asia/Bangkok");
//     $newdate = strtotime ( '-1 day' , strtotime ( $date_now ) ) ;
//     $now_begin = date ( 'Y-m-d' , $newdate );
//     $start_shift_1 = "$now_begin 06:00:00";
//     $end_shift_3 = "$date_now 06:00:00";
	
    $sql_output_target= "SELECT * FROM `aw3_output_target`";
    // echo $sql_output_nm . "</br>";
    $result_output_target = mysqli_query( $connect, $sql_output_target );
    if ($result_output_target && $result_output_target->num_rows > 0) {
        $i = 0;
        while ($row = $result_output_target->fetch_assoc()) {
            $data_output_target[$i][0]=$row['id'];
            $data_output_target[$i][1]=$row['hour'];
            $data_output_target[$i][2]=$row['output_target'];
            // echo $data_output_target[$i][2][1];
            $i++;
        }
    }
    else{
        $data_output_target = [];
    }


    // print_r($data_output_target);
    //set up data aw3_output_5
    //khai bao bien
    //output
    $output_0h = 0;
    $output_1h = 0;
    $output_2h = 0;
    $output_3h = 0;
    $output_4h = 0;
    $output_5h = 0;
    $output_6h = 0;
    $output_7h = 0;
    $output_8h = 0;
    $output_9h = 0;
    $output_10h = 0;
    $output_11h = 0;
    $output_12h = 0;
    $output_13h = 0;
    $output_14h = 0;
    $output_15h = 0;
    $output_16h = 0;
    $output_17h = 0;
    $output_18h = 0;
    $output_19h = 0;
    $output_20h = 0;
    $output_21h = 0;
    $output_22h = 0;
    $output_23h = 0;
    
    //perform
    $performance_0h = 0;
    $performance_1h = 0;
    $performance_2h = 0;
    $performance_3h = 0;
    $performance_4h = 0;
    $performance_5h = 0;
    $performance_6h = 0;
    $performance_7h = 0;
    $performance_8h = 0;
    $performance_9h = 0;
    $performance_10h = 0;
    $performance_11h = 0;
    $performance_12h = 0;
    $performance_13h = 0;
    $performance_14h = 0;
    $performance_15h = 0;
    $performance_16h = 0;
    $performance_17h = 0;
    $performance_18h = 0;
    $performance_19h = 0;
    $performance_20h = 0;
    $performance_21h = 0;
    $performance_22h = 0;
    $performance_23h = 0;
    
    //output_ng
    $output_ng_0h = 0;
    $output_ng_1h = 0;
    $output_ng_2h = 0;
    $output_ng_3h = 0;
    $output_ng_4h = 0;
    $output_ng_5h = 0;
    $output_ng_6h = 0;
    $output_ng_7h = 0;
    $output_ng_8h = 0;
    $output_ng_9h = 0;
    $output_ng_10h = 0;
    $output_ng_11h = 0;
    $output_ng_12h = 0;
    $output_ng_13h = 0;
    $output_ng_14h = 0;
    $output_ng_15h = 0;
    $output_ng_16h = 0;
    $output_ng_17h = 0;
    $output_ng_18h = 0;
    $output_ng_19h = 0;
    $output_ng_20h = 0;
    $output_ng_21h = 0;
    $output_ng_22h = 0;
    $output_ng_23h = 0;
    
    for($i = 0; $i < count($data_output_target);$i++){
        $target_6h = $data_output_target[0][2];
        $target_7h = $data_output_target[1][2];
        $target_8h = $data_output_target[2][2];
        $target_9h = $data_output_target[3][2];
        $target_10h = $data_output_target[4][2];
        $target_11h = $data_output_target[5][2];
        $target_12h = $data_output_target[6][2];
        $target_13h = $data_output_target[7][2];
        $target_14h = $data_output_target[8][2];
        $target_15h = $data_output_target[9][2];
        $target_16h = $data_output_target[10][2];
        $target_17h = $data_output_target[11][2];
        $target_18h = $data_output_target[12][2];
        $target_19h = $data_output_target[13][2];
        $target_20h = $data_output_target[14][2];
        $target_21h = $data_output_target[15][2];
        $target_22h = $data_output_target[16][2];
        $target_23h = $data_output_target[17][2];
        $target_0h = $data_output_target[18][2];
        $target_1h = $data_output_target[19][2];
        $target_2h = $data_output_target[20][2];
        $target_3h = $data_output_target[21][2];
        $target_4h = $data_output_target[22][2];
        $target_5h = $data_output_target[23][2];
    }
    // echo $target_4h;
    //TH1
    if($date_now >= "$date 06:00:00"){
        // print("TH111111");
        $output_m5 = "SELECT * FROM " . $select_line . "_output_5_2 WHERE time BETWEEN '$date 06:00:00' AND '$date 23:59:59'";
        $result_output_m5 = mysqli_query($connect, $output_m5);
        if($result_output_m5 && $result_output_m5 -> num_rows > 0){
            $j = 0;
            while($row = $result_output_m5->fetch_assoc()){
                $data_output_m5[$j][0] = $row['id'];
                $data_output_m5[$j][1] = $row['output'];
                $data_output_m5[$j][2] = $row['time'];
                $j++;
            }
        }
        else{
            $data_output_m5 = [];
        }
        
        //perform
        for($j = 0; $j < count($data_output_m5); $j++){
            if($data_output_m5[$j][2] >=  "$date 06:00:00" && $data_output_m5[$j][2] <= "$date 06:59:59"){
                $output_6h += $data_output_m5[$j][1];
                $performance_6h = round(($output_6h / ($target_6h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 07:00:00" && $data_output_m5[$j][2] <= "$date 07:59:59"){
                $output_7h+= $data_output_m5[$j][1];
                $performance_7h = round(($output_7h / ($target_7h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 08:00:00" && $data_output_m5[$j][2] <= "$date 08:59:59"){

                $output_8h += $data_output_m5[$j][1];
                
                $performance_8h = round(($output_8h / ($target_8h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 09:00:00" && $data_output_m5[$j][2] <= "$date 09:59:59"){
                $output_9h+= $data_output_m5[$j][1];
                $performance_9h = (int)(round(($output_9h / ($target_9h)) * 100, 2));
            }
            elseif($data_output_m5[$j][2] >=  "$date 10:00:00" && $data_output_m5[$j][2] <= "$date 10:59:59"){
                $output_10h+= $data_output_m5[$j][1];
                $performance_10h = round(($output_10h / ($target_10h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 11:00:00" && $data_output_m5[$j][2] <= "$date 11:59:59"){
                $output_11h+= $data_output_m5[$j][1];
                $performance_11h = round(($output_11h / ($target_11h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 12:00:00" && $data_output_m5[$j][2] <= "$date 12:59:59"){
                $output_12h+= $data_output_m5[$j][1];
                $performance_12h = round(($output_12h / ($target_12h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 13:00:00" && $data_output_m5[$j][2] <= "$date 13:59:59"){
                $output_13h+= $data_output_m5[$j][1];
                $performance_13h = round(($output_13h / ($target_13h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 14:00:00" && $data_output_m5[$j][2] <= "$date 14:59:59"){
                $output_14h++;
                $performance_14h = round(($output_14h / ($target_14h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 15:00:00" && $data_output_m5[$j][2] <= "$date 15:59:59"){
                $output_15h++;
                $performance_15h = round(($output_15h / ($target_15h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 16:00:00" && $data_output_m5[$j][2] <= "$date 16:59:59"){
                $output_16h++;
                $performance_16h = round(($output_16h / ($target_16h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 17:00:00" && $data_output_m5[$j][2] <= "$date 17:59:59"){
                $output_17h++;
                $performance_17h = round(($output_17h / ($target_17h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 18:00:00" && $data_output_m5[$j][2] <= "$date 18:59:59"){
                $output_18h++;
                $performance_18h = round(($output_18h / ($target_18h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 19:00:00" && $data_output_m5[$j][2] <= "$date 19:59:59"){
                $output_19h++;
                $performance_19h = round(($output_19h / ($target_19h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 20:00:00" && $data_output_m5[$j][2] <= "$date 20:59:59"){
                $output_20h++;
                $performance_20h = round(($output_20h / ($target_20h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 21:00:00" && $data_output_m5[$j][2] <= "$date 21:59:59"){
                // if($data_output_m5[$j][1] == 0){
                $output_21h++;
                $performance_21h = round(($output_21h / ($target_21h)) * 100, 2);
                // }
            }
            elseif($data_output_m5[$j][2] >=  "$date 22:00:00" && $data_output_m5[$j][2] <= "$date 22:59:59"){
                $output_22h++;
                $performance_22h = round(($output_22h / ($target_22h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$date 23:00:00" && $data_output_m5[$j][2] <= "$date 23:59:59"){
                $output_23h++;
                $performance_23h = round(($output_23h / ($target_23h)) * 100, 2);
            }
        }
        
        //set up data aw3_output_ng_5
        $output_ng_m5 = "SELECT * FROM " . $select_line . "_output_ng_total WHERE time BETWEEN '$date 06:00:00' AND '$date 23:59:59'";
        $result_output_ng_m5 = mysqli_query($connect, $output_ng_m5);
        if($result_output_ng_m5 && $result_output_ng_m5 -> num_rows > 0){
            $k = 0;
            while($row = $result_output_ng_m5->fetch_assoc()){
                $data_output_ng_m5[$k][0] = $row['id'];
                $data_output_ng_m5[$k][1] = $row['defect_name'];
                $data_output_ng_m5[$k][2] = $row['time'];
                $k++;
            }
        }
        else{
            $data_output_ng_m5 = [];
        }
        
        for($k = 0; $k < count($data_output_ng_m5); $k++){
            if($data_output_ng_m5[$k][2] >=  "$date 06:00:00" && $data_output_ng_m5[$k][2] <= "$date 06:59:59"){
                $output_ng_6h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 07:00:00" && $data_output_ng_m5[$k][2] <= "$date 07:59:59"){
                $output_ng_7h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 08:00:00" && $data_output_ng_m5[$k][2] <= "$date 08:59:59"){
                $output_ng_8h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 09:00:00" && $data_output_ng_m5[$k][2] <= "$date 09:59:59"){
                $output_ng_9h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 10:00:00" && $data_output_ng_m5[$k][2] <= "$date 10:59:59"){
                $output_ng_10h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 11:00:00" && $data_output_ng_m5[$k][2] <= "$date 11:59:59"){
                $output_ng_11h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 12:00:00" && $data_output_ng_m5[$k][2] <= "$date 12:59:59"){
                $output_ng_12h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 13:00:00" && $data_output_ng_m5[$k][2] <= "$date 13:59:59"){
                $output_ng_13h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 14:00:00" && $data_output_ng_m5[$k][2] <= "$date 14:59:59"){
                $output_ng_14h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 15:00:00" && $data_output_ng_m5[$k][2] <= "$date 15:59:59"){
                $output_ng_15h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 16:00:00" && $data_output_ng_m5[$k][2] <= "$date 16:59:59"){
                $output_ng_16h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 17:00:00" && $data_output_ng_m5[$k][2] <= "$date 17:59:59"){
                $output_ng_17h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 18:00:00" && $data_output_ng_m5[$k][2] <= "$date 18:59:59"){
                $output_ng_18h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 19:00:00" && $data_output_ng_m5[$k][2] <= "$date 19:59:59"){
                $output_ng_19h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 20:00:00" && $data_output_ng_m5[$k][2] <= "$date 20:59:59"){
                $output_ng_20h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 21:00:00" && $data_output_ng_m5[$k][2] <= "$date 21:59:59"){
                $output_ng_21h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 22:00:00" && $data_output_ng_m5[$k][2] <= "$date 22:59:59"){
                $output_ng_22h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$date 23:00:00" && $data_output_ng_m5[$k][2] <= "$date 23:59:59"){
                $output_ng_23h++;
            }
            
        }
    }
    //TH2
    
    elseif($date_now <  "$date 06:00:00" && $date_now >= "$date 00:00:00"){
        // print("TH22222");
        $output_m5 = "SELECT * FROM " . $select_line . "_output_5_2 WHERE time BETWEEN '$yesterday 06:00:00' AND '$yesterday 23:59:59'";
        $result_output_m5 = mysqli_query($connect, $output_m5);
        if($result_output_m5 && $result_output_m5 -> num_rows > 0){
            $j = 0;
            while($row = $result_output_m5->fetch_assoc()){
                $data_output_m5[$j][0] = $row['id'];
                $data_output_m5[$j][1] = $row['output'];
                $data_output_m5[$j][2] = $row['time'];
                $j++;
            }
        }
        else{
            $data_output_m5 = [];
        }
        
        //select data for shift3
        $output_m5_shift3 = "SELECT * FROM " . $select_line . "_output_5_2 WHERE `time` BETWEEN '$date 00:00:00' AND '$date 05:59:59'";
        $result_output_m5_shift3 = mysqli_query($connect, $output_m5_shift3);
        if($result_output_m5_shift3 && $result_output_m5_shift3 -> num_rows > 0){
            $j = 0;
            while($row = $result_output_m5_shift3->fetch_assoc()){
                $data_output_m5_shift3[$j][0] = $row['id'];
                $data_output_m5_shift3[$j][1] = $row['output'];
                $data_output_m5_shift3[$j][2] = $row['time'];
                $j++;
            }
        }
        else{
            $data_output_m5_shift3 = [];
        }
        
        // print_r($data_output_m5_shift3);
        
        //perform
        for($j = 0; $j < count($data_output_m5_shift3); $j++){
            if($data_output_m5_shift3[$j][2] >=  "$date 00:00:00" && $data_output_m5_shift3[$j][2] <= "$date 00:59:59"){
                $output_0h++;
                $performance_0h = round(($output_0h / ($target_0h)) * 100, 2);
            }
            elseif($data_output_m5_shift3[$j][2] >=  "$date 01:00:00" && $data_output_m5_shift3[$j][2] <= "$date 01:59:59"){
                $output_1h++;
                $performance_1h = round(($output_1h / ($target_1h)) * 100, 2);
            }
            elseif($data_output_m5_shift3[$j][2] >=  "$date 02:00:00" && $data_output_m5_shift3[$j][2] <= "$date 02:59:59"){
                $output_2h++;
                $performance_2h = round(($output_2h / ($target_2h)) * 100, 2);
            }
            elseif($data_output_m5_shift3[$j][2] >=  "$date 03:00:00" && $data_output_m5_shift3[$j][2] <= "$date 03:59:59"){
                $output_3h++;
                $performance_3h = round(($output_3h / ($target_3h)) * 100, 2);
            }
            elseif($data_output_m5_shift3[$j][2] >=  "$date 04:00:00" && $data_output_m5_shift3[$j][2] <= "$date 04:59:59"){
                $output_4h++;
                $performance_4h = round(($output_4h / ($target_4h)) * 100, 2);
            }
            elseif($data_output_m5_shift3[$j][2] >=  "$date 05:00:00" && $data_output_m5_shift3[$j][2] <= "$date 05:59:59"){
                $output_5h++;
                $performance_5h = round(($output_5h / ($target_45)) * 100, 2);
            }
        }
        for($j = 0; $j < count($data_output_m5); $j++){
            if($data_output_m5[$j][2] >=  "$yesterday 06:00:00" && $data_output_m5[$j][2] <= "$yesterday 06:59:59"){
                $output_6h++;
                $performance_6h = round(($output_6h / ($target_6h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 07:00:00" && $data_output_m5[$j][2] <= "$yesterday 07:59:59"){
                $output_7h++;
                $performance_7h = round(($output_7h / ($target_7h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 08:00:00" && $data_output_m5[$j][2] <= "$yesterday 08:59:59"){
                $output_8h++;
                $performance_8h = round(($output_8h / ($target_8h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 09:00:00" && $data_output_m5[$j][2] <= "$yesterday 09:59:59"){
                $output_9h++;
                $performance_9h = (int)(round(($output_9h / ($target_9h)) * 100, 2));
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 10:00:00" && $data_output_m5[$j][2] <= "$yesterday 10:59:59"){
                $output_10h++;
                $performance_10h = round(($output_10h / ($target_10h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 11:00:00" && $data_output_m5[$j][2] <= "$yesterday 11:59:59"){
                $output_11h++;
                $performance_11h = round(($output_11h / ($target_11h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 12:00:00" && $data_output_m5[$j][2] <= "$yesterday 12:59:59"){
                $output_12h++;
                $performance_12h = round(($output_12h / ($target_12h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 13:00:00" && $data_output_m5[$j][2] <= "$yesterday 13:59:59"){
                $output_13h++;
                $performance_13h = round(($output_13h / ($target_13h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 14:00:00" && $data_output_m5[$j][2] <= "$yesterday 14:59:59"){
                $output_14h++;
                $performance_14h = round(($output_14h / ($target_14h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 15:00:00" && $data_output_m5[$j][2] <= "$yesterday 15:59:59"){
                $output_15h++;
                $performance_15h = round(($output_15h / ($target_15h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 16:00:00" && $data_output_m5[$j][2] <= "$yesterday 16:59:59"){
                $output_16h++;
                $performance_16h = round(($output_16h / ($target_16h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 17:00:00" && $data_output_m5[$j][2] <= "$yesterday 17:59:59"){
                $output_17h++;
                $performance_17h = round(($output_17h / ($target_17h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 18:00:00" && $data_output_m5[$j][2] <= "$yesterday 18:59:59"){
                $output_18h++;
                $performance_18h = round(($output_18h / ($target_18h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 19:00:00" && $data_output_m5[$j][2] <= "$yesterday 19:59:59"){
                $output_19h++;
                $performance_19h = round(($output_19h / ($target_19h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 20:00:00" && $data_output_m5[$j][2] <= "$yesterday 20:59:59"){
                $output_20h++;
                $performance_20h = round(($output_20h / ($target_20h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 21:00:00" && $data_output_m5[$j][2] <= "$yesterday 21:59:59"){
                // if($data_output_m5[$j][1] == 0){
                $output_21h++;
                $performance_21h = round(($output_21h / ($target_21h)) * 100, 2);
                // }
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 22:00:00" && $data_output_m5[$j][2] <= "$yesterday 22:59:59"){
                $output_22h++;
                $performance_22h = round(($output_22h / ($target_22h)) * 100, 2);
            }
            elseif($data_output_m5[$j][2] >=  "$yesterday 23:00:00" && $data_output_m5[$j][2] <= "$yesterday 23:59:59"){
                $output_23h++;
                $performance_23h = round(($output_23h / ($target_23h)) * 100, 2);
            }
        }
        
        $output_ng_m5 = "SELECT * FROM " . $select_line . "_output_ng_total WHERE `time` BETWEEN '$yesterday 06:00:00' AND '$yesterday 23:59:59'";
        $result_output_ng_m5 = mysqli_query($connect, $output_ng_m5);
        if($result_output_ng_m5 && $result_output_ng_m5 -> num_rows > 0){
            $k = 0;
            while($row = $result_output_ng_m5->fetch_assoc()){
                $data_output_ng_m5[$k][0] = $row['id'];
                $data_output_ng_m5[$k][1] = $row['defect_name'];
                $data_output_ng_m5[$k][2] = $row['time'];
                $k++;
            }
        }
        else{
            $data_output_ng_m5 = [];
        }
        
        $output_ng_m5_shift3 = "SELECT * FROM " . $select_line . "_output_ng_total WHERE `time` BETWEEN '$date 00:00:00' AND '$date 05:59:59'";
        $result_output_ng_m5_shift3 = mysqli_query($connect, $output_ng_m5_shift3);
        if($result_output_ng_m5_shift3 && $result_output_ng_m5_shift3 -> num_rows > 0){
            $k = 0;
            while($row = $result_output_ng_m5_shift3->fetch_assoc()){
                $data_output_ng_m5_shift3[$k][0] = $row['id'];
                $data_output_ng_m5_shift3[$k][1] = $row['defect_name'];
                $data_output_ng_m5_shift3[$k][2] = $row['time'];
                $k++;
            }
        }
        else{
            $data_output_ng_m5_shift3 = [];
        }
        
        for($k = 0; $k < count($data_output_ng_m5_shift3); $k++){
            if($data_output_ng_m5_shift3[$k][2] >=  "$date 00:00:00" && $data_output_ng_m5_shift3[$k][2] <= "$date 00:59:59"){
                $output_ng_0h++;
            }
            elseif($data_output_ng_m5_shift3[$k][2] >=  "$date 01:00:00" && $data_output_ng_m5_shift3[$k][2] <= "$date 01:59:59"){
                $output_ng_1h++;
            }
            elseif($data_output_ng_m5_shift3[$k][2] >=  "$date 02:00:00" && $data_output_ng_m5_shift3[$k][2] <= "$date 02:59:59"){
                $output_ng_2h++;
            }
            elseif($data_output_ng_m5_shift3[$k][2] >=  "$date 03:00:00" && $data_output_ng_m5_shift3[$k][2] <= "$date 03:59:59"){
                $output_ng_3h++;
            }
            elseif($data_output_ng_m5_shift3[$k][2] >=  "$date 04:00:00" && $data_output_ng_m5_shift3[$k][2] <= "$date 04:59:59"){
                $output_ng_4h++;
            }
            elseif($data_output_ng_m5_shift3[$k][2] >=  "$date 05:00:00" && $data_output_ng_m5_shift3[$k][2] <= "$date 05:59:59"){
                $output_ng_5h++;
            }
            
        }
        
        for($k = 0; $k < count($data_output_ng_m5); $k++){
            if($data_output_ng_m5[$k][2] >=  "$yesterday 06:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 06:59:59"){
                $output_ng_6h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 07:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 07:59:59"){
                $output_ng_7h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 08:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 08:59:59"){
                $output_ng_8h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 09:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 09:59:59"){
                $output_ng_9h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 10:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 10:59:59"){
                $output_ng_10h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 11:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 11:59:59"){
                $output_ng_11h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 12:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 12:59:59"){
                $output_ng_12h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 13:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 13:59:59"){
                $output_ng_13h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 14:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 14:59:59"){
                $output_ng_14h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 15:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 15:59:59"){
                $output_ng_15h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 16:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 16:59:59"){
                $output_ng_16h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 17:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 17:59:59"){
                $output_ng_17h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 18:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 18:59:59"){
                $output_ng_18h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 19:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 19:59:59"){
                $output_ng_19h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 20:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 20:59:59"){
                $output_ng_20h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 21:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 21:59:59"){
                $output_ng_21h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 22:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 22:59:59"){
                $output_ng_22h++;
            }
            elseif($data_output_ng_m5[$k][2] >=  "$yesterday 23:00:00" && $data_output_ng_m5[$k][2] <= "$yesterday 23:59:59"){
                $output_ng_23h++;
            }
        }
    }
    // print_r($data_ouput_m5);
?>

<!-- <style>
        
    #table_1 td{
        font-size: 15px;
        font-weight: bold;
    }
    #table_2 td{
        font-size: 15px;
        font-weight: bold;
    }
    #table_3 td{
        font-size: 15px;
        font-weight: bold;
    }

    table a:hover {
        background: #99CCFF;
        color: #000;
    }
</style> -->

                <div id="shift_1" class="col-sm-12">
                    <h4 style="margin-bottom: 10px;">Ca 1(直1)</h4>
                    <table id="table_1" class="table table-dark table-hover" style="text-align: center;">
                        <thead>
                            <tr>
                                <th style="width: 20%;" >Thời gian (時間)</th>
                                <th style="width: 15%;" >SL theo giờ</th>
                                <th style="width: 15%;" >SL mục tiêu theo giờ</th>
                                <th style="width: 15%;" ><a style="color:white;" href="oee_filter.php">SL lũy kế</a></th>
                                <th style="width: 15%;" >Mục tiêu <br> (出来高目標)</th>
                                <th style="width: 15%;" >Hiệu suất</th>
                                <th style="width: 5%;" ><a style="color:white;" href="output_ng.php">NG</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>06:00-07:00</td>
                                <td style="color: yellow;"><?php echo $output_6h; ?></td>
                                <td>947</td>
                                <td style="color: yellow;"><?php echo $performance_6h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_6h; ?></td>
                                
                            </tr>
                            <tr>
                                <td>07:00-08:00</td>
                                <td style="color: yellow;"><?php echo $output_7h; ?></td>
                                <td>1894</td>
                                <td style="color: yellow;"><?php echo $performance_7h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_7h; ?></td>
                            </tr>
                            
                            <tr>
                                <td>08:00-09:00</td>
                                <td style="color: yellow;"><?php echo $output_8h; ?></td>
                                <td>2683</td>
                                <td style="color: yellow;"><?php echo $performance_8h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_8h; ?></td>
                            </tr>
                            <tr>
                                <td>09:00-10:00</td>
                                <td style="color: yellow;"><?php echo $output_9h; ?></td>
                                <td>3315</td>
                                <td style="color: yellow;"><?php echo $performance_9h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_9h; ?></td>
                            </tr>
                            <tr>
                                <td>10:00-11:00</td>
                                <td style="color: yellow;"><?php echo $output_10h; ?></td>
                                <td>4104</td>
                                <td style="color: yellow;"><?php echo $performance_10h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_10h; ?></td>
                            </tr>
                            <tr>
                                <td>11:00-12:00</td>
                                <td style="color: yellow;"><?php echo $output_11h; ?></td>
                                <td>5051</td>
                                <td style="color: yellow;"><?php echo $performance_11h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_11h; ?></td>
                            </tr>
                            <tr>
                                <td>12:00-13:00</td>
                                <td style="color: yellow;"><?php echo $output_12h; ?></td>
                                <td>5840</td>
                                <td style="color: yellow;"><?php echo $performance_12h; ?>%</td>
                                <td style="color: yellow;" style="color: yellow;"><?php echo $output_ng_12h; ?></td>
                            </tr>
                            <tr>
                                <td>13:00-14:00</td>
                                <td style="color: yellow;"><?php echo $output_13h; ?></td>
                                <td>6787</td>
                                <td style="color: yellow;"><?php echo $performance_13h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_13h; ?></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <div id="shift_2" class="col-sm-12">
                
                    <h4 style="margin-bottom: 10px;">Ca 2(直2)</h4>
                    <table id="table_2" class="table table-dark table-hover" style="text-align: center;">
                        <thead>
                            <tr>
                                <th style="width: 30%;" >Thời gian (時間)</th>
                                <th style="width: 25%;" ><a style="color:white;" href="oee_filter.php">Sản lượng (出来高)</a></th>
                                <th style="width: 25%;" >Mục tiêu <br> (出来高目標)</th>
                                <th style="width: 15%;" >Hiệu suất</th>
                                <th style="width: 5%;" ><a style="color:white;" href="output_ng.php">NG</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>14:00-15:00</td>
                                <td style="color: yellow;"><?php echo $output_14h; ?></td>
                                <td>947</td>
                                <td style="color: yellow;"><?php echo $performance_14h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_14h; ?></td>
                                
                            </tr>
                            <tr>
                                <td>15:00-16:00</td>
                                <td style="color: yellow;"><?php echo $output_15h; ?></td>
                                <td>1894</td>
                                <td style="color: yellow;"><?php echo $performance_15h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_15h; ?></td>
                            </tr>
                            <tr>
                                <td>16:00-17:00</td>
                                <td style="color: yellow;"><?php echo $output_16h; ?></td>
                                <td>2683</td>
                                <td style="color: yellow;"><?php echo $performance_16h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_16h; ?></td>
                            </tr>
                            <tr>
                                <td>17:00-18:00</td>
                                <td style="color: yellow;"><?php echo $output_17h; ?></td>
                                <td>3315</td>
                                <td style="color: yellow;"><?php echo $performance_17h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_17h; ?></td>
                            </tr>
                            <tr>
                                <td>18:00-19:00</td>
                                <td style="color: yellow;"><?php echo $output_18h; ?></td>
                                <td>4104</td>
                                <td style="color: yellow;"><?php echo $performance_18h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_18h; ?></td>
                            </tr>
                            <tr>
                                <td>19:00-20:00</td>
                                <td style="color: yellow;"><?php echo $output_19h; ?></td>
                                <td>5051</td>
                                <td style="color: yellow;"><?php echo $performance_19h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_19h; ?></td>
                            </tr>
                            <tr>
                                <td>20:00-21:00</td>
                                <td style="color: yellow;"><?php echo $output_20h; ?></td>
                                <td>5840</td>
                                <td style="color: yellow;"><?php echo $performance_20h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_20h; ?></td>
                            </tr>
                            <tr>
                                <td>21:00-22:00</td>
                                <td style="color: yellow;"><?php echo $output_21h; ?></td>
                                <td>6787</td>
                                <td style="color: yellow;"><?php echo $performance_21h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_21h; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
              
                <!-- <div id="shift_3" class="col-sm-6 offset-sm-3" > -->
                <div id="shift_3" class="col-sm-12" >
                    <h4 style="margin-bottom: 10px;">Ca 3(直3)</h4>
                    <table id="table_3" class="table table-dark table-hover" style="text-align: center;">
                        <thead>
                            <tr>
                                <th style="width: 25%;" >Thời gian (時間)</th>
                                <th style="width: 25%;" ><a style="color:white;" href="oee_filter.php">Sản lượng (出来高)</a></th>
                                <th style="width: 25%;" >Mục tiêu <br> (出来高目標)</th>
                                <th style="width: 15%;" >Hiệu suất</th>
                                <th style="width: 10%;" ><a style="color:white;" href="output_ng.php">NG</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>22:00-23:00</td>
                                <td style="color: yellow;"><?php echo $output_22h; ?></td>
                                <td>947</td>
                                <td style="color: yellow;"><?php echo $performance_22h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_22h; ?></td>
                            </tr>
                            <tr>
                                <td>23:00-00:00</td>
                                <td style="color: yellow;"><?php echo $output_23h; ?></td>
                                <td>1894</td>
                                <td style="color: yellow;"><?php echo $performance_23h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_23h; ?></td>
                            </tr>
                            <tr>
                                <td>00:00-1:00</td>
                                <td style="color: yellow;"><?php echo $output_0h; ?></td>
                                <td>2683</td>
                                <td style="color: yellow;"><?php echo $performance_0h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_0h; ?></td>
                            <tr>
                                <td>1:00-2:00</td>
                                <td style="color: yellow;"><?php echo $output_1h; ?></td>
                                <td>3315</td>
                                <td style="color: yellow;"><?php echo $performance_1h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_1h; ?></td>
                            </tr>
                            <tr>
                                <td>2:00-3:00</td>
                                <td style="color: yellow;"><?php echo $output_2h; ?></td>
                                <td>3868</td>
                                <td style="color: yellow;"><?php echo $performance_2h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_2h; ?></td>
                            </tr>
                            <tr>
                                <td>3:00-4:00</td>
                                <td style="color: yellow;"><?php echo $output_3h; ?></td>
                                <td>4815</td>
                                <td style="color: yellow;"><?php echo $performance_3h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_3h; ?></td>
                            </tr>
                            <tr>
                                <td>4:00-5:00</td>
                                <td style="color: yellow;"><?php echo $output_4h; ?></td>
                                <td>5604</td>
                                <td style="color: yellow;"><?php echo $performance_4h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_4h; ?></td>
                            </tr>
                            <tr>
                                <td>5:00-6:00</td>
                                <td style="color: yellow;"><?php echo $output_5h; ?></td>
                                <td>6551</td>
                                <td style="color: yellow;"><?php echo $performance_5h; ?>%</td>
                                <td style="color: yellow;"><?php echo $output_ng_5h; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>     
    </div>
<!-- <script>
    $(document).ready(function(){    
        setInterval(function(){
            $("#shift_1").load(" #shift_1 > *");
        }, 1000);
        
        setInterval(function(){
            $("#shift_2").load(" #shift_2 > *");
        }, 1000);
        
        setInterval(function(){
            $("#shift_3").load(" #shift_3 > *");
        }, 1000);
        
    });
</script> -->
