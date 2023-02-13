<pre>
<?php
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];

    $startTime = isset($_GET['startTime']) ? $_GET['startTime'] : NULL; // 
    $stopTime = isset($_GET['stopTime']) ? $_GET['stopTime'] : NULL; //
    $table = isset($_GET['table']) ? $_GET['table'] : NULL; //

    $startTime = '2022-12-20';
    $stopTime = '2022-12-21';
    $table = 'aw3_ttime_1';

    //function select all takttime line aw3
    function selectTacktime ($table, $startTime, $stopTime, $connect){
        $sqltacktime= "SELECT * FROM $table WHERE time BETWEEN '$startTime%' AND '$stopTime%'";
        // echo $sqltacktime;
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
        return $data_tacktime;
    }

    $array_line = array("aw3_ttime", "aw2_ttime", "jatco_ttime");
    $table_arr = array();
    for($i = 0; $i < count($array_line); $i++){
        for($x = 100; $x <= 105; $x++){
            // echo "STT" . $i . "</br>";
            $flag = 'true';
            $abc = $array_line[$i] . "_" . $x;
            echo $abc . "<br>";
            $get_data = selectTacktime($abc, $startTime, $stopTime, $connect);
            for ($j=0; $j < count($get_data); $j++) { 
                if($get_data[$j][0] > 3.8){
                    echo $get_data[$j][0] . "<br>";
                    $flag = 'false';
                    break;
                }
            }
            array_push($table_arr, $flag);
            // print_r($get_data);
        }
    }
    print_r($table_arr);
?>