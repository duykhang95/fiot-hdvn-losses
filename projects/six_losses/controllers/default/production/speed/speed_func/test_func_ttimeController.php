<?php 
    class test_func_ttimeController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/speed/speed_func";
        }
        function index()
        {
            $this->render('test_func_ttime',[]);
        }
        
    }
?>