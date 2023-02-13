<?php 
    class data_chart_monthly_filterController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/oee/oee_func";
        }
        function index()
        {
            $this->render('data_chart_monthly_filter',[]);
        }
    }
?>