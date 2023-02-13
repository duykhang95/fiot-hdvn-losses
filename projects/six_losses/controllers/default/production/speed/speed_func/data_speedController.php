<?php 
    class data_speedController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/speed/speed_func";
        }
        function index()
        {
            $this->render('data_speed',[]);
        }
        
    }
?>