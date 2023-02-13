<?php 
    class hourly_outputController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/oee/oee_func";
        }
        function index()
        {
            $this->render('hourly_output',[]);
        }
    }
?>