<?php
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];
    //khai bao bien
    $date_now = date('Y-m-d H:i:s');
    $date = date('Y-m-d');
    
    $yesterday_tmp = mktime(0, 0, 0, date("m") , date("d")-1, date("Y"));
    $yesterday = date('Y-m-d', $yesterday_tmp);
    
    $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : NULL;
    $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : NULL;
    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;

    #option 1
    // $get_line = '';
    // switch ($select_line){
    //     case 'aw3':
    //         $get_line = 'aw3_long_downtime';
    //         break;
    //     case 'aw2':
    //         $get_line = 'aw2_long_downtime';
    //         break;
    //     case 'jatco':
    //         $get_line = 'jatco_long_downtime';
    //         break;
    // }

    //option 2
    $get_line = $select_line==''?'aw3_long_downtime':($select_line. '_long_downtime');
    
    
    if($date_now >= "$date 06:00:00"){
        if($from_date == $to_date){
            // $short_downtime = "SELECT * FROM `aw3_long_downtime` WHERE `id_name` NOT IN (1177,1178,1228) AND `time` BETWEEN '$from_date 06:00:00' AND '$to_date 23:59:59' AND `period` < 300";
            $short_downtime = "SELECT * FROM $get_line WHERE id_name NOT IN (1177,1178,1228) AND time BETWEEN '$from_date 06:00:00' AND '$to_date 23:59:59' AND period < 300 ORDER BY time DESC";
            $resultcheck_short = mysqli_query( $connect, $short_downtime );
            if ($resultcheck_short && $resultcheck_short->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_short->fetch_assoc()) {
                    //thêm kết quả vào mảng
                    $data_short_downtime[$i][0]=$row['id'];
                    $data_short_downtime[$i][1]=$row['op'];
                    $data_short_downtime[$i][2]=$row['name'];
                    $data_short_downtime[$i][3]=$row['name_jp'];
                    $data_short_downtime[$i][4]=$row['comment'];
                    $data_short_downtime[$i][5]=$row['begin'];
                    $data_short_downtime[$i][6]=$row['period'];
                    $data_short_downtime[$i][7]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_short_downtime = [];
            }
        }else{
            $short_downtime = "SELECT * FROM $get_line WHERE id_name NOT IN (1177,1178,1228) AND time BETWEEN '$from_date 06:00:00' AND '$to_date 23:59:59' AND period < 300 ORDER BY time DESC";
            $resultcheck_short = mysqli_query( $connect, $short_downtime );
            if ($resultcheck_short && $resultcheck_short->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_short->fetch_assoc()) {
                    //thêm kết quả vào mảng
                    $data_short_downtime[$i][0]=$row['id'];
                    $data_short_downtime[$i][1]=$row['op'];
                    $data_short_downtime[$i][2]=$row['name'];
                    $data_short_downtime[$i][3]=$row['name_jp'];
                    $data_short_downtime[$i][4]=$row['comment'];
                    $data_short_downtime[$i][5]=$row['begin'];
                    $data_short_downtime[$i][6]=$row['period'];
                    $data_short_downtime[$i][7]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_short_downtime = [];   
            }
        }
    }
    
    //TH2
    elseif($date_now < "$date 06:00:00" && $date_now >= "$date 00:00:00"){
        if($from_date == $to_date){
            $short_downtime = "SELECT * FROM $get_line WHERE id_name NOT IN (1177,1178,1228) AND time BETWEEN '$from_date 06:00:00' AND '$to_date 05:59:59' AND period < 300 ORDER BY time DESC";
            $resultcheck_short = mysqli_query( $connect, $short_downtime );
            if ($resultcheck_short && $resultcheck_short->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_short->fetch_assoc()) {
                    //thêm kết quả vào mảng
                    $data_short_downtime[$i][0]=$row['id'];
                    $data_short_downtime[$i][1]=$row['op'];
                    $data_short_downtime[$i][2]=$row['name'];
                    $data_short_downtime[$i][3]=$row['name_jp'];
                    $data_short_downtime[$i][4]=$row['comment'];
                    $data_short_downtime[$i][5]=$row['begin'];
                    $data_short_downtime[$i][6]=$row['period'];
                    $data_short_downtime[$i][7]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_short_downtime = [];
                         
            }
        }else{
            $short_downtime = "SELECT * FROM $get_line WHERE id_name NOT IN (1177,1178,1228) AND time BETWEEN '$from_date 06:00:00' AND '$to_date 05:59:59' AND period < 300 ORDER BY time DESC";
            $resultcheck_short = mysqli_query( $connect, $short_downtime );
            if ($resultcheck_short && $resultcheck_short->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_short->fetch_assoc()) {
                    //thêm kết quả vào mảng
                    $data_short_downtime[$i][0]=$row['id'];
                    $data_short_downtime[$i][1]=$row['op'];
                    $data_short_downtime[$i][2]=$row['name'];
                    $data_short_downtime[$i][3]=$row['name_jp'];
                    $data_short_downtime[$i][4]=$row['comment'];
                    $data_short_downtime[$i][5]=$row['begin'];
                    $data_short_downtime[$i][6]=$row['period'];
                    $data_short_downtime[$i][7]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_short_downtime = [];
            }
        }
    }
    if($select_line == 'aw3' || $select_line == 'jatco'){
        for($i = 0; $i < count($data_short_downtime); $i++){
            if($data_short_downtime[$i][1] == 1){
                $data_short_downtime[$i][1] = 'Ép Terminal(タミナル圧入)';
            }
            else if($data_short_downtime[$i][1] == 2){
                $data_short_downtime[$i][1] = 'Quấn Đồng(巻線)';
            }
            else if($data_short_downtime[$i][1] == 3){
                $data_short_downtime[$i][1] = 'Ép Core(Core圧入)';
            }
            else if($data_short_downtime[$i][1] == 4){
                $data_short_downtime[$i][1] = 'Đúc(成形)';
            }
            else if($data_short_downtime[$i][1] == 5){
                $data_short_downtime[$i][1] = 'Kiểm Tra(特性検査)';
            }
        }
    }
    else if ($select_line == "aw2"){
        for($i = 0; $i < count($data_short_downtime); $i++){
            if($data_short_downtime[$i][1] == 0){
                $data_short_downtime[$i][1] = 'Cấp Bobin';
            }
            if($data_short_downtime[$i][1] == 1){
                $data_short_downtime[$i][1] = 'Ép Terminal(タミナル圧入)';
            }
            else if($data_short_downtime[$i][1] == 2){
                $data_short_downtime[$i][1] = 'Quấn Đồng(巻線)';
            }
            else if($data_short_downtime[$i][1] == 31){
                $data_short_downtime[$i][1] = 'Hàn';
            }
            else if($data_short_downtime[$i][1] == 32){
                $data_short_downtime[$i][1] = 'Bàn Pha';
            }
            else if($data_short_downtime[$i][1] == 4){
                $data_short_downtime[$i][1] = 'Đúc(成形)';
            }
            else if($data_short_downtime[$i][1] == 5){
                $data_short_downtime[$i][1] = 'Kiểm Tra(特性検査)';
            }
        }
    }
    //aw2 CĐ 0: Cấp bobin; 1: ép Terminal; 2: Quấn Đồng; 31: Hàn; 32: Bàn Pha; 4: Đúc; 5: Kiểm Tra
    
?>

