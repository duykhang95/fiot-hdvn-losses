<?php 
    class history_intervalController extends Controller
    {
        function __construct(){
            $this->folder = "default/maintenance";
        }
        function index()
        {
            $this->render('history_interval',[]);
        }
    }
?>