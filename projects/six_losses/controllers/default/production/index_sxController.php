<?php 
    class index_sxController extends Controller
    {
        function __construct(){
            $this->folder = "default/production";
        }
        function index()
        {
            $this->render('index_sx',[]);
        }
    }
?>