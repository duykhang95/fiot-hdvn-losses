<?php
    class weldingController extends Controller
    {
        function __construct(){
            $this->folder = "default/maintenance/interval_jatco";
        }
        function index()
        {
            $this->render('welding',[]);
        }
        
    }
?>