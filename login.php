<?php
// Initialize the session
// session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_COOKIE["loggedinHDVN"]) && $_COOKIE["loggedinHDVN"] === true){
    header("location: /fiot-hdvn-losses/index.php");
    exit;
}

// Include config file
require_once 'config/config.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //set up lang
    // $lang = $_POST["lang"];
    // print($lang);die;
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your employee code.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password, full_name, department, email, role, immediate_superior, functions FROM user_hdvn WHERE username = ?";

        if ($stmt = mysqli_prepare($connect, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username,  $hashed_password, $full_name, $department, $email, $role, $immediate_superior, $functions);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // select danh sách chức vụ, vai trò
                            $sqlcheck_tb_role = "SELECT `role_name` FROM `tb_role` WHERE `role` = '$role'";
                            $resultcheck_tb_role = mysqli_query( $connect, $sqlcheck_tb_role );
                            if ($resultcheck_tb_role && $resultcheck_tb_role->num_rows > 0) {
                                $row = $resultcheck_tb_role->fetch_assoc();
                                $data_role=$row['role_name'];
                            }
                            else{
                                $data_role = [];
                            }
                            setcookie('username', $username, time() + (12 * 60 * 60), "/");
                            setcookie('full_name', $full_name, time() + (12 * 60 * 60), "/");
                            // setcookie('department', $department, time() + (12 * 60 * 60), "/");
                            setcookie('email', $email, time() + (12 * 60 * 60), "/");
                            setcookie('role', $role, time() + (12 * 60 * 60), "/");
                            setcookie('role_name', $data_role, time() + (12 * 60 * 60), "/");
                            setcookie('immediate_superior', $boss, time() + (12 * 60 * 60), "/");
                            setcookie('functions', $functions, time() + (12 * 60 * 60), "/");
                            setcookie('lang', $lang, time() + (12 * 60 * 60), "/");
                            setcookie('loggedinHDVN', true, time() + (12 * 60 * 60), "/");

                            // Redirect user to welcome page
                            // if($boss == '' || $boss == 'null'){
                            //     header("location: /fischer-asia/profile");
                            // }
                            // else{
                            //     header("location: /fischer-asia/");
                            // }
                            header("location: /fiot-hdvn-losses/");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "Wrong password, Please enter password again.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "Employee code does not exist.";
                }
            } else {
                echo "Login failed, Please try again.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($connect);
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HDVN Login</title>

        <!-- Favicons -->
        <link href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/img/logo.png" ?>"
            rel="icon">
        <link href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/img/logo.png" ?>"
            rel="apple-touch-icon">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/font-google/fonts-google.css" ?>">
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
                    <a href="#" class="h1"><b>HDVN</b> Dashboard</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your begin</p>

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
                        <!-- <div class="input-group mb-3">
                            <select class="form-control" id="lang" name="lang"> -->
                                <!-- <option value="vi">Việt Nam</option> -->
                                <!-- <option value="en">English</option>
                            </select>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-language"></span>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <br>
                    <p class="login-box-msg">Don't have an account? <a class="text-primary" href="register.php"><b>Sign
                                Up</b></a></p>


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