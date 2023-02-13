<?php
    require_once 'data_shortDT.php';
    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;

?>
    <div class="col-sm-12">
        <button type="button" name="" id="add_data_btn" class="btn btn-primary" data-toggle="modal" data-target="#add_data">
            <i class="fas fa-plus">
                Tạo dữ liệu mới
            </i>
        </button>
    </div>
    <div class="col-sm-12">
        <table id="short_dt" class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th style="width: 15%">Công đoạn <br> </th>
                    <th style="width: 25%">Tên lỗi <br> 不良名</th>
                    <th style="width: 20%">Tên lỗi (JP) <br> 不良名</th>
                    <th style="width: 15%">Trạng thái<br> 不良名</th>
                    <th style="width: 16%">Bắt đầu<br> 始め時間</th>
                    <th style="width: 5%">Phút <br>（分）</th>
                    <th style="width: 2%">Sửa</th>
                    <th style="width: 2%">Xóa</th>
                    <!--<th scope="col">Time End</th>-->
                </tr>
            </thead>
            <tbody>
                <?php
                    for($i = 0; $i < count($data_short_downtime); $i++){
                        echo '<tr>';
                        echo '<td>' . $data_short_downtime[$i][1] . '</td>
                            <td>'. $data_short_downtime[$i][2] . '</td>
                            <td>'. $data_short_downtime[$i][3] . '</td>
                            <td>'. $data_short_downtime[$i][4] . '</td>
                            <td>'. $data_short_downtime[$i][5] . '</td>
                            <td>'. round((int)$data_short_downtime[$i][6] / 60, 1) . '</td>
                            <td><button type="button" name="edit" id="edit" class="btn btn-warning btn-xs"
                                onclick ="editShortDT(' . $data_short_downtime[$i][0] . ',' . '\'' . 
                                $data_short_downtime[$i][1] . '\'' . ',' . '\'' . 
                                $data_short_downtime[$i][2] . '\'' . ',' . '\'' . 
                                $data_short_downtime[$i][3] . '\'' . ',' . '\'' . 
                                $data_short_downtime[$i][4] . '\'' . ')"><span class="fa fa-edit"></span></button></td>
                            <td><button type="button" name="delete" id="delete" class="btn btn-danger btn-xs"
                                onclick ="deleteShortDT('. $data_short_downtime[$i][0] . ',' .'\'' . 
                                $data_short_downtime[$i][2].'\'' .')"><span class="fa fa-trash"></span></button></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal thêm data -->
    <form method="post">
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
                            <!-- <small id="product_family_err" class='invalid-feedback'>Không để trống</small> -->
                        </div>
                        <div class="form-group">
                            <label for="add_name" class="col-form-label">Nhập tên lỗi</label>
                            <input type="text" maxlength="200" class="form-control" id="add_name" name="add_name" placeholder="Nhập tên lỗi">
                            <small id="add_name_err" class="invalid-feedback">Không để trống</small>
                        </div>
                        <div class="form-group">
                            <label for="add_name_jp" class="col-form-label">Nhập tên lỗi (JP)</label>
                            <input type="text" maxlength="200" class="form-control" id="add_name_jp" name="add_name_jp" placeholder="Nhập tên lỗi (JP)">
                            <!-- <small id="name_jp_edit_err" class="invalid-feedback">Không để trống</small> -->
                        </div>
                        <div class="form-group">
                            <label for="add_status" class="col-form-label">Nhập trạng thái</label>
                            <input type="text" maxlength="200" class="form-control" id="add_status" name="add_status" placeholder="Nhập trạng thái">
                            <small id="status_edit_err" class="invalid-feedback">Không để trống</small>
                        </div>
                        <!-- <div class="form-group">
                            <label for="add_day" class="col-form-label">Chọn ngày</label>
                            <input type="date" class="form-control" id="add_day" name="add_day" placeholder="Nhập ngày">
                        </div> -->
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
    </form>
    
    <!-- Modal edit data -->
    <form method="post">
        <div class="modal fade" id="edit_short_dt" tabindex="-1" aria-labelledby="exedit_short_dt" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <input type="hidden" id="edit_id" name="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exedit_short_dt">Sửa Thông Tin Dừng Ngắn</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="form_test">
                        <div class="form-group">
                            <label for="op_edit" class="col-form-label">Tên Công Đoạn</label>
                            <?php
                                if($select_line == "aw3" || $select_line == "jatco"){
                                    echo '<select class="form-control" id="op_edit" name="op_edit">
                                            <option value="1">Ép Terminal (タミナル圧入)</option>
                                            <option value="2">Quấn Đồng (巻線)</option>
                                            <option value="3">Ép Core (Core圧入)</option>
                                            <option value="4">Đúc (成形)</option>
                                            <option value="5">Kiểm Tra (特性検査)</option>
                                        </select>';
                                }
                                else if ($select_line == "aw2"){
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
                                <!-- <select class="form-control" id="op_edit" name="op_edit">
                                    <option value="1">Ép Terminal (タミナル圧入)</option>
                                    <option value="2">Quấn Đồng (巻線)</option>
                                    <option value="3">Ép Core (Core圧入)</option>
                                    <option value="4">Đúc (成形)</option>
                                    <option value="5">Kiểm Tra (特性検査)</option>
                                </select> -->
                            <small id="op_edit_err" class="invalid-feedback">Không để trống</small>
                        </div>
                        <div class="form-group">
                            <label for="name_edit" class="col-form-label">Tên lỗi</label>
                            <input type="text" maxlength="200" class="form-control" id="name_edit" name="name_edit" placeholder="Nhập tên lỗi">
                            <small id="name_edit_err" class="invalid-feedback">Không để trống</small>
                        </div>
                        <div class="form-group">
                            <label for="name_jp_edit" class="col-form-label">Tên lỗi (JP)</label>
                            <input type="text" maxlength="200" class="form-control" id="name_jp_edit" name="name_jp_edit" placeholder="Nhập tên lỗi (JP)">
                            <!-- <small id="name_jp_edit_err" class="invalid-feedback">Không để trống</small> -->
                        </div>
                        <div class="form-group">
                            <label for="status_edit" class="col-form-label">Trạng thái</label>
                            <input type="text" maxlength="200" class="form-control" id="status_edit" name="status_edit" placeholder="Nhập trạng thái">
                            <small id="status_edit_err" class="invalid-feedback">Không để trống</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="edit_shortDT_function" name="edit_shortDT_function" hidden></input>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" id="btn_name_edit" name="btn_name_edit" class="btn btn-primary">Sửa</button>
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
    createDataTable('short_dt', 10, true);
</script>
<script type="text/javascript">
    function deleteShortDT(id_del,content_del) {
        // console.log(id_stt);
        document.getElementById('delete_id').value = id_del;
        document.getElementById('content_delete').innerHTML = content_del;
        $("#myDelete").modal('toggle');
    }

    function editShortDT(edit_id, op_edit, name_edit, name_jp_edit, status_edit) {
        document.getElementById('edit_id').value = edit_id;
        // console.log(id_edit);
        document.getElementById('op_edit').value = op_edit;
        // console.log(op_edit);
        document.getElementById('name_edit').value = name_edit;
        document.getElementById('name_jp_edit').value = name_jp_edit;
        document.getElementById('status_edit').value = status_edit;
        $("#edit_short_dt").modal('toggle');
    }
</script>

