<?php
    if(isset($_COOKIE["loggedinHDVN"]) && $_COOKIE["loggedinHDVN"] === true){
        header("location: /fiot-hdvn-losses/");
        exit;
    }
    
    // Include config file
    require_once 'config/config.php';
    
    $username = $password = $full_name = $position = $department = $email = $boss = "";
    $username_err = $full_name_err =  $password_err = $full_name_err = $position_err = $department_err = $email_err = $boss_err = "";
    
    //select danh sách account
    $sqlcheck_account = "SELECT `username` FROM `user_hdvn` WHERE `username`ORDER BY `username` ASC";
    $resultcheck_account = mysqli_query( $connect, $sqlcheck_account );
    // $check_account = mysqli_fetch_assoc( $resultcheck_account );
    if ($resultcheck_account && $resultcheck_account->num_rows > 0) {
        // tiến hành lặp dữ liệu
        $i = 0;
        while ($row = $resultcheck_account->fetch_assoc()) {
            //thêm kết quả vào mảng
            $data_account[$i]=$row['username'];
            $i++;
        }
    }
    else{
        $data_account = [];
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

    // select danh sách chức vụ, vai trò
    $sqlcheck_tb_role = "SELECT `role`, `role_name` FROM `tb_role` WHERE `role` != 0 ORDER BY `role` ASC";
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

    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        // Check if username is empty
            if(empty(trim($_POST["username"]))){
                $username_err = "Please enter your employee code.";
            } else{
                $username = trim($_POST["username"]);
                $username_err = "";
            }
            
            // Check if password is empty
            if(empty(trim($_POST["password"]))){
                $password_err = "Please enter your password.";
            } else{
                $password = trim($_POST["password"]);
                $password = password_hash($password, PASSWORD_DEFAULT);
                $password_err = "";
                
            }
            //check full name
            if(empty($_POST["full_name"])){
                $full_name_err = "Please enter your full name.";
            } else{
                $full_name = trim($_POST["full_name"]);
                $full_name_err = "";
                
                
            }
            //check position
            if(empty($_POST["position"])){
                $position_err = "Please select your position.";
            } else{
                $position = trim($_POST["position"]);
                $position_err = "";
                
                
            }
            //check department
            // if(empty($_POST["department"])){
            //     $department_err = "Please select your department.";
            // } else{
            //     $department = trim($_POST["department"]);
            //     $department_err = "";
            // }

            //check email
            if(empty($_POST["email"])){
                $email_err = "Please enter your email.";
            } else{
                $email = trim($_POST["email"]);
                $email_err = "";
                
            }

            //submit register
            if(isset($_POST["register"])){

                for($i = 0; $i < count($data_account); $i++){
                    if($username == $data_account[$i]){
                        $username_err = "Employee code is already registered.";
                        // die();
                    }
                }
                if($username_err == '' && $password_err == '' && $full_name_err == '' && $position_err == '' && $email_err == ''){
                    $sqlregister = "INSERT INTO `user_hdvn`(`username`, `password`, `full_name`, `department`, `email`, `role`) VALUES ('$username', '$password', '$full_name', '$department', '$email', '$position')";
                    if ( mysqli_query( $connect, $sqlregister ) ) {
                        mysqli_close( $connect );
                    }
                    echo "<script>document.location = '/fiot-hdvn-losses/'</script>";
                }
                
            }
        
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HDVN Register</title>
        <!-- Favicons -->
        <link href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/img/logo.png" ?>"
            rel="icon">
        <link href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/img/logo.png" ?>"
            rel="apple-touch-icon">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/font-google/fonts-google.css"?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="projects/common/public/plugins/fontawesome-free/css/all.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="projects/common/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="projects/common/public/dist/css/adminlte.min.css">
    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="index2.html" class="h1"><b>HDVN</b> Dashboard</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg h3"><b>CREATE ACCOUNT</b></p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="input-group mb-3">
                            <input type="username" name="username" class="form-control" placeholder="Employee code"
                                autocomplete="username" value="<?php echo $username; ?>">

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="help-block text-danger"><?php echo $username_err; ?></span>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                autocomplete="current-password">
                            <input type="password" name="passwordnew" class="form-control" placeholder="Password"
                                autocomplete="new-password" hidden="hidden">

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="help-block text-danger"><?php echo $password_err; ?></span>
                        </div>

                        <div class="input-group mb-3">
                            <input type="full_name" name="full_name" class="form-control" placeholder="Full Name"
                                autocomplete="full_name" value="<?php echo $full_name; ?>">

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-address-card "></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="help-block text-danger"><?php echo $full_name_err; ?></span>
                        </div>

                        <div class="input-group mb-3">
                            <select class="form-control" id="position" name="position">
                                <option value="">Select position</option>
                                <?php
                                for ($i=0; $i < count($data_role); $i++) {
                                    echo '<option value="'.$data_role[$i][0].'">'.$data_role[$i][1].'</option>';
                                }
                                ?>
                            </select>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-briefcase"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="help-block text-danger"><?php echo $position_err; ?></span>
                        </div>

                        <!-- <div class="input-group mb-3">
                            <select class="form-control" id="department" name="department">
                                <option value="">Select department</option>
                                <?php
                                // for ($i=0; $i < count($data_department); $i++) {
                                //     echo '<option value="'.$data_department[$i].'">'.$data_department[$i].'</option>';
                                // }
                                ?>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-building"></span>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="input-group mb-3">
                            <span class="help-block text-danger"><?php echo $department_err; ?></span>
                        </div> -->

                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                autocomplete="email" value="<?php echo $email; ?>">

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="help-block text-danger"><?php echo $email_err; ?></span>
                        </div>
                        <div class="input-group mb-3">
                            <span class="help-block text-danger"><?php echo $boss_err; ?></span>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block" id="register"
                                    name="register">Sign Up</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <br>
                    <p class="login-box-msg">Have already an account? <a class="text-primary" href="login.php"><b>Login
                                here</b></a></p>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="projects/common/public/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="projects/common/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="projects/common/public/dist/js/adminlte.min.js"></script>

    </body>

</html>