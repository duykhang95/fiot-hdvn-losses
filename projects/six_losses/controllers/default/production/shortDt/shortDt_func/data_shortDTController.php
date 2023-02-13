<?php 
	class data_shortDTController extends Controller
	{
		function __construct(){
			$this->folder = "default/production/shortDt/shortDt_func";
		}
		function index()
		{
			$this->render('data_shortDT',[]);
		}
		
	}
?>