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
            $get_line = 'aw3_line_prepare';
            break;
        case 'aw2':
            $get_line = 'aw2_line_prepare';
            break;
        case 'jatco':
            $get_line = 'jatco_line_prepare';
            break;
        default:
            $get_line = 'aw3_line_prepare';
    }

    //TH1
    if($date_now >= "$date 06:00:00"){
        if($from_date == $to_date){
            $line_prepare = "SELECT * FROM $get_line WHERE `time` BETWEEN '$from_date 06:00:00' AND '$to_date 23:59:59'";
            $resultcheck_prepare = mysqli_query( $connect, $line_prepare );
            if ($resultcheck_prepare && $resultcheck_prepare->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_prepare->fetch_assoc()) {
                    //thêm kết quả vào mảng
                    $data_line_prepare[$i][0]=$row['id'];
                    $data_line_prepare[$i][1]=$row['sub_time'];
                    $data_line_prepare[$i][2]=$row['begin'];
                    $data_line_prepare[$i][3]=$row['period'];
                    $data_line_prepare[$i][4]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_line_prepare = [];
            }
        }else{
            $line_prepare = "SELECT * FROM $get_line WHERE `time` BETWEEN '$from_date 06:00:00' AND '$to_date 23:59:59'";
            $resultcheck_prepare = mysqli_query( $connect, $line_prepare );
            if ($resultcheck_prepare && $resultcheck_prepare->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_prepare->fetch_assoc()) {
                    //thêm kết quả vào mảng
                    $data_line_prepare[$i][0]=$row['id'];
                    $data_line_prepare[$i][1]=$row['sub_time'];
                    $data_line_prepare[$i][2]=$row['begin'];
                    $data_line_prepare[$i][3]=$row['period'];
                    $data_line_prepare[$i][4]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_line_prepare = [];
            }
        }
    }
    
    //TH2
    elseif($date_now < "$date 06:00:00" && $date_now >= "$date 00:00:00"){
        if($from_date == $to_date){
            $line_prepare = "SELECT * FROM $get_line WHERE `time` BETWEEN '$from_date 06:00:00' AND '$to_date 05:59:59'";
            $resultcheck_prepare = mysqli_query( $connect, $line_prepare );
            if ($resultcheck_prepare && $resultcheck_prepare->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_prepare->fetch_assoc()) {
                    //thêm kết quả vào mảng
                    $data_line_prepare[$i][0]=$row['id'];
                    $data_line_prepare[$i][1]=$row['sub_time'];
                    $data_line_prepare[$i][2]=$row['begin'];
                    $data_line_prepare[$i][3]=$row['period'];
                    $data_line_prepare[$i][4]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_line_prepare = [];
            }
        }else{
            $line_prepare = "SELECT * FROM $get_line WHERE `time` BETWEEN '$from_date 06:00:00' AND '$to_date 05:59:59'";
            $resultcheck_prepare = mysqli_query( $connect, $line_prepare );
            if ($resultcheck_prepare && $resultcheck_prepare->num_rows > 0) {
                $i = 0;
                while ($row = $resultcheck_prepare->fetch_assoc()) {
                    //thêm kết quả vào mảng
                    $data_line_prepare[$i][0]=$row['id'];
                    $data_line_prepare[$i][1]=$row['sub_time'];
                    $data_line_prepare[$i][2]=$row['begin'];
                    $data_line_prepare[$i][3]=$row['period'];
                    $data_line_prepare[$i][4]=$row['time'];
                    $i++;
                }
            }
            else{
                $data_line_prepare = [];
            }
        }
        
    }
    
    $sum_begin = 0;
    $sum_end = 0;
    for($i = 0; $i < count($data_line_prepare); $i++){
        if($data_line_prepare[$i][1] == 'begin1' || $data_line_prepare[$i][1] == 'begin2' || $data_line_prepare[$i][1] == 'begin3'){
            $sum_begin += $data_line_prepare[$i][3];
        }else if($data_line_prepare[$i][1] == 'end1' || $data_line_prepare[$i][1] == 'end2' || $data_line_prepare[$i][1] == 'end3'){
            $sum_end += $data_line_prepare[$i][3];
        }
    }

    for($i = 0; $i < count($data_line_prepare); $i++){
        if($data_line_prepare[$i][1] == "begin1"){
            $data_line_prepare[$i][1] = "Đầu Ca 1";
        }
        else if($data_line_prepare[$i][1] == "begin2"){
            $data_line_prepare[$i][1] = "Đầu Ca 2";
        }
        else if($data_line_prepare[$i][1] == "begin3"){
            $data_line_prepare[$i][1] = "Đầu Ca 3";
        }
        else if($data_line_prepare[$i][1] == "end1"){
            $data_line_prepare[$i][1] = "Cuối Ca 1";
        }
        else if($data_line_prepare[$i][1] == "end2"){
            $data_line_prepare[$i][1] = "Cuối Ca 2";
        }
        else{
            $data_line_prepare[$i][1] = "Cuối Ca 3";
        }
    }
?>
    <style>

    </style>

    <div class="col-sm-12">          
        <table id="prepare_content" class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Thời gian (phút) <br> 時間（分）</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Đầu Ca</td>
                    <td><?php echo round($sum_begin /60, 1); ?></td>
                    
                </tr>
                <tr>
                    <td>Cuối Ca</td>
                    <td><?php echo round($sum_end / 60, 1); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <hr>
    <h5 style="margin-top:40px; font-weight:bold;">Chi tiết</h5>
    <div class="col-sm-12">
        
            <table id="prepare_details" class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Nội dung</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Thời gian (phút) <br> 時間（分）</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i = 0; $i < count($data_line_prepare); $i++){
                            echo '<tr>';
                            echo '<td>' . $data_line_prepare[$i][1] . '</td>
                                <td>'. $data_line_prepare[$i][2] . '</td>
                                <td>'. round((int)$data_line_prepare[$i][3] / 60, 1) . '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
    </div>

<script src="
    <?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/six_losses/views/default/js/datatables_func.js" ?>">
</script>
<script type="text/javascript">
    createDataTable('prepare_details', 10, true);
</script>