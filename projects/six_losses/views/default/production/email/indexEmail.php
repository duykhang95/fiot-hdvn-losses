<?php
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];

    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;
?>
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <h2>Quản lí Email</h2>
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
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const select_line = document.getElementById("select_line").value;
        $("#load_table").load("email_func/data_email?select_line=" + select_line);

        function filterData(){
            const select_line = document.getElementById("select_line").value;
            // $("#load_table").load("email_func/data_email?select_line=" + select_line);
            document.location = "indexEmail?select_line=" + select_line;
        }
    </script>

<?php

    if(isset($_POST["btn_minute_edit"])){
        
    }
    
    if(isset($_POST["btn_minute_edit"])){
        $id_minute = $_POST['id_minute'];
        $minute_edit = $_POST['edit_minute'];

        $sql_update_minute= "UPDATE mail_condition SET minutes = '$minute_edit' WHERE id = '$id_minute' AND line = '$select_line'";
        if ( mysqli_query( $connect, $sql_update_minute ) ) {
            mysqli_close( $connect );
        }
        echo "<script>document.location = 'indexEmail?select_line=".$select_line."</script>";
    }

    if(isset($_POST["btn_email_edit"])){
        $edit_id = $_POST['edit_id'];
        $email_edit = $_POST['email_edit'];
        
        $sql_update_email= "UPDATE mail_list SET mail = '$email_edit' WHERE id = '$edit_id' AND line = '$select_line'";
        if ( mysqli_query( $connect, $sql_update_email ) ) {
            mysqli_close( $connect );
            // die();
        }
        echo "<script>document.location = 'indexEmail?select_line=".$select_line."</script>";
    }
?>