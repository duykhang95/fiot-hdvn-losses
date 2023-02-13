<?php 
    class data_emailController extends Controller
    {
        function __construct(){
            $this->folder = "default/production/email/email_func";
        }
        function index()
        {
            $this->render('data_email',[]);
        }
        
    }
?>