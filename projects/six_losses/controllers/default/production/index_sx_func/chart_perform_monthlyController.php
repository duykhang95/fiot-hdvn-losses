<?php 
    class chart_perform_monthlyController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/index_sx_func";
        }
        function index()
        {
            $this->render('chart_perform_monthly',[]);
        }
    }
?>