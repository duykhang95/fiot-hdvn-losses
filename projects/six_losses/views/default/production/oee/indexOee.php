<?php
    // require_once 'oee_func/data_oee.php';
?>

    <style>
        
        #table_1 td{
            font-size: 15px;
            font-weight: bold;
        }
        #table_2 td{
            font-size: 15px;
            font-weight: bold;
        }
        #table_3 td{
            font-size: 15px;
            font-weight: bold;
        }

        table a:hover {
            background: #99CCFF;
            color: #000;
        }
    </style>

    <!-- ========== section start ========== -->
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title mb-30">
                        <h3>OEE</h3>
                    </div>
                </div>
                <div class="col-sm-12" style="margin-bottom:20px;">                  
                    <div class="card">      
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="form-group col-sm-4 px-1">
                                        <p><b>Chọn line</b></p>
                                        <select required class="form-control" id="select_line" name="select_line" onChange="filterData();">
                                            <option value="aw3">AISIN 2</option>
                                            <option value="aw2">AISIN 1</option>
                                            <option value="jatco">JATCO</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="title mb-30">
                        <h4 style="margin-bottom: 10px;">Biểu đồ hiệu suất</h4>
                    </div>
                </div>
                <div class="col-sm-12" id="chart_perform" style="margin-bottom: 5px;"></div>
                <div class="col-sm-12" id="load_oee_perform"></div>
            </div>
        </div>     
    </div>

    <!-- ========= All Javascript files linkup ======== -->
    <script type="text/javascript">
        const select_line = document.getElementById("select_line").value;
        $("#chart_perform").load("oee_func/chart_oee_monthly?select_line=aw3");

        let myOee = setInterval(load_oee_performance, 2000);
        function load_oee_performance(){
            $.get("oee_func/data_oee", {select_line:select_line}, function(data){
                $("#load_oee_perform").html(data);
            });
        }
        function stopLoad(){
            clearInterval(myOee);
            // console.log("clear here.")
        }

        function filterData(){
            stopLoad();
            const select_line = document.getElementById("select_line").value;
            $("#chart_perform").load("oee_func/chart_oee_monthly?select_line=" + select_line);
            myOee = setInterval(load_oee_performance, 2000);
            function load_oee_performance(){
                $.get("oee_func/data_oee", {select_line:select_line}, function(data){
                    $("#load_oee_perform").html(data);
                });
            }
        }
    </script>
    
