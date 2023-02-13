<?php
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];

    $interval_change = "SELECT * FROM aw2_interval WHERE event_animation = 1";
    $resultcheck_event = mysqli_query( $connect, $interval_change );
    if ($resultcheck_event && $resultcheck_event->num_rows > 0) {
        $i = 0;
        while ($row = $resultcheck_event->fetch_assoc()) {
            $data_interval[$i][0]=$row['id'];
            $data_interval[$i][1]=$row['op'];
            $data_interval[$i][2]=$row['content'];
            $data_interval[$i][3]=$row['sub_content'];
            $data_interval[$i][4]=$row['sub_content_jp'];
            $data_interval[$i][5]=$row['interval_alarm'];
            $data_interval[$i][6]=$row['interval_stop'];
            $data_interval[$i][7]=$row['interval_current'];
            $data_interval[$i][8]=$row['event_animation'];
            //echo '<script>alert("Hello World!");</script>';
            $i++;
        }
    }
    else{
        $data_interval = [];
    }

?>

    <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6" style="margin: 20px 0px;">
                    <div class="title mb-30">
                        <h3>Thay thế định kì AISIN 1 / AISIN 1 インタバル交換</h3>
                    </div>
                </div>
                <div class="col-md-6" style="margin: 20px 0px;">
                    <div class="title mb-30" style="text-align:right;">
                        <a href="../index_bt">Trang chủ Bảo trì</a>
                    </div>
                </div>
                <!-- end col -->
                    
                <div class="col-md-3 col-6">
                    <div class="card bg-dark text-center" style="height: 100%;">
                        <a href="bobin">
                            <div id="event_bobin" class="card-body" style="color:white;">
                                <div class="avatar-md mx-auto mb-3">
                                    <span>
                                        <i class="fa fa-circle" style="font-size: 60px;"></i>
                                    </span>
                                </div>
                                <h4>Cấp Bobin <br> ボビン供給</h4>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-3 col-6">
                    <div class="card bg-dark text-center">
                        <a href="winding">
                            <div id="event_winding" class="card-body" style="color:white;">
                                <div class="avatar-md mx-auto mb-3">
                                    <span>
                                        <i class="fa fa-circle" style="font-size: 60px;"></i>
                                    </span>
                                </div>
                                <h4>Quấn Đồng <br> 巻線機</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card bg-dark text-center">
                        <a href="welding">
                            <div id="event_welding" class="card-body" style="color:white;">
                                <div class="avatar-md mx-auto mb-3">
                                    <span>
                                        <i class="fa fa-circle" style="font-size: 60px;"></i>
                                    </span>
                                </div>
                                <h4>Hàn <br> グリッパー</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card bg-dark text-center">
                        <a href="terminal_bend">
                            <div id="event_terminal_bend" class="card-body" style="color:white;">
                                <div class="avatar-md mx-auto mb-3">
                                    <span>
                                        <i class="fa fa-circle" style="font-size: 60px;"></i>
                                    </span>
                                </div>
                                <h4>Uốn Terminal <br> 溶接機</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card bg-dark text-center">
                        <a href="molding">
                            <div id="event_molding" class="card-body" style="color:white;">
                                <div class="avatar-md mx-auto mb-3">
                                    <span>
                                        <i class="fa fa-circle" style="font-size: 60px;"></i>
                                    </span>
                                </div>
                                <h4>Đúc và kiểm tra <br> 成形工程 & 検査</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- end col -->
            </div>
        <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->
        
        <!-- End Row -->
    </div>
<script type="text/javascript">
    function flashtext(ele,col) {
        var tmpColCheck = document.getElementById( ele ).style.color;
        if (tmpColCheck === 'white') {
            document.getElementById( ele ).style.color = col;
        } else {
            document.getElementById( ele ).style.color = 'white';
        }
    }
</script>

<?php
    for($i = 0; $i < count($data_interval); $i++){
        if($data_interval[$i][1] == 2){
            echo '<script type="text/javascript">
                    setInterval(function() {
                        flashtext("event_winding","yellow");
                    }, 500 );
                </script>';
        }
        else if($data_interval[$i][1] == 1 && $data_interval[$i][7] >= (float)$data_interval[$i][6]){
            echo '<script type="text/javascript">
                    setInterval(function() {
                        flashtext("event_bobin","yellow");
                    }, 500 );
                </script>';
        }
        else if($data_interval[$i][1] == 3 && $data_interval[$i][7] >= (float)$data_interval[$i][6]){
            echo '<script type="text/javascript">
                    setInterval(function() {
                        flashtext("event_welding","yellow");
                    }, 500 );
                </script>';
        }
        else if($data_interval[$i][1] == 4 && $data_interval[$i][7] >= (float)$data_interval[$i][6]){
            echo '<script type="text/javascript">
                    setInterval(function() {
                        flashtext("event_terminal_bend","yellow");
                    }, 500 );
                </script>';
        }
        else if($data_interval[$i][1] == 5 && $data_interval[$i][7] >= (float)$data_interval[$i][6]){
            echo '<script type="text/javascript">
                    setInterval(function() {
                        flashtext("event_molding","yellow");
                    }, 500 );
                </script>';
        }
    }
?>