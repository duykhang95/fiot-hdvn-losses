<?php 
    class chart_speedController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/speed/speed_func";
        }
        function index()
        {
            $this->render('chart_speed',[]);
        }
        
    }
?>