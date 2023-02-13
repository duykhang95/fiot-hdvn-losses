<?php
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];

    $interval_change_aw3 = "SELECT * FROM aw3_interval WHERE id NOT IN (69, 70, 81, 82)";
    $resultcheck_aw3 = mysqli_query( $connect, $interval_change_aw3 );
    if ($resultcheck_aw3 && $resultcheck_aw3->num_rows > 0) {
        $i = 0;
        while ($row = $resultcheck_aw3->fetch_assoc()) {
            $data_interval_aw3[$i][0]=$row['id'];
            $data_interval_aw3[$i][1]=$row['event_animation'];
            $i++;
        }
    }
    else{
        $data_interval_aw3 = [];
    }

    $interval_change_aw2 = "SELECT * FROM aw2_interval";
    $resultcheck_aw2 = mysqli_query( $connect, $interval_change_aw2 );
    if ($resultcheck_aw2 && $resultcheck_aw2->num_rows > 0) {
        $i = 0;
        while ($row = $resultcheck_aw2->fetch_assoc()) {
            $data_interval_aw2[$i][0]=$row['id'];
            $data_interval_aw2[$i][1]=$row['event_animation'];
            $data_interval_aw2[$i][2]=$row['interval_stop'];
            $data_interval_aw2[$i][3]=$row['interval_current'];
            $i++;
        }
    }
    else{
        $data_interval_aw2 = [];
    }

    $interval_change_jatco = "SELECT * FROM jatco_interval";
    $resultcheck_jatco = mysqli_query( $connect, $interval_change_jatco );
    if ($resultcheck_jatco && $resultcheck_jatco->num_rows > 0) {
        $i = 0;
        while ($row = $resultcheck_jatco->fetch_assoc()) {
            $data_interval_jatco[$i][0]=$row['id'];
            $data_interval_jatco[$i][1]=$row['event_animation'];
            $i++;
        }
    }
    else{
        $data_interval_jatco = [];
    }

    // function selecetInterval($table_interval = 'aw3_interval', $connect){
    //     $interval_change = "SELECT * FROM $table_interval WHERE event_animation = 1";
    //     $resultcheck_event = mysqli_query( $connect, $interval_change );
    //     if ($resultcheck_event && $resultcheck_event->num_rows > 0) {
    //         $i = 0;
    //         while ($row = $resultcheck_event->fetch_assoc()) {
    //             $data_interval[$i][0]=$row['id'];
    //             $data_interval[$i][1]=$row['event_animation'];
    //             $i++;
    //         }
    //     }
    //     else{
    //         $data_interval = [];
    //     }
    //     return $data_interval;
    // }

    
    // print_r(selecetInterval($table_interval = 'aw3_interval', $connect));
    
    // for ($i = 0; $i < count($arr_interval); $i++){
    //     $interval_change = "SELECT * FROM " . $arr_interval[$i] . "_interval" . " WHERE event_animation = 1";
    //     $resultcheck_event = mysqli_query( $connect, $interval_change );
    //     if ($resultcheck_event && $resultcheck_event->num_rows > 0) {
    //         $i = 0;
    //         while ($row = $resultcheck_event->fetch_assoc()) {
    //             $data_interval[$i][0]=$row['event_animation'];
                
    //             if($data_interval[$i][0] == 1){
    //                 echo '<script type="text/javascript">
    //                             setInterval(function() {
    //                                 flashtext("event_interval","yellow");
    //                             }, 500 );
    //                     </script>';
    //             }
    //             $i++;
    //         }
    //     }
    //     else{
    //         $data_interval = [];
    //     }
    // }
    // print_r($data_interval);
?>  
    
    <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6" style="margin: 20px 0px;">
                    <div class="title mb-30">
                        <h3> BẢO TRÌ </h3>
                    </div>
                </div>
                <div class="col-md-6" style="margin: 20px 0px;">
                    <div class="title mb-30" style="text-align:right;">
                        <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) ?>">Trang chủ</a>
                    </div>
                </div>
                
                <div class="col-sm-3" style="margin-bottom: 30px;">
                    <div id="event_anime" class="card bg-dark text-center" style="height: 100%;">
                        <a href="interval_aw3/index_intervalAW3">
                            <div id="event_aw3" class="card-body" style="color:white;">
                                <div class="avatar-md mx-auto mb-3">
                                    <span>
                                        <i class="fas fa-cog" style="font-size: 60px;"></i>
                                    </span>
                                </div>
                                <h4>AISIN 2</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3" style="margin-bottom: 30px;">
                    <div class="card bg-dark text-center">
                        <a href="interval_jatco/index_intervalJATCO">
                            <div id="event_jatco" class="card-body" style="color:white;">
                                <div class="avatar-md mx-auto mb-3">
                                    <span>
                                        <i class="fas fa-cog" style="font-size: 60px;"></i>
                                    </span>
                                </div>
                                <h4>JATCO</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3" style="margin-bottom: 30px;">
                    <div class="card bg-dark text-center">
                        <a href="interval_aw2/index_intervalAW2">
                            <div id="event_aw2" class="card-body" style="color:white;">
                                <div class="avatar-md mx-auto mb-3">
                                    <span>
                                        <i class="fas fa-cog" style="font-size: 60px;"></i>
                                    </span>
                                </div>
                                <h4>AISIN 1</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3" style="margin-bottom: 30px;">
                    <div class="card bg-dark text-center">
                        <a href="history_interval/index_history">
                            <div class="card-body" style="color:white;">
                                <div class="avatar-md mx-auto mb-3">
                                    <span>
                                        <i class="fas fa-history" style="font-size: 60px;"></i>
                                    </span>
                                </div>
                                <h4>LỊCH SỬ THAY THẾ</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <!-- end col -->
        </div>
    <!-- end row -->
    </div>

<script type="text/javascript">
    function flashtext(ele,col) {
        var tmpColCheck = document.getElementById(ele).style.color;

        if (tmpColCheck === 'white') {
            document.getElementById(ele).style.color = col;
        } else {
            document.getElementById(ele).style.color = 'white';
        }
    }

</script>

<?php
    for($i = 0; $i < count($data_interval_aw3); $i++){
        if($data_interval_aw3[$i][1] == 1){
            echo '<script type="text/javascript">
                    setInterval(function() {
                        $("#event_aw3").fadeIn(500).fadeOut(500);
                        $("#event_aw3").css("color", "yellow");
                    }, 500 );
                </script>';
        }
    }

    for($i = 0; $i < count($data_interval_aw2); $i++){
        if($data_interval_aw2[$i][1] == 1 && $data_interval_aw2[$i][3] >= $data_interval_aw2[$i][2]){
            echo '<script type="text/javascript">
                    setInterval(function() {
                        $("#event_aw2").fadeOut(500).fadeIn(500);
                        $("#event_aw2").css("color", "yellow");
                    }, 500 );
                </script>';
        }
    }

    for($i = 0; $i < count($data_interval_jatco); $i++){
        if($data_interval_jatco[$i][1] == 1){
            echo '<script type="text/javascript">
                    setInterval(function() {
                        $("#event_jatco").fadeOut(500).fadeIn(500);
                        $("#event_jatco").css("color", "yellow");
                    }, 500 );
                </script>';
        }
    }
    // $table_interval = ['aw3_interval', 'aw2_interval', 'jatco_interval'];
    // for($i = 0; $i < count($table_interval); $i++){
    //     $get_interval = selecetInterval($table_interval[$i], $connect);
    //     for ($x = 0; $x < count($get_interval); $x++){
    //         if($table_interval[0] && $get_interval[$x][1] == 1){
    //             echo '<script type="text/javascript">
    //                             setInterval(function() {
    //                                 flashtext("event_aw3","yellow");
    //                             }, 500 );
    //                     </script>';
    //         }
    //         else if($table_interval[1] && $get_interval[$x][1] == 1){
    //             echo '<script type="text/javascript">
    //                             setInterval(function() {
    //                                 flashtext("event_aw2","yellow");
    //                             }, 500 );
    //                     </script>';
    //         }
    //         else if($table_interval[2] && $get_interval[$x][1] == 1){
    //             echo '<script type="text/javascript">
    //                             setInterval(function() {
    //                                 flashtext("event_jatco","yellow");
    //                             }, 500 );
    //                     </script>';
    //         }
    //     }
    // }
?>