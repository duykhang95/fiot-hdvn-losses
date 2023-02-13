<?php

$connect = $GLOBALS['connect'];
$username_change = $_COOKIE['username'];
$ip_address = $_SERVER['REMOTE_ADDR'];

// select danh sách chức vụ, vai trò
$sqlcheck_tb_role = "SELECT `role`, `role_name` FROM `tb_role` ORDER BY `role` ASC";
$resultcheck_tb_role = mysqli_query( $connect, $sqlcheck_tb_role );
if ($resultcheck_tb_role && $resultcheck_tb_role->num_rows > 0) {
    // tiến hành lặp dữ liệu
    $i = 0;
    while ($row = $resultcheck_tb_role->fetch_assoc()) {
        //thêm kết quả vào mảng
        $data_role[$i][0]=$row['role'];
        $data_role[$i][1]=$row['role_name'];
        $i++;
    }
    
}
else{
    $data_role = [];
}

 // select danh sách bộ phận
 $sqlcheck_tb_department = "SELECT `department` FROM `tb_department` ORDER BY `department` ASC";
 $resultcheck_tb_department = mysqli_query( $connect, $sqlcheck_tb_department );
 if ($resultcheck_tb_department && $resultcheck_tb_department->num_rows > 0) {
     // tiến hành lặp dữ liệu
     $i = 0;
     while ($row = $resultcheck_tb_department->fetch_assoc()) {
         //thêm kết quả vào mảng
         $data_department[$i]=$row['department'];
         $i++;
     }
 }
 else{
     $data_department = [];
 }
 
//select logs
$sql_logs = "SELECT * FROM `tb_logs` WHERE `username` = '$username_change' ORDER BY `update_time` DESC LIMIT 100;";
$result_logs = mysqli_query($connect, $sql_logs);
// $check_account = mysqli_fetch_assoc( $resultcheck_account );
if ($result_logs && $result_logs->num_rows > 0) {
    // tiến hành lặp dữ liệu
    $i = 0;
    while ($row = $result_logs->fetch_assoc()) {
        //thêm kết quả vào mảng
        $data_logs[$i][0] = $row['id'];
        $data_logs[$i][1] = $row['ip_address'];
        $data_logs[$i][2] = $row['username'];
        $data_logs[$i][3] = $row['action'];
        $data_logs[$i][4] = $row['update_time'];
        $i++;
    }
} else {
    $data_logs = [];
}

//select curent_pw_js
$sql_pw = "SELECT * FROM `user_fischer` WHERE `username` = '$username_change';";
$result_pw = mysqli_query($connect, $sql_pw);
if ($result_pw && $result_pw->num_rows > 0) {
    $row = $result_pw->fetch_assoc();
        $current_pw = $row['password'];
        $current_department = $row['department'];
        $current_role = $row['role'];
        $current_email = $row['email'];
    
} else {
    $current_pw = null;
}

function return_rolename ($current_role, $data_role){
    $return = '';
    for($i = 0; $i < count($data_role);$i++){
        if($current_role === $data_role[$i][0]){
            $return = $data_role[$i][1];
            break;
        }
        else{
            $return = 'GUEST';
        }
    }
    return $return;
}
echo return_rolename ($current_role, $data_role);

if($current_role == $data_role[1][0]){
    print($data_role[1][1]);
}
else{
    print("failed to return");
}
// print($current_role);
// print($data_role[0][1]);
?>

<div class="row" style="margin-right: 10px;">
    <div class="col-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Profile</h3>
            </div>
        </div>
        <div class="card card-outline">
            <!-- <div class="card-body box-profile"> -->
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                    src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/img/avatar.png" ?>"
                    alt="User profile picture">
            </div>

            <h3 class="profile-username text-center"><?php echo $_COOKIE['full_name'] ?></h3>
            <p class="text-muted text-center"><?php echo $_COOKIE['username'] ?></p>
            <p class="text-muted text-center"><?php echo $_COOKIE['role_name'] ?></p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Change profile</h3>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#account" data-toggle="tab">Account</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Change password</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#logs" data-toggle="tab">Logs</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="account">
                        <form id="save_account_form" name="save_account_form" class="needs-validation" novalidate
                            required action="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/profile"; ?>"
                            method="post">
                            <div class="form-group">
                                <select class="form-control" id="position" name="position">
                                    <?php
                                    echo '<option value="'.$current_role.'">'. return_rolename($current_role, $data_role) .'</option>';
                                    for ($i=0; $i < count($data_role); $i++) {
                                        if($_COOKIE['role'] != $data_role[$i][0]){
                                            echo '<option value="'.$data_role[$i][0].'">'.$data_role[$i][1].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <small id="position_err" class="invalid-feedback">Notify</small>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select class="form-control" id="department" name="department">
                                    <?php
                                    echo '<option value="'.$current_department.'">'.$current_department.'</option>';
                                    for ($i=0; $i < count($data_department); $i++) {
                                        if($current_department != $data_department[$i]){
                                            echo '<option value="'.$data_department[$i].'">'.$data_department[$i].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <small id="department_err" class="invalid-feedback">Notify</small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control special_key" id="email" name="email"
                                    maxlength="40" value="<?php echo $current_email ?>">
                                <small id="email_err" class="invalid-feedback">Notify</small>
                            </div>
                            <input id="save_account_function" name="save_account_function" hidden></input>
                            <button type="button" onclick="save_account_btn()" class="btn btn-primary" id="account_btn"
                                name="account_btn">Save</button>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="password">
                        <form id="change_pw_form" name="change_pw_form" class="needs-validation" novalidate required
                            action="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/profile"; ?>" method="post">
                            <div class="form-group">
                                <label for="current_password">Current password</label>
                                <input type="password" class="form-control" id="current_password"
                                    name="current_password" autofocus="autofocus" autocomplete="current-password"
                                    placeholder="Enter your current password" maxlength="20" required>
                                <small id="current_password_err" class="invalid-feedback">Notify</small>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    autocomplete="new-password" placeholder="Enter your new password" maxlength="20"
                                    required>
                                <small id="new_password_err" class="invalid-feedback">Notify</small>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Retype new password</label>
                                <input type="password" class="form-control" id="confirm_password"
                                    name="confirm_password" autocomplete="new-password"
                                    placeholder="Retype your new password" maxlength="20" required ng-hide="true">
                                <small id="confirm_password_err" class="invalid-feedback">Notify</small>
                            </div>
                            <input id="change_pw_function" name="change_pw_function" hidden></input>
                            <button type="button" onclick="change_pw_btn()" class="btn btn-primary" id="pw_btn"
                                name="pw_btn">Change password</button>
                        </form>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="logs">
                        <table id="logs_table" class="table table-hover text-nowrap table-bordered text-center">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Date</th>
                                    <th style="width: 20%">IP Address</th>
                                    <th style="width: 60%">Conntent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($data_logs); $i++) {
                                    echo '<tr>';
                                    echo '<td>' . $data_logs[$i][4] . '</td>
                                            <td>' . $data_logs[$i][1] . '</td>
                                            <td style="max-width:300px;overflow: hidden;text-overflow: ellipsis"
                                             data-toggle="tooltip" data-placement="top" 
                                             title="' . $data_logs[$i][3] . '">' . $data_logs[$i][3] . '
                                             </td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<script>
function save_account_btn() {
    disableBtn('account_btn');
    positionElement = document.getElementById('position');
    position = positionElement.value.trim();
    position_err = document.getElementById('position_err');

    if (position == '' || position == null) {
        addIsInVail(positionElement);
        position_err.innerHTML = "Please select your position.";
    }
    if (department == '' || department == null) {
        addIsInVail(departmentElement);
        department_err.innerHTML = "Please enter full department.";
    }
    if (email == '' || email == null) {
        addIsInVail(emailElement);
        email_err.innerHTML = "Please enter full email.";
    }


    if (position != '' && department != '' && email != '') {
        document.getElementById('save_account_form').submit()
        // console.log("Submit")
    }
}
// Đổi mật khẩu
function change_pw_btn() {
    disableBtn('pw_btn');
    passwordElement = document.getElementById('current_password');
    password = passwordElement.value.trim();
    password_err = document.getElementById('current_password_err');

    new_passwordElement = document.getElementById('new_password');
    new_password = new_passwordElement.value.trim();
    new_password_err = document.getElementById('new_password_err');

    confirm_passwordElement = document.getElementById('confirm_password');
    confirm_password = confirm_passwordElement.value.trim();
    confirm_password_err = document.getElementById('confirm_password_err');

    var curent_pw_js = '<?php echo $current_pw ?>';

    //check pw
    var check_pw = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var myArr = JSON.parse(this.responseText);
            check_pw = myArr[0];
            if (password == '' || password == null) {
                addIsInVail(passwordElement);
                password_err.innerHTML = "Please enter your current password.";
            } else {
                removeAll(passwordElement);
                password_err.innerHTML = "";
            }
            if (new_password == '' || new_password.length < 6) {
                addIsInVail(new_passwordElement);
                new_password_err.innerHTML = "Please enter at least 6 characters.";
            } else {
                removeAll(new_passwordElement);
                new_password_err.innerHTML = "";
            }
            if (confirm_password == '' || confirm_password.length < 6) {
                addIsInVail(confirm_passwordElement);
                confirm_password_err.innerHTML = "Please enter at least 6 characters.";
            } else {
                removeAll(confirm_passwordElement);
                confirm_password_err.innerHTML = "";
            }
            // kiểm tra 3 trường pw rỗng
            if (password != '' && new_password != '' && confirm_password != '' && password_err.innerHTML == '' &&
                new_password_err.innerHTML == '' && confirm_password_err.innerHTML == '') {
                // alert("Check rỗng ok");
                if (check_pw == "no") { //kiểm tra xem nhập mật khẩu hiện tại đúng hay sai
                    addIsInVail(passwordElement);
                    password_err.innerHTML = "The current password is incorrect. Please try again!";
                } else if (check_pw == "yes") { // mật khẩu đúng thì tiếp tục kiểm tra xác nhận mật khẩu
                    addIsVail(passwordElement);
                    password_err.innerHTML = "";
                    //kiểm tra nhập mật khẩu mới và xác nhận mật khẩu ok chưa
                    if (new_password != confirm_password) {
                        addIsVail(new_passwordElement);
                        new_password_err.innerHTML = "";
                        addIsInVail(confirm_passwordElement);
                        confirm_password_err.innerHTML = "Confirmation password is not correct. Please try again!";
                    } else {
                        addIsVail(new_passwordElement);
                        addIsVail(confirm_passwordElement);
                        confirm_password_err.innerHTML = "";
                        new_password_err.innerHTML = "";
                        document.getElementById('change_pw_form').submit() //submit Change PW
                    }
                }

            }

        }
    };
    var link_get_data = "/fischer-asia/profile/checkpw";
    xmlhttp.open("POST", `${link_get_data}`);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(`checkpw=yes&curent_pw_js=${curent_pw_js}&new_pw_js=${password}`);
}
</script>
<script
    src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/oee-monitoring/views/default/js/function_for_form.js" ?>">
</script>
<script
    src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/oee-monitoring/views/default/js/register_function.js" ?>">
</script>
<script>
createDataTable('logs_table', 8, true, 'No results',
    'Search', 'Next',
    'Pre');
</script>
<script>
$(document).ready(function() {
    $('.select2').select2({});

});
</script>
<?php

// POST thông tin account lên server 
if (isset($_POST["save_account_function"])) {
    // echo '<script>console.log("Submit")</script>';
    $position = trim($_POST['position']);
    $department = trim($_POST['department']);
    $email = trim($_POST['email']);

    // echo "<script>alert('OK')</script>";
    $sqlsave = "UPDATE `user_fischer` SET `role`='$position',`department`='$department',`email`='$email' WHERE `username` = '$username_change'";
    $sqlsave_log = "INSERT INTO `tb_logs`(`ip_address`, `username`, `action`) VALUES ('$ip_address','$username_change','Thay đổi thông tin cá nhân')";
    // var_dump($sqlsave);die();
    if (mysqli_query($connect, $sqlsave) && mysqli_query($connect, $sqlsave_log)) {
        // echo "<script>alert('OK')</script>";
        echo "<script>document.location = '" . dirname($_SERVER['SCRIPT_NAME']) . "/profile'</script>";
        mysqli_close($connect);
    }
} else if (isset($_POST["change_pw_function"])) {
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    // mã hóa pw 
    $new_password = password_hash($new_password, PASSWORD_DEFAULT);
    $sqlchange = "UPDATE `user_fischer` SET `password`='$new_password' WHERE `username` = '$username_change'";
    $sqlsave_log = "INSERT INTO `tb_logs`(`ip_address`, `username`, `action`) VALUES ('$ip_address','$username_change','Thay đổi mật khẩu')";
    if (mysqli_query($connect, $sqlchange) && mysqli_query($connect, $sqlsave_log)) {
        mysqli_close($connect);
    }
}
?>