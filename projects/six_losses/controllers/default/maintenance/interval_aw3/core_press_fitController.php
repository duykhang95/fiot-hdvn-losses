<?php
    class core_press_fitController extends Controller
    {
        function __construct(){
            $this->folder = "default/maintenance/interval_aw3";
        }
        function index()
        {
            $this->render('core_press_fit',[]);
        }
        
    }
?>