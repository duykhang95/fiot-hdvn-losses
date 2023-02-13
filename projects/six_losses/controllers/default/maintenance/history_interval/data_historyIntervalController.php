<?php
    class data_historyIntervalController extends Controller
    {
        function __construct(){
            $this->folder = "default/maintenance/history_interval";
        }
        function index()
        {
            $this->render('data_historyInterval',[]);
        }
        
    }
?>