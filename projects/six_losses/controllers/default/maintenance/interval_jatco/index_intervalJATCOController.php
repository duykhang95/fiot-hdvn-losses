<?php 
    class index_intervalJATCOController extends Controller
    {
        function __construct(){
            $this->folder = "default/maintenance/interval_jatco";
        }
        function index()
        {
            $this->render('index_intervalJATCO',[]);
        }
    }
?>