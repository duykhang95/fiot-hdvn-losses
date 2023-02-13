<?php
    require_once "config/config.php";
    $connect = $GLOBALS['connect'];

    $select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;

    $get_line = '';
    switch ($select_line){
        case 'aw3':
            $get_line = 'aw3_bt_history';
            break;
        case 'aw2':
            $get_line = 'aw2_bt_history';
            break;
        case 'jatco':
            $get_line = 'jatco_bt_history';
            break;
        default:
            $get_line = 'aw3_bt_history';
    }
    $show_history = "SELECT * FROM $get_line ORDER BY `id` DESC";
    $result = mysqli_query( $connect, $show_history );
    if ($result && $result->num_rows > 0) {
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            //thêm kết quả vào mảng
            $data_history[$i][0]=$row['id'];
            $data_history[$i][1]=$row['sub_content_jp'];
            $data_history[$i][2]=$row['content'];
            $data_history[$i][3]=$row['sub_content'];
            $data_history[$i][4]=$row['time'];
            $i++;
        }
    }
    else{
        $data_history = [];
    }
?>
    <table id="myTable1" class="table table-hover table-bordered text-center">
        <thead>
            <tr>
                <th style="width: 5%">STT</th>
                <th style="width: 5%">CONTENT</th>
                <th style="width: 40%">SUB CONTENT</th>
                <th style="width: 30%">SUB CONTENT JP</th>
                <th style="width: 20%">TIME</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $stt_history = 0;
                for($i = 0; $i < count($data_history); $i++){
                    $stt_history++;
                    echo '<tr>';
                    echo '<td>' . $stt_history . '</td>
                    <td>'. $data_history[$i][2] . '</td>
                    <td>'. $data_history[$i][3] . '</td>
                    <td>'. $data_history[$i][1] . '</td>
                    <td>'. $data_history[$i][4] . '</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>

<!-- <form method="post">
    <div class="modal fade" id="myDelete">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Data: <span id="content_delete" name="content_delete"></span></h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete this data!!! </p>
                    <input type="hidden" id="delete_id" name="delete_id">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-light" name="post_delete_content" id="post_delete_content">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form> -->

<script src="
    <?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/six_losses/views/default/js/datatables_func.js" ?>">
</script>
<script type="text/javascript">
    createDataTable('myTable1', 10, true);
</script>

<!-- <script type="text/javascript">
    function deleteHistory(id_del,content_del) {
        // console.log(id_stt);
        document.getElementById('delete_id').value = id_del;
        document.getElementById('content_delete').innerHTML = content_del;
        $("#myDelete").modal('toggle');
    }
</script> -->