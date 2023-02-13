<!-- <pre> -->
<?php  
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];
    
    $start_time = isset($_GET['starttime']) ? $_GET['starttime'] : NULL; // 
    $stop_time = isset($_GET['stoptime']) ? $_GET['stoptime'] : NULL; //
    $select_date = isset($_GET['select_date']) ? $_GET['select_date'] : NULL; //
    $chart_type = isset($_GET['chart_type']) ? $_GET['chart_type'] : NULL; ///
    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;

    $ttime_standard="SELECT * FROM ttime_standard";
    $result_ttime_standard = mysqli_query($connect, $ttime_standard); 
    if ($result_ttime_standard && $result_ttime_standard->num_rows > 0) {
        $i=0;
        while ($row = mysqli_fetch_array($result_ttime_standard)) { 
            $data_ttime_standard[$i][0] = $row['id']; 
            $data_ttime_standard[$i][1] = $row['line'];
            $data_ttime_standard[$i][2] = $row['code'];
            $data_ttime_standard[$i][3] = $row['tacktime_standard'];
            $data_ttime_standard[$i][4] = $row['time'];
            $i++;
        }
    }
    else{
        $data_ttime_standard = [];
    }

    // $get_line = '';
    // switch ($select_line){
    //     case 'aw3':
    //         $get_line = 'aw3_ttime_standard';
    //         break;
    //     case 'aw2':
    //         $get_line = 'aw2_ttime_standard';
    //         break;
    //     case 'jatco':
    //         $get_line = 'jatco_ttime_standard';
    //         break;
    //     default:
    //         $get_line = 'aw3_ttime_standard';
    // }

    $db_table = '';
    if($select_line == "aw2"){
        switch ($chart_type){
            case 'bobin':
                $db_table = 'aw2_ttime_100';
                break;
            case 'terminal':
                $db_table = 'aw2_ttime_101';
                break;
            case 'winding':
                $db_table = 'aw2_ttime_102';
                break;
            case 'fusing':
                $db_table = 'aw2_ttime_103';
                break;
            case 'molding':
                $db_table = 'aw2_ttime_104';
                break;
            case 'inspection':
                $db_table = 'aw2_ttime_105';
                break;    
        }
    }

    //ttime aw3 ---1: terminal, 2:winding, 3:core_press, 4:molding, 5:inspection
    else if($select_line == "aw3"){
        switch ($chart_type){
            case 'terminal':
                $db_table = 'aw3_ttime_101';
                break;
            case 'winding':
                $db_table = 'aw3_ttime_102';
                break;
            case 'core_press':
                $db_table = 'aw3_ttime_103';
                break;
            case 'molding':
                $db_table = 'aw3_ttime_104';
                break;
            case 'inspection':
                $db_table = 'aw3_ttime_105';
                break;
        }
    }
    //ttime jatco ---1: terminal, 2:winding, 3:molding, 4:inspection
    else if($select_line == "jatco"){
        switch ($chart_type){
            case 'terminal':
                $db_table = 'jatco_ttime_101';
                break;
            case 'winding':
                $db_table = 'jatco_ttime_102';
                break;
            case 'molding':
                $db_table = 'jatco_ttime_104';
                break;
            case 'inspection':
                $db_table = 'jatco_ttime_105';
                break;
        }
    }
    // echo $db_table . "<br>";
    
    $start_time_tmp = $select_date . ' ' . $start_time;
    $stop_time_tmp = $select_date . ' ' . $stop_time;

    // $start_time_tmp = '2022-12-19 14:00:00';
    // $stop_time_tmp = '2022-12-19 14:45:00';
    
    $sqltacktime="SELECT * FROM $db_table WHERE time BETWEEN '$start_time_tmp' AND '$stop_time_tmp'";
    // echo $sqltacktime . "<br>";
    $result = mysqli_query($connect, $sqltacktime); 
    if ($result && $result->num_rows > 0) {
        $i=0;
        while ($row = mysqli_fetch_array($result)) { 
            $data_tacktime[$i][0] = $row['tacktime']; 
            $data_tacktime[$i][1] = $row['time'];
            $i++;
        }
    }
    else{
        $data_tacktime = [];
    }
    // print('1: ' . $select_line . "<br>");
    // print('1: ' . $start_time_tmp . "<br>");
    // print('2: ' . $stop_time_tmp . "<br>");
    // print($db_table . '<br>');
    // print_r($data_tacktime);
?>


    <!-- <div class="col-sm-12"> -->
    <div id="chart_tt" style="width: 100%; height: 65vh;"></div>
    <div class="row" style="text-align:center;">
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
    <!-- </div> -->

    <script src="/fiot-hdvn-losses/node_modules/highcharts/highcharts.js"></script>
    <script src="/fiot-hdvn-losses/node_modules/highcharts/modules/accessibility.js"></script>
    <script src="/fiot-hdvn-losses/node_modules/highcharts/modules/exporting.js"></script>
    <script src="/fiot-hdvn-losses/node_modules/highcharts/modules/export-data.js"></script>
    
    <script type="text/javascript">
        Highcharts.chart("chart_tt", {
            chart: {
                // type: "column",
            },
            title: {
                text: null,
            },
            subtitle: {
                text: null,
            },
            credits: {
                enabled: false,
            },
            xAxis: {
                categories: [
                    <?php for($i = 0; $i <count($data_tacktime); $i++){
                            echo '"' . $data_tacktime[$i][1]. '",';
                        } 
                    ?>
                ],
                crosshair: true,
            },
            yAxis: {
                tickInterval: 10, //set range value yAxis
                title: {
                    useHTML: true,
                    text: 'Số giây',
                    style: {
                      fontWeight: 'bold'
                    }
                },
                min: 0,
                max: 5,
                labels: {
                format: "{value.2f}",
                },
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat:
                '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.2f}s</b></td></tr>',
                footerFormat: "</table>",
                shared: true,
                useHTML: true,
            },
            legend: {
                backgroundColor: null,
                itemStyle: {
                color: "black",
                fontWeight: "bold",
                fontSize: 20,
                },
                // layout: 'vertical',
                // align: 'top',
                verticalAlign: "bottom",
                align: "center",

                enabled: true,
            },
            plotOptions: {
                column: {
                pointPadding: 0.2,
                borderWidth: 0,
                },
            },
            series: [
                {
                name: "Tiêu chuẩn <br> 目標",
                type: "line",
                // yAxis: 1,
                marker: false,
                lineWidth: 6,
                data: [
                    <?php 
                        for($i = 0; $i <count($data_tacktime); $i++){
                            for($x = 0; $x < count($data_ttime_standard); $x++){
                                if($data_ttime_standard[$x][1] == $select_line){
                                    echo $data_ttime_standard[$x][3] . ',';
                                }
                            }
                        } 
                    ?>
                ],
                
                color: "#ff6633",
                },
                {
                name: "Takttime thực tế <br> 実績可動率'",
                type: "line",
                marker: false,
                dataLabels: {
                    enabled: true //them value on top 
                },
                lineWidth: 6,
                data: [
                    <?php
                        for($i = 0; $i < count($data_tacktime); $i++){
                            echo $data_tacktime[$i][0] . ",";
                        }
                    ?>
                ],
                color: "#005ce6",
                },
            ],
        });
    </script>
