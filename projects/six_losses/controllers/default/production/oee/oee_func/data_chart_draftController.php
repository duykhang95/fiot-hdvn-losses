<?php 
    class data_chart_draftController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/oee/oee_func";
        }
        function index()
        {
            $this->render('data_chart_draft',[]);
        }
    }
?>