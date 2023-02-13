<?php 
    class chart_longDtController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/longDt/longDt_func";
        }
        function index()
        {
            $this->render('chart_longDt',[]);
        }
        
    }
?>