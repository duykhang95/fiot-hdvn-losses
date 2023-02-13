<?php
$connect = $GLOBALS['connect'];
$username = $_COOKIE['username'];

$sqlcheck_account = "SELECT * FROM `user_fischer` WHERE `username`='$username' ";
$resultcheck_account = mysqli_query($connect, $sqlcheck_account);
// $check_account = mysqli_fetch_assoc( $resultcheck_account );
if ($resultcheck_account && $resultcheck_account->num_rows > 0) {
    // tiến hành lặp dữ liệu
    if ($row = $resultcheck_account->fetch_assoc()) {
        //thêm kết quả vào mảng
        $role = ($row['role'] !== '') ? ($row['role']) : 8;
        $functions = $row['functions'];
        $department = $row['department'];
    } else {
        $role = 8;
        $functions = null;
        $department = null;
    }

    // select danh sách chức vụ, vai trò
    $sqlcheck_tb_role = "SELECT `role_name` FROM `tb_role` WHERE `role` = '$role'";
    $resultcheck_tb_role = mysqli_query( $connect, $sqlcheck_tb_role );
    if ($resultcheck_tb_role && $resultcheck_tb_role->num_rows > 0) {
        $row = $resultcheck_tb_role->fetch_assoc();
        $role_name=$row['role_name'];
    }
    else{
        $role_name = 'GUEST';
    }
    
    setcookie('role', '', time() - 3600, "/");
    setcookie('role_name', '', time() - 3600, "/");
    setcookie('functions', '', time() - 3600, "/");
    setcookie('department', '', time() - 3600, "/");
    setcookie('role',  $role, time() + (12 * 60 * 60), "/");
    setcookie('role_name',  $role_name, time() + (12 * 60 * 60), "/");
    setcookie('functions',  $functions, time() + (12 * 60 * 60), "/");
    setcookie('department',  $department, time() + (12 * 60 * 60), "/");
}