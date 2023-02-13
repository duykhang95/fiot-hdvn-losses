<?php 
    class index_btController extends Controller
    {
        function __construct(){
            $this->folder = "default/maintenance";
        }
        function index()
        {
            $this->render('index_bt',[]);
        }
    }
?>