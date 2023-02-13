<?php
    require_once 'data_outputNG.php';
?>
    <div class="col-sm-12">
        <!-- <button type="button" name="" id="" class="btn btn-primary" data-toggle="modal" data-target="#add_data">
            <i class="fas fa-plus">
                Tạo dữ liệu mới
            </i>
        </button> -->
    </div>
    <div class="col-sm-12">
        <table id="output_ng" class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th style="width: 15%">Công đoạn <br> </th>
                    <th style="width: 25%">Tên lỗi <br> 不良名</th>
                    <th style="width: 20%">Tên lỗi (JP) <br> 不良名</th>
                    <th style="width: 20%">Trạng thái</th>
                    <th style="width: 16%">Thời gian<br> 時間</th>
                    <th style="width: 2%">Sửa</th>
                    <th style="width: 2%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    for($i = 0; $i < count($data_ng); $i++){
                        echo '<tr>';
                        echo '<td>' . $data_ng[$i][1] . '</td>
                            <td>'. $data_ng[$i][2] . '</td>
                            <td>'. $data_ng[$i][3] . '</td>
                            <td>'. $data_ng[$i][4] . '</td>
                            <td>'. $data_ng[$i][5] . '</td>
                            <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                    onclick ="editNG(' . $data_ng[$i][0] . ',' . '\'' . $data_ng[$i][1] . '\'' . ',' . 
                                                    '\'' . $data_ng[$i][2] . '\'' . ',' . '\'' . $data_ng[$i][3] . '\'' . ',' . 
                                                    '\'' . $data_ng[$i][4] . '\'' . ')"><span class="fa fa-edit"></span></button></td>
                            <td><button type="button" name="delete" id="delete" class="btn btn-danger btn-xs"
                                onclick ="deleteNG('. $data_ng[$i][0] . ',' .'\'' .$data_ng[$i][2].'\'' .')"><span class="fa fa-trash"></span></button></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal thêm data -->
    <!-- <form method="post">
        <div class="modal fade" id="add_data" tabindex="-1" role="dialog" aria-labelledby="exadd_data" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exadd_data">Tạo dữ liệu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="add_op" class="col-form-label">Công đoạn</label>
                            <select required class="form-control" id="add_op" name="add_op">
                                <option value="#">Chọn công đoạn</option>
                                <option value="1">Ép Terminal (タミナル圧入)</option>
                                <option value="2">Quấn Đồng (巻線)</option>
                                <option value="3">Ép Core (Core圧入)</option>
                                <option value="4">Đúc (成形)</option>
                                <option value="5">Kiểm Tra (特性検査)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="add_name" class="col-form-label">Nhập tên lỗi</label>
                            <input type="text" maxlength="200" class="form-control" id="add_name" name="add_name" placeholder="Nhập tên lỗi">
                            <small id="add_name_err" class="invalid-feedback">Không để trống</small>
                        </div>
                        <div class="form-group">
                            <label for="add_name_jp" class="col-form-label">Nhập tên lỗi (JP)</label>
                            <input type="text" maxlength="200" class="form-control" id="add_name_jp" name="add_name_jp" placeholder="Nhập tên lỗi (JP)">
                        </div>
                        <div class="form-group">
                            <label for="add_status" class="col-form-label">Nhập trạng thái</label>
                            <input type="text" maxlength="200" class="form-control" id="add_status" name="add_status" placeholder="Nhập trạng thái">
                            <small id="status_edit_err" class="invalid-feedback">Không để trống</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="add_time_begin" class="col-form-label">Thời gian bắt đầu</label>
                            <input type="datetime-local" step="2" class="form-control" id="add_time_begin" name="add_time_begin" placeholder="Nhập thời gian bắt đầu">
                        </div>
                        <div class="form-group">
                            <label for="add_second" class="col-form-label">Nhập số giây (s)</label>
                            <input type="text" maxlength="200" class="form-control" id="add_second" name="add_second" placeholder="Nhập giây (s)">
                        </div>
                        <div class="form-group">
                            <label for="add_time_stop" class="col-form-label">Thời gian kết thúc</label>
                            <input type="datetime-local" step="2" class="form-control" id="add_time_stop" name="add_time_stop" placeholder="Nhập thời gian kết thúc">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="add_new_data" name="add_new_data" hidden></input>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" id="add_data_btn" name="add_data_btn" class="btn btn-primary">Thêm dữ liệu</button>
                    </div>
                </div>
            </div>
        </div>
    </form> -->
    
    <!-- Modal edit data -->
    <form id="ng_form_edit" method="post">
        <!-- Modal edit sản phẩm -->
        <div class="modal fade" id="edit_output_ng" tabindex="-1" role="dialog" aria-labelledby="exedit_output_ng" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <input type="hidden" id="edit_id" name="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exedit_output_ng">Sửa Thông Tin Lỗi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id='form_test'>
                        <div class="form-group">
                            <label for="op_edit" class="col-form-label">Tên Công Đoạn</label>
                            <?php
                                if($select_line == "aw3"){
                                    echo '<select class="form-control" id="op_edit" name="op_edit">
                                            <option value="1">Ép Terminal (タミナル圧入)</option>
                                            <option value="2">Quấn Đồng (巻線)</option>
                                            <option value="3">Ép Core (Core圧入)</option>
                                            <option value="4">Đúc (成形)</option>
                                            <option value="5">Kiểm Tra (特性検査)</option>
                                        </select>';
                                }
                                else if ($select_line == "jatco"){
                                    echo '<select class="form-control" id="op_edit" name="op_edit">
                                            <option value="1">Ép Terminal (タミナル圧入)</option>
                                            <option value="2">Quấn Đồng (巻線)</option>
                                            <option value="3">Bàn Pha</option>
                                            <option value="4">Đúc (成形)</option>
                                            <option value="5">Kiểm Tra (特性検査)</option>
                                        </select>';
                                }
                                else if ($select_line == "jatco"){
                                    echo '<select class="form-control" id="op_edit" name="op_edit">
                                            <option value="0">Cấp Bobin</option>
                                            <option value="1">Ép Terminal (タミナル圧入)</option>
                                            <option value="2">Quấn Đồng (巻線)</option>
                                            <option value="31">Hàn</option>
                                            <option value="32">Bàn Pha</option>
                                            <option value="4">Đúc (成形)</option>
                                            <option value="5">Kiểm Tra (特性検査)</option>
                                        </select>';
                                }
                                
                            ?>
                            <small id="op_edit_err" class="invalid-feedback">Không để trống</small>
                        </div>
                        <div class="form-group">
                            <label for="name_ng_edit" class="col-form-label">Tên lỗi</label>
                            <input type="text" maxlength="200" class="form-control" id="name_ng_edit" name="name_ng_edit" placeholder="Nhập tên lỗi">
                            <small id="name_ng_edit_err" class="invalid-feedback">Không để trống</small>
                        </div>
                        <div class="form-group">
                            <label for="name_ng_jp_edit" class="col-form-label">Tên lỗi (JP)</label>
                            <input type="text" maxlength="200" class="form-control" id="name_ng_jp_edit" name="name_ng_jp_edit" placeholder="Nhập tên lỗi (JP)">
                            <!-- <small id="name_ng_jp_edit_err" class="invalid-feedback">Không để trống</small> -->
                        </div>
                        <div class="form-group">
                            <label for="status_edit" class="col-form-label">Trạng thái</label>
                            <input type="text" maxlength="200" class="form-control" id="status_edit" name="status_edit" placeholder="Nhập trạng thái">
                            <small id="status_edit_err" class="invalid-feedback">Không để trống</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="edit_ng_function" name="edit_ng_function" hidden></input>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" id="btn_name_ng_edit" name="btn_name_ng_edit" class="btn btn-primary">Sửa</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal delete data -->
    <form method="post">
        <!-- /.modal -->
        <div class="modal fade" id="myDelete">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">Xóa dữ liệu: <span id="content_delete" name="content_delete"></span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có muốn xóa dữ liệu này?!!! </p>
                        <input type="hidden" id="delete_id" name="delete_id">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-outline-light" name="post_delete_content" id="post_delete_content">Xóa</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>

<script src="
    <?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/six_losses/views/default/js/datatables_func.js" ?>">
</script>
<script type="text/javascript">
    createDataTable('output_ng', 10, true);
</script>
<script type="text/javascript">
    function warning() {
        console.log("start");
        $("#myWarning").modal('toggle');
    }

    function deleteNG(id_del,content_del) {
        // console.log(id_stt);
        document.getElementById('delete_id').value = id_del;
        document.getElementById('content_delete').innerHTML = content_del;
        $("#myDelete").modal('toggle');
    }

    function editNG(edit_id, op_edit, name_ng_edit, name_ng_jp_edit, status_edit) {
        document.getElementById('edit_id').value = edit_id;
        // console.log(id_edit);
        document.getElementById('op_edit').value = op_edit;
        // console.log(op_edit);
        document.getElementById('name_ng_edit').value = name_ng_edit;
        document.getElementById('name_ng_jp_edit').value = name_ng_jp_edit;
        document.getElementById('status_edit').value = status_edit;
        $("#edit_output_ng").modal('toggle');
    }
</script>

