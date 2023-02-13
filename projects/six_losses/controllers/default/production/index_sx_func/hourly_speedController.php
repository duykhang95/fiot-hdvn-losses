<?php 
    class hourly_speedController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/index_sx_func";
        }
        function index()
        {
            $this->render('hourly_speed',[]);
        }
    }
?>