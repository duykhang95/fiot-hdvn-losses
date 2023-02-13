<?php
    // require_once "config/config.php";
    // $connect = $GLOBALS['connect'];

    // $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;
?>
    <div class="container-fluid"> 
         
        <div class="row">
            <!-- <div class="col-md-12" style="text-align:center;">
                <h3>HIỆU SUẤT HOẠT ĐỘNG TỔNG HỢP / ライン設備総合効率</h3>
            </div> -->
            <div class="col-md-12" >
                <div class="card"> 
                    <div class="card-body" style="width: 100%; height: 60px;">
                        <form method="post">
                            <div class="row">
                                <div class="form-group col-sm-2 px-1">
                                    <!-- <p><b>Chọn line</b></p> -->
                                    <select required class="form-control" onChange="filterData()" id="select_line" name="select_line">
                                        <!-- <option value="#">Chọn line</option> -->
                                        <option value="aw3">AISIN 2</option>
                                        <option value="aw2">AISIN 1</option>
                                        <option value="jatco">JATCO</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-10 px-1" style="text-align:center;">
                                    <h4>HIỆU SUẤT HOẠT ĐỘNG TỔNG HỢP / ライン設備総合効率</h4>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6" >
                <div class="card ">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between" >
                            <h5 class="card-title"><b>HIỆU SUẤT HOẠT ĐỘNG TỔNG HỢP THÁNG <br>ライン設備総合効率</b></h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-4">
                            <figure class="highcharts-figure">
                                <div id="chart_perform"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title"><b>CÁC YẾU TỐ ẢNH HƯỞNG HIỆU SUẤT HOẠT ĐỘNG <br>可動率に影響与える要因</b></h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-4">
                            <figure class="highcharts-figure">
                                <div id="chart_losses"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12" id="load_table"></div>
            
        </div>
    </div>
<!-- </div> -->


<script type="text/javascript">
    const select_line = document.getElementById("select_line").value;
    $("#load_table").load("index_sx_func/data_indexSX?select_line=aw3");
    $("#chart_perform").load("index_sx_func/chart_perform_monthly?select_line=aw3");
    $("#chart_losses").load("index_sx_func/chart_losses_monthly?select_line=aw3");
    function filterData(){
        const select_line = document.getElementById("select_line").value;
        $("#chart_perform").load("index_sx_func/chart_perform_monthly?select_line=" + select_line);
        $("#load_table").load("index_sx_func/data_indexSX?select_line=" + select_line);
        $("#chart_losses").load("index_sx_func/chart_losses_monthly?select_line=" + select_line);
    }
</script>