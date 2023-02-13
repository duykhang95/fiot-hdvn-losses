<div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h3> LỊCH SỬ THAY THẾ ĐỊNH KÌ </h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="title mb-30" style="text-align:right;">
                        <a href="../index_bt">Trang chủ Bảo trì</a>
                    </div>
                </div>
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
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title"><b>Bảng dữ liệu</b></h3>
                        </div>                        
                        <div class="card-body" id="load_table"></div>
                        
                    </div>
                </div>
                
                <!-- end col -->
            </div>
        </div>
    </div>

<script type="text/javascript">
    const select_line = document.getElementById("select_line").value;
    $("#load_table").load("data_historyInterval?select_line=aw3");

    function filterData(){
        const select_line = document.getElementById("select_line").value;
        $("#load_table").load("data_historyInterval?select_line=" + select_line);
    }
</script>

