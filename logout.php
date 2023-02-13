<?php
    // if(isset($_POST['logout'])) {
    //     session_start();
    //     unset($_SESSION['loggedinHDVN']);
    //     session_destroy();
    //     header('Location: /fiot-hdvn-losses/login.php');
    // }
    // else{
    //     header('Location: /fiot-hdvn-losses/index.php');
    // }
if(isset($_POST['logoutHDVN'])) {
    setcookie('id', '', time() -3600 , "/");
    setcookie('username', '', time() -3600 , "/");
    setcookie('full_name', '', time() -3600, "/");
    setcookie('department', '', time() -3600 , "/");
    setcookie('email', '', time() -3600 , "/");
    setcookie('role', '', time() -3600, "/");
    setcookie('role_name', '', time() -3600, "/");
    setcookie('immediate_superior', '', time() -3600, "/");
    setcookie('functions', '', time() -3600, "/");
    setcookie('lang', '', time() -3600, "/");
    setcookie('loggedinHDVN', '', time() -3600, "/");
	header('Location: /fiot-hdvn-losses/login.php');
}
else{
	header("location: /fiot-hdvn-losses/index.php");
}
?>