<?php 
    class index_intervalAW3Controller extends Controller
    {
        function __construct(){
            $this->folder = "default/maintenance/interval_aw3";
        }
        function index()
        {
            $this->render('index_intervalAW3',[]);
        }
        
    }
?>