<?php
    class Bootstrap
    {
        function __construct()
        {
            $url = isset($_GET['url']) ? $_GET['url'] : null;
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            // print_r($url);
            $lenurl = count($url);
            // print_r($url);

            $project = 'six_losses';
            //run home page
            if (empty($url[0])) {
                require_once "projects/" . $project . "/vendor/Controller.php";
                require_once "projects/" . $project . "/controllers/default/indexController.php";
                $object_controller = new IndexController();
                $object_controller->index();
                return false;
            }
            else {
                $ctrlerSubPath = "";
                if($lenurl == 1){
                    $ctrlerSubPath = $url[0];
                }
                else{
                    for ($i = 0; $i < $lenurl - 1; $i++) {
                        $ctrlerSubPath = $ctrlerSubPath . $url[$i] . '/';
                    }
                }
                // for ($i = 0; $i < $lenurl; $i++) {
                //     $ctrlerSubPath = $ctrlerSubPath . $url[$i];
                // }
                $controller = $url[$lenurl-1] . "Controller";
                // echo $ctrlerSubPath;
                // echo $controller;
                $ctrlerPath = "";
                // echo $ctrlerSubPath . "<br>";
                if (file_exists("projects/" . $project . "/controllers/default/" . $ctrlerSubPath . '/' . $controller . ".php")) {
                    $ctrlerPath = "projects/" . $project . "/controllers/default/" . $ctrlerSubPath . '/' . $controller . ".php";
                } elseif (file_exists("projects/" . $project . "/controllers/users/" . $ctrlerSubPath . '/' . $controller . ".php")) {
                    $ctrlerPath = "projects/" . $project . "/controllers/users/" . $ctrlerSubPath . '/' . $controller . ".php";
                } elseif (file_exists("projects/" . $project . "/controllers/admin/" . $ctrlerSubPath . '/' . $controller . ".php")) {
                    $ctrlerPath = "projects/" . $project . "/controllers/admin/" . $ctrlerSubPath . '/' . $controller . ".php";
                } else {
                    $ctrlerPath = "";
                }
                if ($ctrlerPath != "") {
                    require_once "projects/six_losses/vendor/Controller.php";
                    require_once $ctrlerPath;
                    $object_controller = new $controller;
                    $object_controller->index();
                } else {
                    echo "ERR 404: Request not found! 2";
                    return false;
                }
                
            }
        }
    }
?>