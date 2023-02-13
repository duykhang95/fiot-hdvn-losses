<?php 
    class data_indexSXController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/index_sx_func";
        }
        function index()
        {
            $this->render('data_indexSX',[]);
        }
    }
?>