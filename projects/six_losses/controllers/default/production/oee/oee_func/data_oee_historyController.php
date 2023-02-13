<?php 
    class data_oee_historyController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/oee/oee_func";
        }
        function index()
        {
            $this->render('data_oee_history',[]);
        }
        
    }
?>