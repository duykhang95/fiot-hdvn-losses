<?php
    class weldingController extends Controller
    {
        function __construct(){
            $this->folder = "default/maintenance/interval_aw3";
        }
        function index()
        {
            $this->render('welding',[]);
        }
        
    }
?>