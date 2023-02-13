<?php
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];

    $date_now = date('Y-m-d H:i:s');
    $date = date('Y-m-d');

    // $yesterday_tmp = mktime(0, 0, 0, date("m") , date("d")-1, date("Y"));
    // $yesterday = date('Y-m-d', $yesterday_tmp);

    $select_date = isset($_GET['select_date']) ? $_GET['select_date'] : NULL;
    // echo $select_date . "<br>";
    // $select_date_yesterday = date($select_date, $yesterday_tmp);
    $select_date_next = date('Y-m-d', strtotime($select_date . '+ 1 days'));
    // echo $select_date_next . "<br>";

    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;
    $get_line = $select_line==''?'aw3_hourly_output':($select_line. '_hourly_output');

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

    $output = "SELECT * FROM " . $select_line . "_hourly_output " . "WHERE time LIKE '$select_date%' ORDER BY time ASC";
    $result_output = mysqli_query($connect, $output);
    if($result_output && $result_output -> num_rows > 0){
        $i = 0;
        while($row = $result_output->fetch_assoc()){
            $data_output[$i][0] = $row['id'];
            $data_output[$i][1] = $row['output'];
            $data_output[$i][2] = $row['time'];
            $i++;
        }
    }
    else{
        $data_output = [];
    }

    for($i = 0; $i < count($data_output);$i++){
        if($data_output[$i][2] ==  "$select_date 07:00:00"){
            $output_6h = $data_output[$i][1];
            $performance_6h = round(($output_6h / ($target_6h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 08:00:00"){
            $output_7h = $output_6h + $data_output[$i][1];
            $performance_7h = round(($output_7h / ($target_7h + $target_6h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 09:00:00"){
            $output_8h = $output_7h + $data_output[$i][1];
            $performance_8h = round(($output_8h / ($target_8h + $target_7h + $target_6h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 10:00:00"){
            $output_9h = $output_8h + $data_output[$i][1];
            $performance_9h = round(($output_9h / ($target_9h + $target_8h + $target_7h + $target_6h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 11:00:00"){
            if($data_output[$i][1] == null){
                $output_10h = $output_9h + $output_8h + $output_7h + $output_6h;
            }else{
                $output_10h = $output_9h + $data_output[$i][1];
            }
            $performance_10h = round(($output_10h / ($target_10h + $target_9h + $target_8h + $target_7h + $target_6h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 12:00:00"){
            $output_11h= $output_10h + $data_output[$i][1];
            $performance_11h = round(($output_11h / ($target_11h + $target_10h + $target_9h + $target_8h + $target_7h + $target_6h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 13:00:00"){
            $output_12h= $output_11h + $data_output[$i][1];
            $performance_12h = round(($output_12h / ($target_12h + $target_11h + $target_10h + $target_9h + $target_8h + $target_7h + $target_6h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 14:00:00"){
            $output_13h = $output_12h + $data_output[$i][1];
            $performance_13h = round(($output_13h / ($target_13h + $target_12h + $target_11h + $target_10h + $target_9h + $target_8h + $target_7h + $target_6h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 15:00:00"){
            $output_14h = $data_output[$i][1];
            $performance_14h = round(($output_14h / ($target_14h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 16:00:00"){
            $output_15h = $output_14h + $data_output[$i][1];
            $performance_15h = round(($output_15h / ($target_15h + $target_14h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 17:00:00"){
            $output_16h = $output_15h + $data_output[$i][1];
            $performance_16h = round(($output_16h / ($target_16h + $target_15h + $target_14h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 18:00:00"){
            $output_17h = $output_16h + $data_output[$i][1];
            $performance_17h = round(($output_17h / ($target_17h + $target_16h + $target_15h + $target_14h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 19:00:00"){
            $output_18h = $output_17h + $data_output[$i][1];
            $performance_18h = round(($output_18h / ($target_18h + $target_17h + $target_16h + $target_15h + $target_14h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 20:00:00"){
            $output_19h = $output_18h + $data_output[$i][1];
            $performance_19h = round(($output_19h / ($target_19h + $target_18h + $target_17h + $target_16h + $target_15h + $target_14h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 21:00:00"){
            $output_20h = $output_19h + $data_output[$i][1];
            $performance_20h = round(($output_20h / ($target_20h + $target_19h + $target_18h + $target_17h + $target_16h + $target_15h + $target_14h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 22:00:00"){
            $output_21h =  $output_20h + $data_output[$i][1];
            $performance_21h = round(($output_21h / ($target_21h + $target_20h + $target_19h + $target_18h + $target_17h + $target_16h + $target_15h + $target_14h)) * 100, 2);
        }
        else if($data_output[$i][2] ==  "$select_date 23:00:00"){
            $output_22h = $data_output[$i][1];
            $performance_22h = round(($output_22h / ($target_22h)) * 100, 2);
        }
    }

    $output_next = "SELECT * FROM " . $select_line . "_hourly_output " . "WHERE time LIKE '$select_date_next%'";
    $result_output_next = mysqli_query($connect, $output_next);
    if($result_output_next && $result_output_next -> num_rows > 0){
        $i = 0;
        while($row = $result_output_next->fetch_assoc()){
            $data_output_next[$i][0] = $row['id'];
            $data_output_next[$i][1] = $row['output'];
            $data_output_next[$i][2] = $row['time'];
            $i++;
        }
    }
    else{
        $data_output_next = [];
    }

    for($i = 0; $i < count($data_output_next);$i++){
        if($data_output_next[$i][2] ==  "$select_date_next 00:00:00"){
            if($data_output_next[$i][1] == null){
                $output_23h = $output_22h;
            }else{
                $output_23h = $output_22h + $data_output[$i][1];
            }
            $performance_23h = round(($output_23h / ($target_23h + $target_22h)) * 100, 2);
        }
        else if($data_output_next[$i][2] ==  "$select_date_next 01:00:00"){
            $output_0h = $output_23h + $data_output_next[$i][1];
            $performance_0h = round(($output_0h / ($target_0h + $target_23h + $target_22h)) * 100, 2);
        }
        else if($data_output_next[$i][2] ==  "$select_date_next 02:00:00"){
            $output_1h = $output_0h + $data_output_next[$i][1];
            $performance_1h = round(($output_0h / ($target_1h + $target_0h + $target_23h + $target_22h)) * 100, 2);
        }
        else if($data_output_next[$i][2] ==  "$select_date_next 03:00:00"){
            $output_2h = $output_1h + $data_output_next[$i][1];
            $performance_2h = round(($output_2h / ($target_2h + $target_1h + $target_0h + $target_23h + $target_22h)) * 100, 2);
        }
        else if($data_output_next[$i][2] ==  "$select_date_next 04:00:00"){
            $output_3h = $output_2h + $data_output_next[$i][1];
            $performance_3h = round(($output_3h / ($target_3h + $target_2h + $target_1h + $target_0h + $target_23h + $target_22h)) * 100, 2);
        }
        else if($data_output_next[$i][2] ==  "$select_date_next 05:00:00"){
            $output_4h = $output_3h + $data_output_next[$i][1];
            $performance_4h = round(($output_4h / ($target_4h + $target_3h + $target_2h + $target_1h + $target_0h + $target_23h + $target_22h)) * 100, 2);
        }
        else if($data_output_next[$i][2] ==  "$select_date_next 06:00:00"){
            $output_5h = $output_4h + $data_output_next[$i][1];
            $performance_5h = round(($output_5h / ($target_5h + $target_4h + $target_3h + $target_2h + $target_1h + $target_0h + $target_23h + $target_22h)) * 100, 2);
        }
    }

    $output_ng = "SELECT * FROM " . $select_line . "_output_ng_total " . "WHERE time LIKE '$select_date%'";
    $result_output_ng = mysqli_query($connect, $output_ng);
    if($result_output_ng && $result_output_ng -> num_rows > 0){
        $i = 0;
        while($row = $result_output_ng->fetch_assoc()){
            $data_output_ng[$i][0] = $row['id'];
            $data_output_ng[$i][1] = $row['defect_name'];
            $data_output_ng[$i][2] = $row['time'];
            $i++;
        }
    }
    else{
        $data_output_ng = [];
    }

    for($i = 0; $i < count($data_output_ng); $i++){
        if($data_output_ng[$i][2] >=  "$select_date 06:00:00" && $data_output_ng[$i][2] <= "$select_date 06:59:59"){
            $output_ng_6h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 07:00:00" && $data_output_ng[$i][2] <= "$select_date 07:59:59"){
            $output_ng_7h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 08:00:00" && $data_output_ng[$i][2] <= "$select_date 08:59:59"){
            $output_ng_8h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 09:00:00" && $data_output_ng[$i][2] <= "$select_date 09:59:59"){
            $output_ng_9h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 10:00:00" && $data_output_ng[$i][2] <= "$select_date 10:59:59"){
            $output_ng_10h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 11:00:00" && $data_output_ng[$i][2] <= "$select_date 11:59:59"){
            $output_ng_11h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 12:00:00" && $data_output_ng[$i][2] <= "$select_date 12:59:59"){
            $output_ng_12h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 13:00:00" && $data_output_ng[$i][2] <= "$select_date 13:59:59"){
            $output_ng_13h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 14:00:00" && $data_output_ng[$i][2] <= "$select_date 14:59:59"){
            $output_ng_14h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 15:00:00" && $data_output_ng[$i][2] <= "$select_date 15:59:59"){
            $output_ng_15h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 16:00:00" && $data_output_ng[$i][2] <= "$select_date 16:59:59"){
            $output_ng_16h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 17:00:00" && $data_output_ng[$i][2] <= "$select_date 17:59:59"){
            $output_ng_17h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 18:00:00" && $data_output_ng[$i][2] <= "$select_date 18:59:59"){
            $output_ng_18h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 19:00:00" && $data_output_ng[$i][2] <= "$select_date 19:59:59"){
            $output_ng_19h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 20:00:00" && $data_output_ng[$i][2] <= "$select_date 20:59:59"){
            $output_ng_20h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 21:00:00" && $data_output_ng[$i][2] <= "$select_date 21:59:59"){
            $output_ng_21h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 22:00:00" && $data_output_ng[$i][2] <= "$select_date 22:59:59"){
            $output_ng_22h++;
        }
        else if($data_output_ng[$i][2] >=  "$select_date 23:00:00" && $data_output_ng[$i][2] <= "$select_date 23:59:59"){
            $output_ng_23h++;
        }
    }

    $output_ng_next = "SELECT * FROM " . $select_line . "_output_ng_total " . "WHERE time LIKE '$select_date_next%'";
    $result_output_ng_next = mysqli_query($connect, $output_ng_next);
    if($result_output_ng_next && $result_output_ng_next -> num_rows > 0){
        $i = 0;
        while($row = $result_output_ng_next->fetch_assoc()){
            $data_output_ng_next[$i][0] = $row['id'];
            $data_output_ng_next[$i][1] = $row['defect_name'];
            $data_output_ng_next[$i][2] = $row['time'];
            $i++;
        }
    }
    else{
        $data_output_ng_next = [];
    }

    for($i = 0; $i < count($data_output_ng_next); $i++){
        if($data_output_ng_next[$i][2] >=  "$select_date_next 00:00:00" && $data_output_ng_next[$i][2] <= "$select_date_next 00:59:59"){
            $output_ng_0h++;
        }
        else if($data_output_ng_next[$i][2] >=  "$select_date_next 01:00:00" && $data_output_ng_next[$i][2] <= "$select_date_next 01:59:59"){
            $output_ng_1h++;
        }
        else if($data_output_ng_next[$i][2] >=  "$select_date_next 02:00:00" && $data_output_ng_next[$i][2] <= "$select_date_next 02:59:59"){
            $output_ng_2h++;
        }
        else if($data_output_ng_next[$i][2] >=  "$select_date_next 03:00:00" && $data_output_ng_next[$i][2] <= "$select_date_next 03:59:59"){
            $output_ng_3h++;
        }
        else if($data_output_ng_next[$i][2] >=  "$select_date_next 04:00:00" && $data_output_ng_next[$i][2] <= "$select_date_next 04:59:59"){
            $output_ng_4h++;
        }
        else if($data_output_ng_next[$i][2] >=  "$select_date_next 05:00:00" && $data_output_ng_next[$i][2] <= "$select_date_next 05:59:59"){
            $output_ng_5h++;
        }
    }

?>
    <style>
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
    </style>
                <div id="shift_1" class="col-sm-12">
                    <h4 style="margin-bottom: 10px;">Ca 1(直1)</h4>
                    <table id="table_1" class="table table-dark table-hover" style="text-align: center;">
                        <thead>
                            <tr>
                                <th style="width: 30%;" >Thời gian (時間)</th>
                                <th style="width: 25%;" ><a style="color:white;" href="#">Sản lượng (出来高)</a></th>
                                <th style="width: 25%;" >Mục tiêu <br> (出来高目標)</th>
                                <th style="width: 15%;" >Hiệu suất</th>
                                <th style="width: 5%;" ><a style="color:white;" href="../outputNG/indexOutputNG">NG</a></th>
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
                                <th style="width: 5%;" ><a style="color:white;" href="../outputNG/indexOutputNG">NG</a></th>
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
                                <th style="width: 30%;" >Thời gian (時間)</th>
                                <th style="width: 25%;" ><a style="color:white;" href="oee_filter.php">Sản lượng (出来高)</a></th>
                                <th style="width: 25%;" >Mục tiêu <br> (出来高目標)</th>
                                <th style="width: 15%;" >Hiệu suất</th>
                                <th style="width: 5%;" ><a style="color:white;" href="../outputNG/indexOutputNG">NG</a></th>
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