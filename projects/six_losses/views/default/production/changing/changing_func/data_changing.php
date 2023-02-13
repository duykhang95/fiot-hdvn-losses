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

    $get_line_code = '';
    $get_line_electrode = '';
    $get_line_wire = '';
    
    switch ($select_line){
        case 'aw3':
            $get_line_code = 'aw3_code_change';
            $get_line_electrode = $get_line_wire = 'aw3_change_wire';
            break;
        case 'aw2':
            $get_line_code = 'aw2_code_change';
            $get_line_electrode = $get_line_wire = 'aw2_change_wire';
            break;
        case 'jatco':
            $get_line_code = 'jatco_code_change';
            $get_line_electrode = $get_line_wire = 'jatco_change_wire';
            break;
        default:
            $get_line_code = 'aw3_code_change';
            $get_line_electrode = $get_line_wire = 'aw3_change_wire';
    }

    if($date_now >= "$date 06:00:00"){
        if($from_date == $to_date){
            //data code change
            $code_change = "SELECT * FROM $get_line_code WHERE time BETWEEN '$from_date 06:00:00' AND '$to_date 23:59:59' ORDER BY time DESC";
            $result_code = mysqli_query( $connect, $code_change );
            if ($result_code && $result_code->num_rows > 0) {
                $i = 0;
                while($row = $result_code-> fetch_assoc()){
                    $data_code_change[$i][0] = $row['time'];
                    $data_code_change[$i][1] = $row['code'];
                    $data_code_change[$i][2] = $row['period'];                   
                    $i++;
                }
            }
            else{
                $data_code_change = [];
            }
            // print_r($data_code_change);
             //data electrode
            if($select_line == 'jatco' || $select_line == 'aw2'){
                $electrode_change = "SELECT * FROM $get_line_electrode WHERE id_name NOT IN (1078, 1079) AND time BETWEEN '$date 06:00:00' 
                                    AND '$date 23:59:59' ORDER BY time DESC";
            }
            else{
                $electrode_change = "SELECT * FROM $get_line_electrode WHERE id_name NOT IN (1177, 1178) AND time BETWEEN '$date 06:00:00' 
                                    AND '$date 23:59:59' ORDER BY time DESC";
            }
            $result_electrode = mysqli_query( $connect, $electrode_change );
            if ($result_electrode && $result_electrode->num_rows > 0) {
                $i = 0;
                while($row = $result_electrode-> fetch_assoc()){
                    $data_electrode_change[$i][0] = $row['time'];
                    $data_electrode_change[$i][1] = $row['period'];
                    $i++;
                }
            }
            else{
                $data_electrode_change = [];
            }

            //data wire
            if($select_line == 'jatco' || $select_line == 'aw2'){
                $wire_change = "SELECT * FROM $get_line_wire WHERE id_name IN (1078, 1079) AND time BETWEEN '$from_date 06:00:00' 
                                AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            else{
                $wire_change = "SELECT * FROM $get_line_wire WHERE id_name IN (1177, 1178) AND time BETWEEN '$from_date 06:00:00' 
                                AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            $result_wire = mysqli_query( $connect, $wire_change );
            if ($result_wire && $result_wire->num_rows > 0) {
                $i = 0;
                while($row = $result_wire-> fetch_assoc()){
                    $data_wire_change[$i][0] = $row['time'];
                    $data_wire_change[$i][1] = $row['name'];
                    $data_wire_change[$i][2] = $row['period'];
                    $i++;
                }
            }
            else{
                $data_wire_change= [];
            }

        }
        else{
            //data code change
            $code_change = "SELECT * FROM $get_line_code WHERE time BETWEEN '$from_date 06:00:00' 
                                AND '$to_date 23:59:59' ORDER BY time DESC";
            $result_code = mysqli_query( $connect, $code_change );
            if ($result_code && $result_code->num_rows > 0) {
                $i = 0;
                while($row = $result_code-> fetch_assoc()){
                    $data_code_change[$i][0] = $row['time'];
                    $data_code_change[$i][1] = $row['code'];
                    $data_code_change[$i][2] = $row['period'];                 
                    $i++;
                }
            }
            else{
                $data_code_change = [];
            }
             //data electrode
            if($select_line == 'jatco' || $select_line == 'aw2'){
                $electrode_change = "SELECT * FROM $get_line_electrode WHERE id_name NOT IN (1078, 1079) AND time BETWEEN '$from_date 06:00:00' 
                                    AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            else{
                $electrode_change = "SELECT * FROM $get_line_electrode WHERE id_name NOT IN (1177, 1178) AND time BETWEEN '$from_date 06:00:00' 
                                    AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            $result_electrode = mysqli_query( $connect, $electrode_change );
            if ($result_electrode && $result_electrode->num_rows > 0) {
                $i = 0;
                while($row = $result_electrode-> fetch_assoc()){
                    $data_electrode_change[$i][0] = $row['time'];
                    $data_electrode_change[$i][1] = $row['period']; 
                    $i++;
                }
            }
            else{
                $data_electrode_change = [];
            }

            //data wire
            if($select_line == 'jatco' || $select_line == 'aw2'){
                $wire_change = "SELECT * FROM $get_line_wire WHERE id_name IN (1078, 1079) AND time BETWEEN '$from_date 06:00:00' 
                                AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            else{
                $wire_change = "SELECT * FROM $get_line_wire WHERE id_name IN (1177, 1178) AND time BETWEEN '$from_date 06:00:00' 
                                AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            $result_wire = mysqli_query( $connect, $wire_change );
            if ($result_wire && $result_wire->num_rows > 0) {
                $i = 0;
                while($row = $result_wire-> fetch_assoc()){
                    $data_wire_change[$i][0] = $row['time'];
                    $data_wire_change[$i][1] = $row['name'];
                    $data_wire_change[$i][2] = $row['period']; 
                    $i++;
                }
            }
            else{
                $data_wire_change = [];
            }
        }
    }
    
    //TH2
    elseif($date_now < "$date 06:00:00" && $date_now >= "$date 00:00:00"){
        if($from_date == $to_date){
            //data code change
            $code_change = "SELECT * FROM $get_line_code WHERE time BETWEEN '$yesterday 06:00:00' 
                                AND '$date 05:59:59' ORDER BY time DESC";
            $result_code = mysqli_query( $connect, $code_change );
            if ($result_code && $result_code->num_rows > 0) {
                $i = 0;
                while($row = $result_code-> fetch_assoc()){
                    $data_code_change[$i][0] = $row['time'];
                    $data_code_change[$i][1] = $row['code'];
                    $data_code_change[$i][2] = $row['period'];            
                    $i++;
                }
            }
            else{
                $data_code_change = [];
            }

            //data electrode
            if($select_line == 'jatco' || $select_line == 'aw2'){
                $electrode_change = "SELECT * FROM $get_line_electrode WHERE id_name NOT IN (1078, 1079) AND time BETWEEN '$from_date 06:00:00' 
                                    AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            else{
                $electrode_change = "SELECT * FROM $get_line_electrode WHERE id_name NOT IN (1177, 1178) AND time BETWEEN '$from_date 06:00:00' 
                                    AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            $result_electrode = mysqli_query( $connect, $electrode_change );
            if ($result_electrode && $result_electrode->num_rows > 0) {
                $i = 0;
                while($row = $result_electrode-> fetch_assoc()){
                    $data_electrode_change[$i][0] = $row['time'];
                    $data_electrode_change[$i][1] = $row['period']; 
                    $i++;
                }
            }
            else{
                $data_electrode_change = [];
            }

            //data wire
            if($select_line == 'jatco' || $select_line == 'aw2'){
                $wire_change = "SELECT * FROM $get_line_wire WHERE id_name IN (1078, 1079) AND time BETWEEN '$from_date 06:00:00' 
                                AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            else{
                $wire_change = "SELECT * FROM $get_line_wire WHERE id_name IN (1177, 1178) AND time BETWEEN '$from_date 06:00:00' 
                                AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            $result_wire = mysqli_query( $connect, $wire_change );
            if ($result_wire && $result_wire->num_rows > 0) {
                $i = 0;
                while($row = $result_wire-> fetch_assoc()){
                    $data_wire_change[$i][0] = $row['time'];
                    $data_wire_change[$i][1] = $row['name'];
                    $data_wire_change[$i][2] = $row['period']; 
                    $i++;
                }
            }
            else{
                $data_wire_change = [];
            }

        }else{
            //data code change
            $code_change = "SELECT * FROM $get_line_code WHERE time BETWEEN '$from_date 06:00:00' 
                                AND '$to_date 05:59:59' ORDER BY time DESC";
            $result_code = mysqli_query( $connect, $code_change );
            if ($result_code && $result_code->num_rows > 0) {
                $i = 0;
                while($row = $result_code-> fetch_assoc()){
                    $data_code_change[$i][0] = $row['time'];
                    $data_code_change[$i][1] = $row['code'];
                    $data_code_change[$i][2] = $row['period'];
                    $i++;
                }
            }
            else{
                $data_code_change = [];
            }

            //data electrode
            if($select_line == 'jatco' || $select_line == 'aw2'){
                $electrode_change = "SELECT * FROM $get_line_electrode WHERE id_name NOT IN (1078, 1079) AND time BETWEEN '$from_date 06:00:00' 
                                    AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            else{
                $electrode_change = "SELECT * FROM $get_line_electrode WHERE id_name NOT IN (1177, 1178) AND time BETWEEN '$from_date 06:00:00' 
                                    AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            $result_electrode = mysqli_query( $connect, $electrode_change );
            if ($result_electrode && $result_electrode->num_rows > 0) {
                $i = 0;
                while($row = $result_electrode-> fetch_assoc()){
                    $data_electrode_change[$i][0] = $row['time'];
                    $data_electrode_change[$i][1] = $row['period'];
                    $i++;
                }
            }
            else{
                $data_electrode_change = [];
            }

            //data wire
            if($select_line == 'jatco' || $select_line == 'aw2'){
                $wire_change = "SELECT * FROM $get_line_wire WHERE id_name IN (1078, 1079) AND time BETWEEN '$from_date 06:00:00' 
                                AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            else{
                $wire_change = "SELECT * FROM $get_line_wire WHERE id_name IN (1177, 1178) AND time BETWEEN '$from_date 06:00:00' 
                                AND '$to_date 23:59:59' ORDER BY time DESC";
            }
            $result_wire = mysqli_query( $connect, $wire_change );
            if ($result_wire && $result_wire->num_rows > 0) {
                $i = 0;
                while($row = $result_wire-> fetch_assoc()){
                    $data_wire_change[$i][0] = $row['time'];
                    $data_wire_change[$i][1] = $row['name'];
                    $data_wire_change[$i][2] = $row['period'];
                    $i++;
                }
            }
            else{
                $data_wire_change = [];
            }
        }
    }
?>
    <div class="row">
        <div class="col-sm-6">
            <h5 style="text-align:center; margin-bottom: 10px;">Thay Mã</h5>
            <table id="table_code" class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th>Thời gian thay</th>
                        <th>Mã</th>
                        <th>Số phút</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i = 0; $i < count($data_code_change); $i++){
                            echo "<tr>";
                            echo "<td>".$data_code_change[$i][0]."</td>";
                            echo "<td>".$data_code_change[$i][1]."</td>";
                            echo "<td>".round((int)$data_code_change[$i][2] / 60, 2)."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
            <h5 style="text-align:center; margin-bottom: 10px;">Thay Điện Cực</h5>
            <table id="table_electrode" class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th>Thời gian thay</th>
                        <th>Số phút</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i = 0; $i < count($data_electrode_change); $i++){
                            echo "<tr>";
                            echo "<td>".$data_electrode_change[$i][0]."</td>";
                            echo "<td>".round((int)$data_electrode_change[$i][1] / 60, 2)."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12" >
            <h5 style="text-align:center; margin-top: 30px;">Thay Dây Đồng</h5>
            <table id="table_wire" class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th style="width:30%;">Thời gian thay</th>
                        <th style="width:40%;">Mã</th>
                        <th style="width:30%;">Số phút</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i = 0; $i < count($data_wire_change); $i++){
                            echo "<tr>";
                            echo "<td>".$data_wire_change[$i][0]."</td>";
                            echo "<td>".$data_wire_change[$i][1]."</td>";
                            echo "<td>".round((int)$data_wire_change[$i][2] / 60, 2)."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<script src="
    <?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/six_losses/views/default/js/datatables_func.js" ?>">
</script>
<script type="text/javascript">
    createDataTable('table_code', 10, false);
    createDataTable('table_electrode', 10, false);
    createDataTable('table_wire', 10, false);
</script>