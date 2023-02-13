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

    $get_line = '';
    switch ($select_line){
        case 'aw3':
            $get_line = 'aw3_output_ng_total';
            break;
        case 'aw2':
            $get_line = 'aw2_output_ng_total';
            break;
        case 'jatco':
            $get_line = 'jatco_output_ng_total';
            break;
        default:
            $get_line = 'aw3_output_ng_total';
    }
    // $select_line = "aw3";
    // echo $from_date . "</br>";
    
    if($date_now >= "$date 06:00:00"){
        if($from_date == $to_date){
            $ng = "SELECT * FROM $get_line WHERE time BETWEEN '$from_date 06:00:00' AND '$to_date 23:59:59' ORDER BY time DESC";
            $resultcheck_ng = mysqli_query( $connect, $ng );
            if ($resultcheck_ng && $resultcheck_ng->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_ng->fetch_assoc()) {
                    //thêm kết quả vào mảng
                    $data_ng[$i][0]=$row['id'];
                    $data_ng[$i][1]=$row['op'];
                    $data_ng[$i][2]=$row['defect_name'];
                    $data_ng[$i][3]=$row['name_jp'];
                    $data_ng[$i][4]=$row['comment'];
                    $data_ng[$i][5]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_ng = [];
            }
        }else{
            $ng = "SELECT * FROM $get_line WHERE time BETWEEN '$from_date 06:00:00' AND '$to_date 23:59:59' ORDER BY time DESC";
            $resultcheck_ng = mysqli_query( $connect, $ng );
            if ($resultcheck_ng && $resultcheck_ng->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_ng->fetch_assoc()) {
                    //thêm kết quả vào mảng
                    $data_ng[$i][0]=$row['id'];
                    $data_ng[$i][1]=$row['op'];
                    $data_ng[$i][2]=$row['defect_name'];
                    $data_ng[$i][3]=$row['name_jp'];
                    $data_ng[$i][4]=$row['comment'];
                    $data_ng[$i][5]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_ng = [];
            }
        }
    }
    
    //TH2
    elseif($date_now < "$date 06:00:00" && $date_now >= "$date 00:00:00"){
        if($from_date == $to_date){
            $ng = "SELECT * FROM $get_line WHERE time BETWEEN '$from_date 06:00:00' AND '$to_date 23:59:59' ORDER BY time DESC";
            $resultcheck_ng = mysqli_query( $connect, $ng );
            if ($resultcheck_ng && $resultcheck_ng->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_ng->fetch_assoc()) {
                    //thêm kết quả vào mảng
                    $data_ng[$i][0]=$row['id'];
                    $data_ng[$i][1]=$row['op'];
                    $data_ng[$i][2]=$row['defect_name'];
                    $data_ng[$i][3]=$row['name_jp'];
                    $data_ng[$i][4]=$row['comment'];
                    $data_ng[$i][5]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_ng = [];
            }
        }else{
            $ng = "SELECT * FROM $get_line WHERE time BETWEEN '$from_date 06:00:00' AND '$to_date 23:59:59' ORDER BY time DESC";
            $resultcheck_ng = mysqli_query( $connect, $ng );
            if ($resultcheck_ng && $resultcheck_ng->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_ng->fetch_assoc()) {
                    //thêm kết quả vào mảng
                    $data_ng[$i][0]=$row['id'];
                    $data_ng[$i][1]=$row['op'];
                    $data_ng[$i][2]=$row['defect_name'];
                    $data_ng[$i][3]=$row['name_jp'];
                    $data_ng[$i][4]=$row['comment'];
                    $data_ng[$i][5]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_ng = [];
            }
        }
    }

    if($select_line == 'aw3' || $select_line == 'jatco'){
        for($i = 0; $i < count($data_ng); $i++){
            if($data_ng[$i][1] == 1){
                $data_ng[$i][1] = 'Ép Terminal(タミナル圧入)';
            }
            else if($data_ng[$i][1] == 2){
                $data_ng[$i][1] = 'Quấn Đồng(巻線)';
            }
            else if($data_ng[$i][1] == 3){
                $data_ng[$i][1] = 'Ép Core(Core圧入)';
            }
            else if($data_ng[$i][1] == 4){
                $data_ng[$i][1] = 'Đúc(成形)';
            }
            else if($data_ng[$i][1] == 5){
                $data_ng[$i][1] = 'Kiểm Tra(特性検査)';
            }
        }
    }
    else if ($select_line == "aw2"){
        for($i = 0; $i < count($data_ng); $i++){
            if($data_ng[$i][1] == 0){
                $data_ng[$i][1] = 'Cấp Bobin';
            }
            if($data_ng[$i][1] == 1){
                $data_ng[$i][1] = 'Ép Terminal(タミナル圧入)';
            }
            else if($data_ng[$i][1] == 2){
                $data_ng[$i][1] = 'Quấn Đồng(巻線)';
            }
            else if($data_ng[$i][1] == 31){
                $data_ng[$i][1] = 'Hàn';
            }
            else if($data_ng[$i][1] == 32){
                $data_ng[$i][1] = 'Bàn Pha';
            }
            else if($data_ng[$i][1] == 4){
                $data_ng[$i][1] = 'Đúc(成形)';
            }
            else if($data_ng[$i][1] == 5){
                $data_ng[$i][1] = 'Kiểm Tra(特性検査)';
            }
        }
    }
?>

