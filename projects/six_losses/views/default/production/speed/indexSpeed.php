<?php
    $date = date('Y-m-d');
    $date_time = date('H:i:s');
    // $newTime = strtotime('-30 minutes');
    $newTime = strtotime('-15 minutes');
    $sub_30min =  date('H:i:s', $newTime);
    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;
?>
    <style type="text/css">

        input[type=button]:hover{color:orange;}

        input[type=button]:focus{color:yellow;}

    </style>
    <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>TỐC ĐỘ</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="get">
                                <div class="row">
                                    <div class="form-group col-lg-2 px-1">
                                        <p><b>Chọn line</b></p>
                                        <select required class="form-control" onChange="filterData()" id="select_line" name="select_line" value="">
                                            <?php
                                               echo '<option value="aw3">AISIN 2</option>
                                                <option value="aw2">AISIN 1</option>
                                                <option value="jatco">JATCO</option>';
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 px-1">
                                        <p><b>Chọn công đoạn</b></p>
                                        <select required class="form-control" onChange="filterData()" id="chart_type" name="chart_type" value="">
                                            <option value="bobin">Bobin</option>
                                            <option value="terminal">Terminal (タミナル圧入)</option>
                                            <option value="winding">Quấn Đồng (巻線)</option>
                                            <option value="core_press">Ép Core (Core圧入)</option>
                                            <option value="fusing">Hàn</option>
                                            <option value="molding">Đúc (成形)</option>
                                            <option value="inspection">Kiểm Tra (特性検査)</option>
                                            <?php
                                                if($select_line == "aw3"){
                                                    echo '<option value="terminal">Terminal (タミナル圧入)</option>
                                                            <option value="winding">Quấn Đồng (巻線)</option>
                                                            <option value="core_press">Ép Core (Core圧入)</option>
                                                            <option value="molding">Đúc (成形)</option>
                                                            <option value="inspection">Kiểm Tra (特性検査)</option>';
                                                }
                                                else if($select_line == "aw2"){
                                                    echo '<option value="bobin">Cấp Bobin</option>
                                                            <option value="terminal">Ép Terminal (タミナル圧入)</option>
                                                            <option value="winding">Quấn Đồng (巻線)</option>
                                                            <option value="fusing">Hàn</option>
                                                            <option value="molding">Đúc (成形)</option>
                                                            <option value="inspection">Kiểm Tra (特性検査)</option>';
                                                }
                                                else if ($select_line == "jatco"){
                                                    echo '<option value="terminal">Ép Terminal (タミナル圧入)</option>
                                                        <option value="winding">Quấn Đồng (巻線)</option>
                                                        <option value="molding">Đúc (成形)</option>
                                                        <option value="inspection">Kiểm Tra (特性検査)</option>';
                                                } 
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2 px-1">
                                        <p><b>Chọn ngày / 日付選択</b></p>
                                        <input type="date" onChange="filterData()" id="select_date" name="select_date" value="<?php echo $date; ?>" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-2 px-1">
                                        <p><b>Thời gian bắt đầu</b></p>
                                        <!--<p><b>Start Time</b></p>-->
                                        <input id="start_time" onChange="filterData()" type="time" step="1" name="start_time" value="<?php echo $sub_30min; ?>" class="form-control" tabindex="5">
                                    </div>
                                    <div class="form-group col-lg-2 px-1">
                                        <p><b>Thời gian kết thúc</b></p>
                                        <input id="stop_time" onChange="filterData()" type="time" step="1" name="stop_time" value="<?php echo $date_time; ?>" class="form-control" tabindex="5">
                                    </div>
                                </div>
                                <!--<button type="submit" style="font-size: 20px; margin-top: 5px;" class="btn btn-primary" name="submit_date" id="submit_date">Submit</button>-->
                            </form>
                        </div>
                    <!--<button type="submit" style="font-size: 20px;" class="btn btn-primary" name="submit" id="submit">Submit</button>-->
                    </div>
                </div>
                <br>
                <div id="chart" class="col-sm-12">
                        <!-- <div id="chart"></div> -->
                        <?php
                            // if($select_line == "aw3"){
                            //     echo '<input type="button" id="0" class="btn btn-success" value="terminal" onclick="chart_click(terminal)"/>
                            //         <input type="button" id="1" class="btn btn-success" value="winding" onclick="chart_click(winding)"/>
                            //         <input type="button" id="2" class="btn btn-success" value="core_press" onclick="chart_click(core_press)"/>
                            //         <input type="button" id="3" class="btn btn-success" value="molding" onclick="chart_click(molding)"/>
                            //         <input type="button" id="4" class="btn btn-success" value="inspection" onclick="chart_click(inspection)"/>';
                            // } 
                            // else if ($select_line == "aw2"){
                            //     echo '<input type="button" id="5" class="btn btn-success" value="bobin" onclick="chart_click("bobin")"/>
                            //         <input type="button" id="6" class="btn btn-success" value="terminal" onclick="chart_click("terminal")"/>
                            //         <input type="button" id="7" class="btn btn-success" value="winding" onclick="chart_click("winding")"/>
                            //         <input type="button" id="8" class="btn btn-success" value="fusing" onclick="chart_click("fusing")"/>
                            //         <input type="button" id="9" class="btn btn-success" value="molding" onclick="chart_click("molding")"/>
                            //         <input type="button" id="10" class="btn btn-success" value="inspection" onclick="chart_click("inspection")"/>';
                            // }
                            // else if ($select_line == "jatco"){
                            //     echo '<input type="button" id="11" class="btn btn-success" value="terminal" onclick="chart_click("terminal")"/>
                            //         <input type="button" id="12" class="btn btn-success" value="winding" onclick="chart_click("winding")"/>
                            //         <input type="button" id="13" class="btn btn-success" value="molding" onclick="chart_click("molding")"/>
                            //         <input type="button" id="14" class="btn btn-success" value="inspection" onclick="chart_click("inspection")"/>';
                            // }
                        ?>
                </div>
              <!-- end col -->
            </div>
        </div>
          <!-- ========== title-wrapper end ========== -->
          <!-- End Row -->
    </div>

    <script type="text/javascript">
        const date = document.getElementById("select_date").value;
        const starttime = document.getElementById("start_time").value;
        const stoptime = document.getElementById("stop_time").value;
        const chart_type = document.getElementById("chart_type").value;
        const select_line = document.getElementById("select_line").value;
        // load begin
        $("#chart").load("speed_func/chart_speed?select_line=aw3"  + "&select_date=" + date + "&chart_type=" + chart_type + "&starttime=" + starttime + "&stoptime=" + stoptime);
        // check_button();
        // setInterval(function () {
        //     check_button();
        // },2000);
        function filterData(){
            const select_line = document.getElementById("select_line").value;
            const date = document.getElementById("select_date").value;
            const starttime = document.getElementById("start_time").value;
            const stoptime = document.getElementById("stop_time").value;
            const chart_type = document.getElementById("chart_type").value;
            $("#chart").load("speed_func/chart_speed?select_line=" + select_line + "&select_date=" + date + "&chart_type=" + chart_type + "&starttime=" + starttime + "&stoptime=" + stoptime);
        }
        // function chart_click(chart_type){
        //     const date = document.getElementById("select_date").value;
        //     const starttime = document.getElementById("start_time").value;
        //     const stoptime = document.getElementById("stop_time").value;
        //     const select_line = document.getElementById("select_line").value;
        //     // console.log("HERE");
        //     // document.getElementById("1").style.cssText = "background-color: yellow";
        //     // var chart = document.getElementById('chart');
        //     // chart.removeChild(chart.firstChild);
            
        //     $("#chart").load("speed_func/chart_speed?select_line=" + select_line + "&select_date=" + date + "&chart_type=" + chart_type + "&starttime=" + starttime + "&stoptime=" + stoptime);
        // };
        // function check_button(){
        //     var date = document.getElementById("select_date").value;
        //     var starttime = document.getElementById("start_time").value;
        //     var stoptime = document.getElementById("stop_time").value;
        //     var select_line = document.getElementById("select_line").value;

        //     var xmlhttp = new XMLHttpRequest();
        //     xmlhttp.onreadystatechange = function() {
        //         if (this.readyState == 4 && this.status == 200) {
        //         var myArr = JSON.parse(this.responseText);
        //             for(let i = 0; i < 23; i++){
        //                 if(myArr[i] == 'false'){
        //                     document.getElementById(i).style.cssText = "background-color: red";
        //                 }
        //                 else{
        //                     document.getElementById(i).style.cssText = "background-color: #198754";
        //                 }
        //             }
        //             // if(myArr[0] == 'false'){
        //             //     document.getElementById("1").style.cssText = "background-color: red";
        //             // }
        //             // else{
        //             //     document.getElementById("1").style.cssText = "background-color: #198754";
        //             // }
        //         }
        //     };
        //     // xmlhttp.open("GET", url, true);
        //     xmlhttp.open("GET", "http://localhost/hamaden/HDVN/ttime_event.php?select_date=" + date + "&starttime="+ starttime +"&stoptime="+ stoptime, true);
        //     xmlhttp.send();
        // };
    </script>