<?php 
    class data_oee_testController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/oee/oee_func";
        }
        function index()
        {
            $this->render('data_oee_test',[]);
        }
        
    }
?>