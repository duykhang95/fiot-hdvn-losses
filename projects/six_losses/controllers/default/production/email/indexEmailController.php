<?php 
    class indexEmailController extends Controller{
        function __construct(){
            $this->folder = "default/production/email";
        }
        function index()
        {
            $this->render('indexEmail',[]);
        }
    }
?>