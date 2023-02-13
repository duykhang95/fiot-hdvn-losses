<?php
    class moldingController extends Controller
    {
        function __construct(){
            $this->folder = "default/maintenance/interval_aw3";
        }
        function index()
        {
            $this->render('molding',[]);
        }
        
    }
?>