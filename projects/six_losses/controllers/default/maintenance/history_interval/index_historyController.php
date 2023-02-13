<?php
    class index_historyController extends Controller
    {
        function __construct(){
            $this->folder = "default/maintenance/history_interval";
        }
        function index()
        {
            $this->render('index_history',[]);
        }
        
    }
?>