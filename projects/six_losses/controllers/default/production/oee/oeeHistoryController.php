<?php 
    class oeeHistoryController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/oee";
        }
        function index()
        {
            $this->render('oeeHistory',[]);
        }
        
    }
?>