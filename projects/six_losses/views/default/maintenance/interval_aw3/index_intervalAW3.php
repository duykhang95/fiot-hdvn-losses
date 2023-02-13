<?php
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];

    $interval_change = "SELECT * FROM `aw3_interval` WHERE `event_animation` = 1 AND `id` NOT IN (69, 70, 81, 82)";
    $resultcheck_event = mysqli_query( $connect, $interval_change );
    if ($resultcheck_event && $resultcheck_event->num_rows > 0) {
        $i = 0;
        while ($row = $resultcheck_event->fetch_assoc()) {
            $data_interval[$i][0]=$row['content'];
            $data_interval[$i][1]=$row['event_animation'];
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
            <div class="col-md-8" style="margin: 20px 0px;">
                <div class="title mb-30">
                    <h3>THAY THẾ ĐỊNH KÌ AISIN 2 / AISIN 2 インタバル交換</h3>
                </div>
            </div>
            <div class="col-md-4" style="margin: 20px 0px;">
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
                            <h4> Cấp Bobin <br> ボビン供給</h4>
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
                            <h4>Quấn đồng <br> 巻線機</h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card bg-dark text-center">
                    <a href="gripper">
                        <div id="event_gripper" class="card-body" style="color:white;">
                            <div class="avatar-md mx-auto mb-3">
                                <span>
                                    <i class="fa fa-circle" style="font-size: 60px;"></i>
                                </span>
                            </div>
                            <h4>Gripper <br> グリッパー</h4>
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
                            <h4>Hàn <br> 溶接機</h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card bg-dark text-center">
                    <a href="terminal_bend">
                        <div id="event_terminal" class="card-body" style="color:white;">
                            <div class="avatar-md mx-auto mb-3">
                                <span>
                                    <i class="fa fa-circle" style="font-size: 60px;"></i>
                                </span>
                            </div>
                            <h4>Uốn Terminal <br> ターミナル曲げ</h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card bg-dark text-center">
                    <a href="core_press_fit">
                        <div id="event_core" class="card-body" style="color:white;">
                            <div class="avatar-md mx-auto mb-3">
                                <span>
                                    <i class="fa fa-circle" style="font-size: 60px;"></i>
                                </span>
                            </div>
                            <h4>Ép Core <br> コア―圧入</h4>
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
                            <h4>Đúc <br> 成形工程</h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card bg-dark text-center">
                    <a href="inspection">
                        <div id="event_inspection" class="card-body" style="color:white;">
                            <div class="avatar-md mx-auto mb-3">
                                <span>
                                    <i class="fa fa-circle" style="font-size: 60px;"></i>
                                </span>
                            </div>
                            <h4>Kiểm tra sau uốn <br> 検査</h4>
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
        if($data_interval[$i][0] == 'Bobin'){
            echo '<script type="text/javascript">
                        setInterval(function() {
                            flashtext("event_bobin","yellow");
                        }, 500 );
                  </script>';
        }
        
        else if($data_interval[$i][0] == 'Winding'){
            echo '<script type="text/javascript">
                        setInterval(function() {
                            flashtext("event_winding","yellow");
                        }, 500 );
                  </script>';
        }
        
        else if($data_interval[$i][0] == 'Gripper'){
            echo '<script type="text/javascript">
                        setInterval(function() {
                            flashtext("event_gripper","yellow");
                        }, 500 );
                  </script>';
        }
        
        else if($data_interval[$i][0] == 'Welding'){
            echo '<script type="text/javascript">
                        setInterval(function() {
                            flashtext("event_welding","yellow");
                        }, 500 );
                  </script>';
        }
        
        else if($data_interval[$i][0] == 'Terminal Bend'){
            echo '<script type="text/javascript">
                        setInterval(function() {
                            flashtext("event_terminal","yellow");
                        }, 500 );
                  </script>';
        }
        
        else if($data_interval[$i][0] == 'Core Press Fit'){
            echo '<script type="text/javascript">
                        setInterval(function() {
                            flashtext("event_core","yellow");
                        }, 500 );
                  </script>';
        }
        
        else if($data_interval[$i][0] == 'Molding'){
            echo '<script type="text/javascript">
                        setInterval(function() {
                            flashtext("event_molding","yellow");
                        }, 500 );
                  </script>';
        }
        
        else if($data_interval[$i][0] == 'Inspection'){
            echo '<script type="text/javascript">
                        setInterval(function() {
                            flashtext("event_inspection","yellow");
                        }, 500 );
                  </script>';
        }
    }
?>