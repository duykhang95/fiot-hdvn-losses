<?php 
    class chart_losses_monthlyController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/index_sx_func";
        }
        function index()
        {
            $this->render('chart_losses_monthly',[]);
        }
    }
?>