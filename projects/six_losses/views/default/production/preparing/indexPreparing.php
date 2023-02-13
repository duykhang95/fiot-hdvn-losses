<?php
    $date = date('Y-m-d');
?>    
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>CHUẨN BỊ</h2>
                    </div>
                </div>
                <!-- end col -->
            
                <div class="col-sm-12" style="margin-bottom:10px;">
                    <div class="card"> 
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="form-group col-sm-4 px-1">
                                        <p><b>Chọn line</b></p>
                                        <select required class="form-control" onChange="filterData()" id="select_line" name="select_line" value="<?php echo($select_line); ?>">
                                            <option value="aw3">AISIN 2</option>
                                            <option value="aw2">AISIN 1</option>
                                            <option value="jatco">JATCO</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4 px-1">
                                        <p><b>Từ ngày / …日から</b></p>
                                        <input type="date" onChange="filterData()" id="from_date" name="from_date" value="<?php echo($date); ?>" max="<?php echo($date); ?>" class="form-control" >
                                    </div>
                                    <div class="form-group col-sm-4 px-1">
                                        <p><b>Đến ngày / …日まで</b></p>
                                        <input type="date" onChange="filterData()" id="to_date" name="to_date" value="<?php echo($date); ?>" max="<?php echo($date); ?>" class="form-control" >
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

                <!-- <div class="col-sm-12">
                    <div id="load_table"></div>
                </div> -->
            </div>
        </div>
        <!-- End Wrapper -->
    </div>

<script type="text/javascript">
    const select_line = document.getElementById("select_line").value;
    const from_date = document.getElementById("from_date").value;
    const to_date = document.getElementById("to_date").value;
    $("#load_table").load("preparing_func/data_preparing?select_line=" + select_line + "&from_date=" + from_date + "&to_date=" + to_date);
    function filterData(){
        const select_line = document.getElementById("select_line").value;
        const from_date = document.getElementById("from_date").value;
        const to_date = document.getElementById("to_date").value;
        $("#load_table").load("preparing_func/data_preparing?select_line=" + select_line + "&from_date=" + from_date + "&to_date=" + to_date);
    }
</script>