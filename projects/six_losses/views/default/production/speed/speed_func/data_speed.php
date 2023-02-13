<?php
    
    require_once "config/config.php";
    // $chart_type = isset($_GET['chart_type']) ? $_GET['chart_type'] : NULL; ///
    $date_now = date('Y-m-d H:i:s');
    $date = date('Y-m-d');
    
    $yesterday_tmp = mktime(0, 0, 0, date("m") , date("d")-1, date("Y"));
    $yesterday = date('Y-m-d', $yesterday_tmp);
    
    $start_time = isset($_GET['starttime']) ? $_GET['starttime'] : NULL; // 
    $stop_time = isset($_GET['stoptime']) ? $_GET['stoptime'] : NULL; //
    $select_date = isset($_GET['select_date']) ? $_GET['select_date'] : NULL; //
    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;
    
    $start_time_tmp = $select_date . ' ' . $start_time;
    $stop_time_tmp = $select_date . ' ' . $stop_time;

    //get line
    $get_line = '';
    
    switch ($select_line){
        case 'aw3':
            $get_line = 'aw3_long_downtime';
            break;
        case 'aw2':
            $get_line = 'aw2_long_downtime';
            break;
        case 'jatco':
            $get_line = 'jatco_long_downtime';
            break;
        default:
            $get_line = 'aw3_long_downtime';
    }
    
    $sql_ttime_standard= "SELECT * FROM ttime_standard";
    $result_ttime_standard = mysqli_query($connect, $sql_ttime_standard); 
    if ($result_ttime_standard && $result_ttime_standard->num_rows > 0) {
        $i = 0;
        while ($row = mysqli_fetch_array($result_ttime_standard)) { 
            $data_ttime_standard[$i][0] = $row['id']; 
            $data_ttime_standard[$i][1] = $row['line'];
            $data_ttime_standard[$i][2] = $row['code'];
            $data_ttime_standard[$i][3] = $row['tacktime_standard'];
            $data_ttime_standard[$i][4] = $row['time_update'];
            $i++;
        }
    }
    else{
        $data_ttime_standard = []; 
    }

    for($i = 0; $i < count($data_ttime_standard); $i++){
        if($select_line == "aw2"){
            $data_ttime_standard[$i][1] = "aw2";
        }
        else if($select_line == "aw3"){
            $data_ttime_standard[$i][1] = "aw3";
        }
        else if($select_line == "jatco"){
            $data_ttime_standard[$i][1] = "jatco";
        }
    }
    
?>
