<?php 
    class index_intervalAW2Controller extends Controller
    {
        function __construct(){
            $this->folder = "default/maintenance/interval_aw2";
        }
        function index()
        {
            $this->render('index_intervalAW2',[]);
        }
    }
?>