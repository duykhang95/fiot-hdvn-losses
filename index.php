<?php
if (isset($_COOKIE["loggedinHDVN"]) && $_COOKIE["loggedinHDVN"] == true) {
}
else {
    echo "<script>document.location = '/fiot-hdvn-losses/login.php'</script>";
}
require_once 'config/config.php';
require_once 'config/dbconnection.php';
require_once 'vendor/Bootstrap.php';
require_once 'projects/common/views/layouts/setcookie_role.php';

//check lang
if(isset($_COOKIE['lang'])){
    if($_COOKIE['lang'] == 'vi'){
        require_once 'lang/vi.php';
    }
    else if($_COOKIE['lang'] == 'en'){
        require_once 'lang/en.php';
    }
    else {
        require_once 'lang/ja.php';
    }
}
else{
    setcookie('lang', 'en', time() + (12 * 60 * 60), "/");
    require_once 'lang/en.php';
    header("Refresh:0");
}

$x = new Bootstrap();
// print($_COOKIE['lang']);
//abc
?>