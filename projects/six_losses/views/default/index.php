<?php
    require_once 'config/config.php';
    $connect = $GLOBALS['connect'];
?>

<div class="container-fluid">
<!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <h2>HDVN TRANG CHỦ</h2>
        <div class="row align-items-center">    
            <div class="col-sm-6" style="margin-bottom: 30px;">
                <div id="event_anime" class="card bg-dark text-center" style="height: 100%;">
                    <a href="maintenance/index_bt">
                        <div id="event_bt" class="card-body" style="color:white;">
                            <?php  
                                $interval_change = "SELECT event_animation FROM aw3_interval WHERE id NOT IN (69, 70, 81, 82)";
                                $resultcheck_event = mysqli_query( $connect, $interval_change );
                                if ($resultcheck_event && $resultcheck_event->num_rows > 0) {
                                    while ($row = $resultcheck_event->fetch_assoc()) {
                                        $data_interval_aw3=$row['event_animation'];
                                    }
                                }
                                $interval_change_aw2 = "SELECT event_animation FROM aw2_interval";
                                $resultcheck_event_aw2 = mysqli_query( $connect, $interval_change_aw2 );
                                if ($resultcheck_event_aw2 && $resultcheck_event_aw2->num_rows > 0) {
                                    while ($row = $resultcheck_event_aw2->fetch_assoc()) {
                                        $data_interval_aw2=$row['event_animation'];
                                    }
                                }
                                $interval_change_jatco = "SELECT event_animation FROM jatco_interval";
                                $resultcheck_event_jatco = mysqli_query( $connect, $interval_change_jatco );
                                if ($resultcheck_event_jatco && $resultcheck_event_jatco->num_rows > 0) {
                                    while ($row = $resultcheck_event_jatco->fetch_assoc()) {
                                        $data_interval_jatco=$row['event_animation'];
                                    }
                                }

                                if($data_interval_aw3 == 1 || $data_interval_aw2 == 1 || $data_interval_jatco == 1){
                                    echo '<script type="text/javascript">
                                                        setInterval(function() {
                                                            flashtext("event_bt","yellow");
                                                        }, 500 );
                                            </script>';
                                }
                            ?>
                            <div class="avatar-md mx-auto mb-3">
                                <span>
                                    <i class="fas fa-cog" style="font-size: 60px;"></i>
                                </span>
                            </div>
                            <h4>BẢO TRÌ</h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-6" style="margin-bottom: 30px;">
                <div class="card bg-dark text-center">
                    <a href="production/index_sx">
                        <div class="card-body" style="color:white;">
                            <div class="avatar-md mx-auto mb-3">
                                <span>
                                    <i class="fas fa-chart-line" style="font-size: 60px;"></i>
                                </span>
                            </div>
                            <h4>SẢN XUẤT</h4>
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
        // setInterval(function(){
        //     $("#event_bt").load(" #event_bt > *");
        // }, 3000);
        
        function flashtext(ele,col) {
            var tmpColCheck = document.getElementById( ele ).style.color;

            if (tmpColCheck === 'white') {
              document.getElementById( ele ).style.color = col;
            } else {
              document.getElementById( ele ).style.color = 'white';
            }
        }
</script>