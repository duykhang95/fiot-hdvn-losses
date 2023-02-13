<?php
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];
    $date = date('Y-m-d');

    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;

    if(isset($_GET["from_date"])){
        $from_date = $_GET["from_date"];
    }
    else{
        $from_date = $date;
    }
    
    if(isset($_GET["to_date"])){
        $to_date = $_GET["to_date"];
    }
    else{
        $to_date = $date;
    }
?>

    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <h2>TỈ LỆ LỖI</h2>
            <div class="row align-items-center">
                <div class="col-sm-12" style="margin-bottom:10px;">
                    <div class="card"> 
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="form-group col-sm-4 px-1">
                                        <p><b>Chọn line</b></p>
                                        <select required class="form-control" onChange="filterData()" id="select_line" name="select_line">
                                            <!-- <option value="#">Chọn Line</option> -->
                                            <option value="aw3" <?php if($select_line=='aw3'){echo 'selected';} ?>> AISIN 2</option>
                                            <option value="aw2" <?php if($select_line=='aw2'){echo 'selected';} ?>> AISIN 1</option>
                                            <option value="jatco" <?php if($select_line=='jatco'){echo 'selected';} ?>> JATCO</option>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4 px-1">
                                        <p><b>Từ ngày / …日から</b></p>
                                        <input type="date" onChange="filterData()" id="from_date" name="from_date" value="<?php echo($from_date); ?>" max="<?php echo($date); ?>" class="form-control" >
                                    </div>
                                    <div class="form-group col-sm-4 px-1">
                                        <p><b>Đến ngày / …日まで</b></p>
                                        <!--<p><b>Start Time</b></p>-->
                                        <input type="date" onChange="filterData()" id="to_date" name="to_date" value="<?php echo($to_date); ?>" max="<?php echo($date); ?>" class="form-control" >
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title"><b>BIỂU ĐỒ TỔN THẤT LỖI</b></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="position-relative mb-4">
                                <figure class="highcharts-figure">
                                    <div id="chart"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div id="chart" class="col-sm-12" style="margin-bottom: 30px;"></div> -->
                <!-- </div> -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title"><b>Bảng dữ liệu</b></h3>
                            </div>  
                        </div>
                        <div class="card-body">
                            <div class="position-relative mb-4">                              
                                <div class="card-body table-responsive p-0" id="load_table">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- end col -->
            </div>
        </div>
    </div>

<script type="text/javascript">
    const select_line = document.getElementById("select_line").value;
    const from_date = document.getElementById("from_date").value;
    const to_date = document.getElementById("to_date").value;
    // console.log(select_line);
    $("#chart").load("outputNG_func/chart_outputNG?select_line=" + select_line + "&from_date=" + from_date + "&to_date=" + to_date);
    $("#load_table").load("outputNG_func/table_outputNG?select_line=" + select_line + "&from_date=" + from_date + "&to_date=" + to_date);

    function filterData(){
        const select_line = document.getElementById("select_line").value;
        const from_date = document.getElementById("from_date").value;
        const to_date = document.getElementById("to_date").value;

        document.location = "indexOutputNG?select_line=" + select_line + "&from_date=" + from_date + "&to_date=" + to_date;
        // $("#chart").load("outputNG_func/chart_outputNG?select_line=" + select_line + "&from_date=" + from_date + "&to_date=" + to_date);
        // $("#load_table").load("outputNG_func/table_outputNG?select_line=" + select_line + "&from_date=" + from_date + "&to_date=" + to_date);
    }
</script>

<?php
    if(isset($_GET["submit_defect"])){
        $select_op = $_GET['select_op'];
        $defect_name = $_GET['defect_name'];
        $time_input = $_GET['time_input'];

        $sql_insert_ng = "INSERT INTO `aw3_output_ng_total`(`op`, `defect_name`, `time`) VALUES ('$select_op', '$defect_name', '$time_input')";
        // echo $sql_insert_ng;
        if(mysqli_query( $connect, $sql_insert_ng )) {
            mysqli_close( $connect );
        }
        echo "OKkkkkkkkkkkkkkkkkkkkkkkkkkkkkk";
        // echo "<script type=text/javascript>success()</script>"; 
    }
    else{
        echo "Don't OK";
    }

    if(isset($_POST["post_delete_content"])){
        $delete_id = $_POST['delete_id'];
        // echo "<script>alert('Delete! Delete đi')</script>";
        $sql_delete = "DELETE FROM " . $select_line . "_output_ng_total WHERE id = '$delete_id'";
        if ( mysqli_query( $connect, $sql_delete ) ) {
            mysqli_close( $connect );
            // die();
        }
        echo "<script>document.location = 'indexOutputNG?select_line=".$select_line."&from_date=".$from_date."&to_date=".$to_date."</script>";
    }

    if(isset($_POST["btn_name_ng_edit"])){
        $edit_id = $_POST['edit_id'];
        // echo "<script>alert('Update! Update đi')</script>";
        $op_edit = $_POST['op_edit'];
        $name_ng_edit = $_POST['name_ng_edit'];
        $name_ng_jp_edit = $_POST['name_ng_jp_edit'];
        $status_edit = $_POST['status_edit'];

        $sql_update= "UPDATE " . $select_line . "_output_ng_total SET op = '$op_edit', defect_name = '$name_ng_edit', name_jp = '$name_ng_jp_edit', comment = '$status_edit'  WHERE id = '$edit_id'";
        if ( mysqli_query( $connect, $sql_update ) ) {
            mysqli_close( $connect );
            // die();
        }
        echo "<script>document.location = 'indexOutputNG?select_line=".$select_line."&from_date=".$from_date."&to_date=".$to_date."</script>";
    }
?>
