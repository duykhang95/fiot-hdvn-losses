<?php
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];

    $interval_change = "SELECT * FROM `aw3_interval` WHERE `content` = 'Bobin'";
    $resultcheck_op = mysqli_query( $connect, $interval_change );
    if ($resultcheck_op && $resultcheck_op->num_rows > 0) {
        $i = 0;
        while ($row = $resultcheck_op->fetch_assoc()) {
            //thêm kết quả vào mảng
            if(isset($_GET['jp'])){
                $data_interval[$i][0]=$row['sub_content_jp'];
            }
            else if(isset($_GET['en'])) {
                $data_interval[$i][0]=$row['sub_content_en'];
            }
            else{
                $data_interval[$i][0]=$row['sub_content'];
            }
            $data_interval[$i][1]=$row['interval_alarm'];
            $data_interval[$i][2]=$row['interval_stop'];
            $data_interval[$i][3]=$row['interval_current'];
            $data_interval[$i][4]=$row['event_animation'];

            $int_alarm = $data_interval[$i][1];
            $int_stop = $data_interval[$i][2];
            $int_current = $data_interval[$i][3];
            
            if((float)$data_interval[$i][1] <= (float)$data_interval[$i][3] && (float)$data_interval[$i][3] < (float)$data_interval[$i][2] ) {
                $sql_update_event = "UPDATE `aw3_interval` SET `event_animation` = 1 WHERE `interval_alarm`= '$int_alarm' AND `interval_current` = '$int_current';";
                mysqli_query($connect, $sql_update_event);
                $data_interval[$i][1] = '<span id=one>'. number_format($data_interval[$i][1]) .'</span>';
                $data_interval[$i][2] = number_format($data_interval[$i][2]);
                $data_interval[$i][3] = number_format($data_interval[$i][3]);
                // echo '<script>blinkingText();</script>';               
            }    
            else if((float)$data_interval[$i][3] >= (float)$data_interval[$i][2]){
                $sql_update_event = "UPDATE `aw3_interval` SET `event_animation` = 1 WHERE `interval_stop`= '$int_stop' AND `interval_current` = '$int_current';";
                mysqli_query($connect, $sql_update_event);
                $data_interval[$i][2] = '<span id=one>'. number_format($data_interval[$i][2]) .'</span>';
                $data_interval[$i][1] = number_format($data_interval[$i][1]);
                $data_interval[$i][3] = number_format($data_interval[$i][3]);
            }          
            else if((float)$data_interval[$i][3] != (float)$data_interval[$i][1] && (float)$data_interval[$i][3] != (float)$data_interval[$i][2]){
                $sql_update_event = "UPDATE `aw3_interval` SET `event_animation` = 0 WHERE `interval_current` = '$int_current';";
                mysqli_query($connect, $sql_update_event);
                $data_interval[$i][1] = number_format($data_interval[$i][1]);
                $data_interval[$i][2] = number_format($data_interval[$i][2]);
                $data_interval[$i][3] = number_format($data_interval[$i][3]);
            }
            else {
                $data_interval[$i][1] = number_format($data_interval[$i][1]);
                $data_interval[$i][2] = number_format($data_interval[$i][2]);
                $data_interval[$i][3] = number_format($data_interval[$i][3]);
            }
            $i++;
        }
    }
    else{
        $data_interval = [];
    }
?>
    <style type="text/css">
        #ok{
            text-align: right;
            min-width: 10px;
            font-weight: bold;   
            /*vertical-align: right;  */
        }
        #ok:first-child, #ok:last-child {
          width: 100%;
        }
        #ok1{
            text-align: right;
        } 

    </style>
  
      
<div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6" style="margin: 20px 0px;">
                <div class="title mb-30">
                    <h3> CẤP BOBIN / ボビン供給 </h3>
                </div>
            </div>
            <div class="col-md-6" style="margin: 20px 0px;">
                <div class="title mb-30" style="text-align:right;">
                    <a href="index_intervalAW3">Thay thế định kì AISIN 2</a>
                </div>
            </div>
        <!-- end col -->
            <div class="col-md-12">
                <div class="card">    
                    <div class="card-body" >
                        <form method="get">
                            <div class="row">
                                <div class="form-group col-lg-1 px-1">
                                    <button style="padding: 0; margin: 0;" type="submit" id="vn" name="vn"><img src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/img/vn.png" ?>" height ="30" width="60"/></button>
                                </div>
                                <div class="form-group col-lg-1 px-1">
                                    <button style="padding: 0; margin: 0;" type="submit" id="jp" name="jp"><img src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/img/jp.png" ?>" height ="30" width="60"/></button>
                                </div>
                                <div class="form-group col-lg-1 px-1">
                                    <button style="padding: 0; margin: 0;" type="submit" id="en" name="en"><img src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/img/en.png" ?>" height ="30" width="60" /></button>
                                </div>
                                
                            </div>
                        </form>
                        <table id="data_bobin" class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width:40%;">Content</th>
                                    <th id="ok1" style="width:20%;">Interval Alarm <br> 警報設定値</th>
                                    <th id="ok1" style="width:20%;">Interval Stop <br> 停止設定値</th>
                                    <th id="ok1" style="width:20%;">Interval Current <br> 現在値</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    for($i = 0; $i < count($data_interval); $i++){
                                        echo '<tr>';
                                        echo '<td>' . $data_interval[$i][0] . '</td>
                                        <td id="ok">'. $data_interval[$i][1] . '</td>
                                        <td id="ok">'. $data_interval[$i][2] . '</td>
                                        <td id="ok">'. $data_interval[$i][3] . '</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
      
<script type="text/javascript">
    $(document).ready(function(){    
        setInterval(function(){
              $("#data_bobin").load(" #data_bobin > *");
              // $("#data_bobin").load("bobin.php #data_bobin");
        }, 1000);
    });
    
    // setTimeout(function () {
    //     document.location = 'bobin.php';
    // }, 3000);
</script>
  
