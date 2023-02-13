<?php
    $date = date('Y-m-d');
    $yesterday_tmp = mktime(0, 0, 0, date("m") , date("d")-1, date("Y"));
    $yesterday = date('Y-m-d', $yesterday_tmp);
?>

    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <h2>OEE History</h2>
            <div class="row align-items-center">
                <div class="col-sm-12" style="margin-bottom:10px;">
                    <div class="card"> 
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="form-group col-sm-4 px-1">
                                        <p><b>Chọn line</b></p>
                                        <select required class="form-control" onChange="filterData()" id="select_line" name="select_line">
                                            <option value="aw3">AISIN 2</option>
                                            <option value="aw2">AISIN 1</option>
                                            <option value="jatco">JATCO</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4 px-1">
                                        <p><b>Chọn ngày</b></p>
                                        <input type="date" onChange="filterData()" id="select_date" name="select_date" value="<?php echo $yesterday; ?>" class="form-control" >
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- <div id="chart" class="col-sm-12" style="margin-bottom: 30px;"></div> -->
                <!-- </div> -->
                <div class="col-sm-12" id="load_table"></div>
                
                <!-- end col -->
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const select_date = document.getElementById("select_date").value;
        const select_line = document.getElementById("select_line").value;
        $("#load_table").load("oee_func/data_oee_history?select_line=" + select_line + "&select_date=" + select_date);
        // console.log(date);
        function filterData(){
            const select_date = document.getElementById("select_date").value;
            const select_line = document.getElementById("select_line").value;
            $("#load_table").load("oee_func/data_oee_history?select_line=" + select_line + "&select_date=" + select_date);
        }
    </script>