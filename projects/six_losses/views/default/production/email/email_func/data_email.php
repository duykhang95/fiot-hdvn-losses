<!-- <pre> -->
<?php
    require_once 'config/config.php';
    $connect = $GLOBALS['connect'];

    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;

    //filter data table mail_list--------------------------------------------
    $sql_mail_list = "SELECT * FROM mail_list WHERE line = '$select_line'";
    // echo $sql_mail_list . "<br>";
    $resultcheck_mail = mysqli_query( $connect, $sql_mail_list );
    if ($resultcheck_mail && $resultcheck_mail->num_rows > 0) {
        $i = 0;
        while ($row = $resultcheck_mail->fetch_assoc()) {
            //thêm kết quả vào mảng
            $data_email_list[$i][0]=$row['id'];
            $data_email_list[$i][1]=$row['line'];
            $data_email_list[$i][2]=$row['step'];
            $data_email_list[$i][3]=$row['mail'];
            $data_email_list[$i][4]=$row['time'];
            $i++;
        }
    }
    else{
        $data_email_list = [];
    }
    // print_r($data_email_list);

    $sql_mail_condition = "SELECT * FROM mail_condition WHERE line = '$select_line'";
    $resultcheck_mail_condition = mysqli_query( $connect, $sql_mail_condition );
    if ($resultcheck_mail_condition && $resultcheck_mail_condition->num_rows > 0) {
        $i = 0;
        while ($row = $resultcheck_mail_condition->fetch_assoc()) {
            //thêm kết quả vào mảng
            $data_email_condition[$i][0]=$row['id'];
            $data_email_condition[$i][1]=$row['line'];
            $data_email_condition[$i][2]=$row['step'];
            $data_email_condition[$i][3]=$row['minutes'];
            $data_email_condition[$i][4]=$row['time'];
            $i++;
        }
    }
    else{
        $data_email_condition = [];
    }
    // print_r($data_email_condition);

?>
    <!-- <select name="select_line" id="select_line">
        <option value="aw3">AISIN 2</option>
        <option value="aw2">AISIN 1</option>
        <option value="jatco">JATCO</option>
    </select> -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative mb-4">                              
                        <div class="card-body table-responsive p-0">
                            <table id="email" class="table table-hover table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">Tuần tự gửi mail</th>
                                        <th style="width: 60%">Số phút</th>
                                        <th style="width: 20%">Sửa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $condition_send_mail = 0;
                                        for($i = 0; $i < count($data_email_condition); $i++){
                                            $condition_send_mail++;
                                            if($select_line = "aw3" ){
                                                echo '<tr>';
                                                echo '<td>' . $condition_send_mail.'</td>
                                                    <td>' . $data_email_condition[$i][3].'</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editMinute(' . $data_email_condition[$i][0] . ',' . '\'' .    
                                                        $data_email_condition[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                            else if($select_line = "aw2"){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_condition[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editMinute(' . $data_email_list[$i][0] . ',' . '\'' .    
                                                        $data_email_condition[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                            else if($select_line = "jatco"){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_condition[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editMinute(' . $data_email_condition[$i][0] . ',' . '\'' .    
                                                        $data_email_condition[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative mb-4">                              
                        <div class="card-body table-responsive p-0">
                            <table id="email" class="table table-hover table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 80%">Danh sách mail SV của Sản xuất, PE và MA (1)</th>
                                        <th style="width: 20%">Sửa</th>
                                        <!--<th scope="col">Time End</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for($i = 0; $i < count($data_email_list); $i++){
                                            if($select_line = "aw3" && $data_email_list[$i][2] == 1){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_list[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editEmail(' . $data_email_list[$i][0] . ',' . '\'' .    
                                                        $data_email_list[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                            else if($select_line = "aw2" && $data_email_list[$i][2] == 1){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_list[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editEmail(' . $data_email_list[$i][0] . ',' . '\'' .    
                                                        $data_email_list[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                            else if($select_line = "jatco" && $data_email_list[$i][2] == 1){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_list[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editEmail(' . $data_email_list[$i][0] . ',' . '\'' .    
                                                        $data_email_list[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative mb-4">                              
                        <div class="card-body table-responsive p-0">
                            <table id="email" class="table table-hover table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 80%">Danh sách mail MGR của Sản xuất, PE và MA (2)</th>
                                        <th style="width: 20%">Sửa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for($i = 0; $i < count($data_email_list); $i++){
                                            if($select_line = "aw3" && $data_email_list[$i][2] == 2){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_list[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editEmail(' . $data_email_list[$i][0] . ',' . '\'' .    
                                                        $data_email_list[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                            else if($select_line = "aw2" && $data_email_list[$i][2] == 2){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_list[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editEmail(' . $data_email_list[$i][0] . ',' . '\'' .    
                                                        $data_email_list[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                            else if($select_line = "jatco" && $data_email_list[$i][2] == 2){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_list[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editEmail(' . $data_email_list[$i][0] . ',' . '\'' .    
                                                        $data_email_list[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                        }
                                        
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative mb-4">                              
                        <div class="card-body table-responsive p-0">
                            <table id="email" class="table table-hover table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 80%">Danh sách mail GM của Sản xuất, PE và MA (3)</th>
                                        <th style="width: 20%">Sửa</th>
                                        <!--<th scope="col">Time End</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for($i = 0; $i < count($data_email_list); $i++){
                                            if($select_line = "aw3" && $data_email_list[$i][2] == 3){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_list[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editEmail(' . $data_email_list[$i][0] . ',' . '\'' .    
                                                        $data_email_list[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                            else if($select_line = "aw2" && $data_email_list[$i][2] == 3){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_list[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editEmail(' . $data_email_list[$i][0] . ',' . '\'' .    
                                                        $data_email_list[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                            else if($select_line = "jatco" && $data_email_list[$i][2] == 3){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_list[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editEmail(' . $data_email_list[$i][0] . ',' . '\'' .    
                                                        $data_email_list[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative mb-4">                              
                        <div class="card-body table-responsive p-0">
                            <table id="email" class="table table-hover table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 80%">Mail Tổng Giám Đốc (4)</th>
                                        <th style="width: 20%">Sửa</th>
                                        <!--<th scope="col">Time End</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for($i = 0; $i < count($data_email_list); $i++){
                                            if($select_line = "aw3" && $data_email_list[$i][2] == 4){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_list[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editEmail(' . $data_email_list[$i][0] . ',' . '\'' .    
                                                        $data_email_list[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                            else if($select_line = "aw2" && $data_email_list[$i][2] == 4){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_list[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editEmail(' . $data_email_list[$i][0] . ',' . '\'' .    
                                                        $data_email_list[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                            else if($select_line = "jatco" && $data_email_list[$i][2] == 4){
                                                echo '<tr>';
                                                echo '
                                                    <td>' . $data_email_list[$i][3] . '</td>
                                                    <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                                        onclick ="editEmail(' . $data_email_list[$i][0] . ',' . '\'' .    
                                                        $data_email_list[$i][3] . '\'' . ')"><span class="fa fa-edit"></span></button></td>';
                                                echo '</tr>';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- modal edit email -->
    <form method="post">
        <div class="modal fade" id="edit_email" tabindex="-1" aria-labelledby="exedit_email" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <input type="hidden" id="edit_id" name="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exedit_email">Sửa Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="form_test">
                        <div class="form-group">
                            <label for="email_edit" class="col-form-label">Email</label>
                            <input type="text" maxlength="200" class="form-control" id="email_edit" name="email_edit" placeholder="Nhập tên lỗi">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="edit_Email_function" name="edit_Email_function" hidden></input>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" id="btn_email_edit" name="btn_email_edit" class="btn btn-primary">Sửa</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <!-- modal edit số phút -->
    <form method="post">
        <div class="modal fade" id="editMinute" tabindex="-1" aria-labelledby="exeditMinute" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <input type="hidden" id="id_minute" name="id_minute">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exeditMinute">Sửa Phút</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="form_test">
                        <div class="form-group">
                            <label for="edit_minute" class="col-form-label">Số phút</label>
                            <input type="text" maxlength="200" class="form-control" id="edit_minute" name="edit_minute" placeholder="Nhập tên lỗi">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="edit_minute_function" name="edit_minute_function" hidden></input>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" id="btn_minute_edit" name="btn_minute_edit" class="btn btn-primary">Sửa</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
<script type="text/javascript">
    
    function editEmail(edit_id, email_edit) {
        document.getElementById('edit_id').value = edit_id;
        document.getElementById('email_edit').value = email_edit;
        $("#edit_email").modal('toggle');
    }

    function editMinute(id_minute, edit_minute) {
        document.getElementById('id_minute').value = id_minute;
        document.getElementById('edit_minute').value = edit_minute;
        $("#editMinute").modal('toggle');
    }
    
</script>