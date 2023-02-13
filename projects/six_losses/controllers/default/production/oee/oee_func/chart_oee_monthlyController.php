<?php 
    class chart_oee_monthlyController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/oee/oee_func";
        }
        function index()
        {
            $this->render('chart_oee_monthly',[]);
        }
        
    }
?>